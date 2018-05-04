<?php

/**
 * Description of VigenciaWs
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/nusoap095/lib/nusoap.php';
require_once APPPATH.'third_party/FirePHP/FirePHP.class.php';
class VigenciaWs extends Config{
    const WS_DEF_REQ_TMOUT = 10, WS_DEF_RESP_TMOUT = 30;
    public $stat, $errCode, $msg, $rawData, $data, $soapCli,
            $errCatalog = array(
                "WS_TIMED_OUT",
                "WS_HTTP_ERROR",
                "WS_CLI_CONF",
                /* El valor de WS_CLI_MP es dummy, solo para tenerlo en el catálogo.
                 * Aplica para cuando el WS responde técnicamente bien, pero sucedió
                 * un problema con el servicio o con la información de la BD. */
                "WS_CLI_MP",
                //WS_UNKNOWN para cuando no aplique ninguno de estos.
                "WS_UNKNOWN"
    );
    //http://vigenciaderechos.imss.gob.mx/WSConsVigGpoFamComXNssService/WSConsVigGpoFamComXNss?wsdl
    //http://172.16.23.113/WSConsVigGpoFamComXNssService/WSConsVigGpoFamComXNss?WSDL
    private
            $webServices = array(
                'Acceder_Uni' => array(
                    'url' => "http://vigenciaderechos.imss.gob.mx/WSConsVigGpoFamComXNssService/WSConsVigGpoFamComXNss?wsdl",
                    'oper' => "getInfo",
                    'root' => "return",
                    'wsdl' => true,
                    'namespacews' => "http://vigenciaderechos.imss.gob.mx",
                    'checkKey' => "codigoError",
                    'reqTimeout' => 10,
                    'respTimeout' => 15
                ),
            ),
            $callErrors = array(
                "WS_TIMED_OUT" => "timed out",
                "WS_HTTP_ERROR" => "HTTP ERROR",
                "WS_CLI_CONF" => "XML error parsing",
            ),
            $dataInvalidVals = array(
                'NO ASIGNADA', 'NO ASIGNADO', 'NO TIENE', 'Desconocido', 'Indefinido', '', null,
            ),
            $currWSData = null, $currWSName = "", $firePHP = null,
            $comFdsDH = array('Colonia', 'Direccion', 'Telefono', 'Consultorio','DhDeleg', 'DhUMF', 'ClavePresupuestal', 'Turno'),
            $dateFields = array('FechaNacimiento', 'VigenteHasta');
    public function __construct() {
        parent::__construct();
        $this->firePHP = FirePHP::init();
        //Para deshabilitar el logging de PHP
        $this->firePHP->setEnabled($enableLogging);
        error_reporting(1);
    }

    public function verificaVigencia($NSS, $agregado = "") {
        $acceUniPms = array('nss' => $NSS, 'Cpid' => '36');
        if ($this->requestWebServiceData("Acceder_Uni", $acceUniPms)) {
            $this->parseResponseData();
        } else {
        }
        $finalData = $this->data;
        if ($agregado)
            $finalData = $this->getAgregadoData($agregado, $this->data);

        $this->firePHP->log($finalData, "FINALIZA PROCESO");

        return $finalData;
    }
    /**
     * Para cuando se requiera tambien mandar el agregado no se
     * envia directamente a los WS, se recupera todo el gpo familiar,
     * ya con los datos finales se devuelve solo el que contenga el agregado
     * correcto. Esto debido a que hay casos donde solo el asegurado
     * contiene los datos de domicilio
     * 
     */
    private function getAgregadoData($agregado, $arrayFinalData) {
        $kAgr = 'AgregadoMedico';

        foreach ($arrayFinalData as $rowd) {
            if ($rowd[$kAgr] == $agregado) {
                return $rowd;
            }
        }
        return array();
    }
    private function requestWebServiceData($ws, $paramsWS) {
        $this->stat = false;
        $this->currWSName = $ws;
        $this->currWSData = $this->webServices[$ws];
        $this->firePHP->log(array_merge($this->currWSData, $paramsWS), "Conectar a {$this->currWSName} con pms");
        $soapCli = $this->soapCli = $this->initSoapCliObj();
        $this->rawData = $soapCli->call($this->currWSData["oper"], $paramsWS, $this->currWSData["namespacews"]);
        //$this->setOutputV2($this->rawData['return']);
        $this->stat = $this->checkResponse();
        $this->firePHP->log($this->rawData, "$ws Resultado Raw de Conexion");
        if (!$this->stat)
            $this->firePHP->error("{$this->errCode}. Mensaje error: {$this->msg}", "$ws Error");

        return $this->stat;
    }

    private function initSoapCliObj() {
        //Timeouts
        $reqTimeoutInSecs = isset($this->currWSData["reqTimeout"]) ? $this->currWSData["reqTimeout"] : self::WS_DEF_REQ_TMOUT;
        $respTimeoutInSecs = isset($this->currWSData["respTimeout"]) ? $this->currWSData["respTimeout"] : self::WS_DEF_RESP_TMOUT;

        $soapCli = new nusoap_client(
                $this->currWSData["url"], $this->currWSData["wsdl"], false, false, false, false, $reqTimeoutInSecs, $respTimeoutInSecs
        );

        //Por default nusoap trabaja con ISO-8859-1 y los web services aqui estan trabajando con utf 8
        $soapCli->decode_utf8 = 0;
        $soapCli->soap_defencoding = 'UTF-8';
        $soapCli->setDebugLevel(0); //Para ver el log valores de 1-9
        return $soapCli;
    }

    private function checkResponse() {
        $errTxtSOAP = $this->msg = $this->soapCli->getError();

        if ($this->soapCli->fault || $errTxtSOAP) {
            /* El error WS_UNKOWN sera cuando no se encuentre la naturaleza del error
             * ya sea si existe un $errTxtSOAP o un $soapCli->fault
             */
            $this->errCode = "WS_UNKOWN";
            if ($errTxtSOAP) {
                $this->firePHP->log($errTxtSOAP, "Error SOAP");
                foreach ($this->callErrors as $k => $v) {
                    if (stripos($errTxtSOAP, $v) !== false) {
                        $this->errCode = $k;
                        break;
                    }
                }
            }
            return false;
        }
        //var_dump($this->rawData[$this->currWSData['root']]);
        return $this->checkResponseData();
    }

    private function checkResponseData() {
        $responseErrs = array('2' => 'WS_ND_DH', '3' => 'DH_WARN_OUTDATED_DATA');
        if (!$this->checkDataStructure($this->rawData))
            return false;

        $d = $this->data = $this->rawData[$this->currWSData['root']];
        //No solo en los errores hay mensajes, tambien en respuestas exitosas que requieren alguna atención del usuario
        $this->msg = $d['mensajeError'];
        $res = $d[$this->currWSData['checkKey']];
        if (!($this->errCode = $responseErrs[$res])) {
            $this->errCode = "WS_CLI_MP";
        }
        if ($res == '2') {
            return false;
        }
        return true;
    }

    private function parseResponseData() {
        $this->data['isAsegurado'] = true;
        $asegData = $this->data;
        unset($asegData['Beneficiarios']);
        /*
         * Si el DH no tiene beneficiarios el WS no devuelve la propiedad 'Beneficiarios'
         * Si el DH solo tiene 1 beneficiario el WS en lugar de devolver un arreglo 
         * de arreglos (donde cada arreglo es un beneficiario), devuelve un arreglo
         * asociativo con las propiedades directas del único beneficiario, p.e:
         * array('Beneficiarios'=>array('AgregadoMedico'=>123,Colonia=>'asd',...))
         * Cuando el DH tiene más de 1 beneficiario el formato esperado es
         * array('Beneficiarios'=>array(0 => array('AgregadoMedico'=>123,Colonia=>'asd',...)), 1 => array(...),...)
         */
        $data = isset($this->data['Beneficiarios']) ? $this->data['Beneficiarios'] : array();
        if (!empty($data) && !isset($data[0]))
            $data = array($data);
            array_unshift($data, $asegData);

        foreach ($data as &$dh) {
            $this->checkValues($dh, $asegData, !isset($dh['isAsegurado']));
            $agregados[] = $dh['AgregadoMedico'];
        }
        array_multisort($agregados, $data);
        $this->data = $data;
    }

    private function checkValues(&$data, $asegData, $isBenef = false) {
        foreach ($data as $fd => $v) {
            if (in_array($fd, $this->dateFields) && !empty($v)) {
                $data[$fd] = $this->parseWSDate($v, '');
            }
            if ($isBenef)
                $this->checkDHValue($data, $asegData, $fd);
        }
    }

    /**
     * Función para formatear la fecha de respuesta del Web Service al formato
     * 'd/m/Y'
     * Se considera que el date a convertir puede venir en iso8601,
     * eso es algo como "1987-02-21T00:00:00-06:00".
     * O puede venir en formato 'Y/m/d', no importa el formato de entrada
     * mientras que sea entendido por las notaciones definidas en php
     * http://php.net/manual/en/datetime.formats.php
     */
    private function parseWSDate($dateStr, $defVal = "Desconocido") {
        if (($dateOb = date_create($dateStr))) {
            return date_format($dateOb, 'd/m/Y');
        } else {
            $this->firePHP->warn($dateStr, "ADVERTENCIA, formato de fecha desconocido");
            return $defVal;
        }
    }

    private function checkDHValue(&$dataDH, $asegData, $fd) {
        /* Si hay presencia de grupo familiar acomodar los datos compartidos
         * Basándose en los del ASEGURADO
         */
        if (in_array($fd, $this->comFdsDH) && !$this->isValidVal($dataDH[$fd], false))
            $dataDH[$fd] = isset($this->data[$fd]) ? $this->data[$fd] : '';
    }

    /**
     * Si se hace strict a false, los valores "empty" como '',0,false,null
     * se interpretan iguales a '' a excepcion del '0' (0 como string)
     * Tener cuidado cuando 0 sea un valor correcto, en dicho caso $strict debe 
     * ser true.
     * @param mixed $dataValue
     * @param boolean $strict
     * @return boolean
     */
    private function isValidVal($dataValue, $strict = true) {
        return !in_array($dataValue, $this->dataInvalidVals, $strict);
    }
    
    /**
     * 
     * @param type $data
     * @return boolean
     */

    private function checkDataStructure($data) {
        if (!is_array($data) || !is_array($data[$this->currWSData["root"]]) 
                || !isset($data[$this->currWSData["root"]]["codigoError"]))
            return false;

        return true;
    }
    public function AjaxVigenciaAcceder() {
        if(isset($_GET['inputNssAg']) || isset($_POST['inputNssAg'])){
            $respData = $this->verificaVigencia($this->input->get_post('inputNss'),$this->input->get_post('inputNssAg'));
            $this->config_mdl->sqlInsert('sigh_acceder_log',array(
                'log_fecha'=> date('Y-m-d'),
                'log_hora'=>date('H:i:i'),
                'log_nss'=>$this->input->get_post('inputNss'),
                'log_nss_agregado'=>$this->input->get_post('inputNssAg'),
                'log_area'=> $this->UMAE_AREA,
                'empleado_id'=> $this->UMAE_USER
            ));
        }else{
            $respData = $this->verificaVigencia($this->input->get_post('inputNss'));
            $this->config_mdl->sqlInsert('sigh_acceder_log',array(
                'log_fecha'=> date('Y-m-d'),
                'log_hora'=>date('H:i:i'),
                'log_nss'=> $this->input->get_post('inputNss'),
                'log_nss_agregado'=>'NO APLICA',
                'log_area'=> $this->UMAE_AREA,
                'empleado_id'=> $this->UMAE_USER
            ));
        }
        
        $this->setOutputV2($respData);
    }
    
}
