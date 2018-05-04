<?php

/**
 * Description of Rx
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Rx extends Config{
    public function RegionesAnatomicas() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_rx_ra');
        $this->load->view('RegionesAnatomicas',$sql);
    }
    public function AjaxRegionAnatomica() {
        $data=array(
            'ra_nombre'=> $this->input->post('ra_nombre')
        );
        if($this->input->post('ra_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_rx_ra',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_rx_ra',$data,array(
                'ra_id'=> $this->input->post('ra_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarRegionAnatomica() {
        $this->config_mdl->sqlDelete('sigh_rx_ra',array(
            'ra_id'=> $this->input->post('ra_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Estudios() {
        $Ra= $this->input->get('ra');
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_rx_ra AS ra
                                                        INNER JOIN sigh_rx_ra_estudios estudios
                                                        ON(
                                                                ra.ra_id=estudios.ra_id AND 
                                                                ra.ra_id=$Ra)");
        $this->load->view('RegionesAnatomicasEstudios',$sql);
    }
    public function AjaxEstudios() {
        $data=array(
            'estudio_nombre'=> $this->input->post('estudio_nombre'),
            'ra_id'=> $this->input->post('ra_id')
        );
        if($this->input->post('estudio_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_rx_ra_estudios',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_rx_ra_estudios',$data,array(
                'estudio_id'=> $this->input->post('estudio_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarEstudio() {
        $this->config_mdl->sqlDelete('sigh_rx_ra_estudios',array(
            'estudio_id'=> $this->input->post('estudio_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /**/
    public function AjaxSolicitudesRxAmView() {
        $triage_id= $this->input->post('triage_id');
        $sql= $this->config_mdl->sqlQuery("SELECT solicitud_id FROM sigh_rx_solicitudes AS sol 
                                        INNER JOIN sigh_empleados emple ON (
                                                emple.empleado_id=sol.empleado_id AND sol.ingreso_id=$triage_id)");
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxSolicitudesRxTriage() {
        $ingreso_id= $this->input->get_post('ingreso_id');
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_rx_solicitudes AS sol 
                                        INNER JOIN sigh_empleados emple ON (
                                                emple.empleado_id=sol.empleado_id AND sol.ingreso_id=$ingreso_id)");
        $tr='';
        foreach ($sql as $value) {
            $tr.='  <tr>
                        <td>'.$value['solicitud_fecha'].' '.$value['solicitud_hora'].'</td>
                        <td>'.$value['solicitud_dx_presuncional'].'</td>
                        <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                        <td>
                            <i class="fa fa-pencil color-imss i-20 pointer btn-rx-nueva-solicitud"  data-id="'.$value['solicitud_id'].'" data-dx="'.$value['solicitud_dx_presuncional'].'" data-ingreso="'.$ingreso_id.'" data-accion="edit"></i>&nbsp;
                            <a href="Rx/AgregarEstudios?sol='.$value['solicitud_id'].'&folio='.$ingreso_id.'" class="solicitud-rx-estudio-triage">
                                <i class="fa fa-clone color-imss i-20"></i>
                            </a>&nbsp;
                            <i class="fa fa-trash-o color-imss pointer i-20 icon-rx-remove" data-id="'.$value['solicitud_id'].'"></i>
                        </td>
                    </tr>';
            
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function SolicitudesRx() {
        $Folio=$_GET['folio'];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_rx_solicitudes AS sol 
                                        INNER JOIN sigh_empleados emple ON (
                                                emple.empleado_id=sol.empleado_id AND sol.ingreso_id=$Folio)");
        $this->load->view('SolicitudesRx',$sql);
    }
    public function AjaxSolicitudesRx() {
        $data=array(
            'solicitud_dx_presuncional'=> $this->input->post('solicitud_dx'),
            'solicitud_area'=> $this->UMAE_AREA,
            'solicitud_fecha'=> date('Y-m-d'),
            'solicitud_hora'=>date('H:i:s'),
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'empleado_id'=> $this->UMAE_USER
        );
        $SolicitudID=0;
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_rx_solicitudes',$data);
            $SolicitudID= $this->config_mdl->sqlGetLastId('sigh_rx_solicitudes','solicitud_id');
        }else{
            unset($data['solicitud_fecha']);
            unset($data['solicitud_hora']);
            unset($data['empleado_id']);
            $this->config_mdl->sqlUpdate('sigh_rx_solicitudes',$data,array(
                'solicitud_id'=> $this->input->post('solicitud_id')
            ));
            $SolicitudID=$this->input->post('solicitud_id');
        }
        $this->setOutput(array('accion'=>'1','SolicitudId'=>$SolicitudID));
    }
    public function AgregarEstudios() {
        $sql['Regiones']= $this->config_mdl->sqlGetData('sigh_rx_ra');
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_rx_solicitudes_estudios se
                                                        INNER JOIN sigh_rx_solicitudes sol ON se.solicitud_id=sol.solicitud_id
                                                        INNER JOIN sigh_rx_ra_estudios es ON es.estudio_id=se.estudio_id 
                                                        INNER JOIN sigh_rx_ra ra ON ra.ra_id=es.ra_id AND sol.solicitud_id=".$this->input->get_post('sol'));
        $this->load->view('SolicitudesRx_Estudios',$sql);
    }
    public function AjaxObtenerEstudios() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_rx_ra_estudios',array(
            'ra_id'=> $this->input->post('ra_id')
        ));
        $Estudios='';
        $Estudios.='<option value="">SELECCIONAR ESTUDIO</option>';
        foreach ($sql as $value) {
            $Estudios.='<option value="'.$value['estudio_id'].'">'.$value['estudio_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$Estudios));
    }
    public function AjaxSolicitudAgregarEs() {
        $data=array(
            'se_fecha'=>date('Y-m-d'),
            'se_hora'=>date('H:i:i'),
            'solicitud_id'=> $this->input->post('solicitud_id'),
            'estudio_id'=> $this->input->post('estudio_id')
        );
        $Check= $this->config_mdl->sqlGetDataCondition('sigh_rx_solicitudes_estudios',array(
            'solicitud_id'=> $this->input->post('solicitud_id'),
            'estudio_id'=> $this->input->post('estudio_id')
        ));
        if(empty($Check)){
            $this->config_mdl->sqlInsert('sigh_rx_solicitudes_estudios',$data);
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
        
        
    }
    public function AjaxRxElimiarSolicitudes() {
        $this->config_mdl->sqlDelete('sigh_rx_solicitudes',array(
            'solicitud_id'=> $this->input->post('solicitud_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxSolicitudEliminarEs() {
        $this->config_mdl->sqlDelete('sigh_rx_solicitudes_estudios',array(
            'se_id'=> $this->input->post('se_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function SendXML() {
        $this->load->view('SendXML');
    }
    public function AjaxSendXML() {
        $xml_data='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.connectors.connect.mirth.com/">';
            $xml_data.='<soapenv:Header/>';
                $xml_data.='<soapenv:Body use="literal">';
                    $xml_data.='<ws:acceptMessage>';
                        $xml_data.='<arg0>';
                            $xml_data.='<![CDATA[';
                            $xml_data.='<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
                            $xml_data.='<result>';
                                $xml_data.='<GRAMMAR_ID>ORM-O01</GRAMMAR_ID>';
                                $xml_data.='<Paciente_ID>1163980</Paciente_ID>';
                                $xml_data.='<Paciente_Nombre>ALBERTO MAJARRILLA</Paciente_Nombre>';
                                $xml_data.='<Paciente_APaterno>U</Paciente_APaterno>';
                                $xml_data.='<Paciente_AMaterno>U</Paciente_AMaterno>';
                                $xml_data.='<Paciente_Genero>F</Paciente_Genero>';
                                $xml_data.='<Paciente_FNacimiento>19650627</Paciente_FNacimiento>';
                                $xml_data.='<Medico_ID>61884</Medico_ID>';
                                $xml_data.='<Medico_Nombre>DAMESIO</Medico_Nombre>';
                                $xml_data.='<Medico_APaterno>JOHN</Medico_APaterno>';
                                $xml_data.='<Medico_AMaterno></Medico_AMaterno>';
                                $xml_data.='<Visita_ID>584585</Visita_ID>';
                                $xml_data.='<Visita_Origen>U</Visita_Origen>';
                                $xml_data.='<Visita_Prioridad>S</Visita_Prioridad> ';
                                $xml_data.='<Visita_Clinicos>Fractura de femur expuesta</Visita_Clinicos>';
                                $xml_data.='<Visita_Accion>NW</Visita_Accion> ';
                                $xml_data.='<Referencia_Clave>HO90</Referencia_Clave>';
                                $xml_data.='<Referencia_Descripcion>Hospital de Alta Especialidad</Referencia_Descripcion>';
                                $xml_data.='<Procedimiento_ID>982</Procedimiento_ID>';
                                $xml_data.='<Procedimiento_Descripcion>TORAX SIMPLE</Procedimiento_Descripcion>';
                                $xml_data.='<Procedimiento_Modalidad>RX</Procedimiento_Modalidad>';
                            $xml_data.='</result>]]>';   
                        $xml_data.='</arg0>';
                    $xml_data.='</ws:acceptMessage>';
                $xml_data.='</soapenv:Body>';
        $xml_data.='</soapenv:Envelope>';
        $url="http://201.149.27.42:5888/services/Integracion?wsdl";
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
        $this->setOutput(array('accion'=>$result));
    }
    public function AjaxAgregarEstudioEspecial() {
        $this->config_mdl->sqlInsert('sigh_rx_ra_estudios',array(
            'estudio_nombre'=> $this->input->post('estudio_nombre'),
            'ra_id'=> $this->input->post('ra_id_es')
        ));
        $EstudioId= $this->config_mdl->sqlGetLastId('sigh_rx_ra_estudios','estudio_id');
        $data=array(
            'se_fecha'=>date('Y-m-d'),
            'se_hora'=>date('H:i:i'),
            'solicitud_id'=> $this->input->post('solicitud_id'),
            'estudio_id'=> $EstudioId
        );
        $this->config_mdl->sqlInsert('sigh_rx_solicitudes_estudios',$data);
        $this->setOutput(array('accion'=>'1'));
    }
}
