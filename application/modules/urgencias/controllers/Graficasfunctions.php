<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Graficasfunctions
 *
 * @author bienTICS
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Graficasfunctions extends Config{
    public function __construct() {
        parent::__construct();
    }
    /*SQL PARA LAS VISTAS DE GRAFICAS CON BASE AL LOG DE ACCESOS*/
    public function Sql_LogTotalTickets($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT acceso_id FROM os_accesos WHERE 
                os_accesos.acceso_tipo='Hora Cero' AND 
                os_accesos.acceso_fecha='$fecha' AND 
                os_accesos.acceso_turno='$turno' "); 
    }
    public function _LogEnfermeriaTriage($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT acceso_id FROM os_accesos WHERE 
                os_accesos.acceso_tipo='Triage Enfermería' AND 
                os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function _LogMedicoTriage($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT acceso_id FROM os_accesos WHERE 
                os_accesos.acceso_tipo='Triage Médico' AND 
                 os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function _LogAsistentesMedicas($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT acceso_id FROM os_accesos WHERE 
                os_accesos.acceso_tipo='Asistente Médica' AND
                os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function _IndicadorConsultorios($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $consultorio=$data['consultorio'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_consultorios_especialidad
            WHERE 
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_consultorios_especialidad.ce_asignado_consultorio='$consultorio'");
   }
    /**/
    public function LogTotalTickets($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos WHERE 
                os_accesos.acceso_tipo='Hora Cero' AND 
                os_empleados.empleado_id=os_accesos.empleado_id AND 
                os_triage.triage_id=os_accesos.triage_id AND 
                os_accesos.acceso_fecha='$fecha' AND 
                os_accesos.acceso_turno='$turno' "); 
    }
    public function LogEnfermeriaTriage($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos WHERE 
                os_accesos.acceso_tipo='Triage Enfermería' AND 
                os_empleados.empleado_id=os_accesos.empleado_id AND 
                os_triage.triage_id=os_accesos.triage_id AND os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function LogMedicoTriage($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos WHERE 
                os_accesos.acceso_tipo='Triage Médico' AND 
                os_empleados.empleado_id=os_accesos.empleado_id AND 
                os_triage.triage_id=os_accesos.triage_id AND os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function LogAsistentesMedicas($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos,os_asistentesmedicas WHERE 
                os_accesos.acceso_tipo='Asistente Médica' AND 
                os_accesos.areas_id=os_asistentesmedicas.asistentesmedicas_id AND
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function LogRx($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos WHERE 
                os_accesos.acceso_tipo='RX' AND 
                os_empleados.empleado_id=os_accesos.empleado_id AND 
                os_triage.triage_id=os_accesos.triage_id AND os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
    public function LogConsultoriosEspecialidad($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                        os_triage.triage_consultorio_nombre='Filtro' OR 
                        os_triage.triage_consultorio_nombre='Consultorio Maxilofacial' OR
                        os_triage.triage_consultorio_nombre='Consultorio Neurocirugía' OR
                        os_triage.triage_consultorio_nombre='Consultorio Cirugía General'
                ) AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id ");
    }
    public function LogChoque($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_choque_camas, os_accesos, os_empleados, os_triage
                WHERE 
                os_accesos.acceso_tipo='Ingreso Choque' AND
                os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.areas_id=os_choque_camas.choque_cama_id");
    }
    public function LogConsultoriosEspecialidadST7($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                        os_triage.triage_consultorio_nombre='Filtro' OR 
                        os_triage.triage_consultorio_nombre='Consultorio Maxilofacial' OR
                        os_triage.triage_consultorio_nombre='Consultorio Neurocirugía' OR
                        os_triage.triage_consultorio_nombre='Consultorio Cirugía General'
                ) AND
                os_triage.triage_paciente_accidente_lugar='TRABAJO' AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id ");
    }
    public function LogConsultoriosEspecialidadIncapacidad($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad, os_asistentesmedicas
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                        os_triage.triage_consultorio_nombre='Filtro' OR 
                        os_triage.triage_consultorio_nombre='Consultorio Maxilofacial' OR
                        os_triage.triage_consultorio_nombre='Consultorio Neurocirugía' OR
                        os_triage.triage_consultorio_nombre='Consultorio Cirugía General'
                ) AND
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
                os_asistentesmedicas.asistentesmedicas_incapacidad_am='Si' AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id ");
    }
    public function LogEnfermeriaMedicoObs($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $tipo=$data['tipo'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_observacion
            WHERE
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.areas_id=os_observacion.observacion_id");
    }
    public function LogCirugiaAmbulatoria($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id ");
    }
    public function LogCirugiaAmbulatoriaST7($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_triage.triage_paciente_accidente_lugar='TRABAJO' AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id ");
    }
    public function LogCirugiaAmbulatoriaIncapacidad($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad,os_asistentesmedicas
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
		os_asistentesmedicas.asistentesmedicas_incapacidad_am='Si' AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id ");
    }
    public function LogEgresosAsistentesMedicas($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados,  os_asistentesmedicas_egresos
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Egreso Paciente Asistente Médica' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                os_accesos.areas_id=os_asistentesmedicas_egresos.egreso_id");
    }
    
    public function ObtenerPacientesConsultorios($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $consultorio=$data['consultorio'];
        return count($this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad
            WHERE
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_triage.triage_consultorio_nombre='$consultorio'"));
    }
    public function ObtenerPacientesConsultoriosUsuarios($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $consultorio=$data['consultorio'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad, os_empleados
            WHERE
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_triage.triage_consultorio_nombre='$consultorio' GROUP BY os_empleados.empleado_id");
    }
    public function TotalConsultasPacientesConsultorios($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $consultorio=$data['consultorio'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad, os_empleados
            WHERE
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_triage.triage_consultorio_nombre='$consultorio' AND os_empleados.empleado_id=$empleado");
    }
    public function TotalST7PacientesConsultorios($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $consultorio=$data['consultorio'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad, os_empleados
            WHERE
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_triage.triage_paciente_accidente_lugar='TRABAJO' AND
            os_triage.triage_consultorio_nombre='$consultorio' AND os_empleados.empleado_id=$empleado");
    }
    public function TotalIncapacidadPacientesConsultorios($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $consultorio=$data['consultorio'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad, os_empleados, os_asistentesmedicas
            WHERE
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_asistentesmedicas.triage_id=os_triage.triage_id AND
            os_asistentesmedicas.asistentesmedicas_incapacidad_am='Si' AND
            os_triage.triage_consultorio_nombre='$consultorio' AND os_empleados.empleado_id=$empleado");
    }
    public function ObtenerPacientesConsultoriosEmpleados($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $consultorio=$data['consultorio'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad, os_empleados
            WHERE
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_triage.triage_consultorio_nombre='$consultorio' AND os_empleados.empleado_id=$empleado");
    }
    public function ObtenerTurno($data) {
        if($data['turno']=='1'){
            return 'Mañana';
        }if($data['turno']=='2'){
            return 'Tarde';
        }if($data['turno']=='3'){
            return 'Noche';
        }
    }
    /*Productividad usuarios*/
    public function ProductividadUsuarios($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $tipo=$data['tipo'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos WHERE 
                os_accesos.acceso_tipo='$tipo' AND 
                os_empleados.empleado_id=os_accesos.empleado_id AND 
                os_triage.triage_id=os_accesos.triage_id AND 
                os_accesos.acceso_fecha='$fecha' AND 
                os_accesos.acceso_turno='$turno' GROUP BY os_empleados.empleado_id"); 
    }
    public function ProductividadUsuariosConsultas($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $tipo=$data['tipo'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_empleados, os_triage, os_accesos WHERE 
                os_accesos.acceso_tipo='$tipo' AND 
                os_empleados.empleado_id=os_accesos.empleado_id AND 
                os_triage.triage_id=os_accesos.triage_id AND 
                os_accesos.acceso_fecha='$fecha' AND 
                os_accesos.acceso_turno='$turno' AND os_empleados.empleado_id=$empleado"); 
    }
    public function ProductividadUsuariosCA($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id GROUP BY os_empleados.empleado_id");
    }
    public function ProductividadUsuariosConsultasCA($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id AND os_empleados.empleado_id=$empleado");
    }
    public function ProductividadUsuariosST7CA($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_triage.triage_paciente_accidente_lugar='TRABAJO' AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id AND os_empleados.empleado_id=$empleado");
    }
    public function ProductividadUsuariosIncapacidadCA($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_empleados, os_consultorios_especialidad,os_asistentesmedicas
                WHERE
                os_accesos.empleado_id=os_empleados.empleado_id AND
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_asistentesmedicas.triage_id=os_triage.triage_id AND
		os_asistentesmedicas.asistentesmedicas_incapacidad_am='Si' AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id AND os_empleados.empleado_id=$empleado");
    }
    public function ProductividadPacientes($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $tipo=$data['tipo'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage
            WHERE
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.empleado_id=$empleado");
    }
    public function ProductividadPacientesCA($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $empleado=$data['empleado'];
        return $this->config_mdl->_query("SELECT * FROM os_accesos, os_triage, os_consultorios_especialidad
                WHERE
                os_accesos.acceso_tipo='Consultorios Especialidad' AND
                os_accesos.triage_id=os_triage.triage_id AND
                os_accesos.acceso_turno='$turno' AND
                os_accesos.acceso_fecha='$fecha' AND
                (
                    os_triage.triage_consultorio_nombre='Consultorio Cirugía Maxilofacial' OR 
                    os_triage.triage_consultorio_nombre='Consultorio Cpr'
                ) AND
                os_accesos.areas_id=os_consultorios_especialidad.ce_id AND os_accesos.empleado_id=$empleado");
    }
    /*Indicador v2
    *  Indicador Usuarios
    */ 
   public function IndicadorUsuarios($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $tipo=$data['tipo'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage
            WHERE 
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.triage_id=os_triage.triage_id GROUP BY os_empleados.empleado_id");
   }
   public function IndicadorUsuariosTotalConsultas($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $tipo=$data['tipo'];
       $empleado=$data['empleado'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage
            WHERE 
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.triage_id=os_triage.triage_id AND os_empleados.empleado_id=".$empleado);
   }
   public function IndicadorConsultorios($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $consultorio=$data['consultorio'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage, os_consultorios_especialidad
            WHERE 
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_consultorios_especialidad.ce_asignado_consultorio='$consultorio'");
   }
   public function IndicadorConsultoriosUsuarios($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $consultorio=$data['consultorio'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage, os_consultorios_especialidad
            WHERE 
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_consultorios_especialidad.ce_asignado_consultorio='$consultorio' GROUP BY os_empleados.empleado_id ");
   }
   public function IndicadorConsultoriosTotalConsultas($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $consultorio=$data['consultorio'];
       $empleado=$data['empleado'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage, os_consultorios_especialidad
            WHERE 
            os_accesos.acceso_tipo='Consultorios Especialidad' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_consultorios_especialidad.ce_id AND
            os_accesos.triage_id=os_triage.triage_id AND
            os_consultorios_especialidad.ce_asignado_consultorio='$consultorio' AND os_empleados.empleado_id=$empleado ");
   }
   public function IndicadorObservacion($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $tipo=$data['tipo'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage, os_observacion
            WHERE 
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_observacion.observacion_id AND
            os_accesos.triage_id=os_triage.triage_id");
   }
   public function IndicadorObservacionUsuarios($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $tipo=$data['tipo'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage, os_observacion
            WHERE 
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_observacion.observacion_id AND
            os_accesos.triage_id=os_triage.triage_id GROUP BY os_empleados.empleado_id");
   }
   public function IndicadorObservacionPacientes($data) {
       $turno=$data['turno'];
       $fecha=$data['fecha'];
       $tipo=$data['tipo'];
       $empleado=$data['empleado'];
       return $this->config_mdl->_query("SELECT * FROM os_accesos, os_empleados, os_triage, os_observacion
            WHERE 
            os_accesos.acceso_tipo='$tipo' AND
            os_accesos.acceso_fecha='$fecha' AND
            os_accesos.acceso_turno='$turno' AND
            os_accesos.empleado_id=os_empleados.empleado_id AND
            os_accesos.areas_id=os_observacion.observacion_id AND
            os_accesos.triage_id=os_triage.triage_id AND os_empleados.empleado_id=$empleado");
   }
   /*---------------------------------------------------------------------------*/
   public function IndicadorTriage($data) {
        $turno=$data['turno'];
        $fecha=$data['fecha'];
        $tipo=$data['tipo'];
        return $this->config_mdl->_query("SELECT acceso_id FROM os_accesos WHERE 
                os_accesos.acceso_tipo='$tipo' AND 
                os_accesos.acceso_fecha='$fecha' AND
                os_accesos.acceso_turno='$turno'");
    }
}
