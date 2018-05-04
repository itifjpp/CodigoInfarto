<?php

/**
 * Description of Vigilancia
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Vigilancia extends Config{
    public function Accesos() {
        $this->load->view('Accesos/Accesos');
    }
    public function AjaxAccesos() {

        $sqlCheck= $this->config_mdl->sqlGetDataCondition("um_pases_visitas",array(
            'triage_id'=>$this->input->post('triage_id')
        ));
        if(!empty($sqlCheck)){
            $this->setOutput(array(
                'accion'=>'1',
                'pv_tipo'=>$sqlCheck[0]['pv_tipo']
            ));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function Paciente($Paciente) {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['Familiares']= $this->config_mdl->sqlGetDataCondition('um_poc_familiares',array(
            'triage_id'=>$Paciente
        ));
        $this->load->view('Accesos/Paciente',$sql);
    }
    public function AjaxIngresoFamiliar() {
        if($this->input->post('familiar_acceso')=='EN VISITA'){
            $this->config_mdl->sqlUpdate('um_poc_familiares',array(
                'familiar_acceso'=>$this->input->post('familiar_acceso'),
                'familiar_if'=> date('Y-m-d'),
                'familiar_ih'=> date('H:i:s')
            ),array(
                'familiar_id'=> $this->input->post('familiar_id')
            ));
        }else{
            $this->config_mdl->sqlUpdate('um_poc_familiares',array(
                'familiar_acceso'=>$this->input->post('familiar_acceso'),
                'familiar_sf'=> date('Y-m-d'),
                'familiar_sh'=> date('H:i:s')
            ),array(
                'familiar_id'=> $this->input->post('familiar_id')
            ));
        }
        
        $this->setOutput(array('accion'=>'1'));
    }
}
