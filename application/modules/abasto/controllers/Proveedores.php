<?php

/**
 * Description of Proveedores
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Proveedores extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('abs_proveedores');
        $this->load->view('Proveedores/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('abs_proveedores',array(
            'proveedor_id'=> $this->input->get('proveedor')
        ))[0];
        $this->load->view('Proveedores/Agregar',$sql);
    }
    public function AjaxGuardar() {
        $data=array(
            'proveedor_nombre'=> $this->input->post('proveedor_nombre')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('abs_proveedores',$data);
        }else{
            $this->config_mdl->sqlUpdate('abs_proveedores',$data,array(
                'proveedor_id'=> $this->input->post('proveedor_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminar() {
        $this->config_mdl->sqlDelete('abs_proveedores',array(
            'proveedor_id'=> $this->input->post('proveedor_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
