<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author felipe de jesus
 */
require_once APPPATH.'third_party/html2pdf/html2pdf.class.php';
require_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
class Config extends MX_Controller{
    public $UMAE_USER,$UMAE_AREA;
    public $ConfigEnfermeriaHC,$ConfigSolicitarOD,$ConfigOrtopediaAC,$ConfigDestinosMT,$ConfigDestinosOAC,
           $ConfigExcepcionCMT,$ConfigExpedienteMagdalena,$ConfigExpediente430128,$ConfigDiagnosticosCIE10,
           $ConfigHojaInicialAsistentes,$ConfigHojaInicialAbierta,$ConfigEnfermeriaObsPorTipos;
    
    /*nuevas variables de configuración*/
    public $SiGH_SESSION_USER,$SiGH_SESSION_AREA;
    
    public function __construct() {
        parent::__construct(); 
        error_reporting(1);
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','3096M');
        date_default_timezone_set('America/Mexico_City');
        $this->UMAE_USER=$_SESSION['UMAE_USER'];
        $this->UMAE_AREA=$_SESSION['UMAE_AREA'];
        $this->load->model(array(
            'config/config_mdl'
        ));
        $this->_umConfig();
        
        /*--------------------------------------------------------------------*/
        $this->SiGH_SESSION_USER=$_SESSION['SiGH_USER'];
        $this->SiGH_SESSION_AREA=$_SESSION['SiGH_AREA'];
    }

    public function _umConfig() {
        $sql= $this->config_mdl->sqlGetData('um_config');
        $this->ConfigEnfermeriaHC           =  $sql[0]['config_estatus'];
        $this->ConfigSolicitarOD            =   $sql[1]['config_estatus'];
        $this->ConfigDestinosMT             =   $sql[2]['config_estatus'];
        $this->ConfigDestinosOAC            =   $sql[3]['config_estatus'];
        $this->ConfigExcepcionCMT           =   $sql[4]['config_estatus'];
        $this->ConfigExpedienteMagdalena    =   $sql[5]['config_estatus'];
        $this->ConfigExpediente430128       =   $sql[6]['config_estatus'];
        $this->ConfigDiagnosticosCIE10      =   $sql[7]['config_estatus'];
        
        $this->ConfigHojaInicialAsistentes  =   $sql[8]['config_estatus'];
        $this->ConfigHojaInicialAbierta     =   $sql[9]['config_estatus'];
        $this->ConfigEnfermeriaObsPorTipos     =   $sql[10]['config_estatus'];
        define('CONFIG_AM_HOJAINICIAL', $sql[8]['config_estatus']);
        define("SiGH_ENFERMERIA_HORACERO", $sql[0]['config_estatus']);
        define("SiGH_ENFERMERIA_SOLICITAR_OD", $sql[1]['config_estatus']);
        define('SiGH_OBSERVACION_ENFERMERIA', $sql[10]['config_estatus']);
        define("SiGH_EXCEPCION_CMT", $sql[4]['config_estatus']);
        define("SiGH_ASISTENTESMEDICAS_HI", $sql[8]['config_estatus']);
        define("SiGH_ASISTENTESMEDICAS_ILT", $sql[11]['config_estatus']);
        define("SiGH_ASISTENTESMEDICAS_OMISION", $sql[12]['config_estatus']);
        define("SiGH_VALIDACIONPACIENTE", $sql[13]['config_estatus']);
        define('base_domain', $_SERVER['HTTP_HOST']);
    }
    public function CerrarSesion() {
        $this->config_mdl->sqlUpdate('sigh_hospitales_equipos',array(
            'equipo_acceso_area'=>'',
            'equipo_acceso_fecha'=> date('Y-m-d H:i:s'),
            'equipo_estado'=>'Offline',
            'empleado_id'=> 0
        ),array(
            'equipo_ip'=>$_SERVER['REMOTE_ADDR']
        ));
        $this->config_mdl->sqlUpdate('sigh_empleados',array('empleado_conexion'=> '0'),array(
                'empleado_id'=> $this->UMAE_USER
        ));
        session_destroy();
        session_unset();
        redirect('login');
    }
    public function VerificarSession() {
        if(!isset($_SESSION['UMAE_USER'])){
            redirect(base_url());
        }
    }
    public function setOutput($json) {
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    }  
    public function setOutputV2($json) {
        header('Content-type: application/json');
        echo  json_encode($json,JSON_PRETTY_PRINT);
    }  
    public function upload_image_pt() {
        $url_sav = $_GET['tipo'];
        $dir = 'assets/' .$url_sav . '/';
        $serverdir = $dir;
        $tmp = explode(',', $_POST['data']['data']);
        $imgdata = base64_decode($tmp[1]);
        $extension = strtolower(end(explode('.', $_POST['data']['name'])));
        $filename = substr($_POST['data']['name'], 0, -(strlen($extension) + 1)) . '.' . substr(sha1(time()), 0, 6) . '.' . $extension;
        $handle = fopen($serverdir . $filename, 'w');
        fwrite($handle, $imgdata);
        fclose($handle);
        $response = array(
            "status" => "success",
            "url" => $filename . '?' . time(),
            "filename" => $filename
        );
        if (!empty($_POST['original'])) {
            $tmp = explode(',', $_POST['original']);
            $originaldata = base64_decode($tmp[1]);
            $original = substr($_POST['name'], 0, -(strlen($extension) + 1)) . '.' . substr(sha1(time()), 0, 6) . '.original.' . $extension;

            $handle = fopen($serverdir . $original, 'w');
            fwrite($handle, $originaldata);
            fclose($handle);
            $response['original'] = $original;
        }
        $this->setOutput($response);
    }
    public function uploadImageTmp() {
        $image_dir = 'assets/'.$this->input->get_post('tipo').'/';
        $image_tmp= explode(',', $_POST['data']['data']);
        $image_data= base64_decode($image_tmp[1]);
        $image_extension= end(explode('.', $_POST['data']['name']));
        $image_name= date('YmdHis').'_'. rand().'.'.$image_extension;
        $image_handle= fopen($image_dir.$image_name,'w');
        fwrite($image_handle, $image_data);
        fclose($image_handle);
        $this->setOutput(array(
            "status" => "success",
            "url" => $image_name,
            "filename" => $image_name
        ));
    }
    public function writeImg() {
        $img_name= $this->input->post('img_name').'.'.$this->input->post('img_type');
        $img = str_replace('data:image/'.$this->input->post('img_type').';base64,', '', $this->input->get_post('img_data'));
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents('assets/'.$this->input->get_post('img_url_save').'/'.$img_name, $data);
        $this->setOutput(array('action'=>1,'img_url'=>$img_name));
        
    }
    public function logAccesos($datas){
        if(strtotime(date('H:i'))>=  strtotime('07:00')){
            $turno='Mañana';
            $turno_test='Mañana';
        }if(strtotime(date('H:i'))>=  strtotime('14:00')){
            $turno='Tarde';
            $turno_test='Tarde';
        }if(strtotime(date('H:i')) >=  strtotime('21:00')){ 
            $turno='Noche';
            $turno_test='Noche A';
        }if(strtotime(date('H:i')) >=  strtotime('00:00') && strtotime(date('H:i'))<  strtotime('07:00') ){ 
            $turno='Noche';
            $turno_test='Noche B';
        }
        $this->config_mdl->sqlInsert($this->sigh->tbl('sigh_accesos'),array(
            'acceso_tipo'=>$datas['acceso_tipo'],
            'acceso_fecha'=>  date('Y-m-d'),
            'acceso_hora'=>  date('H:i:s') ,
            'acceso_turno'=>$turno,
            //'acceso_turno_test'=>$turno_test,
            'ingreso_id'=>$datas['ingreso_id'],
            'empleado_id'=>$_SESSION['UMAE_USER'],
            'areas_id'=>$datas['areas_id']
        ));
    }
    public function ObtenerTurno(){
        if(strtotime(date('H:i'))>=  strtotime('07:00') && strtotime(date('H:i'))< strtotime('13:59')){
            return 'Mañana';
        }if(strtotime(date('H:i'))>=  strtotime('14:00') && strtotime(date('H:i'))< strtotime('20:59')){
            return 'Tarde';
        }if(strtotime(date('H:i')) >=  strtotime('21:00') && strtotime(date('H:i')) <  strtotime('23:59')){ 
            return 'Noche A';
        }if(strtotime(date('H:i')) >=  strtotime('00:00') && strtotime(date('H:i')) <  strtotime('06:59')){ 
            return 'Noche B';
        }
    }
    public function ObtenerTurnoReportes(){
        if(strtotime(date('H:i'))>=  strtotime('07:00') && strtotime(date('H:i'))< strtotime('13:59')){
            return 'Mañana';
        }if(strtotime(date('H:i'))>=  strtotime('14:00') && strtotime(date('H:i'))< strtotime('20:59')){
            return 'Tarde';
        }if(strtotime(date('H:i')) >=  strtotime('21:00') && strtotime(date('H:i')) <  strtotime('23:59')){ 
            return 'Noche';
        }
    }
    public function TiempoTranscurridoResult($data) {
        $Tiempo1=new DateTime($data['fecha1']);
        $Tiempo2=new DateTime($data['fecha2']);
        $diff=$Tiempo1->diff($Tiempo2);
        return $diff->h*60 + $diff->i; 
    }
    public function TiempoTranscurrido($data) {
        $Tiempo1=new DateTime(str_replace('/', '-', $data['Tiempo1_fecha']).' '.$data['Tiempo1_hora']);
        $Tiempo2=new DateTime(str_replace('/', '-', $data['Tiempo2_fecha']).' '. $data['Tiempo2_hora']);
        $diff=$Tiempo1->diff($Tiempo2);
        return $diff->h*60 + $diff->i; 
    }
    public function CalcularTiempoTranscurrido($data) {
        $Tiempo1=new DateTime($data['Tiempo1']);
        $Tiempo2=new DateTime($data['Tiempo2']);
        return $Tiempo1->diff($Tiempo2);
    }
    public function ColorClasificacion($data) {
        switch ($data['color']){
            case 'Rojo':
                return 'bg-red';
            case 'Naranja':
                return 'orange';
            case  'Amarillo':
                return 'yellow-A700';
            case 'Verde':
                return 'bg-green';
            case 'Azul':
                return 'bg-blue';
        }
    }
    public function ColorClasificacionBorder($data) {
        switch ($data['color']){
            case 'Rojo':
                return '#F44336';
            case 'Naranja':
                return '#FF9800';
            case  'Amarillo':
                return '#FFC107';
            case 'Verde':
                return '#4CAF50';
            case 'Azul':
                return '#3F51B5';
        }
    }
    public function CalcularEdad_($fechanac) {
        $fecha_hac=  new DateTime(str_replace('/', '-', $fechanac));
        $hoy=  new DateTime(date('d-m-Y')); 
        return $hoy->diff($fecha_hac); 
    }
    public function ModCalcularEdad($data) {
        $fecha_hac=  new DateTime(str_replace('/', '-', $data['fecha']));
        $hoy=  new DateTime(date('d-m-Y')); 
        return $hoy->diff($fecha_hac); 
    }
    public function ExpiredSession() {
        if(isset($_SESSION['UMAE_USER'])){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function EgresoCamas($data) { 
        $this->config_mdl->_insert('os_camas_egresos',array(
            'cama_egreso_f'=> date('d/m/Y'),
            'cama_egreso_h'=> date('H:i'),
            'cama_egreso_cama'=>$data['cama_egreso_cama'],
            'cama_egreso_tipo'=>'Egreso',
            'cama_egreso_modulo'=> $this->UMAE_AREA,
            'cama_egreso_destino'=>$data['cama_egreso_destino'],
            'cama_egreso_table'=>$data['cama_egreso_table'],
            'cama_egreso_table_id'=>$data['cama_egreso_table_id'],
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=> $data['triage_id']
        ));
    }
    public function postCurl($url,$parametros) {
        // abrimos la sesión cURL
        $ch = curl_init();
        // definimos la URL a la que hacemos la petición
        curl_setopt($ch, CURLOPT_URL,$url);
        // indicamos el tipo de petición: POST
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // definimos cada uno de los parámetros
        foreach($parametros as $key=>$value) { 
            $fields_string .= $key.'='.$value.'&'; 
        }
        rtrim($fields_string, '&');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        // recibimos la respuesta y la guardamos en una variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        // cerramos la sesión cURL
        curl_close ($response);
        // hacemos lo que queramos con los datos recibidos
        // por ejemplo, los mostramos
        $json= json_decode($response);
        return $json;
    }
    public function getBgClasification($color) {
        if($color=='Rojo'){
            return 'bg-red';
        }if($color=='Naranja'){
            return 'bg-orange';
        }if($color=='Amarillo'){
            return 'bg-yellow';
        }if($color=='Verde'){
            return 'bg-green';
        }if($color=='Azul'){
            return 'bg-blue';
        }
    }
    public function getTimeElapsed($data) {
        $Tiempo1=new DateTime($data['Time1']);
        $Tiempo2=new DateTime($data['Time2']);
        return $Tiempo1->diff($Tiempo2);
    }
}
