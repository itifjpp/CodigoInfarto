<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Enfermeria
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Enfermeria extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_quirofanos_pacientes WHERE os_quirofanos_pacientes.triage_id=os_triage.triage_id AND os_quirofanos_pacientes.qp_status!='Egreso de Quirófano';");
        if(MOD_QUIROFANOS=='Si'){
            $this->load->view('EnfermeriaQuirofano',$sql);
        }else{
            $this->ModuleNotAvailable();
        }
        
    }
    public function AjaxBuscarPaciente() {
        $sql= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            $sqlQuirofano= $this->config_mdl->_get_data_condition('os_quirofanos_pacientes',array(
                'triage_id'=> $this->input->post('triage_id')
            ));
            if(empty($sqlQuirofano)){
                $this->config_mdl->_insert('os_quirofanos_pacientes',array(
                    'qp_status'=>'Ingreso a Quirofano',
                    'qp_iq_f'=> date('Y-m-d'),
                    'qp_iq_h'=> date('H:i:s'),
                    'enfermeria_iq'=> $this->UMAE_USER,
                    'triage_id'=>$this->input->post('triage_id')
                ));
                $sqlQuirofanoID= $this->config_mdl->_get_last_id('os_quirofanos_pacientes','qp_id');
                $this->AccesosUsuarios(array('acceso_tipo'=>'Ingreso a Quirófano','triage_id'=>$this->input->post('triage_id'),'areas_id'=> $sqlQuirofanoID));
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            $this->setOutput(array('accion'=>'0'));
        }
    }
    public function Paciente($Paciente) {
        $sql['info']= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $Paciente
        ))[0];
        $sql['quirofono']= $this->config_mdl->_get_data_condition('os_quirofanos_pacientes',array(
            'triage_id'=> $Paciente
        ))[0];
        $sql['sala']= $this->config_mdl->_get_data_condition('os_quirofanos',array(
            'triage_id'=> $Paciente
        ))[0];
        $this->load->view('EnfermeriaPacientes',$sql);
    }
    
    public function AjaxSalas() {
        $sqlSalas=$this->config_mdl->_get_data_condition('os_quirofanos',array(
            'quirofano_status'=>'Disponible'
        ));
        if(!empty($sqlSalas)){
            foreach ($sqlSalas as $value) {
                $option.='<option value="'.$value['quirofano_id'].'">'.$value['quirofano_nombre'].'</option>';
            }
        }else{
            $option='NO_HAY_SALAS';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxIngresoSala() {
        $this->config_mdl->_update_data('os_quirofanos',array(
            'quirofano_status'=>'Ocupado',
            'triage_id'=> $this->input->post('triage_id')
        ),array(
            'quirofano_id'=> $this->input->post('quirofano_id')
        ));
        $this->config_mdl->_update_data('os_quirofanos_pacientes',array(
            'qp_status'=>'Ingreso a Sala',
            'qp_as_f'=> $this->input->post('FechaValue'),
            'qp_as_h'=> $this->input->post('HoraValue'),
            'quirofano_id'=> $this->input->post('quirofano_id'),
            'enfermeria_as'=> $this->UMAE_USER
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $sqlQuirofanoID= $this->config_mdl->_get_data_condition('os_quirofanos_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ))[0];
        $this->AccesosUsuarios(array('acceso_tipo'=>'Ingreso a Sala Quirófano','triage_id'=>$this->input->post('triage_id'),'areas_id'=> $sqlQuirofanoID['qp_id']));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxAccionesEnfermeria() {
        $this->config_mdl->_update_data('os_quirofanos_pacientes',array(
            'qp_status'=>$this->input->post('AccionTipo'),
            $this->input->post('Fecha')=> $this->input->post('FechaValue'),
            $this->input->post('Hora')=> $this->input->post('HoraValue'),
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if($this->input->post('AccionTipo')=='Termina Procedimiento Quirófano'){
            $sqlQuirofanoPaciente= $this->config_mdl->_get_data_condition('os_quirofanos_pacientes',array(
                'qp_id'=> $this->input->post('qp_id')
            ))[0];
            $this->config_mdl->_update_data('os_quirofanos',array(
                'quirofano_status'=>'En Limpieza',
                'triage_id'=> 0
            ),array(
                'quirofano_id'=> $sqlQuirofanoPaciente['quirofano_id']
            ));
        }
        $this->AccesosUsuarios(array('acceso_tipo'=>$this->input->post('AccionTipo'),'triage_id'=>$this->input->post('triage_id'),'areas_id'=> $this->input->post('qp_id')));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Salas() {
        if(MOD_QUIROFANOS=='Si'){
            $this->load->view('EnfermeriaQuirofanoSalas');
        }else{
            $this->ModuleNotAvailable();
        }  
    }
    public function AjaxQuirofanos() {
        $Camas=  $this->config_mdl->_query("SELECT * FROM os_quirofanos");
        if(!empty($Camas)){
            foreach ($Camas as $value) {
                $sql_paciente=  $this->config_mdl->_query("SELECT * FROM os_quirofanos_pacientes, os_triage, os_quirofanos
                                                            WHERE
                                                            os_quirofanos_pacientes.triage_id=os_triage.triage_id AND
                                                            os_quirofanos_pacientes.quirofano_id=os_quirofanos.quirofano_id AND
                                                            os_triage.triage_id=".$value['triage_id']);
                $Paciente='<br>';
                $Enfermera='<br>';
                $AQ_AS='<br>';
                $LimpiezaMantenimiento='';
                $Accion='';
                $AltaPaciente='';
                $CambiarCama='';
                if($value["quirofano_status"]=="Disponible"){
                    $StatusCama='blue';
                }else if($value["quirofano_status"]=="Ocupado"){
                    $StatusCama='green';
                    $SQLEnfermero= $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>$sql_paciente[0]['enfermeria_as']))[0];
                    $AQ_AS='<i class="fa fa-clock-o"></i> '.$sql_paciente[0]['qp_iq_f'].' '.$sql_paciente[0]['qp_iq_h'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<i class="fa fa-clock-o"></i> '.$sql_paciente[0]['qp_as_f'].' '.$sql_paciente[0]['qp_as_h'];
                    $Paciente='PACIENTE: '.$sql_paciente[0]['triage_nombre'].'<br>';
                    $Enfermera='ENF: '.$SQLEnfermero['empleado_nombre'].' '.$SQLEnfermero['empleado_apellidos'];
                }else if($value["quirofano_status"]=="En Limpieza"){
                    $StatusCama='orange';
                    $LimpiezaMantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['quirofano_id'].'">Finalizar Limpieza / Mantenimiento</a></li>';
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$LimpiezaMantenimiento.'</ul>
                                </li>
                            </ul>';
                }else if($value["quirofano_status"]=="En Mantenimiento"){
                    $StatusCama='red';
                    $LimpiezaMantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['quirofano_id'].'">Finalizar Limpieza / Mantenimiento</a></li>';
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$LimpiezaMantenimiento.'</ul>
                                </li>
                            </ul>';
                }
                $col_md_3.='<div class="col-md-4 cols-camas" style="padding: 3px;margin-top:-10px">
                                    <div class="card '.$StatusCama.' color-white">
                                        <div class="row" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                            <div class="col-md-12" style="padding-left:0px;"><b style="text-transform:uppercase;font-size:18px">
                                                <i class="fa fa-medkit " ></i> <b>'.$value['quirofano_nombre'].'</b>
                                            </div>
                                        </div>
                                        <div class="card-heading" >
                                            <div class="row" style="margin-top: -20px;">
                                                <div class="col-md-8" style="margin-left: -14px;">
                                                    <small style="opacity: 1;font-size: 11px"> 
                                                        <i class="fa fa-clock-o"></i> '.$value['quirofano_status'].'
                                                    </small>
                                                </div>
                                                <div class="col-md-4" >
                                                    <small style="opacity: 1;font-size: 11px;position:absolute;top: 0px;right: 0px"> 
                                                        '.$sql_paciente[0]['qp_f_entrada'].' '.$sql_paciente[0]['qp_h_entrada'].'
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-tools" style="right:2px;top:2px">'.$Accion.'</div>
                                        <div class="card-divider" style="margin-top:-10px"></div>
                                        <div class="card-body" style="margin-top:-20px;margin-left: -14px;">
                                            <p style="font-size:9px;;margin-bottom: 5px;margin-top:3px">'.$AQ_AS.'</p>
                                            <p style="font-size:9px;margin-bottom: 5px;">'.$Paciente.'</p>
                                            <p style="font-size:9px;margin-bottom: -13px;">'.$Enfermera.'</p>
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
    
    public function AjaxEgresoPaciente() {
        $this->config_mdl->_update_data('os_quirofanos_pacientes',array(
            'qp_eq_f'=> date('Y-m-d'),
            'qp_eq_h'=>  date('H:i:s') ,
            'qp_alta'=> $this->input->post('qp_alta'),
            'qp_status'=>'Egreso de Quirófano'
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_insert('os_quirofano_egreso',array(
            'egreso_f'=> date('Y-m-d'),
            'egreso_h'=> date('H:i:s'),
            'egreso_tipo'=>'Alta de Quirófano',
            'egreso_destino'=> $this->input->post('qp_alta'),
            'quirofano_id'=> $this->input->post('quirofano_id'),
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Egreso de Quirófano','triage_id'=>$this->input->post('triage_id'),'areas_id'=> $this->input->post('qp_id')));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxFinalizarLimpiezaMantenimiento() {
        $this->config_mdl->_update_data('os_quirofanos',array(
            'quirofano_status'=>'Disponible',
            'triage_id'=>0
        ),array(
            'quirofano_id'=> $this->input->post('id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
