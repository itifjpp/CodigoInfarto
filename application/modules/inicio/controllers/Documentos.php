<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documentos
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Documentos extends Config{
    public function index() {
        $this->load->view('Documentos/index');
    }
    public function Clasificacion($Paciente) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_destino_triage,ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,ing.ingreso_date_medico,ing.ingreso_time_medico,ing.ingreso_medico_id, pac.paciente_nombre, pac.paciente_ap,pac.paciente_am, ing.ingreso_time_am,ing.ingreso_date_am, pac.paciente_fn,
                                                    ing.ingreso_date_horacero,ing.ingreso_time_horacero, pac.paciente_sexo, pac.paciente_nss, pac.paciente_nss_agregado, info.info_procedencia_esp,
                                                    info.info_procedencia_esp_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['Clasificacion']=  $this->config_mdl->sqlGetDataCondition('sigh_pacientes_clasificacion_ing',array(
            'ingreso_id'=>  $Paciente
        ))[0];
        $sql['Medico']=  $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['ingreso_medico_id']
        ),'empleado_nombre, empleado_ap,empleado_am, empleado_matricula')[0];
        if($_GET['via']=='Choque'){
            $sql['class_choque']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_pacientes_sv
            WHERE 
            sigh_pacientes_sv.sv_tipo='Choque' AND
            sigh_pacientes_sv.ingreso_id=".$Paciente." ORDER BY sigh_pacientes_sv.sv_id ASC LIMIT 1")[0];
            
        }
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'sv_tipo'=>'Triage',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['AdmisionContinua']= $this->config_mdl->sqlGetDataCondition('or_admision_continua',array(
            'triage_id'=>$Paciente
        ),'ac_diagnostico')[0];
        $sql['ClasificacionSettings']= $this->config_mdl->sqlGetDataCondition('sigh_clasificacion_settings');
        if($sql['info'][0]['triage_consultorio_nombre']=='Ortopedia-Admisión Continua'){
           // $this->load->view('Documentos/ClasificacionOrtopedia',$sql);
        }else{
            $this->load->view('Documentos/Clasificacion',$sql);
        }
        
    }
    public function ST7($Paciente) {
        
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_date_am,ing.ingreso_time_am,ing.ingreso_am_id,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                    pac.paciente_nss,pac.paciente_nss_agregado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                                    pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                                    info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                                    info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa, am.asistentesmedicas_da, am.asistentesmedicas_dl, 
                                                    am.asistentesmedicas_ip, am.asistentesmedicas_tratamientos, am.asistentesmedicas_ss_in, am.asistentesmedicas_ss_ie,
                                                    am.asistentesmedicas_oc_hr,am.asistentesmedicas_am,am.asistentesmedicas_incapacidad_am, am.asistentesmedicas_incapacidad_fi, 
                                                    am.asistentesmedicas_incapacidad_folio,am.asistentesmedicas_incapacidad_da,am.asistentesmedicas_mt, am.asistentesmedicas_mt_m
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac, sigh_asistentesmedicas AS am
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND am.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['ST7_FOLIO']=  $this->config_mdl->sqlGetDataCondition('sigh_st7_folio',array(
            'ingreso_id'=>  $Paciente
        ))[0];
        $sql['hojafrontal']=  $this->config_mdl->sqlGetDataCondition('sigh_hojafrontal',array(
            'ingreso_id'=>  $Paciente
        ),'hf_diagnosticos')[0];
        $sql['DirEmpresa']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Empresa',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Paciente',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['Empresa']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_empresas',array(
            'ingreso_id'=>$Paciente
        ))[0];
        $this->load->view('Documentos/st7',$sql);
    }
    public function HojaFrontal($Paciente) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_date_am,ing.ingreso_time_am,ing.ingreso_am_id,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                pac.paciente_nss,pac.paciente_nss_agregado, pac.paciente_sexo, info.info_delegacion,
                info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['DirEmpresa']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Empresa',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Paciente',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['Empresa']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_empresas',array(
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['am']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['ingreso_am_id']
        ),'empleado_nombre,empleado_ap,empleado_am')[0];
        $this->load->view('Documentos/hojafrontal',$sql);
    }
    public function HojaFrontalCE($Paciente) {
        $sql['hoja']=  $this->config_mdl->_get_data_condition('sigh_hojafrontal',array(
            'ingreso_id'=>  $Paciente
        ))[0];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,
                                                    ing.ingreso_enfermera_id,ing.ingreso_date_am,ing.ingreso_time_am,ing.ingreso_am_id,
                                                    ing.ingreso_date_horacero,ing.ingreso_time_horacero,ing.ingreso_date_enfermera,ing.ingreso_time_enfermera,
                                                    pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,pac.paciente_rfc,
                                                    pac.paciente_nss,pac.paciente_nss_agregado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                                    pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                                    info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                                    info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa, am.asistentesmedicas_da, am.asistentesmedicas_dl, 
                                                    am.asistentesmedicas_ip, am.asistentesmedicas_tratamientos, am.asistentesmedicas_ss_in, am.asistentesmedicas_ss_ie,
                                                    am.asistentesmedicas_oc_hr,am.asistentesmedicas_am,am.asistentesmedicas_incapacidad_am, am.asistentesmedicas_incapacidad_fi, 
                                                    am.asistentesmedicas_incapacidad_folio,am.asistentesmedicas_incapacidad_da,am.asistentesmedicas_mt, am.asistentesmedicas_mt_m
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac, sigh_asistentesmedicas AS am
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND am.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['am']=  $this->config_mdl->sqlGetDataCondition('sigh_asistentesmedicas',array(
            'ingreso_id'=>  $Paciente
        ),'asistentesmedicas_fecha,asistentesmedicas_hora,asistentesmedicas_incapacidad_am,asistentesmedicas_incapacidad_tipo,asistentesmedicas_incapacidad_folio,asistentesmedicas_incapacidad_fi,asistentesmedicas_incapacidad_da')[0];
        $sql['DirEmpresa']= $this->config_mdl->_get_data_condition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Empresa',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->_get_data_condition('sigh_pacientes_directorios',array(
            'directorio_tipo'=>'Paciente',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['Empresa']= $this->config_mdl->_get_data_condition('sigh_pacientes_empresas',array(
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['Medico']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['hoja']['empleado_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['AsistenteMedica']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['ingreso_am_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['Enfermera']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['ingreso_enfermera_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['SignosVitales']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'sv_tipo'=>'Triage',
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['Dxs']= $this->config_mdl->sqlQuery("SELECT dx.dx_fecha, dx.dx_hora, dx.dx_tipo, dx.dx_dx, cie.id10
                                            FROM sigh_pacientes_dx AS dx, sigh_cie10 AS cie WHERE
                                            dx.cie10_n4=cie.id10 AND dx.dx_tipo='SECUNDARIO' AND dx.dx_temp='".$sql['hoja']['hf_temp']."'");
        $this->load->view('Documentos/HojaFrontal430128',$sql); 
        
    }
    public function HojaInicialAbierto($Paciente){
        $sql['hoja']=  $this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['info']=  $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['am']=  $this->config_mdl->sqlGetDataCondition('os_asistentesmedicas',array(
            'triage_id'=>  $Paciente
        ),'asistentesmedicas_fecha,asistentesmedicas_hora,asistentesmedicas_incapacidad_am,asistentesmedicas_incapacidad_tipo,asistentesmedicas_incapacidad_folio,asistentesmedicas_incapacidad_fi,asistentesmedicas_incapacidad_da')[0];
        $sql['DirEmpresa']= $this->config_mdl->sqlGetDataCondition('os_triage_directorio',array(
            'directorio_tipo'=>'Empresa',
            'triage_id'=>$Paciente
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->sqlGetDataCondition('os_triage_directorio',array(
            'directorio_tipo'=>'Paciente',
            'triage_id'=>$Paciente
        ))[0];
        $sql['Empresa']= $this->config_mdl->sqlGetDataCondition('os_triage_empresa',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['PINFO']= $this->config_mdl->sqlGetDataCondition('paciente_info',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['Medico']= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=>$sql['hoja']['empleado_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula,empleado_cedula')[0];
        $sql['AsistenteMedica']= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=>$sql['info']['triage_crea_am']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['Enfermera']= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=>$sql['info']['triage_crea_enfemeria']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['SignosVitales']= $this->config_mdl->_get_data_condition('os_triage_signosvitales',array(
            'sv_tipo'=>'Triage',
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('Documentos/HojaFrontal430128Abierto',$sql); 
    }
    public function Doc43029() {
        $inputFecha= $this->input->get('fecha');
        $inputTurno= $this->input->get('turno');
        if($inputTurno=='Noche'){
            $sql['Gestion']=$this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am,
                pac.paciente_fn, pac.paciente_nss, pac.paciente_nss_agregado, info.info_delegacion, info.info_umf, info.info_procedencia_esp,
                info.info_procedencia_esp_lugar,info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,
                ing.ingreso_date_am, ing.ingreso_time_am, doc.doc_fecha, doc.doc_hora
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info , sigh_doc43029 AS doc
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND doc.ingreso_id=ing.ingreso_id AND
                doc.doc_turno='Noche A' AND doc.doc_fecha='$inputFecha'");
            
            $sql['Gestion2']=$this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am,
                pac.paciente_fn, pac.paciente_nss, pac.paciente_nss_agregado, info.info_delegacion, info.info_umf, info.info_procedencia_esp,
                info.info_procedencia_esp_lugar,info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,
                ing.ingreso_date_am, ing.ingreso_time_am, doc.doc_fecha, doc.doc_hora
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info , sigh_doc43029 AS doc
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND doc.ingreso_id=ing.ingreso_id AND
                doc.doc_turno='Noche B' AND doc.doc_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY)");
            

        }else{
            $sql['Gestion']=$this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am,
                pac.paciente_fn, pac.paciente_nss, pac.paciente_nss_agregado, info.info_delegacion, info.info_umf, info.info_procedencia_esp,
                info.info_procedencia_esp_lugar,info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,
                ing.ingreso_date_am, ing.ingreso_time_am, doc.doc_fecha, doc.doc_hora
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info , sigh_doc43029 AS doc
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND doc.ingreso_id=ing.ingreso_id AND
                doc.doc_turno='$inputTurno' AND doc.doc_fecha='$inputFecha'");
            $sql['Gestion2']=NULL;
        }

        $this->load->view('Documentos/JAM_43029_IE',$sql);
    }
    public function Doc43021() {
        $inputFecha= $this->input->get('fecha');
        $inputTurno= $this->input->get('turno');
        $inputTipo= $this->input->get('tipo');
        if($inputTurno=='Noche'){
            $sql['Gestion']=$this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am,
                pac.paciente_fn, pac.paciente_nss, pac.paciente_nss_agregado, info.info_delegacion, info.info_umf, info.info_procedencia_esp,
                info.info_procedencia_esp_lugar,info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,
                ing.ingreso_date_am, ing.ingreso_time_am, doc.doc_fecha, doc.doc_hora
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info , sigh_doc43021 AS doc
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND doc.ingreso_id=ing.ingreso_id AND
                doc.doc_turno='Noche A' AND doc.doc_tipo='$inputTipo' AND doc.doc_fecha='$inputFecha'");
            $sql['Gestion2']=$this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am,
                pac.paciente_fn, pac.paciente_nss, pac.paciente_nss_agregado, info.info_delegacion, info.info_umf, info.info_procedencia_esp,
                info.info_procedencia_esp_lugar,info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,
                ing.ingreso_date_am, ing.ingreso_time_am, doc.doc_fecha, doc.doc_hora
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info , sigh_doc43021 AS doc
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND doc.ingreso_id=ing.ingreso_id AND
                doc.doc_turno='Noche B' AND doc.doc_tipo='$inputTipo' AND doc.doc_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY)");

        }else{
            $sql['Gestion']=$this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre,pac.paciente_ap, pac.paciente_am,
                pac.paciente_fn, pac.paciente_nss, pac.paciente_nss_agregado, info.info_delegacion, info.info_umf, info.info_procedencia_esp,
                info.info_procedencia_esp_lugar,info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,
                ing.ingreso_date_am, ing.ingreso_time_am, doc.doc_fecha, doc.doc_hora
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info , sigh_doc43021 AS doc
                WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND doc.ingreso_id=ing.ingreso_id AND
                doc.doc_turno='$inputTurno' AND doc.doc_tipo='$inputTipo' AND doc.doc_fecha='$inputFecha'");
            $sql['Gestion2']=NULL;
        }
        if($inputTipo=='Ingreso'){
            $this->load->view('Documentos/JAM_43021_I',$sql);
        }else{
            $this->load->view('Documentos/JAM_43021_E',$sql);
        }
    }
    public function ObtenerCamasObsChoque($data) {
        if($data['tipo']=='Choque'){
            $sql= $this->config_mdl->_query("SELECT * FROM os_observacion, os_camas WHERE os_camas.cama_id=os_observacion.observacion_cama AND
                os_observacion.triage_id=".$data['triage_id'])[0];
            return $sql['cama_nombre'];
        }else{
            $sql= $this->config_mdl->_query("SELECT * FROM os_choque_v2, os_camas WHERE os_camas.cama_id=os_choque_v2.cama_id AND
                os_choque_v2.triage_id=".$data['triage_id'])[0];
            return $sql['cama_nombre'];
        }
    }
    public function HojaFrontalPacientes($data) {
        $sql=$this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>$data['triage_id']
        ))[0];
        if(empty($sql)){
            return '';
        }else{
            return $sql['hf_diagnosticos_lechaga'];
        }
    }
    public function SolicitudServicioTransfusion($Tratamiento) {
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $this->load->view('Documentos/SolicitudServicioTransfusion',$sql);
    }
    public function CirugiaSegura($Tratamiento) {
        $sql['cs']=  $this->config_mdl->_get_data_condition('os_observacion_cirugiasegura',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $this->load->view('Documentos/CirugiaSegura',$sql);
    }
    public function SolicitudIntervencionQuirurgica($Tratamiento) {
        $sql['cs']=  $this->config_mdl->_get_data_condition('os_observacion_cirugiasegura',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['ci']=  $this->config_mdl->_get_data_condition('os_observacion_ci',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Paciente',
            'triage_id'=>$this->input->get('folio')
        ))[0];
        $this->load->view('Documentos/SolicitudIntervencionQuirurgica',$sql);
    }
    public function CartaConsentimientoInformado($Tratamiento) {
        $sql['observacion']=  $this->config_mdl->_get_data_condition('os_observacion',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['ci']=  $this->config_mdl->_get_data_condition('os_observacion_ci',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['cci']=  $this->config_mdl->_get_data_condition('os_observacion_cci',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $this->load->view('Documentos/CartaConsentimientoInformado',$sql);
    }
    public function ISQ($Tratamiento) {
        $sql['isq']=  $this->config_mdl->_get_data_condition('os_observacion_isq',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['triage']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $sql['ci']=  $this->config_mdl->_get_data_condition('os_observacion_ci',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['cci']=  $this->config_mdl->_get_data_condition('os_observacion_cci',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['st']=  $this->config_mdl->_get_data_condition('os_observacion_solicitudtransfucion',array(
            'tratamiento_id'=> $Tratamiento
        ))[0];
        $sql['PINFO']= $this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=> $this->input->get('folio')
        ))[0];
        $this->load->view('Documentos/ISQ',$sql);
    }
    /*NUEVOS FORMATOS*/
    public function FormatoIngreso_Egreso() {
        $turno=$this->input->get('turno');
        $fecha=$this->input->get('fecha');
        
        if($this->input->get('tipo')=='Ingreso'){
            $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_asistentesmedicas
                                        WHERE 
                                        os_accesos.areas_id=os_asistentesmedicas.asistentesmedicas_id AND
                                        os_triage.triage_id=os_accesos.triage_id AND
                                        os_triage.triage_id=os_asistentesmedicas.triage_id AND 
                                        os_triage.triage_consultorio_nombre!='Observación' AND
                                        os_accesos.acceso_tipo='Asistente Médica' AND 
                                        os_accesos.acceso_turno='$turno' AND 
                                        os_accesos.acceso_fecha='$fecha'"
                );
                $this->load->view('Documentos/JAM_Ingresos',$sql);
        }else{
            $sql['Gestion']=$this->config_mdl->_query("SELECT * FROM os_accesos, os_triage,  os_asistentesmedicas_egresos
                    WHERE 
                    os_accesos.acceso_tipo='Egreso Paciente Asistente Médica' AND
                    os_accesos.acceso_turno='$turno' AND 
                    os_accesos.acceso_fecha='$fecha' AND
                    os_accesos.triage_id=os_triage.triage_id AND
                    os_asistentesmedicas_egresos.triage_id=os_triage.triage_id AND
                    os_asistentesmedicas_egresos.egreso_area='Observacion' AND
                    os_accesos.triage_id=os_triage.triage_id"
                );
                $this->load->view('Documentos/JAM_Egresos',$sql);
        }
    }
    public function ListaPacientesEnEspera() {
        $hoy= date('d/m/Y');
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_asistentesmedicas, os_triage, os_consultorios_especialidad, os_accesos,os_empleados
            WHERE
            os_triage.triage_id=os_asistentesmedicas.triage_id AND
            os_asistentesmedicas.asistentesmedicas_id=os_consultorios_especialidad.asistentesmedicas_id AND
            os_accesos.acceso_tipo='Asistente Médica' AND
            os_consultorios_especialidad.ce_status='En Espera' AND
            os_asistentesmedicas.asistentesmedicas_id=os_accesos.areas_id AND
            os_empleados.empleado_id=os_accesos.empleado_id AND
            os_asistentesmedicas.asistentesmedicas_fecha='$hoy' ");
        $this->load->view('Documentos/ListaPacientesEspera',$sql);
    }
    public function ListaPacientesAsignados() {
        $sql['Gestion']=  $this->config_mdl->_query("SELECT * FROM os_consultorios_especialidad, os_consultorios_especialidad_llamada, os_triage, os_empleados
            WHERE os_consultorios_especialidad.ce_status='Asignado' AND os_triage.triage_id=os_consultorios_especialidad.triage_id AND
            os_empleados.empleado_id=os_consultorios_especialidad.ce_crea AND
            os_consultorios_especialidad.ce_id=os_consultorios_especialidad_llamada.ce_id_ce ORDER BY os_consultorios_especialidad_llamada.cel_id DESC");
        $this->load->view('Documentos/ListaPacientesAsignados',$sql);
    }
    public function LechugaConsultorios() {
        $inputFechaInicio= $this->input->get_post('inputFechaInicio');
        $sql['Notas']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,nota.notas_id, nota.notas_fecha, nota.notas_hora, 
                                                    nota.notas_tipo, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am,
                                                    pac.paciente_nss, pac.paciente_nss_agregado FROM sigh_notas AS nota, sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac
                                                    WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=nota.ingreso_id AND 
                                                    nota.empleado_id=$this->UMAE_USER  AND nota.notas_fecha='$inputFechaInicio'");
        $sql['HojasFrontales']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,hf.hf_urgencia, hf.hf_diagnosticos, hf.hf_atencion, 
                                                    hf.hf_receta_por, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, hf.hf_receta_por,
                                                    info.info_lugar_accidente, pac.paciente_nss, pac.paciente_nss_agregado 
                                                    FROM sigh_hojafrontal AS hf, sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_pacientes_info_ing AS info
                                                    WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=hf.ingreso_id AND info.ingreso_id=ing.ingreso_id AND
                                                    hf.empleado_id=$this->UMAE_USER  AND hf.hf_fg='$inputFechaInicio'");
        $sql['medico']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=> $this->UMAE_USER
        ))[0];
        $this->load->view('Documentos/LechugaConsultorios',$sql);
    }

    public function TarjetaDeIdentificacion($Paciente) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                pac.paciente_rfc, pac.paciente_sexo,info.info_identificacion
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['tarjeta']=  $this->config_mdl->sqlGetDataCondition('sigh_tarjeta_identificacion',array(
            'ingreso_id'=>  $Paciente
        ))[0];
        $sql['HojaFrontal']= $this->config_mdl->sqlQuery("SELECT hf.hf_diagnosticos FROM sigh_hojafrontal AS hf WHERE hf.ingreso_id=".$Paciente);
        
        if($_GET['via']=='Observación'){
            $Origen=  $this->config_mdl->sqlQuery("SELECT observacion_cama FROM sigh_observacion AS obs WHERE obs.ingreso_id=".$Paciente)[0];
            $sql['AreaCama']=  $this->config_mdl->sqlQuery("SELECT * FROM sigh_areas AS area,sigh_camas AS cama WHERE cama.area_id=area.area_id AND cama.cama_id=".$Origen['observacion_cama'])[0];    
        }else{
            $Origen=  $this->config_mdl->sqlQuery("SELECT cama_id FROM sigh_cortaestancia AS ce WHERE ce.ingreso_id=".$Paciente)[0];
            $sql['AreaCama']=  $this->config_mdl->sqlQuery("SELECT * FROM sigh_areas AS area,sigh_camas AS cama WHERE cama.area_id=area.area_id AND cama.cama_id=".$Origen['cama_id'])[0];
            
        }
        $this->load->view('Documentos/TarjetaDeIdentificacion',$sql);
    }
    public function TarjetaDeIdentificacionChoque($Paciente) {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $Paciente
        ))[0];
        if($_GET['via']=='ChoqueV2'){
            $sql['choque']=  $this->config_mdl->_get_data_condition('os_choque_v2',array(
                'triage_id'=>  $Paciente
            ))[0];
        }else{
            $sql['choque']=  $this->config_mdl->_get_data_condition('os_choque_camas',array(
                'triage_id'=>  $Paciente
            ))[0];
        }
        $sql['tarjeta']=  $this->config_mdl->_get_data_condition('os_tarjeta_identificacion',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['hojafrontal']=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['cama']= $this->config_mdl->_query("SELECT * FROM os_areas, os_camas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_id=".$sql['choque']['cama_id'])[0];
        $this->load->view('Documentos/TarjetaDeIdentificacionChoque',$sql);
    }
    public function TarjetaDeIdentificacionAreas($Paciente) {
        $sql['info']=  $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['areas']=  $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['tarjeta']=  $this->config_mdl->_get_data_condition('os_tarjeta_identificacion',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['hojafrontal']=  $this->config_mdl->_get_data_condition('os_consultorios_especialidad_hf',array(
            'triage_id'=>  $Paciente
        ))[0];
        $sql['cama']= $this->config_mdl->_query("SELECT * FROM os_areas, os_camas
            WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_id=".$sql['areas']['cama_id'])[0];
        $this->load->view('Documentos/TarjetaDeIdentificacionAreas',$sql);
    }
    public function ConsentimientoInformadoIngresoObs($Paciente) {
        
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,ing.ingreso_date_medico,ing.ingreso_time_medico,ing.ingreso_medico_id, pac.paciente_nombre, pac.paciente_ap,pac.paciente_am, ing.ingreso_time_am,ing.ingreso_date_am, pac.paciente_fn,
                                                    ing.ingreso_date_horacero,ing.ingreso_time_horacero, pac.paciente_sexo, pac.paciente_nss, pac.paciente_nss_agregado, info.info_procedencia_esp,
                                                    info.info_procedencia_esp_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['obs']=  $this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
            'ingreso_id'=>  $Paciente,
        ))[0];
        $this->load->view('Documentos/ConsentimientoInformadoIngresoObs',$sql);
    }

    public function AsistentesMedicas() {
        $inputFechaInicio= $this->input->get_post('POR_FECHA_FECHA_I');
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_asistentesmedicas,paciente_info, os_triage, os_empleados
            WHERE
            os_asistentesmedicas.triage_id=os_triage.triage_id AND
            paciente_info.triage_id=os_triage.triage_id AND
            os_triage.triage_crea_am=os_empleados.empleado_id AND
            os_asistentesmedicas.asistentesmedicas_omitir='No' AND 
            os_asistentesmedicas.asistentesmedicas_fecha='$inputFechaInicio' AND paciente_info.pia_lugar_accidente='TRABAJO'");
        $sql['Am']= $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=>$this->UMAE_USER
        ))[0];
        $this->load->view("Documentos/AsistentesMedicas",$sql);
    }
    public function Medico($data) {
        $sql= $this->config_mdl->_query('SELECT * FROM os_consultorios_especialidad_hf, os_triage, os_empleados
                WHERE 
                os_consultorios_especialidad_hf.triage_id=os_triage.triage_id AND
                os_consultorios_especialidad_hf.empleado_id=os_empleados.empleado_id AND
                os_triage.triage_id='.$data['triage_id']);
        return $sql[0]['empleado_nombre'].' '.$sql[0]['empleado_ap'].' '.$sql['empleado_am'];
    }
    public function IndicadorPisos() {
        $by_fecha_inicio= $this->input->get_post('by_fecha_inicio');
        $by_fecha_fin= $this->input->get_post('by_fecha_fin');
        $by_hora_fecha= $this->input->get_post('by_hora_fecha');
        $by_hora_inicio= $this->input->get_post('by_hora_inicio');
        $by_hora_fin= $this->input->get_post('by_hora_fin');
        if($this->input->get_post('TipoBusqueda')=='POR_FECHA'){
            if($this->input->get_post('TIPO_ACCION')=='INGRESO'){
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_ingreso BETWEEN '$by_fecha_inicio' AND '$by_fecha_fin'");
            }else{
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_salida BETWEEN '$by_fecha_inicio' AND '$by_fecha_fin'");
            }
            
            
        }else{
            if($this->input->get_post('TIPO_ACCION')=='INGRESO'){
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_ingreso='$by_hora_fecha' AND 
                                                os_areas_pacientes.ap_h_ingreso BETWEEN '$by_hora_inicio' AND '$by_hora_fin'");
            }else{
                $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_triage, os_pisos, os_camas, os_areas, os_areas_pacientes, os_pisos_camas
                                                WHERE
                                                os_areas_pacientes.triage_id=os_triage.triage_id AND
                                                os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                os_pisos_camas.piso_id=os_pisos.piso_id AND
                                                os_pisos_camas.cama_id=os_camas.cama_id AND
                                                os_areas.area_id=os_camas.area_id AND
                                                os_areas_pacientes.ap_f_salida='$by_hora_fecha' AND 
                                                os_areas_pacientes.ap_h_salida BETWEEN '$by_hora_inicio' AND '$by_hora_fin'");
            }
        }   
        $this->load->view('Documentos/IndicadorPisos',$sql);
    }
    public function DOC43051($Paciente) {
        $sql['Diagnostico']= $this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
            'triage_id'=> $Paciente
        ),'hf_diagnosticos')[0];
        $sql['Asignacion']= $this->config_mdl->sqlGetDataCondition('doc_43051',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['info']= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=> $Paciente
        ))[0];
        $sql['area']= $this->config_mdl->_get_data_condition('os_areas_pacientes',array(
            'triage_id'=> $Paciente
        ))[0];
        $sql['PINFO']= $this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=> $Paciente
        ))[0];
        $sql['dirPaciente']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Paciente',
            'triage_id'=> $Paciente
        ))[0];
        $sql['dirEmpresa']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Empresa',
            'triage_id'=> $Paciente
        ))[0];
        $sql['dirFamiliar']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Familiar',
            'triage_id'=> $Paciente
        ))[0];
        $sql['Empresa']= $this->config_mdl->_get_data_condition('os_triage_empresa',array(
            'triage_id'=> $Paciente
        ))[0];
        $sql['AsistenteMedicaIngreso']= $this->config_mdl->sqlGetDataCondition('os_asistentesmedicas',array(
            'triage_id'=> $Paciente
        ),'asistentesmedicas_fecha,asistentesmedicas_hora')[0];
        $sql['AsistenteMedica']= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=> $sql['Asignacion']['empleado_id']
        ),'empleado_nombre','empleado_ap,empleado_am')[0];
        $sql['cama']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE 
            os_camas.area_id=os_areas.area_id AND os_camas.cama_id=".$sql['Asignacion']['cama_id'])[0];
        $sql['Piso']= $this->config_mdl->_query("SELECT * FROM os_pisos, os_pisos_camas WHERE os_pisos.piso_id=os_pisos_camas.piso_id AND 
            os_pisos_camas.cama_id=".$sql['cama']['cama_id'])[0];
        $this->load->view('Documentos/DOC43051',$sql);
    }
    public function CamasOcupadas() {
        if($this->input->get('tipo')=='Total'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Disponibles'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Disponible'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Ocupados'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='Ocupado'  AND os_areas.area_id=".$this->input->get('area')." ORDER BY cama_ingreso_f ASC, cama_ingreso_h ASC");
        }if($this->input->get('tipo')=='Mantenimiento'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Mantenimiento'  AND os_areas.area_id=".$this->input->get('area'));
        }if($this->input->get('tipo')=='Limpieza'){
            $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM os_camas, os_areas
                    WHERE os_camas.area_id=os_areas.area_id AND os_camas.cama_status='En Limpieza'  AND os_areas.area_id=".$this->input->get('area'));
        }
        $this->load->view('Inicio/Documentos/CamasOcupadas',$sql);
    }
    public function ImprimirPulsera($Paciente) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,pac.paciente_pseudonimo, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                pac.paciente_rfc, pac.paciente_sexo,info.info_identificacion
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $this->config_mdl->sqlInsert('sigh_pacientes_pulseras',array(
            'pulsera_fecha'=> date('Y-m-d'),
            'pulsera_hora'=>date('H:i:s'),
            'pulsera_tipo'=> $this->UMAE_AREA,
            'empleado_id'=> $this->UMAE_USER,
            'ingreso_id'=>$Paciente
        ));
        $this->load->view('Documentos/ImprimirPulsera',$sql);
    }
    public function DOC430200($Doc) {
        $sql['doc']= $this->config_mdl->sqlGetDataCondition('sigh_doc430200',array(
           'doc_id'=>$Doc 
        ))[0];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap,pac.paciente_am, pac.paciente_nss,pac.paciente_nss_agregado FROM 
                                        sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=".$sql['doc']['ingreso_id'])[0];
        
        $sql['am']= $this->config_mdl->sqlGetDataCondition('sigh_asistentesmedicas',array(
           'ingreso_id'=>$sql['doc']['ingreso_id'] 
        ))[0];
        $sql['medico']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
           'empleado_id'=>$sql['doc']['empleado_envia'] 
        ))[0];
        $this->load->view('Documentos/DOC430200',$sql);
    }
    public function GenerarNotas($Nota) {
        $sql['Nota']= $this->config_mdl->_query("SELECT * FROM sigh_notas, sigh_nota WHERE
            sigh_notas.notas_id=sigh_nota.notas_id AND 
            sigh_notas.notas_id=".$Nota)[0];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_date_am,ing.ingreso_time_am, ing.ingreso_am_id,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                    pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                                    pac.paciente_estadocivil,pac.paciente_rfc,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                                    info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                                    ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,info.info_indicio_embarazo,
                                                    ing.ingreso_valida_nss 
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$sql['Nota']['ingreso_id'])[0];
        $sql['Medico']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['Nota']['empleado_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['AsistenteMedica']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['ingreso_am_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['SignosVitalesNotas']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'notas_id'=>$sql['Nota']['notas_id'],
            'sv_tipo'=>'Notas Médicas'
        ))[0];
        $sql['SignosVitalesTriage']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'ingreso_id'=>$sql['Nota']['ingreso_id'],
            'sv_tipo'=>'Triage'
        ))[0];
        $sql['Dxs']= $this->config_mdl->sqlQuery("SELECT dx.dx_fecha, dx.dx_hora, dx.dx_tipo, dx.dx_dx, cie.id10
                                            FROM sigh_pacientes_dx AS dx, sigh_cie10 AS cie WHERE
                                            dx.cie10_n4=cie.id10 AND dx.dx_tipo='SECUNDARIO' AND dx.dx_temp='".$sql['Nota']['notas_temp']."'");
        $this->load->view('Documentos/Notas',$sql);
    }
    public function NotaConsultoriosEspecialidad($Nota) {
        $sql['Nota']= $this->config_mdl->_query("SELECT * FROM doc_notas, doc_nota WHERE
            doc_notas.notas_id=doc_nota.notas_id AND 
            doc_notas.notas_id=".$Nota)[0];
        $sql['Medico']= $this->config_mdl->_get_data_condition('os_empleados',array(
            'empleado_id'=> $sql['Nota']['empleado_id']
        ))[0];
        $sql['info']= $this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$sql['Nota']['triage_id']
        ))[0];
        $sql['am']=  $this->config_mdl->_get_data_condition('os_asistentesmedicas',array(
            'triage_id'=>  $sql['Nota']['triage_id']
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Paciente',
            'triage_id'=>$sql['Nota']['triage_id']
        ))[0];
        $sql['DirEmpresa']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Empresa',
            'triage_id'=>$sql['Nota']['triage_id']
        ))[0];
        $sql['Empresa']= $this->config_mdl->_get_data_condition('os_triage_empresa',array(
            'triage_id'=>$sql['Nota']['triage_id']
        ))[0];
        $this->load->view('Documentos/NotaConsultoriosEspecialidad',$sql);
    }
    public function AvisarAlMinisterioPublico($Paciente) {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_date_am,ing.ingreso_time_am,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                            pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                            pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                            info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                            ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,info.info_indicio_embarazo,
                                            ing.ingreso_valida_nss 
                                            FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                            WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$Paciente)[0];
        $sql['AvisoMp']= $this->config_mdl->sqlGetDataCondition('sigh_ministeriopublico',array(
            'ingreso_id'=>$Paciente
        ))[0];
        $sql['Medico']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['AvisoMp']['medico_familiar']
        ))[0];
        $sql['Ts']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['AvisoMp']['trabajosocial']
        ))[0];
        $this->load->view('Documentos/AvisarAlMinisterioPublico',$sql);
    }
    public function ExpedienteAmarillo($Paciente){
        $sql['info']=$this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['PINFO']=$this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['DirPaciente']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Paciente',
            'triage_id'=>$Paciente
        ))[0];
        $sql['DirEmpresa']= $this->config_mdl->_get_data_condition('os_triage_directorio',array(
            'directorio_tipo'=>'Empresa',
            'triage_id'=>$Paciente
        ))[0];
        $sql['Empresa']= $this->config_mdl->_get_data_condition('os_triage_empresa',array(
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('Documentos/ExpedienteAmarillo',$sql);
    }
    public function ExpedienteAmarilloBack($Paciente){
        $sql['info']=$this->config_mdl->_get_data_condition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        $this->load->view('Documentos/ExpedienteAmarilloBack',$sql);
    }
    public function PaseDeVisita($Paciente) {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];
        if($_GET['tipo']=='Pisos'){
            $sqlIngresoPisos= $this->config_mdl->sqlGetDataCondition('os_areas_pacientes',array(
                'triage_id'=>$Paciente
            ));
            if(empty($sqlIngresoPisos)){
                $sql['Cama']= $this->config_mdl->sqlQuery("SELECT * FROM os_camas, doc_43051, os_areas WHERE
                                                            os_camas.area_id=os_areas.area_id AND
                                                            os_camas.cama_id=doc_43051.cama_id AND 
                                                            doc_43051.triage_id=".$Paciente)[0];
            }else{
                $sql['Cama']=$this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE os_camas.area_id=os_areas.area_id AND
                                                    os_camas.cama_dh=".$Paciente)[0];
            }
        }else{
            $sql['Cama']=$this->config_mdl->_query("SELECT * FROM os_camas, os_areas WHERE os_camas.area_id=os_areas.area_id AND
                                                    os_camas.cama_dh=".$Paciente)[0];
        }
        
        $sql['Familiares']= $this->config_mdl->sqlGetDataCondition('um_poc_familiares',array(
            'triage_id'=>$Paciente
        ));
        $this->load->view('Documentos/PaseDeVisita',$sql);
    }
    public function PaseDeVisitaTemp($Paciente) {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('os_triage',array(
            'triage_id'=>$Paciente
        ))[0];   
        $sql['PaseVisita']= $this->config_mdl->sqlGetDataCondition('um_pases_visitas',array(
            'triage_id'=>$Paciente
        ))[0];
        $sql['Familiares']= $this->config_mdl->sqlGetDataCondition('um_poc_familiares',array(
            'triage_id'=>$Paciente
        ));
        $this->load->view('Documentos/PaseDeVisitaTemp',$sql);
    }
    public function ReportesPrealtas() {
        $getFecha=$_GET['getFecha'];
        $getValidacion=$_GET['getValidacion'];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM um_pisos_prealtas, os_triage, os_areas_pacientes, os_areas, os_camas WHERE
                                                        os_areas_pacientes.triage_id=os_triage.triage_id AND		
                                                        os_areas_pacientes.cama_id=os_camas.cama_id AND			
                                                        os_areas_pacientes.ap_area=os_areas.area_id AND							
                                                        um_pisos_prealtas.triage_id=os_triage.triage_id AND 
                                                        um_pisos_prealtas.prealta_fecha='$getFecha' AND um_pisos_prealtas.prealta_confirm='$getValidacion'");
    
        $this->load->view('Documentos/ReportesPrealtas',$sql);
    }
    public function IndicadoresPisos() {
        $inputFecha= $this->input->get('inputFecha');
        $inputTurno= $this->input->get('inputTurno');
        $inputTipo= $this->input->get('inputTipo');
        if($inputTurno=='Noche'){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT log_fecha, log_hora, cama_nombre, triage_nombre, triage_nombre_ap, triage_nombre_am, piso_nombre, area_nombre FROM um_pisos_log AS log
                                                        INNER JOIN os_camas camas ON(
                                                                        camas.cama_id=log.cama_id AND
                                                                        log.log_tipo='$inputTipo' AND log.log_turno='Noche A' AND log.log_fecha='$inputFecha'
                                                        )
                                                        INNER JOIN os_triage tri ON tri.triage_id=log.triage_id
                                                        INNER JOIN os_pisos_camas pi_camas ON pi_camas.cama_id=camas.cama_id 
                                                        INNER JOIN os_pisos piso ON piso.piso_id=pi_camas.piso_id 
                                                        INNER JOIN os_areas area ON area.area_id=camas.area_id");
            $sql['Gestion2']= $this->config_mdl->sqlQuery("SELECT log_fecha, log_hora, cama_nombre, triage_nombre, triage_nombre_ap, triage_nombre_am, piso_nombre, area_nombre FROM um_pisos_log AS log
                                                        INNER JOIN os_camas camas ON(
                                                                        camas.cama_id=log.cama_id AND
                                                                        log.log_tipo='$inputTipo' AND log.log_turno='Noche B' AND log.log_fecha= DATE_ADD('$inputFecha', INTERVAL 1 DAY)
                                                        )
                                                        INNER JOIN os_triage tri ON tri.triage_id=log.triage_id
                                                        INNER JOIN os_pisos_camas pi_camas ON pi_camas.cama_id=camas.cama_id 
                                                        INNER JOIN os_pisos piso ON piso.piso_id=pi_camas.piso_id 
                                                        INNER JOIN os_areas area ON area.area_id=camas.area_id");
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT log_fecha, log_hora, cama_nombre, triage_nombre, triage_nombre_ap, triage_nombre_am, piso_nombre, area_nombre FROM um_pisos_log AS log
                                                        INNER JOIN os_camas camas ON(
                                                                        camas.cama_id=log.cama_id AND
                                                                        log.log_tipo='$inputTipo' AND log.log_turno='$inputTurno' AND log.log_fecha='$inputFecha'
                                                        )
                                                        INNER JOIN os_triage tri ON tri.triage_id=log.triage_id
                                                        INNER JOIN os_pisos_camas pi_camas ON pi_camas.cama_id=camas.cama_id 
                                                        INNER JOIN os_pisos piso ON piso.piso_id=pi_camas.piso_id 
                                                        INNER JOIN os_areas area ON area.area_id=camas.area_id");
        }
        
        $this->load->view('Documentos/IndicadoresEnfermeriaPisos',$sql);
    }
    /**SOLICITUDES DE RX MOSTRAR TODAS LAS SOLICITUDES EN UN SOLO DOCUMENTO*/
    public function SolicitudRx() {
        $ingreso_id= $this->input->get_post('folio');
                $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_consultorio_nombre,ing.ingreso_date_medico,ing.ingreso_time_medico,ing.ingreso_medico_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                    ing.ingreso_date_horacero,ing.ingreso_time_horacero, pac.paciente_sexo, pac.paciente_nss, pac.paciente_nss_agregado, info.info_procedencia_esp,
                                                    info.info_procedencia_esp_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num
                                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$ingreso_id)[0];
        
        $sql['sqlSolicitudesRx']=$this->config_mdl->sqlGetDataCondition('sigh_rx_solicitudes',array(
            'solicitud_id'=>$_GET['sol']
        ));
        $sql['Medico']=  $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['sqlSolicitudesRx'][0]['empleado_id']
        ))[0];
        $this->load->view('Documentos/SolicitudRxAll',$sql);
    }
    public function GenerarHojaAltaHospitalaria($Hoja) {
        $sql['Hoja']= $this->config_mdl->sqlQuery("SELECT * FROM doc_ha_hospitalaria WHERE ha_id=".$Hoja)[0];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,ing.ingreso_acceder,ing.ingreso_time_am,ing.ingreso_date_am,pac.paciente_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                    pac.paciente_pseudonimo,pac.paciente_nss,pac.paciente_nss_agregado,pac.paciente_nss_armado,ing.ingreso_consultorio_nombre, pac.paciente_sexo, ing.ingreso_vigenciaacceder,pac.paciente_curp, info.info_delegacion,
                                    pac.paciente_estadocivil,info.info_umf, info.info_responsable_nombre, info.info_responsable_parentesco,ing.ingreso_consultorio_nombre,
                                    info.info_responsable_telefono,info.info_mt,info.info_am,info.info_lugar_accidente,info.info_lugar_procedencia,info.info_identificacion,
                                    ing.ingreso_pv,info.info_fecha_accidente, info.info_hora_accidente,info.info_dia_pa,ing.ingreso_en,
                                    ing.ingreso_time_horacero ,ing.ingreso_date_horacero 
                                    FROM sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info, sigh_pacientes AS pac
                                    WHERE ing.paciente_id=pac.paciente_id AND info.ingreso_id=ing.ingreso_id AND ing.ingreso_id=".$sql['Hoja']['ingreso_id'])[0];
        
        $sql['Medico']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['Hoja']['empleado_id']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['AsistenteMedica']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$sql['info']['triage_crea_am']
        ),'empleado_nombre,empleado_ap,empleado_am,empleado_matricula')[0];
        $sql['SignosVitalesNotas']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'notas_id'=>$sql['Hoja']['ha_id'],
            'sv_tipo'=>'Hoja de Alta Hospitalaria'
        ))[0];
        $sql['SignosVitalesTriage']= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
            'ingreso_id'=>$sql['Hoja']['ingreso_id'],
            'sv_tipo'=>'Triage'
        ))[0];
        $this->load->view('Documentos/HojaAltaHospitalaria',$sql);
        //$this->load->view('Documentos/HojaAltaHospitalaria_Old',$sql);
    }
    public function HL_CL() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT c.cama_nombre, c.cama_fh_estatus, a.area_nombre,a.area_modulo FROM os_camas AS c, os_areas AS a WHERE 
                                            c.area_id=a.area_id AND
                                            c.cama_status='En Limpieza'");
        $this->load->view('Documentos/HL_CL',$sql);
    }
    public function ReportesIngresoUrgencias() {
        $Hoy= date('Y-m-d H:i:s');
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT c.acceso_fecha, c.acceso_hora, 
                                                    t.triage_id,t.triage_nombre, t.triage_nombre_ap, t.triage_nombre_am,
                                                    t.triage_fecha_nac, t.triage_paciente_sexo,t.triage_paciente_curp,
                                                    t.triage_color, t.triage_en
                                                    FROM os_triage AS t,os_accesos AS c WHERE
                                                    c.triage_id=t.triage_id AND 
                                                    c.acceso_fecha='2017-09-19' AND
                                                    c.acceso_hora BETWEEN '14:00:00' AND '23:59:59' AND c.acceso_tipo='Hora Cero' AND
                                                    t.triage_nombre!=''  ORDER BY t.triage_id DESC ");
        $sql['Gestion2']= $this->config_mdl->sqlQuery("SELECT c.acceso_fecha, c.acceso_hora, t.triage_id,t.triage_nombre, t.triage_nombre_ap, t.triage_nombre_am,
                                                    t.triage_color, t.triage_en
                                                    FROM os_triage AS t,os_accesos AS c WHERE
                                                    c.triage_id=t.triage_id AND 
                                                    c.acceso_fecha='2017-09-20' AND
                                                    c.acceso_hora BETWEEN '00:00:00' AND '$Hoy' AND c.acceso_tipo='Hora Cero' AND
                                                    t.triage_nombre!=''  ORDER BY t.triage_id DESC ");
        $this->load->view('Documentos/ReportesIngresoUrgencias',$sql);
    }
    public function ReporteStatusHospital() {
        $sql['Hospital']= $this->config_mdl->sqlGetDataCondition('um_hospitales',array(
            'hospital_id'=>$_GET['hos']
        ))[0];
        $sql['info']= $this->config_mdl->sqlGetDataCondition('um_hospitales_status',array(
            'status_id'=>$_GET['st']
        ))[0];
        $this->load->view('Documentos/ReporteStatusHospital',$sql);
    }
    public function DistribucionDePersonal() {
        $sql['Dp']= $this->config_mdl->sqlQuery("SELECT * FROM um_distribucion AS dis, os_empleados AS em WHERE
                                                         dis.empleado_id=em.empleado_id AND dis.distribucion_id=".$_GET['dp'])[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM os_empleados AS em, um_distribucion_personal AS dp WHERE
                                                    dp.empleado_id=em.empleado_id AND dp.distribucion_id=".$_GET['dp']);
        $this->load->view('Documentos/DistribucionDePersonal',$sql);
    }
    public function ConsumoMaterialesOsteo() {
        $ReporteConsumo=$_GET['rc'];
        $sql['info']= $this->config_mdl->sqlQuery("SELECT * FROM abs_reporte_consumo  AS rc WHERE  rc.rc_id='$ReporteConsumo'")[0];
        
        $sql['Materiales']= $this->config_mdl->sqlQuery("SELECT sis.sistema_titulo,ele.elemento_titulo, ran.rango_titulo, inv.inventario_id
                                FROM abs_sistemas AS sis, abs_elementos AS ele, abs_rangos AS ran, abs_inventario AS inv, abs_reporte_consumo rc , abs_reporte_consumo_in AS rc_in
                                WHERE
                                sis.sistema_id=ele.sistema_id AND ele.elemento_id=ran.elemento_id AND
                                ran.rango_id=inv.rango_id AND 
                                rc_in.inventario_id=inv.inventario_id AND
                                rc_in.rc_id=rc.rc_id AND rc.rc_id='$ReporteConsumo'");
        $this->load->view('Documentos/ConsumoMaterialesOsteo',$sql);
    }
    public function GenerarRelaciondeSalida() {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT * FROM os_empleados AS em, abs_reporte_consumo AS rc WHERE
                                                    em.empleado_id=rc.arsenal_id AND rc.rc_id=".$_GET['rc'])[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery('SELECT sis.sistema_titulo, ele.elemento_titulo, ran.rango_titulo, inv.inventario_id FROM abs_sistemas AS sis, abs_elementos AS ele, abs_rangos AS ran, abs_inventario AS inv,
                                                abs_reporte_consumo AS rc, abs_reporte_consumo_in rc_in
                                                WHERE
                                                sis.sistema_id=ele.sistema_id AND ele.elemento_id=ran.elemento_id AND
                                                ran.rango_id=inv.rango_id AND 
                                                inv.inventario_id=rc_in.inventario_id AND 
                                                rc.rc_id=rc_in.rc_id AND rc.rc_id='.$_GET['rc']);
        $this->load->view('Documentos/GenerarRelaciondeSalida',$sql);
    }
    public function BarCodes() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('abs_materiales');
        $this->load->view('Documentos/BarCodes',$sql);
    }
    public function InventarioCodigos() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('abs_inventario',array(
            'rango_id'=>$_GET['rango']
        ));
        $this->load->view('Documentos/InventarioCodigos',$sql);
    }
    public function ConsumoMaterialesOsteoDevolucion() {
        $sql['info']= $this->config_mdl->sqlQuery("SELECT * FROM os_empleados AS em, abs_reporte_consumo AS rc WHERE
                                                    em.empleado_id=rc.cirujano_id AND rc.rc_id=".$_GET['rc'])[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT sis.sistema_titulo, ele.elemento_titulo, ran.rango_titulo, inv.inventario_id FROM abs_sistemas AS sis, abs_elementos AS ele, abs_rangos AS ran, abs_inventario AS inv,
                                                abs_reporte_consumo AS rc, abs_reporte_consumo_in rc_in
                                                WHERE
                                                sis.sistema_id=ele.sistema_id AND ele.elemento_id=ran.elemento_id AND
                                                ran.rango_id=inv.rango_id AND 
                                                inv.inventario_id=rc_in.inventario_id AND rc_in.consumo_status in('Sin Ocupar','Devolución') AND
                                                rc.rc_id=rc_in.rc_id AND rc.rc_id=".$_GET['rc']);
        $this->load->view('Documentos/ConsumoMaterialesOsteoDevolucion',$sql);
    }
    public function PrestacionesRopaQuirurgica() {
        $hospital_id= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=> $this->UMAE_USER
        ),'hospital_id')[0]['hospital_id'];
        $inputDateStart= $this->input->get('start');
        $inputDateEnd= $this->input->get('end');
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ropa.*, em.empleado_matricula, em.empleado_nombre, em.empleado_ap,em.empleado_am FROM um_empleados_ropa  AS ropa, os_empleados AS em WHERE ropa.hospital_id=$hospital_id AND 
                                                        em.empleado_id=ropa.empleado_id AND
                                                        ropa.rq_r_fecha BETWEEN '$inputDateStart' AND '$inputDateEnd'");
        $sql['hospital']= $this->config_mdl->sqlGetDataCondition('um_hospitales',array(
            'hospital_id'=>$hospital_id
        ))[0];
        $this->load->view('Documentos/PrestacionesRopaQuirurgica',$sql);
    }
    /*REPORTES DE INDICADORES*/
    public function ReporteIndicadorHoracero() {
        $UMAE_USER=$_SESSION['UMAE_USER'];
        $sql['Usuario']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$UMAE_USER
        ))[0];
        $inputFecha= $this->input->get_post('inputFecha');
        if($this->input->get_post('inputTurno')=='Mañana'){
            $sql['sql1']=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero='$inputFecha' AND ing.ingreso_time_horacero BETWEEN '07:00:00' AND '13:59:59'");
            $sql['sql2']=NULL;
        }if($this->input->get_post('inputTurno')=='Tarde'){
            $sql['sql1']=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero='$inputFecha' AND ing.ingreso_time_horacero BETWEEN '14:00:00' AND '20:59:59'");
            $sql['sql2']=NULL;
        }if($this->input->get_post('inputTurno')=='Noche'){
            $sql['sql1']=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero='$inputFecha' AND ing.ingreso_time_horacero BETWEEN '21:00:00' AND '23:25:59'");
            
            $sql['sql2']=  $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_date_horacero, ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE
                    ing.ingreso_horacero_id=$UMAE_USER AND ing.ingreso_date_horacero=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND ing.ingreso_time_horacero BETWEEN '00:00:00' AND '06:59:59'");
        }
        $this->load->view('Documentos/ReporteIndicadorHoracero',$sql);
    }
    public function ReporteIndicadorTriage() {
        $inputFecha= $this->input->get_post('inputFecha');
        $inputUser=$_SESSION['UMAE_USER'];
        $sql['Usuario']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$inputUser
        ))[0];
        if($this->UMAE_AREA=='Enfermeria Triage'){
            $ConditionCre='ingreso_enfermera_id';
            $ConditionDate='ingreso_date_enfermera';
            $ConditionTime='ingreso_time_enfermera';
        }else{
            $ConditionCre='ingreso_medico_id';
            $ConditionDate='ingreso_date_medico';
            $ConditionTime='ingreso_time_medico';
        }

        if($this->input->get_post('inputTurno')=='Mañana'){
            $sql['sql1']=  $this->config_mdl->sqlQuery("SELECT pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, ing.ingreso_id, ing.ingreso_date_enfermera, ing.ingreso_time_enfermera,ing.ingreso_date_medico, ing.ingreso_time_medico,ing.ingreso_clasificacion FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE
                    ing.paciente_id=pac.paciente_id AND
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate='$inputFecha' AND ing.$ConditionTime BETWEEN '07:00:00' AND '13:59:59'");
            $sql['sql2']=NULL;
        }if($this->input->get_post('inputTurno')=='Tarde'){
            $sql['sql1']=  $this->config_mdl->sqlQuery("SELECT pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, ing.ingreso_id, ing.ingreso_date_enfermera, ing.ingreso_time_enfermera,ing.ingreso_date_medico, ing.ingreso_time_medico,ing.ingreso_clasificacion FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE
                    ing.paciente_id=pac.paciente_id AND
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate='$inputFecha' AND ing.$ConditionTime BETWEEN '14:00:00' AND '20:59:59'");
            $sql['sql2']=NULL;
        }if($this->input->get_post('inputTurno')=='Noche'){
            $sql['sql1']=  $this->config_mdl->sqlQuery("SELECT pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, ing.ingreso_id, ing.ingreso_date_enfermera, ing.ingreso_time_enfermera,ing.ingreso_date_medico, ing.ingreso_time_medico,ing.ingreso_clasificacion FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE
                    ing.paciente_id=pac.paciente_id AND
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate='$inputFecha' AND ing.$ConditionTime BETWEEN '21:00:00' AND '23:25:59'");
            
            $sql['sql2']=  $this->config_mdl->sqlQuery("SELECT pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, ing.ingreso_id, ing.ingreso_date_enfermera, ing.ingreso_time_enfermera,ing.ingreso_date_medico, ing.ingreso_time_medico,ing.ingreso_clasificacion FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac WHERE
                    ing.paciente_id=pac.paciente_id AND
                    ing.$ConditionCre=$inputUser AND ing.$ConditionDate=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND ing.$ConditionTime BETWEEN '00:00:00' AND '06:59:59'");
        }
        $this->load->view('Documentos/ReporteIndicadorTriage',$sql);
    }
    public function ReporteIndicadorEnfermeriaObs() {
        $sql['Usuario']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_matricula'=>$_GET['matricula']
        ))[0];
        
        $inputDateStart= $this->input->get('start');
        $inputDateEnd= $this->input->get('end');
        $inputMatricula= $this->input->post('matricula');           
        if($_GET['tipo']=='Ingreso Enfermería Observación'){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am ,
                pac.paciente_sexo, pac.paciente_nss, pac.paciente_nss_agregado, obs.observacion_fe, obs.observacion_he,
                obs.observacion_fs, obs.observacion_hs
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_observacion AS obs
                WHERE ing.paciente_id=pac.paciente_id AND ing.ingreso_id=obs.ingreso_id AND 
                obs.observacion_fe BETWEEN '$inputDateStart' AND '$inputDateEnd' AND obs.observacion_crea='".$sql['Usuario']['empleado_id']."'");
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, pac.paciente_nombre, pac.paciente_ap, pac.paciente_am ,
                pac.paciente_sexo, pac.paciente_nss, pac.paciente_nss_agregado, obs.observacion_fe, obs.observacion_he,
                obs.observacion_fs, obs.observacion_hs
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_observacion AS obs
                WHERE ing.paciente_id=pac.paciente_id AND ing.ingreso_id=obs.ingreso_id AND 
                obs.observacion_fs BETWEEN '$inputDateStart' AND '$inputDateEnd' AND obs.observacion_crea='".$sql['Usuario']['empleado_id']."'");
        }
        $this->load->view('Documentos/ReporteIndicadorEnfermeriaObs',$sql);
    }
    public function ListaEsperaConsultorios() {
        if($_GET['tipo']=='Asignados'){
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,
                                                            pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                                            lista.lista_espera_id,
                                                            lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                            ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado='Ingresado' AND lista.lista_espera_estatus=''");    
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                                        lista.lista_espera_id,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN('Ausente','En Espera') AND lista.lista_espera_estatus=''");
        }
        
        $this->load->view('Documentos/ReporteListaEspera',$sql);
    }
    public function UsuariosEnCursos() {
        $Curso=$_GET['curso'];
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_cursos',array(
            'curso_id'=>$Curso
        ))[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_cursos AS curso, sigh_cursos_empleados AS ce, sigh_empleados AS emp
                                                        WHERE ce.curso_id=curso.curso_id AND ce.empleado_id=emp.empleado_id AND  curso.curso_id=$Curso ORDER BY emp.empleado_categoria");
    
        $this->load->view('Documentos/ReporteCursosUsuarios',$sql);
    }
    public function FichaMedicoResidente() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$_GET['emp']
        ))[0];
        $sql['Ropa']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
            'empleado_id'=>$_GET['emp'],
        ))[0];
        $sql['Directorio']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$_GET['emp'],
            'directorio_tipo'=>'Empleado'
        ))[0];
        $sql['Familiar']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=>$_GET['emp'],
        ))[0];
        $sql['Directorio2']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$_GET['emp'],
            'directorio_tipo'=>'Familiar'
        ))[0];
        $sql['ua']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
            'empleado_id'=>$_GET['emp'],
        ))[0];
        $sql['Documentos']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
            'empleado_id'=>$sql['info']['empleado_tmp'],
        ));
        $this->load->view('Documentos/FichaMedicoResidente',$sql);
    }
    public function FichaMedicoInterno() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
            'empleado_id'=>$_GET['emp']
        ))[0];
        $sql['Ropa']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ropa',array(
            'empleado_id'=>$_GET['emp'],
        ))[0];
        $sql['Directorio']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$_GET['emp'],
            'directorio_tipo'=>'Empleado'
        ))[0];
        $sql['Familiar']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_familiar',array(
            'empleado_id'=>$_GET['emp'],
        ))[0];
        $sql['Directorio2']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_directorio',array(
            'empleado_id'=>$_GET['emp'],
            'directorio_tipo'=>'Familiar'
        ))[0];
        $sql['ua']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_ua',array(
            'empleado_id'=>$_GET['emp'],
        ))[0];
        $sql['Documentos']= $this->config_mdl->sqlGetDataCondition('sigh_empleados_documentos',array(
            'empleado_id'=>$sql['info']['empleado_tmp'],
        ));
        $this->load->view('Documentos/FichaMedicoInterno',$sql);
    }
    public function ListaUsuarioPreregistro() {
        $sql['sqlUsers']= $this->config_mdl->sqlQuery("SELECT emp.*,ua.eua_especialidad FROM sigh_empleados AS emp, sigh_empleados_ua AS ua, sigh_empleados_roles AS roles
                                    WHERE 
                                    emp.empleado_id=roles.empleado_id AND
                                    roles.rol_id IN (82,85) AND
                                    emp.empleado_nombre!='' AND 
                                    emp.empleado_id=ua.empleado_id AND
                                    emp.empleado_registrotipo='Preregistro' ORDER BY emp.empleado_categoria DESC ,ua.eua_especialidad DESC");
        $this->load->view('Documentos/ListaUsuarioPreregistro',$sql);
    }
    public function ListaEsperaAbandono() {
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT 
                                               ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_date_horacero, ing.ingreso_time_horacero,
                                               pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                               lista.lista_espera_id,lista.lista_espera_consultorio,
                                               lista.lista_espera_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado,
                                               emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am, emp.empleado_perfil
                                               FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_empleados AS emp WHERE
                                               lista.empleado_id=emp.empleado_id AND
                                               lista.lista_espera_date, lista.lista_espera_time BETWEEN '".$_GET['inputDateStart']."' AND '".$_GET['inputDateEnd']."' AND
                                               ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estatus='hidden'");
        $this->load->view('Documentos/ListaEsperaAbandono',$sql);
    }
    public function ListaEsperaIndicadores() {
        $this->load->view('Documentos/ListaEsperaIndicadores');
    }
    public function ReporteTriageGeneral() {
        $this->load->view('Documentos/ReporteTriageGeneral');
    }
    public function ReporteRezagoPacientes() {
        $sql['Lista']= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,
                                                        ing.ingreso_date_enfermera,ingreso_time_enfermera,ing.ingreso_date_medico,ing.ingreso_time_medico,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,paciente_fn,
                                                        lista.lista_espera_id,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND lista.lista_espera_date_envio!='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera') ORDER BY lista.lista_espera_id ASC");
        $this->load->view('Documentos/ReporteRezagoPacientes',$sql);
    }
    public function GenerarIndicadorConsultorios() {
        $inputFilter= $this->input->get_post('inputFilter');
        $inputTurno= $this->input->get_post('inputTurno');
        $inputDateStart= $this->input->get_post('inputDateStart');
        $inputDateEnd= $this->input->get_post('inputDateEnd');
        $inputServicio= $this->input->get_post('Servicio');
        if($inputFilter=='Fechas'){
            $sql['sql1']= $this->config_mdl->sqlQuery("SELECT 
                                                        ing.ingreso_id, ing.ingreso_date_medico, ing.ingreso_time_medico,ce.ce_fe, ce.ce_he,
                                                        ing.ingreso_clasificacion,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                        emp.empleado_id, emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am
                                                    FROM 
                                                            sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                            sigh_empleados AS emp
                                                    WHERE
                                                            emp.empleado_id=ce.ce_crea AND
                                                            ing.ingreso_id=ce.ingreso_id AND
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ce.ce_status='Salida' AND 
                                                            ce.ce_fs BETWEEN '$inputDateStart' AND '$inputDateEnd' AND
                                                            ce.ce_asignado_consultorio='$inputServicio' GROUP BY emp.empleado_id");
        }else{
            if($inputTurno=='Mañana'){
                $inputHora1='07:00';
                $inputHora2='13:59';
            }if($inputTurno=='Tarde'){
                $inputHora1='14:00';
                $inputHora2='20:59';
            }if($inputTurno=='Noche'){
                $inputHora1='21:00';
                $inputHora2='23:59';
            }
            if($inputTurno=='Noche'){
                $sql['sql1']= $this->config_mdl->sqlQuery("SELECT 
                                                            ing.ingreso_id, ing.ingreso_date_medico, ing.ingreso_time_medico,ce.ce_fe, ce.ce_he,
                                                            ing.ingreso_clasificacion,
                                                            pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                            emp.empleado_id, emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am
                                                        FROM 
                                                                sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                sigh_empleados AS emp
                                                        WHERE
                                                                emp.empleado_id=ce.ce_crea AND
                                                                ing.ingreso_id=ce.ingreso_id AND
                                                                ing.paciente_id=pac.paciente_id AND
                                                                ce.ce_status='Salida' AND
                                                                ce.ce_fs='$inputDateStart' AND
                                                                ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                ce.ce_asignado_consultorio='$inputServicio' GROUP BY emp.empleado_id");
                $sql['sql2']= $this->config_mdl->sqlQuery("SELECT 
                                                            ing.ingreso_id, ing.ingreso_date_medico, ing.ingreso_time_medico,ce.ce_fe, ce.ce_he,
                                                            ing.ingreso_clasificacion,
                                                            pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                            emp.empleado_id, emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am
                                                        FROM 
                                                                sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                sigh_empleados AS emp
                                                        WHERE
                                                                emp.empleado_id=ce.ce_crea AND
                                                                ing.ingreso_id=ce.ingreso_id AND
                                                                ing.paciente_id=pac.paciente_id AND
                                                                ce.ce_status='Salida' AND
                                                                ce.ce_fs=DATE_ADD('$inputDateStart', INTERVAL 1 DAY) AND
                                                                ce.ce_hs BETWEEN '00:00' AND '06:59' AND
                                                                ce.ce_asignado_consultorio='$inputServicio' GROUP BY emp.empleado_id");
            }else{
                $sql['sql1']= $this->config_mdl->sqlQuery("
                                                        SELECT 
                                                            ing.ingreso_id, ing.ingreso_date_medico, ing.ingreso_time_medico,ce.ce_fe, ce.ce_he,
                                                            ing.ingreso_clasificacion,
                                                            pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                            emp.empleado_id, emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am
                                                        FROM 
                                                                sigh_consultorios_especialidad AS ce, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,
                                                                sigh_empleados AS emp
                                                        WHERE
                                                                emp.empleado_id=ce.ce_crea AND
                                                                ing.ingreso_id=ce.ingreso_id AND
                                                                ing.paciente_id=pac.paciente_id AND
                                                                ce.ce_status='Salida' AND
                                                                ce.ce_fs='$inputDateStart' AND
                                                                ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                ce.ce_asignado_consultorio='$inputServicio' GROUP BY emp.empleado_id");
            }
        }
        $this->load->view('Documentos/GenerarIndicadorConsultorios',$sql);
    }
}
