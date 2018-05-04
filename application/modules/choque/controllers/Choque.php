<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Choque
 *
 * @author bienTICS
 */
include_once APPPATH.'modules/config/controllers/Config.php';
include_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
class Choque extends Config{
    //construct
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->view('choque_index');
    }
    public function NuevoPaciente() {
        $this->load->view('choque_paciente');
    }
    public function AjaxGenerarFolio() {
        
        if($this->input->post('ingreso_tipopaciente')=='Identificado'){
            
            $check= $this->config_mdl->sqlGetDataCondition('sigh_pacientes',array(
                'paciente_nss'=> $this->input->post('paciente_nss'),
                'paciente_nss_agregado'=> $this->input->post('paciente_nss_agregado'),
            ));   
            if(!empty($check) && $this->input->post('paciente_nss')){
                $paciente_id= $check[0]['paciente_id'];
                $ingreso_pv='Subsecuente';
                $ingreso_valida_nss='Si';
            }else{
                $ingreso_pv='Primera vez';
                $this->config_mdl->sqlInsert('sigh_pacientes',array(
                    'paciente_pseudonimo'=>'',
                    'paciente_nombre'=> $this->input->post('paciente_nombre'),
                    'paciente_ap'=>$this->input->post('paciente_ap'),
                    'paciente_am'=>$this->input->post('paciente_am'),
                    'paciente_nss'=> $this->input->post('paciente_nss'),
                    'paciente_nss_agregado'=> $this->input->post('paciente_nss_agregado'),
                    'paciente_sexo'=> $this->input->post('paciente_sexo')
                ));
                $ingreso_valida_nss='No';
                $paciente_id= $this->config_mdl->sqlGetLastId('sigh_pacientes','paciente_id');
            }
            
        }else{
            $this->config_mdl->sqlInsert('sigh_pacientes',array(
                'paciente_pseudonimo'=> $this->input->post('paciente_nombre_pseudonimo'),
                'paciente_nombre'=>($this->input->post('paciente_am')=='' ? '': $this->input->post('paciente_nombre')),
                'paciente_ap'=>($this->input->post('paciente_ap')=='' ? '': $this->input->post('paciente_ap')),
                'paciente_am'=>($this->input->post('paciente_am')=='' ? '': $this->input->post('paciente_am')),
                'paciente_nss'=>'',
                'paciente_nss_agregado'=>'',
                'paciente_sexo'=> $this->input->post('paciente_sexo'),
                'paciente_fna'=> $this->input->post('paciente_fna')
            ));
            $ingreso_valida_nss='No';
            $paciente_id= $this->config_mdl->sqlGetLastId('sigh_pacientes','paciente_id');
        }
        
        $this->config_mdl->sqlInsert('sigh_pacientes_ingresos',array(
            'ingreso_tipopaciente'=> $this->input->post('ingreso_tipopaciente'),
            'ingreso_en'=> 'Choque',
            'ingreso_en_status'=>'Ingreso',
            'ingreso_date_horacero'=>  date('Y-m-d'),
            'ingreso_time_horacero'=>  date('H:i'),
            'ingreso_viaregistro'=> 'Choque',
            'hospital_id'=> $this->sigh->getInfo('hospital_id'),
            'ingreso_horacero_id'=> $this->UMAE_USER,
            'ingreso_pv'=>$ingreso_pv,
            'ingreso_acceder'=>'No Validado',
            'ingreso_valida_nss'=>$ingreso_valida_nss,
            'paciente_id'=>$paciente_id
        ));
        $last_id=  $this->config_mdl->sqlGetLastId('sigh_pacientes_ingresos','ingreso_id');
        if($this->input->post('paciente_sexo')=='HOMBRE'){
            $triage_paciente_sexo='OM';
        }else{
            $triage_paciente_sexo='OF';
        }
        if($this->input->post('ingreso_tipopaciente')=='No Identificado'){
            $numcon_id= $this->NumeroConsecutivo();
            $anio= substr(date('Y'), 2, 4);
            $NSS='';
            $NSS_A= date('dm').$anio.'50'.$numcon_id.$triage_paciente_sexo.$this->input->post('paciente_fna').'ND';
            $this->NumeroConsecutivoLog(array(
                'numcon_nss'=>$NSS_A,
                'numcon_id'=>$numcon_id,
                'ingreso_id'=>$last_id
            ));
            $this->config_mdl->sqlUpdate('sigh_pacientes',array(
                'paciente_nss_armado'=>$NSS_A
            ),array(
                'paciente_id'=> $paciente_id
            ));
        }else{
            if($this->input->post('paciente_nss_bol')=='No'){
                $numcon_id= $this->NumeroConsecutivo();
                $anio= substr(date('Y'), 2, 4);
                $NSS= '';
                $FechaNac= explode("-", $this->input->post('paciente_fn'))[0];
                $NSS_A= date('dm').$anio.'50'.$numcon_id.$triage_paciente_sexo.$FechaNac.'ND';
                $this->NumeroConsecutivoLog(array(
                    'numcon_nss'=>$NSS_A,
                    'numcon_id'=>$numcon_id,
                    'triage_id'=>$last_id
                ));
                $this->config_mdl->sqlUpdate('sigh_pacientes',array(
                    'paciente_nss_armado'=>$NSS_A
                ),array(
                    'paciente_id'=> $paciente_id
                ));
            }else{
                $NSS_A='';
                $NSS=$this->input->post('paciente_nss');
            }
            
        }

        $this->config_mdl->sqlInsert('sigh_choque',array(
            'choque_status'=>'Ingreso',
            'choque_vigilante'=>'En Espera',
            'choque_ingreso_f'=> date('d/m/Y'),
            'choque_ingreso_h'=> date('H:i'),
            'ingreso_id'=>$last_id,
            'empleado_id'=> $this->UMAE_USER
        ));
        $this->config_mdl->sqlInsert('sigh_pacientes_info_ing',array(
            'info_procedencia_esp'=>$this->input->post('info_procedencia_esp'),
            'info_procedencia_esp_lugar'=>$this->input->post('info_procedencia_esp_lugar'),
            'info_procedencia_hospital'=>$this->input->post('info_procedencia_hospital'),
            'info_procedencia_hospital_num'=>$this->input->post('info_procedencia_hospital_num'),
            'ingreso_id'=>$last_id
        ));
        $this->config_mdl->sqlInsert('sigh_doc43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> 'Choque',
            'doc_tipo'=>'Ingreso',
            'doc_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>  $last_id
        ));
        $this->config_mdl->sqlInsert('sigh_asistentesmedicas',array(
           'ingreso_id'=>$last_id 
        ));
        $this->logAccesos(array('acceso_tipo'=>'Hora Cero Choque','ingreso_id'=>$last_id,'areas_id'=>0));
        $this->setOutput(array('accion'=>'1','max_id'=>$last_id));
    }
    public function NumeroConsecutivoLog($data) {
        $this->config_mdl->_insert('sigh_pacientes_numcon_log',array(
            'numcon_log_fecha'=> date('d/m/Y'),
            'numcon_log_hora'=> date('H:i'),
            'numcon_nss'=>$data['numcon_nss'],
            'numcon_id'=>$data['numcon_id'],
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>$data['ingreso_id']
        ));
    }
    public function NumeroConsecutivo() {
        $hoy= date('d/m/Y');
        $numcon_id= $this->config_mdl->sqlQuery("SELECT * FROM sigh_pacientes_numcon WHERE numcon_id=(SELECT MAX(numcon_id) FROM sigh_pacientes_numcon)");
        if(!empty($numcon_id)){
            if($hoy==$numcon_id[0]['numcon_fecha']){
                return $this->LastNumeroConsecutivo();
            }else{
                $this->config_mdl->TruncateTable("sigh_pacientes_numcon");
                return $this->LastNumeroConsecutivo();
            }
        }else{
            return $this->LastNumeroConsecutivo();
        }
    }
    public function LastNumeroConsecutivo() {
        $this->config_mdl->_insert('sigh_pacientes_numcon',array(
            'numcon_fecha'=> date('d/m/Y')
        ));
        $last_id=$this->config_mdl->sqlGetLastId('sigh_pacientes_numcon','numcon_id');
        if(strlen($last_id)==1){
            $last_id_='0'.$last_id;
        }else{
            $last_id_=$last_id;
        }
        return $last_id_;
    }
    public function AsistenteMedica($Paciente) {
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
        $sql['PINFO']= $this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('choque_am',$sql);
    }
    public function AjaxAsistenteMedica() {
        
        $data=array(
            'asistentesmedicas_fecha'=> date('Y-m-d'),
            'asistentesmedicas_hora'=> date('H:i'),
            'triage_id'=>  $this->input->post('triage_id')
        );
        $sqlAsistente= $this->config_mdl->sqlGetDataCondition('os_asistentesmedicas',array(
            'triage_id'=> $this->input->post('triage_id')
        ),'triage_id');
        if(empty($sqlAsistente)){
            if($this->input->post('triage_paciente_accidente_lugar')=='TRABAJO'){
                Modules::run('Asistentesmedicas/DOC_ST7_FOLIO',array(
                    'triage_id'=>  $this->input->post('triage_id')
                ));
            }
            $this->config_mdl->sqlInsert('os_asistentesmedicas',$data);
            $asistentesmedicas_id= $this->config_mdl->sqlGetLastId('os_asistentesmedicas','asistentesmedicas_id');
        }else{
            unset($data['asistentesmedicas_fecha']);
            unset($data['asistentesmedicas_hora']);
            $this->config_mdl->sqlUpdate('os_asistentesmedicas',$data,array(
                 'asistentesmedicas_id'=> $this->input->post('asistentesmedicas_id')
             ));
            $asistentesmedicas_id= $this->input->post('asistentesmedicas_id');
        }
        $data_triage=array(
            'triage_fecha'=> date('Y-m-d'), 
            'triage_hora'=> date('H:i'), 
            'triage_nombre'=>  $this->input->post('triage_nombre'), 
            'triage_nombre_ap'=>  $this->input->post('triage_nombre_ap'), 
            'triage_nombre_am'=>  $this->input->post('triage_nombre_am'), 
            'triage_paciente_sexo'=> $this->input->post('triage_paciente_sexo'),
            'triage_fecha_nac'=>  $this->input->post('triage_fecha_nac'),
            'triage_paciente_estadocivil'=>  $this->input->post('triage_paciente_estadocivil'),
            'triage_paciente_curp'=>  $this->input->post('triage_paciente_curp'),
            'triage_crea_am'=> $this->UMAE_USER
        );
        $this->config_mdl->sqlUpdate('paciente_info',array(
            'pum_nss'=>$this->input->post('pum_nss'),
            'pum_nss_agregado'=>$this->input->post('pum_nss_agregado'),
            'pum_nss_armado'=>$this->input->post('pum_nss_armado'),
            'pum_umf'=>$this->input->post('pum_umf'),
            'pum_delegacion'=>$this->input->post('pum_delegacion'),
            'pia_lugar_accidente'=>$this->input->post('pia_lugar_accidente'),
            'pia_lugar_procedencia'=>$this->input->post('pia_lugar_procedencia'),
            'pia_dia_pa'=>$this->input->post('pia_dia_pa'),
            'pia_fecha_accidente'=>$this->input->post('pia_fecha_accidente'),
            'pia_hora_accidente'=>$this->input->post('pia_hora_accidente'),
            'pic_identificacion'=>$this->input->post('pic_identificacion'),
            'pic_responsable_nombre'=>$this->input->post('pic_responsable_nombre'),
            'pic_responsable_parentesco'=>$this->input->post('pic_responsable_parentesco'),
            'pic_responsable_telefono'=>$this->input->post('pic_responsable_telefono'),
            'info_vigencia_acceder'=> $this->input->post('info_vigencia_acceder'),
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
        if($this->input->post('directorio_cp_2')!=''){
            Modules::run('Triage/TriagePacienteDirectorio',array(
                'directorio_tipo'=>'Empresa',
                'directorio_cp'=> $this->input->post('directorio_cp_2'),
                'directorio_cn'=> $this->input->post('directorio_cn_2'),
                'directorio_colonia'=> $this->input->post('directorio_colonia_2'),
                'directorio_municipio'=> $this->input->post('directorio_municipio_2'),
                'directorio_estado'=> $this->input->post('directorio_estado_2'),
                'directorio_telefono'=> $this->input->post('directorio_telefono_2'),
                'triage_id'=>$this->input->post('triage_id')
            ));
            Modules::run('Triage/TriagePacienteEmpresa',array(
                'empresa_nombre'=> $this->input->post('empresa_nombre'),
                'empresa_modalidad'=> $this->input->post('empresa_modalidad'),
                'empresa_rp'=> $this->input->post('empresa_rp'),
                'empresa_fum'=> $this->input->post('empresa_fum'),
                'empresa_tel'=> $this->input->post('empresa_tel'),
                'empresa_he'=> $this->input->post('empresa_he'),
                'empresa_hs'=>$this->input->post('empresa_hs'),
                'triage_id'=> $this->input->post('triage_id')
            ));   
        }
        $this->config_mdl->sqlUpdate('os_triage',$data_triage,
                array('triage_id'=>  $this->input->post('triage_id'))
        );
        $this->config_mdl->sqlInsert('doc_43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=>'Choque',
            'doc_tipo'=>'Ingreso',
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Asistente Médica Choque','triage_id'=>$this->input->post('triage_id'),'areas_id'=>$asistentesmedicas_id));
        $this->setOutput(array('accion'=>'1'));     
    }
    public function Enfermeria() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("  SELECT 
                                                            pac.paciente_pseudonimo, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am, pac.paciente_rfc,
                                                            pac.paciente_sexo, ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero,ing.ingreso_tipopaciente
                                                        FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_choque AS cq
                                                        WHERE 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_id=cq.ingreso_id AND
                                                            cq.choque_status='Ingreso' AND
                                                            ing.ingreso_viaregistro='Choque' ORDER BY cq.choque_id DESC");
        $this->load->view('Enfermeria/index',$sql);
    }
    public function EnfermeriaCamas() {
        $this->load->view('Enfermeria/Camas');
    }
    public function InformacionCama($data) {
        $sql= $this->config_mdl->_get_data_condition('os_camas',array(
            'cama_id'=> $data['cama_id']
        ));
        return $sql[0]['cama_nombre'];
    }
    /*MEDICO CHOQUE*/
    public function Medico() {
        $this->load->view('choque_medico');
        
    }
    public function AjaxMedico(){
        $sql= $this->config_mdl->sqlQuery("SELECT t.triage_id, t.triage_tipo_paciente,t.triage_nombre, t.triage_nombre_ap, 
                t.triage_nombre_am, t.triage_nombre_pseudonimo, pin.pum_nss, pin.pum_nss_agregado,pin.pum_nss_armado,
                t.triage_paciente_sexo, t.triage_horacero_f, t.triage_horacero_h
                FROM os_triage AS t, os_choque_v2 AS c, paciente_info pin WHERE 
                                                t.triage_id=pin.triage_id AND
                            t.triage_id=c.triage_id AND 
                            c.choque_status='Ingreso' AND
                            t.triage_via_registro='Choque' ORDER BY c.choque_id DESC");
        $this->setOutput(array('sql'=>$sql));
    }
    public function ObtenerCamasChoque() {
        $sql= $this->config_mdl->_query("SELECT * FROM os_camas WHERE os_camas.area_id=6 AND os_camas.cama_status='Disponible'");
        if(empty($sql)){
            $this->setOutput(array('accion'=>'2'));
        }else{
            foreach ($sql as $value) {
                $option.='<option value="'.$value['cama_id'].'">'.$value['cama_nombre'].'</option>';
            }
            $this->setOutput(array('accion'=>$option));
        }
    }
    public function AjaxTarjetaIdentificacion() {
        $check= $this->config_mdl->_get_data_condition('os_tarjeta_identificacion',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $data=array(
            'ti_enfermedades'=> $this->input->post('ti_enfermedades'),
            'ti_alergias'=> $this->input->post('ti_alergias'),
            'ti_fecha'=> date('d/m/Y'),
            'ti_hora'=> date('H:i'),
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=> $this->input->post('triage_id')
        );
        if(empty($check)){
            $this->config_mdl->_insert('os_tarjeta_identificacion',$data);
        }else{
            unset($data['ti_fecha']);
            unset($data['ti_hora']);
            unset($data['empleado_id']);
            $this->config_mdl->_update_data('os_tarjeta_identificacion',$data,array(
                'triage_id'=> $this->input->post('triage_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxAltaNoEspecificado(){
        $this->config_mdl->sqlUpdate('os_choque_v2',array(
            'choque_status'=>'Salida',
            'choque_alta'=>'Alta No Especificado',
            'choque_salida_f'=>date('Y-m-d'),
            'choque_salida_h'=>date('H:i')
        ),array(
            'triage_id'=>$this->input->post('triage_id')
        )); 
        $this->config_mdl->sqlUpdate('os_triage',array(
            'triage_en'=> 'Choque',
            'triage_en_status'=>'Egreso',
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->config_mdl->sqlInsert('doc_43021',array(
            'doc_fecha'=> date('Y-m-d'),
            'doc_hora'=> date('H:i:s'),
            'doc_turno'=>Modules::run('Config/ObtenerTurno'),
            'doc_destino'=> 'Alta No Especificado',
            'doc_tipo'=>'Egreso',
            'doc_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxAltaPaciente() {
        $this->config_mdl->_update_data('os_choque_v2',array(
            'choque_alta'=>  $this->input->post('choque_alta')
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_choque_v2',array(
            'choque_salida_f'=> date('Y-m-d'),
            'choque_salida_h'=>  date('H:i') ,
            'choque_status'=>'Salida'
        ),array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->config_mdl->_update_data('os_camas',array(
            'cama_status'=>'En Limpieza',
            'cama_ingreso_f'=> '',
            'cama_ingreso_h'=> '',
            'cama_fh_estatus'=> date('Y-m-d H:i:s'),
            'cama_dh'=>0
        ),array(
            'cama_id'=>  $this->input->post('cama_id')
        ));
        $choque= $this->config_mdl->_get_data_condition('os_choque_v2',array(
            'triage_id'=> $this->input->post('triage_id')
        ))[0];
        $this->EgresoCamas($egreso=array(
            'cama_egreso_cama'=>$this->input->post('cama_id'),
            'cama_egreso_destino'=>$this->input->post('choque_alta'),
            'cama_egreso_table'=>'os_choque_v2',
            'cama_egreso_table_id'=>$choque['choque_id'],
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->config_mdl->sqlUpdate('os_triage',array(
            'triage_en'=> 'Choque',
            'triage_en_status'=>'Egreso',
        ),array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Egreso Choque','triage_id'=>$this->input->post('triage_id'),'areas_id'=>$choque['choque_id']));
        $this->setOutput(array('accion'=>'1'));
    }
}
