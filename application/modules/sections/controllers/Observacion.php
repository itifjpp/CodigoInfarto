<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Observacion
 *
 * @author bienTICS
 */
class Observacion extends MX_Controller{
    public function __construct() {
        parent::__construct();
        error_reporting(1);
        $this->load->model(array('config/config_mdl'));
        date_default_timezone_set('America/Mexico_City');
    }
    public function setOutput($json) {
        $this->output->set_content_type('application/json')->set_output(json_encode($json));
    } 
    public function AdultosHombres() {
        $this->load->view('Observacion/AdultosHombres');
    }
    public function AdultosMujeres() {
        $this->load->view('Observacion/AdultosMujeres');
    }
    public function Pediatria() {
        $this->load->view('Observacion/Pediatria');
    }
     
    public function AjaxCamas() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado' AND  cama_display<=>NULL AND os_areas.area_id=".$this->input->get_post('area')." ORDER BY os_camas.cama_ingreso_f ASC, os_camas.cama_ingreso_h DESC");
        foreach ($sql as $value) {
            $paciente_um= $this->config_mdl->_query('SELECT pum_nss, pum_nss_agregado FROM paciente_info WHERE triage_id ='.$value['cama_dh']);
            $paciente= $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>$value['cama_dh']));
            $Tiempo=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                'Tiempo1'=> date('Y-m-d H:i:s'),
                                                'Tiempo2'=> $value['cama_fh_estatus'],
                                                
                                        ));
            if($Tiempo->d==0 && $Tiempo->h>=12 && $Tiempo->h<18 ){
                $class="color-amarillo";
            }else if($Tiempo->d==0 && $Tiempo->h>=18 ){
                $class="color-naranja";
            }else if($Tiempo->d>0 ){
                $class="red";
            }else{
                $class='';
            }
            if(strlen($paciente[0]['triage_nombre'])>28){
                $font_size='13px';
            }else{
                $font_size='14px';
            }
            $col_md_3.='<div class="col-md-3" data-triage="'.$value['cama_dh'].'" data-cama="'.$value['cama_id'].'" style="margin-top: 5px" >
                                <div class="row" >
                                    <div class="col-md-1 '.$class.'" style="height:85px"></div>
                                    <div class="col-md-4 back-imss" style="height:85px;padding-left:2px">
                                        <h3 style="text-transform: uppercase;font-size:19px;margin-top:10px;text-align:center"><b>'.$value['cama_nombre'].'</b></h3>
                                        <h6 style="font-size:10px;position:absolute;top:62px"><i class="fa fa-clock-o"></i> '.$value['cama_ingreso_f'].' '.$value['cama_ingreso_h'].'</h6>
                                    </div>
                                    <div class="col-md-7 back-imss" style="height:85px;font-size:12px;padding-left:2px;padding-right:2px;width:57%">
                                        <h5 style="font-size:'.$font_size.';text-transform: uppercase;"><b>'.$paciente[0]['triage_nombre_ap'].' '.$paciente[0]['triage_nombre_am'].' '.$paciente[0]['triage_nombre'].'</b></h5>
                                        <h6 style="text-transform: uppercase;font-size:10px;position:absolute;top:48px"><b>N.S.S:</b> '.$paciente_um[0]['pum_nss'].'-'.$paciente_um[0]['pum_nss_agregado'].'</h6>
                                        <h6 style="text-transform: uppercase;font-size:9px;position:absolute;top: 62px;"><i class="fa fa-clock-o"></i> '.$Tiempo->d.' Dias '.$Tiempo->h.' Horas '.$Tiempo->i.' Minutos</h6>
                                    </div>
                                </div>        
                            </div>';
        }
        $this->setOutput(array('col_md_3'=>$col_md_3,'page_reload'=>'0'));
    }
    public function Camas() {
        $this->load->view('Observacion/Camas');
    }
    public function MedicoObservacion(){
        $this->load->view('Observacion/MedicoObservacion');
    }
    public function AjaxMedicoObservacion(){
        $sql= $this->config_mdl->_query("SELECT * FROM os_observacion, os_triage, os_camas, os_areas WHERE
            os_triage.triage_id=os_observacion.triage_id AND
            os_camas.area_id=os_areas.area_id AND
            os_triage.triage_id=os_camas.cama_dh AND 
            os_areas.area_id IN (3,4,5) AND
            os_observacion.observacion_status_v2='En Espera' ORDER BY os_observacion.observacion_fe DESC, os_observacion.observacion_he DESC ");
        foreach ($sql as $value) {
            $paciente= $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>$value['cama_dh']));
            if(strlen($paciente[0]['triage_nombre'])>20){
                $font_size='9.5px';
            }else{
                $font_size='10px';
            }
            $Tiempo=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                'Tiempo1'=> date('d-m-Y').' '. date('H:i'),
                                                'Tiempo2'=> str_replace('/', '-', $value['observacion_fe'].' '.$value['observacion_he']),
                                                
                                        ));
            if($Tiempo->d==0 && $Tiempo->h>=12 && $Tiempo->h<18 ){
                $class="color-amarillo";
            }else if($Tiempo->d==0 && $Tiempo->h>=18 ){
                $class="color-naranja";
            }else if($Tiempo->d>0 ){
                $class="red";
            }else{
                $class='';
            }
            $col_md_3.='<div class="col-md-3" style="margin-top: 5px" >
                                <div class="row" >
                                    <div class="col-md-1 '.Modules::run('Config/ColorClasificacion',array('color'=>$value['triage_color'])).'" style="height:85px"></div>
                                    <div class="col-md-4 back-imss" style="height:85px;padding-left:2px">
                                        <h3 style="text-transform: uppercase;font-size:20px;margin-top:10px;text-align:center"><b>'.$value['cama_nombre'].'</b></h3>
                                        <h6 style="font-size:10px;position:absolute;top:62px"><i class="fa fa-clock-o"></i> '.$value['cama_ingreso_f'].' '.$value['cama_ingreso_h'].'</h6>
                                    </div>
                                    <div class="col-md-7 back-imss" style="height:85px;font-size:12px;padding-left:2px;padding-right:2px;width:57%">
                                        <h5 style="margin-top:4px;font-size:13px;text-transform: uppercase"><b>'.$value['triage_nombre'].' '.$value['triage_nombre_ap'].' '.$value['triage_nombre_am'].'</b></h5>
                                        <h6 style="text-transform: uppercase;font-size:10px;position:absolute;top: 36px"><b>N.S.S:</b> '.$value['triage_paciente_afiliacion'].'</h6>
                                        
                                        <h6 style="text-transform: uppercase;font-size:9px;position:absolute;top: 49px;"><i class="fa fa-clock-o"></i> '.$Tiempo->d.' Dias '.$Tiempo->h.' Horas '.$Tiempo->i.' Minutos</h6>
                                        <h6 style="font-size:10px;position:absolute;top: 62px">'.$value['area_nombre'].'</h6>
                                    </div>
                                </div>        
                            </div>';
        }
        $this->setOutput(array('col_md_3'=>$col_md_3,'page_reload'=>'0'));
    }
    public function ProcedimientoQuirurgico() {
        $this->load->view('Observacion/ProcedimientoQuirurgico');
    }
    public function AjaxProcedimientoQuirurgico(){
        $sql= $this->config_mdl->_query("SELECT * FROM os_observacion, os_observacion_tratamientos, os_triage, os_areas
WHERE 
os_observacion.triage_id=os_triage.triage_id AND
os_observacion.triage_id=os_observacion_tratamientos.triage_id AND
os_observacion.observacion_status_v2='Asignado' AND
os_observacion.observacion_area=os_areas.area_id GROUP BY os_triage.triage_id");
       
        foreach ($sql as $value) {
            $Tiempo=Modules::run('Config/CalcularTiempoTranscurrido',array(
                'Tiempo1'=> date('d-m-Y').' '. date('H:i'),
                'Tiempo2'=> str_replace('/', '-', $value['observacion_fe'].' '.$value['observacion_he']),
            ));
            $CCI= count($this->config_mdl->_query("SELECT * FROM os_observacion_cci WHERE triage_id=".$value['triage_id']));
            $CI= count($this->config_mdl->_query("SELECT * FROM os_observacion_ci WHERE triage_id=".$value['triage_id']));
            $ISQ= count($this->config_mdl->_query("SELECT * FROM os_observacion_isq WHERE triage_id=".$value['triage_id']));
            $CS= count($this->config_mdl->_query("SELECT * FROM os_observacion_cirugiasegura WHERE triage_id=".$value['triage_id']));
            $ST= count($this->config_mdl->_query("SELECT * FROM os_observacion_solicitudtransfucion WHERE triage_id=".$value['triage_id']));
            $Tratamientos=$CCI+$CI+$CS+$ST+$ISQ;
            if($Tratamientos>=5){
                $Protocolo='';
            }else{
                $Protocolo='PROTOCOLO INICIADO';
            }
            if(strlen($value['triage_nombre'])>30){
                $font_size='15px';
            }else{
                $font_size='17px';
            }
            $Cama= $this->config_mdl->_get_data_condition('os_camas',array('cama_id'=>$value['observacion_cama']));
            $col_md_3.='<div class="col-md-3" style="margin-top: 5px" >
                                <div class="row" >
                                    <div class="col-md-1 '.Modules::run('Config/ColorClasificacion',array('color'=>$value['triage_color'])).'" style="height:85px"></div>
                                    <div class="col-md-4 back-imss" style="height:85px;padding-left:2px">
                                        <h3 style="text-transform: uppercase;font-size:18px;margin-top:10px;text-align:center"><b>'.(empty($Cama)? 'No Asignado': $Cama[0]['cama_nombre'] ).'</b></h3>
                                        <h3 style="text-transform: uppercase;font-size:10px;margin-top:12px;text-align:center;"><b>'.$Protocolo.'</b></h3>
                                    </div>
                                    <div class="col-md-7 back-imss" style="height:85px;font-size:12px;padding-left:2px;padding-right:2px;width:57%;">
                                        <h5 style="text-transform: uppercase;margin-top:8px;font-size:'.$font_size.';"><b>'.$value['triage_nombre'].'</b></h5>
                                        
                                        <h6 style="text-transform: uppercase;font-size:9px;position:absolute;top: 49px;"><i class="fa fa-clock-o"></i> '.$Tiempo->d.' Dias '.$Tiempo->h.' Horas '.$Tiempo->i.' Minutos</h6>
                                        <h6 style="font-size:10px;position:absolute;top: 62px">'.$value['area_nombre'].'</h6>
                                    </div>
                                </div>        
                            </div>';            
        }
        $this->setOutput(array('col_md_3'=>$col_md_3,'page_reload'=>'0'));
    }
}
