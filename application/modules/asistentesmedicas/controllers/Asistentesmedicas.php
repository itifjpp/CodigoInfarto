<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asistentesmedicas
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Asistentesmedicas extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('index');   
    }    
    public function AjaxAsistentesmedicasAcceder() {
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_pacientes',array(
            'paciente_nss'=> $this->input->post('paciente_nss'),
            'paciente_nss_agregado'=> $this->input->post('paciente_nss_agregado'),
        ));
        if(!empty($sqlCheck)){
            $this->config_mdl->sqlDelete('sigh_pacientes',array(
                'paciente_id'=> $this->input->post('paciente_id')
            ));
            $paciente_id=$sqlCheck[0]['paciente_id'];
        }else{
            $paciente_id= $this->input->post('paciente_id');
        }
        $this->config_mdl->sqlUpdate('sigh_pacientes',array(
            'paciente_nombre'=> $this->input->post('paciente_nombre'),
            'paciente_ap'=> $this->input->post('paciente_ap'),
            'paciente_am'=> $this->input->post('paciente_am'),
            'paciente_nss'=> $this->input->post('paciente_nss'),
            'paciente_nss_agregado'=> $this->input->post('paciente_nss_agregado'),
            'paciente_vigenciaacceder'=> $this->input->post('paciente_vigenciaacceder'),
            'paciente_curp'=> $this->input->post('paciente_curp'),
            'paciente_fn'=> $this->input->post('paciente_fn'),
            'paciente_sexo'=> $this->input->post('paciente_sexo'),
        ),array(
           'paciente_id'=> $paciente_id
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_info_ing',array(
            'info_umf'=> $this->input->post('info_umf'),
            'info_delegacion'=> $this->input->post('info_delegacion')
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'paciente_id'=>$paciente_id,
            'ingreso_acceder'=> 'Si Validado'
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxPaciente() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ),'ingreso_id,ingreso_date_medico,ingreso_acceder,paciente_id');
        if(!empty($sql)){
            $info= $this->config_mdl->sqlGetDataCondition('sigh_asistentesmedicas',array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ),'asistentesmedicas_id');
            if(empty($info)){
                $this->config_mdl->sqlInsert('sigh_asistentesmedicas',array('ingreso_id'=> $this->input->post('ingreso_id')));
            }
            if($sql[0]['ingreso_date_medico']!=''){
                if($sql[0]['ingreso_acceder']=='Si Validado'){
                    $this->setOutput(array('action'=>1,'acceder'=>'Si','paciente_id'=>$sql[0]['paciente_id']));
                }else{
                    $this->setOutput(array('action'=>1,'acceder'=>'No','paciente_id'=>$sql[0]['paciente_id']));
                }
            }else{
                $this->setOutput(array('action'=>2));
            }
        }else{
            $this->setOutput(array('action'=>3));
        }
    }
    public function Paciente($Paciente) {
        $sql['MedicosTratantes']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados AS em WHERE em.empleado_categoria='MEDICO NO FAMILIAR 80'");
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_destino_triage,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_date_am,ing.ingreso_time_am,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                    pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp,
                                                    pac.paciente_rfc,pac.paciente_estadocivil,pac.paciente_umf,pac.paciente_delegacion, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                                    info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                                    ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,
                                                    ing.ingreso_valida_nss 
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['empleado']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_id'=> $this->UMAE_USER
        ),'empleado_nombre,empleado_ap,empleado_am');
        
        $sql['DirPaciente']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'paciente_id'=>  $sql['info']['paciente_id'],
            'directorio_tipo'=>'Paciente'
        ))[0];
        $sql['DirEmpresa']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'ingreso_id'=>  $Paciente,
            'directorio_tipo'=>'Empresa'
        ))[0];
        $sql['Empresa']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_empresas',array(
           'ingreso_id'=>  $Paciente,
        ))[0];
        $this->load->view('paciente',$sql);
    }
    public function AjaxValidaNss() {
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_pacientes',array(
            'paciente_nss'=> $this->input->post('paciente_nss'),
            'paciente_nss_agregado'=> $this->input->post('paciente_nss_agregado')
        ));
        if(!empty($sqlCheck) ){
            $this->config_mdl->sqlDelete('sigh_pacientes',array(
                'paciente_id'=> $this->input->post('paciente_id')
            ));
            $paciente_id=$sqlCheck[0]['paciente_id'];
            $ingreso_pv='Subsecuente';
            $accion=1;
            
        }else{
            $ingreso_pv='Primera vez';
            $paciente_id=$this->input->post('paciente_id');
            $accion=2;
            
        }
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_acceder'=>'No Validado',
            'ingreso_valida_nss'=>'Si',
            'ingreso_pv'=>$ingreso_pv,
            'paciente_id'=>$paciente_id
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Paciente',
            'paciente_id'=>$paciente_id,
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('accion'=>$accion));
    }
    public function AjaxGuardar() {
        $paciente=array(
            'paciente_nombre'=> $this->input->post('paciente_nombre'),
            'paciente_am'=> $this->input->post('paciente_ap'),
            'paciente_ap'=> $this->input->post('paciente_am'),
            'paciente_fn'=> $this->input->post('paciente_fn'),
            'paciente_sexo'=> $this->input->post('paciente_sexo'),
            'paciente_curp'=> $this->input->post('paciente_curp'),
            'paciente_estadocivil'=> $this->input->post('paciente_estadocivil'),
            'paciente_nss'=> $this->input->post('paciente_nss'),
            'paciente_nss_agregado'=> $this->input->post('paciente_nss_agregado'),
            'paciente_umf'=> $this->input->post('paciente_umf'),
            'paciente_delegacion'=> $this->input->post('paciente_delegacion')
        );
        if($this->input->post('ingreso_date_am')==''){
//            $sqlCheckConsultorio= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
//                'ingreso_id'=> $this->input->post('ingreso_id')
//            ))[0];
//            if($sqlCheckConsultorio['ingreso_destino_triage']=='Consultorios'){
//                $this->config_mdl->sqlInsert('sigh_consultorios_lista_espera',array(
//                    'lista_espera_envio'=> date('Y-m-d H:i'),
//                    'lista_espera_fecha'=>'',
//                    'lista_espera_eventos'=>0,
//                    'lista_espera_estado'=>'En Espera',
//                    'lista_espera_estatus'=>'',
//                    'lista_espera_consultorio'=>'',
//                    'ingreso_id'=> $this->input->post('ingreso_id'),
//                    'empleado_id'=>''
//                ));    
//            }
            
            $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                'ingreso_date_am'=> date('Y-m-d'),
                'ingreso_time_am'=> date('H:i:s'),
                'ingreso_en'=> 'Asistentes Médicas',
                'ingreso_en_status'=>'Egreso',
                'ingreso_am_id'=> $this->UMAE_USER,
                'ingreso_valida_nss'=> $this->input->post('ingreso_valida_nss'),
                'ingreso_pv'=> $this->input->post('ingreso_pv'),
                'paciente_id'=>$this->input->post('paciente_id')
            ),array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
            if($this->input->post('info_lugar_accidente')=='TRABAJO'){
                Modules::run('Asistentesmedicas/DOC_ST7_FOLIO',array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
            }
            if($this->input->post('ingreso_consultorio_nombre')=='Observación'){
                $this->config_mdl->sqlInsert('sigh_doc43021',array(
                    'doc_fecha'=> date('Y-m-d'),
                    'doc_hora'=> date('H:i:s'),
                    'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                    'doc_destino'=>$this->input->post('ingreso_consultorio_nombre'),
                    'doc_tipo'=>'Ingreso',
                    'empleado_id'=> $this->UMAE_USER,
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
            }else{
                $this->config_mdl->sqlInsert('sigh_doc43029',array(
                    'doc_fecha'=> date('Y-m-d'),
                    'doc_hora'=> date('H:i:s'),
                    'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                    'doc_destino'=> $this->input->post('triage_consultorio_nombre'),
                    'doc_tipo'=>'Ingreso',
                    'empleado_id'=> $this->UMAE_USER,
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
            }
            $this->config_mdl->sqlUpdate('sigh_asistentesmedicas',array(
                'asistentesmedicas_fecha'=> date('Y-m-d'),
                'asistentesmedicas_hora'=> date('H:i'), 
            ),array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
            $this->logAccesos(array('acceso_tipo'=>'Asistente Médica','ingreso_id'=>$this->input->post('ingreso'),'areas_id'=>0));
        }
        $this->config_mdl->sqlUpdate('sigh_pacientes',$paciente,array(
            'paciente_id'=> $this->input->post('paciente_id')
        ));
        
        $this->config_mdl->sqlInsert('sigh_pacientes_log',array(
            'log_fecha'=> date('Y-m-d H:i:s'),
            'log_paciente'=> $this->input->post('paciente_ap').' '.$this->input->post('paciente_am').' '.$this->input->post('paciente_nombre'),
            'log_paciente_nss'=> $this->input->post('paciente_nss').' '.$this->input->post('paciente_nss_agregado'),
            'log_area'=> $this->UMAE_AREA,
            'empleado_id'=>$this->UMAE_USER,
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_info_ing',array(
            'info_umf'=>$this->input->post('paciente_umf'),
            'info_delegacion'=>$this->input->post('paciente_delegacion'),
            'info_lugar_accidente'=>$this->input->post('info_lugar_accidente'),
            'info_lugar_procedencia'=>$this->input->post('info_lugar_procedencia'),
            'info_dia_pa'=>$this->input->post('info_dia_pa'),
            'info_fecha_accidente'=>$this->input->post('info_fecha_accidente'),
            'info_hora_accidente'=>$this->input->post('info_hora_accidente'),
            'info_identificacion'=>$this->input->post('info_identificacion'),
            'info_responsable_nombre'=>$this->input->post('info_responsable_nombre'),
            'info_responsable_parentesco'=>$this->input->post('info_responsable_parentesco'),
            'info_responsable_telefono'=>$this->input->post('info_responsable_telefono'),
            'info_mt'=> $this->input->post('info_mt'), 
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        
        $sqlDirPaciente= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'paciente_id'=> $this->input->post('paciente_id'),
            'directorio_tipo'=>'Paciente',
        ),'directorio_id');
        $dataDirPaciente=array(
            'directorio_tipo'=>'Paciente',
            'directorio_cp'=> $this->input->post('directorio_cp'),
            'directorio_cn'=> $this->input->post('directorio_cn'),
            'directorio_colonia'=> $this->input->post('directorio_colonia'),
            'directorio_municipio'=> $this->input->post('directorio_municipio'),
            'directorio_estado'=> $this->input->post('directorio_estado'),
            'directorio_telefono'=> $this->input->post('directorio_telefono'),
            'paciente_id'=> $this->input->post('paciente_id'),
            'ingreso_id'=>$this->input->post('ingreso_id')
        );
        if(empty($sqlDirPaciente)){
            $this->config_mdl->sqlInsert('sigh_pacientes_directorios',$dataDirPaciente);
        }else{
            $this->config_mdl->sqlUpdate('sigh_pacientes_directorios',$dataDirPaciente,array(
                'paciente_id'=> $this->input->post('paciente_id'),
                'directorio_tipo'=>'Paciente',
            ));
        }
        if($this->input->post('directorio_cp_2')!=''){
            Modules::run('Triage/TriagePacienteDirectorio',array(
                'directorio_tipo'=>'Empresa',
                'directorio_cp'=> $this->input->post('directorio_cp_2'),
                'directorio_cn'=> $this->input->post('directorio_cn_2'),
                'directorio_colonia'=> $this->input->post('directorio_colonia_2'),
                'directorio_municipio'=> $this->input->post('directorio_municipio_2'),
                'directorio_estado'=> $this->input->post('directorio_estado_2'),
                'directorio_telefono'=> $this->input->post('directorio_telefono_2'),
                'ingreso_id'=>$this->input->post('ingreso_id')
            ));
            Modules::run('Triage/TriagePacienteEmpresa',array(
                'empresa_nombre'=> $this->input->post('empresa_nombre'),
                'empresa_modalidad'=> $this->input->post('empresa_modalidad'),
                'empresa_rp'=> $this->input->post('empresa_rp'),
                'empresa_fum'=> $this->input->post('empresa_fum'),
                'empresa_tel'=> $this->input->post('empresa_tel'),
                'empresa_he'=> $this->input->post('empresa_he'),
                'empresa_hs'=>$this->input->post('empresa_hs'),
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));   
        } 
        $this->setOutput(array('accion'=>'1'));        
        
    }
    public function DOC_ST7_FOLIO($info) {
        $this->config_mdl->_insert('sigh_st7_folio',array(
            'st7_folio_fecha'=> date('Y-m-d'),
            'st7_folio_hora'=> date('H:i'),
            'ingreso_id'=>$info['ingreso_id'],
            'empleado_id'=> $this->UMAE_USER
        ));
    }
    public function BuscarCodigoPostal() {
       $sql=  $this->config_mdl->_get_data_condition('os_codigospostales',array('CodigoPostal'=>  $this->input->post('cp'))) ;
       $this->setOutput(array('result_cp'=>$sql[0]));
    }
    public function Egresos() {
        $this->load->view('Egresos');  
    }
    public function AjaxEgresoPaciente() {
        $sql_check= $this->config_mdl->_get_data_condition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if($sql_check[0]['ingreso_egreso_date']==''){
            $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                'ingreso_egreso_date'=> date('Y-m-d'),
                'ingreso_egreso_time'=> date('H:i:s'),
                'ingreso_egreso_motivo'=> $this->input->post('ingreso_egreso_motivo'),
                'ingreso_egreso_id'=> $this->UMAE_USER
            ),array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
            $this->logAccesos(array('acceso_tipo'=>'Egreso Paciente de la Unidad Médica','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
            $this->setOutput(array('action'=>'1'));
        }else{
            $this->setOutput(array('action'=>'2'));
        }
    }
    public function Indicadores() {
        $this->load->view("Indicadores");
    }
    public function AjaxIndicadorST7() {
        $inputFecha= $this->input->post('inputFecha');
        $inputTurno= $this->input->post('inputTurno');
        $Total=0;
        if($this->input->post('inputTipo')=='Iniciadas'){
            $Tipo="";
        }else{
            $Tipo="am.asistentesmedicas_omitir='No' AND ";
        }
        if($inputTurno=='Mañana'){
            $inputHora1='07:00';
            $inputHora2='13:59';
        }if($inputTurno=='Tarde'){
            $inputHora1='14:00';
            $inputHora2='20:59';
        }if($inputTurno=='Noche'){
            $inputHora1='21:00';
            $inputHora2='23:59';
        }
        if($inputTurno=='Noche'){
            $sqlA=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                    INNER JOIN paciente_info pi 
                                                    ON pi.triage_id=am.triage_id AND 
                                                            pi.pia_lugar_accidente='TRABAJO' AND
                                                            $Tipo
                                                            am.asistentesmedicas_fecha='$inputFecha' AND
                                                            am.asistentesmedicas_hora BETWEEN '$inputHora1' AND '$inputHora2'
            "));
            $sqlB=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                    INNER JOIN paciente_info pi 
                                                    ON pi.triage_id=am.triage_id AND 
                                                            pi.pia_lugar_accidente='TRABAJO' AND
                                                            $Tipo
                                                            am.asistentesmedicas_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND
                                                            am.asistentesmedicas_hora BETWEEN '00:00' AND '06:59'
            "));
            $Total=$sqlA+$sqlB;
        }else{
            $Total=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                    INNER JOIN paciente_info pi 
                                                    ON pi.triage_id=am.triage_id AND 
                                                            pi.pia_lugar_accidente='TRABAJO' AND
                                                            $Tipo
                                                            am.asistentesmedicas_fecha='$inputFecha' AND
                                                            am.asistentesmedicas_hora BETWEEN '$inputHora1' AND '$inputHora2'
            "));
        }
        $this->setOutput(array('Total'=>$Total));
    }
    public function AjaxIndicadorEspontaneas() {
        $inputFecha= $this->input->post('inputFecha');
        $inputTurno= $this->input->post('inputTurno');
        $inputTipo= $this->input->post('inputTipo');
        
        $Total=0;
        if($inputTurno=='Mañana'){
            $inputHora1='07:00';
            $inputHora2='13:59';
        }if($inputTurno=='Tarde'){
            $inputHora1='14:00';
            $inputHora2='20:59';
        }if($inputTurno=='Noche'){
            $inputHora1='21:00';
            $inputHora2='23:59';
        }
        if($inputTurno=='Noche'){
            $sqlA=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                    INNER JOIN paciente_info pi 
                                                    ON pi.triage_id=am.triage_id AND 
                                                            pi.pia_procedencia_espontanea='$inputTipo' AND
                                                            am.asistentesmedicas_fecha='$inputFecha' AND
                                                            am.asistentesmedicas_hora BETWEEN '$inputHora1' AND '$inputHora2'
            "));
            $sqlB=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                    INNER JOIN paciente_info pi 
                                                    ON pi.triage_id=am.triage_id AND 
                                                            pi.pia_procedencia_espontanea='$inputTipo' AND
                                                            am.asistentesmedicas_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND
                                                            am.asistentesmedicas_hora BETWEEN '00:00' AND '06:59'
            "));
            $Total=$sqlA+$sqlB;
        }else{
            $Total=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                    INNER JOIN paciente_info pi 
                                                    ON pi.triage_id=am.triage_id AND 
                                                            pi.pia_procedencia_espontanea='$inputTipo' AND
                                                            am.asistentesmedicas_fecha='$inputFecha' AND
                                                            am.asistentesmedicas_hora BETWEEN '$inputHora1' AND '$inputHora2'
            "));
        }
        $this->setOutput(array('Total'=>$Total));
    }
    public function AjaxIndicadorTotal() {
        $inputFecha= $this->input->post('inputFecha');
        $inputTurno= $this->input->post('inputTurno');
        $Total=0;
        if($inputTurno=='Mañana'){
            $inputHora1='07:00';
            $inputHora2='13:59';
        }if($inputTurno=='Tarde'){
            $inputHora1='14:00';
            $inputHora2='20:59';
        }if($inputTurno=='Noche'){
            $inputHora1='21:00';
            $inputHora2='23:59';
        }
        if($inputTurno=='Noche'){
            $sqlA=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                            WHERE
                                                            am.asistentesmedicas_fecha='$inputFecha' AND
                                                            am.asistentesmedicas_hora BETWEEN '$inputHora1' AND '$inputHora2'
            "));
            $sqlB=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                            WHERE
                                                            am.asistentesmedicas_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND
                                                            am.asistentesmedicas_hora BETWEEN '00:00' AND '06:59'
            "));
            $Total=$sqlA+$sqlB;
        }else{
            $Total=count($this->config_mdl->sqlQuery("SELECT am.asistentesmedicas_id FROM os_asistentesmedicas AS am
                                                            WHERE
                                                            am.asistentesmedicas_fecha='$inputFecha' AND
                                                            am.asistentesmedicas_hora BETWEEN '$inputHora1' AND '$inputHora2'
            "));
        }
        $this->setOutput(array('Total'=>$Total));
    }
    public function IndicadorDetalles() {
        $POR_FECHA_FI= $this->input->get_post('POR_FECHA_FECHA_I');
        if($this->input->get_post('TIPO')=='ST7 INICIADA'){
            $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_triage, paciente_info
            WHERE
            os_asistentesmedicas.triage_id=os_triage.triage_id AND
            os_triage.triage_id=paciente_info.triage_id AND
            os_asistentesmedicas.asistentesmedicas_fecha='$POR_FECHA_FI' AND paciente_info.pia_lugar_accidente='TRABAJO'");

        }if($this->input->get_post('TIPO')=='ST7 TERMINADA'){
            $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, paciente_info, os_triage
            WHERE
            os_asistentesmedicas.triage_id=os_triage.triage_id AND
            os_asistentesmedicas.asistentesmedicas_omitir='No' AND 
            os_triage.triage_id=paciente_info.triage_id AND
            os_asistentesmedicas.asistentesmedicas_fecha='$POR_FECHA_FI' AND paciente_info.pia_lugar_accidente='TRABAJO'");

        }if($this->input->get_post('TIPO')=='ESPONTÁNEA'){
            $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, paciente_info, os_triage
            WHERE
            os_asistentesmedicas.triage_id=os_triage.triage_id AND
            os_triage.triage_id=paciente_info.triage_id AND
            os_asistentesmedicas.asistentesmedicas_fecha='$POR_FECHA_FI' AND paciente_info.pia_procedencia_espontanea='Si'");

        }if($this->input->get_post('TIPO')=='NO ESPONTÁNEA'){
            $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, paciente_info, os_triage
            WHERE
            os_asistentesmedicas.triage_id=os_triage.triage_id AND
            os_triage.triage_id=paciente_info.triage_id AND
            os_asistentesmedicas.asistentesmedicas_fecha='$POR_FECHA_FI' AND paciente_info.pia_procedencia_espontanea='No'");

        }
        $this->load->view('IndicadoresDetalles',$sql);
    }
    public function ChartSt7Iniciada($data) {
        $POR_FECHA_FI= $data['POR_FECHA_FECHA_I'];
        $POR_FECHA_FF= $data['POR_FECHA_FECHA_F'];
        $POR_HORA_F= $data['POR_HORA_FECHA'];
        $POR_HORA_HI= $data['POR_HORA_HORA_I'];
        $POR_HORA_HF= $data['POR_HORA_HORA_F'];
        $COLOR=$data['COLOR'];
        if($data['FILTRO']=='Por Fecha'){
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha BETWEEN '$POR_FECHA_FI' AND '$POR_FECHA_FF' AND os_triage.triage_paciente_accidente_lugar='TRABAJO'"));
        }else{
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha='$POR_HORA_F' AND
                os_asistentesmedicas.asistentesmedicas_hora BETWEEN '$POR_HORA_HI' AND '$POR_HORA_HF' AND os_triage.triage_paciente_accidente_lugar='TRABAJO'"));
        }
    }
    public function ChartSt7Terminada($data) {
        $POR_FECHA_FI= $data['POR_FECHA_FECHA_I'];
        $POR_FECHA_FF= $data['POR_FECHA_FECHA_F'];
        $POR_HORA_F= $data['POR_HORA_FECHA'];
        $POR_HORA_HI= $data['POR_HORA_HORA_I'];
        $POR_HORA_HF= $data['POR_HORA_HORA_F'];
        $COLOR=$data['COLOR'];
        if($data['FILTRO']=='Por Fecha'){
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_asistentesmedicas.asistentesmedicas_omitir='No' AND 
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha BETWEEN '$POR_FECHA_FI' AND '$POR_FECHA_FF' AND os_triage.triage_paciente_accidente_lugar='TRABAJO'"));
        }else{
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_asistentesmedicas.asistentesmedicas_omitir='No' AND 
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha='$POR_HORA_F' AND
                os_asistentesmedicas.asistentesmedicas_hora BETWEEN '$POR_HORA_HI' AND '$POR_HORA_HF' AND os_triage.triage_paciente_accidente_lugar='TRABAJO'"));
        }
    }
    public function ChartEspontanea($data) {
        $POR_FECHA_FI= $data['POR_FECHA_FECHA_I'];
        $POR_FECHA_FF= $data['POR_FECHA_FECHA_F'];
        $POR_HORA_F= $data['POR_HORA_FECHA'];
        $POR_HORA_HI= $data['POR_HORA_HORA_I'];
        $POR_HORA_HF= $data['POR_HORA_HORA_F'];
        $COLOR=$data['COLOR'];
        if($data['FILTRO']=='Por Fecha'){
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha BETWEEN '$POR_FECHA_FI' AND '$POR_FECHA_FF' AND os_triage.triage_procedencia!=''"));
        }else{
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_asistentesmedicas.asistentesmedicas_omitir='No' AND 
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha='$POR_HORA_F' AND
                os_asistentesmedicas.asistentesmedicas_hora BETWEEN '$POR_HORA_HI' AND '$POR_HORA_HF' AND os_triage.triage_procedencia!=''"));
        }
    }
    public function ChartNoEspontanea($data) {
        $POR_FECHA_FI= $data['POR_FECHA_FECHA_I'];
        $POR_FECHA_FF= $data['POR_FECHA_FECHA_F'];
        $POR_HORA_F= $data['POR_HORA_FECHA'];
        $POR_HORA_HI= $data['POR_HORA_HORA_I'];
        $POR_HORA_HF= $data['POR_HORA_HORA_F'];
        $COLOR=$data['COLOR'];
        if($data['FILTRO']=='Por Fecha'){
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha BETWEEN '$POR_FECHA_FI' AND '$POR_FECHA_FF' AND os_triage.triage_procedencia=''"));
        }else{
            return count($this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_asistentesmedicas_rc, os_triage
                WHERE
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_asistentesmedicas.asistentesmedicas_omitir='No' AND
                os_triage.triage_color='$COLOR' AND
                os_asistentesmedicas_rc.asistentesmedicas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_asistentesmedicas.asistentesmedicas_fecha='$POR_HORA_F' AND
                os_asistentesmedicas.asistentesmedicas_hora BETWEEN '$POR_HORA_HI' AND '$POR_HORA_HF' AND os_triage.triage_procedencia=''"));
        }
    }
    public function AjaxMedicoTratantes() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_empleados, os_empleados_roles, os_roles WHERE
                                        os_empleados.empleado_id=os_empleados_roles.empleado_id AND
                                        os_roles.rol_id=os_empleados_roles.rol_id AND
                                        os_roles.rol_id=2");
        foreach ($sql as $value) {
            $Medico.="'".$value['empleado_nombre'].' '.$value['empleado_ap']."'".$value['empleado_am']."',";
            
        }
        $this->setOutput(array('medicos'=>trim($Medico,',')));
    }
}
