<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProcuracionOrganos
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class ProcuracionOrganos extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_choque_v2, os_triage_po WHERE 
            os_triage.triage_id=os_triage_po.triage_id AND
            os_triage.triage_id=os_choque_v2.triage_id AND 
            os_triage_po.po_donador='Si' AND
            os_triage.triage_via_registro='Choque' ORDER BY os_choque_v2.choque_id DESC");
        $this->load->view('index',$sql);
    }
    public function PosibleDonador() {
        $sql['info']= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get_post('folio')
        ));
        $sql['po']= $this->config_mdl->_get_data_condition('os_triage_po',array(
            'triage_id'=> $this->input->get_post('folio')
        ))[0];
        $this->load->view('PosibleDonador',$sql);
    }
    public function AjaxPosibleDonador() {
        $Estado='Posible Donador';
        if($this->input->post('po_potencial_donador')=='Si'){
            $Estado='Potencia Donador';
        }
        if($this->input->post('po_potencial_donador')=='Si' && $this->input->post('po_donador_elegible')=='Si'){
            $Estado='Donador Elegible';
        }
        if($this->input->post('po_potencial_donador')=='Si' && $this->input->post('po_donador_elegible')=='Si' && $this->input->post('po_donador_efectivo')=='Si'){
            $Estado='Donador Efectivo';
        }
        if($this->input->post('po_potencial_donador')=='Si' && $this->input->post('po_donador_elegible')=='Si' && $this->input->post('po_donador_efectivo')=='Si' && $this->input->post('po_donador_util')=='Si'){
            $Estado='Donador Útil';
        }
        $this->config_mdl->_update_data('os_triage_po',array(
            'po_estatus'=>$Estado,
            'po_potencial_donador'=> $this->input->post('po_potencial_donador'),
            'po_donador_elegible'=> $this->input->post('po_donador_elegible'),
            'po_donador_efectivo'=> $this->input->post('po_donador_efectivo'),
            'po_donador_util'=> $this->input->post('po_donador_util')
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
