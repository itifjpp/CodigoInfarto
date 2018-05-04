<?php

/**
 * Description of Especialidades
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Especialidades extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_especialidades');
        $this->load->view('Especialidades/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
            'especialidad_id'=>$_GET['es']
        ))[0];
        $this->load->view('Especialidades/Agregar',$sql);
    }
    public function AjaxGuardarEspecialidad() {
        $data=array(
            'especialidad_nombre'=> $this->input->post('especialidad_nombre'),
            'especialidad_subespecialidades'=> $this->input->post('especialidad_subespecialidades'),
            'especialidad_consultorios'=> $this->input->post('especialidad_consultorios'),
            'especialidad_43029'=> $this->input->post('especialidad_43029')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_especialidades',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_especialidades',$data,array(
                'especialidad_id'=> $this->input->post('especialidad_id')
            ));
        }
        $this->setOutput(array(
            'accion'=>'1'
        ));
    }
    public function AjaxEliminarEspecialidad() {
        $this->config_mdl->sqlDelete('sigh_especialidades',array(
            'especialidad_id'=> $this->input->post('especialidad_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    /*Subespecialidad*/
    public function Subespecialidad() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM um_especialidades, um_especialidades_sub WHERE 
                                                    um_especialidades.especialidad_id=um_especialidades_sub.especialidad_id AND 
                                                    um_especialidades.especialidad_id=".$_GET['es']);
        $this->load->view('Especialidades/Subespecialidad',$sql);
    }
    public function SubespecialidadAgregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_especialidades_sub',array(
            'sub_id'=>$_GET['sub']
        ))[0];
        $this->load->view('Especialidades/SubespecialidadAgregar',$sql);
    }
    public function AjaxSubespecialidadAgregar() {
        $data=array(
            'sub_nombre'=> $this->input->post('sub_nombre'),
            'especialidad_id'=> $this->input->post('especialidad_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('um_especialidades_sub',$data);
        }else{
            $this->config_mdl->_update_data('um_especialidades_sub',$data,array(
                'sub_id'=> $this->input->post('sub_id')
            ));
        }
        $this->setOutput(array(
            'accion'=>'1'
        ));
    }
    /*Consultotorios*/
    public function Consultorios() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_especialidades AS esp, sigh_especialidades_consultorios AS con WHERE
                                                    esp.especialidad_id=con.especialidad_id AND
                                                    esp.especialidad_id=".$_GET['es']);
        $this->load->view('Especialidades/Consultorios',$sql);
    }
    public function AgregarConsultorios() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_especialidades_consultorios',array(
            'consultorio_id'=>$_GET['cons']
        ))[0];
        $this->load->view('Especialidades/ConsultoriosAgregar',$sql);
    }
    public function AjaxAgregarConsultorios() {
        $data=array(
            'consultorio_nombre'=> $this->input->post('consultorio_nombre'),
            'consultorio_especialidad'=> $this->input->post('consultorio_especialidad'),
            'especialidad_id'=> $this->input->post('especialidad_id')
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_especialidades_consultorios',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_especialidades_consultorios',$data,array(
                'consultorio_id'=> $this->input->post('consultorio_id')
            ));
        }
        $this->setOutput(array(
            'accion'=>'1'
        ));
    }
    public function AjaxEliminarConsultorio() {
        $this->config_mdl->sqlDelete('sigh_especialidades_consultorios',array(
            'consultorio_id'=> $this->input->post('consultorio_id')
        ));
        $this->setOutput(array('action'=>1));
    }
    /*Configuración de Documentos del Expediente*/
    public function Documentos() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_documentos');
        $this->load->view('Especialidades/Documentos',$sql);
    }
    public function DocumentosNuevo() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_documentos',array(
            'doc_id'=>$_GET['doc']
        ))[0];
        $this->load->view('Especialidades/DocumentosAgregar',$sql);
    }
    public function AjaxDocumentosNuevo() {
        $data=array(
            'doc_nombre'=> $this->input->post('documento_nombre'),
            'doc_tipo'=> 'NOTAS FORMATO 4 30 128'
        );
        if($this->input->post('documento_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_documentos',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_documentos',$data,array(
                'doc_id'=> $this->input->post('documento_id')
            ));
        }
        
        $this->setOutput(array('action'=>1));
    }
    public function AjaxEliminarDocumentos(){
        $this->config_mdl->sqlDelete('sigh_documentos',array(
            'doc_id'=> $this->input->post('doc_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
