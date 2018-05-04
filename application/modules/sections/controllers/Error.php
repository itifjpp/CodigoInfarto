<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Error extends Config{
    public function AjaxLogError() {
        $data=array(
            'error_fecha'=> date('d/m/Y'),
            'error_hora'=> date('H:i'),
            'error_url'=> $this->input->post('error_url'),
            'error_msj'=> $this->input->post('error_msj'),
            'error_area'=> $this->UMAE_AREA,
            'error_empleado'=> $this->UMAE_USER
        );
        $this->config_mdl->_insert('log_errores',$data);
        $this->setOutput(array('accion'=>'1'));
    }
}
