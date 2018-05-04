<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Enfermeria
 *
 * @author bienTICS
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Enfermeria extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('Enfermeria');
    }
    public function ObtenerPisos() {
        $sqlPiso= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_mod'=>'Pisos',
            'areas_acceso_nombre'=> $this->UMAE_AREA
        ))[0];
        return $sqlPiso['areas_acceso_mod_val'];
        
    }
    /*FUNCIONES VIA AJAX*/
    public function AjaxCamas() {
        $Camas=  $this->config_mdl->_query("SELECT * FROM sigh_camas AS cama, sigh_pisos AS piso, sigh_pisos_camas AS pc, sigh_areas AS area
                                            WHERE
                                            area.area_id=cama.area_id AND
                                            pc.piso_id=piso.piso_id AND
                                            pc.cama_id=cama.cama_id AND
                                            piso.piso_id=".$this->ObtenerPisos()." ORDER BY cama.cama_id ASC");
        if(!empty($Camas)){
            foreach ($Camas as $value) {
                $Paciente='&nbsp';
                $Enfermera='&nbsp';
                $Status='';
                $ColorSexo='';
                /**/
                $camaBg='';
                $camaMenu='';
                $camaMenuLista='';
                if($value['cama_status']=='Disponible'){
                    $camaBg='blue';
                    $sqlCheck43051= $this->config_mdl->sqlGetDataCondition('sigh_doc43051',array(
                        'cama_id'=>$value['cama_id'],
                        'ac_estatus'=>'Asignación'
                    ));
                    if(!empty($sqlCheck43051)){
                        $camaMenu='<button md-ink-ripple="" class="md-btn md-fab m-b green waves-effect tip btn-paciente-agregar-ah" data-ingreso="'.$sqlCheck43051[0]['ingreso_id'].'" data-status="'.$value['cama_status'].'" data-cama="'.$value['cama_id'].'" data-area="'.$value['area_id'].'" >
                                <i class="material-icons color-white i-24" >person_add</i>
                            </button>';
                    }else{
                        $camaMenu='<button md-ink-ripple="" class="md-btn md-fab m-b green waves-effect tip btn-paciente-agregar" data-ingreso="0" data-status="'.$value['cama_status'].'" data-cama="'.$value['cama_id'].'" data-area="'.$value['area_id'].'" >
                                <i class="material-icons color-white i-24" >person_add</i>
                            </button>';
                    }
                    
                    $area=$value['cama_status'];
                }if($value['cama_status']=='En Espera'){
                    $camaBg='grey-600';
                    $camaMenu='<button md-ink-ripple="" class="md-btn md-fab m-b red waves-effect tip ingreso-paciente-quirofano" data-triage="'.$value['cama_dh'].'" data-status="'.$value['cama_status'].'" data-cama="'.$value['cama_id'].'" data-area="'.$value['area_id'].'" >
                                <i class="mdi-navigation-arrow-back i-24" ></i>
                            </button>';
                    $area='Ingreso a Quirofano';
                }else if($value['cama_status']=='En Mantenimiento'){
                    $camaBg='red';
                    $area=$value['cama_status'];
                    $camaMenu='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                        <li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Mantenimiento</a></li>
                                    </ul>
                                </li>
                            </ul>';
                }else if($value['cama_status']=='En Limpieza'){
                    $camaBg='orange';
                    $area=$value['cama_status'];
                    $camaMenu='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                        <li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza</a></li>
                                    </ul>
                                </li>
                            </ul>';
                }else if($value['cama_status']=='Ocupado' || $value['cama_status']=='Descompuesta'){
                    
                    $sqlTriage=  $this->config_mdl->sqlQuery("SELECT 
                        area.empleado_id_ingreso,paciente.triage_nombre,paciente.triage_nombre_ap,paciente.triage_nombre_am, paciente.triage_paciente_sexo,
                        paciente.triage_id, area.ap_area,area.ap_id, area.ap_f_ingreso, area.ap_h_ingreso
                        FROM os_triage AS paciente, os_areas_pacientes AS area, os_camas AS cama WHERE 
                            area.triage_id=paciente.triage_id AND
                            area.cama_id=cama.cama_id AND paciente.triage_id=".$value['cama_dh']);
                    $sqlEnfermera= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
                        'empleado_id'=>$sqlTriage[0]['empleado_id_ingreso']
                    ),'empleado_id, empleado_nombre, empleado_ap,empleado_am');
                    
                    if(!empty($sqlTriage)){
                        $NombrePaciente=$sqlTriage[0]['triage_nombre'].' '.$sqlTriage[0]['triage_nombre_ap'].' '.$sqlTriage[0]['triage_nombre_am'];
                        if(strlen($NombrePaciente)>35){
                            $Paciente= '<b>PACIENTE: </b> '.mb_substr($NombrePaciente,0, 35,'UTF-8').'...';
                        }else{
                            $Paciente='<b>PACIENTE: </b> '.$NombrePaciente;
                        }
                        if($sqlTriage[0]['triage_paciente_sexo']=='HOMBRE'){
                            $ColorSexo='blue';
                        }else if($sqlTriage[0]['triage_paciente_sexo']=='MUJER'){
                            $ColorSexo='pink-A100';
                        }else{
                            $ColorSexo='';
                        }
                    }
                    if(!empty($sqlEnfermera)){
                        $NombreEnfermera=$sqlEnfermera[0]['empleado_nombre'].' '.$sqlEnfermera[0]['empleado_ap'].' '.$sqlEnfermera[0]['empleado_am'];
                        if(strlen($NombreEnfermera)>35){
                            $Enfermera='<b>ENF.:</b> '.mb_substr($NombreEnfermera,0, 35,'UTF-8').'...'.' <i class="fa fa-user-md pull-right pointer cambiar-enfermera i-16" style="margin-top:-3px" data-area="'.$sqlTriage[0]['ap_area'].'" data-id="'.$sqlTriage[0]['triage_id'].'"></i>';
                        }else{
                            $Enfermera='<b>ENF.:</b> '.$NombreEnfermera.' <i class="fa fa-user-md pull-right pointer cambiar-enfermera i-16" style="margin-top:-3px" data-area="'.$sqlTriage[0]['ap_area'].'" data-id="'.$sqlTriage[0]['triage_id'].'"></i>';

                        }
                    }
                    if($value['cama_status']=='Ocupado'){
                        $camaBg='green';
                        $camaMenuLista='<li><a href="" class="reportar-cama-descompuesta" data-id="'.$sqlTriage[0]['triage_id'].'" data-piso="'.$value['piso_id'].'" data-cama="'.$value['cama_id'].'"><i class="fa fa fa-wrench icono-accion"></i> Reportar como descompuesta</a></li>';
                    }else if($value['cama_status']=='Descompuesta'){
                        $Status='<i class="fa fa-exclamation-triangle mensaje-cama-decompuesta pointer"></i>';
                        $camaBg='red';
                    }

                    if($sqlTriage[0]['ap_area']!=''){
                        $sql_area= $this->config_mdl->sqlQuery("SELECT * FROM os_areas WHERE area_id=".$sqlTriage[0]['ap_area'])[0];
                        $ap_area='<span style="text-transform:uppercase;">&nbsp;<b>'.$sql_area['area_nombre'].'</b></span>';
                    }else{
                        $ap_area='<span style="text-transform:uppercase;">&nbsp;<b>Sin Especificar </b></span>';
                    }

                    $area=$ap_area.'&nbsp;<i class="fa fa-pencil pointer cambiar-area" data-id="'.$sqlTriage[0]['ap_id'].'"></i>';  
                    $camaMenuLista.='<li><a class="alta-paciente" data-area="'.$value['area_id'].'" data-alta="'.$sqlTriage[0]['observacion_alta'].'" data-cama="'.$value['cama_id'].'" data-triage="'.$sqlTriage[0]['triage_id'].'"><i class="fa fa-share-square-o icono-accion"></i> Alta Paciente</a></li>';
                    $camaMenuLista.='<li><a class="add-tarjeta-identificacion"  data-area="'.$sqlTriage[0]['ap_area'].'" data-id="'.$sqlTriage[0]['triage_id'].'" ><i class="fa fa-address-card-o icono-accion"></i> Tarjeta de Identificación</a></li>';
                    $camaMenuLista.='<li><a class="cambiar-cama-paciente" data-id="'.$sqlTriage[0]['triage_id'].'" data-area="'.$sqlTriage[0]['ap_area'].'" data-cama="'.$value['cama_id'].'"><i class="fa fa-bed icono-accion"></i> Cambiar Cama</a></li>';
                    $camaMenuLista.='<li><a href="'.  base_url().'Sections/Documentos/Expediente/'.$sqlTriage[0]['triage_id'].'/?tipo=Observación&url=Enfermeria" target="_blank"><i class="fa fa-files-o icono-accion"></i> Archivos Anexos</a></li>';
                    $camaMenu='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$camaMenuLista.'</ul>
                                </li>
                            </ul>';
                }if($value['cama_fh_estatus']!=''){
                    $TT= Modules::run('Config/CalcularTiempoTranscurrido',array(
                        'Tiempo1'=>$value['cama_fh_estatus'],
                        'Tiempo2'=> date('Y-m-d H:i:s')
                    ));
                    $TT_=$TT->d.' Dias '.$TT->h.' Hrs '.$TT->i.' Min ';
                }else{
                    $TT_='No se puede determinar';
                }
                $col_md_3.='<div class="col-md-4 cols-camas" style="padding: 3px;margin-top:-10px" data-cama="'.$value['cama_id'].'" data-folio="'.$value['cama_dh'].'">
                                <div class="grid simple color-white" style="border-radius:3px">
                                    <div class="grid-title  sigh-background-secundary color-white">
                                        <h6 class="no-margin color-white" style="margin-top:-6px!important"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</h6>
                                        <div class="card-tools" style="right:2px;top:9px;position:absolute">'.$camaMenu.'</div>
                                    </div>
                                    <div class="grid-body '.$camaBg.'" style="padding-bottom: 5px;border-top:transparent!important">
                                        <h5 class="color-white no-margin semi-bold text-uppercase" style="margin-top:-10px!important;">
                                            <i class="fa fa-bed " ></i> '.$value['cama_nombre'].'
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <h6 class="color-white"> 
                                                    <i class="fa fa-clock-o"></i> '.$value['cama_status'].'
                                                    <span class="pull-right semi-bold">'.$Status.'</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-12">
                                                <h6 class="color-white no-margin" style="font-size:11px!important">'.$Paciente.'</h6>
                                                <h6 class="color-white  m-t-5" style="font-size:11px!important">'.$Enfermera.'</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="position:relative" class="hide">
                                        <div style="position: absolute;width: 10px;height: 112px;top: 25px;" class="'.$ColorSexo.'"></div>
                                    </div>
                                    <div class="row hide" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                        <div class="col-md-7" style="padding-left:0px;"><b style="text-transform:uppercase;font-size:10px"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</b></div>
                                    </div>
                                    <div class="card-heading hide" style="margin-top:-10px;padding-bottom: 0px!important;">
                                        <h5 class="font-thin color-white" style="font-size:20px!important;margin-left: -10px;margin-top: 0px;text-transform: uppercase">
                                            <i class="fa fa-bed"></i> <b>'.$value['cama_nombre'].' '.$Status.'</b>
                                            <div style="position: absolute;right: 24px;top: 20px;;text-transform: none">'.$TT_.'</div>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12" style="margin-left: -10px;margin-top:-9px">
                                                <small style="opacity: 1;font-size: 10px"> 
                                                    <b class="text-left"><i style="font-size:14px" class="fa fa-address-book-o"></i> '.$area.'&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                                    <b class="text-right pull-right"> '.$sqlTriage[0]['ap_f_ingreso'].' '.$sqlTriage[0]['ap_h_ingreso'].'</b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-top:-20px;margin-left:-11px;padding-bottom: 8px;">
                                        <p style="font-size: 10px;">'.$Paciente.'</p>
                                        <p style="margin-top: -7px;font-size: 10px;margin-bottom: 5px;">'.$Enfermera.'</p>
                                    </div>
                                </div>
                            </div>';
                $col_md_3.='';
            }
        }else{
            $col_md_3='NO_HAY_CAMAS';
        }
        $this->setOutput(array('result_camas'=>$col_md_3));
    }
    public function AjaxObtenerPaciente(){
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pisos_pacientes',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ),'cama_id,ap_status');
        if(!empty($sql)){
            if($sql[0]['ap_status']=='Ingreso'){
                $this->setOutput(array('action'=>'EN_PISOS'));
            }else if($sql[0]['ap_status']=='Salida'){
                $this->setOutput(array('action'=>'ALTA_DE_PISOS'));
            }
        }else{
            $this->setOutput(array('action'=>'NO_EXISTE_EN_PISOS'));
        }
    }
    public function AjaxIngresoPacientePisos() {
        $this->config_mdl->sqlDelete('sigh_pisos_pacientes',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $data=array(
            'ap_f_ingreso'=> date('Y-m-d'),
            'ap_h_ingreso'=> date('H:i:s'),
            'ap_status'=>'Ingreso',
            'ap_origen'=> $this->input->post('ap_origen'),
            'ap_area'=> $this->input->post('area_id'),
            'area_id'=> $this->input->post('area_id'),
            'cama_id'=> $this->input->post('cama_id'),
            'empleado_id'=> $this->UMAE_USER,
            'empleado_id_ingreso'=> $this->input->post('empleado_id'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        $this->config_mdl->sqlInsert('sigh_pisos_pacientes',$data);
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('d/m/Y'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=>$this->input->post('ingreso_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'Ocupado',
            'cama_id'=> $this->input->post('cama_id'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        Modules::run('Pisos/Camas/LogPisos',array(
            'log_tipo'=>'Ingreso',
            'log_obs'=>'Ingreso',
            'log_alta'=>'N/A',
            'cama_id'=> $this->input->post('cama_id'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $sqlCheck43051= $this->config_mdl->sqlGetDataCondition('sigh_doc43051',array(
            'ac_estatus'=>'Asignación',
            'ingreso_id'=> $this->input->post('ingreso_id'),
            
        ));
        if(!empty($sqlCheck43051)){
            $this->config_mdl->sqlUpdate('sigh_doc43051',array(
                'ac_estatus'=>'No Asignado',
                'ac_fecha_asignacion'=> date('Y-m-d H:i:s'),
                'cama_id_asignado'=> $this->input->post('cama_id'),
                'empleado_asigna'=> $this->input->post('empleado_id'),
                'triage_asignado'=> $this->input->post('triage_asignado'),
                'ac_estatus_doc'=>'Liberado'
            ),array(
                'ac_estatus'=>'Asignación',
                'ingreso_id'=> $this->input->post('ingreso_id'),
            ));
        }
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Pisos',
            'ingreso_en_status'=>'Ingreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->logAccesos(array('acceso_tipo'=>'Ingreso '.$this->UMAE_AREA,'ingreso_id'=>$this->input->post('ingreso_id')));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxCambiarCama() {
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'En Limpieza',
            'cama_dh'=>0,
            'cama_ingreso_f'=> '',
            'cama_ingreso_h'=> '',
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
        ),array(
            'cama_id'=>  $this->input->post('cama_id_old')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'En Limpieza',
            'cama_id'=>$this->input->post('cama_id_old'),
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'Disponible',
            'cama_id'=> $this->input->post('cama_id_old'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('d/m/Y'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=> $this->input->post('triage_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id_new')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Ocupado',
            'cama_id'=>$this->input->post('cama_id_new'),
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'Ocupado',
            'cama_id'=> $this->input->post('cama_id_new'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_areas_pacientes',array(
            'cama_id'=>  $this->input->post('cama_id_new'),
            'ap_f_ingreso'=> date('Y-m-d'),
            'ap_h_ingreso'=>  date('H:i:s') 
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_insert('os_camas_log',array(
            'cama_log_fecha'=> date('d/m/Y'),
            'cama_log_hora'=> date('H:i'),
            'cama_log_tipo'=>'Cambio de Cama',
            'cama_log_modulo'=> $this->UMAE_AREA,
            'cama_id'=> $this->input->post('cama_id_new'),
            'triage_id'=> $this->input->post('triage_id'),
            'empleado_id'=> $this->UMAE_USER
        ));
        $info= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ))[0];
        $this->AccesosUsuarios(array('acceso_tipo'=>'Cambio de Cama '.$this->UMAE_AREA,'triage_id'=>$this->input->post('triage_id'),'areas_id'=>$info['ap_id']));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxCambiarEnfermera() {
        $sql= $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sql)){
            $areas= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
                'triage_id'=>  $this->input->post('triage_id'),
                'area_id'=> $this->input->post('area_id')
            ))[0];
            $this->config_mdl->_insert('os_log_cambio_enfermera',array(
                'cambio_fecha'=> date('d/m/Y'),
                'cambio_hora'=> date('H:i'),
                'cambio_modulo'=> $this->UMAE_AREA,
                'cambio_cama'=>$areas['cama_id'],
                'empleado_new'=> $sql[0]['empleado_id'],
                'empleado_old'=> $areas['empleado_id_ingreso'],
                'empleado_cambio'=> $this->UMAE_USER,
                'triage_id'=>$this->input->post('triage_id')
            ));
            
            $this->config_mdl->_update_data('os_areas_pacientes',array(
                'empleado_id_ingreso'=>$sql[0]['empleado_id']
            ),array(
                'area_id'=> $this->input->post('area_id'),
                'triage_id'=>  $this->input->post('triage_id')
            ));
            $this->AccesosUsuarios(array('acceso_tipo'=>'Cambio Enfermera '.$this->UMAE_AREA,'triage_id'=>$this->input->post('triage_id'),'areas_id'=>$areas['ap_id']));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxAltaPaciente() {
        $this->config_mdl->_update_data('os_areas_pacientes',array(
            'ap_alta'=>  $this->input->post('ap_alta')
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));

        $this->config_mdl->_update_data('os_areas_pacientes',array(
            'area_id'=> $this->input->post('area_id'),
            'ap_f_salida'=> date('Y-m-d'),
            'ap_h_salida'=>  date('H:i:s') ,
            'ap_status'=>'Salida'
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'En Limpieza',
            'cama_dh'=>0,
            'cama_ingreso_f'=> '',
            'cama_ingreso_h'=> '',
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'En Limpieza',
            'cama_id'=>$this->input->post('cama_id'),
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'En Limpieza',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        Modules::run('Pisos/Camas/LogPisos',array(
            'log_tipo'=>'Egreso',
            'log_obs'=> $this->input->post('log_obs'),
            'log_alta'=> $this->input->post('ap_alta'),
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        $areas= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ))[0];
        $this->config_mdl->sqlUpdate('os_triage',array(
            'triage_en'=> 'Pisos',
            'triage_en_status'=>'Egreso',
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Egreso '.$this->UMAE_AREA,'triage_id'=>$this->input->post('triage_id'),'areas_id'=>$areas['ap_id']));
        
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxObtenerAreas() {
        $option='';
        foreach ($this->config_mdl->_query("SELECT * FROM os_areas WHERE os_areas.area_id BETWEEN 7 AND 23") as $value) {
            $option.='<option value="'.$value['area_id'].'">'.$value['area_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxCambiarArea() {
        $this->config_mdl->_update_data('os_areas_pacientes',array(
            'ap_area'=> $this->input->post('area_id')
        ),array(
            'ap_id'=> $this->input->post('ap_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxObtenerCamas() {
        $Camas=  $this->config_mdl->_query("SELECT * FROM os_camas, os_pisos, os_pisos_camas, os_areas
                                            WHERE
                                            os_camas.cama_status='Disponible' AND
                                            os_areas.area_id=os_camas.area_id AND
                                            os_pisos_camas.piso_id=os_pisos.piso_id AND
                                            os_pisos_camas.cama_id=os_camas.cama_id AND
                                            os_pisos.piso_id=".$this->ObtenerPisos());
        foreach ($Camas as $value) {
            $option.='<option value="'.$value['cama_id'].'">'.$value['cama_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxReingresoPisos() {
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'Ocupado',
            'cama_dh'=> $this->input->post('triage_id'),
            'cama_ingreso_f'=> date('d/m/Y'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Ocupado',
            'cama_id'=>$this->input->post('cama_id'),
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'En Limpieza',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        Modules::run('Pisos/Camas/LogPisos',array(
            'log_tipo'=>'Ingreso',
            'log_obs'=>'Ingreso',
            'log_alta'=> 'N/A',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_areas_pacientes',array(
            'ap_f_ingreso'=> date('Y-m-d'),
            'ap_h_ingreso'=>  date('H:i:s') ,
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $areas= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ))[0];
        $this->config_mdl->sqlUpdate('os_triage',array(
            'triage_en'=> 'Pisos',
            'triage_en_status'=>'Ingreso',
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Reingreso '.$this->UMAE_AREA,'triage_id'=>$this->input->post('triage_id'),'areas_id'=>$areas['ap_id']));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxReportarDescompuesta() {
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'Descompuesta',
            'cama_fh_estatus'=> date('Y-m-d H:i:s')
        ),array(
            'cama_id'=> $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Descompuesta',
            'cama_id'=>$this->input->post('cama_id'),
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'Descompuesta',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxTraslados() {
        $sqlTraslado= $this->config_mdl->_get_data_condition('cc_traslados',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $sqlMatricula= $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sqlMatricula)){
            if(empty($sqlTraslado)){
                $this->config_mdl->_insert('cc_traslados',array(
                    'traslado_sf'=> date('Y-m-d'),
                    'traslado_sh'=> date('H:i:s'),
                    'traslado_codigo'=> $this->input->post('traslado_codigo'),
                    'traslado_servicio'=> $this->input->post('traslado_servicio'),
                    'traslado_medio_traslado'=> $this->input->post('traslado_medio_traslado'),
                    'traslado_estatus'=>'Solicitud Enviada',
                    'cama_id'=> $this->input->post('cama_id'),
                    'triage_id'=> $this->input->post('triage_id'),
                    'empleado_envia'=>$sqlMatricula[0]['empleado_id']
                ));
            }
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function Indicador() {
        $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_areas, os_camas, os_pisos, os_pisos_camas WHERE
            os_areas.area_id=os_camas.area_id AND os_areas.area_modulo='Pisos' AND
            os_pisos.piso_id=os_pisos_camas.piso_id AND os_camas.cama_id=os_pisos_camas.cama_id AND
            os_pisos.piso_id=".$this->ObtenerPisos());
        $this->load->view('EnfermeriaIndicador',$sql);
    }
    /*Asignacion de Camas realizados por Admisión Hospitalaria*/
    public function AjaxCheckAsignacionCama() {
        $sqlAreasPacientes= $this->config_mdl->sqlGetDataCondition('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(empty($sqlAreasPacientes)){
            $sql= $this->config_mdl->sqlGetDataCondition('sigh_doc43051',array(
                'ac_estatus'=>'Asignación',
                'cama_id'=> $this->input->post('cama_id'),
                'triage_id'=> $this->input->post('triage_id_old')
            ))[0];
            if($sql['triage_id'] == $this->input->post('triage_id')){
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{    
            $this->setOutput(array('accion'=>'3'));
        }
    }
    public function AjaxIngresoPacienteAdmision() {
        $data=array(
            'ap_f_ingreso'=> date('Y-m-d'),
            'ap_h_ingreso'=> date('H:i:s'),
            'ap_status'=>'Ingreso',
            'ap_origen'=> $this->input->post('ap_origen'),
            'ap_area'=> $this->input->post('ap_area'),
            'area_id'=> $this->input->post('ap_area'),
            'cama_id'=> $this->input->post('cama_id'),
            'empleado_id'=> $this->UMAE_USER,
            'empleado_id_ingreso'=> $this->UMAE_USER,
            'triage_id'=> $this->input->post('triage_id')
        );
        $this->config_mdl->_insert('os_areas_pacientes',$data,array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $sqlGetId= $this->config_mdl->sqlGetLastId('os_areas_pacientes','ap_id');
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('d/m/Y'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=>$this->input->post('triage_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'Ocupado',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        Modules::run('Pisos/Camas/LogPisos',array(
            'log_tipo'=>'Ingreso',
            'log_obs'=>'Ingreso',
            'log_alta'=> 'N/A',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        if($this->input->post('ac_estatus')=='Asignado'){
            $TriageSolicitud=$this->input->post('triage_id_old');
        }else{
            $TriageSolicitud=$this->input->post('triage_id');
        }
        $sqsDoc43051= $this->config_mdl->sqlGetDataCondition('sigh_doc43051',array(
            'triage_id'=> $TriageSolicitud,
            'ac_estatus'=>'Asignación'
        ));
        
        if(empty($sqsDoc43051)){
            $this->config_mdl->_update_data('sigh_doc43051',array(
                'ac_estatus'=> $this->input->post('ac_estatus'),
                'ac_estatus_doc'=> 'Liberado',
                'ac_fecha_asignacion'=> date('Y-m-d H:i:s'),
                'cama_id_asignado'=> $this->input->post('cama_id'),
                'triage_asignado'=>$this->input->post('triage_id'),
                'empleado_asigna'=> $this->UMAE_USER,
            ),array(
                'ac_estatus'=>'Asignación',
                'cama_id'=> $this->input->post('cama_id')
            ));
        }else{
            $this->config_mdl->_update_data('sigh_doc43051',array(
                'ac_estatus'=> $this->input->post('ac_estatus'),
                'ac_estatus_doc'=> 'Liberado',
                'ac_fecha_asignacion'=> date('Y-m-d H:i:s'),
                'cama_id_asignado'=> $this->input->post('cama_id'),
                'triage_asignado'=>$this->input->post('triage_id'),
                'empleado_asigna'=> $this->UMAE_USER,
            ),array(
                'triage_id'=> $TriageSolicitud
            ));
        }
        
        
        $this->AccesosUsuarios(array('acceso_tipo'=>'Ingreso '.$this->UMAE_AREA,'triage_id'=>$this->input->post('triage_id'),'areas_id'=>$sqlGetId));
        $this->setOutput(array('accion'=>'1'));
    }
    /**/
    public function AjaxBuscarPacienteAreas() {
        $sqlPaciente= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ),'triage_nombre,triage_nombre_ap,triage_nombre_am')[0];
        $sqlArea= $this->config_mdl->_query("SELECT * FROM os_areas_pacientes, os_camas WHERE os_areas_pacientes.cama_id=os_camas.cama_id AND
            os_areas_pacientes.triage_id=".$this->input->post('triage_id'))[0];
        $sqlCama= $this->config_mdl->sqlGetDataCondition('os_camas',array(
            'cama_id'=> $this->input->post('cama_id')
        ),'cama_id,cama_nombre,cama_status')[0];
        $this->setOutput(array(
            'sqlPaciente'=>$sqlPaciente,
            'sqlArea'=>$sqlArea,
            'sqlCama'=>$sqlCama
        ));
    }
    public function AjaxForzarIngreso() {
        /*Forzar asignacion de cama al paciente*/
        $this->config_mdl->_delete_data('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $data=array(
            'ap_f_ingreso'=> date('Y-m-d'),
            'ap_h_ingreso'=> date('H:i:s'),
            'ap_status'=>'Ingreso',
            'ap_area'=> $this->input->post('area'),
            'area_id'=> $this->input->post('area'),
            'cama_id'=> $this->input->post('cama_id'),
            'empleado_id'=> $this->UMAE_USER,
            'empleado_id_ingreso'=> $this->UMAE_USER,
            'triage_id'=> $this->input->post('triage_id')
        );
        $this->config_mdl->_insert('os_areas_pacientes',$data);
        if($this->input->post('cama_status_old')=='Ocupado' || $this->input->post('cama_status_old')=='Asignado'){
            $this->config_mdl->_update_data('os_camas',array(
                'cama_status'=>'Disponible',
                'cama_ingreso_f'=> date('d/m/Y'),
                'cama_ingreso_h'=> date('H:i'),
                'cama_fh_estatus'=> date('Y-m-d H:i:s'),
                'cama_dh'=>0
            ),array(
                'cama_id'=>  $this->input->post('cama_id_old')
            ));
            Modules::run('Pisos/Camas/LogCamas',array(
                'estado_tipo'=>'Disponible',
                'cama_id'=> $this->input->post('cama_id_old'),
                'triage_id'=> $this->input->post('triage_id')
            ));
        }
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('d/m/Y'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=>$this->input->post('triage_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>'Ocupado',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        Modules::run('Pisos/Camas/LogPisos',array(
            'log_tipo'=>'Ingreso',
            'log_obs'=>'Ingreso',
            'log_alta'=>'N/A',
            'cama_id'=> $this->input->post('cama_id'),
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->config_mdl->sqlUpdate('os_triage',array(
            'triage_en'=> 'Pisos',
            'triage_en_status'=>'Ingreso',
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Ingreso '.$this->UMAE_AREA,'triage_id'=>$this->input->post('triage_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarPaciente() {
        $this->config_mdl->_delete_data('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $sql= $this->config_mdl->sqlGetDataCondition('os_camas',array(
            'cama_dh'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            if($sql[0]['cama_status']=='Ocupado'){
                $this->config_mdl->_update_data('os_camas',array(
                    'cama_status'=>'Disponible',
                    'cama_ingreso_f'=> date('d/m/Y'),
                    'cama_ingreso_h'=> date('H:i'),
                    'cama_fh_estatus'=> date('Y-m-d H:i:s'),
                    'cama_dh'=>0
                ),array(
                    'cama_dh'=>$this->input->post('triage_id')
                ));
            }
        }
        $this->config_mdl->_insert('um_pisos_log_del',array(
            'log_fecha'=> date('Y-m-d H:i:s'),
            'log_piso'=> $this->UMAE_AREA,
            'log_accion'=>'Eliminación de paciente del área de pisos',
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Indicadores() {
        $this->load->view('Enfermeria/Indicador');
    }
    public function AjaxIndicador() {
        $inputFecha= $this->input->post('inputFecha');
        $inputTurno= $this->input->post('inputTurno');
        $TotalIngreso=0;
        $TotalEgreso=0;
        if($inputTurno=='Noche'){
            $sqlIngresoNocheA= $this->config_mdl->sqlQuery("SELECT log.log_id FROM um_pisos_log as log WHERE 
                log.log_tipo='Ingreso' AND log.log_fecha='$inputFecha' AND log_turno='Noche A'");
            $sqlIngresoNocheB= $this->config_mdl->sqlQuery("SELECT log.log_id FROM um_pisos_log as log WHERE 
                log.log_tipo='Ingreso' AND log.log_fecha=DATE_ADD('$inputFecha', INTERVAL 1 DAY) AND log_turno='Noche B'");
            $sqlEgresoNocheA= $this->config_mdl->sqlQuery("SELECT log.log_id FROM um_pisos_log as log WHERE 
            log.log_tipo='Egreso' AND log.log_fecha='$inputFecha' AND log_turno='Noche A'");
            $sqlEgresoNocheB= $this->config_mdl->sqlQuery("SELECT log.log_id FROM um_pisos_log as log WHERE 
            log.log_tipo='Egreso' AND log.log_fecha=DATE_ADD('$inputFecha', INTERVAL 1 DAY) AND log_turno='Noche B'");
            $TotalIngreso=count($sqlIngresoNocheA)+count($sqlIngresoNocheB);
            $TotalEgreso=count($sqlEgresoNocheA)+count($sqlEgresoNocheB);
        }else{
            $sqlIngreso= $this->config_mdl->sqlQuery("SELECT log.log_id FROM um_pisos_log as log WHERE 
            log.log_tipo='Ingreso' AND log.log_fecha='$inputFecha' AND log.log_turno='$inputTurno'");
            $sqlEgreso= $this->config_mdl->sqlQuery("SELECT log.log_id FROM um_pisos_log as log WHERE 
                log.log_tipo='Egreso' AND log.log_fecha='$inputFecha' AND log.log_turno='$inputTurno'");
            $TotalIngreso=count($sqlIngreso);
            $TotalEgreso=count($sqlEgreso);
        }
        
        $this->setOutput(array(
            'Ingreso'=>$TotalIngreso,
            'Egreso'=>$TotalEgreso
        ));
    }
}
