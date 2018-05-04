<?php

/**
 * Description of Um
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Um extends Config{
    public function Encuestas() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('um_ensat_encuestas');
        $this->load->view('Encuestas',$sql);
    }
    public function AjaxEncuesta() {
        $data=array(
            'encuesta_nombre'=> $this->input->post('encuesta_nombre'),
            'encuesta_estado'=> $this->input->post('encuesta_estado')
        );
        if($this->input->post('encuesta_accion')=='add'){
            $this->config_mdl->_insert('um_ensat_encuestas',$data);
        }else{
            $this->config_mdl->_update_data('um_ensat_encuestas',$data,array(
                'encuesta_id'=> $this->input->post('encuesta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function EncuestaPreguntas() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM um_ensat_encuestas, um_ensat_encuesta_preg WHERE
                                                    um_ensat_encuestas.encuesta_id=um_ensat_encuesta_preg.encuesta_id AND
                                                    um_ensat_encuestas.encuesta_id=".$_GET['enc']);
        $this->load->view('EncuestasPreguntas',$sql);
    }
    public function AjaxEncuestaPreguntas() {
        $data=array(
            'pregunta_nombre'=> $this->input->post('pregunta_nombre'),
            'encuesta_id'=> $this->input->post('encuesta_id')
        );
        if($this->input->post('pregunta_accion')=='add'){
            $this->config_mdl->_insert('um_ensat_encuesta_preg',$data);
        }else{
            $this->config_mdl->_update_data('um_ensat_encuesta_preg',$data,array(
                'pregunta_id'=> $this->input->post('pregunta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function EncuestaPreguntasRespuetas() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM 
                                                    um_ensat_encuesta_preg, um_ensat_encuesta_preg_res WHERE
                                                    um_ensat_encuesta_preg.pregunta_id=um_ensat_encuesta_preg_res.pregunta_id AND
                                                    um_ensat_encuesta_preg.pregunta_id=".$_GET['pregunta']);
        $this->load->view('encuestasPreguntasRespuetas',$sql);
    }
    public function AjaxencuestaPreguntasRespuetas(){
        $data=array(
            'respuesta_nombre'=> $this->input->post('respuesta_nombre'),
            'respuesta_icon'=> $this->input->post('respuesta_icon'),
            'pregunta_id'=> $this->input->post('pregunta_id')
        );
        if($this->input->post('respuesta_accion')=='add'){
            $this->config_mdl->_insert('um_ensat_encuesta_preg_res',$data);
        }else{
            $this->config_mdl->_update_data('um_ensat_encuesta_preg_res',$data,array(
                'respuesta_id'=> $this->input->post('respuesta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarRespuestas() {
        $this->config_mdl->_delete_data('um_ensat_encuesta_preg_res',array(
            'respuesta_id'=> $this->input->post('respuesta_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Paciente() {
        $sql['Encuestas']= $this->config_mdl->sqlGetDataCondition('um_ensat_encuestas',array(
            'encuesta_estado'=>'true'
        ));
        $this->load->view('encuestaPaciente',$sql);
    }
    public function AjaxValidarPaciente() {
        $sql= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function Encuesta() {
        $sql['Encuestas']= $this->config_mdl->sqlGetDataCondition('um_ensat_encuestas',array(
            'encuesta_estado'=>'true'
        ));
        $this->load->view('Encuesta',$sql);
    }
    public function AjaxResultadoEncuestas() {
        $this->config_mdl->_insert('um_ensat_encuestas_resultados',array(
            'resultado_fecha'=> date('Y-m-d'),
            'resultado_hora'=> date('H:i:s'),
            'resultado_turno'=> $this->ObtenerTurno(),
            'respuesta_id'=> $this->input->post('respuesta_id'),
            'pregunta_id'=> $this->input->post('pregunta_id'),
            'encuesta_id'=> $this->input->post('encuesta_id'),
            'triage_tipo'=> $this->input->post('triage_tipo'),
            'triage_id'=> $this->input->post('triage_id'),
        ));
        $this->setOutputV2($this->input->post());
    }
}
