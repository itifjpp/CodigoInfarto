<?php

/**
 * Description of Protocolos
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Protocolos extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('sigh_protocolos',array(
            'empleado_id'=> $this->UMAE_USER
        ));
        $this->load->view('Protocolos/index',$sql);
    }
    public function AjaxAgregar() {
        $data=array(
            'protocolo_nombre'=> $this->input->post('protocolo_nombre'),
            'protocolo_descripcion'=> $this->input->post('protocolo_descripcion'),
            'empleado_id'=> $this->UMAE_USER
        );
        if($this->input->post('protocolo_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_protocolos',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_protocolos',$data,array(
                'protocolo_id'=> $this->input->post('protocolo_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function Pacientes() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("  SELECT 
                                                            prot.protocolo_id,
                                                            emp.empleado_id, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am FROM sigh_empleados AS emp, sigh_protocolos AS prot, sigh_protocolos_pacientes AS pp 
                                                        WHERE pp.protocolo_id=prot.protocolo_id AND
                                                              pp.empleado_id=emp.empleado_id AND 
                                                              pp.protocolo_id=".$_GET['protocolo']);
        $this->load->view('Protocolos/index_pacientes',$sql);
    }
    public function BuscarPacientes() {
        $this->load->view('Protocolos/index_buscar');
    }
    public function AjaxBuscarPaciente() {
        $inputSearch= $this->input->post('empleado_nombre');
        $sql= $this->config_mdl->sqlQuery("SELECT empleado_id, CONCAT_WS(' ',emp.empleado_nombre,emp.empleado_ap,emp.empleado_ap) AS empleado_nombre 
                FROM sigh_empleados AS emp HAVING empleado_nombre LIKE '%$inputSearch%' LIMIT 200");
        $tr='';
        foreach ($sql as $value) {
            $tr.=   '<tr>
                        <td>'.$value['empleado_nombre'].' '.$value['empleado_ap'].' '.$value['empleado_am'].'</td>
                        <td>
                            <i class="fa fa-user-plus sigh-color i-20 pointer protocolo-agregar-usuario" data-id="'.$value['empleado_id'].'"></i>
                        </td>
                    </tr>';
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function AjaxUsuarioProtocolo() {
        $sql=$this->config_mdl->sqlGetDataCondition('sigh_protocolos_pacientes',array(
            'protocolo_id'=> $this->input->post('protocolo_id'),
            'empleado_id'=> $this->input->post('empleado_id')
        ));
        if(empty($sql)){
            $this->config_mdl->sqlInsert('sigh_protocolos_pacientes',array(
                'protocolo_id'=> $this->input->post('protocolo_id'),
                'empleado_id'=> $this->input->post('empleado_id')
            ));
            $this->setOutput(array('action'=>1));
        }else{
            $this->setOutput(array('action'=>2));
        }
    }
    public function Chat() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $this->input->get_post('emp')
        ))[0];
        $this->load->view('Protocolos/index_chat',$sql);
    }
}
