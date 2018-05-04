<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Roles extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_roles');
        $this->load->view('Roles/index',$sql);
    }
    public function AjaxGuardar() {
        $data=array(
            'rol_nombre'=> $this->input->post('rol_nombre')
        );
        if($this->input->post('accion')=='Agregar'){
            $this->config_mdl->sqlInsert('sigh_roles',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_roles',$data,array(
                'rol_id'=> $this->input->post('rol_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function DocumentosRegistro() {
        $sql['Documentos']= $this->config_mdl->sqlGetDataCondition('sigh_roles_documentos',array(
            'rol_id'=>$_GET['rol']
        ));
        $this->load->view('Roles/Documentos',$sql);
    }
    public function AjaxDocumentosRegistro() {
        $data=array(
            'documento_nombre'=> $this->input->post('documento_nombre'),
            'rol_id'=> $this->input->post('rol_id')
        );
        if($this->input->post('documento_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_roles_documentos',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_roles_documentos',$data,array(
                'documento_id'=> $this->input->post('documento_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
}
