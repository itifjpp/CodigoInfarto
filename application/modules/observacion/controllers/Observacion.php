<?php
/**
 * Description of Observacion
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Observacion extends Config{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sqlGetRol= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_nombre'=> $this->UMAE_AREA
        ),'areas_acceso_rol')[0];
        if($sqlGetRol['areas_acceso_rol']=='3'){
            $this->load->view('enfermeria');
        }else{
            $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                'empleado_id'=> $this->UMAE_USER
            ))[0];
            $sql['Observacion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion, ing.ingreso_consultorio, ing.ingreso_consultorio_nombre, pac.paciente_nombre, 
                                                            pac.paciente_ap, pac.paciente_am, pac.paciente_sexo, obs.observacion_date_medico_i, obs.observacion_time_medico_i, obs.observacion_medico_status
                                                            FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_observacion AS obs WHERE
                                                            ing.paciente_id=pac.paciente_id AND 
                                                            ing.ingreso_id=obs.ingreso_id AND
                                                            obs.observacion_medico_status IN('Ingreso','Interconsulta') AND
                                                            obs.observacion_medico=".$this->UMAE_USER);
            $this->load->view('medico',$sql);
        }
    }
    public function AreasObservacion() {
        $sqlArea= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
            'area_modulo'=>'Observación',
            'area_nombre'=> $this->UMAE_AREA
        ),'area_id')[0];
        echo $sqlArea['area_id'];
    }
    public function _GetArea() {
        if(SIGH_OBSERVACION_ENFERMERIA=='Si'){
            $sql= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
                'area_modulo'=>'Observación'
            ),'area_id')[0];
            return $sql['area_id'];
        }else{
            $sqlGeneroArea= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
                'areas_acceso_mod'=>'Observación',
                'areas_acceso_nombre'=> $this->UMAE_AREA
            ))[0];
            $sqlArea= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
                'area_id'=>$sqlGeneroArea['areas_acceso_mod_val']
            ))[0];
            return $sqlArea['area_id'];
        }
    }
    public function AjaxLoadCamas(){
        $Camas=  $this->config_mdl->sqlQuery("SELECT * FROM sigh_camas AS camas, sigh_areas AS area WHERE area.area_id=camas.area_id AND camas.area_id=".$this->_GetArea());
        if(!empty($Camas)){
            
            foreach ($Camas as $value) {
                $Accion='';
                $LimpiezaMantenimiento='';
                $StatusCama='';
                $Enfermera='<br><br>';
                $Paciente='';
                if($value["cama_status"]=='Disponible'){
                    $Color='bg-blue';
                    $Accion='<button class="md-btn md-fab m-b green waves-effect tip btn-paciente-agregar" data-cama="'.$value['cama_id'].'" data-area="'.$value['area_id'].'" data-original-title="Agregar Paciente">
                                <i class="material-icons i-24 color-white">person_add</i>
                            </button>';
                }else if($value["cama_status"]=='Ocupado'){
                    $Color='bg-green';
                    $sqlPaciente= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac 
                                        WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$value['cama_dh'])[0];
                    $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                        'ingreso_id'=>$sqlPaciente['ingreso_id']
                    ))[0];
                    $sql_ti= $this->config_mdl->sqlGetDataCondition('sigh_tarjeta_identificacion',array(
                        'ingreso_id'=>$sqlPaciente['ingreso_id']
                    ))[0];
                    $sql_enf= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                        'empleado_id'=>$sqlObs['observacion_crea']
                    ))[0];
                    $StatusCama=$value['cama_ingreso_f'].' '.$value['cama_ingreso_h'];
                    $Menu=' <li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-alta pointer" data-alta="'.$sqlObs['observacion_alta'].'" data-cama="'.$value['cama_id'].'" data-ingreso="'.$sqlPaciente['ingreso_id'].'"><i class="fa fa-share-square-o sigh-color i-20"></i> Alta Paciente</a></li>';
                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="" href="'.  base_url().'Sections/Documentos/Expediente/'.$sqlPaciente['ingreso_id'].'/?tipo=Observación&url=Enfermeria" target="_blank"><i class="fa fa-folder-open-o sigh-color i-20"></i> Ver Expediente</a></li>';    
                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-tarjeta" href="#"  data-id="'.$sqlPaciente['ingreso_id'].'" data-enfermedad="'.$sql_ti['ti_enfermedades'].'" data-alergia="'.$sql_ti['ti_alergias'].'"><i class="fa fa-address-card-o sigh-color i-20"></i> Tarjeta de Identificación</a></li>';
                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-cambiarcama" href="#"  data-id="'.$sqlPaciente['ingreso_id'].'" data-area="'.$value['area_id'].'" data-cama="'.$value['cama_id'].'"><i class="fa fa-bed sigh-color i-20"></i> Cambiar Cama</a></li>';
                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-imprimirpulsera pointer" data-id="'.$sqlPaciente['ingreso_id'].'"><i class="fa fa-print sigh-color i-20"></i> Imprimir Pulsera</a></li>';
                    
                    $PacienteNombre= $sqlPaciente['paciente_nombre'].' '.$sqlPaciente['paciente_ap'].' '.$sqlPaciente['paciente_am'];
                    $Paciente='<b>PACIENTE:</b> '. $PacienteNombre.'<br>';
                    $Enfermera='<b>ENF:</b> '.$sql_enf['empleado_nombre'].' '.$sql_enf['empleado_ap'].' '.$sql_enf['empleado_am'].' <i class="fa fa-user-md pull-right pointer observacion-enf-cambiarenfermera i-16" style="margin-top:-3px" data-id="'.$sqlPaciente['ingreso_id'].'"></i>';
                    $Accion='<ul class="list-inline" style="margin-top: -9px;">
                                    <li class="dropdown">
                                        <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white btn-mini md-btn-circle">
                                            <i class="material-icons i-24">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menu.'</ul>
                                    </li>
                                </ul>';
                }else if($value["cama_status"]=='En Mantenimiento'){
                    $Color='red';
                    $LimpiezaMantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza / Mantenimiento</a></li>';
                    $Accion='<ul class="list-inline">
                                    <li class="dropdown">
                                        <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                            <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$LimpiezaMantenimiento.'</ul>
                                    </li>
                                </ul>';   
                }else if($value["cama_status"]=='En Limpieza'){
                    $Color='orange';
                    $Menu='<li><a style="line-height:0;padding: 6px 9px;" class="enf-finalizar-mantenimiento pointer" data-title="MANTENIMIENTO" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza</a></li>';
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="material-icons i-24">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menu.'</ul>
                                </li>
                            </ul>';
                }
                
                $col_md_3.='<div class="col-md-4 cols-camas '.$value['cama_display'].'" style="padding: 3px;margin-top:-10px">
                                    <div class="grid simple  color-white">
                                        <div class="grid-title sigh-background-secundary">
                                            <h6 class="no-margin color-white" style="margin-top:-6px!important"><i class="fa fa-window-restore"></i> '.$this->UMAE_AREA.'</h6>
                                            <div class="card-tools" style="right:2px;top:9px;position:absolute">'.$Accion.'</div>
                                        </div>
                                        <div class="grid-body '.$Color.'" style="padding-bottom: 5px;border-top:transparent!important">
                                            <h5 class="color-white no-margin semi-bold text-uppercase" style="margin-top:-10px!important;">
                                                <i class="fa fa-bed " ></i> '.$value['cama_nombre'].'
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <h6 class="color-white"> 
                                                        <i class="fa fa-clock-o"></i> '.$value['cama_status'].'
                                                        <span class="pull-right semi-bold">'.$StatusCama.'</span>
                                                    </h6>
                                                </div>
                                                <div class="col-md-12">
                                                    <h6 class="color-white no-margin" style="font-size:11px!important">'.$Paciente.'</h6>
                                                    <h6 class="color-white  m-t-5" style="font-size:11px!important">'.$Enfermera.'</h6>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>';
            }
            
        }else{
            $col_md_3='NO_HAY_CAMAS';
        }
        $this->setOutput(array('result_camas'=>$col_md_3));
    }
    public function AjaxLoadCamasTipo(){
        
        $sqlModules= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
            'area_modulo'=>'Observación'
        ));
        $TabModule= '<div class="panel-group" id="accordion" data-toggle="collapse" style="margin-top:-20px">';
        $i=0;
        $TabExpansed='false';
        $TabaAction='';
        foreach ($sqlModules as $modulo) {
            $i++;
            if($i==1){
                $TabExpansed='true';
                $TabaAction='in';
            }else{
               $TabExpansed='false';
                $TabaAction=''; 
            }
            $TabModule.= '<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title text-uppercase">
                                    <a class="" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$modulo['area_id'].'" aria-expanded="'.$TabExpansed.'">'.$modulo['area_nombre'].'</a>
                                </h4>
                            </div>
                            <div id="collapse'.$modulo['area_id'].'" class="panel-collapse collapse '.$TabaAction.'" aria-expanded="'.$TabExpansed.'" style="">
                                <div class="panel-body no-padding">
                                    <div class="grid simple" style="">
                                        <div class="grid-body" style=" padding-bottom: 0px;">
                                            <div class="row">';
                                            $Camas=  $this->config_mdl->sqlQuery("SELECT * FROM sigh_camas AS camas, sigh_areas AS area WHERE area.area_id=camas.area_id AND area.area_id=".$modulo['area_id']);
                                            foreach ($Camas as $value) {
                                                $Accion='';
                                                $LimpiezaMantenimiento='';
                                                $StatusCama='';
                                                $Enfermera='<br><br>';
                                                $Paciente='';
                                                if($value["cama_status"]=='Disponible'){
                                                    $Color='bg-blue';
                                                    $Accion='<button class="md-btn md-fab m-b green waves-effect tip btn-paciente-agregar" data-cama="'.$value['cama_id'].'" data-area="'.$value['area_id'].'" data-original-title="Agregar Paciente">
                                                                <i class="material-icons i-24 color-white">person_add</i>
                                                            </button>';
                                                }else if($value["cama_status"]=='Ocupado'){
                                                    $Color='bg-green';
                                                    $sqlPaciente= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac 
                                                                        WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$value['cama_dh'])[0];
                                                    $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                                                        'ingreso_id'=>$sqlPaciente['ingreso_id']
                                                    ))[0];
                                                    $sql_ti= $this->config_mdl->sqlGetDataCondition('sigh_tarjeta_identificacion',array(
                                                        'ingreso_id'=>$sqlPaciente['ingreso_id']
                                                    ))[0];
                                                    $sql_enf= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                                                        'empleado_id'=>$sqlObs['observacion_crea']
                                                    ))[0];
                                                    $StatusCama=$value['cama_ingreso_f'].' '.$value['cama_ingreso_h'];
                                                    $Menu=' <li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-alta pointer" data-alta="'.$sqlObs['observacion_alta'].'" data-cama="'.$value['cama_id'].'" data-ingreso="'.$sqlPaciente['ingreso_id'].'"><i class="fa fa-share-square-o sigh-color i-20"></i> Alta Paciente</a></li>';
                                                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-verexpediente" href="#" data-id="'.$sqlPaciente['ingreso_id'].'"><i class="fa fa-folder-open-o sigh-color i-20"></i> Ver Expediente</a></li>';    
                                                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-tarjeta" href="#"  data-id="'.$sqlPaciente['ingreso_id'].'" data-enfermedad="'.$sql_ti['ti_enfermedades'].'" data-alergia="'.$sql_ti['ti_alergias'].'"><i class="fa fa-address-card-o sigh-color i-20"></i> Tarjeta de Identificación</a></li>';
                                                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-cambiarcama" href="#"  data-id="'.$sqlPaciente['ingreso_id'].'" data-area="'.$value['area_id'].'" data-cama="'.$value['cama_id'].'"><i class="fa fa-bed sigh-color i-20"></i> Cambiar Cama</a></li>';
                                                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-cambiarenfermera" href="#"  data-id="'.$sqlPaciente['ingreso_id'].'"><i class="fa fa-user-md sigh-color i-20"></i> Cambiar Enfermer@</a></li>';
                                                    $Menu.='<li><a style="line-height:0;padding: 6px 9px;" class="observacion-enf-imprimirpulsera pointer" data-id="'.$sqlPaciente['ingreso_id'].'"><i class="fa fa-print sigh-color i-20"></i> Imprimir Pulsera</a></li>';

                                                    $PacienteNombre= $sqlPaciente['paciente_nombre'].' '.$sqlPaciente['paciente_ap'].' '.$sqlPaciente['paciente_am'];
                                                    $Paciente='<b>PACIENTE:</b> '. $PacienteNombre.'<br>';
                                                    $Enfermera='<b>ENF:</b> '.$sql_enf['empleado_nombre'].' '.$sql_enf['empleado_ap'].' '.$sql_enf['empleado_am'];
                                                    $Accion='<ul class="list-inline" style="margin-top: -9px;">
                                                                    <li class="dropdown">
                                                                        <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white btn-mini md-btn-circle">
                                                                            <i class="material-icons i-24">more_vert</i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menu.'</ul>
                                                                    </li>
                                                                </ul>';
                                                }else if($value["cama_status"]=='En Mantenimiento'){
                                                    $Color='red';
                                                    $LimpiezaMantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza / Mantenimiento</a></li>';
                                                    $Accion='<ul class="list-inline">
                                                                    <li class="dropdown">
                                                                        <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                                                            <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$LimpiezaMantenimiento.'</ul>
                                                                    </li>
                                                                </ul>';   
                                                }else if($value["cama_status"]=='En Limpieza'){
                                                    $Color='orange';
                                                    $Menu='<li><a style="line-height:0;padding: 6px 9px;" class="enf-finalizar-mantenimiento pointer" data-title="MANTENIMIENTO" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza</a></li>';
                                                    $Accion='<ul class="list-inline">
                                                                <li class="dropdown">
                                                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                                                        <i class="material-icons i-24">more_vert</i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menu.'</ul>
                                                                </li>
                                                            </ul>';
                                                }

                                $TabModule.='<div class="col-md-4 cols-camas '.$value['cama_display'].'" style="padding: 3px;margin-top:-10px">
                                                    <div class="grid simple  color-white">
                                                        <div class="grid-title sigh-background-secundary">
                                                            <h6 class="no-margin color-white" style="margin-top:-6px!important"><i class="fa fa-window-restore"></i> '.$this->UMAE_AREA.'</h6>
                                                            <div class="card-tools" style="right:2px;top:9px;position:absolute">'.$Accion.'</div>
                                                        </div>
                                                        <div class="grid-body '.$Color.'" style="padding-bottom: 5px;border-top:transparent!important;padding-left:10px;padding-right:10px">
                                                            <h5 class="color-white no-margin semi-bold text-uppercase" style="margin-top:-10px!important;">
                                                                <i class="fa fa-bed " ></i> '.$value['cama_nombre'].'
                                                            </h5>
                                                            <div class="row">
                                                                <div class="col-md-12" >
                                                                    <h6 class="color-white"> 
                                                                        <i class="fa fa-clock-o"></i> '.$value['cama_status'].'
                                                                        <span class="pull-right semi-bold">'.$StatusCama.'</span>
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h6 class="color-white no-margin" style="font-size:11px!important">'.$Paciente.'</h6>
                                                                    <h6 class="color-white  m-t-5" style="font-size:11px!important">'.$Enfermera.'</h6>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>'; 
                                            }
            $TabModule.='                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        $TabModule.='</div>';
        $this->setOutput(array('result_camas'=>$TabModule));
    }
    
    public function AjaxTarjetaIdentificacion() {
        $check= $this->config_mdl->sqlGetDataCondition('sigh_tarjeta_identificacion',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $data=array(
            'ti_enfermedades'=> $this->input->post('ti_enfermedades'),
            'ti_alergias'=> $this->input->post('ti_alergias'),
            'ti_fecha'=> date('Y-m-d'),
            'ti_hora'=> date('H:i'),
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        if(empty($check)){
            $this->config_mdl->sqlInsert('sigh_tarjeta_identificacion',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_tarjeta_identificacion',$data,array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    
    /*NUEVOS CAMBIOS AL MODULO DE OBSERVACIÓN :v*/
    
    public function AjaxCambiarCama() {
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'En Limpieza',
            'cama_ingreso_f'=> '',
            'cama_ingreso_h'=> '',
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=>0
        ),array(
            'cama_id'=>  $this->input->post('cama_id_old')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'En Limpieza',
            'cama_id'=>$this->input->post('cama_id_old')
        ));/**/
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('Y-m-d'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=> $this->input->post('ingreso_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id_new')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Ocupado',
            'cama_id'=>$this->input->post('cama_id_new')
        ));
        $this->config_mdl->sqlUpdate('sigh_observacion',array(
            'observacion_cama'=>  $this->input->post('cama_id_new'),
            'observacion_fac'=> date('Y-m-d'),
            'observacion_hac'=>  date('H:i') 
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_camas_log_all',array(
            'cama_log_fecha'=> date('Y-m-d'),
            'cama_log_hora'=> date('H:i'),
            'cama_log_tipo'=>'Cambio de Cama',
            'cama_log_modulo'=>'Observación',
            'cama_id'=> $this->input->post('cama_id_new'),
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'empleado_id'=> $this->UMAE_USER
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxCambiarEnfermera() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sql)){
            $obs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ))[0];
            $this->config_mdl->sqlInsert('sigh_cambio_enfermera_log',array(
                'cambio_fecha'=> date('Y-m-d'),
                'cambio_hora'=> date('H:i'),
                'cambio_modulo'=>'Observación',
                'cambio_cama'=>$obs['observacion_cama'],
                'empleado_new'=> $sql[0]['empleado_id'],
                'empleado_old'=> $obs['observacion_crea'],
                'empleado_cambio'=> $this->UMAE_USER,
                'ingreso_id'=>$this->input->post('ingreso_id')
            ));
            
            $this->config_mdl->sqlUpdate('sigh_observacion',array(
                'observacion_crea'=>$sql[0]['empleado_id'],
            ),array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
            $this->logAccesos(array('acceso_tipo'=>'Cambio de Enfermeroa Observación','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxAltaPaciente() {
        $this->config_mdl->sqlUpdate('sigh_observacion',array(
            'observacion_alta'=>  $this->input->post('observacion_alta'),
            'observacion_fs'=> date('Y-m-d'),
            'observacion_hs'=>  date('H:i') ,
            'observacion_status_v2'=>'Salida'
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id'),
        ));
        $this->config_mdl->sqlInsert('sigh_doc43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> $this->input->post('observacion_alta'),
            'doc_tipo'=>'Egreso',
            'doc_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'En Limpieza',
            'cama_ingreso_f'=> '',
            'cama_ingreso_h'=> '',
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=>0,
        ),array(
            'cama_id'=> $this->input->post('cama_id'),
            'cama_dh'=>  $this->input->post('ingreso_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'En Limpieza',
            'cama_id'=>$this->input->post('cama_id')
        ));
        $this->config_mdl->sqlInsert('sigh_observacion_log',array(
            'log_fecha'=> date('Y-m-d H:i:s'),
            'log_area'=> $this->UMAE_AREA,
            'log_alta'=> $this->input->post('observacion_alta'),
            'cama_id'=> $this->input->post('cama_id'),
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Observación',
            'ingreso_en_status'=>'Egreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->logAccesos(array('acceso_tipo'=>'Egreso Enfermería Observación','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxObservacionMedico() {
        
        $sqlIngreso= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(!empty($sqlIngreso)){
            $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
            if(empty($sqlObs)){
                if(SiGH_ASISTENTESMEDICAS_OMISION=='No'){
                    if($sqlIngreso[0]['ingreso_date_am']!=''){
                        $this->config_mdl->sqlInsert('sigh_observacion',array(
                            'observacion_date_medico_i'=> date('Y-m-d'),
                            'observacion_time_medico_i'=> date('H:i'),
                            'observacion_medico'=> $this->UMAE_USER,
                            'observacion_medico_status'=>'Ingreso',
                            'ingreso_id'=> $this->input->post('ingreso_id')
                        ));
                        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                            'ingreso_en'=> 'Observación',
                            'ingreso_en_status'=>'Ingreso',
                        ),array(
                            'ingreso_id'=> $this->input->post('ingreso_id')
                        ));
                        $this->setOutput(array('action'=>'Ok'));    
                    }else{
                        $this->setOutput(array('action'=>'Datos NO Capturados por AM'));
                    }    
                }else{
                    $this->config_mdl->sqlInsert('sigh_observacion',array(
                        'observacion_date_medico_i'=> date('Y-m-d'),
                        'observacion_time_medico_i'=> date('H:i'),
                        'observacion_medico'=> $this->UMAE_USER,
                        'observacion_medico_status'=>'Ingreso',
                        'ingreso_id'=> $this->input->post('ingreso_id')
                    ));
                    $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
                        'ingreso_en'=> 'Observación',
                        'ingreso_en_status'=>'Ingreso',
                    ),array(
                        'ingreso_id'=> $this->input->post('ingreso_id')
                    ));
                    $this->setOutput(array('action'=>'Ok'));  
                }
                
                
            }else{
                if($sqlObs[0]['observacion_medico_status']=='Ingreso'){
                    $this->setOutput(array('action'=>'Ingreso'));
                }else if($sqlObs[0]['observacion_medico_status']=='Alta Médico'){
                    $this->setOutput(array('action'=>'Alta Médico'));
                }else{
                    $this->setOutput(array('action'=>'Sin Especificar'));
                }
            }
        }else{
            $this->setOutput(array('action'=>'No Existe'));
        }
        
    }

    
    public function AjaxObservacionMedicoReingreso() {
        $this->config_mdl->sqlUpdate('sigh_observacion',array(
            'observacion_date_medico_i'=> date('Y-m-d'),
            'observacion_time_medico_i'=> date('H:i'),
            'observacion_medico'=> $this->UMAE_USER,
            'observacion_medico_status'=>'Ingreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Observación',
            'ingreso_en_status'=>'Ingreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>'1'));
    }
    public function AjaxObservacionMedicoAlta() {
        $this->config_mdl->sqlUpdate('sigh_observacion',array(
            'observacion_date_medico_e'=> date('Y-m-d'),
            'observacion_time_medico_e'=> date('H:i'),
            'observacion_medico_status'=>'Alta Médico'
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxVerificaMatricula() {
        $sql= $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sql)){
            $info= $this->config_mdl->_get_data_condition('os_triage',array(
                'triage_id'=> $this->input->post('triage_id')
            ))[0];
            $pinfo= $this->config_mdl->_get_data_condition('paciente_info',array(
                'triage_id'=> $this->input->post('triage_id')
            ))[0];
            $this->setOutput(array('accion'=>'1','info'=>$info,'pinfo'=>$pinfo));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxCrearSessionServicio() {
        $this->config_mdl->sqlUpdate('sigh_empleados',array(
            'empleado_servicio'=>$this->input->post('observacion_servicio')
        ),array(
            'empleado_id'=> $this->UMAE_USER
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /*Consultorios por servicio*/
    public function AjaxConsultoriosServicio() {
        $especialidad=$this->config_mdl->sqlGetDataCondition('sigh_consultorios',array(
            'consultorio_especialidad'=>'Si'
        ));
        foreach ($especialidad as $value) {
            $option.='<option value="'.$value['consultorio_id'].';'.$value['consultorio_nombre'].'">'.$value['consultorio_nombre'].'</option>';
        }
        $option.='<option selected value="0;Primer Contacto/Filtro">Primer Contacto/Filtro</option>';
        $this->setOutput(array('option'=>$option));
    }
    /*
     *  _______________________________________________________________________
     * |                                                                       |
     * |                       NUEVAS FUNCIONES                                |
     * |_______________________________________________________________________|
    */
    public function AjaxVerificarAreaEnfermeria() {
        $sqlTriage= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_am,ing.ingreso_time_am, pac.paciente_fn, pac.paciente_sexo FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac 
                                                    WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$this->input->post('ingreso_id'))[0];
        if(SiGH_ASISTENTESMEDICAS_OMISION=='No'){
            if($sqlTriage['ingreso_date_am']!=''){
                if(SiGH_OBSERVACION_ENFERMERIA=='Si'){
                    $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                        'ingreso_id'=> $this->input->post('ingreso_id')
                    ));
                    if(!empty($sqlObs)){
                        if($sqlObs[0]['observacion_status_v2']=='En Espera' || $sqlObs[0]['observacion_status_v2']=='Asignado' || $sqlObs[0]['observacion_status_v2']=='Interconsulta'){
                            if($sqlObs[0]['observacion_cama']!=''){
                                $this->setOutput(array('accion'=>'EL_PACIENTE_YA_TIENE_UNA_CAMA'));
                            }else{
                                $this->setOutput(array('accion'=>'EL_PACIENTE_NO_TIENE_UNA_CAMA'));
                            }
                        }else{
                            $this->setOutput(array('accion'=>'EL_PACIENTE_YA_SE_ENCUENTRA_EN_OBS'));
                        }

                    }else{
                        $this->setOutput(array('accion'=>'AGREGAR_A_OBSERVACION'));
                    }
                }else{
                    $EdadPaciente= Modules::run('Config/ModCalcularEdad',array('fecha'=>$sqlTriage['paciente_fn']));
                    if($EdadPaciente->y<15){
                        $AreaGenero='Pediatría';
                    }else{
                        if($sqlTriage['paciente_sexo']=='MUJER'){
                            $AreaGenero='Adultos Mujeres';
                        }else{
                            $AreaGenero='Adultos Hombres';
                        }
                    }
                    $sqlGeneroArea= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
                        'areas_acceso_mod'=>'Observación',
                        'areas_acceso_nombre'=> $this->UMAE_AREA
                    ))[0];
                    $sqlArea= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
                        'area_id'=>$sqlGeneroArea['areas_acceso_mod_val']
                    ))[0];
                    if($sqlArea['area_genero']==$AreaGenero){
                        $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                            'ingreso_id'=> $this->input->post('ingreso_id')
                        ));
                        if(!empty($sqlObs)){
                            if($sqlObs[0]['observacion_status_v2']=='En Espera' || $sqlObs[0]['observacion_status_v2']=='Asignado' || $sqlObs[0]['observacion_status_v2']=='Interconsulta'){
                                if($sqlObs[0]['observacion_cama']!=''){
                                    $this->setOutput(array('accion'=>'EL_PACIENTE_YA_TIENE_UNA_CAMA'));
                                }else{
                                    $this->setOutput(array('accion'=>'EL_PACIENTE_NO_TIENE_UNA_CAMA'));
                                }
                            }else{
                                $this->setOutput(array('accion'=>'EL_PACIENTE_YA_SE_ENCUENTRA_EN_OBS'));
                            }

                        }else{
                            $this->setOutput(array('accion'=>'AGREGAR_A_OBSERVACION'));
                        }

                    }else{
                        $this->setOutput(array('accion'=>'NO_PERTENECE_AL_AREA'));
                    }

                }    
            }else{
               $this->setOutput(array('accion'=>'NO_INFO_AM'));
            }     
        }else{
            if(SiGH_OBSERVACION_ENFERMERIA=='Si'){
            $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
            if(!empty($sqlObs)){
                if($sqlObs[0]['observacion_status_v2']=='En Espera' || $sqlObs[0]['observacion_status_v2']=='Asignado' || $sqlObs[0]['observacion_status_v2']=='Interconsulta'){
                    if($sqlObs[0]['observacion_cama']!=''){
                        $this->setOutput(array('accion'=>'EL_PACIENTE_YA_TIENE_UNA_CAMA'));
                    }else{
                        $this->setOutput(array('accion'=>'EL_PACIENTE_NO_TIENE_UNA_CAMA'));
                    }
                }else{
                    $this->setOutput(array('accion'=>'EL_PACIENTE_YA_SE_ENCUENTRA_EN_OBS'));
                }

            }else{
                $this->setOutput(array('accion'=>'AGREGAR_A_OBSERVACION'));
            }
        }else{
            $EdadPaciente= Modules::run('Config/ModCalcularEdad',array('fecha'=>$sqlTriage['paciente_fn']));
            if($EdadPaciente->y<15){
                $AreaGenero='Pediatría';
            }else{
                if($sqlTriage['paciente_sexo']=='MUJER'){
                    $AreaGenero='Adultos Mujeres';
                }else{
                    $AreaGenero='Adultos Hombres';
                }
            }
            $sqlGeneroArea= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
                'areas_acceso_mod'=>'Observación',
                'areas_acceso_nombre'=> $this->UMAE_AREA
            ))[0];
            $sqlArea= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
                'area_id'=>$sqlGeneroArea['areas_acceso_mod_val']
            ))[0];
            if($sqlArea['area_genero']==$AreaGenero){
                $sqlObs= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                    'ingreso_id'=> $this->input->post('ingreso_id')
                ));
                if(!empty($sqlObs)){
                    if($sqlObs[0]['observacion_status_v2']=='En Espera' || $sqlObs[0]['observacion_status_v2']=='Asignado' || $sqlObs[0]['observacion_status_v2']=='Interconsulta'){
                        if($sqlObs[0]['observacion_cama']!=''){
                            $this->setOutput(array('accion'=>'EL_PACIENTE_YA_TIENE_UNA_CAMA'));
                        }else{
                            $this->setOutput(array('accion'=>'EL_PACIENTE_NO_TIENE_UNA_CAMA'));
                        }
                    }else{
                        $this->setOutput(array('accion'=>'EL_PACIENTE_YA_SE_ENCUENTRA_EN_OBS'));
                    }

                }else{
                    $this->setOutput(array('accion'=>'AGREGAR_A_OBSERVACION'));
                }

            }else{
                $this->setOutput(array('accion'=>'NO_PERTENECE_AL_AREA'));
            }

        } 
        }
        
    }
    /*INGRESO DEL PACIENTE POR ENFERMERÍA*/
    public function AjaxAgregarPacienteEnfermeria() {
        $data=array(
            'observacion_fe'=> date('Y-m-d'),
            'observacion_he'=> date('H:i:s'), 
            'observacion_area'=> $this->input->post('area_id'),
            'observacion_cama'=> $this->input->post('cama_id'),
            'observacion_crea'=> $this->UMAE_USER,
            'observacion_status_v2'=>'Asignado',
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('Y-m-d'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=> $this->input->post('ingreso_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Ocupado',
            'cama_id'=>$this->input->post('cama_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Observación',
            'ingreso_en_status'=>'Ingreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $sqlIngreso43021= $this->config_mdl->sqlGetDataCondition('sigh_doc43021',array(
            'doc_destino'=>'Observación',
            'doc_tipo'=>'Ingreso',
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        if(empty($sqlIngreso43021)){
            $this->config_mdl->sqlInsert('sigh_doc43021',array(
                'doc_fecha'=> date('Y-m-d'),
                'doc_hora'=> date('H:i:s'),
                'doc_turno'=>Modules::run('Config/ObtenerTurno'),
                'doc_destino'=> 'Observación',
                'doc_tipo'=>'Ingreso',
                'doc_area'=> $this->UMAE_AREA,
                'empleado_id'=> $this->UMAE_USER,
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
        }
        $this->config_mdl->sqlInsert('sigh_observacion',$data);
        
        $this->logAccesos(array('acceso_tipo'=>'Ingreso Enfermería Observación','ingreso_id'=> $this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    /*ASIGNACIÓN DE CAMA POR ENFERMERÍA*/
    public function AjaxAsignarCamaPaciente() {
        $data=array(
            'observacion_fe'=> date('Y-m-d'),
            'observacion_he'=> date('H:i:s'), 
            'observacion_area'=> $this->input->post('area_id'),
            'observacion_cama'=> $this->input->post('cama_id'),
            'observacion_crea'=> $this->UMAE_USER,
            'observacion_status_v2'=>'Asignado',
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('Y-m-d'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=> $this->input->post('ingreso_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Ocupado',
            'cama_id'=>$this->input->post('cama_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_observacion',$data,array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->logAccesos(array('acceso_tipo'=>'Ingreso Enfermería Observación','ingreso_id'=> $this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxObtenerPacienteEnfermeria() {
        $sql= $this->config_mdl->sqlQuery("SELECT pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, ing.ingreso_clasificacion,
                                            cama.cama_nombre, cama.cama_status , obs.observacion_alta
                                            FROM sigh_pacientes AS pac , sigh_pacientes_ingresos AS ing, sigh_camas AS cama, sigh_observacion AS obs WHERE
                                            obs.observacion_cama=cama.cama_id AND ing.ingreso_id=obs.ingreso_id AND
                                            pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$this->input->post('ingreso_id'))[0];
        $this->setOutput($sql);
    }
    public function AjaxReingresoPacienteEnfermeria() {
        $this->config_mdl->sqlDelete('sigh_observacion',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxForzarReingresoPaciente() {
        $sqlObs= $this->config_mdl->sqlQuery("SELECT * FROM sigh_observacion, sigh_camas WHERE
                                        sigh_observacion.observacion_cama=sigh_camas.cama_id AND
                                        sigh_observacion.ingreso_id=".$this->input->post('ingreso_id'))[0];
        if($sqlObs['cama_status']=='Ocupado'){
            $this->config_mdl->sqlUpdate('sigh_camas',array(
                'cama_status'=>'Disponible',
                'cama_ingreso_f'=> date('Y-m-d'),
                'cama_ingreso_h'=> date('H:i'),
                'cama_fh_estatus'=> date('Y-m-d H:i:s'),
                'cama_dh'=> 0
            ),array(
                'cama_id'=>  $sqlObs['observacion_cama']
            ));
            Modules::run('Areas/LogCamas',array(
                'log_estatus'=>'Disponible',
                'cama_id'=>$sqlObs['observacion_cama']
            ));
        }
        $this->config_mdl->sqlDelete('sigh_observacion',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarPacienteObs() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(!empty($sql)){
            if($sql[0]['observacion_cama']!=''){
                $sqlCama=$this->config_mdl->sqlGetDataCondition('sigh_camas',array('cama_id'=>$sql[0]['observacion_cama']))[0];
                if($sqlCama['cama_status']=='Ocupado'){
                    $this->config_mdl->sqlUpdate('sigh_camas',array(
                        'cama_status'=>'Disponible',
                        'cama_ingreso_f'=> date('Y-m-d'),
                        'cama_ingreso_h'=> date('H:i'),
                        'cama_fh_estatus'=> date('Y-m-d H:i:s'),
                        'cama_dh'=>0
                    ),array(
                        'cama_id'=>  $sql[0]['observacion_cama']
                    ));
                    Modules::run('Pisos/Camas/LogCamas',array(
                        'estado_tipo'=>'Disponible',
                        'cama_id'=> $sql[0]['observacion_cama'],
                        'triage_id'=> $this->input->post('triage_id')
                    ));
                }
            }
            $this->config_mdl->sqlInsert('sigh_observacion_delete',array(
                'log_fecha'=> date('Y-m-d H:i:s'),
                'log_area'=> $this->UMAE_AREA,
                'ingreso_id'=> $this->input->post('ingreso_id'),
                'empleado_id'=> $this->UMAE_USER
            ));
            $this->config_mdl->sqlDelete('sigh_observacion',array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxConfirmarDatos() {
        $this->setOutput(array('accion'=>'1'));
    }
}
