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
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT pisos.*, hospital_tipo, hospital_nombre FROM sigh_pisos AS pisos, sigh_hospitales AS hospital WHERE 
                                                        pisos.hospital_id=hospital.hospital_id AND hospital.hospital_id=".$this->sigh->getInfo('hospital_id'));
        $this->load->view('PisosIndex',$sql);
    }
    public function AjaxAgregarPiso() {
        $data=array(
            'piso_nombre'=> $this->input->post('piso_nombre'),
            'hospital_id'=> $this->input->post('hospital_id')
        );
        if($this->input->post('piso_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_pisos',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_pisos',$data,array(
                'piso_id'=> $this->input->post('piso_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxGetHospitales() {
        $sql= $this->config_mdl->sqlGetData('sigh_hospitales');
        $option='';
        foreach ($sql as $value) {
            $option.='<option value="'.$value['hospital_id'].'">'.$value['hospital_clasificacion'].' '.$value['hospital_tipo'].' '.$value['hospital_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function TotaCamasAsignadas($data) {
        $sql= $this->config_mdl->sqlGetDataCondition('os_pisos_sc',array(
            'sala_id'=>$data['sala_id']
        ));
        return count($sql);
    }

    public function AsignarCamas() {
        $sql['Piso']= $this->config_mdl->sqlGetDataCondition('sigh_pisos',array(
            'piso_id'=> $this->input->get('piso')
        ));
        $sql['Areas']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_areas AS areas WHERE areas.area_modulo='Pisos' AND hospital_id=".$sql['Piso'][0]['hospital_id']);
        
        $this->load->view('PisosCamas',$sql);
    }
    public function AjaxObtenerCamas() {
        $Camas= $this->config_mdl->sqlQuery("SELECT * FROM sigh_camas AS camas, sigh_areas AS areas WHERE camas.area_id=areas.area_id AND areas.area_id=".$this->input->post('area_id'));
        $CamasAsignadas= $this->config_mdl->sqlQuery("SELECT * FROM sigh_camas AS camas, sigh_pisos AS piso, sigh_areas AS area, sigh_pisos_camas AS pisos_c WHERE area.area_id=camas.area_id AND pisos_c.cama_id=camas.cama_id AND 
        pisos_c.piso_id=piso.piso_id AND
        piso.piso_id=".$this->input->post('piso_id'));
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
        $sql= $this->config_mdl->_query("SELECT * FROM sigh_camas AS cama, sigh_pisos AS piso, sigh_areas AS area, sigh_pisos_camas AS pc
        WHERE
        area.area_id=cama.area_id AND
        pc.cama_id=cama.cama_id AND
        pc.piso_id=piso.piso_id AND
        piso.piso_id=".$this->input->post('piso_id'));
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
            $sql= $this->config_mdl->sqlGetDataCondition('sigh_pisos_camas',array(
                'cama_id'=>$this->input->post('cama_id')
            ));
            if(empty($sql)){
                $this->config_mdl->sqlInsert('sigh_pisos_camas',array(
                    'piso_id'=> $this->input->post('piso_id'),
                    'cama_id'=> $this->input->post('cama_id')
                ));
                $this->setOutput(array('accion'=>'1'));
            }else{
                $this->setOutput(array('accion'=>'2'));
            }
        }else{
            $this->config_mdl->sqlDelete('sigh_pisos_camas',array(
                'piso_id'=> $this->input->post('piso_id'),
                'cama_id'=> $this->input->post('cama_id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }
        
    }
    public function AjaxSala() {
        $data=array(
            'sala_nombre'=> $this->input->post('sala_nombre'),
            'piso_id'=> $this->input->post('piso_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('os_pisos_salas',$data);
        }else{
            $this->config_mdl->_update_data('os_pisos_salas',$data,array(
                'sala_id'=> $this->input->post('sala_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
}
