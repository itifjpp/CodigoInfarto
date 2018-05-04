<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Consultorios
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Consultorios extends Config{
    public function __construct() {
        parent::__construct();
        $this->VerificarSession();
    }
    public function Configuracion() {
        $this->load->view('index_configuracion');
    }
    public function index() {   
        $sql['Consultorio']= $this->BuscarConsultorio($this->UMAE_AREA);
        $sql['Gestion']=  $this->config_mdl->sqlQuery("SELECT 
                                                        ing.ingreso_clasificacion,ing.ingreso_folio_simef,
                                                        ing.ingreso_id, ce_fe,ce_he,con.ce_hf,pac.paciente_nombre, pac.paciente_ap,pac.paciente_am,ce_asignado_consultorio,ce_status 
                                                        FROM 
                                                            sigh_consultorios_especialidad AS con, sigh_consultorios_especialidad_llamada AS con_ll, 
                                                            sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac 
                                                        WHERE 
                                                            con.ce_id=con_ll.ce_id_ce AND pac.paciente_id=ing.paciente_id AND con.ingreso_id=ing.ingreso_id AND
                                                            con.ce_status!='Salida' AND con.ce_asignado_consultorio='$this->UMAE_AREA' ORDER BY con_ll.cel_id DESC LIMIT 20");
        
        $sql['TotalEspera']= count($this->config_mdl->sqlQuery("SELECT lista.lista_espera_id FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND lista.lista_espera_date_envio!='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera')"));
        
        
        $this->load->view('index',$sql);
    } 
    public function ListarPacientesEnEspera() {
        $this->load->view('index_listaenespera');
    }
    public function AjaxListaEsperaTotal() {
        $TotalEspera= count($this->config_mdl->sqlQuery("SELECT lista.lista_espera_id FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND lista.lista_espera_date_envio!='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera')"));
        $this->setOutput(array('TotalEspera'=>$TotalEspera));
        
    }
    public function AjaxReportarSalida() {
        
    }
    public function AjaxAltaPorAusencia() {
        
    }
    public function AjaxSalidaObservacion() {
        $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',array(
            'ce_hf'=>'Observación',
            'ce_status'=>'Salida',
            'ce_fs'=>date('Y-m-d'),
            'ce_hs'=>date('H:i') 
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_doc43029',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> 'Observación',
            'doc_tipo'=>'Egreso',
            'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_doc43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> 'Observación',
            'doc_tipo'=>'Ingreso',
            'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Consultorios',
            'ingreso_en_status'=>'Alta e Ingreso a Observación',
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->logAccesos(array('acceso_tipo'=>'Alta de Consultorio ','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxObtenerPaciente() {
        $sqlConsultorio=$this->config_mdl->sqlQuery("SELECT * FROM sigh_consultorios_especialidad AS ce WHERE ce.ingreso_id=".$this->input->get_post('ingreso_id'));
        $sqlPaciente=   $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_am_id, pac.paciente_nombre, pac.paciente_ap,pac.paciente_am,pac.paciente_rfc,pac.paciente_nss,pac.paciente_nss_agregado, ing.ingreso_clasificacion FROM 
                                                    sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$this->input->get_post('ingreso_id'))[0];
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->get_post('ingreso_id')
        ));
        if(!empty($sqlCheck)){
            if($sqlCheck[0]['paciente_id']!=''){
                if(SiGH_ASISTENTESMEDICAS_OMISION=='No'){
                    if($sqlPaciente['ingreso_am_id']!=''){
                        if(!empty($sqlConsultorio)){
                            if($sqlConsultorio[0]['ce_status']=='En Espera'){
                                $this->setOutput(array('paciente'=>$sqlPaciente,'action'=>'NO_ASIGNADO'));
                            }else{
                                $Interconsulta= $this->config_mdl->sqlGetDataCondition('sigh_doc430200',array(
                                    'ingreso_id'=> $this->input->post('ingreso_id')
                                ));
                                $Medico= $this->config_mdl->sqlQuery("SELECT emp.empleado_nombre, emp.empleado_am, emp.empleado_ap, emp.empleado_matricula, emp.empleado_id FROM sigh_empleados AS emp WHERE emp.empleado_id=".$sqlConsultorio[0]['ce_crea']);
                                $this->setOutput(array('paciente'=>$sqlPaciente,'ce'=>$sqlConsultorio[0],'medico'=>$Medico[0],'action'=>'ASIGNADO','TieneInterconsulta'=>$Interconsulta));
                            }    
                        }else{
                            $this->setOutput(array('action'=>'NO_EXISTE_EN_CE','paciente'=>$sqlPaciente));
                        }
                    }else{
                        $this->setOutput(array('action'=>'NO_AM'));
                    }    
                }else{
                    if(!empty($sqlConsultorio)){
                        if($sqlConsultorio[0]['ce_status']=='En Espera'){
                            $this->setOutput(array('paciente'=>$sqlPaciente,'action'=>'NO_ASIGNADO'));
                        }else{
                            $Interconsulta= $this->config_mdl->sqlGetDataCondition('sigh_doc430200',array(
                                'ingreso_id'=> $this->input->get_post('ingreso_id')
                            ));
                            $Medico= $this->config_mdl->sqlQuery("SELECT emp.empleado_nombre, emp.empleado_am, emp.empleado_ap, emp.empleado_matricula, emp.empleado_id FROM sigh_empleados AS emp WHERE emp.empleado_id=".$sqlConsultorio[0]['ce_crea']);
                            $this->setOutput(array('paciente'=>$sqlPaciente,'ce'=>$sqlConsultorio[0],'medico'=>$Medico[0],'action'=>'ASIGNADO','TieneInterconsulta'=>$Interconsulta));
                        } 
                    }else{
                        $this->setOutput(array('action'=>'NO_EXISTE_EN_CE','paciente'=>$sqlPaciente));
                    }
                }
            }else{
                $this->setOutput(array('action'=>'DATOS NO ENFERMERA'));
            }
        }else{
            $this->setOutput(array('action'=>'NO EXISTE EL N° DE INGRESO'));
        }
    }
    public function AjaxAgregarConsultorioV2() {
        $this->config_mdl->sqlInsert('sigh_consultorios_especialidad',array(
            'ce_fe'=>  date('Y-m-d'),
            'ce_he'=>  date('H:i'), 
            'ce_crea'=> $this->UMAE_USER,
            'ce_status'=>'Asignado',
            'ce_asignado_consultorio'=> $this->UMAE_AREA,
            'ce_interconsulta'=>'No',
            'consultorio_id'=>$this->BuscarConsultorio($this->UMAE_AREA)['ConsultorioId'],
            'especialidad_id'=> $this->ObtenerEspecialidadID(array('Consultorio'=>$this->UMAE_AREA))['id'],   
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $sqlMaxId= $this->config_mdl->sqlGetLastId('sigh_consultorios_especialidad','ce_id');
        $this->config_mdl->sqlInsert('sigh_consultorios_especialidad_llamada',array(
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'ce_id_ce'=>$sqlMaxId
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Consultorios',
            'ingreso_en_status'=>'Ingreso',
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $sqlCkecListaEspera= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
            'ingreso_id'=>$this->input->post('ingreso_id')
        ));
        if(!empty($sqlCkecListaEspera)){
            $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                'lista_espera_estado'=>'Ingresado',
                'lista_espera_date'=> date('Y-m-d'),
                'lista_espera_time'=> date('H:i:s'),
                'lista_espera_consultorio'=> $this->UMAE_AREA,
                'empleado_id'=> $this->UMAE_USER
            ),array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
        }
        $this->logAccesos(array('acceso_tipo'=>'Consultorios Especialidad','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxIngresoConsultorioV2() {
        $sqlConsultorio= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ))[0];
        $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',array(
            'ce_fe'=>  date('Y-m-d'),
            'ce_he'=>  date('H:i'), 
            'ce_crea'=> $this->UMAE_USER,
            'ce_status'=>'Asignado',
            'ce_asignado_consultorio'=> $this->UMAE_AREA,
            'ce_interconsulta'=>'No',
            'consultorio_id'=>$this->BuscarConsultorio($this->UMAE_AREA)['ConsultorioId'],
            'especialidad_id'=> $this->ObtenerEspecialidadID(array('Consultorio'=>$this->UMAE_AREA))['id']   
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_consultorios_especialidad_llamada',array(
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'ce_id_ce'=>$sqlConsultorio['ce_id']
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Consultorios',
            'ingreso_en_status'=>'Ingreso',
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $Servicio= $this->ObtenerEspecialidadID(array(
            'Consultorio'=>$this->UMAE_AREA
        ));
        $sqlCheck43029= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
            'especialidad_id'=>$Servicio['id']
        ));
        if($sqlCheck43029[0]['especialidad_43029']=='Si'){
            $this->config_mdl->sqlInsert('sigh_doc43029',array(
                'doc_fecha'=> date('Y-m-d'),
                'doc_hora'=> date('H:i:s'),
                'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                'doc_destino'=> 'Consultorios',
                'doc_tipo'=>'Ingreso',
                'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
                'empleado_id'=> $this->UMAE_USER,
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
        }
        $sqlCkecListaEspera= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
            'ingreso_id'=>$this->input->post('ingreso_id')
        ));
        if(!empty($sqlCkecListaEspera)){
            $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                'lista_espera_estado'=>'Ingresado',
                'lista_espera_date'=> date('Y-m-d'),
                'lista_espera_time'=> date('H:i:s'),
                'lista_espera_consultorio'=> $this->UMAE_AREA,
                'empleado_id'=> $this->UMAE_USER
            ),array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
        }
        $this->logAccesos(array('acceso_tipo'=>'Consultorios Especialidad','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Indicadores() {
        $this->load->view('IndicadorPersonal');
    }
    public function AjaxIndicadorPersonal() {
        $sql= $this->config_mdl->sqlQuery(" SELECT ce.ce_id
                                            FROM 
                                                    sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_consultorios_especialidad AS ce
                                            WHERE 
                                                    ing.paciente_id=ing.paciente_id AND
                                                    ing.ingreso_id=ce.ingreso_id AND
                                                    ce.ce_crea=".$this->UMAE_USER);
        $this->setOutput(array(
            'action'=>1,
            'total'=> count($sql)
        ));
    }
    public function AjaxIndicadores() {
        $inputFechaInicio= $this->input->post('inputFechaInicio');
        $HF= count($this->config_mdl->_query("SELECT hf_id FROM sigh_hojafrontal WHERE 
        empleado_id=$this->UMAE_USER AND hf_fg='$inputFechaInicio'"));
        $sqlDocumentos= $this->config_mdl->sqlGetDataCondition('sigh_documentos',array(
            'doc_tipo'=>'NOTAS FORMATO 4 30 128'
        ));
        $Total=0;
        foreach ($sqlDocumentos as $value) {
            $TipoDoc=$value['doc_nombre'];
            $TotalConsultorios= count($this->config_mdl->sqlQuery("SELECT notas_id FROM sigh_notas WHERE sigh_notas.notas_tipo='$TipoDoc' AND
                        sigh_notas.empleado_id=$this->UMAE_USER AND sigh_notas.notas_fecha='$inputFechaInicio'"));
            $Total=$TotalConsultorios+$Total;
        }
        $this->setOutput(array(
            'TOTAL_DOCS'=>$HF+$Total
            
        ));
    }
    /*Gestion y Altas a Nuevos Consultorios*/
    public function BuscarConsultorio($Consultoririo) {
        $sqlConsultorio= $this->config_mdl->_get_data_condition('sigh_especialidades_consultorios',array(
            'consultorio_nombre'=> $Consultoririo
        ))[0];
        if($sqlConsultorio['consultorio_especialidad']=='Si'){
            return array(
                'ConsultorioId'=>$sqlConsultorio['consultorio_id'],
                'ConsultorioNombre'=>$sqlConsultorio['consultorio_nombre']
            );
        }else{
            return array(
                'ConsultorioId'=>0,
                'ConsultorioNombre'=>'Consultorios'
            );
        }
    }
    /*NUEVAS FUNCIONES DE CONSULTORIOS POR SERVICIOS ETC..*/
    public function ObtenerEspecialidad($data) {
        $Consultorio=$data['Consultorio'];
        $sqlConsultorio= $this->config_mdl->sqlQuery("SELECT * FROM sigh_especialidades, sigh_especialidades_consultorios WHERE 
            sigh_especialidades.especialidad_id=sigh_especialidades_consultorios.especialidad_id AND
            sigh_especialidades_consultorios.consultorio_nombre='$Consultorio'")[0];
        return $sqlConsultorio['especialidad_nombre']; 
        
    }
    public function ObtenerEspecialidadID($data) {
        $Consultorio=$data['Consultorio'];
        $sqlConsultorio= $this->config_mdl->sqlQuery("SELECT * FROM sigh_especialidades, sigh_especialidades_consultorios WHERE 
            sigh_especialidades.especialidad_id=sigh_especialidades_consultorios.especialidad_id AND
            sigh_especialidades_consultorios.consultorio_nombre='$Consultorio'")[0];
        return array(
            'Especialidad'=>$sqlConsultorio['especialidad_nombre'],
            'id'=>$sqlConsultorio['especialidad_id']
        ); 
    }
    public function ObtenerEspecialidades() {
        $sqlEspecialidades= $this->config_mdl->_query("SELECT * FROM sigh_especialidades");
        foreach ($sqlEspecialidades as $value) {
            $option.='<option value="'.$value['especialidad_nombre'].'">'.$value['especialidad_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    /*Funciones para agregar destinos si el modulo de consultorios esta disponible*/
    function Destinos() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_primercontacto_destinos');
        $this->load->view('Destinos',$sql);
    }
    public function AjaxDestinos() {
        $data=array(
            'destino_nombre'=> $this->input->post('destino_nombre')
        );
        if($this->input->post('destino_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_primercontacto_destinos',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_primercontacto_destinos',$data,array(
                'destino_id'=> $this->input->post('destino_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxDestinosEliminar() {
        $this->config_mdl->sqlDelete('sigh_primercontacto_destinos',array(
            'destino_id'=> $this->input->post('destino_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /*FUNCIONES DINAMICAS PARA CONSULTORIOS*/
    public function AjaxObtenerConsultoriosV2() {
        $sqlFiltro=$this->config_mdl->sqlGetDataCondition('sigh_especialidades_consultorios',array(
            'consultorio_especialidad'=>'No'
        ));
        if(!empty($sqlFiltro)){
            $option.='<option value="0;Consultorios">Consultorios</option>';
        }
        $especialidad=$this->config_mdl->sqlGetDataCondition('sigh_especialidades_consultorios');
        foreach ($especialidad as $value) {
            if($value['consultorio_especialidad']=='Si'){
                $option.='<option value="'.$value['consultorio_id'].';'.$value['consultorio_nombre'].'">'.$value['consultorio_nombre'].'</option>';
            }
        }
        
        $sqlDestinos= $this->config_mdl->sqlGetData('sigh_primercontacto_destinos');
        foreach ($sqlDestinos as $value) {
            $option.='<option value="0;'.$value['destino_nombre'].'">'.$value['destino_nombre'].'</option>';
        }
        if($this->ConfigDestinosOAC=='Si'){
            $option.='<option value="0;Ortopedia-Admisión Continua">Ortopedia-Admisión Continua</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function ActualizarenCe() {
        $sql= $this->config_mdl->sqlQuery('SELECT ce_asignado_consultorio,ce_id FROM os_consultorios_especialidad');
        foreach ($sql as $value) { 
            $this->config_mdl->sqlUpdate('os_consultorios_especialidad',array(
                'consultorio_id'=>$this->BuscarConsultorio($value['ce_asignado_consultorio'])['ConsultorioId'],
                'especialidad_id'=> $this->ObtenerEspecialidadID(array('Consultorio'=>$value['ce_asignado_consultorio']))['id'],
            ),array(
                'ce_id'=>$value['ce_id']
            ));
        }
        $this->setOutput(array('accion'=>'PROCESO TERMINADO'));
    }
    public function AltaPacientes() {
        $sql=$this->config_mdl->sqlQuery("SELECT * FROM os_consultorios_especialidad AS con 
                                    WHERE con.ce_status='Asignado' AND con.ce_fe!='2017-11-23' ORDER BY con.ce_fe DESC");
        foreach ($sql as $value) {
            $data=array(
                'ce_status'=>'Salida',
                'ce_fs'=>date('Y-m-d'),
                'ce_hs'=>date('H:i')
            );
            $this->config_mdl->sqlUpdate('os_consultorios_especialidad',$data,array(
                'triage_id'=> $value['triage_id']
            ));
        }
    }
    /*LISTA DE PACIENTES EN ESPERA*/
    public function AjaxListaEspera() {
        $Especialidad= $this->ObtenerEspecialidad(array(
            'Consultorio'=> $this->UMAE_AREA
        ));
        
        $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                lista.*, ing.ingreso_consultorio_nombre, ing.ingreso_clasificacion 
                                            FROM 
                                                sigh_consultorios_lista_espera AS lista, sigh_pacientes_ingresos AS ing 
                                            WHERE 
                                                lista.ingreso_id=ing.ingreso_id AND
                                                lista.lista_espera_estado!='Ingresado' AND lista.lista_espera_estatus='' AND
                                                ing.ingreso_consultorio_nombre='$Especialidad'
                                            ORDER BY 
                                                ing.ingreso_clasificacion='Amarillo' DESC, 
                                                ing.ingreso_clasificacion='Verde' DESC, 
                                                ing.ingreso_clasificacion='Azul' DESC,
                                                lista.lista_espera_id ASC");
        
        $sqlVerde= count($this->config_mdl->sqlQuery("SELECT lista.lista_espera_id
                                                    FROM 
                                                        sigh_consultorios_lista_espera AS lista, sigh_pacientes_ingresos AS ing 
                                                    WHERE 
                                                        lista.ingreso_id=ing.ingreso_id AND
                                                        lista.lista_espera_estado!='Ingresado' AND lista.lista_espera_estatus='' AND
                                                        ing.ingreso_consultorio_nombre='$Especialidad' AND
                                                        ing.ingreso_clasificacion='Verde'"));
        $sqlAzul= count($this->config_mdl->sqlQuery("SELECT lista.lista_espera_id
                                                    FROM 
                                                        sigh_consultorios_lista_espera AS lista, sigh_pacientes_ingresos AS ing 
                                                    WHERE 
                                                        lista.ingreso_id=ing.ingreso_id AND
                                                        lista.lista_espera_estado!='Ingresado' AND lista.lista_espera_estatus='' AND
                                                        ing.ingreso_consultorio_nombre='$Especialidad' AND
                                                        ing.ingreso_clasificacion='Azul'"));
        if(!empty($sql)){
            $sqlTurnos= $this->config_mdl->sqlGetData('sigh_consultorios_le_llamados');
            $ContadorAmarillo=$sqlTurnos[0]['llamado_espera_amarillo'];
            $ContadorVerde=$sqlTurnos[0]['llamado_espera_verde'];
            $ContadorAzul=$sqlTurnos[0]['llamado_espera_azul'];
            
            $TurnoAmarillo=$sqlTurnos[1]['llamado_espera_amarillo'];
            $TurnoVerde=$sqlTurnos[1]['llamado_espera_verde'];
            $TurnoAzul=$sqlTurnos[1]['llamado_espera_azul'];
            foreach ($sql as $value) {
                if($value['lista_espera_eventos']<=3){
                    if($value['lista_espera_eventos']==0){
                        if($value['ingreso_clasificacion']=='Amarillo'){
                            if($ContadorAmarillo<$TurnoAmarillo){
                                $this->ListaEsperaAgregar(array(
                                    'lista_espera_eventos'=>$value['lista_espera_eventos'],
                                    'lista_espera_id'=>$value['lista_espera_id'],
                                    'ingreso_id'=>$value['ingreso_id']
                                ));
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_amarillo'=>$ContadorAmarillo+1
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR AMARILLO CONTADOR:'.$EsperaAmarillo,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                break;
                            }else{
                                if($ContadorAmarillo==$TurnoAmarillo){
                                    if($sqlVerde==0 && $sqlAzul==0){
                                        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                            'llamado_espera_amarillo'=>0,
                                            'llamado_espera_verde'=>0,
                                            'llamado_espera_azul'=>0
                                        ),array(
                                            'llamado_id'=>1
                                        ));
                                        $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                        continue;
                                    }else{
                                    
                                    }
                                }else{
                                    continue;
                                }

                            }
                        }else if($value['ingreso_clasificacion']=='Verde'){
                            if($ContadorVerde<$TurnoVerde){
                                $this->ListaEsperaAgregar(array(
                                    'lista_espera_eventos'=>$value['lista_espera_eventos'],
                                    'lista_espera_id'=>$value['lista_espera_id'],
                                    'ingreso_id'=>$value['ingreso_id']
                                ));
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_verde'=>$ContadorVerde+1
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR VERDE CONTADOR:'.$EsperaVerde,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                break;
                            }else{
                                if($ContadorVerde==$TurnoVerde){
                                    if($sqlAzul==0){
                                        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                            'llamado_espera_amarillo'=>0,
                                            'llamado_espera_verde'=>0,
                                            'llamado_espera_azul'=>0
                                        ),array(
                                            'llamado_id'=>1
                                        ));
                                        $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                        continue;
                                    }else{
                                        
                                    }
                                }else{
                                    continue;
                                }

                            }

                        }else if($value['ingreso_clasificacion']=='Azul'){
                            if($ContadorAzul<$TurnoAzul){
                                $this->ListaEsperaAgregar(array(
                                    'lista_espera_eventos'=>$value['lista_espera_eventos'],
                                    'lista_espera_id'=>$value['lista_espera_id'],
                                    'ingreso_id'=>$value['ingreso_id']
                                ));
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_azul'=>$ContadorAzul+1
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR AZUL CONTADOR:'.$EsperaAzul,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                break;
                            }else{
                                if($ContadorAzul==$TurnoAzul){
                                    $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                        'llamado_espera_amarillo'=>0,
                                        'llamado_espera_verde'=>0,
                                        'llamado_espera_azul'=>0
                                    ),array(
                                        'llamado_id'=>1
                                    ));
                                    $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                    continue;
                                }else{
                                    continue;
                                }
                            }
                        }
                        if($ContadorAmarillo==$TurnoAmarillo && $ContadorVerde==$TurnoVerde && $ContadorAzul==$TurnoAzul){
                            $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                'llamado_espera_amarillo'=>0,
                                'llamado_espera_verde'=>0,
                                'llamado_espera_azul'=>0
                            ),array(
                                'llamado_id'=>1
                            ));
                            $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                            continue;
                        }
                        
                    }else{ 
                        $Tiempo1=new DateTime($value['lista_espera_date'].' '.$value['lista_espera_time']);
                        $Tiempo2=new DateTime(date('Y-m-d H:i:s'));

                        $Diff=$Tiempo1->diff($Tiempo2);
                        if($Diff->i>15){
                            if($value['ingreso_clasificacion']=='Amarillo'){
                                if($ContadorAmarillo<$TurnoAmarillo){
                                    $this->ListaEsperaAgregar(array(
                                        'lista_espera_eventos'=>$value['lista_espera_eventos'],
                                        'lista_espera_id'=>$value['lista_espera_id'],
                                        'ingreso_id'=>$value['ingreso_id']
                                    ));
                                    $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                        'llamado_espera_amarillo'=>$ContadorAmarillo+1
                                    ),array(
                                        'llamado_id'=>1
                                    ));
                                    $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR AMARILLO CONTADOR:'.$EsperaAmarillo,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                    break;
                                }else{
                                    if($ContadorAmarillo==$TurnoAmarillo){
                                        if($sqlVerde==0 && $sqlAzul==0){
                                            $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                                'llamado_espera_amarillo'=>0,
                                                'llamado_espera_verde'=>0,
                                                'llamado_espera_azul'=>0
                                            ),array(
                                                'llamado_id'=>1
                                            ));
                                            $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                            continue;
                                        }else{

                                        }
                                    }else{
                                        continue;
                                    }

                                }
                            }else if($value['ingreso_clasificacion']=='Verde'){
                                if($ContadorVerde<$TurnoVerde){
                                    $this->ListaEsperaAgregar(array(
                                        'lista_espera_eventos'=>$value['lista_espera_eventos'],
                                        'lista_espera_id'=>$value['lista_espera_id'],
                                        'ingreso_id'=>$value['ingreso_id']
                                    ));
                                    $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                        'llamado_espera_verde'=>$ContadorVerde+1
                                    ),array(
                                        'llamado_id'=>1
                                    ));
                                    $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR VERDE CONTADOR:'.$EsperaVerde,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                    break;
                                }else{
                                    if($ContadorVerde==$TurnoVerde){//1<2
                                        if($sqlAzul==0){
                                            $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                                'llamado_espera_amarillo'=>0,
                                                'llamado_espera_verde'=>0,
                                                'llamado_espera_azul'=>0
                                            ),array(
                                                'llamado_id'=>1
                                            ));
                                            $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                            continue;
                                        }else{

                                        }
                                    }else{
                                        continue;
                                    }
                                }
                            }else if($value['ingreso_clasificacion']=='Azul'){
                                if($ContadorAzul<$TurnoAzul){
                                    $this->ListaEsperaAgregar(array(
                                        'lista_espera_eventos'=>$value['lista_espera_eventos'],
                                        'lista_espera_id'=>$value['lista_espera_id'],
                                        'ingreso_id'=>$value['ingreso_id']
                                    ));
                                    $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                        'llamado_espera_azul'=>$EsperaAzul+1
                                    ),array(
                                        'llamado_id'=>1
                                    ));
                                    $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR AZUL CONTADOR:'.$EsperaAzul,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                    break;
                                }else{
                                    if($ContadorAzul==$TurnoAzul){ //2>2
                                        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                            'llamado_espera_amarillo'=>0,
                                            'llamado_espera_verde'=>0,
                                            'llamado_espera_azul'=>0
                                        ),array(
                                            'llamado_id'=>1
                                        ));
                                        $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                        continue;   
                                    }else{
                                        continue;
                                    }
                                }
                            }
                            if($ContadorAmarillo==$TurnoAmarillo && $ContadorVerde==$TurnoVerde && $ContadorAzul==$TurnoAzul){
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_amarillo'=>0,
                                    'llamado_espera_verde'=>0,
                                    'llamado_espera_azul'=>0
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES','ListaEspera'=> count($sql))); 
                                continue;
                            }
                        }else{
                            $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'TIEMPO DE ESPERA NO ES MAYOR A 15 Mi','ListaEspera'=> 0)); 
                            continue;
                        }
                    }
                }else{
                    $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                        'lista_espera_estatus'=>'hidden'
                    ),array(
                        'ingreso_id'=>  $value['ingreso_id']
                    ));
                    $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'ALATA PACIENTE 3 EVENTOS DE LLAMADA','ListaEspera'=> count($sql))); 
                    continue;
                }
              
            }
        }else{
            $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'FIN NO HYA LISTA DE PACIENTES','ListaEspera'=> count($sql)));
            
        }
    }
    public function AjaxResetCounter() {
        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
            'llamado_espera_amarillo'=>0,
            'llamado_espera_verde'=>0,
            'llamado_espera_azul'=>0
        ),array(
            'llamado_id'=>1
        ));
        $this->setOutput(array('action'=>1));
    }
    public function ListaEsperaAgregar($data) {
        $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
            'lista_espera_date'=> date('Y-m-d'),
            'lista_espera_time'=> date('H:i:s'),
            'lista_espera_eventos'=>$data['lista_espera_eventos'],
            'lista_espera_estado'=>'En Lista de Espera',
            'lista_espera_consultorio'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER
        ),array(
            'lista_espera_id'=>$data['lista_espera_id']
        ));
        $Servicio= $this->ObtenerEspecialidadID(array(
            'Consultorio'=>$this->UMAE_AREA
        ));
        $sqlCheck43029= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
            'especialidad_id'=>$Servicio['id']
        ));
        if($sqlCheck43029[0]['especialidad_43029']=='Si'){
            $this->config_mdl->sqlInsert('sigh_doc43029',array(
                'doc_fecha'=> date('Y-m-d'),
                'doc_hora'=> date('H:i:s'),
                'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                'doc_destino'=> 'Consultorios',
                'doc_tipo'=>'Ingreso',
                'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
                'empleado_id'=> $this->UMAE_USER,
                'ingreso_id'=>  $data['ingreso_id']
            ));
        }
    }
    public function AjaxListaEspera_old() {
        $Especialidad= $this->ObtenerEspecialidad(array(
            'Consultorio'=> $this->UMAE_AREA
        ));
        
        $sql= $this->config_mdl->sqlQuery(" SELECT 
                                                lista.*, ing.ingreso_consultorio_nombre, ing.ingreso_clasificacion 
                                            FROM 
                                                sigh_consultorios_lista_espera AS lista, sigh_pacientes_ingresos AS ing 
                                            WHERE 
                                                lista.ingreso_id=ing.ingreso_id AND
                                                lista.lista_espera_estado!='En Espera' AND lista.lista_espera_estatus='' AND
                                                ing.ingreso_consultorio_nombre='$Especialidad'
                                                ORDER BY 
                                                ing.ingreso_clasificacion='Amarillo' DESC, 
                                                ing.ingreso_clasificacion='Verde' DESC, 
                                                ing.ingreso_clasificacion='Azul' DESC");
        
        if(!empty($sql)){
            $sqlEsperaLlamado= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_le_llamados',array(
                'llamado_id'=>1
            ))[0];
            $sqlEsperaLlamadoConfig= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_le_llamados',array(
                'llamado_id'=>2
            ))[0];
            $EsperaAmarilloConfig=$sqlEsperaLlamadoConfig['llamado_espera_amarillo'];
            $EsperaVerdeConfig=$sqlEsperaLlamadoConfig['llamado_espera_verde'];
            $EsperaAzulConfig=$sqlEsperaLlamadoConfig['llamado_espera_azul'];
            $EsperaAmarillo=$sqlEsperaLlamado['llamado_espera_amarillo'];
            $EsperaVerde=$sqlEsperaLlamado['llamado_espera_verde'];
            $EsperaAzul=$sqlEsperaLlamado['llamado_espera_azul'];
            foreach ($sql as $value) {
                //if($value['ingreso_consultorio_nombre']==$Especialidad){
                    if($value['lista_espera_estado']=='En Espera'){
                        if($value['ingreso_clasificacion']=='Amarillo'){
                            if($EsperaAmarillo<=$EsperaAmarilloConfig){
                                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                                    'lista_espera_date'=> date('Y-m-d'),
                                    'lista_espera_time'=> date('H:i:s'),
                                    'lista_espera_eventos'=>0,
                                    'lista_espera_estado'=>'En Lista de Espera',
                                    'lista_espera_consultorio'=> $this->UMAE_AREA,
                                    'empleado_id'=> $this->UMAE_USER
                                ),array(
                                    'lista_espera_id'=>$value['lista_espera_id']
                                ));
                                $Servicio= $this->ObtenerEspecialidadID(array(
                                    'Consultorio'=>$this->UMAE_AREA
                                ));
                                $sqlCheck43029= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
                                    'especialidad_id'=>$Servicio['id']
                                ));
                                if($sqlCheck43029[0]['especialidad_43029']=='Si'){
                                    $this->config_mdl->sqlInsert('sigh_doc43029',array(
                                        'doc_fecha'=> date('Y-m-d'),
                                        'doc_hora'=> date('H:i:s'),
                                        'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                                        'doc_destino'=> 'Consultorios',
                                        'doc_tipo'=>'Ingreso',
                                        'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
                                        'empleado_id'=> $this->UMAE_USER,
                                        'ingreso_id'=>  $this->input->post('ingreso_id')
                                    ));
                                }
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_amarillo'=>$EsperaAmarillo+1
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR AMARILLO CONTADOR:'.$EsperaAmarillo,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                break;
                            }else{
                                continue;
                            }
                        }else if($value['ingreso_clasificacion']=='Verde'){
                            if($EsperaVerde<=$EsperaVerdeConfig){
                                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                                    'lista_espera_date'=> date('Y-m-d'),
                                    'lista_espera_time'=> date('H:i:s'),
                                    'lista_espera_eventos'=>0,
                                    'lista_espera_estado'=>'En Lista de Espera',
                                    'lista_espera_consultorio'=> $this->UMAE_AREA,
                                    'empleado_id'=> $this->UMAE_USER
                                ),array(
                                    'lista_espera_id'=>$value['lista_espera_id']
                                ));
                                $Servicio= $this->ObtenerEspecialidadID(array(
                                    'Consultorio'=>$this->UMAE_AREA
                                ));
                                $sqlCheck43029= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
                                    'especialidad_id'=>$Servicio['id']
                                ));
                                if($sqlCheck43029[0]['especialidad_43029']=='Si'){
                                    $this->config_mdl->sqlInsert('sigh_doc43029',array(
                                        'doc_fecha'=> date('Y-m-d'),
                                        'doc_hora'=> date('H:i:s'),
                                        'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                                        'doc_destino'=> 'Consultorios',
                                        'doc_tipo'=>'Ingreso',
                                        'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
                                        'empleado_id'=> $this->UMAE_USER,
                                        'ingreso_id'=>  $this->input->post('ingreso_id')
                                    ));
                                }
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_verde'=>$EsperaVerde+1
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR VERDE CONTADOR:'.$EsperaVerde,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                break;
                            }else{
                                continue;
                            }
                            
                        }else if($value['ingreso_clasificacion']=='Azul'){
                            if($EsperaAzul<=$EsperaAzulConfig){
                                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                                    'lista_espera_date'=> date('Y-m-d'),
                                    'lista_espera_time'=> date('H:i:s'),
                                    'lista_espera_eventos'=>0,
                                    'lista_espera_estado'=>'En Lista de Espera',
                                    'lista_espera_consultorio'=> $this->UMAE_AREA,
                                    'empleado_id'=> $this->UMAE_USER
                                ),array(
                                    'lista_espera_id'=>$value['lista_espera_id']
                                ));
                                $Servicio= $this->ObtenerEspecialidadID(array(
                                    'Consultorio'=>$this->UMAE_AREA
                                ));
                                $sqlCheck43029= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
                                    'especialidad_id'=>$Servicio['id']
                                ));
                                if($sqlCheck43029[0]['especialidad_43029']=='Si'){
                                    $this->config_mdl->sqlInsert('sigh_doc43029',array(
                                        'doc_fecha'=> date('Y-m-d'),
                                        'doc_hora'=> date('H:i:s'),
                                        'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                                        'doc_destino'=> 'Consultorios',
                                        'doc_tipo'=>'Ingreso',
                                        'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
                                        'empleado_id'=> $this->UMAE_USER,
                                        'ingreso_id'=>  $this->input->post('ingreso_id')
                                    ));
                                }
                                $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                                    'llamado_espera_azul'=>$EsperaAzul+1
                                ),array(
                                    'llamado_id'=>1
                                ));
                                $this->setOutput(array('action'=>"PACIENTE_EN_ESPERA",'STATUS'=>$value['lista_espera_estado'],'case'=>'COLOR AZUL CONTADOR:'.$EsperaAzul,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id']));
                                break;
                            }else{
                                
                                //$this->setOutput(array('action'=>0));
                                //continue;
                            }
                        }
                        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
                            'llamado_espera_amarillo'=>0,
                            'llamado_espera_verde'=>0,
                            'llamado_espera_azul'=>0
                        ),array(
                            'llamado_id'=>1
                        ));
                        $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'RESETEO CONTADOR DE COLORES'));
                        continue;
                        
                    }else{
                        //POR ACA......
                        if($value['lista_espera_eventos']>0){
                            if($value['lista_espera_eventos']<=3){
                                $Tiempo1=new DateTime(date('Y-m-d H:i:s'));
                                $Tiempo2=new DateTime($value['lista_espera_date'].' '.$value['lista_espera_time']);
                                $Diff=$Tiempo1->diff($Tiempo2);
                                if($Diff->d==0 && $Diff->h>=0){
                                    if($Diff->i>=15){
                                        $this->setOutput(array('action'=>"PACIENTE_AUSENTE",'STATUS'=>$value['lista_espera_estado'],'tiempo'=>$Diff->i,'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id'],'enventos_espera'=>$value['lista_espera_eventos'],'Consultorio'=>$Especialidad));
                                        break;
                                    }else{
                                        $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'test'));
                                        continue;
                                    }
                                }else{
                                    $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                                        'lista_espera_estatus'=>'hidden'
                                    ),array(
                                        'lista_espera_id'=>$value['lista_espera_id']
                                    ));
                                    $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'test'));
                                    continue;
                                }
                            }else{
                                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                                    'lista_espera_estatus'=>'hidden'
                                ),array(
                                    'lista_espera_id'=> $value['ingreso_id']
                                ));
                                $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'EN ESPERA DE 15 MIN'));
                                continue;
                            }
                        }else{
                            $this->setOutput(array('action'=>"PACIENTE_AUSENTE",'STATUS'=>$value['lista_espera_estado'],'lista_espera_id'=>$value['lista_espera_id'],'ingreso_id'=>$value['ingreso_id'],'enventos_espera'=>$value['lista_espera_eventos'],'Consultorio'=>$Especialidad));
                            break;  
                        }  
                    }
                //}else{
                //    $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'case'=>'NO PERTENCE AL CONSULTORIO LLAMADA','envio'=>$value['ingreso_consultorio_nombre'],'Consultorio'=>$Especialidad));
                //    continue;
                //}
            }  
        }else{
            $this->setOutput(array('action'=>"NO_HAY_LISTA_DE_PACIENTES_EN_ESPERA",'Consultorio'=>$Especialidad,'case'=>'FIN NO HYA LISTA DE PACIENTES'));
        }
    }
    public function AjaxListaEsperaIngreso() {
        $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
            'lista_espera_estado'=>'Ingresado',
            'lista_espera_date'=> date('Y-m-d'),
            'lista_espera_time'=> date('H:i:s'),
            'lista_espera_consultorio'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER
        ),array(
            'lista_espera_id'=> $this->input->post('lista_espera_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function EliminarSesiones() {
        unset($_SESSION['SiGH_ESPERA_AMARILLO']);
        unset($_SESSION['SiGH_ESPERA_VERDE']);
        unset($_SESSION['SiGH_ESPERA_AZUL']);
    }
    public function ver_sesiones() {
        var_dump($_SESSION);
        $this->setOutput($_SESSION);
    }
    public function AjaxListaEsperaAusencia() {//no se esta usando en consultorios.js
        $sql=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
            'lista_espera_id'=> $this->input->post('lista_espera_id')
        ))[0];
        $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
            'lista_espera_estado'=>'Ausente',
            'lista_espera_date'=> date('Y-m-d'),
            'lista_espera_time'=> date('H:i:s'),
            'lista_espera_eventos'=>$sql['lista_espera_eventos']+1,
        ),array(
            'lista_espera_id'=> $this->input->post('lista_espera_id')
        ));
        $this->config_mdl->sqlDelete('sigh_consultorios_especialidad',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlDelete('sigh_consultorios_especialidad_llamada',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Consultorios',
            'ingreso_en_status'=>'Alta Por Ausencia',
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function ListaConsultorios() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_destinos');
        $this->load->view('ListaConsultorios',$sql);
    }
    public function ListaEsperaAsignados() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT 
                                                        ing.ingreso_id, ing.ingreso_clasificacion,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                                        lista.lista_espera_id,lista.lista_espera_consultorio,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado,
                                                        emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am, emp.empleado_perfil
                                                        FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_empleados AS emp WHERE
                                                        lista.lista_espera_estatus='' AND
                                                        lista.empleado_id=emp.empleado_id AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado='Ingresado'");
        $this->load->view('ListaEsperaAsignados',$sql);
    }
    public function ListaEsperaPendientes() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,
                                                        ing.ingreso_date_enfermera,ingreso_time_enfermera,ing.ingreso_time_medico,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                                        lista.lista_espera_id,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND lista.lista_espera_date_envio!='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera')");
        $this->load->view('ListaEsperaPendientes',$sql);
    }
    public function AjaxListaEsperaAsignados() {
        $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
            'lista_espera_estatus'=>'hidden'
        ),array(
            'lista_espera_id'=> $this->input->post('lista_espera_id')
        ));
        $this->config_mdl->sqlDelete('sigh_consultorios_especialidad',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlDelete('sigh_consultorios_especialidad_llamada',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxListaEsperaAlta() {
        $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
            'lista_espera_estatus'=>'hidden'
        ),array(
            'lista_espera_id'=> $this->input->post('lista_espera_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxListaEsperaAltaAll() {
        $this->config_mdl->sqlQueryUpdate("UPDATE sigh_consultorios_lista_espera SET lista_espera_estatus='hidden' WHERE lista_espera_estado IN ('Ausente','En Espera')");
        $this->setOutput(array('action'=>1));
    }
    public function AjaxHistorialEventosLlamadas() {
        $sql= $this->config_mdl->sqlQuery("SELECT espera_log.log_fecha, espera_log.log_hora, emp.empleado_matricula FROM 
                                            sigh_consultorios_lista_espera_log AS espera_log, sigh_empleados AS emp WHERE
                                            espera_log.empleado_id=emp.empleado_id AND 
                                            espera_log.ingreso_id=".$this->input->post('ingreso_id'));
        $lista='';
        if(!empty($sql)){ 
            foreach ($sql as $value) {
                $lista.='<h5 class="no-margin"><i class="fa fa-clock-o color-sigh"></i> '.$value['log_fecha'].' '.$value['log_hora'].' / '.$value['empleado_matricula'].'<h5>';
            }    
        }else{
            $lista='<h5 class="no-margin text-center">NO HAY EVENTOS DE LLAMADA</h5>';
        }
        
        $this->setOutput(array('historial'=>$lista,'action'=>1));
    }
    public function ListaEsperaAbandono() {
        if(isset($_GET['inputDateStart'])){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT 
                                                        ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_date_horacero, ing.ingreso_time_horacero,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                                        lista.lista_espera_id,lista.lista_espera_consultorio,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado,
                                                        emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am, emp.empleado_perfil
                                                        FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_empleados AS emp WHERE
                                                        lista.empleado_id=emp.empleado_id AND
                                                        lista.lista_espera_date BETWEEN '".$_GET['inputDateStart']."' AND '".$_GET['inputDateEnd']."' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estatus='hidden'");
        }else{
            $sql['Gestion']=NULL;
        }
        $this->load->view('ListaEsperaAbandono',$sql);
    }
    public function AjaxConsAltaPaciente() {
        switch ($this->input->post('ce_alta')) {
            case "ENVIAR AL CORTA ESTANCIA":
                $Destino_43029='Corta Estancia';
                $data=array(
                    'ce_hf'=> 'Corta Estancia',
                    'ce_destino'=> 'Corta Estancia',
                    'ce_status'=>'Salida',
                    'ce_fs'=>date('Y-m-d'),
                    'ce_hs'=>date('H:i')
                 );
                $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',$data,array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                    'ingreso_en'=> 'Consultorios',
                    'ingreso_en_status'=>'Alta de Consultorios',
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                    'lista_espera_estatus'=>'hidden'
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $action=1;
                
                break;
            case "ENVIAR A OBSERVACIÓN":
                $Destino_43029='Observación';
                $data=array(
                    'ce_hf'=> 'Se interna al servicio de Observación',
                    'ce_destino'=> 'Se interna al servicio de Observación',
                    'ce_status'=>'Salida',
                    'ce_fs'=>date('Y-m-d'),
                    'ce_hs'=>date('H:i')
                 );
                $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',$data,array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                    'ingreso_en'=> 'Consultorios',
                    'ingreso_en_status'=>'Alta de Consultorios',
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                    'lista_espera_estatus'=>'hidden'
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                 
                $action=1;
                break;
            case "ALTA POR AUSENCIA":
                $Destino_43029='Alta Por Ausencia';
                $sql= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
                    'ingreso_id'=> $this->input->post('ingreso_id')
                ))[0];
                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                    'lista_espera_estado'=>'En Espera',
                    'lista_espera_date'=> date('Y-m-d'),
                    'lista_espera_time'=> date('H:i:s'),
                    'lista_espera_eventos'=>$sql['lista_espera_eventos']+1,
                ),array(
                    'ingreso_id'=> $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlDelete('sigh_consultorios_especialidad',array(
                    'ingreso_id'=> $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlDelete('sigh_consultorios_especialidad_llamada',array(
                    'ingreso_id'=> $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                    'ingreso_en'=> 'Consultorios',
                    'ingreso_en_status'=>'Alta Por Ausencia',
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $action=1;
                break;
            case "ALTA PACIENTE DE CONSULTORIOS":
                $Destino_43029='Alta Paciente';
                $data=array(
                    'ce_hf'=> 'Alta paciente',
                    'ce_destino'=> 'Alta paciente',
                    'ce_status'=>'Salida',
                    'ce_fs'=>date('Y-m-d'),
                    'ce_hs'=>date('H:i')
                 );
                $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',$data,array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                    'ingreso_en'=> 'Consultorios',
                    'ingreso_en_status'=>'Alta de Consultorios',
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                    'lista_espera_estatus'=>'hidden'
                ),array(
                    'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
                $action=1;
                break;
            default:
                $action=0;

                break;
        }

        $sqlCheck43029= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
            'especialidad_id'=> $this->ObtenerEspecialidadID(array('Consultorio'=>$this->UMAE_AREA))['id']
        ))[0];
        if($sqlCheck43029['especialidad_43029']=='Si'){
            $this->config_mdl->sqlInsert('sigh_doc43029',array(
                'doc_fecha'=> date('Y-m-d'),
                'doc_hora'=> date('H:i:s'),
                'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                'doc_destino'=> $Destino_43029,
                'doc_tipo'=>'Egreso',
                'doc_area'=> $this->ObtenerEspecialidad(array('Consultorio'=>$this->UMAE_AREA)),
                'empleado_id'=> $this->UMAE_USER,
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));   
        }
        $this->logAccesos(array('acceso_tipo'=>'Alta de Consultorio','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('action'=>$action));
    }
    public function ListaEsperaIndicadores() {
        $this->load->view('ListaEsperaIndicadores');
    }
    public function AjaxListaEsperaIndicadores() {
        $sqlConsultorios= $this->config_mdl->sqlGetData("sigh_especialidades_consultorios");
        $colConsultorio='';
        $inputFilter= $this->input->post('inputFilter');
        $inputDateStart= $this->input->post('inputDateStart');
        $inputDateEnd= $this->input->post('inputDateEnd');
        $inputTurno= $this->input->post('inputTurno');
        foreach ($sqlConsultorios as $value) {
            if($inputFilter=='RANGO_DE_FECHAS'){
                $sqlPacientes= count($this->config_mdl->sqlQuery("
                    SELECT
                            espera.lista_espera_id
                    FROM
                            sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera
                    WHERE
                            espera.ingreso_id=ing.ingreso_id AND
                            espera.lista_espera_date BETWEEN '$inputDateStart' AND '$inputDateEnd' AND
                            espera.lista_espera_estado='Ingresado' AND
                            espera.lista_espera_consultorio='".$value['consultorio_nombre']."'"));
            }else{
               
                if($inputTurno=='NOCHE'){
                    $sqlPacientesA= $this->config_mdl->sqlQuery("
                                SELECT
                                        espera.lista_espera_id
                                FROM
                                        sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera
                                WHERE
                                        espera.ingreso_id=ing.ingreso_id AND
                                        espera.lista_espera_date='$inputDateStart' AND
                                        espera.lista_espera_date BETWEEN '21:00' AND '23:59' AND
                                        espera.lista_espera_estado='Ingresado' AND
                                        espera.lista_espera_consultorio='".$value['consultorio_nombre']."'");
                    $sqlPacientesB= $this->config_mdl->sqlQuery("
                                SELECT
                                        espera.lista_espera_id
                                FROM
                                        sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera
                                WHERE
                                        espera.ingreso_id=ing.ingreso_id AND
                                        espera.lista_espera_date=DATE_ADD('$inputDateStart',INTERVAL 1 DAY) AND
                                        espera.lista_espera_date BETWEEN '00:00' AND '06:59' AND
                                        espera.lista_espera_estado='Ingresado' AND
                                        espera.lista_espera_consultorio='".$value['consultorio_nombre']."'");
                    $sqlPacientes= count($sqlPacientesA)+count($sqlPacientesB);
                }else{
                    if($inputTurno=='MAÑANA'){
                        $inputTimeStart='07:00';
                        $inputTimeEnd='13:59';
                    }else{
                        $inputTimeStart='14:00';
                        $inputTimeEnd='20:59';
                    }
                    $sqlPacientes= count($this->config_mdl->sqlQuery("
                                SELECT
                                        espera.lista_espera_id
                                FROM
                                        sigh_pacientes_ingresos AS ing, sigh_consultorios_lista_espera AS espera
                                WHERE
                                        espera.ingreso_id=ing.ingreso_id AND
                                        espera.lista_espera_date='$inputDateStart' AND
                                        espera.lista_espera_date BETWEEN '$inputTimeStart' AND '$inputTimeEnd' AND
                                        espera.lista_espera_estado='Ingresado' AND
                                        espera.lista_espera_consultorio='".$value['consultorio_nombre']."'"));
                    
                }
            }
            
            $colConsultorio.=   '<div class="col-md-3 m-t-10 pointer link-open-view" data-href="'. base_url().'Inicio/Documentos/ListaEsperaIndicadores?inputFilter='.$inputFilter.'&inputDateStart='.$inputDateStart.'&inputDateEnd='.$inputDateEnd.'&inputTurno='.$inputTurno.'&inputCons='.$value['consultorio_nombre'].'">
                                    <h3 class="line-height no-margin text-center semi-bold">'.$sqlPacientes.' Pacientes</h3>
                                    <hr class="no-margin">
                                    <h5 class="line-height no-margin text-center">'.$value['consultorio_nombre'].'</h5>
                                </div>';
        }
        $this->setOutput(array('action'=>1,'consultorios'=>$colConsultorio));
    }
}  
