<?php

/**
 * Description of Terapiaintensiva
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Terapiaintensiva extends Config{
    
    public function Pacientes() {
        $this->load->view('Pacientes/index');
    }
    public function AjaxPacientes() {
        $sql= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            $this->setOutputV2(array('accion'=>'1'));
        }else{
            $this->setOutputV2(array('accion'=>'2'));
        }
    }
}
