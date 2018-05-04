<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Materiales
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Catalogos extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query('SELECT *FROM abs_sistemas');
        $this->load->view('Sistemas/SistemasIndex',$sql);
    }

    public function NuevoSistema() {
        $sql['Contratos'] = $this->config_mdl->sqlQuery("SELECT *FROM abs_contrato");
        $sql['info']= $this->config_mdl->sqlGetDataCondition('abs_sistemas',array(
            'sistema_id'=> $this->input->get_post('sistema')
        ))[0];
        $this->load->view('Sistemas/SistemasAgregar',$sql);
    }
    
    public function AjaxNuevoSistema() {
        $data=array(
            'sistema_titulo'=> $this->input->post('sistema_titulo'),
            'sistema_descripcion'=> $this->input->post('sistema_descripcion'),
            'contrato_id'=> $this->input->post('contrato_id'),
            'sistema_proveedor'=> $this->input->post('sistema_proveedor'),
            'sistema_img'=> $this->input->post('elemento_img'),
            'sistema_status'=>0
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('abs_sistemas',$data);
        }else{
            $this->config_mdl->_update_data('abs_sistemas',$data,array(
                'sistema_id'=> $this->input->post('sistema_id')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Elementos() {
        $sql['sistema']= $this->config_mdl->_get_data_condition('abs_sistemas',array(
            'sistema_id'=>$_GET['sistema']
        ))[0];
        $sql['total']= $this->config_mdl->_query("SELECT COUNT(abs_elementos.elemento_id) AS total FROM abs_sistemas, abs_elementos WHERE 
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_sistemas.sistema_id=".$_GET['sistema'])[0];
        
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas, abs_elementos WHERE 
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_sistemas.sistema_id=".$_GET['sistema']);
        $this->load->view('Catalogos/ElementosIndex',$sql);
    }
    
    public function NuevoElemento() {
        $sql['info']= $this->config_mdl->_get_data_condition('abs_elementos',array(
            'elemento_id'=>$_GET['elemento']
        ))[0];
        $this->load->view('Catalogos/ElementosAgregar',$sql);
    }
    //MinimaInvacion
    public function AjaxNuevoElemento() {
        $data=array(
            'elemento_titulo'=> $this->input->post('elemento_titulo'),
            'elemento_clave'=> $this->input->post('elemento_clave'),
            'elemento_img'=> $this->input->post('elemento_img'),
            'elemento_descripcion'=> $this->input->post('elemento_descripcion'),
            'sistema_id'=> $this->input->post('sistema_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('abs_elementos',$data);
        }else{
            $this->config_mdl->_update_data('abs_elementos',$data,array(
                'elemento_id'=> $this->input->post('elemento_id')
            ));
        }
        
        $sql = $this->config_mdl->_query("SELECT *FROM abs_elementos WHERE abs_elementos.sistema_id =".$this->input->post('sistema_id'));
        if(!empty($sql)){
            $this->config_mdl->_update_data('abs_sistemas', array(
                    'sistema_status'=> 1
                ), array(
                    'sistema_id'=> $this->input->post('sistema_id')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Rangos() {
        $sql['sistema']= $this->config_mdl->_get_data_condition('abs_sistemas',array(
            'sistema_id'=>$_GET['sistema']
        ))[0];
        $sql['elemento']= $this->config_mdl->_get_data_condition('abs_elementos',array(
            'elemento_id'=>$_GET['elemento']
        ))[0];
        $sql['total']= $this->config_mdl->_query("SELECT COUNT(abs_rangos.rango_id) AS total FROM abs_sistemas, abs_elementos, abs_rangos WHERE
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_elementos.elemento_id=abs_rangos.elemento_id AND
            abs_elementos.elemento_id=".$_GET['elemento']);
        
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas, abs_elementos, abs_rangos WHERE
            abs_sistemas.sistema_id=abs_elementos.sistema_id AND
            abs_elementos.elemento_id=abs_rangos.elemento_id AND
            abs_elementos.elemento_id=".$_GET['elemento']);
        $this->load->view('Catalogos/RangosIndex',$sql);
    }
    
    public function NuevoRango() {
        $sql['info']= $this->config_mdl->_get_data_condition('abs_rangos',array(
            'rango_id'=>$_GET['rango']
        ))[0];
        $this->load->view('Catalogos/RangosAgregar',$sql);
    }
    
    public function AjaxNuevoRango() {
        $data=array(
            'rango_titulo'=> $this->input->post('rango_titulo'),
            'sistema_id'=> $this->input->post('sistema_id'),
            'elemento_id'=> $this->input->post('elemento_id'),
            'rangos_status'=>0,
            'rango_img'=> $this->input->post('elemento_img'),
            'rango_descripcion'=> $this->input->post('rango_descripcion'),
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('abs_rangos',$data);
        }else{
            unset($data['rangos_status']);
            $this->config_mdl->sqlUpdate('abs_rangos',$data,array(
                'rango_id'=> $this->input->post('rango_id')
            ));
        }
        
        $sql = $this->config_mdl->_query("SELECT *FROM abs_rangos WHERE abs_rangos.elemento_id =".$this->input->post('elemento_id'));
        if(!empty($sql)){
            $this->config_mdl->_update_data('abs_elementos', array(
                    'elemento_status'=> 1
                ), array(
                    'elemento_id'=> $this->input->post('elemento_id')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function AjaxEliminar() {
        if($this->input->post('tipo')=='Codigo'){
            $this->config_mdl->_delete_data('abs_inventario',array(
                'inventario_id'=> $this->input->post('id')
            ));
            
            $sql = $this->config_mdl->_query("SELECT *FROM abs_inventario WHERE abs_inventario.rango_id =".$this->input->post('dependencia'));
            if(empty($sql)){
                $this->config_mdl->_update_data('abs_rangos', array(
                        'rangos_status'=> 0
                    ), array(
                        'rango_id'=> $this->input->post('dependencia')
                ));
            }
        }
        if($this->input->post('tipo')=='Rango'){
            $this->config_mdl->_delete_data('abs_rangos',array(
                'rango_id'=> $this->input->post('id')
            ));
            
            $sql = $this->config_mdl->_query("SELECT *FROM abs_rangos WHERE abs_rangos.elemento_id =".$this->input->post('dependencia'));
            if(empty($sql)){
                $this->config_mdl->_update_data('abs_elementos', array(
                        'elemento_status'=> 0
                    ), array(
                        'elemento_id'=> $this->input->post('dependencia')
                ));
            }
        }if($this->input->post('tipo')=='Elemento'){
            $this->config_mdl->_delete_data('abs_elementos',array(
                'elemento_id'=> $this->input->post('id')
            ));
            
            $sql = $this->config_mdl->_query("SELECT *FROM abs_elementos WHERE abs_elementos.sistema_id =".$this->input->post('dependencia'));
            if(empty($sql)){
                $this->config_mdl->_update_data('abs_sistemas', array(
                        'sistema_status'=> 0
                    ), array(
                        'sistema_id'=> $this->input->post('dependencia')
                ));
            }
        }if($this->input->post('tipo')=='Sistema'){
            $this->config_mdl->_delete_data('abs_sistemas',array(
                'sistema_id'=> $this->input->post('id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function ProcedimientosIndex() {
        $sql['procedimientos'] = $this->config_mdl->_query("SELECT *FROM abs_procedimiento");
        
        $this->load->view("Catalogos/ProcimientosIndex", $sql);
    }
    
    public function ProcedimientoAgregar() {
        $this->load->view("Catalogos/ProcedimientoAgregar");
    }
    
    public function GuardarProcedimiento() {
        
        $lastID = $this->config_mdl->_get_last_id('abs_procedimiento','procedimiento_id');
        $CEROS = "";
        for($i = 11; $i > strlen($lastID) ; $i--){
            $CEROS.="0";
        }
        $newId = $lastID + 1;
        $id = $CEROS.$newId."P";
        $this->config_mdl->_insert('abs_procedimiento', array(
            'procedimiento_nombre'=> $this->input->post('procedimiento_nombre'),
            'procedimiento_fecha'=> date('d/m/Y'),
            'procedimiento_hora'=>date('H:i'),
            'procedimiento_codigo'=>"$id"
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Ceye() {
        $this->load->view("Catalogos/Ceye");
    }
}