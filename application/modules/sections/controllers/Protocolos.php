<?php

/**
 * Description of Protocolos
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Protocolos extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('sigh_protocolos',array(
            'empleado_id'=> $this->UMAE_USER
        ));
        $this->load->view('Protocolos/index',$sql);
    }
    public function AjaxAgregar() {
        $data=array(
            'protocolo_nombre'=> $this->input->post('protocolo_nombre'),
            'protocolo_descripcion'=> $this->input->post('protocolo_descripcion'),
            'empleado_id'=> $this->UMAE_USER
        );
        if($this->input->post('protocolo_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_protocolos',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_protocolos',$data,array(
                'protocolo_id'=> $this->input->post('protocolo_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function AgregarPacientes() {
        $this->load->view('Protocolos/AgregarPacientes');
    }
}
