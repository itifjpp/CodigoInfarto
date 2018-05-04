<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Login extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']=  $this->config_mdl->_query('SELECT * FROM sigh_areasacceso WHERE areas_acceso_status=""');
        $sqlHospital= $this->config_mdl->sqlGetDataCondition('sigh_hospitales',array(
           'hospital_nivel'=>'Principal' 
        ));
        $sql['CheckEquipo']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales_equipos',array(
            'equipo_ip'=>$_SERVER['REMOTE_ADDR']
        ));
        if(empty($sqlHospital)){
            $this->load->view('Login/PrimerUso',$sql);
        }else{
            $this->load->view('Login/v2',$sql);
        }
        
    }
    public function ObtenerAreas() {
        $sql_rol=  $this->config_mdl->_get_data('sigh_areasacceso');
        $areas=array();
        foreach ($sql_rol as $value) {
            if($value['areas_acceso_status']==''):
                array_push($areas, $value['areas_acceso_nombre']) ;
            endif;
        }
        $this->setOutput($areas);
    }
    public function loginV2() {
        $sql=  $this->config_mdl->_get_data_condition('sigh_empleados',array(
            'empleado_matricula'=>  $this->input->post('empleado_matricula')
        ));
        $sql_rol=  $this->config_mdl->_get_data('sigh_areasacceso');
        $areas=array();
        foreach ($sql_rol as $value) {
            array_push($areas, $value['areas_acceso_nombre']) ;
        }
        $sqlGetRol= $this->config_mdl->_get_data_condition('sigh_areasacceso',array(
            'areas_acceso_nombre'=>$this->input->post('empleado_area')
        ))[0];
        if(in_array($this->input->post('empleado_area'), $areas)){
            if(!empty($sql)){
                $sql_roles=  $this->config_mdl->_get_data_condition('sigh_empleados_roles',array(
                    'empleado_id'=>$sql[0]['empleado_id'],
                    'rol_id'=>$sqlGetRol['areas_acceso_rol']
                ));
                if(!empty($sql_roles)){
                    if($sql[0]['empleado_sc']=='Si'){
                        $this->setOutput(array(
                            'ACCESS_LOGIN'=>'ACCESS_SC',
                            'nombre'=>$sql[0]['empleado_nombre'],
                            'ap'=>$sql[0]['empleado_ap'],
                            'am'=>$sql[0]['empleado_am'],
                            'perfil'=>$sql[0]['empleado_perfil']
                        ));
                    }else{
                        $_SESSION['UMAE_USER']=$sql[0]['empleado_id'];
                        $_SESSION['UMAE_AREA']=  $this->input->post('empleado_area');
                        $this->config_mdl->_update_data('sigh_empleados',array(
                            'empleado_area_acceso'=>$this->input->post('empleado_area'),
                            'empleado_acceso_f'=>  date('d/m/Y'),
                            'empleado_acceso_h'=>  date('H:i') ,
                            'empleado_conexion'=>  '1'
                        ),array(
                            'empleado_id'=>$sql[0]['empleado_id']
                        ));
                        $this->config_mdl->sqlUpdate('sigh_hospitales_equipos',array(
                            'equipo_acceso_area'=>$this->input->post('empleado_area'),
                            'equipo_acceso_fecha'=> date('Y-m-d H:i:s'),
                            'equipo_estado'=>'Online',
                            'empleado_id'=>$sql[0]['empleado_id']
                        ),array(
                            'equipo_ip'=>$_SERVER['REMOTE_ADDR']
                        ));
                        $this->setOutput(array('ACCESS_LOGIN'=>'ACCESS'));
                    }
                }else{
                    $this->setOutput(array('ACCESS_LOGIN'=>'AREA_NO_ROL'));
                }
            }else{
                $this->setOutput(array('ACCESS_LOGIN'=>  'MATRICULA_NO_ENCONTRADA'));
            }  
        }else{
            $this->setOutput(array('ACCESS_LOGIN'=>  'AREA_NO_ENCONTRADA'));
        }
    } 
    public function AjaxValidarAcceso() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $this->input->post('empleado_id'),
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sql)){
            $option='';
            $sql_hos= $this->config_mdl->sqlGetData('sigh_hospitales');
            foreach ($sql_hos as $value) {
                $option.='<option value="'.$value['hospital_id'].'">'.$value['hospital_tipo'].' '.$value['hospital_nombre'].'</option>';
            }
            $this->setOutput(array('action'=>'1','option'=>$option));
        }else{
            $this->setOutput(array('action'=>'2'));
        }
    }
    public function AjaxSolicitarPassword() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula'),
            'empleado_password'=> sha1($this->input->post('empleado_password'))
        ));
        if(!empty($sql)){
            $_SESSION['UMAE_USER']=  $sql[0]['empleado_id'];
            $_SESSION['UMAE_AREA']=  $this->input->post('empleado_area');
            $this->config_mdl->_update_data('sigh_empleados',array(
                'empleado_area_acceso'=>$this->input->post('empleado_area'),
                'empleado_acceso_f'=>  date('d/m/Y'),
                'empleado_acceso_h'=>  date('H:i') ,
                'empleado_conexion'=>  '1'
            ),array(
                'empleado_id'=>$sql[0]['empleado_id']
            ));
            $this->config_mdl->sqlUpdate('sigh_hospitales_equipos',array(
                'equipo_acceso_area'=>$this->input->post('empleado_area'),
                'equipo_acceso_fecha'=> date('Y-m-d H:i:s'),
                'equipo_estado'=>'Online',
                'empleado_id'=>$sql[0]['empleado_id'],
            ),array(
                'equipo_ip'=>$_SERVER['REMOTE_ADDR']
            ));
            $this->setOutput(array('accion'=>'1',$_SESSION));
        }else{
            $this->setOutput(array(
                'accion'=>'2',
                'nombre'=>$sql[0]['empleado_nombre'],
                'ap'=>$sql[0]['empleado_ap'],
                'am'=>$sql[0]['empleado_am'],
                'perfil'=>$sql[0]['empleado_perfil']
            ));
        }
    }
    public function AjaxPrimerUso() {
        $data=array(
            'hospital_nombre'=> $this->input->post('hospital_nombre'),
            'hospital_tipo'=> $this->input->post('hospital_tipo'),
            'hospital_clasificacion'=> $this->input->post('hospital_clasificacion'),
            'hospital_direccion'=> $this->input->post('hospital_direccion'),
            'hospital_acerca_de'=> $this->input->post('hospital_acerca_de'),
            'hospital_mision'=> $this->input->post('hospital_mision'),
            'hospital_vision'=> $this->input->post('hospital_vision'),
            'hospital_logo'=> $this->input->post('hospital_logo'),
            'hospital_nivel'=>'Principal',
        );
        $this->config_mdl->sqlInsert('sigh_hospitales',$data);
        $sqlLastID= $this->config_mdl->sqlGetLastId('sigh_hospitales','hospital_id');
        $this->config_mdl->sqlInsert('sigh_hospitales_equipos',array(
            'hospital_id'=>$sqlLastID,
            'equipo_ip'=>$_SERVER['REMOTE_ADDR'],
            'equipo_descripcion'=>'Administrador',
            'equipo_acceso_area'=>'',
            'equipo_acceso_fecha'=>'',
            'equipo_estado'=>'Offline',
            'empleado_id'=>'',
        ));
        $this->setOutput(array('accion'=>'ok'));
    }
    public function getAreas() {
        $sql_rol=  $this->config_mdl->sqlGetData('sigh_areasacceso');
        $option='<option value="">SELECCIONAR ÁREA...</option>';
        foreach ($sql_rol as $value) {
            if($value['areas_acceso_status']==''):
                $option.='<option value="'.$value['areas_acceso_id'].'">'.$value['areas_acceso_nombre'] .'</option>';
            endif;
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxCambiarArea() {
        $empleado_id=$this->UMAE_USER;
        $sqlGetRol= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_id'=>$this->input->post('areas_acceso_id')
        ))[0];
        $sql_roles=  $this->config_mdl->_get_data_condition('sigh_empleados_roles',array(
            'empleado_id'=> $empleado_id,
            'rol_id'=>$sqlGetRol['areas_acceso_rol']
        ));
        if(!empty($sql_roles)){
            $_SESSION['UMAE_USER']=$empleado_id;
            $_SESSION['UMAE_AREA']=  $sqlGetRol['areas_acceso_nombre'];
            $this->config_mdl->_update_data('sigh_empleados',array(
                'empleado_area_acceso'=>$sqlGetRol['areas_acceso_nombre'],
                'empleado_acceso_f'=>  date('d/m/Y'),
                'empleado_acceso_h'=>  date('H:i') ,
                'empleado_conexion'=>  '1'
            ),array(
                'empleado_id'=>$empleado_id
            ));
            $this->config_mdl->sqlUpdate('sigh_hospitales_equipos',array(
                'equipo_acceso_area'=>$sqlGetRol['areas_acceso_nombre'],
                'equipo_acceso_fecha'=> date('Y-m-d H:i:s'),
                'equipo_estado'=>'Online',
                'empleado_id'=>$empleado_id
            ),array(
                'equipo_ip'=>$_SERVER['REMOTE_ADDR']
            ));
            $this->setOutput(array('ACCESS_LOGIN'=>'ACCESS'));
        }else{
            $this->setOutput(array('ACCESS_LOGIN'=>'AREA_NO_ROL'));
        }
    }
    public function AjaxTestServer() {
        $this->setOutput(array('action'=>'SERVER STATUS:OK'));
    }
    public function NoPuedoIngresar() {
        $this->load->view('Login/NoPuedoIngresar');
    }
}
