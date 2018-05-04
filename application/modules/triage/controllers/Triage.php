<?php
/**
 * Description of Triage
 *
 * @author felipe de jesus | itifjpp@gmail.com 
 */
include_once APPPATH.'modules/config/controllers/Config.php';
require_once APPPATH.'third_party/nusoap095/lib/nusoap.php';
class Triage extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function Enfermeriatriage() {
        $this->load->view('Enfermeriatrige/index');
    }
    public function Medicotriage() {
        $this->load->view('Medicotriage/index');
    }
    public function Paciente($paciente) {
        
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'sv_tipo'=>'Triage',
            'ingreso_id'=>$paciente
        ))[0];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,pac.paciente_rfc,
                                                    ing.ingreso_validar_indentificador,ing.ingreso_pv,ing.ingreso_folio_simef,
                                                    ing.ingreso_date_horacero,ing.ingreso_time_horacero, pac.paciente_sexo,pac.paciente_derechohabiente, info.info_indicio_embarazo, info.info_procedencia_esp,
                                                    info.info_procedencia_esp_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$paciente)[0];
        if($this->UMAE_AREA=='Enfermeria Triage' || $_GET['via']=='Paciente'){
            
            $this->load->view('Enfermeriatrige/paciente',$sql);
        }else{
            $this->load->view('Medicotriage/paciente',$sql);
        }
    }
    /*Guardar datos*/
    public function EnfemeriatriageGuardar() {
        $paciente=array(
            'paciente_nombre'=> $this->input->post('paciente_nombre'),
            'paciente_ap'=> $this->input->post('paciente_ap'),
            'paciente_am'=> $this->input->post('paciente_am'),
            'paciente_fn'=> $this->input->post('paciente_fn'),
            'paciente_derechohabiente'=> $this->input->post('paciente_derechohabiente'),
            'paciente_sexo'=> $this->input->post('paciente_sexo') ,
            'paciente_tmp'=> $this->input->post('ingreso_id'),
            'paciente_rfc'=> $this->input->post('paciente_rfc')
        );
        if($this->input->post('paciente_id')==''){
            $SQL=$this->config_mdl->sqlGetDataCondition('sigh_pacientes',array(
                'paciente_tmp'=> $this->input->post('ingreso_id')
            ));
            $paciente_id=$this->input->post('ingreso_id');
        }else{
            $SQL=$this->config_mdl->sqlGetDataCondition('sigh_pacientes',array(
                'paciente_id'=> $this->input->post('paciente_id')
            ));
            $paciente_id=$this->input->post('paciente_id');
        }
        if(empty($SQL)){
            $this->config_mdl->sqlInsert('sigh_pacientes',$paciente);
            $LastPac= $this->config_mdl->sqlGetLastId('sigh_pacientes','paciente_id');
            $this->config_mdl->sqlInsert('sigh_pacientes_directorios',array(
                'directorio_tipo'=>'Paciente',
                'ingreso_id'=>$this->input->post('ingreso_id'),
                'paciente_id'=>$LastPac,
            ));
        }else{
            $this->config_mdl->sqlUpdate('sigh_pacientes',$paciente,array(
                'paciente_id'=> $this->input->post('paciente_id')
            ));
            $LastPac=$this->input->post('paciente_id');
        }
        $data=array(
            'ingreso_en'=> 'Enfermería Triage',
            'ingreso_en_status'=>'Ingreso',
            'ingreso_viaregistro'=>'Hora Cero',
            'ingreso_date_enfermera'=> date('Y-m-d'),
            'ingreso_time_enfermera'=> date('H:i:s'),
            'ingreso_enfermera_id'=> $this->UMAE_USER,
            'ingreso_validar_indentificador'=> $this->input->post('ingreso_validar_indentificador'),
            'ingreso_folio_simef'=> $this->input->post('ingreso_folio_simef'),
            'paciente_id'=>$LastPac
        );
        
        $this->SignosVitales(array(
            'sv_sistolica'=> $this->input->post('sv_sistolica'),
            'sv_diastolica'=> $this->input->post('sv_diastolica'),
            'sv_ta'=> $this->input->post('sv_ta'),
            'sv_temp'=> $this->input->post('sv_temp'),
            'sv_fc'=> $this->input->post('sv_fc'),
            'sv_fr'=> $this->input->post('sv_fr'),
            'sv_oximetria'=> $this->input->post('sv_oximetria'),
            'sv_dextrostix'=> $this->input->post('sv_dextrostix'),
            'sv_glicemia'=> $this->input->post('sv_glicemia'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $info=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ),'ingreso_date_enfermera')[0];
        if($info['ingreso_date_enfermera']!=''){ 
            unset($data['ingreso_date_enfermera']);
            unset($data['ingreso_time_enfermera']);
            unset($data['ingreso_enfermera_id']);
            unset($data['ingreso_en']);
            unset($data['ingreso_en_status']);
        }else{
            $this->logAccesos(array('acceso_tipo'=>'Triage Enfermería','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=> 0));
        }
        $this->config_mdl->sqlUpdate('sigh_pacientes_info_ing',array(
            'info_indicio_embarazo'=>$this->input->post('info_indicio_embarazo'),
            'info_procedencia_esp'=>$this->input->post('info_procedencia_esp'),
            'info_procedencia_esp_lugar'=>$this->input->post('info_procedencia_esp_lugar'),
            'info_procedencia_hospital'=>$this->input->post('info_procedencia_hospital'),
            'info_procedencia_hospital_num'=>$this->input->post('info_procedencia_hospital_num')
        ),array(
            'ingreso_id'=>$this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_pacientes_log',array(
            'log_fecha'=> date('Y-m-d H:i:s'),
            'log_paciente'=> $this->input->post('paciente_ap').' '.$this->input->post('paciente_am').' '.$this->input->post('paciente_nombre'),
            'log_paciente_nss'=>'NO APLICA',
            'log_area'=> $this->UMAE_AREA,
            'empleado_id'=>$this->UMAE_USER,
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',$data,array(
            'ingreso_id'=>  $this->input->post('ingreso_id'
        )));
        $this->setOutput(array('accion'=>'1'));
        
    }
    public function AjaxReclasificar() {
        $this->config_mdl->sqlDelete('sigh_pacientes_clasificacion_ing',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlDelete('sigh_consultorios_lista_espera',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    
    public function AjaxCalcularEdad() {
        $this->setOutput(array(
            'Anio'=> $this->CalcularEdad_($this->input->post('triage_fecha_nac'))->y,
            'Mes'=> $this->CalcularEdad_($this->input->post('triage_fecha_nac'))->m,
            'Dia'=> $this->CalcularEdad_($this->input->post('triage_fecha_nac'))->d,
        ));
    }
    public function AjaxClasificacionChoque() {
        $data=array(
            'ingreso_en'=> 'Médico Triage',
            'ingreso_en_status'=>'Ingreso',
            'ingreso_date_medico'=>  date('Y-m-d'),
            'ingreso_time_medico'=>  date('H:i:s'),
            'ingreso_clasificacion'=> $this->input->post('clasificacionColor'),
            'ingreso_destino_triage'=> 'Choque',
            'ingreso_consultorio'=>  'No Aplica',
            'ingreso_consultorio_nombre'=>  'No Aplica',
            'ingreso_medico_id'=> $this->UMAE_USER,
            'ingreso_acceder'=>'No Validado',
            'ingreso_pv'=>'',
            'ingreso_vigenciaacceder'=>'',
            'paciente_id'=> $this->input->post('paciente_id')
        );   
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',$data,array('ingreso_id'=>  $this->input->post('ingreso_id')));
        $sqlCheckClasificacion= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_clasificacion_ing',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(empty($sqlCheckClasificacion)){
            $this->config_mdl->sqlInsert('sigh_pacientes_clasificacion_ing',array(
                'clasificacion_omision'=>'Si',
                'clasificacion_preg1_s1'=>  '',
                'clasificacion_preg2_s1'=>  '',
                'clasificacion_preg3_s1'=>  '',
                'clasificacion_preg4_s1'=>  '',
                'clasificacion_preg5_s1'=>  '',
                'clasificacion_preg_puntaje_s1'=> '',
                'clasificacion_preg1_s2'=>  '',
                'clasificacion_preg2_s2'=>  '',
                'clasificacion_preg3_s2'=>  '',
                'clasificacion_preg4_s2'=>  '',
                'clasificacion_preg5_s2'=>  '',
                'clasificacion_preg6_s2'=>  '',
                'clasificacion_preg7_s2'=>  '',
                'clasificacion_preg8_s2'=>  '',
                'clasificacion_preg9_s2'=>  '',
                'clasificacion_preg10_s2'=>  '',
                'clasificacion_preg11_s2'=>  '',
                'clasificacion_preg12_s2'=>  '',
                'clasificacion_preg_puntaje_s2'=>'',
                'clasificacion_preg1_s3'=>  '',
                'clasificacion_preg2_s3'=>  '',
                'clasificacion_preg3_s3'=>  '',
                'clasificacion_preg4_s3'=>  '',
                'clasificacion_preg5_s3'=>  '',
                'clasificacion_preg_puntaje_s3'=>'',
                'clasificacion_puntaje_total'=>'',
                'clasificacion_color'=>$this->input->post('clasificacionColor'),
                'clasificacion_observacion'=> 'Envio a Choque',
                'clasificacion_notas'=> 'Envio a Choque',
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
        }
        $this->logAccesos(array('acceso_tipo'=>'Triage Médico','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=> 0));
        $this->setOutput(array('accion'=>'1','ingreso_id'=>  $this->input->post('ingreso_id') ));
    }
    public function GuardarClasificacion() {
        if($this->input->post('clasificacion_omision')=='No'){
            $clas_preg_puntaje_s1=$this->input->post('clasificacion_preg1_s1')+
                                    $this->input->post('clasificacion_preg2_s1')+
                                    $this->input->post('clasificacion_preg3_s1')+
                                    $this->input->post('clasificacion_preg4_s1')+
                                    $this->input->post('clasificacion_preg5_s1');
            $clas_preg_puntaje_s2=$this->input->post('clasificacion_preg1_s2')+
                                    $this->input->post('clasificacion_preg2_s2')+
                                    $this->input->post('clasificacion_preg3_s2')+
                                    $this->input->post('clasificacion_preg4_s2')+
                                    $this->input->post('clasificacion_preg5_s2')+
                                    $this->input->post('clasificacion_preg6_s2')+
                                    $this->input->post('clasificacion_preg7_s2')+
                                    $this->input->post('clasificacion_preg8_s2')+
                                    $this->input->post('clasificacion_preg9_s2')+
                                    $this->input->post('clasificacion_preg10_s2')+
                                    $this->input->post('clasificacion_preg11_s2')+ 
                                    $this->input->post('clasificacion_preg12_s2');

            $clas_preg_puntaje_s3=$this->input->post('clasificacion_preg1_s3')+
                                    $this->input->post('clasificacion_preg2_s3')+
                                    $this->input->post('clasificacion_preg3_s3')+
                                    $this->input->post('clasificacion_preg4_s3')+
                                    $this->input->post('clasificacion_preg5_s3');
            $total_puntos=$clas_preg_puntaje_s1+$clas_preg_puntaje_s2+$clas_preg_puntaje_s3;
            if($total_puntos>30){
                $color_name='Rojo';
            }if($total_puntos>=21 && $total_puntos<=30){
                $color_name='Naranja';
            }if($total_puntos>=11 && $total_puntos<=20){
                $color_name='Amarillo';
            }if($total_puntos>=6 && $total_puntos<=10){
                $color_name='Verde';
            }if($total_puntos<=5){
                $color_name='Azul';
            }    
            $data_clasificacion=array(
                'clasificacion_omision'=>'No',
                'clasificacion_preg1_s1'=>  $this->input->post('clasificacion_preg1_s1'),
                'clasificacion_preg2_s1'=>  $this->input->post('clasificacion_preg2_s1'),
                'clasificacion_preg3_s1'=>  $this->input->post('clasificacion_preg3_s1'),
                'clasificacion_preg4_s1'=>  $this->input->post('clasificacion_preg4_s1'),
                'clasificacion_preg5_s1'=>  $this->input->post('clasificacion_preg5_s1'),
                'clasificacion_preg_puntaje_s1'=> $clas_preg_puntaje_s1,
                'clasificacion_preg1_s2'=>  $this->input->post('clasificacion_preg1_s2'),
                'clasificacion_preg2_s2'=>  $this->input->post('clasificacion_preg2_s2'),
                'clasificacion_preg3_s2'=>  $this->input->post('clasificacion_preg3_s2'),
                'clasificacion_preg4_s2'=>  $this->input->post('clasificacion_preg4_s2'),
                'clasificacion_preg5_s2'=>  $this->input->post('clasificacion_preg5_s2'),
                'clasificacion_preg6_s2'=>  $this->input->post('clasificacion_preg6_s2'),
                'clasificacion_preg7_s2'=>  $this->input->post('clasificacion_preg7_s2'),
                'clasificacion_preg8_s2'=>  $this->input->post('clasificacion_preg8_s2'),
                'clasificacion_preg9_s2'=>  $this->input->post('clasificacion_preg9_s2'),
                'clasificacion_preg10_s2'=>  $this->input->post('clasificacion_preg10_s2'),
                'clasificacion_preg11_s2'=>  $this->input->post('clasificacion_preg11_s2'),
                'clasificacion_preg12_s2'=>  $this->input->post('clasificacion_preg12_s2'),
                'clasificacion_preg_puntaje_s2'=>$clas_preg_puntaje_s2,
                'clasificacion_preg1_s3'=>  $this->input->post('clasificacion_preg1_s3'),
                'clasificacion_preg2_s3'=>  $this->input->post('clasificacion_preg2_s3'),
                'clasificacion_preg3_s3'=>  $this->input->post('clasificacion_preg3_s3'),
                'clasificacion_preg4_s3'=>  $this->input->post('clasificacion_preg4_s3'),
                'clasificacion_preg5_s3'=>  $this->input->post('clasificacion_preg5_s3'),
                'clasificacion_preg_puntaje_s3'=>$clas_preg_puntaje_s3,
                'clasificacion_puntaje_total'=>$total_puntos,
                'clasificacion_color'=>$color_name,
                'clasificacion_observacion'=> $this->input->post('clasificacionObservacion'),
                'clasificacion_notas'=> $this->input->post('clasificacion_notas'),
                'ingreso_id'=> $this->input->post('ingreso_id')
            );
        }else{
            $color_name= $this->input->post('clasificacionColor');
            $data_clasificacion=array(
                'clasificacion_omision'=>'Si',
                'clasificacion_color'=>$color_name,
                'clasificacion_observacion'=> $this->input->post('clasificacionObservacion'),
                'clasificacion_notas'=> $this->input->post('clasificacion_notas'),
                'ingreso_id'=> $this->input->post('ingreso_id'), 
            );
        }
        $paciente_id= $this->input->post('paciente_id');
        $data=array(
            'ingreso_en'=> 'Médico Triage',
            'ingreso_en_status'=>'Ingreso',
            'ingreso_date_medico'=>  date('Y-m-d'),
            'ingreso_time_medico'=>  date('H:i:s'),
            'ingreso_clasificacion'=>$color_name,
            'ingreso_destino_triage'=> $this->input->post('ingreso_destino_triage'),
            'ingreso_consultorio'=>  $this->input->post('ingreso_consultorio'),
            'ingreso_consultorio_nombre'=>  $this->input->post('ingreso_consultorio_nombre'),
            'ingreso_medico_id'=> $this->UMAE_USER,
            'ingreso_acceder'=>'No Validado',
            'ingreso_pv'=>'',
            'ingreso_vigenciaacceder'=>'',
            'paciente_id'=> $paciente_id
         );   
        if($this->input->post('ingreso_destino_triage')=='Consultorios'){
            $sqlCheckListaEspera= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
            if(empty($sqlCheckListaEspera)){
                $this->config_mdl->sqlInsert('sigh_consultorios_lista_espera',array(
                    'lista_espera_date_envio'=> date('Y-m-d'),
                    'lista_espera_time_envio'=> date('H:i:s'),
                    'lista_espera_date'=>'', 
                    'lista_espera_time'=>'',
                    'lista_espera_eventos'=>0,
                    'lista_espera_estado'=>'En Espera',
                    'lista_espera_estatus'=>'',
                    'lista_espera_consultorio'=>'',
                    'ingreso_id'=> $this->input->post('ingreso_id'),
                    'empleado_id'=>''
                )); 
            }
               
        }
        
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',$data,array('ingreso_id'=>  $this->input->post('ingreso_id')));
        $sqlCheckClasificacion= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_clasificacion_ing',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(empty($sqlCheckClasificacion)){
            $this->config_mdl->sqlInsert('sigh_pacientes_clasificacion_ing',$data_clasificacion);
        }
        $this->logAccesos(array('acceso_tipo'=>'Triage Médico','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=> 0));
        $this->setOutput(array('accion'=>'1','ingreso_id'=>  $this->input->post('ingreso_id') ));
    }
    public function Indicador() {
        if($this->UMAE_AREA=='Enfermeria Triage'){
            $this->load->view('Enfermeriatrige/indicador');
        }else{
            $this->load->view('Medicotriage/indicador');
        }
    }
    public function AjaxIndicador() {
        $inputFecha= $this->input->post('inputFecha');
        $inputUser=$_SESSION['UMAE_USER'];
        if($this->UMAE_AREA=='Enfermeria Triage'){
            $ConditionCre='ingreso_enfermera_id';
            $ConditionDate='ingreso_date_enfermera';
            $ConditionTime='ingreso_time_enfermera';
        }else{
            $ConditionCre='ingreso_medico_id';
            $ConditionDate='ingreso_date_medico';
            $ConditionTime='ingreso_time_medico';
        }

        if($this->input->post('inputTurno')=='Mañana'){
            $sql=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate='$inputFecha' AND ing.$ConditionTime BETWEEN '07:00:00' AND '13:59:59'");
            $sql2=NULL;
        }if($this->input->post('inputTurno')=='Tarde'){
            $sql=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate='$inputFecha' AND ing.$ConditionTime BETWEEN '14:00:00' AND '20:59:59'");
            $sql2=NULL;
        }if($this->input->post('inputTurno')=='Noche'){
            $sql=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate='$inputFecha' AND ing.$ConditionTime BETWEEN '21:00:00' AND '23:25:59'");
            
            $sql2=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND ing.$ConditionTime BETWEEN '00:00:00' AND '06:59:59'");
        }
        $this->setOutput(array(
            'TOTAL_INFO_CAP'=> count($sql)+ count($sql2)
        ));
    }
    public function TriagePacienteDirectorio($data) {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'ingreso_id'=>$data['ingreso_id'],
            'directorio_tipo'=>$data['directorio_tipo']
        ));
        $datos=array(
            'directorio_cp'=> $data['directorio_cp'],
            'directorio_cn'=> $data['directorio_cn'],
            'directorio_colonia'=> $data['directorio_colonia'],
            'directorio_municipio'=> $data['directorio_municipio'],
            'directorio_estado'=> $data['directorio_estado'],
            'directorio_telefono'=> $data['directorio_telefono'],
            'directorio_tipo'=>$data['directorio_tipo'],
            'ingreso_id'=>$data['ingreso_id']
        );
        if(empty($sql)){
            $this->config_mdl->sqlInsert('sigh_pacientes_directorios',$datos);
        }else{
            $this->config_mdl->sqlUpdate('sigh_pacientes_directorios',$datos,array(
                'ingreso_id'=>$data['ingreso_id'],
                'directorio_tipo'=>$data['directorio_tipo']
            ));
        }
    }
    public function TriagePacienteEmpresa($data) {
        // <editor-fold defaultstate="collapsed" desc="Datos de la Empresa">
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_empresas',array(
            'ingreso_id'=>$data['ingreso_id']
        ));
        $datos=array(
            'empresa_nombre'=> $data['empresa_nombre'],
            'empresa_modalidad'=> $data['empresa_modalidad'],
            'empresa_rp'=> $data['empresa_rp'],
            'empresa_fum'=> $data['empresa_fum'],
            'empresa_he'=> $data['empresa_he'],
            'empresa_hs'=>$data['empresa_hs'],
            'ingreso_id'=>$data['ingreso_id']
        );
        if(empty($sql)){
            $this->config_mdl->sqlInsert('sigh_pacientes_empresas',$datos);
        }else{
            $this->config_mdl->sqlUpdate('sigh_pacientes_empresas',$datos,array(
                'ingreso_id'=>$data['ingreso_id']
            ));
        }
        // </editor-fold>
    }
    public function SignosVitales($data) {
        // <editor-fold defaultstate="collapsed" desc="Signos Vitales">
        $sqlSv= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'sv_tipo'=>'Triage',
            'ingreso_id'=>$data['ingreso_id']
        ));
        $svData=array(
            'sv_tipo'=>'Triage',
            'sv_fecha'=> date('Y-m-d'),
            'sv_hora'=> date('H:i'),
            'sv_sistolica'=> $this->input->post('sv_sistolica'),
            'sv_diastolica'=> $this->input->post('sv_diastolica'),
            'sv_ta'=>$data['sv_ta'],
            'sv_temp'=>$data['sv_temp'],
            'sv_fc'=>$data['sv_fc'],
            'sv_fr'=>$data['sv_fr'],
            'sv_oximetria'=>$data['sv_oximetria'],
            'sv_dextrostix'=>$data['sv_dextrostix'],
            'sv_glicemia'=>$data['sv_glicemia'],
            'ingreso_id'=>$data['ingreso_id'],
            'empleado_id'=> $this->UMAE_USER
        );
        if(empty($sqlSv)){
            $this->config_mdl->sqlInsert('sigh_pacientes_sv',$svData);
        }else{
            $this->config_mdl->sqlUpdate('sigh_pacientes_sv',$svData,array(
                'sv_tipo'=>'Triage',
                'ingreso_id'=>$data['ingreso_id']
            ));
        }
        // </editor-fold>
    }
    public function LogChangesPatient($data) {

        // </editor-fold>
    }
    public function AjaxObtenerEdad() {
        $fecha= $this->CalcularEdad_($this->input->post('fechaNac'));
        $this->setOutput(array(
            'Anios'=>$fecha->y
        ));
    }    
    public function AjaxGetDestinoPacientes() {
        $destino_paciente= $this->input->post('destino_paciente');
        $option='';
        if($destino_paciente=='Consultorios'){
            $sql= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
                'especialidad_consultorios'=>'Si'
            ));
            foreach ($sql as $value) {
                $option.='<option value="'.$value['especialidad_id'].';'.$value['especialidad_nombre'].'">'.$value['especialidad_nombre'].'</option>';
            }
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxValidarRfcExistence() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes',array(
            'paciente_rfc'=> $this->input->post('paciente_rfc')
        ));
        if(!empty($sql)){
            $this->setOutput(array('action'=>'EXISTENCE','info'=>$sql[0]));
        }else{
            $this->setOutput(array('action'=>'NO EXISTENCE'));
        }
    }
}
