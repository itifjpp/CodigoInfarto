<?php

/**
 * Description of Codigos
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Codigos extends Config{
    public function index(){
        $sql['Gestion']= $this->config_mdl->sqlGetData('um_codigos');
        $this->load->view('Codigos/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_codigos',array(
            'ci_id'=>$_GET['ci']
        ))[0];
        $this->load->view('Codigos/Agregar',$sql);
    }
    public function AjaxAgregar() {
        $data=array(
            'ci_codigo'=> $this->input->post('ci_codigo'),
            'ci_color'=> $this->input->post('ci_color'),
            'ci_color_hex'=> $this->input->post('ci_color_hex')
        );
        if($this->input->post('ci_accion')=='add'){
            $this->config_mdl->sqlInsert('um_codigos',$data);
        }else{
            $this->config_mdl->sqlUpdate('um_codigos',$data,array(
                'ci_id'=> $this->input->post('ci_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function getCodigos() {
        $sql= $this->config_mdl->sqlGetData('um_codigos');
        $this->setOutput(array('sql'=>$sql));
    }
    public function Fase1() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM um_codigos AS ci, um_codigos_f1 AS ci_f1 WHERE
                                        ci.ci_id=ci_f1.ci_id AND ci.ci_id=".$_GET['ci']);
        $this->load->view('Codigos/Fase1',$sql);
    }
    public function AgregarFase1() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_codigos_f1',array(
            'ci_f1_id'=>$_GET['f1']
        ))[0];
        $this->load->view('Codigos/Fase1Agregar',$sql);
    }
    public function AjaxAgregarF1() {
        $data=array(
            'ci_f1_fase'=> $this->input->post('ci_f1_fase'),
            'ci_f1_tiempo'=> $this->input->post('ci_f1_tiempo'),
            'ci_id'=> $this->input->post('ci_id')
        );
        if($this->input->post('f1_accion')=='add'){
            $this->config_mdl->sqlInsert('um_codigos_f1',$data);
        }else{
            $this->config_mdl->sqlUpdate('um_codigos_f1',$data,array(
                'ci_f1_id'=> $this->input->post('ci_f1_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    
    public function Fase2() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM um_codigos_f1 AS f1, um_codigos_f2 AS ci_f2 WHERE
                                                        f1.ci_f1_id=ci_f2.ci_f1_id AND f1.ci_f1_id=".$_GET['f1']);
        $this->load->view('Codigos/Fase2',$sql);
    }
    public function AgregarFase2() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_codigos_f2',array(
            'ci_f2_id'=>$_GET['f2']
        ))[0];
        $this->load->view('Codigos/Fase2Agregar',$sql);
    }
    public function AjaxAgregarF2() {
        $data=array(
            'ci_f2_fase'=> $this->input->post('ci_f2_fase'),
            'ci_f2_tiempo'=> $this->input->post('ci_f2_tiempo'),
            'ci_f1_id'=> $this->input->post('ci_f1_id')
        );
        if($this->input->post('f2_accion')=='add'){
            $this->config_mdl->sqlInsert('um_codigos_f2',$data);
        }else{
            $this->config_mdl->sqlUpdate('um_codigos_f2',$data,array(
                'ci_f2_id'=> $this->input->post('ci_f2_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function Fase3() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM um_codigos_f2 AS f2, um_codigos_f3 AS f3 WHERE
                                                        f2.ci_f2_id=f3.ci_f2_id AND f2.ci_f2_id=".$_GET['f2']);
        $this->load->view('Codigos/Fase3',$sql);
    }
    public function AgregarFase3() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_codigos_f3',array(
            'ci_f3_id'=>$_GET['f3']
        ))[0];
        $this->load->view('Codigos/Fase3Agregar',$sql);
    }
    public function AjaxAgregarF3() {
        $data=array(
            'ci_f3_fase'=> $this->input->post('ci_f3_fase'),
            'ci_f3_tiempo'=> $this->input->post('ci_f3_tiempo'),
            'ci_f2_id'=> $this->input->post('ci_f2_id')
        );
        if($this->input->post('f3_accion')=='add'){
            $this->config_mdl->sqlInsert('um_codigos_f3',$data);
        }else{
            $this->config_mdl->sqlUpdate('um_codigos_f3',$data,array(
                'ci_f3_id'=> $this->input->post('ci_f3_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
}
