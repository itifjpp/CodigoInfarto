<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Medico
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Medico extends Config{
    
    public function index() {
        if(MOD_QUIROFANOS=='Si'){
            $this->load->view('MedicoQuirofano');
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
                $Accion='';
                $ReportarMateriales='';
                if($value["quirofano_status"]=="Disponible"){
                    $StatusCama='blue';
                    $Accion='';
                }else if($value["quirofano_status"]=="Ocupado"){
                    $StatusCama='green';
                    $SQLEnfermero= $this->config_mdl->_get_data_condition('os_empleados',array('empleado_id'=>$sql_paciente[0]['enfermeria_as']))[0];
                    $AQ_AS='<i class="fa fa-clock-o"></i> '.$sql_paciente[0]['qp_f_iq'].' '.$sql_paciente[0]['qp_h_iq'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<i class="fa fa-clock-o"></i> '.$sql_paciente[0]['qp_f_as'].' '.$sql_paciente[0]['qp_h_as'];
                    $Paciente='PACIENTE: '.$sql_paciente[0]['triage_nombre'].'<br>';
                    $Enfermera='ENF: '.$SQLEnfermero['empleado_nombre'].' '.$SQLEnfermero['empleado_apellidos'];
                    
                    $ReportarMateriales='<li><a href="'. base_url().'Quirofano/Medico/ReportarConsumo?folio='.$value['triage_id'].'&quirofano='.$value['quirofano_id'].'" target="_blank"><i class="fa fa-medkit icono-accion"></i> Reportar Consumo</a></li>';
                        
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$ReportarMateriales.'</ul>
                                </li>
                            </ul>';
                }else if($value["quirofano_status"]=="En Limpieza"){
                    $StatusCama='orange';
                    $Accion='';
                }else if($value["quirofano_status"]=="En Mantenimiento"){
                    $StatusCama='red';
                    $Accion='';
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
    public function ReportarConsumo() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_catalogos, abs_sistemas, abs_elementos, abs_rangos, abs_rangos_existencia, os_triage, os_quirofano_consumo WHERE
            abs_catalogos.catalogo_id=abs_sistemas.catalogo_id AND
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_elementos.elemento_id=abs_rangos.elemento_id AND
            abs_rangos_existencia.rango_id=abs_rangos.rango_id AND
            os_quirofano_consumo.existencia_id=abs_rangos_existencia.existencia_id AND
            os_quirofano_consumo.triage_id=os_triage.triage_id AND os_triage.triage_id=".$this->input->get_post('folio'));
        $this->load->view('MedicoQuirofanoConsumo',$sql);
    }
    public function AjaxReportarConsumo() {
        $sql= $this->config_mdl->_get_data_condition('abs_rangos_existencia',array(
            'existencia_id'=> $this->input->post('existencia_id')
        ));
        $sql_check= $this->config_mdl->_get_data_condition('os_quirofano_consumo',array(
            'existencia_id'=> $this->input->post('existencia_id')
        ));
        if(!empty($sql)){
            if(empty($sql_check)){
                $this->config_mdl->_insert('os_quirofano_consumo',array(
                    'consumo_fecha'=> date('d/m/Y'),
                    'consumo_hora'=> date('H:i'),
                    'existencia_id'=> $this->input->post('existencia_id'),
                    'quirofano_id'=> $this->input->post('quirofano_id'),
                    'triage_id'=> $this->input->post('triage_id'),
                    'empleado_id'=> $this->UMAE_USER
                ));
                $this->config_mdl->_update_data('abs_rangos_existencia',array(
                    'existencia_status'=>'Consumido'
                ),array(
                    'existencia_id'=> $this->input->post('existencia_id')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else{
                 $this->setOutput(array('accion'=>'3'));
            }
            
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
}
