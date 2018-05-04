<?php

/**
 * Description of Vigencias
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Vigencias extends Config{
    public function index() {
        $this->load->view('Vigencias/index');
    }
    public function AjaxCheckPaciente() {
        $sql= $this->config_mdl->sqlQuery("SELECT t.triage_nombre, t.triage_nombre_ap, t.triage_nombre_am, pic.pum_nss, pic.pum_nss_agregado, t.triage_paciente_sexo FROM paciente_info pic, os_triage t WHERE
                                            t.triage_id=pic.triage_id AND t.triage_id=".$this->input->post('triage_id'));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1','msj'=>''));
        }else{
            $this->setOutput(array('accion'=>'2','msj'=>'EL N° DE FOLIO NO EXISTE'));
        }
    }
    public function Paciente() {
        $sql['info']=$this->config_mdl->sqlQuery("  SELECT t.triage_nombre, t.triage_nombre_ap, t.triage_nombre_am, pic.pum_nss, pic.pum_nss_agregado, t.triage_paciente_sexo,
                                                    pic.info_vigencia_acceder,pic.info_vigencia_arimac,pic.info_vigencia_autorizacion_tipo,pic.info_vigencia_autorizacion
                                                    FROM paciente_info pic, os_triage t WHERE
                                                    t.triage_id=pic.triage_id AND t.triage_id=".$this->input->get_post('folio'))[0];
        $this->load->view('Vigencias/Paciente',$sql);
    }
    public function AjaxAutorizacionTipos() {
        $sql= $this->config_mdl->sqlGetData('um_arimac_aut_tipo');
        $opt='';
        foreach ($sql as $value) {
            $opt.='<option value="'.$value['autorizacion_tipo'].'">'.$value['autorizacion_tipo'].'</option>';
        }
        $this->setOutput(array('option'=>$opt));
    }
    public function AjaxAutorizacionVigencia() {
        $this->config_mdl->sqlUpdate('paciente_info',array(
            'info_vigencia_arimac'=> $this->input->post('info_vigencia_arimac'),
            'info_vigencia_autorizacion'=> $this->UMAE_USER,
            'info_vigencia_autorizacion_tipo'=> $this->input->post('info_vigencia_autorizacion_tipo')
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
}
