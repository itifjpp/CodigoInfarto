<?php

/**
 * Description of Ua
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Ua extends Config{
    public function index() {
        $sql['Ua']= $this->config_mdl->sqlGetData('sigh_ua');
        $this->load->view('Ua/ua_index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_ua',array(
            'ua_id'=>$_GET['ua']
        ))[0];
        $this->load->view('Ua/ua_agregar',$sql);
    }
    public function AjaxAgregar() {
        $data=array(
            'ua_nombre'=> $this->input->post('ua_nombre'),
            'ua_incorporacion'=> $this->input->post('ua_incorporacion'),
            'ua_telefono'=> $this->input->post('ua_telefono'),
            'ua_email'=> $this->input->post('ua_email'),
            'ua_direccion'=> $this->input->post('ua_direccion')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_ua',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_ua',$data,array(
                'ua_id'=> $this->input->post('ua_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function AjaxEliminarUa() {
        $this->config_mdl->sqlDelete('sigh_ua',array(
            'ua_id'=> $this->input->post('ua_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    public function Carreras() {
        $sql['UaCarreras']= $this->config_mdl->sqlGetDataCondition('sigh_ua_carreras',array(
            'ua_id'=>$_GET['ua']
        ));
        $this->load->view('Ua/ua_carreras',$sql);
    }
    public function Carrera() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_ua_carreras',array(
            'carrera_id'=> $this->input->get('carrera')
        ))[0];
        $this->load->view('Ua/ua_carrera',$sql);
    }
    public function AjaxAgregarCarrera() {
        $data=array(
            'carrera_nombre'=> $this->input->post('carrera_nombre'),
            'ua_id'=> $this->input->post('ua_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_ua_carreras',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_ua_carreras',$data,array(
                'carrera_id'=> $this->input->post('carrera_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function EjaxEliminarCarrera() {
        $this->config_mdl->sqlDelete('sigh_ua_carreras',array(
            'carrera_id'=> $this->input->post('carrera_id')
        ));
        $this->setOutput(array('action'=>'1'));
    }
    public function AjaxGetUaCarreras() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_ua_carreras',array(
            'ua_id'=> $this->input->post('ua_id')
        ));
        $option='';
        foreach ($sql as $value) {
            $option.='<option value="'.$value['carrera_id'].'">'.$value['carrera_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
}
