<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Finanzas
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Finanzas extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_choque_v2, os_finanzas WHERE 
                                os_triage.triage_id=os_choque_v2.triage_id AND
				os_triage.triage_id=os_finanzas.triage_id AND
                                os_finanzas.empleado_id=$this->UMAE_USER AND
                                os_triage.triage_via_registro='Choque' ORDER BY os_choque_v2.choque_id DESC");
        $this->load->view('index',$sql);
    }
    public function AjaxBuscarPaciente() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_choque_v2, os_triage
            WHERE
            os_triage.triage_id=os_choque_v2.triage_id AND
            os_triage.triage_id=".$this->input->post('triage_id'));
        if(!empty($sql)){
            if($sql[0]['triage_paciente_afiliacion_armado']!=''){
                if($sql[0]['choque_finanza']==''){
                    $this->setOutput(array('accion'=>'1','info'=>$sql[0]));
                }else{
                    $this->setOutput(array('accion'=>'4'));
                }
                
            }else{
                $this->setOutput(array('accion'=>'3'));
            }
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxAgregarFinazas() {
        $data=array(
            'finanza_f'=> date('d/m/Y'),
            'finanza_h'=> date('H:i'),
            'finanza_status'=>'Ingreso',
            'triage_id'=> $this->input->post('triage_id'),
            'empleado_id'=> $this->UMAE_USER
        );
        $this->config_mdl->_insert('os_finanzas',$data);
        $this->config_mdl->_update_data('os_choque_v2',array(
            'choque_finanza'=>'Ingreso'
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEstadoProceso() {
        $data=array(
            'finanza_status'=>'Verificado',
            'finanza_estado_proceso'=> $this->input->post('finanza_estado_proceso')
        );
        $this->config_mdl->_update_data('os_finanzas',$data,array(
            'finanza_id'=> $this->input->post('finanza_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function PreciosAtencion() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_finanzas_pa ORDER BY os_finanzas_pa.pa_id ASC");
        $this->load->view('PreciosAtencion',$sql);
    }
    public function PreciosAtencionAdd($Precio) {
        $sql['info']= $this->config_mdl->_get_data_condition('os_finanzas_pa',array(
            'pa_id'=>$Precio
        ))[0];
        $this->load->view('PreciosAtencionAdd',$sql);
    }
    public function AjaxPrecioAtencion() {
        $data=array(
            'pa_costo'=> $this->input->post('pa_costo'),
            'pa_concepto'=> $this->input->post('pa_concepto'),
            'pa_descripcion'=> $this->input->post('pa_descripcion'),
            'empleado_id'=> $this->UMAE_USER
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('os_finanzas_pa',$data);
        }else{
            unset($data['empleado_id']);
            $this->config_mdl->_update_data('os_finanzas_pa',$data,array(
                'pa_id'=> $this->input->post('pa_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxElimiarPrecioAtencion() {
        $this->config_mdl->_delete_data('os_finanzas_pa',array(
            'pa_id'=> $this->input->post('pa_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
