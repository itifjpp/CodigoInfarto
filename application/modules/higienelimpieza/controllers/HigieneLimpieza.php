<?php

/**
 * Description of HigieneLimpieza
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class HigieneLimpieza extends Config{
    
    public function RopaQuirurgica() {
        $this->load->view('RopaQuirurgica/index');
    }
    public function AjaxRopaQuirurgica() {
        $hospital_id= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=> $this->UMAE_USER
        ),'hospital_id')[0]['hospital_id'];
        $inputDateStart= $this->input->post('inputDateStart');
        $inputDateEnd= $this->input->post('inputDateEnd');
        $sql=count($this->config_mdl->sqlQuery("SELECT ropa.rq_id FROM um_empleados_ropa  AS ropa WHERE ropa.hospital_id=$hospital_id AND 
        ropa.rq_r_fecha BETWEEN '$inputDateStart' AND '$inputDateEnd'"));
        $this->setOutput(array('accion'=>'1','total'=>$sql));
    }
}
