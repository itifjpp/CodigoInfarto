<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pisos
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Pisos extends Config{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->_get_data('os_pisos');
        $this->load->view('Pisos/index',$sql);
    }
    public function AsignarCamas($Piso) {
        $sql['info']= $this->config_mdl->_get_data_condition('os_pisos',array(
            'piso_id'=>$Piso
        ));
        $sql['Areas']= $this->config_mdl->_query("SELECT * FROM os_areas WHERE os_areas.area_id BETWEEN 7 AND 23");
        
        $this->load->view('Pisos/AsignarCamas',$sql);
    }
    public function AjaxObtenerCamas() {
        $Camas= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE
        os_camas.area_id=os_areas.area_id AND
        os_areas.area_id=".$this->input->post('area_id'));
        $CamasAsignadas= $this->config_mdl->_query("SELECT os_camas.cama_id FROM os_camas, os_pisos, os_pisos_camas, os_areas
        WHERE
        os_areas.area_id=os_camas.area_id AND
        os_pisos_camas.piso_id=os_pisos.piso_id AND
        os_pisos_camas.cama_id=os_camas.cama_id AND
        os_pisos.piso_id=".$this->input->post('piso_id'));
        foreach ($Camas as $value) {
            $col_md_3.='<div class="col-md-3">
                    <div class="form-group">
                        <label class="md-check tip" data-original-title="ssds">
                            <input type="checkbox" class="has-value cama_'.$value['cama_id'].'" name="cama_id" data-accion="Agregar" data-id="'.$value['cama_id'].'" data-piso="'.$this->input->post('piso_id').'">
                            <i class="indigo " ></i><b>Cama: </b>'.$value['cama_nombre'].'
                        </label>
                    </div>
                </div>';
        }
        $this->setOutput(array('col_md_3'=>$col_md_3,'CamasAsignadas'=>$CamasAsignadas));
    }
    public function AjaxCamasAsignadas() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_camas, os_pisos, os_pisos_camas, os_areas
        WHERE
        os_areas.area_id=os_camas.area_id AND
        os_pisos_camas.piso_id=os_pisos.piso_id AND
        os_pisos_camas.cama_id=os_camas.cama_id AND
        os_pisos.piso_id=".$this->input->post('piso_id'));
        foreach ($sql as $value) {
            $col_md_3.='<div class="col-md-3">
                    <div class="form-group">
                        <label class="md-check tip" data-original-title="ssds">
                            <input type="checkbox" checked class="has-value" name="cama_id" data-accion="Eliminar" data-id="'.$value['cama_id'].'" data-piso="'.$this->input->post('piso_id').'">
                            <i class="indigo " ></i><b>Cama :</b> '.$value['cama_nombre'].'
                        </label><br>
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Área &nbsp;&nbsp;:</b> '.$value['area_nombre'].'</label>
                    </div>
                </div>';
        }
        $this->setOutput(array('col_md_3'=>$col_md_3));
    }
    public function AjaxAsignarCamas() {
        if($this->input->post('accion')=='Agregar'){
            $sql= $this->config_mdl->_get_data_condition('os_pisos_camas',array(
                'cama_id'=>$this->input->post('cama_id')
            ));
            if(empty($sql)){
                $this->config_mdl->_insert('os_pisos_camas',array(
                    'piso_id'=> $this->input->post('piso_id'),
                    'cama_id'=> $this->input->post('cama_id')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            $this->config_mdl->_delete_data('os_pisos_camas',array(
                'piso_id'=> $this->input->post('piso_id'),
                'cama_id'=> $this->input->post('cama_id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }
        
    }
}
