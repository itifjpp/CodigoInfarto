<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrabajoSocial
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class TrabajoSocial extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_choque_v2, os_trabajosocial WHERE 
                        os_triage.triage_id=os_choque_v2.triage_id AND
                        os_triage.triage_id=os_trabajosocial.triage_id AND
                        os_trabajosocial.empleado_id=$this->UMAE_USER AND
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
                if($sql[0]['choque_trabajo_social']==''){
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
    public function AjaxAgregarTrabajoSocial() {
        $data=array(
            'ts_fecha'=> date('d/m/Y'),
            'ts_hora'=> date('H:i'),
            'ts_status'=>'Ingreso',
            'triage_id'=> $this->input->post('triage_id'),
            'empleado_id'=> $this->UMAE_USER
        );
        $this->config_mdl->_insert('os_trabajosocial',$data);
        $this->config_mdl->_update_data('os_choque_v2',array(
            'choque_trabajo_social'=>'Ingreso'
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEstadoProceso() {
        $data=array(
            'ts_status'=>'Verificado',
        );
        $this->config_mdl->_update_data('os_trabajosocial',$data,array(
            'ts_id'=> $this->input->post('ts_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AvisosMinisterioPublico() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM ts_ministerio_publico, os_triage WHERE
                                                    os_triage.triage_id=ts_ministerio_publico.triage_id AND
                                                    ts_ministerio_publico.mp_estatus!='Terminado' 
                                                    ORDER BY ts_ministerio_publico.mp_id DESC");
        $this->load->view('AMP',$sql);
    }
    public function AjaxMarcarComoRecibido() {
        $this->config_mdl->_update_data('ts_ministerio_publico',array(
            'mp_estatus'=>'Recibido',
            'mp_rf'=> date('Y-m-d'),
            'mp_rh'=> date('H:i:s'),
            'trabajosocial'=> $this->UMAE_USER
        ),array(
            'mp_id'=> $this->input->post('mp_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxMarcarComoTerminado() {
        $this->config_mdl->_update_data('ts_ministerio_publico',array(
            'mp_estatus'=>'Terminado',
        ),array(
            'mp_id'=> $this->input->post('mp_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
