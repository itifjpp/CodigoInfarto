<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of AdmisionHospitalaria
 *
 * @author felipe de jesus <itifjpp@gmail.com/>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Arimac extends Config{
    public function index(){
        $this->load->view('index');
    }
    public function AjaxBuscarPaciente(){
        $sqlPaciente=$this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$this->input->post('triage_id')
        ));
        if(!empty($sqlPaciente)){
            
            $this->setOutput(array('accion'=>'1','info'=>$sqlPaciente[0],'pum'=>$sqlPUM));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function Paciente($Paciente){
        $sql['info']=$this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['pum']=$this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['DirPaciente']=$this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Paciente',
            'triage_id'=>$Paciente
        ))[0];
        $sql['DirEmpresa']=$this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Empresa',
            'triage_id'=>$Paciente
        ))[0];
        $sql['Empresa']=$this->config_mdl->_get_data_condition('os_triage_empresa',array(
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('paciente',$sql);
    }
    public function AjaxExpediente(){
        $this->config_mdl->_update_data('os_triage',array(
            'triage_nombre'=>  $this->input->post('triage_nombre'),
            'triage_nombre_ap'=>$this->input->post('triage_nombre_ap') ,
            'triage_nombre_am'=>$this->input->post('triage_nombre_am') ,
            'triage_paciente_curp'=> $this->input->post('triage_paciente_curp')
        ),array(
            'triage_id'=> $this->input->post('triage_id_val')
        ));
        $this->config_mdl->_update_data('paciente_info',array(
            'pum_nss'=>$this->input->post('pum_nss'),
            'pum_nss_agregado'=>$this->input->post('pum_nss_agregado'),
            'pum_umf'=>$this->input->post('pum_umf'),
            'pum_delegacion'=>$this->input->post('pum_delegacion')
        ),array(
            'triage_id'=> $this->input->post('triage_id_val')
        ));
        Modules::run('Triage/TriagePacienteDirectorio',array(
            'directorio_tipo'=>'Paciente',
            'directorio_cp'=> $this->input->post('directorio_cp'),
            'directorio_cn'=> $this->input->post('directorio_cn'),
            'directorio_colonia'=> $this->input->post('directorio_colonia'),
            'directorio_municipio'=> $this->input->post('directorio_municipio'),
            'directorio_estado'=> $this->input->post('directorio_estado'),
            'directorio_telefono'=> $this->input->post('directorio_telefono'),
            'triage_id'=>$this->input->post('triage_id_val')
        ));
        if($this->input->post('directorio_cp_2')!=''){
            Modules::run('Triage/TriagePacienteDirectorio',array(
                'directorio_tipo'=>'Empresa',
                'directorio_cp'=> $this->input->post('directorio_cp_2'),
                'directorio_cn'=> $this->input->post('directorio_cn_2'),
                'directorio_colonia'=> $this->input->post('directorio_colonia_2'),
                'directorio_municipio'=> $this->input->post('directorio_municipio_2'),
                'directorio_estado'=> $this->input->post('directorio_estado_2'),
                'directorio_telefono'=> $this->input->post('directorio_telefono_2'),
                'triage_id'=>$this->input->post('triage_id_val')
            ));
            Modules::run('Triage/TriagePacienteEmpresa',array(
                'empresa_nombre'=> $this->input->post('empresa_nombre'),
                'empresa_modalidad'=> $this->input->post('empresa_modalidad'),
                'empresa_rp'=> $this->input->post('empresa_rp'),
                'empresa_fum'=> $this->input->post('empresa_fum'),
                'empresa_tel'=> $this->input->post('empresa_tel'),
                'empresa_he'=> $this->input->post('empresa_he'),
                'empresa_hs'=>$this->input->post('empresa_hs'),
                'triage_id'=> $this->input->post('triage_id_val')
            ));   
        }
        $this->setOutput(array('accion'=>'1'));
    }
}