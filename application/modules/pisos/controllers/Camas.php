<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Camas
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Camas extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function GestionCamas() {
        $sql['AreaSesion']= $this->ObtenerArea();
        $sql['Areas']= $this->config_mdl->_query('SELECT  * FROM os_areas WHERE os_areas.area_id>6');
        $this->load->view('Camas/GestionCamas',$sql);
    }
    public function AjaxGestionCamas() {
        if($this->input->post('area')==''){
            if($this->UMAE_AREA=='Urgencias' || $this->UMAE_AREA=='Admisión Hospitalaria' || $this->UMAE_AREA=='Jefa Asistentes Médicas'){
                $Condition="AND os_areas.area_modulo IN('Observación','Choque')";
            }else{
                $Condition="AND os_areas.area_modulo IN('Pisos')";
            }
            $Mantenimiento= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Mantenimiento FROM os_camas, os_areas
                WHERE os_camas.cama_display<=>NULL AND  os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento' $Condition")[0]['Mantenimiento'];
                $Limpieza= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Limpieza FROM os_camas, os_areas
                WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza' $Condition")[0]['Limpieza'];
                $Ocupadas= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS ocupadas FROM os_camas, os_areas
                WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado' $Condition")[0]['ocupadas'];
                $Disponible= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS disponible FROM os_camas, os_areas
                WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible' $Condition")[0]['disponible'];
                $Total= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS total FROM os_camas, os_areas
                WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id $Condition")[0]['total'];
        }else{
            $Mantenimiento= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Mantenimiento FROM os_camas, os_areas
            WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento' AND os_areas.area_id=".$this->input->post('area'))[0]['Mantenimiento'];
            $Limpieza= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Limpieza FROM os_camas, os_areas
            WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza' AND os_areas.area_id=".$this->input->post('area'))[0]['Limpieza'];
            $Ocupadas= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS ocupadas FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado' AND os_areas.area_id=".$this->input->post('area'))[0]['ocupadas'];
            $Disponible= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS disponible FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible' AND os_areas.area_id=".$this->input->post('area'))[0]['disponible'];
            $Total= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS total FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_areas.area_id=".$this->input->post('area'))[0]['total'];
        }
        $this->setOutput(array(
            'Total'=>$Total,
            'Disponibles'=>$Disponible,
            'Ocupados'=>$Ocupadas,
            'Mantenimiento'=>$Mantenimiento,
            'Limpieza'=>$Limpieza
        ));
    }
    public function CamasDetalles() {
        if($this->input->get('tipo')=='Total'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Disponibles'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Ocupados'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado'  AND os_areas.area_id=".$this->input->get('area')." ORDER BY cama_ingreso_f ASC, cama_ingreso_h ASC");
        }if($this->input->get('tipo')=='Mantenimiento'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Limpieza'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.cama_display<=>NULL AND os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza'  AND os_areas.area_id=".$this->input->get('area'));
        }
        $this->load->view('Camas/CamasDetalles',$sql);
    }
    public function DetallePaciente($data) {
        return $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>$data['triage_id']))[0];
    }
    public function ObtenerArea() {
        if($this->UMAE_AREA=='Servicio Cadera'){
            return 8;
        }if($this->UMAE_AREA=='Servicio Femúr y Rodilla'){
            return 11;
        }if($this->UMAE_AREA=='Servicio Fracturas Expuestas'){
            return 12;
        }if($this->UMAE_AREA=='Servcio Pie y Tobillo'){
            return 14;
        }if($this->UMAE_AREA=='Servicio Neurocirugía'){
            return 15;
        }if($this->UMAE_AREA=='Servicio Columna'){
            return 0;
        }if($this->UMAE_AREA=='Servicio CPR'){
            return 17;
        }if($this->UMAE_AREA=='Servicio Maxilofacial'){
            return 18;
        }if($this->UMAE_AREA=='Servicio Quemados'){
            return 19;
        }if($this->UMAE_AREA=='Servicio Pediatría'){
            return 20;
        }if($this->UMAE_AREA=='Servicio Corta Estancia'){
            return 21;
        }if($this->UMAE_AREA=='Servicio Miembro Torácico'){
            return 13;
        }
    }
    public function ObtenerPisos() {
        $sqlPiso= $this->config_mdl->sqlGetDataCondition('os_areas_acceso',array(
            'areas_acceso_mod'=>'Pisos',
            'areas_acceso_nombre'=> $this->UMAE_AREA
        ))[0];
        return $sqlPiso['areas_acceso_mod_val'];
    }
    public function LimpiezaCamas() {
        $sql['Areas']= $this->config_mdl->_get_data('os_areas');
        $this->load->view('Camas/LimpiezaCamas',$sql);
        
        
    }
    public function AjaxLimpiezaCamas() {
        if($this->UMAE_AREA=='Administrador'){
        $Camas=  $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                                            WHERE
                                            os_areas.area_id=os_camas.area_id AND
                                            os_areas.area_id=".$this->input->post('area_id'));
        $AccionCambioGenero='';
        }else{
            $Camas=  $this->config_mdl->_query("SELECT * FROM os_camas, os_pisos, os_pisos_camas, os_areas
                                            WHERE
                                            os_areas.area_id=os_camas.area_id AND
                                            os_pisos_camas.piso_id=os_pisos.piso_id AND
                                            os_pisos_camas.cama_id=os_camas.cama_id AND
                                            os_pisos.piso_id=".$this->ObtenerPisos()." ORDER BY os_camas.cama_id ASC");
        $AccionCambioGenero='hidden';
        }
        if(!empty($Camas)){
            foreach ($Camas as $value) {
                
                $Accion='';
                $Limpieza='';
                $Limpieza_Mantenimiento='';
                $AccionCambioE='';
                $Ingreso='<br>';
                $NombrePaciente='<br>';
                if($value['cama_status']=='Disponible'){
                    $CamaStatus='blue';
                    $Limpieza_Mantenimiento='<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="En Limpieza" >En Limpieza</a></li>';
                    $Limpieza='<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="En Mantenimiento" >En Mantenimiento</a></li>';
                    
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.' '.$Limpieza.'</ul>
                                </li>
                            </ul>';
                    $area=$value['cama_status'];
                }else if($value['cama_status']=='En Mantenimiento'){
                    $CamaStatus='red';
                    $Limpieza_Mantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'" data-accion="Disponible">Finalizar Limpieza / Mantenimiento</a></li>';
                    $area=$value['cama_status'];
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.'</ul>
                                </li>
                            </ul>';
                }else if($value['cama_status']=='En Limpieza'){
                    $CamaStatus='orange';
                    $Limpieza_Mantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'" data-accion="Disponible">Finalizar Limpieza / Mantenimiento</a></li>';
                    $area=$value['cama_status'];
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.'</ul>
                                </li>
                            </ul>';
                }else if($value['cama_status']=='Descompuesta'){
                    $CamaStatus='orange';
                    $Limpieza_Mantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'" data-accion="Ocupado">Finalizar Limpieza / Mantenimiento</a></li>';
                    $area=$value['cama_status'];
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.'</ul>
                                </li>
                            </ul>';
                    
                }else if($value['cama_status']=='Ocupado'){
                    $CamaStatus='green';
                    $Paciente=$this->config_mdl->_get_data_condition('os_triage',array(
                        'triage_id'=> $value['cama_dh']
                    ))[0];
                    if($value['area_id']==3 || $value['area_id']==4 || $value['area_id']==5){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_observacion',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['observacion_fac'].' '.$PacienteIngreso['observacion_hac'];
                    }else if($value['area_id']==6){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['ap_f_ingreso'].' '.$PacienteIngreso['ap_h_ingreso'];
                    }else {
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_choque_camas',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['choque_cama_fe'].' '.$PacienteIngreso['choque_cama_he'];
                    }
                    if(strlen($Paciente['triage_nombre'])>30){
                        $NombrePaciente='<b>PACIENTE: </b>'. substr($Paciente['triage_nombre'], 0,30).'...';
                    }else{
                        $NombrePaciente='<b>PACIENTE: </b>'.$Paciente['triage_nombre'];
                    }                  
                }else if($value['cama_status']=='En Espera'){
                    $AccionCambioE='hidden';
                    $CamaStatus='blue-grey-700';                    
                    $Paciente=$this->config_mdl->_get_data_condition('os_triage',array(
                        'triage_id'=> $value['cama_dh']
                    ))[0];
                    if($value['area_id']==3 || $value['area_id']==4 || $value['area_id']==5){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_observacion',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['observacion_fac'].' '.$PacienteIngreso['observacion_hac'];
                    }else if($value['area_id']==6){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['ap_f_ingreso'].' '.$PacienteIngreso['ap_h_ingreso'];
                    }else {
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_choque_camas',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['choque_cama_fe'].' '.$PacienteIngreso['choque_cama_he'];
                    }
                    
                    if(strlen($Paciente['triage_nombre'])>30){
                        $NombrePaciente='<b>PACIENTE: </b>'. substr($Paciente['triage_nombre'], 0,30).'...';
                    }else{
                        $NombrePaciente='<b>PACIENTE: </b>'.$Paciente['triage_nombre'];
                    }
                      
                }
                if($value['cama_genero']=='Mujer'){
                    $CamaGenero='<i class="fa fa-female"></i>';
                }else{
                    $CamaGenero='<i class="fa fa-male"></i>';
                }
                $col_md_3.='<div class="col-md-4 cols-camas" >
                                
                                <div class="card '.$CamaStatus.' color-white" style="border-radius:3px">
                                    <div class="row" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                        <div class="col-md-12" "><b style="text-transform:uppercase;font-size:10px;margin-left:-14px"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</b></div>
                                    </div>
                                    <div class="card-heading" style="margin-top:-10px">
                                        <h5 class="font-thin color-white" style="font-size:19px!important;margin-left: -10px;margin-top: 0px;text-transform: uppercase">
                                            <i class="fa fa-bed " ></i> <b>'.$value['cama_nombre'].'</b>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12" style="margin-left: -10px;margin-top:-9px">
                                                <small style="opacity: 1;font-size: 10px"> 
                                                    <b class="text-left"><i class="fa fa-clock-o"></i> '.$value['cama_status'].'</b>&nbsp;&nbsp;&nbsp;
                                                    <b class="text-left"><i class="fa fa-window-maximize"></i> '.$value['area_tipo'].'</b>&nbsp;&nbsp;&nbsp;
                                                    <b class="text-left">'.$CamaGenero.' '.$value['cama_genero'].' <i class="fa fa-pencil cambiar-genero-cama pointer '.$AccionCambioGenero.'" data-cama="'.$value['cama_id'].'"></i></b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-tools" style="right:2px;top:2px">'.$Accion.'</div>
                                    <div class="card-divider" style="margin-top:-10px"></div>
                                    <div class="card-body" style="margin-top:-20px;margin-left:-11px">
                                        <span style="font-size:10px"> '.$NombrePaciente.' '.$Ingreso.'</span>
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
    public function AjaxCambiarGeneroCama() {
        $this->config_mdl->_update_data('os_camas',array(
            'cama_genero'=> $this->input->post('cama_genero')
        ),array(
            'cama_id'=> $this->input->post('cama_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxLimpiezaMantenimientoCama() {
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=> $this->input->post('accion')
        ),array(
            'cama_id'=> $this->input->post('id')
        ));
        Modules::run('Pisos/Camas/LogCamas',array(
            'estado_tipo'=>$this->input->post('accion'),
            'cama_id'=> $this->input->post('id'),
            'triage_id'=> 0
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>$this->input->post('accion'),
            'cama_id'=>$this->input->post('id'),
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function IngresoPaciente($data) {
        $paciente=$data['paciente'];
        if($data['area']=="3" || $data['area']=="4" || $data['area']=="5"){
            $info= $this->config_mdl->_query("SELECT * FROM os_observacion WHERE os_observacion.triage_id=$paciente")[0];
            return $info['observacion_fac'].' '.$info['observacion_hac'];
        }else{
            $info= $this->config_mdl->_query("SELECT * FROM os_areas_pacientes WHERE os_areas_pacientes.triage_id=$paciente")[0];
            return $info['ap_f_ingreso'].' '.$info['ap_h_ingreso'];
        }
    }
    public function VisorCamas(){
        $this->load->view('Camas/VisorCamas');
    }
    public function AjaxVisorCamas() {
        if($this->UMAE_AREA=='Administrador'){
            $AccionCambioGenero='';
        }else{ 
            $AccionCambioGenero='hidden';
        }
        $TOTAL_CD= count($this->config_mdl->_get_data_condition('os_camas',array('cama_status'=>'Disponible')));
        $TOTAL_CO= count($this->config_mdl->_get_data_condition('os_camas',array('cama_status'=>'Ocupado')));
        $TOTAL_CM= count($this->config_mdl->_get_data_condition('os_camas',array('cama_status'=>'En Mantenimiento')));
        $TOTAL_CL= count($this->config_mdl->_get_data_condition('os_camas',array('cama_status'=>'En Limpieza')));
        $TOTAL_CDES= count($this->config_mdl->_get_data_condition('os_camas',array('cama_status'=>'En Espera')));
        $Camas=  $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                                            WHERE os_areas.area_id=os_camas.area_id ORDER BY os_areas.area_id ASC, os_camas.cama_id ASC");
        if(!empty($Camas)){
            foreach ($Camas as $value) {
                
                $Accion='';
                $Limpieza='';
                $Limpieza_Mantenimiento='';
                $AccionCambioE='';
                $Ingreso='<br>';
                $NombrePaciente='<br>';
                if($value['cama_status']=='Disponible'){
                    $CamaStatus='blue';
                    $Limpieza_Mantenimiento='<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="En Limpieza" >En Limpieza</a></li>';
                    $Limpieza='<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="En Mantenimiento" >En Mantenimiento</a></li>';
                    
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.' '.$Limpieza.'</ul>
                                </li>
                            </ul>';
                    $area=$value['cama_status'];
                }else if($value['cama_status']=='En Mantenimiento'){
                    $CamaStatus='red';
                    $Limpieza_Mantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'" data-accion="Disponible">Finalizar Limpieza / Mantenimiento</a></li>';
                    $area=$value['cama_status'];
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.'</ul>
                                </li>
                            </ul>';
                }else if($value['cama_status']=='En Limpieza'){
                    $CamaStatus='orange';
                    $Limpieza_Mantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'" data-accion="Disponible">Finalizar Limpieza / Mantenimiento</a></li>';
                    $area=$value['cama_status'];
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.'</ul>
                                </li>
                            </ul>';
                }else if($value['cama_status']=='Descompuesta'){
                    $CamaStatus='orange';
                    $Limpieza_Mantenimiento='<li><a class="finalizar-mantenimiento" data-id="'.$value['cama_id'].'" data-accion="Ocupado">Finalizar Limpieza / Mantenimiento</a></li>';
                    $area=$value['cama_status'];
                    $Accion='<ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-fab bg-white md-btn-circle waves-effect" aria-expanded="false">
                                        <i class="mdi-navigation-more-vert text-md" style="color:black"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$Limpieza_Mantenimiento.'</ul>
                                </li>
                            </ul>';
                    
                }else if($value['cama_status']=='Ocupado'){
                    $CamaStatus='green';
                    $Paciente=$this->config_mdl->_get_data_condition('os_triage',array(
                        'triage_id'=> $value['cama_dh']
                    ))[0];
                    if($value['area_id']==3 || $value['area_id']==4 || $value['area_id']==5){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_observacion',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['observacion_fac'].' '.$PacienteIngreso['observacion_hac'];
                    }else if($value['area_id']==6){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['ap_f_ingreso'].' '.$PacienteIngreso['ap_h_ingreso'];
                    }else {
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_choque_camas',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['choque_cama_fe'].' '.$PacienteIngreso['choque_cama_he'];
                    }
                    if(strlen($Paciente['triage_nombre'])>30){
                        $NombrePaciente='<b>PACIENTE: </b>'. substr($Paciente['triage_nombre'], 0,30).'...';
                    }else{
                        $NombrePaciente='<b>PACIENTE: </b>'.$Paciente['triage_nombre'];
                    }                  
                }else if($value['cama_status']=='En Espera'){
                    $AccionCambioE='hidden';
                    $CamaStatus='blue-grey-700';                    
                    $Paciente=$this->config_mdl->_get_data_condition('os_triage',array(
                        'triage_id'=> $value['cama_dh']
                    ))[0];
                    if($value['area_id']==3 || $value['area_id']==4 || $value['area_id']==5){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_observacion',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['observacion_fac'].' '.$PacienteIngreso['observacion_hac'];
                    }else if($value['area_id']==6){
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['ap_f_ingreso'].' '.$PacienteIngreso['ap_h_ingreso'];
                    }else {
                        $PacienteIngreso= $this->config_mdl->_get_data_condition('os_choque_camas',array(
                            'triage_id'=>$value['cama_dh']
                        ))[0];
                        $Ingreso='<br><b>INGRESO: </b>'.$PacienteIngreso['choque_cama_fe'].' '.$PacienteIngreso['choque_cama_he'];
                    }
                    
                    if(strlen($Paciente['triage_nombre'])>30){
                        $NombrePaciente='<b>PACIENTE: </b>'. substr($Paciente['triage_nombre'], 0,30).'...';
                    }else{
                        $NombrePaciente='<b>PACIENTE: </b>'.$Paciente['triage_nombre'];
                    }
                      
                }
                if($value['cama_genero']=='Mujer'){
                    $CamaGenero='<i class="fa fa-female"></i>';
                }else{
                    $CamaGenero='<i class="fa fa-male"></i>';
                }
                $col_md_3.='<div class="col-md-4 cols-camas" >
                                
                                <div class="card '.$CamaStatus.' color-white" style="border-radius:3px">
                                    <div class="row" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                        <div class="col-md-12" "><b style="text-transform:uppercase;font-size:10px;margin-left:-14px"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</b></div>
                                    </div>
                                    <div class="card-heading" style="margin-top:-10px">
                                        <h5 class="font-thin color-white" style="font-size:19px!important;margin-left: -10px;margin-top: 0px;text-transform: uppercase">
                                            <i class="fa fa-bed " ></i> <b>'.$value['cama_nombre'].'</b>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-12" style="margin-left: -10px;margin-top:-9px">
                                                <small style="opacity: 1;font-size: 10px"> 
                                                    <b class="text-left"><i class="fa fa-clock-o"></i> '.$value['cama_status'].'</b>&nbsp;&nbsp;&nbsp;
                                                    <b class="text-left"><i class="fa fa-window-maximize"></i> '.$value['area_tipo'].'</b>&nbsp;&nbsp;&nbsp;
                                                    <b class="text-left">'.$CamaGenero.' '.$value['cama_genero'].' <i class="fa fa-pencil cambiar-genero-cama pointer '.$AccionCambioGenero.'" data-cama="'.$value['cama_id'].'"></i></b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-tools" style="right:2px;top:2px">'.$Accion.'</div>
                                    <div class="card-divider" style="margin-top:-10px"></div>
                                    <div class="card-body" style="margin-top:-20px;margin-left:-11px">
                                        <span style="font-size:10px"> '.$NombrePaciente.' '.$Ingreso.'</span>
                                    </div>
                                </div>
                            </div>';
                $col_md_3.='';
            }
        }else{
            $col_md_3='NO_HAY_CAMAS';
        }
        $this->setOutput(array(
            'result_camas'=>$col_md_3,
            'TOTAL_CD'=>$TOTAL_CD,
            'TOTAL_CO'=>$TOTAL_CO,
            'TOTAL_CM'=>$TOTAL_CM,
            'TOTAL_CL'=>$TOTAL_CL,
            'TOTAL_CDES'=>$TOTAL_CDES
        ));
    }
    public function Indicador() {
        $this->load->view('Camas/Indicador');
    }
    public function AjaxIndicador() {
        $by_fecha_inicio= $this->input->post('by_fecha_inicio');
        $by_fecha_fin= $this->input->post('by_fecha_fin');
        $by_hora_fecha= $this->input->post('by_hora_fecha');
        $by_hora_inicio= $this->input->post('by_hora_inicio');
        $by_hora_fin= $this->input->post('by_hora_fin');
        if($this->input->post('TipoBusqueda')=='POR_FECHA'){
            $SQL_INGRESO= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_ingreso BETWEEN '$by_fecha_inicio' AND '$by_fecha_fin'");
            $SQL_ALTAS= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_salida BETWEEN '$by_fecha_inicio' AND '$by_fecha_fin'");
        }else{
            $SQL_INGRESO= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_ingreso='$by_hora_fecha' AND 
                                                os_areas_pacientes.ap_h_ingreso BETWEEN '$by_hora_inicio' AND '$by_hora_fin'");
            $SQL_ALTAS= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_salida='$by_hora_fecha' AND 
                                                os_areas_pacientes.ap_h_salida BETWEEN '$by_hora_inicio' AND '$by_hora_fin'");
        }
        
        $this->setOutput(array(
            'INGRESOS'=> count($SQL_INGRESO),
            'ALTAS'=> count($SQL_ALTAS)
        ));
    }
    public function IndicadorDetalles() {
        $by_fecha_inicio= $this->input->get_post('by_fecha_inicio');
        $by_fecha_fin= $this->input->get_post('by_fecha_fin');
        $by_hora_fecha= $this->input->get_post('by_hora_fecha');
        $by_hora_inicio= $this->input->get_post('by_hora_inicio');
        $by_hora_fin= $this->input->get_post('by_hora_fin');
        if($this->input->get_post('TipoBusqueda')=='POR_FECHA'){
            if($this->input->get_post('TIPO_ACCION')=='INGRESO'){
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_ingreso BETWEEN '$by_fecha_inicio' AND '$by_fecha_fin'");
            }else{
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_salida BETWEEN '$by_fecha_inicio' AND '$by_fecha_fin'");
            }
            
            
        }else{
            if($this->input->get_post('TIPO_ACCION')=='INGRESO'){
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_ingreso='$by_hora_fecha' AND 
                                                os_areas_pacientes.ap_h_ingreso BETWEEN '$by_hora_inicio' AND '$by_hora_fin'");
            }else{
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_salida='$by_hora_fecha' AND 
                                                os_areas_pacientes.ap_h_salida BETWEEN '$by_hora_inicio' AND '$by_hora_fin'");
            }
        }   
        $this->load->view('Camas/IndicadorDetalles',$sql);
    }    
    public function LogCamas($data) {
        $this->config_mdl->sqlInsert('sigh_camas_estados',array(
            'estado_tipo'=>$data['estado_tipo'],
            'estado_fecha'=> date('d/m/Y'),
            'estado_hora'=> date('H:i'),
            'cama_id'=>$data['cama_id'],
            'empledo_id'=> $this->UMAE_USER,
            'ingreso_id'=>$data['ingreso_id']
        ));
    }
    public function EstatusCamas() {
        $this->load->view('Camas/EstatusCamas');
    }
    public function AjaxEstatusCamas() {
        $sql=  $this->config_mdl->_query("SELECT * FROM os_camas, os_pisos, os_pisos_camas, os_areas
            WHERE
            os_areas.area_id=os_camas.area_id AND
            os_pisos_camas.piso_id=os_pisos.piso_id AND
            os_pisos_camas.cama_id=os_camas.cama_id AND
            os_pisos.piso_id=".$this->ObtenerPisos()." ORDER BY os_camas.cama_id ASC");
        foreach ($sql as $value) {

            $Accion='';
            $Limpieza='';
            $Limpieza_Mantenimiento='';
            $AccionCambioE='';
            $Ingreso='<br>';
            $NombrePaciente='<br>';
            if($value['cama_status']=='Disponible'){
                $CamaStatus='blue';
                
            }else if($value['cama_status']=='En Mantenimiento'){
                $CamaStatus='red';
  
            }else if($value['cama_status']=='En Limpieza'){
                $CamaStatus='orange';
            }else if($value['cama_status']=='Descompuesta'){
                $CamaStatus='orange';

            }else if($value['cama_status']=='Ocupado'){
                $CamaStatus='green';
               
            }else if($value['cama_status']=='En Espera'){
                $CamaStatus='blue-grey-700';                    

            }
            if($value['cama_fh_estatus']!=''){
                $TT= Modules::run('Config/CalcularTiempoTranscurrido',array(
                    'Tiempo1'=>$value['cama_fh_estatus'],
                    'Tiempo2'=> date('Y-m-d H:i:s')
                ));
                $_TT=$TT->h.' Horas '.$TT->i.' Min '.$TT->s.' Seg';
            }else{
                $_TT='No se puede determinar';
            }
            $colCamas.='<div class="col-md-4 cols-camas" >

                            <div class="card '.$CamaStatus.' color-white" style="border-radius:3px">
                                <div class="row" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                    <div class="col-md-12" "><b style="text-transform:uppercase;font-size:10px;margin-left:-14px"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</b></div>
                                </div>
                                <div class="card-heading" style="margin-top:-10px">
                                    <h5 class="font-thin color-white" style="font-size:19px!important;margin-left: -10px;margin-top: 0px;text-transform: uppercase">
                                        <i class="fa fa-bed " ></i> <b>'.$value['cama_nombre'].'</b>
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-left: -10px;margin-top:-9px">
                                            <small style="opacity: 1;font-size: 10px"> 
                                                <b class="text-left"><i class="fa fa-clock-o"></i> '.$value['cama_status'].'</b>&nbsp;&nbsp;&nbsp;
                                                <b class="text-left"><i class="fa fa-window-maximize"></i> '.$value['piso_nombre'].'</b>&nbsp;&nbsp;&nbsp;
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-tools" style="right:2px;top:2px">'.$Accion.'</div>
                                <div class="card-body" style="margin-top:-50px;margin-left:-11px;padding: 4px 24px;">
                                    <span style="font-size:10px"> '.$NombrePaciente.' '.$Ingreso.'</span>
                                    <p style="font-size:10px"><b>Tiempo Transcurrido:</b> '.$_TT.'</p>
                                </div>
                            </div>
                        </div>';
            $colCamas.='';
        }
        $this->setOutput(array('colCamas'=>$colCamas));
    }
    public function LogPisos($data) {
        $this->config_mdl->sqlInsert('sigh_pisos_log',array(
            'log_fecha'=> date('Y-m-d'),
            'log_hora'=>date('H:i:s'),
            'log_turno'=> Modules::run('Config/ObtenerTurno'),
            'log_tipo'=>$data['log_tipo'],
            'log_obs'=>$data['log_obs'],
            'log_alta'=>$data['log_alta'],
            'log_area'=> $this->UMAE_AREA,
            'cama_id'=>$data['cama_id'],
            'ingreso_id'=>$data['ingreso_id'],
            'empleado_id'=> $this->UMAE_USER
        ));
    }
}
