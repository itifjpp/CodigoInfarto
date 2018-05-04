<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdmisionContinua
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Ortopedia extends Config{
    public function AdmisionContinua() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, or_admision_continua WHERE 
                                                    os_triage.triage_id=or_admision_continua.triage_id AND
                                                    or_admision_continua.empleado_id= ".$this->UMAE_USER);
        $this->load->view('Medico/index',$sql);
    }
    public function AjaxPaciente() {
        $sqlPaciente= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sqlPaciente)){
            if($sqlPaciente[0]['triage_consultorio_nombre']=='Ortopedia-Admisión Continua'){
                $sqlAdmisionContinua= $this->config_mdl->_get_data_condition('or_admision_continua',array(
                    'triage_id'=> $this->input->post('triage_id')
                ));
                if($sqlPaciente[0]['triage_crea_am']!=''){
                    if($sqlAdmisionContinua[0]['ac_ingreso_fecha']==''){
                        $this->setOutput(array('accion'=>'NO_ASIGNADO'));
                    }else{
                        $this->setOutput(array('accion'=>'ASIGNADO'));
                    }
                }else{
                    $this->setOutput(array('accion'=>'NO_AM'));
                }
            }else{
                $this->setOutput(array('accion'=>'NO_ENVIADO'));
            }
        }else{
            $this->setOutput(array('accion'=>'NO_EXISTE'));
        }
    }
    public function AjaxIngresoAC() {
        $this->config_mdl->_update_data('or_admision_continua',array(
            'ac_ingreso_fecha'=> date('Y-m-d'),
            'ac_ingreso_hora'=> date('H:i:s'),
            'empleado_id'=> $this->UMAE_USER
        ),array(
            'triage_id'=>$this->input->post('triage_id')
        ));
        $sqlMax= $this->config_mdl->_get_data_condition('or_admision_continua',array(
            'triage_id'=>$this->input->post('triage_id')
        ))[0]['ac_id'];
        $this->AccesosUsuarios(array('acceso_tipo'=>'Ortopedia Admisión Continua','triage_id'=>$this->input->post('triage_id'),'areas_id'=> $sqlMax));
        $this->setOutput(array('accion'=>'1'));
    }
}
