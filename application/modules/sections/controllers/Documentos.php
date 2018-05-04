<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documentos
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Documentos extends Config{
    public function index() {
        die('ACCESO NO PERMITIDO');
    }
    public function Expediente($paciente) {
        $sql['HojasFrontales']= $this->config_mdl->sqlQuery("SELECT hf_id,hf_fg,hf_hg,hf_via,empleado_id,hf_temp,ingreso_id FROM sigh_hojafrontal AS hf WHERE ingreso_id=".$paciente);
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ingreso_id, ingreso_date_medico,ingreso_time_medico, ingreso_medico_id,ingreso_clasificacion,ingreso_egreso_date FROM sigh_pacientes_ingresos AS ing WHERE ing.ingreso_id=".$paciente)[0];
        $sql['AvisoMp']= $this->config_mdl->_query("SELECT mp_fecha,mp_hora,empleado_nombre,empleado_ap,empleado_am FROM sigh_empleados AS emp, sigh_ministeriopublico AS mp WHERE
            emp.empleado_id=mp.medico_familiar AND
            mp.ingreso_id=".$paciente);
        $sql['HojasAltas']= $this->config_mdl->sqlQuery("SELECT ha.ha_id, ha.ha_fecha, ha.ha_hora, ha.ha_area,
                                                            em.empleado_id, em.empleado_nombre , em.empleado_ap,em.empleado_am
                                                            FROM doc_ha_hospitalaria AS ha, sigh_empleados AS em
                                                            WHERE 
                                                            ha.empleado_id=em.empleado_id AND
                                                            ha.ingreso_id=$paciente");
        
        $this->load->view('Documentos/Expediente',$sql);
    }
    public function ExpedienteEmpleado($data) {
        $sql= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $data['empleado_id']
        ));
        if(empty($sql)){
            return 'No Especificado';
        }else{
            return $sql[0]['empleado_nombre'].' '.$sql[0]['empleado_ap'].' '.$sql[0]['empleado_am'];
        }     
    }
    public function HojaFrontal() {
        $sql['Especialidades']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_especialidades GROUP BY sigh_especialidades.especialidad_nombre");
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_pv ,ing.ingreso_clasificacion,ing.ingreso_date_horacero,ing.ingreso_time_horacero,ing.ingreso_date_am,ing.ingreso_time_am,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                            pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                            pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                            info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                            ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,info.info_indicio_embarazo,
                                            ing.ingreso_valida_nss 
                                            FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                            WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$_GET['folio'])[0];
        $sql['hojafrontal']=  $this->config_mdl->sqlGetDataCondition('sigh_hojafrontal',array(
            'hf_id'=>  $this->input->get_post('hf')
        ));
        $sql['am']=  $this->config_mdl->sqlGetDataCondition('sigh_asistentesmedicas',array(
            'ingreso_id'=>  $this->input->get_post('folio')
        ));
        $sql['DirEmpresa']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Empresa',
            'ingreso_id'=>  $this->input->get_post('folio')
        ))[0];
        $sql['ce']=  $this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
            'ingreso_id'=>  $this->input->get_post('folio')
        ),'ce_asignado_consultorio,ce_status, ce_hf');
        $sql['INFO_USER']=  $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>  $_SESSION['UMAE_USER']
        ),'empleado_id,empleado_nombre,empleado_ap, empleado_ap,empleado_matricula');
        $sql['Empresa']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_empresas',array(
            'ingreso_id'=>$this->input->get_post('folio')
        ))[0];
        $sql['MinisterioPublico']= $this->config_mdl->sqlGetDataCondition('sigh_ministeriopublico',array(
            'ingreso_id'=>$this->input->get_post('folio')
        ))[0];
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'ingreso_id'=>$this->input->get_post('folio') 
        ))[0];
        $this->load->view('Documentos/Doc_HojaFrontal',$sql);
        
    }
    public function GuardarHojaFrontal() {
        $sqlConsultorio= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
            'ingreso_id'=>  $this->input->post('ingreso_id')
        ),'ce_status')[0];
        foreach ($this->input->post('hf_mecanismolesion') as $value) {
            $hf_mecanismolesion.=$value.',';
        }
        foreach ($this->input->post('hf_quemadura') as $value) {
            $hf_quemadura.=$value.',';
        }
        foreach ($this->input->post('hf_trataminentos') as $value) {
            $hf_trataminentos.=$value.',';
        }
        $data=array(
            'hf_via'=> $this->input->post('tipo'),
            'hf_fg'=> date('Y-m-d'),
            'hf_hg'=> date('H:i'),
            'hf_intoxitacion'=>  $this->input->post('hf_intoxitacion'),
            'hf_intoxitacion_descrip'=>  $this->input->post('hf_intoxitacion_descrip'),
            'hf_urgencia'=>  $this->input->post('hf_urgencia'),
            'hf_atencion'=> $this->input->post('hf_atencion'),
            'hf_especialidad'=>  $this->input->post('hf_especialidad'),
            'hf_motivo'=>  $this->input->post('hf_motivo'),
            'hf_mecanismolesion'=>rtrim($hf_mecanismolesion,','),
            'hf_mecanismolesion_mtrs'=>  $this->input->post('hf_mecanismolesion_mtrs'),
            'hf_mecanismolesion_otros'=>  $this->input->post('hf_mecanismolesion_otros'),
            'hf_quemadura'=>  rtrim($hf_quemadura,','),
            'hf_quemadura_otros'=>  $this->input->post('hf_quemadura_otros'),
            'hf_antecedentes'=>  $this->input->post('hf_antecedentes'),
            'hf_exploracionfisica'=>  $this->input->post('hf_exploracionfisica'),
            'hf_interpretacion'=>  $this->input->post('hf_interpretacion'),
            'hf_diagnosticos'=>  $this->input->post('hf_diagnosticos'),
            'hf_diagnosticos_lechaga'=>  $this->input->post('hf_diagnosticos_lechaga'),
            'hf_trataminentos'=> rtrim($hf_trataminentos,','),
            'hf_trataminentos_otros'=>  $this->input->post('hf_trataminentos_otros'),
            'hf_trataminentos_por'=>  $this->input->post('hf_trataminentos_por'),
            'hf_receta_por'=>  $this->input->post('hf_receta_por'),
            'hf_indicaciones'=>  $this->input->post('hf_indicaciones'),
            'hf_ministeriopublico'=>  $this->input->post('hf_ministeriopublico'),
            'hf_servicio_tratante'=> $this->input->post('hf_servicio_tratante'),
            'hf_alta'=> $this->input->post('hf_alta'),
            'hf_alta_otros'=> $this->input->post('hf_alta_otros'),
            'hf_incapacidad_dias'=>  $this->input->post('hf_incapacidad_dias'),
            'hf_incapacidad_ptr_eg'=>  $this->input->post('hf_incapacidad_ptr_eg'),
            'hf_temp'=> $this->input->post('temp'),
            'ingreso_id'=>  $this->input->post('ingreso_id'),
            'empleado_id'=> $this->UMAE_USER
        ); 
        $data_am=array(
            'asistentesmedicas_fecha'=> date('Y-m-d'),
            'asistentesmedicas_hora'=> date('H:i:s'),
            'asistentesmedicas_da'=>  $this->input->post('asistentesmedicas_da'),
            'asistentesmedicas_dl'=>  $this->input->post('asistentesmedicas_dl'),
            'asistentesmedicas_ip'=>  $this->input->post('asistentesmedicas_ip'),
            'asistentesmedicas_tratamientos'=>  $this->input->post('asistentesmedicas_tratamientos'),
            'asistentesmedicas_ss_in'=>  $this->input->post('asistentesmedicas_ss_in'),
            'asistentesmedicas_ss_ie'=>  $this->input->post('asistentesmedicas_ss_ie'),
            'asistentesmedicas_oc_hr'=>  $this->input->post('asistentesmedicas_oc_hr'),
            'asistentesmedicas_am'=>  $this->input->post('asistentesmedicas_am'),
            'asistentesmedicas_incapacidad_am'=>  $this->input->post('asistentesmedicas_incapacidad_am'),
            'asistentesmedicas_incapacidad_ga'=> $this->input->post('asistentesmedicas_incapacidad_ga'),
            'asistentesmedicas_incapacidad_tipo'=> $this->input->post('asistentesmedicas_incapacidad_tipo'),
            'asistentesmedicas_incapacidad_dias_a'=> $this->input->post('asistentesmedicas_incapacidad_dias_a'),
            'asistentesmedicas_incapacidad_fi'=>  $this->input->post('asistentesmedicas_incapacidad_fi'),
            'asistentesmedicas_incapacidad_da'=>  $this->input->post('asistentesmedicas_incapacidad_da'),
            'asistentesmedicas_mt'=>  $this->input->post('asistentesmedicas_mt'),
            'asistentesmedicas_mt_m'=>  $this->input->post('asistentesmedicas_mt_m'),
            'asistentesmedicas_incapacidad_folio'=>  $this->input->post('asistentesmedicas_incapacidad_folio'),
            'asistentesmedicas_omitir'=>  $this->input->post('asistentesmedicas_omitir'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        if($this->input->post('tipo')=='Consultorios'){
            if($sqlConsultorio['ce_status']=='Salida'){
                unset($data['hf_alta']);
            }else{
                $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',array(
                    'ce_hf'=>($this->input->post('hf_alta')!='Otros' ? $this->input->post('hf_alta') : $this->input->post('hf_alta_otros'))
                ),array(
                   'ingreso_id'=>  $this->input->post('ingreso_id')
                ));
            }
        }
        $sqlCheckHojaFrontal= $this->config_mdl->sqlGetDataCondition('sigh_hojafrontal',array(
            'ingreso_id'=> $this->input->post('ingreso_id')
        ),'hf_id');
        if(empty($sqlCheckHojaFrontal)){
            $this->config_mdl->sqlInsert('sigh_hojafrontal',$data);
        }else{
            unset($data['hf_via']);
            unset($data['hf_fg']);
            unset($data['hf_hg']);
            unset($data['empleado_id']);
            $this->config_mdl->sqlUpdate('sigh_hojafrontal',$data,array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
        }
        $sqlCheckAm= $this->config_mdl->sqlGetDataCondition('sigh_asistentesmedicas',array(
            'ingreso_id'=>$this->input->post('ingreso_id')
        ),'asistentesmedicas_id');
        if(empty($sqlCheckAm)){
            $this->config_mdl->sqlInsert('sigh_asistentesmedicas',$data_am);
        }else{
            unset($data_am['asistentesmedicas_fecha']);
            unset($data_am['asistentesmedicas_hora']);
            $this->config_mdl->sqlUpdate('sigh_asistentesmedicas',$data_am,array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));
        }
        
        if($this->input->post('hf_ministeriopublico')=='Si'){
            $sqlMP= $this->config_mdl->sqlGetDataCondition('sigh_ministeriopublico',array(
                'ingreso_id'=> $this->input->post('ingreso_id')
            ));
            if(empty($sqlMP)){
                $this->config_mdl->sqlInsert('sigh_ministeriopublico',array(
                    'mp_estatus'=>'Enviado',
                    'mp_fecha'=> date('Y-m-d'),
                    'mp_hora'=> date('H:i:s'),
                    'mp_area'=> $this->input->post('tipo'),
                    'ingreso_id'=> $this->input->post('ingreso_id'),
                    'medico_familiar'=> $this->UMAE_USER
                ));
            }
        }
        $sqlSv= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'sv_tipo'=>'Triage'
        ),'sv_id');
        if(empty($sqlSv)){
            $this->config_mdl->sqlInsert('sigh_pacientes_sv',array(
                'sv_tipo'=>'Triage',
                'sv_fecha'=> date('Y-m-d'),
                'sv_hora'=>date('H:i:s'),
                'sv_ta'=> $this->input->post('sv_ta'),
                'sv_temp'=> $this->input->post('sv_temp'),
                'sv_fc'=> $this->input->post('sv_fc'),
                'sv_fr'=> $this->input->post('sv_fr'),
                'ingreso_id'=> $this->input->post('ingreso_id'),
                'empleado_id'=> $this->UMAE_USER
            ));
        }
        $this->setOutput(array('accion'=>'1','post'=> $this->input->post()));
    }
    public function HojaInicialAbierto() {
        $sql['Especialidades']= $this->config_mdl->sqlQuery("SELECT * FROM um_especialidades GROUP BY um_especialidades.especialidad_nombre");
        $sql['info']=  $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=> $this->input->get_post('folio')
        ))[0];
        $sql['hojafrontal']=  $this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
            'hf_id'=>  $this->input->get_post('hf')
        ));
        $sql['am']=  $this->config_mdl->sqlGetDataCondition('os_asistentesmedicas',array(
            'triage_id'=>  $this->input->get_post('folio')
        ));
        $sql['DirEmpresa']=  $this->config_mdl->sqlGetDataCondition('os_triage_directorio',array(
            'directorio_tipo'=>'Empresa',
            'triage_id'=>  $this->input->get_post('folio')
        ))[0];
        $sql['ce']=  $this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad',array(
            'triage_id'=>  $this->input->get_post('folio')
        ));
        $sql['INFO_USER']=  $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=>  $_SESSION['UMAE_USER']
        ));
        $sql['Empresa']= $this->config_mdl->sqlGetDataCondition('os_triage_empresa',array(
            'triage_id'=>$this->input->get_post('folio')
        ))[0];
        $sql['MinisterioPublico']= $this->config_mdl->sqlGetDataCondition('ts_ministerio_publico',array(
            'triage_id'=>$this->input->get_post('folio')
        ))[0];
        $sql['PINFO']= $this->config_mdl->sqlGetDataCondition('paciente_info',array(
            'triage_id'=>$this->input->get_post('folio') 
        ))[0];
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('os_triage_signosvitales',array(
            'triage_id'=>$this->input->get_post('folio') 
        ))[0];
        $sql['Documentos']= $this->config_mdl->sqlGetDataCondition('pc_documentos',array(
            'doc_nombre'=>'Hoja Frontal'
        ));
        $this->load->view('Documentos/HojaInicialAbierto',$sql);
    }
    public function AjaxHojaInicialAbierto() {
        $consultorio= $this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad',array(
            'triage_id'=>  $this->input->post('triage_id')
        ))[0];

        $data=array(
            'hf_via'=> $this->input->post('tipo'),
            'hf_fg'=> date('Y-m-d'),
            'hf_hg'=> date('H:i'),
            'hf_motivo'=> $this->input->post('hf_motivo'),//Motivo de Consulta
            'hf_diagnosticos'=>  $this->input->post('hf_diagnosticos'),
            'hf_diagnosticos_lechaga'=>  $this->input->post('hf_diagnosticos_lechaga'),
            'hf_antecedentes'=> $this->input->post('hf_antecedentes'),//Plan Médico
            'hf_indicaciones'=> $this->input->post('hf_indicaciones'),//Pronosticos
            'hf_interpretacion'=> $this->input->post('hf_interpretacion'),//Estado de salud
            'hf_alta'=> $this->input->post('hf_alta'),
            'hf_alta_otros'=> $this->input->post('hf_alta_otros'),
            'triage_id'=>  $this->input->post('triage_id'),
            'empleado_id'=> $this->UMAE_USER
        ); 
        $data_am=array(
            'asistentesmedicas_da'=>  $this->input->post('asistentesmedicas_da'),
            'asistentesmedicas_dl'=>  $this->input->post('asistentesmedicas_dl'),
            'asistentesmedicas_ip'=>  $this->input->post('asistentesmedicas_ip'),
            'asistentesmedicas_tratamientos'=>  $this->input->post('asistentesmedicas_tratamientos'),
            'asistentesmedicas_ss_in'=>  $this->input->post('asistentesmedicas_ss_in'),
            'asistentesmedicas_ss_ie'=>  $this->input->post('asistentesmedicas_ss_ie'),
            'asistentesmedicas_oc_hr'=>  $this->input->post('asistentesmedicas_oc_hr'),
            'asistentesmedicas_am'=>  $this->input->post('asistentesmedicas_am'),
            'asistentesmedicas_incapacidad_am'=>  $this->input->post('asistentesmedicas_incapacidad_am'),
            'asistentesmedicas_incapacidad_ga'=> $this->input->post('asistentesmedicas_incapacidad_ga'),
            'asistentesmedicas_incapacidad_tipo'=> $this->input->post('asistentesmedicas_incapacidad_tipo'),
            'asistentesmedicas_incapacidad_dias_a'=> $this->input->post('asistentesmedicas_incapacidad_dias_a'),
            'asistentesmedicas_incapacidad_fi'=>  $this->input->post('asistentesmedicas_incapacidad_fi'),
            'asistentesmedicas_incapacidad_da'=>  $this->input->post('asistentesmedicas_incapacidad_da'),
            'asistentesmedicas_mt'=>  $this->input->post('asistentesmedicas_mt'),
            'asistentesmedicas_mt_m'=>  $this->input->post('asistentesmedicas_mt_m'),
            'asistentesmedicas_incapacidad_folio'=>  $this->input->post('asistentesmedicas_incapacidad_folio'),
            'asistentesmedicas_omitir'=>  $this->input->post('asistentesmedicas_omitir')
        );
        if($this->input->post('tipo')=='Consultorios'){
            if($consultorio['ce_status']=='Salida'){
                unset($data['hf_alta']);
            }else{
                $this->config_mdl->_update_data('os_consultorios_especialidad',array(
                    'ce_hf'=>($this->input->post('hf_alta')!='Otros' ? $this->input->post('hf_alta') : $this->input->post('hf_alta_otros'))
                ),array(
                   'triage_id'=>  $this->input->post('triage_id')
                ));
            }
        }
        $sqlCheckHojaFrontal= $this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
            'triage_id'=> $this->input->post('triage_id')
        ),'hf_id');
        if(empty($sqlCheckHojaFrontal)){
            $this->config_mdl->_insert('os_consultorios_especialidad_hf',$data);
        }else{
            unset($data['hf_fg']);
            unset($data['hf_hg']);
            unset($data['empleado_id']);
            $this->config_mdl->_update_data('os_consultorios_especialidad_hf',$data,array(
                'hf_id'=>  $this->input->post('hf_id')
            ));
        }
        $this->config_mdl->_update_data('os_asistentesmedicas',$data_am,array(
           'triage_id'=>  $this->input->post('triage_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /*DOCUMENTOS OBSERVACIÓN*/
    public function TratamientoQuirurgico($Paciente) {
        $sql['tratamientos']=  $this->config_mdl->_get_data_condition('os_observacion_tratamientos',array(
            'triage_id'=> $Paciente
        ));
        $this->load->view('Documentos/TratamientoQuirurgico',$sql);
    }
    public function AjaxTratamientosQuirurgicos() {
        $data=array(
            'tratamiento_nombre'=> $this->input->post('tratamiento_nombre'),
            'tratamiento_fecha'=> date('Y-m-d'),
            'tratamiento_hora'=> date('H:i:s'),
            'triage_id'=> $this->input->post('triage_id'),
            'empleado_id'=> $this->UMAE_USER
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('os_observacion_tratamientos',$data);
        }else{
            unset($data['tratamiento_fecha']);
            unset($data['tratamiento_hora']);
            unset($data['empleado_id']);
            $this->config_mdl->_update_data('os_observacion_tratamientos',$data,array(
                'tratamiento_id'=> $this->input->post('tratamiento_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function DocumentosTratamientoQuirurgico($Tratamiento) {
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $sql['cs']=  $this->config_mdl->_get_data_condition('os_observacion_cirugiasegura',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $sql['si']=  $this->config_mdl->_get_data_condition('os_observacion_ci',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $sql['cci']=  $this->config_mdl->_get_data_condition('os_observacion_cci',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $sql['isq']=  $this->config_mdl->_get_data_condition('os_observacion_isq',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $this->load->view('Documentos/TratamientoQuirurgico/ComboQuirurgico',$sql);
    }
    public function SolicitudTransfusion($Tratamiento) {
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['empleado']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=> $sql['observacion'][0]['observacion_medico']
        ));
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $this->load->view('Documentos/TratamientoQuirurgico/SolicitudTransfusion',$sql);
    }
    public function AjaxSolicitudTransfusion() {
        $data=array(
            'solicitudtransfucion_sangre'=>  $this->input->post('solicitudtransfucion_sangre'),
            'solicitudtransfucion_plasma'=>  $this->input->post('solicitudtransfucion_plasma'),
            'solicitudtransfucion_suspensionconcentrada'=>  $this->input->post('solicitudtransfucion_suspensionconcentrada'),
            'solicitudtransfucion_otros'=>  $this->input->post('solicitudtransfucion_otros'),
            'solicitudtransfucion_otros_val'=>  $this->input->post('solicitudtransfucion_otros_val'),
            'solicitudtransfucion_ordinaria'=>  $this->input->post('solicitudtransfucion_ordinaria'),
            'solicitudtransfucion_urgente'=>  $this->input->post('solicitudtransfucion_urgente'),
            'solicitudtransfucion_urgente_vol'=>  $this->input->post('solicitudtransfucion_urgente_vol'),
            'solicitudtransfucion_operacion_dia'=>  $this->input->post('solicitudtransfucion_operacion_dia'),
            'solicitudtransfucion_operacion_hora'=>  $this->input->post('solicitudtransfucion_operacion_hora'),
            'solicitudtransfucion_disponible'=>  $this->input->post('solicitudtransfucion_disponible'),
            'solicitudtransfucion_reserva'=>  $this->input->post('solicitudtransfucion_reserva'),
            'solicitudtransfucion_gs_abo'=>  $this->input->post('solicitudtransfucion_gs_abo'),
            'solicitudtransfucion_gs_rhd'=>  $this->input->post('solicitudtransfucion_gs_rhd'),
            'solicitudtransfucion_gs_ignora'=>  $this->input->post('solicitudtransfucion_gs_ignora'),
            'solicitudtransfucion_diagnostico'=>  $this->input->post('solicitudtransfucion_diagnostico'),
            'solicitudtransfucion_hb'=>  $this->input->post('solicitudtransfucion_hb'),
            'solicitudtransfucion_ht'=>  $this->input->post('solicitudtransfucion_ht'),
            'solicitudtransfucion_transfuciones_previas'=>  $this->input->post('solicitudtransfucion_transfuciones_previas'),
            'solicitudtransfucion_reacciones_postransfuncionales'=>  $this->input->post('solicitudtransfucion_reacciones_postransfuncionales'),
            'solicitudtransfucion_fecha_ultima'=>  $this->input->post('solicitudtransfucion_fecha_ultima'),
            'solicitudtransfucion_embarazo_previo'=>  $this->input->post('solicitudtransfucion_embarazo_previo'),
            'solicitudtransfucion_pfh'=>  $this->input->post('solicitudtransfucion_pfh'),
            'solicitudtransfucion_solicita_f'=>  $this->input->post('solicitudtransfucion_solicita_f'),
            'solicitudtransfucion_solicita_h'=>  $this->input->post('solicitudtransfucion_solicita_h'),
            'solicitudtransfucion_recibio_nombre'=>  $this->input->post('solicitudtransfucion_recibio_nombre'),
            'solicitudtransfucion_recibio_f'=>  $this->input->post('solicitudtransfucion_recibio_f'),
            'solicitudtransfucion_recibio_h'=>  $this->input->post('solicitudtransfucion_recibio_h'),
            'tratamiento_id'=> $this->input->post('tratamiento_id'),
            'triage_id'=>  $this->input->post('triage_id')
        );
        if(empty($this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array('tratamiento_id'=>  $this->input->post('tratamiento_id'))))){
            $this->config_mdl->_insert('os_observacion_solicitudtransfucion',$data);
        }else{
            $this->config_mdl->_update_data('os_observacion_solicitudtransfucion',$data,array(
                'tratamiento_id'=>  $this->input->post('tratamiento_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function CirugiaSegura($Tratamiento) {
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['empleado']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=> $sql['observacion'][0]['observacion_medico']
        ));
        $sql['cs']=  $this->config_mdl->_get_data_condition('os_observacion_cirugiasegura',array(
            'triage_id'=> $Tratamiento
        ));
        $this->load->view('Documentos/TratamientoQuirurgico/CirugiaSegura',$sql);
    }
    public function AjaxCirugiaSegura() {
        $data=array(
            'cirugiasegura_procedimiento'=>  $this->input->post('cirugiasegura_procedimiento'),
            'triage_id'=>  $this->input->post('triage_id'),
            'tratamiento_id'=> $this->input->post('tratamiento_id')
        );
        if(empty($this->config_mdl->_get_data_condition('os_observacion_cirugiasegura',array('tratamiento_id'=>  $this->input->post('tratamiento_id'))))){
            $this->config_mdl->_insert('os_observacion_cirugiasegura',$data);
        }else{
            $this->config_mdl->_update_data('os_observacion_cirugiasegura',$data,array(
                'tratamiento_id'=>  $this->input->post('tratamiento_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function SolicitudeIntervencion($Tratamiento) {
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['empleado']=  $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=> $sql['observacion'][0]['observacion_medico']
        ));
        $sql['si']=  $this->config_mdl->_get_data_condition('os_observacion_ci',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $this->load->view('Documentos/TratamientoQuirurgico/SolicitudeIntervencion',$sql);
    }
    public function AjaxSolicitudeIntervencion() {
        $data=array(
            'ci_servicio'=>  $this->input->post('ci_servicio'),
            'ci_fecha_solicitud'=>  $this->input->post('ci_fecha_solicitud'),
            'ci_fecha_solicitada'=>  $this->input->post('ci_fecha_solicitada'),
            'ci_hora_deseada'=>  $this->input->post('ci_hora_deseada'),
            'ci_prioridad'=>  $this->input->post('ci_prioridad'),
            'ci_diagnostico'=>  $this->input->post('ci_diagnostico'),
            'ci_operacion_planeada'=>  $this->input->post('ci_operacion_planeada'),
            'ci_operacion_eu'=>  $this->input->post('ci_operacion_eu'),
            'ci_ap'=>  $this->input->post('ci_ap'),
            'ci_tec'=>  $this->input->post('ci_tec'),
            'ci_njs'=>  $this->input->post('ci_njs'),
            'ci_nmc'=>  $this->input->post('ci_nmc'),
            'ci_mmc'=>  $this->input->post('ci_mmc'),
            'triage_id'=>  $this->input->post('triage_id'),
            'tratamiento_id'=> $this->input->post('tratamiento_id')
        );
        if(empty($this->config_mdl->_get_data_condition('os_observacion_ci',array('tratamiento_id'=>  $this->input->post('tratamiento_id'))))){
            $this->config_mdl->_insert('os_observacion_ci',$data);
        }else{
            $this->config_mdl->_update_data('os_observacion_ci',$data,array(
                'tratamiento_id'=>  $this->input->post('tratamiento_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function ConsentimientoInformado($Tratamiento) {
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ));
        $sql['cci']=  $this->config_mdl->_get_data_condition('os_observacion_cci',array(
            'triage_id'=> $Tratamiento
        ));
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $this->load->view('Documentos/TratamientoQuirurgico/ConsentimientoInformado',$sql);
    }
    public function AjaxConsentimientoInformado() {
        $data=array(
            'cci_fecha'=>  $this->input->post('cci_fecha'),
            'cci_la_que_suscribe'=>  $this->input->post('cci_la_que_suscribe'),
            'cci_caracter'=>  $this->input->post('cci_caracter'),
            'cci_tipo_ct'=>  $this->input->post('cci_tipo_ct'),
            'cci_pronostico'=>  $this->input->post('cci_pronostico'),
            'triage_id'=>  $this->input->post('triage_id'),
            'tratamiento_id'=> $this->input->post('tratamiento_id')
        );
        if(empty($this->config_mdl->_get_data_condition('os_observacion_cci',array('tratamiento_id'=>  $this->input->post('tratamiento_id'))))){
            $this->config_mdl->_insert('os_observacion_cci',$data);
        }else{
            $this->config_mdl->_update_data('os_observacion_cci',$data,array(
                'tratamiento_id'=>  $this->input->post('tratamiento_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function ListaVerificacionISQ($Tratamiento) {
        
        $sql['isq']=  $this->config_mdl->_get_data_condition('os_observacion_isq',array(
            'tratamiento_id'=> $Tratamiento
        ));
        $this->load->view('Documentos/TratamientoQuirurgico/ListaVerificacionISQ',$sql);
    }
    public function AjaxListaVerificacionISQ() {
        $data=array(
            'isq_servicio_area'=>  $this->input->post('isq_servicio_area'),
            'isq_turno'=>  $this->input->post('isq_turno'),
            'triage_id'=>  $this->input->post('triage_id'),
            'tratamiento_id'=> $this->input->post('tratamiento_id')
        );
        if(empty($this->config_mdl->_get_data_condition('os_observacion_isq',array('tratamiento_id'=>  $this->input->post('tratamiento_id'))))){
            $this->config_mdl->_insert('os_observacion_isq',$data);
        }else{
            $this->config_mdl->_update_data('os_observacion_isq',$data,array(
                'tratamiento_id'=>  $this->input->post('tratamiento_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function HojaClasificacion($Paciente) {
        $sql['info']= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('Documentos/Doc_HojaClasificacion',$sql);
    }
    public function AjaxHojaClasificacion() {
        $triege_preg_puntaje_s1=0;
        $triege_preg_puntaje_s2=$this->input->post('triage_preg1_s2')+
                                $this->input->post('triage_preg2_s2')+
                                $this->input->post('triage_preg3_s2')+
                                $this->input->post('triage_preg4_s2')+
                                $this->input->post('triage_preg5_s2')+
                                $this->input->post('triage_preg6_s2')+
                                $this->input->post('triage_preg7_s2')+
                                $this->input->post('triage_preg8_s2')+
                                $this->input->post('triage_preg9_s2')+
                                $this->input->post('triage_preg10_s2')+
                                $this->input->post('triage_preg11_s2')+ 
                                $this->input->post('triage_preg12_s2');
        
        $triege_preg_puntaje_s3=$this->input->post('triage_preg1_s3')+ 
                                $this->input->post('triage_preg2_s3')+ 
                                $this->input->post('triage_preg3_s3')+
                                $this->input->post('triage_preg4_s3')+
                                $this->input->post('triage_preg5_s3');
        $total_puntos=$triege_preg_puntaje_s1+$triege_preg_puntaje_s2+$triege_preg_puntaje_s3;
        if($total_puntos>30){
            $color='#E50914';
            $color_name='Rojo';
        }if($total_puntos>=21 && $total_puntos<=30){
            $color='#FF7028';
            $color_name='Naranja';
        }if($total_puntos>=11 && $total_puntos<=20){
            $color='#FDE910';
            $color_name='Amarillo';
        }if($total_puntos>=6 && $total_puntos<=10){
            $color='#4CBB17';
            $color_name='Verde';
        }if($total_puntos<=5){
            $color='#0000FF';
            $color_name='Azul';
        }
        $data=array(
            'triage_via_registro'=>'Choque',
            'triage_fecha_clasifica'=> date('Y-m-d'),
            'triage_hora_clasifica'=> date('H:i'),
            'triage_status'=>'Finalizado',
            'triage_etapa'=>'2',
            'triage_color'=>$color_name,
            'triage_crea_enfemeria'=> $this->UMAE_USER,
            'triage_crea_medico'=> $this->UMAE_USER,
        );
        $data_clasificacion=array(
            'triage_preg1_s1'=>  0,
            'triage_preg2_s1'=>  0,
            'triage_preg3_s1'=>  0,
            'triage_preg4_s1'=>  0,
            'triage_preg5_s1'=>  0,
            'triege_preg_puntaje_s1'=> $triege_preg_puntaje_s1,
            'triage_preg1_s2'=>  $this->input->post('triage_preg1_s2'),
            'triage_preg2_s2'=>  $this->input->post('triage_preg2_s2'),
            'triage_preg3_s2'=>  $this->input->post('triage_preg3_s2'),
            'triage_preg4_s2'=>  $this->input->post('triage_preg4_s2'),
            'triage_preg5_s2'=>  $this->input->post('triage_preg5_s2'),
            'triage_preg6_s2'=>  $this->input->post('triage_preg6_s2'),
            'triage_preg7_s2'=>  $this->input->post('triage_preg7_s2'),
            'triage_preg8_s2'=>  $this->input->post('triage_preg8_s2'),
            'triage_preg9_s2'=>  $this->input->post('triage_preg9_s2'),
            'triage_preg10_s2'=> $this->input->post('triage_preg10_s2'),
            'triage_preg11_s2'=> $this->input->post('triage_preg11_s2'),
            'triage_preg12_s2'=> $this->input->post('triage_preg12_s2'),
            'triege_preg_puntaje_s2'=>$triege_preg_puntaje_s2,
            'triage_preg1_s3'=>  $this->input->post('triage_preg1_s3'),
            'triage_preg2_s3'=>  $this->input->post('triage_preg2_s3'),
            'triage_preg3_s3'=>  $this->input->post('triage_preg3_s3'),
            'triage_preg4_s3'=>  $this->input->post('triage_preg4_s3'),
            'triage_preg5_s3'=>  $this->input->post('triage_preg5_s3'),
            'triege_preg_puntaje_s3'=>$triege_preg_puntaje_s3,
            'triage_puntaje_total'=>$total_puntos,
            'triage_color'=>$color_name,
            'triage_id'=> $this->input->post('triage_id')
        );
        $this->config_mdl->_update_data('os_triage',$data,array(
            'triage_id'=>  $this->input->post('triage_id')
        ));
        
        $this->config_mdl->_insert('os_triage_clasificacion',$data_clasificacion);
        Modules::run('Sections/Api/TriageMedico',$data_clasificacion);
        $this->AccesosUsuarios(array('acceso_tipo'=>'Triage Enfermería (Choque)','triage_id'=>$this->input->post('triage_id'),'areas_id'=> $this->input->post('triage_id')));
        $this->AccesosUsuarios(array('acceso_tipo'=>'Triage Médico (Choque)','triage_id'=>$this->input->post('triage_id'),'areas_id'=> $this->input->post('triage_id')));
        
        $this->setOutput(array('accion'=>'1'));
    }

    /*NUEVAS FUNCIONES NOTAS CONSULTORIOS Y OBSERVACIÓN*/
    public function Notas($Nota) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_date_am,ing.ingreso_time_am,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                    pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                                    pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                                    info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                                    ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,info.info_indicio_embarazo,
                                                    ing.ingreso_valida_nss 
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$_GET['folio'])[0];
        $sql['Documentos']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_documentos WHERE doc_nombre!='Hoja Frontal'");
        $sql['Nota']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_notas, sigh_nota WHERE
            sigh_notas.notas_id=sigh_nota.notas_id AND 
            sigh_notas.notas_id=".$Nota)[0];
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'notas_id'=>$Nota
        ))[0];
        $sql['Medicos']= $this->config_mdl->sqlQuery("SELECT emp.empleado_nombre,emp.empleado_ap,emp.empleado_am, emp.empleado_id, emp.empleado_matricula FROM sigh_empleados AS emp, sigh_empleados_roles AS emp_rol, sigh_roles AS rol WHERE 
                                                    emp_rol.empleado_id=emp.empleado_id AND
                                                    emp_rol.rol_id=rol.rol_id AND
                                                    rol.rol_id=2");
        $sql['Anexos']= $this->config_mdl->sqlGetDataCondition('sigh_notas_anexos',array(
            'notas_id'=>$sql['Nota']['notas_id']
        ));
        $sql['Especialidades']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_especialidades GROUP BY sigh_especialidades.especialidad_nombre");
        $this->load->view('Documentos/Doc_Notas',$sql);
    }
    public function AjaxNotas() {
        $dataNotas=array(
            'notas_fecha'=> date('Y-m-d'),
            'notas_hora'=> date('H:i'),
            'notas_tipo'=> $this->input->post('notas_tipo'),
            'notas_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'notas_medico_autoriza'=> $this->input->post('notas_medico_autoriza'),
            'notas_medico_supervisa'=> $this->input->post('notas_medico_supervisa'),
            'notas_temp'=> $this->input->post('temp'),
            'notas_especialidad'=> $this->input->post('notas_especialidad'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('sigh_notas',$dataNotas);
            $sqlMax= $this->config_mdl->sqlGetLastId('sigh_notas','notas_id');
            $this->config_mdl->sqlInsert('sigh_nota',array(
                'nota_nota'=> $this->input->post('nota_nota'),
                'nota_diagnostico'=> $this->input->post('nota_diagnostico'),
                'notas_id'=>$sqlMax
            ));
            $MaxNota=$sqlMax;
        }else{
            $this->config_mdl->sqlUpdate('sigh_notas',array(
                'notas_medico_autoriza'=> $this->input->post('notas_medico_autoriza'),
                'notas_medico_supervisa'=> $this->input->post('notas_medico_supervisa'),
            ),array(
                'notas_id'=> $this->input->post('notas_id')
            ));
            $this->config_mdl->sqlUpdate('sigh_nota',array(
                'nota_nota'=> $this->input->post('nota_nota'),
                'nota_diagnostico'=> $this->input->post('nota_diagnostico')      
            ),array(
                'notas_id'=> $this->input->post('notas_id')
            ));
            $MaxNota=$this->input->post('notas_id');
        }
        if($this->input->post('via')=='Interconsulta'){
            $this->config_mdl->sqlUpdate('sigh_doc430200',array(
                'doc_estatus'=>'Evaluado',
                'doc_fecha_r'=> date('Y-m-d'),
                'doc_hora_r'=> date('H:i:s'),
                'doc_nota_id'=>$MaxNota,
                'empleado_recive'=> $this->UMAE_USER
            ),array(
                'doc_id'=> $this->input->post('doc_id')
            ));
        }
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'notas_id'=>$MaxNota,
            'sv_tipo'=> 'Notas Médicas'
        ),'sv_id');
        $dataSV=array(
            'sv_tipo'=> 'Notas Médicas',
            'sv_fecha'=> date('Y-m-d'),
            'sv_hora'=>date('H:i:s'),
            'sv_ta'=> $this->input->post('sv_ta'),
            'sv_temp'=> $this->input->post('sv_temp'),
            'sv_fc'=> $this->input->post('sv_fc'),
            'sv_fr'=> $this->input->post('sv_fr'),
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'notas_id'=>$MaxNota,
            'empleado_id'=> $this->UMAE_USER
        );
        if(empty($sqlCheck)){
            $this->config_mdl->sqlInsert('sigh_pacientes_sv',$dataSV);
        }else{
            unset($dataSV['sv_fecha']);
            unset($dataSV['sv_hora']);
            $this->config_mdl->sqlUpdate('sigh_pacientes_sv',$dataSV,array(
                'sv_tipo'=>'Notas Médicas',
                'notas_id'=>$MaxNota,
            ));
        }   
        $this->setOutput(array('accion'=>'1','notas_id'=>$MaxNota));
    }
    public function AjaxNotasAnexos() {
        foreach ($this->input->post('PasteImages') as $value) {
            $NameImg= $this->input->post('ingreso_id').'_'.rand().'.png';
            $img = str_replace('data:image/png;base64,', '', $value);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            file_put_contents('assets/NotasAnexos/'.$NameImg, $data);
            $this->config_mdl->sqlInsert('sigh_notas_anexos',array(
                'anexo_img'=>$NameImg,
                'notas_id'=> $this->input->post('notas_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxNotasEliminarAnexo() {
        $sql=$this->config_mdl->sqlGetDataCondition('sigh_notas_anexos',array(
            'anexo_id'=> $this->input->post('anexo_id')
        ));
        unlink('assets/NotasAnexos/'.$sql[0]['anexo_img']);
        $this->config_mdl->sqlDelete('sigh_notas_anexos',array(
            'anexo_id'=> $this->input->post('anexo_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function TarjetaDeIdentificacion($Paciente) {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('os_tarjeta_identificacion',array(
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('Documentos/Doc_TarjetaIdentificacion',$sql);
    }
    public function AjaxTarjetaDeIdentificacion() {
        $check= $this->config_mdl->sqlGetDataCondition('os_tarjeta_identificacion',array(
            'triage_id'=> $this->input->post('triage_id')
        ),'ti_id');
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
            $this->config_mdl->_update_data('os_tarjeta_identificacion',$data,array(
                'triage_id'=> $this->input->post('triage_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    /*Obtener Diagnosticos*/
    public function AjaxObtenerDiagnosticosKey() {
        
    }
    public function AjaxGuardarDiagnosticos() {
        $sqlDiagnostico= $this->config_mdl->sqlGetDataCondition('um_cie10',array(
            'cie10_nombre'=> $this->input->post('cie10_nombre')
        ));
        $data=array(
            'cie10hf_fecha'=> date('Y-m-d H:i:s'),
            'cie10hf_tipo'=> $this->input->post('cie10hf_tipo'),
            'cie10hf_estado'=> $this->input->post('cie10hf_estado'),
            'cie10hf_obs'=> $this->input->post('cie10hf_obs'),
            'triage_id'=> $this->input->post('triage_id'),
            'cie10_id'=> $sqlDiagnostico[0]['cie10_id']
        );
        if($this->input->post('accion')=='add'){
            $this->config_mdl->_insert('um_cie10_hojafrontal',$data);
        }else{
            unset($data['cie10hf_fecha']);
            $this->config_mdl->_update_data('um_cie10_hojafrontal',$data,array(
                'cie10hf_id'=> $this->input->post('cie10hf_id')
            ));
        }
        $this->setOutput(array('accion'=>'1','post'=> $this->input->post()));
    }
    public function AjaxObtenerDiagnosticos() {
        $sql= $this->config_mdl->_query("SELECT * FROM um_cie10_hojafrontal, um_cie10 WHERE
                    um_cie10_hojafrontal.cie10_id=um_cie10.cie10_id AND
                    um_cie10_hojafrontal.triage_id=".$this->input->post('triage_id')." ORDER BY cie10hf_tipo='Primario' DESC");
        foreach ($sql as $value) {
            $row.='<div class="col-md-12" style="margin-top: -10px;">
                    <div class="alert alert-info alert-dismissable fade in">
                        <div class="row" style="margin-right: -36px;    margin-top: -10px;margin-bottom: -9px;">
                            <div class="col-md-9 text-mayus">
                                <strong>Diagnostico:</strong> '.$value['cie10_nombre'].'<br>
                                <h6 style="font-size:9px"><strong>Observaciones:</strong> '.($value['cie10hf_obs']!='' ? $value['cie10hf_obs'] : 'Sin Observaciones').'</h6>
                            </div>
                            <div class="col-md-2 text-mayus">
                                <h6 style="font-size:9px"><strong>'.$value['cie10hf_tipo'].'</strong></h6>
                                <h6 style="font-size:12px;margin-top: -6px;"><strong>'.($value['cie10hf_estado']=='Presuntivo' ? '<span class="label green">Presuntivo</span>' : '<span class="label amber">Definitivo</span>').'</strong></h6>
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-pencil icono-accion pointer editar-diagnostico-cie10" data-id="'.$value['cie10hf_id'].'" data-obs="'.$value['cie10hf_obs'].'" data-nombre="'.$value['cie10_nombre'].'"></i>&nbsp;
                                <i class="fa fa-trash-o icono-accion pointer tip eliminar-diagnostico-cie10" data-id="'.$value['cie10hf_id'].'"></i>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        $this->setOutputV2(array('row'=>$row));
    }
    public function AjaxEliminarDiagnostico() {
        $this->config_mdl->_delete_data('um_cie10_hojafrontal',array(
            'cie10hf_id'=> $this->input->post('cie10hf_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxCIE10() {
        $cie10_nombre= $this->input->post('cie10_nombre');
        $sql= $this->config_mdl->_query("SELECT * FROM um_cie10 WHERE cie10_nombre LIKE '%$cie10_nombre%' LIMIT 50");
        foreach ($sql as $value) {
            $um_cie10.='<li>'.$value['cie10_nombre'].'</li>';
        }
        $this->setOutput(array('um_cie10'=>$um_cie10));
    }
    public function AjaxCheckCIE10() {
        $sql= $this->config_mdl->sqlGetDataCondition('um_cie10',array(
            'cie10_nombre'=> $this->input->post('cie10_nombre')
        ));
        if(!empty($sql)){
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function AjaxEliminarNotas() {
        $sqlAnexos= $this->config_mdl->sqlGetDataCondition('doc_notas_anexos',array(
            'notas_id'=> $this->input->post('notas_id')
        ));
        foreach ($sqlAnexos as $value) {
            unlink('assets/NotasAnexos/'.$value['anexo_img']);
        }
        $this->config_mdl->sqlDelete('doc_notas_anexos',array(
            'notas_id'=> $this->input->post('notas_id')
        ));
        $this->config_mdl->sqlDelete('doc_nota',array(
            'notas_id'=> $this->input->post('notas_id')
        ));
        $this->config_mdl->sqlDelete('doc_notas',array(
            'notas_id'=> $this->input->post('notas_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function HojaAltaHospitalaria($Hoja) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_date_am,ing.ingreso_time_am,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                            pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                            pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                            info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                            ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,info.info_indicio_embarazo,
                                            ing.ingreso_time_horacero, ing.ingreso_date_horacero 
                                            FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                            WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$_GET['folio'])[0];
        $sql['Hoja']= $this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria',array(
            'ha_id'=>$Hoja
        ))[0];
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'notas_id'=>$Hoja,
            'sv_tipo'=>'Hoja de Alta Hospitalaria'
        ))[0];
        $sql['Medicos']= $this->config_mdl->_query("SELECT * FROM sigh_empleados AS emp, sigh_empleados_roles AS emp_rol, sigh_roles AS rol WHERE 
                                                    emp_rol.empleado_id=emp.empleado_id AND
                                                    emp_rol.rol_id=rol.rol_id AND
                                                    rol.rol_id=2");
        $this->load->view('Documentos/Doc_HojaAltaHospitalaria',$sql);
    }
    public function AjaxHojaAltaDx() {
        $data=array(
            'dx_tipo'=> $this->input->post('dx_tipo'),
            'dx_'=> $this->input->post('dx'),
            'dx_codificacion'=> $this->input->post('dx_codificacion'),
            'ha_id'=> $this->input->post('ha_id'),
            'dx_temp'=> $this->input->post('dx_temp')
        );
        if($this->input->post('dx_accion')=='add'){
            $this->config_mdl->sqlInsert('doc_ha_hospitalaria_dx',$data);
            
        }else{
            if($this->input->post('ha_id')==0){
                $this->config_mdl->sqlUpdate('doc_ha_hospitalaria_dx',$data,array(
                    'dx_temp'=> $this->input->post('dx_temp')
                ));
            }else{
                $this->config_mdl->sqlUpdate('doc_ha_hospitalaria_dx',$data,array(
                    'ha_id'=> $this->input->post('ha_id')
                ));
            }
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxHojaAltaDxGet() {
        if($this->input->post('ha_id')==0){
            $sql=$this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria_dx',array(
                'dx_temp'=> $this->input->post('ha_temp')
            ));
        }else{
            $sql=$this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria_dx',array(
                'ha_id'=> $this->input->post('ha_id')
            ));
        }
        $tr='';
        foreach ($sql as $value) {
            $tr.=   '<tr>
                        <td>'.$value['dx_tipo'].'</td>
                        <td>'.$value['dx_codificacion'].'</td>
                        <td>'.$value['dx_'].'</td>
                    </tr>';
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function AjaxHojaAltaPro() {
        $data=array(
            'pro_nombre'=> $this->input->post('pro_nombre'),
            'pro_codificacion'=> $this->input->post('pro_codificacion'),
            'pro_fecha'=> $this->input->post('pro_fecha'),
            'ha_id'=> $this->input->post('ha_id'),
            'pro_temp'=> $this->input->post('pro_temp')
        );
        if($this->input->post('pro_accion')=='add'){
            $this->config_mdl->sqlInsert('doc_ha_hospitalaria_pro',$data);
            
        }else{
            if($this->input->post('pro_id')==0){
                $this->config_mdl->sqlUpdate('doc_ha_hospitalaria_pro',$data,array(
                    'pro_temp'=> $this->input->post('pro_temp')
                ));
            }else{
                $this->config_mdl->sqlUpdate('doc_ha_hospitalaria_pro',$data,array(
                    'pro_id'=> $this->input->post('pro_id')
                ));
            }
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxHojaAltaProGet() {
        if($this->input->post('ha_id')==0){
            $sql=$this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria_pro',array(
                'pro_temp'=> $this->input->post('ha_temp')
            ));
        }else{
            $sql=$this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria_pro',array(
                'ha_id'=> $this->input->post('ha_id')
            ));
        }
        $tr='';
        foreach ($sql as $value) {
            $tr.=   '<tr>
                        <td>'.$value['pro_codificacion'].'</td>
                        <td>'.$value['pro_fecha'].'</td>
                        <td>'.$value['pro_nombre'].'</td>
                    </tr>';
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function AjaxHojaAltaHospitalaria() {
        $dataHoja=array(
            'ha_fecha'=> date('Y-m-d'),
            'ha_hora'=> date('H:i'),
            'ha_fecha_ingreso'=> $this->input->post('ha_fecha_ingreso'),
            'ha_hora_ingreso'=> $this->input->post('ha_hora_ingreso'),
            'ha_fecha_eg'=> $this->input->post('ha_fecha_eg'),
            'ha_hora_eg'=> $this->input->post('ha_hora_eg'),
            'ha_total_dias_estancia'=> $this->input->post('ha_total_dias_estancia'),
            'ha_motivo_egreso'=> $this->input->post('ha_motivo_egreso'),
            'ha_especialidad'=> $this->input->post('ha_especialidad'),
            'ha_envio'=> $this->input->post('ha_envio'),
            'ha_dx_ingreso'=> $this->input->post('ha_dx_ingreso'),
            'ha_dx_ingreso_c'=> $this->input->post('ha_dx_ingreso_c'),
            'ha_dx_ingreso_prin'=> $this->input->post('ha_dx_ingreso_prin'),
            'ha_dx_ingreso_prin_c'=> $this->input->post('ha_dx_ingreso_prin_c'),
            'ha_dx_1_sec'=> $this->input->post('ha_dx_1_sec'),
            'ha_dx_1_sec_c'=> $this->input->post('ha_dx_1_sec_c'),
            'ha_dx_2_sec'=> $this->input->post('ha_dx_2_sec'),
            'ha_dx_2_sec_c'=> $this->input->post('ha_dx_2_sec_c'),
            'ha_com_1_intra'=> $this->input->post('ha_com_1_intra'),
            'ha_com_1_intra_c'=> $this->input->post('ha_com_1_intra_c'),
            'ha_com_2_intra'=> $this->input->post('ha_com_2_intra'),
            'ha_com_2_intra_c'=> $this->input->post('ha_com_2_intra_c'),
            'ha_egreso_df_dx1'=> $this->input->post('ha_egreso_df_dx1'),
            'ha_egreso_df_dx2'=> $this->input->post('ha_egreso_df_dx2'),
            'ha_egreso_df_autopsia'=> $this->input->post('ha_egreso_df_autopsia'),
            'ha_programa'=> $this->input->post('ha_programa'),
            'ha_planificacion'=> $this->input->post('ha_planificacion'),
            'ha_ramo_seguro'=> $this->input->post('ha_ramo_seguro'),
            'ha_n_recetas'=> $this->input->post('ha_n_recetas'),
            'ha_area'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'ha_medico_supervisa'=> $this->input->post('ha_medico_supervisa'),
            'ha_medico_autoriza'=> $this->input->post('ha_medico_autoriza'),
            'ingreso_id'=> $this->input->post('ingreso_id')
        );
        
        if($this->input->post('accion')=='add'){
            $this->config_mdl->sqlInsert('doc_ha_hospitalaria',$dataHoja);
            $MaxNota= $this->config_mdl->_get_last_id('doc_ha_hospitalaria','ha_id');
            $this->config_mdl->sqlUpdate('doc_ha_hospitalaria_dx',array(
                'ha_id'=>$MaxNota
            ),array(
                'dx_temp'=> $this->input->post('ha_temp')
            ));
            $this->config_mdl->sqlUpdate('doc_ha_hospitalaria_pro',array(
                'ha_id'=>$MaxNota
            ),array(
                'pro_temp'=> $this->input->post('ha_temp')
            ));
        }else{
            $this->config_mdl->sqlUpdate('doc_ha_hospitalaria',$dataHoja,array(
                'ha_id'=> $this->input->post('ha_id')
            ));
            $MaxNota=$this->input->post('ha_id');
        }
        $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'notas_id'=>$MaxNota,
            'sv_tipo'=> 'Hoja de Alta Hospitalaria'
        ),'sv_id');
        $dataSV=array(
            'sv_tipo'=> 'Hoja de Alta Hospitalaria',
            'sv_fecha'=> date('Y-m-d'),
            'sv_hora'=>date('H:i:s'),
            'sv_ta'=> $this->input->post('sv_ta'),
            'sv_temp'=> $this->input->post('sv_temp'),
            'sv_fc'=> $this->input->post('sv_fc'),
            'sv_fr'=> $this->input->post('sv_fr'),
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'notas_id'=>$MaxNota,
            'empleado_id'=> $this->UMAE_USER
        );
        if(empty($sqlCheck)){
            $this->config_mdl->sqlInsert('sigh_pacientes_sv',$dataSV);
        }else{
            unset($dataSV['sv_fecha']);
            unset($dataSV['sv_hora']);
            $this->config_mdl->sqlUpdate('sigh_pacientes_sv',$dataSV,array(
                'sv_tipo'=>'Hoja de Alta Hospitalaria',
                'notas_id'=>$MaxNota,
            ));
        }   
        $this->setOutput(array('accion'=>'1','ha_id'=>$MaxNota));
    }
    public function AjaxNotificarMP() {
        $sqlMP= $this->config_mdl->sqlGetDataCondition('ts_ministerio_publico',array(
            'triage_id'=> $this->input->post('triage_id')
        ));
        if(empty($sqlMP)){
            $this->config_mdl->_insert('ts_ministerio_publico',array(
                'mp_estatus'=>'Enviado',
                'mp_fecha'=> date('Y-m-d'),
                'mp_hora'=> date('H:i:s'),
                'mp_area'=> $this->input->post('mp_area'),
                'triage_id'=> $this->input->post('triage_id'),
                'medico_familiar'=> $this->UMAE_USER
            ));
            $this->setOutput(array('accion'=>'1'));
        }else{
            $this->setOutput(array('accion'=>'2'));
        }
    }
    public function Dx() {
        $dxTemp=$_GET['temp'];
        $ingreso=$_GET['ingreso'];
        $dxEspecialidad=$_GET['Especialidad'];
        $sql['Check']= count($this->config_mdl->sqlGetDataCondition('sigh_pacientes_dx',array(
            'dx_temp'=>$dxTemp,
            'dx_tipo'=>'PRIMARIO'
        )));
        
        $sql['DxPrimario']= $this->config_mdl->sqlQuery("SELECT dx.*, em.empleado_nombre, em.empleado_ap,em.empleado_am FROM sigh_pacientes_dx AS dx, sigh_empleados AS em
                                                        WHERE dx.empleado_id=em.empleado_id AND 
                                                        dx.dx_tipo='PRIMARIO' AND dx.dx_especialidad='$dxEspecialidad' AND dx.ingreso_id=$ingreso ORDER BY dx_id DESC");
        $this->load->view('Documentos/Dx',$sql);
    }
    public function HistorialDx() {
        $Paciente= $this->input->get_post('ingreso');
        $sql['Dxs']= $this->config_mdl->sqlQuery("SELECT dx.dx_id,dx.dx_fecha, dx.dx_hora, dx.dx_tipo, dx.dx_dx, cie.id10
                                            FROM sigh_pacientes_dx AS dx, sigh_cie10 AS cie WHERE
                                            dx.cie10_n4=cie.id10 AND dx.ingreso_id=$Paciente ORDER BY dx_id ASC");
        $this->load->view('Documentos/DxHistory',$sql);
    }
    public function AjaxCie10N2() {
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cie10 WHERE sigh_cie10.grp10='".$this->input->post('grp10')."'");
        $option='<option value="" selected="">Seleccionar uno de la Lista</option>';
        foreach ($sql as $value){
            $option.='<option value="'.$value['id10'].'">'.$value['dec10'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxCie10N3() {
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cie10 WHERE sigh_cie10.grp10='".$this->input->post('grp10')."'");
        $option='<option value="" selected="">Seleccionar uno de la Lista</option>';
        foreach ($sql as $value){
            $option.='<option value="'.$value['id10'].'">'.$value['dec10'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxCie10N4() {
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cie10 WHERE sigh_cie10.id10 LIKE'".$this->input->post('grp10')."%'");
        $option='';
        foreach ($sql as $value){
            $option.='<option value="'.$value['id10'].'">'.$value['dec10'].'</option>';
        }
        $this->setOutput(array('option'=>$option));
    }
    public function AjaxDxPaciente() {
        $data=array(
            'dx_fecha'=> date('Y-m-d'),
            'dx_hora'=> date('H:i:s'),
            'dx_tipo'=> $this->input->post('dx_tipo'),
            'dx_dx'=> $this->input->post('dx_dx'),
            'dx_temp'=> $this->input->post('dx_temp'),
            'dx_especialidad'=> $this->input->post('dx_especialidad'),
            'cie10_n1'=> $this->input->post('cie10_n1'),
            'cie10_n2'=> $this->input->post('cie10_n2'),
            'cie10_n3'=> $this->input->post('cie10_n3'),
            'cie10_n4'=> $this->input->post('cie10_n4'),
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=> $this->input->post('ingreso_id'),
        );
        $this->config_mdl->sqlInsert('sigh_pacientes_dx',$data);
        $this->setOutput(array('accion'=>'1'));
        
    }
    public function AjaxGetDx() {
        $temp= $this->input->post('temp');
        $sql= $this->config_mdl->sqlQuery("SELECT dx.dx_id,dx.dx_fecha, dx.dx_hora, dx.dx_tipo, dx.dx_dx, cie.dec10
                                            FROM sigh_pacientes_dx AS dx, sigh_cie10 AS cie WHERE
                                            dx.cie10_n4=cie.id10 AND dx.dx_temp='$temp' ORDER BY dx_id ASC");
        $tr='';
        if(!empty($sql)){
            foreach ($sql as $value) {
                $label='';
                if($value['dx_tipo']=='PRIMARIO'){
                    $label='green';
                }if($value['dx_tipo']=='SECUNDARIO'){
                    $label='blue';
                }if($value['dx_tipo']=='PRESUNTIVO'){
                    $label='orange';
                }
                $tr.=   '<tr>
                            <td>'.$value['dx_fecha'].' '.$value['dx_hora'].'</td>
                            <td><span class="label '.$label.'">'.$value['dx_tipo'].'</span></td>
                            <td>'.$value['dx_dx'].'</td>
                            <td class="text-uppercase">'.$value['dec10'].'</td>
                            <td><i class="fa fa-trash-o sigh-color i-24 pointer dx-cie10-del" data-id="'.$value['dx_id'].'"></i></td>
                        </tr>';
            }
        }else{
            
        }
        $this->setOutput(array('tr'=>$tr));
    }
    public function VideoDx() {
        $this->load->view('Documentos/DxVideo');
    }
    public function AjaxElimiarDxCie10() {
        $this->config_mdl->sqlDelete('sigh_pacientes_dx',array(
            'dx_id'=> $this->input->post('dx_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxInterConsulta() {
        if($this->UMAE_AREA=='Médico Observación'){
            $sqlEmpleado= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                'empleado_id'=> $this->UMAE_USER
            ))[0];
            $doc_modulo='Observación';
            $doc_servicio_envia=$sqlEmpleado['empleado_servicio'];
            $this->config_mdl->sqlUpdate('sigh_observacion',array(
                'observacion_medico_status'=>'Interconsulta',
            ),array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            ));    
        }else{
            $doc_modulo='Consultorios';
            $doc_servicio_envia=Modules::run('Consultorios/ObtenerEspecialidad',array('Consultorio'=>$this->UMAE_AREA));
            $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',array(
                'ce_status'=>'Interconsulta',
                'ce_interconsulta'=>'Si'
            ),array(
                'ingreso_id'=>  $this->input->post('ingreso_id')
            )); 
        }
        $sqlInterconsulta= $this->config_mdl->sqlGetDataCondition('sigh_doc430200',array(
            'ingreso_id'=> $this->input->post('ingreso_id'),
            'doc_modulo'=>$doc_modulo,
            'doc_servicio_solicitado'=>$this->input->post('doc_servicio_solicitado'),
        ));
        if(empty($sqlInterconsulta)){
            $this->config_mdl->sqlInsert('sigh_doc430200',array(
                'doc_estatus'=>'En Espera',
                'doc_fecha'=> date('Y-m-d'),
                'doc_hora'=> date('H:i'),
                'doc_area'=> $this->UMAE_AREA,
                'doc_servicio_envia'=>$doc_servicio_envia ,
                'doc_servicio_solicitado'=>$this->input->post('doc_servicio_solicitado'),
                'doc_diagnostico'=> $this->input->post('doc_diagnostico'),
                'doc_modulo'=>$doc_modulo,
                'ingreso_id'=> $this->input->post('ingreso_id'),
                'empleado_envia'=> $this->UMAE_USER
            ));
            $sqlInterconsulta= $this->config_mdl->sqlGetLastId('sigh_doc430200','doc_id');
            $this->setOutput(array('accion'=>'1','Interconsulta'=>$sqlInterconsulta));
        }else{
            $this->setOutput(array('accion'=>'2'));
        } 
    }
    public function InterconsultasSolicitadas() {
        if($this->UMAE_AREA=='Médico Observación'){
            $sqlEmpleado= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                'empleado_id'=> $this->UMAE_USER
            ))[0];
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                doc.empleado_envia, doc.doc_estatus, doc.doc_id
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                doc.doc_estatus!='Evaluado' AND
                doc.empleado_envia!=$this->UMAE_USER AND
                ing.paciente_id=pac.paciente_id AND
                ing.ingreso_id=doc.ingreso_id AND  

                doc.doc_servicio_solicitado='".Modules::run('Consultorios/ObtenerEspecialidad',array('Consultorio'=>$sqlEmpleado['empleado_servicio']))."'");

        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                doc.empleado_envia, doc.doc_estatus, doc.doc_id
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                doc.doc_estatus!='Evaluado' AND
                doc.empleado_envia!=$this->UMAE_USER AND
                ing.paciente_id=pac.paciente_id AND
                ing.ingreso_id=doc.ingreso_id AND
                doc.doc_servicio_solicitado='".Modules::run('Consultorios/ObtenerEspecialidad',array('Consultorio'=>$this->UMAE_AREA))."'");
        }
        $this->load->view('Documentos/Interconsulta/InterconsultasSolicitadas',$sql); 
    }
    public function InterconsultasRealizadas() {
        if(isset($_GET['inputDateStart'])){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                    doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                    doc.empleado_envia, doc.doc_estatus, doc.doc_id FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                    ing.paciente_id=pac.paciente_id AND
                    ing.ingreso_id=doc.ingreso_id AND
                    doc.empleado_recive=$this->UMAE_USER AND doc_fecha_r BETWEEN '".$_GET['inputDateStart']."' AND '".$_GET['inputDateEnd']."'");
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                    doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                    doc.empleado_envia, doc.doc_estatus, doc.doc_id FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                    ing.paciente_id=pac.paciente_id AND
                    ing.ingreso_id=doc.ingreso_id AND
                    doc.empleado_recive=$this->UMAE_USER AND doc_fecha_r BETWEEN '". date('Y-m-d')."' AND '". date('Y-m-d')."' LIMIT 20");
        }
         
        
        $this->load->view('Documentos/Interconsulta/InterconsultasRealizadas',$sql); 
    }
    public function InterconsultasEnviadas() {
        if(isset($_GET['inputDateStart'])){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                    doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                    doc.empleado_envia, doc.doc_estatus, doc.doc_id FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                    ing.paciente_id=pac.paciente_id AND
                    ing.ingreso_id=doc.ingreso_id AND
                    doc.empleado_envia=$this->UMAE_USER AND doc_fecha_r BETWEEN '".$_GET['inputDateStart']."' AND '".$_GET['inputDateEnd']."'"); 
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                    doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                    doc.empleado_envia, doc.doc_estatus, doc.doc_id FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                    ing.paciente_id=pac.paciente_id AND
                    ing.ingreso_id=doc.ingreso_id AND
                    doc.empleado_envia=$this->UMAE_USER AND doc_fecha BETWEEN '". date('Y-m-d')."' AND '".date('Y-m-d')."' LIMIT 20"); 
        }
        
        $this->load->view('Documentos/Interconsulta/InterconsultasEnviadas',$sql); 
    }
    public function InterconsultasDetalles() {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_pacientes_ingresos AS ing, sigh_doc430200 AS doc, sigh_empleados AS emp WHERE 
            doc.empleado_envia=emp.empleado_id AND
            ing.ingreso_id=doc.ingreso_id AND doc.doc_id=".$this->input->get_post('inter'))[0]; 
        $sql['MedicoTratante']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['empleado_recive']
        ))[0];
        $this->load->view('Documentos/Interconsulta/InterconsultasDetalles',$sql);
    }
    public function AjaxAltaInterconsulta() {
        $this->config_mdl->sqlUpdate('sigh_doc430200',array(
            'doc_estatus'=>'Evaluado'
        ),array(
            'doc_id'=> $this->input->post('doc_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function Vidal() {
        $this->load->view('Documentos/Vidal');
    }
}
