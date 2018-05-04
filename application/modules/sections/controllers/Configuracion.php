<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Umae
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Configuracion extends Config{
    public function index(){
        $this->load->view('Umae/index');
    }
    public function UnidadMedica() {
        $sql['info']= $this->config_mdl->sqlGetData('um_')[0];
        $sql['empleado']= $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=> $this->UMAE_USER
        ))[0];
        $this->load->view('Umae/UnidadMedica',$sql);
    }
    public function AjaxUnidadMedica() {
        $unidadmedica_logo=$_FILES['um_logo']['name'];
        $ext='UM_LOGO.'.end(explode('.', $unidadmedica_logo));
        if($unidadmedica_logo!=''){
            copy($_FILES['um_logo']['tmp_name'], 'assets/img/'.$ext);
        }else{
            $ext=_UM_LOGO;
        }
        $data = array(
            'um_nombre'=> $this->input->post('um_nombre'),
            'um_tipo'=> $this->input->post('um_tipo'),
            'um_clasificacion'=> $this->input->post('um_clasificacion'),
            'um_direccion'=> $this->input->post('um_direccion'),
            'um_acerca_de'=> $this->input->post('um_acerca_de'),
            'um_mision'=> $this->input->post('um_mision'),
            'um_vision'=> $this->input->post('um_vision'),
            'um_logo'=>$ext,
        );
        $this->config_mdl->_update_data('um_',$data,array(
            'um_id'=>1
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxGuardar() {
        $this->config_mdl->_update_data('um_config',array(
            'config_estatus'=> $this->input->post('config_estatus')
        ),array(
            'config_id'=> $this->input->post('config_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxConfigTurnos() {
        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
            'llamado_espera_amarillo'=> 0,
            'llamado_espera_verde'=>0,
            'llamado_espera_azul'=> 0
        ),array(
            'llamado_id'=>1
        ));
        $this->config_mdl->sqlUpdate('sigh_consultorios_le_llamados',array(
            'llamado_espera_amarillo'=> $this->input->post('llamado_espera_amarillo'),
            'llamado_espera_verde'=> $this->input->post('llamado_espera_verde'),
            'llamado_espera_azul'=> $this->input->post('llamado_espera_azul')
        ),array(
            'llamado_id'=>2
        ));
        $this->setOutput(array('action'=>1));
    }
}
