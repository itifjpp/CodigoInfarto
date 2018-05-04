<?php

/**
 * Description of Sistemas
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Sistemas extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query('SELECT *FROM abs_sistemas');
        $this->load->view('Sistemas/index',$sql);
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
            'sistema_img'=> $this->input->post('elemento_img'),
            'sistema_status'=>0
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('abs_sistemas',$data);
        }else{
            $this->config_mdl->sqlUpdate('abs_sistemas',$data,array(
                'sistema_id'=> $this->input->post('sistema_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarSistema() {
        $this->config_mdl->sqlDelete('abs_sistemas',array(
            'sistema_id'=> $this->input->post('sistema_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /*ELEMENTOS*/
    public function Elementos() {
        $sql['Sistema']= $this->config_mdl->sqlGetDataCondition('abs_sistemas',array(
            'sistema_id'=> $this->input->get('sistema')
        ),'sistema_titulo')[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM abs_sistemas AS s
                                                        INNER JOIN abs_elementos e on s.sistema_id=e.sistema_id 
                                                        WHERE s.sistema_id=".$this->input->get('sistema'));
        $this->load->view('Sistemas/Elementos',$sql);
    }
    public function NuevoElemento() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('abs_elementos',array(
            'elemento_id'=> $this->input->get('elemento')
        ))[0];
        $this->load->view('Sistemas/ElementosAgregar',$sql);
    }
    public function AjaxNuevoElemento() {
        $data=array(
            'elemento_titulo'=> $this->input->post('elemento_titulo'),
            'elemento_clave'=> $this->input->post('elemento_clave'),
            'elemento_img'=> $this->input->post('elemento_img'),
            'elemento_descripcion'=> $this->input->post('elemento_descripcion'),
            'elemento_fecha'=> date('Y-m-d H:i:s'),
            'empleado_id'=> $this->UMAE_USER,
            'elemento_status'=>0,
            'sistema_id'=> $this->input->post('sistema_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('abs_elementos',$data);
        }else{
            unset($data['elemento_status']);
            $this->config_mdl->sqlUpdate('abs_elementos',$data,array(
                'elemento_id'=> $this->input->post('elemento_id')
            ));
        }
        $this->config_mdl->sqlUpdate('abs_sistemas',array(
            'sistema_status'=>1
        ),array(
            'sistema_id'=> $this->input->post('sistema_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarElemento() {
        $this->config_mdl->sqlDelete('abs_elementos',array(
            'elemento_id'=> $this->input->post('elemento_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /*RANGOS*/
    public function Rangos() {        
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM abs_sistemas AS s
                                                    INNER JOIN abs_elementos e on s.sistema_id=e.sistema_id 
                                                    INNER JOIN abs_rangos r on r.elemento_id=e.elemento_id 
                                                    WHERE e.elemento_id=".$_GET['elemento']);
        $this->load->view('Sistemas/RangosIndex',$sql);
    }
    
    public function NuevoRango() {
        $sql['info']= $this->config_mdl->_get_data_condition('abs_rangos',array(
            'rango_id'=>$_GET['rango']
        ))[0];
        $this->load->view('Sistemas/RangosAgregar',$sql);
    }
    
    public function AjaxNuevoRango() {
        $data=array(
            'rango_titulo'=> $this->input->post('rango_titulo'),
            'elemento_id'=> $this->input->post('elemento_id'),
            'rango_img'=> $this->input->post('elemento_img'),
            'rango_descripcion'=> $this->input->post('rango_descripcion'),
            'rango_fecha'=> date('Y-m-d H:i:s'),
            'empleado_id'=> $this->UMAE_USER,
            'rango_status'=>0,
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('abs_rangos',$data);
        }else{
            unset($data['rango_status']);
            $this->config_mdl->_update_data('abs_rangos',$data,array(
                'rango_id'=> $this->input->post('rango_id')
            ));
        }
        $this->config_mdl->sqlUpdate('abs_elementos', array(
                'elemento_status'=> 1
            ), array(
                'elemento_id'=> $this->input->post('elemento_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarRango() {
        $this->config_mdl->sqlDelete('abs_rangos',array(
            'rango_id'=> $this->input->post('rango_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /*INVENTARIO DE RANGOS*/
    public function RangosInventario() {
        $rango_id=$_GET['rango'];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT s.sistema_titulo, e.elemento_titulo, r.rango_titulo, i.* FROM abs_sistemas AS s
                                                        INNER JOIN abs_elementos e ON s.sistema_id=e.sistema_id 
                                                        INNER JOIN abs_rangos r ON e.elemento_id=r.elemento_id
                                                        INNER JOIN abs_inventario i ON (r.rango_id=i.rango_id AND r.rango_id=$rango_id)");
        $this->load->view('Sistemas/RangosInventario',$sql);
    }
    public function AjaxInventario() {
        for ($i = 0; $i < $this->input->post('inventario'); $i++) {
            $this->config_mdl->sqlInsert('abs_inventario',array(
                'entrega_id'=>0,
                'inventario_fecha'=> date('Y-m-d H:i:s'),
                'empleado_id'=> $this->UMAE_USER,
                'inventario_status'=>'false',
                'vale_servicio_id'=>0,
                'procedimiento_status'=>'SIN ASIGNAR',
                'rango_id'=> $this->input->post('rango_id')
            ));
        }
        $this->config_mdl->sqlUpdate('abs_rangos',array(
            'rango_status'=>1
        ),array(
            'rango_id'=> $this->input->post('rango_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarInventario() {
        $this->config_mdl->sqlDelete('abs_inventario',array(
            'inventario_id'=> $this->input->post('inventario_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
