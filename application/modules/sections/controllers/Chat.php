<?php

/**
 * Description of Chat
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Chat extends Config{
    public function index() {
        $sql['Usuarios']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_empleados LIMIT 100");
        $this->load->view('Chat/index',$sql);
    }
    public function v2() {
        $this->load->view('Chat/v2');
    }
    public function AjaxMessages() {
        $chatDe= $this->input->get_post('chat_de');
        $chatPara= $this->input->get_post('chat_para');
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_chat AS c WHERE 
        c.chat_de=$chatDe AND c.chat_para=$chatPara OR c.chat_de=$chatPara AND c.chat_para=$chatDe ORDER BY c.chat_id ASC");
        $this->setOutput($sql);
    }
    public function AjaxSearch() {
        $inputMatricula= $this->input->post('inputMatricula');
        $sql= $this->config_mdl->sqlQuery("SELECT em.empleado_id,em.empleado_matricula,em.empleado_nombre, em.empleado_ap,em.empleado_ap, em.empleado_perfil FROM sigh_empleados AS em WHERE em.empleado_matricula LIKE'%$inputMatricula%' ");
        $this->setOutput(array(
            sql=>$sql
        ));
    }
    public function AjaxListaUsers() {
        $sql= $this->config_mdl->sqlQuery("SELECT em.empleado_id,em.empleado_matricula,em.empleado_nombre, em.empleado_ap, em.empleado_am, em.empleado_socket_id, em.empleado_perfil FROM sigh_empleados AS em WHERE em.empleado_socket_id!=''");
        $this->setOutput(array(
            sql=>$sql
        ));
    }
    public function AjaxGetNewChats() {
        $chat_para= $this->input->post('chat_para');
        $chat_de= $this->input->post('chat_de');
        $sqlDe= $this->config_mdl->sqlQuery("SELECT emp.empleado_socket_id FROM sigh_empleados AS emp WHERE empleado_id=$chat_de");
        $sqlPara= $this->config_mdl->sqlQuery("SELECT emp.empleado_socket_id FROM sigh_empleados AS emp WHERE empleado_id=$chat_para");
        $this->setOutput(array('chat_msj'=>1));
    }
    public function AjaxGetSocket() {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $this->input->post('empleado_id')
        ))[0];
        $this->setOutput(array('empleado_socket_id'=>$sql['empleado_socket_id']));
        
    }
}
