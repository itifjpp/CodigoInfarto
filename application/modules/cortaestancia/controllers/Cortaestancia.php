<?php

/**
 * Description of Cortaestancia
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Cortaestancia extends Config{
    public function Enfermeria() {
        $this->load->view('index_enfermeria');
    }
    public function AjaxLoadCamas() {
        $cols='';
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_areas AS areas, sigh_camas AS camas WHERE areas.area_modulo='Corta Estancia' AND areas.area_id=camas.area_id");
        foreach ($sql as $value) {
            $Menu='';
            $Menus='';
            $bgCama='';
            $infoEnfermera='&nbsp;';
            $infoPaciente='&nbsp;';
            if($value['cama_status']=='Disponible'){
                $bgCama='bg-blue';
                $Menu='<button class="md-btn md-fab m-b red waves-effect tip btn-paciente-agregar" data-cama="'.$value['cama_id'].'" data-original-title="Agregar Paciente">
                                <i class="material-icons i-24 color-white">person_add</i>
                            </button>';
            }else if($value['cama_status']=='Ocupado'){
                $bgCama='bg-green';
                $getInformation= $this->config_mdl->sqlQuery("SELECT 
                    pac.paciente_id,pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, emp.empleado_id, emp.empleado_nombre,
                    emp.empleado_ap, emp.empleado_am, ing.ingreso_id ,
                    ce.cortaestancia_date_ac, ce.cortaestancia_time_ac
                    FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_cortaestancia AS ce, sigh_empleados AS emp, sigh_camas AS camas
                    WHERE ing.paciente_id=pac.paciente_id AND ing.ingreso_id=ce.ingreso_id AND
                    ce.cortaestancia_enfermera=emp.empleado_id AND ce.cama_id=camas.cama_id AND camas.cama_dh='".$value['cama_dh']."'")[0];
                
                $infoPaciente='<b>PACIENTE:</b> '.$getInformation['paciente_nombre'].' '.$getInformation['paciente_ap'].' '.$getInformation['paciente_am'].'<br>';
                $infoEnfermera='<b>ENF:</b> '.$getInformation['empleado_nombre'].' '.$getInformation['empleado_ap'].' '.$getInformation['empleado_am'];
                $infoTarejeta= $this->config_mdl->sqlGetDataCondition('sigh_tarjeta_identificacion',array(
                    'ingreso_id'=> $value['cama_dh']
                ))[0];
                $Menus=' <li><a style="line-height:0;padding: 6px 9px;" class="cortaestancia-altapaciente" href="#" data-cama="'.$value['cama_id'].'" data-ingreso="'.$getInformation['ingreso_id'].'"><i class="fa fa-share-square-o sigh-color i-20"></i> Alta Paciente</a></li>';
                $Menus.='<li><a style="line-height:0;padding: 6px 9px;" class="" href="'.  base_url().'Sections/Documentos/Expediente/'.$getInformation['ingreso_id'].'/?tipo=Observación&url=Enfermeria" target="_blank"><i class="fa fa-folder-open-o sigh-color i-20"></i> Ver Expediente</a></li>';    
                $Menus.='<li><a style="line-height:0;padding: 6px 9px;" class="cortaestancia-tarjeta" href="#"  data-ingreso="'.$getInformation['ingreso_id'].'" data-enfermedades="'.$infoTarejeta['ti_enfermedades'].'" data-alergias="'.$infoTarejeta['ti_alergias'].'"><i class="fa fa-address-card-o sigh-color i-20"></i> Tarjeta de Identificación</a></li>';
                $Menus.='<li><a style="line-height:0;padding: 6px 9px;" class="cortaestancia-cambiarcama" href="#"  data-id="'.$getInformation['ingreso_id'].'" data-area="'.$value['area_id'].'" data-cama="'.$value['cama_id'].'"><i class="fa fa-bed sigh-color i-20"></i> Cambiar Cama</a></li>';
                $Menus.='<li><a style="line-height:0;padding: 6px 9px;" class="cortaestancia-cambiarenfermera" href="#"  data-id="'.$getInformation['ingreso_id'].'"><i class="fa fa-user-md sigh-color i-20"></i> Cambiar Enfermer@</a></li>';
                $Menus.='<li><a style="line-height:0;padding: 6px 9px;" class="cortaestancia-imprimirpulsera pointer" data-id="'.$getInformation['ingreso_id'].'"><i class="fa fa-print sigh-color i-20"></i> Imprimir Pulsera</a></li>';

                $Menu='<ul class="list-inline" style="margin-top: -9px;">
                            <li class="dropdown">
                                <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white btn-mini md-btn-circle">
                                    <i class="material-icons i-24">more_vert</i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menus.'</ul>
                            </li>
                        </ul>';
                
            }else if($value['cama_status']=='En Mantenimiento'){
                $bgCama='bg-red';
                $Menus='<li><a class="cortaestancia-end-mantenimiento" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza / Mantenimiento</a></li>';
                $Menu='<ul class="list-inline">
                            <li class="dropdown">
                                <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                    <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menus.'</ul>
                            </li>
                        </ul>'; 
            }else if($value['cama_status']=='En Limpieza'){
                $bgCama='bg-orange';
                $Menus='<li><a class="cortaestancia-end-mantenimiento pointer" data-title="LIMPIEZA" data-id="'.$value['cama_id'].'"><i class="fa fa-wrench icono-accion"></i> Finalizar Limpieza</a></li>';
                $Menu='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="material-icons i-24">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color" style="margin-top: -60px;margin-right: 0px;">'.$Menus.'</ul>
                                </li>
                            </ul>';
            }
            $cols.='<div class="col-md-4 cols-camas " style="padding: 3px;margin-top:-10px">
                            <div class="grid simple  color-white">
                                <div class="grid-title sigh-background-secundary">
                                    <h6 class="no-margin color-white" style="margin-top:-6px!important"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</h6>
                                    <div class="card-tools" style="right:2px;top:9px;position:absolute">'.$Menu.'</div>
                                </div>
                                <div class="grid-body '.$bgCama.'" style="padding-bottom: 5px;border-top:transparent!important;padding-left:10px;padding-right:10px">
                                    <h5 class="color-white no-margin semi-bold text-uppercase" style="margin-top:-10px!important;">
                                        <i class="fa fa-bed "></i> '.$value['cama_nombre'].'
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="color-white"> 
                                                <i class="fa fa-clock-o"></i> '.$value['cama_status'].'
                                                <span class="pull-right semi-bold">'.$value['cama_ingreso_f'].' '.$value['cama_ingreso_h'].'</span>
                                            </h6>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="color-white no-margin text-nowrap text-uppercase" style="font-size:11px!important;">'.$infoPaciente.'</h6>
                                            <h6 class="color-white no-margin text-nowrap text-uppercase" style="font-size:11px!important;">'.$infoEnfermera.'</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        
        $this->setOutput(array('action'=>1,'cols'=>$cols));
    }
    public function AjaxValidarFolio() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_ingresos',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(empty($sql)){
            $this->setOutput(array('action'=>'N° DE INGRESO NO ENCONTRADO'));
        }else{
            $this->setOutput(array('action'=>'N° DE INGRESO ENCONTRADO'));
        }
    }
    public function AjaxValidarIngreso() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_cortaestancia',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        if(!empty($sql)){
            if($sql[0]['cortaestancia_enfermera_es']=='Ingreso'){
                $this->setOutput(array('action'=>'PACIENTE INGRESADO'));
            }else if($sql[0]['cortaestancia_enfermera_es']=='Egreso'){
                $this->setOutput(array('action'=>'PACIENTE EGRESADO'));
            }else{
                $this->setOutput(array('action'=>'ERROR NO ESPECIFICADO'));
            }
        }else{
            $this->setOutput(array('action'=>'NO EXISTE EN CORTAESTANCIA'));
        }
    }
    public function AjaxEliminarPacienteDeCe() {
        $this->config_mdl->sqlDelete('sigh_cortaestancia',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function AjaxIngresoByEnfermeria() {
        $this->config_mdl->sqlInsert('sigh_cortaestancia',array(
            'cortaestancia_date_i'=> date('Y-m-d'),
            'cortaestancia_time_i'=> date('H:i'),
            'cortaestancia_enfermera'=> $this->UMAE_USER,
            'cortaestancia_enfermera_es'=> 'Ingreso',
            'cortaestancia_date_ac'=> date('Y-m-d'),
            'cortaestancia_time_ac'=>  date('H:i'),
            'cama_id'=> $this->input->post('cama_id'),
            'ingreso_id'=> $this->input->post('ingreso_id'), 
        ));
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>'Ocupado',
            'cama_ingreso_f'=> date('Y-m-d'),
            'cama_ingreso_h'=> date('H:i'),
            'cama_fh_estatus'=> date('Y-m-d H:i'),
            'cama_dh'=> $this->input->post('ingreso_id')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Ocupado',
            'cama_id'=>$this->input->post('cama_id')
        ));
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Corta Estancia',
            'ingreso_en_status'=>'Ingreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $sqlIngreso43021= $this->config_mdl->sqlGetDataCondition('sigh_doc43021',array(
            'doc_destino'=>'Corta Estancia',
            'doc_tipo'=>'Ingreso',
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_doc43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> 'Corta Estancia',
            'doc_tipo'=>'Ingreso',
            'doc_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->setOutput(array('action'=>'INGRESO CORRECTO A CORTAESTANCIA'));
    }
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
        $this->config_mdl->sqlUpdate('sigh_cortaestancia',array(
            'cama_id'=>  $this->input->post('cama_id_new'),
            'cortaestancia_date_ac'=> date('Y-m-d'),
            'cortaestancia_time_ac'=>  date('H:i') 
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_camas_log_all',array(
            'cama_log_fecha'=> date('Y-m-d'),
            'cama_log_hora'=> date('H:i'),
            'cama_log_tipo'=>'Cambio de Cama',
            'cama_log_modulo'=>'Corta Estancia',
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
            $cortaestancia= $this->config_mdl->sqlGetDataCondition('sigh_cortaestancia',array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ))[0];
            $this->config_mdl->sqlInsert('sigh_cambio_enfermera_log',array(
                'cambio_fecha'=> date('Y-m-d'),
                'cambio_hora'=> date('H:i'),
                'cambio_modulo'=>'Corta Estancia',
                'cambio_cama'=>$cortaestancia['cama_id'],
                'empleado_new'=> $sql[0]['empleado_id'],
                'empleado_old'=> $cortaestancia['cortaestancia_enfermera'],
                'empleado_cambio'=> $this->UMAE_USER,
                'ingreso_id'=>$this->input->post('ingreso_id')
            ));
            
            $this->config_mdl->sqlUpdate('sigh_cortaestancia',array(
                'cortaestancia_enfermera'=>$sql[0]['empleado_id'],
            ),array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
            $this->logAccesos(array('acceso_tipo'=>'Cambio de Enfermer@ Corta Estancia','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxAltaPaciente() {
        $this->config_mdl->sqlUpdate('sigh_cortaestancia',array(
            'cortaestancia_alta'=>  $this->input->post('cortaestancia_alta'),
            'cortaestancia_date_e'=> date('Y-m-d'),
            'cortaestancia_time_e'=>  date('H:i') ,
            'cortaestancia_enfermera_es'=>'Egreso'
        ),array(
            'ingreso_id'=>  $this->input->post('ingreso_id'),
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
        $this->config_mdl->sqlUpdate('sigh_pacientes_ingresos',array(
            'ingreso_en'=> 'Corta Estancia',
            'ingreso_en_status'=>'Egreso',
        ),array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ));
        $this->config_mdl->sqlInsert('sigh_doc43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> 'Corta Estancia',
            'doc_tipo'=>'Egreso',
            'doc_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ));
        $this->logAccesos(array('acceso_tipo'=>'Egreso Corta Estancia','ingreso_id'=>$this->input->post('ingreso_id'),'areas_id'=>0));
        $this->setOutput(array('accion'=>'1'));
    }
}
