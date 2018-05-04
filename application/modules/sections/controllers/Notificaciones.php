<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificaciones
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Notificaciones extends Config{
    //put your code here
    public function index() {
        $sql['Gestion']= $this->config_mdl->_get_data('nt_notificaciones');
        $this->load->view('Notificaciones/index',$sql);
    }
    public function Nuevo() {
        $sql['Areas']= $this->config_mdl->_get_data('os_areas_acceso');
        $this->load->view('Notificaciones/Nuevo',$sql);
    }
    public function AjaxNotificaciones() {
        $data=array(
            'notificacion_titulo'=> $this->input->post('notificacion_titulo'),
            'notificacion_descripcion'=> $this->input->post('notificacion_descripcion'),
            'notificacion_estatus'=> 'Enviado',
            'notificacion_para'=>1,
            'notificacion_de'=> $this->UMAE_AREA,
            'notificacion_fecha'=> date('d/m/Y'),
            'notificacion_hora'=> date('H:i'),
        );
        $this->config_mdl->_insert('nt_notificaciones',$data);
        $lastID= $this->config_mdl->_get_last_id('nt_notificaciones','notificacion_id');
        for ($i = 0; $i < count($_FILES['anexo_archivo']['name']); $i++) {
            $ext= md5(rand()).'.'.end(explode('.',$_FILES['anexo_archivo']['name'][$i]));
            if(copy($_FILES['anexo_archivo']['tmp_name'][$i],'assets/Notificaciones/'.$ext)){
                $this->config_mdl->_insert('nt_notificaciones_anexo',array(
                    'anexo_archivo'=>$ext,
                    'notificacion_id'=>$lastID
                ));
            }
        }
        $this->setOutput(array('accion'=>'1','total'=>count($_FILES['anexo_archivo']['name'])));
    }
    public function AjaxObtenerNotificaciones() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_notificaciones, os_notificaciones_areas
        WHERE 
        os_notificaciones_areas.notificacion_id=os_notificaciones.notificacion_id AND
        os_notificaciones_areas.na_status='Sin Leer' AND
        os_notificaciones_areas.area='$this->UMAE_AREA' AND
        os_notificaciones_areas.empleado_id=$this->UMAE_USER");
        $this->setOutput(array('TOTAL_MSJ'=> count($sql),'Notificaciones'=>$sql));
    }
    public function AjaxLeerNotificaciones() {
        $this->config_mdl->_update_data('os_notificaciones_areas',array(
            'na_status'=>'Leido'
        ),array(
            'area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
