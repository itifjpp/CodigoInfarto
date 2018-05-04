<?php

/**
 * Description of Contratos
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Contratos extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlQuery('SELECT * FROM abs_contrato AS c
                                                       INNER JOIN abs_proveedores p on c.proveedor_id=p.proveedor_id');
        $this->load->view('Contratos/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('abs_contrato',array(
            'contrato_id'=> $this->input->get('contrato')
        ))[0];
        $sql['Proveedores']= $this->config_mdl->sqlGetData('abs_proveedores');
        $this->load->view('Contratos/Agregar',$sql);
    }
    public function AjaxGuardar() {
        $data=array(
            'contrato_nombre'=> $this->input->post('contrato_nombre'),
            'proveedor_id'=> $this->input->post('proveedor_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('abs_contrato',$data);
        }else{
            $this->config_mdl->sqlUpdate('abs_contrato',$data,array(
                'contrato_id'=> $this->input->post('contrato_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminar() {
        $this->config_mdl->sqlDelete('abs_contrato',array(
            'contrato_id'=> $this->input->post('contrato_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
