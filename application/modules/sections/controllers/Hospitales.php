<?php

/**
 * Description of Hospitales
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Hospitales extends Config{
    public function index() {
        $sql['Hospitales']= $this->config_mdl->sqlGetData('sigh_hospitales');
        $this->load->view('Hospitales/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales',array(
            'hospital_id'=> $this->input->get_post('hospital')
        ))[0];
        
        $this->load->view('Hospitales/Agregar',$sql);
    }
    public function AjaxAgregar() {
        $data=array(
            'hospital_nombre'=> $this->input->post('hospital_nombre'),
            'hospital_tipo'=> $this->input->post('hospital_tipo'),
            'hospital_clasificacion'=> $this->input->post('hospital_clasificacion'),
            'hospital_direccion'=> $this->input->post('hospital_direccion'),
            'hospital_acerca_de'=> $this->input->post('hospital_acerca_de'),
            'hospital_mision'=> $this->input->post('hospital_mision'),
            'hospital_vision'=> $this->input->post('hospital_vision'),
            'hospital_logo'=> $_FILES['hospital_logo']['name'],
            'hospital_img_doc'=>$_FILES['hospital_img_doc']['name'],
            'hospital_color'=> $this->input->post('hospital_color'),
            'hospital_back_primary'=> $this->input->post('hospital_back_primary'),
            'hospital_back_secundary'=> $this->input->post('hospital_back_secundary'),
            
        );
        if($_FILES['hospital_logo']['name']!=''){
            copy($_FILES['hospital_logo']['tmp_name'], 'assets/img/'.$_FILES['hospital_logo']['name']);
        }else{
            unset($data['hospital_logo']);
        }
        if($_FILES['hospital_img_doc']['name']!=''){
            copy($_FILES['hospital_img_doc']['tmp_name'], 'assets/img/'.$_FILES['hospital_img_doc']['name']);
        }else{
            unset($data['hospital_img_doc']);
        }
        if($this->input->post('hospital_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_hospitales',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_hospitales',$data,array(
                'hospital_id'=> $this->input->post('hospital_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function Equipos() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales_equipos',array(
            'hospital_id'=>$_GET['hos']
        ));
        $this->load->view('Hospitales/Equipos',$sql);
    }
    public function AjaxEquipos() {
        if($this->input->post('equipo_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_hospitales_equipos',array(
                'equipo_ip'=> $this->input->post('equipo_ip'),
                'equipo_descripcion'=> $this->input->post('equipo_descripcion'),
                'equipo_acceso_area'=>'',
                'equipo_acceso_fecha'=>'',
                'equipo_estado'=>'Offline',
                'empleado_id'=>0,
                'hospital_id'=> $this->input->post('hospital_id')
            ));
            
        }else{
            $this->config_mdl->sqlUpdate('sigh_hospitales_equipos',array(
                'equipo_ip'=> $this->input->post('equipo_ip'),
                'equipo_descripcion'=> $this->input->post('equipo_descripcion')
            ),array(
                'equipo_id'=> $this->input->post('equipo_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEquipoEliminar() {
        $this->config_mdl->sqlDelete('sigh_hospitales_equipos',array(
            'equipo_id'=> $this->input->post('equipo_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function ws() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales_ws',array(
            'hospital_id' =>$this->input->get('hos')
        ));
        $this->load->view('Hospitales/ws/ws_index',$sql);
    }
    public function ws_add() {
        $this->load->view('Hospitales/ws/ws_add');
    }
    public function Ajax_ws_add() {
        $data=array(
            'ws_bd_user'=> $this->input->post('ws_bd_user'),
            'ws_bd_password'=> $this->input->post('ws_bd_password'),
            'ws_bd_name'=> $this->input->post('ws_bd_name'),
            'ws_bd_ip'=> $this->input->post('ws_bd_ip'),
            'ws_url'=> $this->input->post('ws_url'),
            'hospital_id'=> $this->input->post('hospital_id')
        );
        if($this->input->post('ws_accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_hospitales_ws',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_hospitales_ws',$data,array(
                'ws_id'=> $this->input->post('ws_id')
            ));
        }
        $this->setOutput(array(
            'action'=>1
        ));
    }
    public function Ajax_ws_publish() {
        $this->config_mdl->sqlUpdate('sigh_hospitales',array(
            'hospital_ws'=> $this->input->post('hospital_ws'),
            'hospital_ws_url'=> $this->input->post('hospital_ws_url')
        ),array(
            'hospital_id'=> $this->input->post('hospital_id')
        ));
        $info= $this->config_mdl->sqlGetDataCondition('sigh_hospitales',array(
            'hospital_id'=> $this->input->post('hospital_id')
        ))[0];
        $hospital_logo = base64_encode(file_get_contents( 'assets/img/'.$info['hospital_logo_login']));
        $ch=$this->postCurl('http://localhost/sighwebsite/Api/setInfo', array(
            'hospital_nombre'=>$info['hospital_nombre'],
            'hospital_tipo'=>$info['hospital_tipo'],
            'hospital_clasificacion'=> $info['hospital_clasificacion'],
            'hospital_direccion'=> $info['hospital_direccion'],
            'hospital_acerca_de'=>$info['hospital_acerca_de'],
            'hospital_mision'=>$info['hospital_mision'],
            'hospital_vision'=> $info['hospital_vision'],
            'hospital_logo'=>$hospital_logo,
            'hospital_logo_ext'=> end(explode('.', $info['hospital_logo_login'])),
            'hospital_status'=>$this->input->post('hospital_ws'),
            'hospital_id'=> $this->input->post('hospital_id')
        ));
        $this->setOutput($ch);
    }
}
