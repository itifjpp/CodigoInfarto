<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Areas
 *
 * @author bienTICS
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Areas extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_areas');
        $this->load->view('areasv/index',$sql);
    }
    public function AgregarArea(){
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
            'area_id'=> $this->input->get('area')
        ))[0];
        $sql['Hospitales']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales');
        $this->load->view('areasv/AreaAgregar',$sql);
    }
    public function AjaxGuardarArea() {
        $data=array(
            'area_nombre'=> $this->input->post('area_nombre'),
            'area_camas'=> 'Si',
            'area_horario_visita'=> $this->input->post('area_horario_visita'),
            'area_modulo'=> $this->input->post('area_modulo'),
            'area_genero'=> $this->input->post('area_genero'),
            'hospital_id'=> $this->input->post('hospital_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_areas',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_areas',$data,array(
                'area_id'=> $this->input->post('area_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function EliminarArea($area) {
        $this->config_mdl->sqlDelete('sigh_areas',array(
            'area_id'=>$area
        ));
        $this->config_mdl->sqlDelete('sigh_camas',array(
            'area_id'=>$area
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function GestionCamas($area) {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_camas AS cama WHERE cama.area_id='$area' ORDER BY cama.cama_id DESC");
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
            'area_id'=>$area
        ))[0];
        $this->load->view('areasv/camas',$sql);
    }
    public function TotalCama($data) {
        return $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS TOTAL FROM sigh_camas WHERE sigh_camas.area_id=".$data['area_id'])[0]['TOTAL'];
    }
    public function GuardarCama() {
        $data=array(
            'cama_nombre'=> $this->input->post('cama_nombre'),
            'cama_status'=> 'Disponible',
            'cama_aislado'=> $this->input->post('cama_aislado'),
            'cama_genero'=> $this->input->post('cama_genero'),
            'area_id'=> $this->input->post('area_id'),
            'cama_dh'=>'0'
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_camas',$data);
        }else{
            unset($data['cama_status']);
            unset($data['cama_dh']);
            $this->config_mdl->sqlUpdate('sigh_camas',$data,array(
                'cama_id'=> $this->input->post('cama_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function EliminarCama($cama) {
        $this->config_mdl->_delete_data('os_camas',array(
            'cama_id'=>$cama
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function ObtenerCamas($area) {
        $sql_cama= $this->config_mdl->_get_data_condition('os_camas',array(
            'area_id'=> $area
        ));
        $option.='<option value="">Seleccionar Cama</option>';
        if(!empty($sql_cama)){
            foreach ($sql_cama as $value) {
                $option.='<option value="'.$value['cama_id'].'">'.$value['cama_nombre'].'</option>';
            }
        }else{
            $this->setOutput(array('camas'=>'NO'));
        }
        
        $this->setOutput(array('camas'=>$option));
    }
    public function LogCamas($data) {
        $this->config_mdl->_insert('sigh_camas_log',array(
            'log_estatus'=>$data['log_estatus'],
            'log_fecha'=> date('Y-m-d'),
            'log_hora'=> date('H:i:s'),
            'log_turno'=> Modules::run('Config/ObtenerTurno'),
            'cama_id'=>$data['cama_id'],
            'log_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER
        ));
    }
    /**/
    public function AjaxObtenerAreas() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
            'area_modulo'=> $this->input->post('areas_acceso_mod')
        ));
        foreach ($sql as $value) {
            $option.='<option value="'.$value['area_id'].'">'.$value['area_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxObtenerPisos() {
        $sql= $this->config_mdl->sqlGetData('sigh_pisos');
        foreach ($sql as $value) {
            $option.='<option value="'.$value['piso_id'].'">'.$value['piso_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxObtenerCamas() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
            'area_id'=> $this->input->post('area_id'),
            'cama_status'=>'Disponible'
        ));
        foreach ($sql as $value) {
            $option.='<option value="'.$value['cama_id'].'">'.$value['cama_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxEndMantenimiento() {
        $this->config_mdl->sqlUpdate('sigh_camas',array(
            'cama_status'=>  'Disponible',
            'cama_ingreso_f'=> '',
            'cama_ingreso_h'=> '',
            'cama_fh_estatus'=> date('Y-m-d H:i:s')
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        Modules::run('Areas/LogCamas',array(
            'log_estatus'=>'Disponible',
            'cama_id'=>$this->input->post('cama_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
