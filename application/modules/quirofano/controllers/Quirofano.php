<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Quirofano
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Quirofano extends Config{
    
    public function index() {
        $sql['Gestion']= $this->config_mdl->_get_data('os_quirofanos');
        $this->load->view('index',$sql);
    }
    public function AjaxAgregarQuirofano() {
        $data=array(
            'quirofano_nombre'=> $this->input->post('quirofano_nombre')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('os_quirofanos',$data);
        }else{
            $this->config_mdl->_update_data('os_quirofanos',$data,array(
                'quirofano_id'=> $this->input->post('quirofano_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxObtenerPaciente() {
        $sql= $this->config_mdl->_get_data_condition('os_quirofanos_pacientes',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            if($sql[0]['qp_status']=='Ingreso a Quirófano'){
                $this->setOutput(array('accion'=>'2'));
            }if($sql[0]['qp_status']=='Sala Asignada'){
                $this->setOutput(array('accion'=>'3'));
            }if($sql[0]['qp_status']=='Salida'){
                $this->setOutput(array('accion'=>'4'));
            }
        }else{
            $this->setOutput(array('accion'=>'1'));
        }
    }
    public function EnvioQuirofano($data) {
        $sql= $this->config_mdl->_get_data_condition('os_quirofanos_pacientes',array(
            'triage_id'=> $data['triage_id']
        ));
        if(empty($sql)){
            $this->config_mdl->_insert('os_quirofanos_pacientes',array(
                'qp_status'=>'En Espera',
                'qp_f_envio'=> date('d/m/Y'),
                'qp_h_envio'=> date('H:i'),
                'qp_ruta'=>$data['ruta'],
                'triage_id'=> $data['triage_id']
            ));
        }
    }
    public function AjaxObtenerQuirofanos() {
        $sql= $this->config_mdl->_get_data_condition('os_quirofanos',array(
            'quirofano_status'=>'Disponible'
        ));
        foreach ($sql as $value) {
            $option.='<option value="'.$value['quirofano_id'].'">'.$value['quirofano_nombre'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
}
