<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Multimedia
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Multimedia extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->_get_data('sec_multimedia');
        $this->load->view('Multimedia/index',$sql);
    }
    public function Agregar() {
        $sql['info']= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=> $this->input->get('m')
        ))[0];
        $this->load->view('Multimedia/Agregar',$sql);
    }
    public function AjaxAgregar() {
        $multimedia_url=$_FILES['multimedia_url']['name'];
        $multimedia_url_tmp=$_FILES['multimedia_url']['tmp_name'];
        $multimedia_ext= end(explode('.', $multimedia_url));
        copy($multimedia_url_tmp, 'assets/multimedia/'.$multimedia_url);
        $data=array(
            'multimedia_fecha'=> date('d/m/Y'),
            'multimedia_hora'=> date('H:i'),
            'multimedia_status'=>'No Publicado',
            'multimedia_titulo'=> $this->input->post('multimedia_titulo'),
            'multimedia_url'=> $multimedia_url,
            'multimedia_ext'=>$multimedia_ext
        );
        $this->config_mdl->_update_data('sec_multimedia',$data,array(
            'multimedia_id'=> $this->input->post('multimedia_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxMultimedia() {
        $sql_s1= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=>1,
            'multimedia_status'=>'Publicado'
        ));
        $sql_s2= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=>2,
            'multimedia_status'=>'Publicado'
        ));
        $sql_s3= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=>3,
            'multimedia_status'=>'Publicado'
        ));
        $this->setOutput(array(
            'MULTIMEDIA_1'=> count($sql_s1),
            'MULTIMEDIA_2'=> count($sql_s2),
            'MULTIMEDIA_3'=> count($sql_s3)
        ));
    }
    public function AjaxLoadMultimedia() {
        $sql_s1= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=>1,
            'multimedia_status'=>'Publicado'
        ));
        $sql_s2= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=>2,
            'multimedia_status'=>'Publicado'
        ));
        $sql_s3= $this->config_mdl->_get_data_condition('sec_multimedia',array(
            'multimedia_id'=>3,
            'multimedia_status'=>'Publicado'
        ));
        if(!empty($sql_s1)){
            $result_m1='<video  autoplay="" style="width:100%;height:266px" loop="true" muted>
                                    <source src="'. base_url().'assets/multimedia/'.$sql_s1[0]['multimedia_url'].'"  type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
            $MULTIMEDIA_1_TIPO='Video';
        }else{
            $MULTIMEDIA_1_TIPO='';
            $result_m1='<img src="'. base_url().'assets/multimedia/ser-imss.jpg" style="width: 100%;margin-top: 5px;height: 266px;">';
        }
        if(!empty($sql_s2)){
            $MULTIMEDIA_2_TIPO='Imagen';
            $result_m2='<img src="'. base_url().'assets/multimedia/'.$sql_s2[0]['multimedia_url'].'" style="width: 100%;margin-top: 5px;height: 174px;">';
        }else{
            $MULTIMEDIA_2_TIPO='';
            $result_m2='<img src="'. base_url().'assets/multimedia/ser-imss.jpg" style="width: 100%;margin-top: 5px;height: 174px;">';
        }
        if(!empty($sql_s3)){
            $result_m3='<audio autoplay loop="true"  >
                                    <source src="'. base_url().'assets/multimedia/'.$sql_s3[0]['multimedia_url'].'"  type="audio/mpeg">
                                </audio>';
            $MULTIMEDIA_3_TIPO='Audio';
        }else{
            $MULTIMEDIA_3_TIPO='';
            $result_m3='';
        }
        $this->setOutput(array(
            'MULTIMEDIA_1'=> count($sql_s1),
            'MULTIMEDIA_2'=> count($sql_s2),
            'MULTIMEDIA_3'=> count($sql_s3),
            'MULTIMEDIA_1_RES'=>$result_m1,
            'MULTIMEDIA_1_TIPO'=>$MULTIMEDIA_1_TIPO,
            'MULTIMEDIA_2_RES'=>$result_m2,
            'MULTIMEDIA_2_TIPO'=>$MULTIMEDIA_2_TIPO,
            'MULTIMEDIA_3_RES'=>$result_m3,
            'MULTIMEDIA_3_TIPO'=>$MULTIMEDIA_3_TIPO
        ));
    }
    public function AjaxPublicacion() {
        $this->config_mdl->_update_data('sec_multimedia',array(
            'multimedia_status'=> $this->input->post('multimedia_accion')
        ),array(
            'multimedia_id'=> $this->input->post('multimedia_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
