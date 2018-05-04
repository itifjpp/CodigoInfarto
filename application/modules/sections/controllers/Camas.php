<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Camas
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Camas extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function GestionCamas() {
        $sql['AreaSesion']= $this->ObtenerArea();
        $sql['Areas']= $this->config_mdl->_get_data('os_areas');
        $this->load->view('Camas/GestionCamas',$sql);
    }
    public function AjaxGestionCamas() {
        if($this->input->post('area')==''){
            $Mantenimiento= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Mantenimiento FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento'")[0]['Mantenimiento'];
            $Limpieza= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Limpieza FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza'")[0]['Limpieza'];
            $Ocupadas= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS ocupadas FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado'")[0]['ocupadas'];
            $Disponible= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS disponible FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible'")[0]['disponible'];
            $Total= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS total FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id")[0]['total'];
        }else{
            $Mantenimiento= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Mantenimiento FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento' AND os_areas.area_id=".$this->input->post('area'))[0]['Mantenimiento'];
            $Limpieza= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS Limpieza FROM os_camas, os_areas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza' AND os_areas.area_id=".$this->input->post('area'))[0]['Limpieza'];
            $Ocupadas= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS ocupadas FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado' AND os_areas.area_id=".$this->input->post('area'))[0]['ocupadas'];
            $Disponible= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS disponible FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible' AND os_areas.area_id=".$this->input->post('area'))[0]['disponible'];
            $Total= $this->config_mdl->_query("SELECT COUNT(os_camas.cama_id) AS total FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_areas.area_id=".$this->input->post('area'))[0]['total'];
        }
        $this->setOutput(array(
            'Total'=>$Total,
            'Disponibles'=>$Disponible,
            'Ocupados'=>$Ocupadas,
            'Mantenimiento'=>$Mantenimiento,
            'Limpieza'=>$Limpieza
        ));
    }
    public function CamasDetalles() {
        if($this->input->get('tipo')=='Total'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Disponibles'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Ocupados'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Mantenimiento'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Limpieza'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza'  AND os_areas.area_id=".$this->input->get('area'));
        }
        $this->load->view('Camas/CamasDetalles',$sql);
    }
    public function DetallePaciente($data) {
        return $this->config_mdl->_get_data_condition('os_triage',array('triage_id'=>$data['triage_id']))[0];
    }
    public function ObtenerArea() {
        if($this->UMAE_AREA=='Servicio Cadera'){
            return 8;
        }if($this->UMAE_AREA=='Servicio Femúr y Rodilla'){
            return 11;
        }if($this->UMAE_AREA=='Servicio Fracturas Expuestas'){
            return 12;
        }if($this->UMAE_AREA=='Servcio Pie y Tobillo'){
            return 14;
        }if($this->UMAE_AREA=='Servicio Neurocirugía'){
            return 15;
        }if($this->UMAE_AREA=='Servicio Columna'){
            return 0;
        }if($this->UMAE_AREA=='Servicio CPR'){
            return 17;
        }if($this->UMAE_AREA=='Servicio Maxilofacial'){
            return 18;
        }if($this->UMAE_AREA=='Servicio Quemados'){
            return 19;
        }if($this->UMAE_AREA=='Servicio Pediatría'){
            return 20;
        }if($this->UMAE_AREA=='Servicio Corta Estancia'){
            return 21;
        }if($this->UMAE_AREA=='Servicio Miembro Torácico'){
            return 13;
        }
    }
    public function VisorCamas() {
        $this->load->view('Camas/VisorCamas');
    }
}
