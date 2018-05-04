<?php

/**
 * Description of DistribucionPersonal
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class DistribucionPersonal extends Config{
    public function index(){
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_distribucion AS dis, sigh_empleados AS em WHERE
                                                         dis.empleado_id=em.empleado_id ORDER BY dis.distribucion_id DESC");
        $this->load->view('Dp/index',$sql);
    }
    public function Agregar() {
        $sql['Empleados']= $this->config_mdl->sqlGetData('sigh_empleados');
        $this->load->view('Dp/Agregar',$sql);
    }
    public function AjaxAgregar(){
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_distribucion',array(
            'distribucion_fecha'=> $this->input->post('distribucion_fecha'),
            'distribucion_turno'=> $this->input->post('distribucion_turno'),
        ));
        if(empty($sqlCheck)){
            $this->config_mdl->sqlInsert('sigh_distribucion',array(
                'distribucion_fecha'=> $this->input->post('distribucion_fecha'),
                'distribucion_s_fecha'=> date('Y-m-d'),
                'distribucion_s_hora'=> date('H:i:s'),
                'distribucion_turno'=> $this->input->post('distribucion_turno'),
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'3'));
        }
    }
    public function Personal() {
        $sql['Dp']= $this->config_mdl->sqlGetDataCondition('sigh_distribucion',array(
            'distribucion_id'=>$_GET['dp']
        ))[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados AS em, sigh_distribucion_personal AS dp WHERE
                                                    dp.empleado_id=em.empleado_id AND dp.distribucion_id=".$_GET['dp']);
        $this->load->view('Dp/Personal',$sql);
    }
    public function AjaxBuscarEmpleado() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=> $this->input->post('empleado_matricula')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1','sql'=>$sql[0]));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxAgregarPersonal() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_distribucion_personal',array(
            'distribucion_id'=> $this->input->post('distribucion_id'),
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sql)){
            $this->config_mdl->sqlInsert('sigh_distribucion_personal',array(
                'dp_area'=> $this->input->post('dp_area'),
                'dp_tipo'=>$this->input->post('dp_tipo'),
                'empleado_id'=> $this->input->post('empleado_id'),
                'distribucion_id'=> $this->input->post('distribucion_id')
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxEliminarPersonal() {
        $this->config_mdl->sqlDelete('sigh_distribucion_personal',array(
            'dp_id'=> $this->input->post('dp_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
