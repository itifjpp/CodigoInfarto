<?php

/**
 * Description of Medico
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Medico extends Config{
    public function index() {
        $this->load->view('Medicos/Medico');
    }
    public function AjaxBuscarPaciente() {
        $sql= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxPrealta() {
        $this->config_mdl->sqlInsert('um_pisos_prealtas',array(
            'prealta_fecha'=> date('Y-m-d'),
            'prealta_hora'=> date('H:i:s'),
            'prealta_estado'=>'Si',
            'prealta_confirm'=>'',
            'triage_id'=> $this->input->post('triage_id'),
            'empleado_id'=> $this->UMAE_USER
        ));  
        
        $this->setOutput(array('accion'=>'1'));
    }
}
