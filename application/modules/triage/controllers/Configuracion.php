<?php

/**
 * Description of Configuracion
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Configuracion extends Config{
    public function index() {
        $sql['Clasificacion']= $this->config_mdl->sqlGetData('sigh_clasificacion_settings');
        $this->load->view('Configuracion/index',$sql);
    }
    public function AjaxClasificacion() {
        $this->config_mdl->sqlUpdate('sigh_clasificacion_settings',array(
            'clasificacion_tiempo'=> $this->input->post('clasificacion_tiempo'),
            'clasificacion_min'=> $this->input->post('clasificacion_min'),
            'clasificacion_max'=> $this->input->post('clasificacion_max')
        ),array(
            'clasificacion_id'=> $this->input->post('clasificacion_id')
        ));
        $this->setOutput(array('action'=>1));
    }
}
