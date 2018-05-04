<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Camas
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Camas extends Config{
    public function index() {
        $this->load->view('Camas/GestionCamas');
    }
    public function CamasDetalles() {
        if($this->input->get('tipo')=='Total'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id  AND sigh_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Disponibles'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Disponible'  AND sigh_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Ocupados'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Ocupado'  AND sigh_areas.area_id=".$this->input->get('area')." ORDER BY cama_ingreso_f ASC, cama_ingreso_h ASC");
        }if($this->input->get('tipo')=='Mantenimiento'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Mantenimiento'  AND sigh_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Limpieza'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Limpieza'  AND sigh_areas.area_id=".$this->input->get('area'));
        }
        $this->load->view('Camas/CamasDetalles',$sql);
    }
    public function DetallePaciente($data) {
        return $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>$data['triage_id']))[0];
    }
    public function Estados() {
        $sql['Areas']= $this->config_mdl->sqlGetDataCondition('sigh_areas',array(
            'area_modulo'=>'Observación'
        ));
        if(isset($_GET['area_id'])){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_areas, sigh_camas WHERE sigh_areas.area_id=sigh_camas.area_id AND
            sigh_areas.area_id=".$_GET['area_id']);
        }
        $this->load->view('Camas/Estados',$sql);
    }
    public function AjaxEstados() {
        $this->config_mdl->_update_data('sigh_camas',array(
            'cama_display'=> $this->input->post('cama_display')
        ),array(
            'cama_id'=> $this->input->post('cama_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxCamasIndicadorEstados() {
        if($this->input->post('area')==''){
            $Condition="AND sigh_areas.area_modulo IN('Observación','Choque')";
            $Mantenimiento= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS Mantenimiento FROM sigh_camas, sigh_areas
                WHERE sigh_camas.cama_display<=>NULL AND  sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Mantenimiento' $Condition")[0]['Mantenimiento'];
                $Limpieza= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS Limpieza FROM sigh_camas, sigh_areas
                WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Limpieza' $Condition")[0]['Limpieza'];
                $Ocupadas= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS ocupadas FROM sigh_camas, sigh_areas
                WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Ocupado' $Condition")[0]['ocupadas'];
                $Disponible= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS disponible FROM sigh_camas, sigh_areas
                WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Disponible' $Condition")[0]['disponible'];
                $Total= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS total FROM sigh_camas, sigh_areas
                WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id $Condition")[0]['total'];
        }else{
            $Mantenimiento= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS Mantenimiento FROM sigh_camas, sigh_areas
            WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Mantenimiento' AND sigh_areas.area_id=".$this->input->post('area'))[0]['Mantenimiento'];
            $Limpieza= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS Limpieza FROM sigh_camas, sigh_areas
            WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Limpieza' AND sigh_areas.area_id=".$this->input->post('area'))[0]['Limpieza'];
            $Ocupadas= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS ocupadas FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Ocupado' AND sigh_areas.area_id=".$this->input->post('area'))[0]['ocupadas'];
            $Disponible= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS disponible FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Disponible' AND sigh_areas.area_id=".$this->input->post('area'))[0]['disponible'];
            $Total= $this->config_mdl->sqlQuery("SELECT COUNT(sigh_camas.cama_id) AS total FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_areas.area_id=".$this->input->post('area'))[0]['total'];
        }
        $this->setOutput(array(
            'Total'=>$Total,
            'Disponibles'=>$Disponible,
            'Ocupados'=>$Ocupadas,
            'Mantenimiento'=>$Mantenimiento,
            'Limpieza'=>$Limpieza
        ));
    }
    public function CamasDetallesIndicadores() {
        if($this->input->get('tipo')=='Total'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id  AND sigh_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Disponibles'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Disponible'  AND sigh_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Ocupados'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='Ocupado'  AND sigh_areas.area_id=".$this->input->get('area')." ORDER BY cama_ingreso_f ASC, cama_ingreso_h ASC");
        }if($this->input->get('tipo')=='Mantenimiento'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Mantenimiento'  AND sigh_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Limpieza'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_camas, sigh_areas
                    WHERE sigh_camas.cama_display<=>NULL AND sigh_camas.area_id=sigh_areas.area_id AND sigh_camas.cama_status='En Limpieza'  AND sigh_areas.area_id=".$this->input->get('area'));
        }
        $this->load->view('Camas/CamasDetalles',$sql);
    }
}
