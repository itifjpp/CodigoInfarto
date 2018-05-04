<?php

/**
 * Description of AsistentesMedicas
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class AsistentesMedicas extends Config{
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_accesos, os_empleados, os_asistentesmedicas
            WHERE 
            os_accesos.acceso_tipo='Asistente Médica Ortopedia' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_asistentesmedicas.asistentesmedicas_id AND
            os_empleados.empleado_id=$this->UMAE_USER ORDER BY os_accesos.acceso_id DESC LIMIT 10");
        $this->load->view('AsistenteMedica/index',$sql);
    }
    public function Paciente($Paciente) {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
           'triage_id'=>  $Paciente
        ));
        $sql['solicitud']= $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
           'triage_id'=> $Paciente
        ));
        $sql['empleado']= $this->config_mdl->_get_data_condition('os_empleados',array(
           'empleado_id'=> $this->UMAE_USER
        ));
        $sql['DirPaciente']=  $this->config_mdl->_get_data_condition('os_triage_directorio',array(
           'triage_id'=>  $Paciente,
            'directorio_tipo'=>'Paciente'
        ))[0];
        $sql['DirEmpresa']=  $this->config_mdl->_get_data_condition('os_triage_directorio',array(
           'triage_id'=>  $Paciente,
            'directorio_tipo'=>'Empresa'
        ))[0];
        $sql['Empresa']=  $this->config_mdl->_get_data_condition('os_triage_empresa',array(
           'triage_id'=>  $Paciente,
        ))[0];
        $sql['PINFO']=  $this->config_mdl->_get_data_condition('paciente_info',array(
           'triage_id'=>  $Paciente,
        ))[0];
        $this->load->view('AsistenteMedica/Paciente',$sql);
    }
    public function AjaxGuardar() {
        $info=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $this->input->post('triage_id')
        ))[0];
        $am=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->post('triage_id')
        ))[0];
        if($info['triage_crea_am']==''){     
            $this->AccesosUsuarios(array('acceso_tipo'=>'Asistente Médica Ortopedia','triage_id'=>$this->input->post('triage_id'),'areas_id'=>$am['asistentesmedicas_id']));
        }
        $data=array(
            'asistentesmedicas_fecha'=> date('Y-m-d'),
            'asistentesmedicas_hora'=> date('H:i'), 
            'asistentesmedicas_hoja'=>  $this->input->post('asistentesmedicas_hoja'),
            'asistentesmedicas_renglon'=>  $this->input->post('asistentesmedicas_renglon'),
            'asistentesmedicas_exectuar_st7'=> $this->input->post('asistentesmedicas_exectuar_st7'),
            'triage_id'=>  $this->input->post('triage_id')
        );
        if($am['asistentesmedicas_fecha']!=''){
            unset($data['asistentesmedicas_fecha']);
            unset($data['asistentesmedicas_hora']);
            
        }
        $this->config_mdl->_update_data('os_asistentesmedicas',$data,
                array('triage_id'=>  $this->input->post('triage_id'))
        );
        $data_triage=array(
            'triage_nombre'=>  $this->input->post('triage_nombre'),
            'triage_nombre_ap'=>$this->input->post('triage_nombre_ap') ,
            'triage_nombre_am'=>$this->input->post('triage_nombre_am') ,
            'triage_paciente_sexo'=> $this->input->post('triage_paciente_sexo'),
            'triage_fecha_nac'=>  $this->input->post('triage_fecha_nac'),
            'triage_paciente_estadocivil'=>  $this->input->post('triage_paciente_estadocivil'),
            'triage_paciente_curp'=>  $this->input->post('triage_paciente_curp'),
            'triage_crea_am'=> $this->UMAE_USER
        ); 
        $this->config_mdl->_update_data('paciente_info',array(
            'pum_nss'=>$this->input->post('pum_nss'),
            'pum_nss_agregado'=>$this->input->post('pum_nss_agregado'),
            'pum_umf'=>$this->input->post('pum_umf'),
            'pum_delegacion'=>$this->input->post('pum_delegacion'),
            'pic_identificacion'=>$this->input->post('pic_identificacion'),
            'pic_responsable_nombre'=>$this->input->post('pic_responsable_nombre'),
            'pic_responsable_parentesco'=>$this->input->post('pic_responsable_parentesco'),
            'pic_responsable_telefono'=>$this->input->post('pic_responsable_telefono'),
            'pic_mt'=> $this->input->post('pic_mt'),
            'pic_am'=> $this->input->post('pic_am'), 
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        Modules::run('Triage/TriagePacienteDirectorio',array(
            'directorio_tipo'=>'Paciente',
            'directorio_cp'=> $this->input->post('directorio_cp'),
            'directorio_cn'=> $this->input->post('directorio_cn'),
            'directorio_colonia'=> $this->input->post('directorio_colonia'),
            'directorio_municipio'=> $this->input->post('directorio_municipio'),
            'directorio_estado'=> $this->input->post('directorio_estado'),
            'directorio_telefono'=> $this->input->post('directorio_telefono'),
            'triage_id'=>$this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_triage',$data_triage,
                array('triage_id'=>  $this->input->post('triage_id'))
        );
        $this->setOutput(array('accion'=>'1'));        
        
    }
}
