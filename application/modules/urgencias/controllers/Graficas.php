<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Graficas
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Graficas extends Config{
    public function index() {
        $this->load->view('graficas/index');
    }
    /*INDICADOR URGENCIAS V2*/
    public function Indicador($Tipo) {
        if($Tipo=='Triage'){
            $this->load->view('Triage/index');
        }else if($Tipo=='Consultorios'){
            $sql['Especialidades']= $this->config_mdl->sqlGetDataCondition("sigh_especialidades",array(
                'especialidad_consultorios'=>'Si'
            ));
            $this->load->view('Consultorios/index',$sql);
        }else if($Tipo=='Observacion'){
            $this->load->view('Observacion/index');
        }else if($Tipo=='Pisos'){
            $this->load->view('Pisos/index');
        }
    }
    /*INDICADORES TRIAGE*/
    public function AjaxIndicadorTriage() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputTipo=$this->input->get_post('inputTipo');
        if($inputTipo=='Hora Cero'){
            $TotalIndicador= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_date_horacero BETWEEN '$inputFechaI' AND '$inputFechaF'");
        }if($inputTipo=='Triage Enfermería'){
            $TotalIndicador= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_date_enfermera BETWEEN '$inputFechaI' AND '$inputFechaF'");
        }if($inputTipo=='Triage Médico'){
            $TotalIndicador= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        }if($inputTipo=='Asistente Médica'){
            $TotalIndicador= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE
                                                            ing.ingreso_date_am BETWEEN '$inputFechaI' AND '$inputFechaF'");
            
        }if($inputTipo=='Derechohabientes'){
            $TotalIndicador= NULL;
        
            
            $TotalDh= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                    WHERE
                                                            pac.paciente_derechohabiente='Si' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
            $TotalNoDh= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                    WHERE
                                                            pac.paciente_derechohabiente='No' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        }
        $this->setOutputV2(array(
            'TotalIndicador'=>count($TotalIndicador),
            'TotalDerechoHabientes'=> count($TotalDh),
            'TotalNoDerechoHabientes'=>count($TotalNoDh)
        ));
    }
    public function AjaxIndicadorTriageTurnos() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputTipo=$this->input->get_post('inputTipo');
        $inputTurno= $this->input->post('inputTurno');
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
            if($inputTipo=='Hora Cero'){
                $NocheA= $this->__AjaxTriageTurnos(array(
                    'inputFecha'=>$inputFechaI,
                    'inputHora1'=>$inputHora1,
                    'inputHora2'=>$inputHora2,
                    'inputAttr1'=>'ingreso_date_horacero',
                    'inputAttr2'=>'ingreso_time_horacero'
                ));
                $NocheB= $this->__AjaxTriageTurnosNoche(array(
                    'inputFecha'=>$inputFechaI,
                    'inputAttr1'=>'ingreso_date_horacero',
                    'inputAttr2'=>'ingreso_time_horacero'
                ));
                $TotalIndicador=$NocheA+$NocheB;
            }if($inputTipo=='Triage Enfermería'){
                $NocheA= $this->__AjaxTriageTurnos(array(
                    'inputFecha'=>$inputFechaI,
                    'inputHora1'=>$inputHora1,
                    'inputHora2'=>$inputHora2,
                    'inputAttr1'=>'ingreso_date_enfermera',
                    'inputAttr2'=>'ingreso_time_enfermera'
                ));
                $NocheB= $this->__AjaxTriageTurnosNoche(array(
                    'inputFecha'=>$inputFechaI,
                    'inputAttr1'=>'ingreso_date_enfermera',
                    'inputAttr2'=>'ingreso_time_enfermera'
                ));
                $TotalIndicador=$NocheA+$NocheB;
            }if($inputTipo=='Triage Médico'){
                $NocheA= $this->__AjaxTriageTurnos(array(
                    'inputFecha'=>$inputFechaI,
                    'inputHora1'=>$inputHora1,
                    'inputHora2'=>$inputHora2,
                    'inputAttr1'=>'ingreso_date_medico',
                    'inputAttr2'=>'ingreso_time_medico'
                ));
                $NocheB= $this->__AjaxTriageTurnosNoche(array(
                    'inputFecha'=>$inputFechaI,
                    'inputAttr1'=>'ingreso_date_medico',
                    'inputAttr2'=>'ingreso_time_medico'
                ));
                $TotalIndicador=$NocheA+$NocheB;
            }if($inputTipo=='Asistente Médica'){
                $NocheA= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE
                                                                ing.ingreso_date_am='$inputFechaI' AND
                                                                ing.ingreso_time_am BETWEEN '$inputHora1' AND '$inputHora2'"));
                $NocheB= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE
                                                                ing.ingreso_date_am=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                                ing.ingreso_time_am BETWEEN '00:00' AND '06:59'"));
                $TotalIndicador=$NocheA+$NocheB;
            }if($inputTipo=='Derechohabientes'){
                $TotalDh_NA= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                        WHERE
                                                            pac.paciente_derechohabiente='Si' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico='$inputFechaI' AND
                                                            ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
                $TotalDh_NB= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                        WHERE
                                                            pac.paciente_derechohabiente='Si' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                            ing.ingreso_time_medico BETWEEN '00:00' AND '06:59'"));
                
                
                $TotalNoDh_NA= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                        WHERE
                                                            pac.paciente_derechohabiente='No' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico='$inputFechaI' AND
                                                            ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
                $TotalNoDh_NB= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                        WHERE
                                                            pac.paciente_derechohabiente='No' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                            ing.ingreso_time_medico BETWEEN '00:00' AND '06:59'"));
            }  
        }else{
            if($inputTipo=='Hora Cero'){
                $TotalIndicador= $this->__AjaxTriageTurnos(array(
                    'inputFecha'=>$inputFechaI,
                    'inputHora1'=>$inputHora1,
                    'inputHora2'=>$inputHora2,
                    'inputAttr1'=>'ingreso_date_horacero',
                    'inputAttr2'=>'ingreso_time_horacero'
                ));
            }if($inputTipo=='Triage Enfermería'){
                $TotalIndicador= $this->__AjaxTriageTurnos(array(
                    'inputFecha'=>$inputFechaI,
                    'inputHora1'=>$inputHora1,
                    'inputHora2'=>$inputHora2,
                    'inputAttr1'=>'ingreso_date_enfermera',
                    'inputAttr2'=>'ingreso_time_enfermera'
                ));
            }if($inputTipo=='Triage Médico'){
                $TotalIndicador= $this->__AjaxTriageTurnos(array(
                    'inputFecha'=>$inputFechaI,
                    'inputHora1'=>$inputHora1,
                    'inputHora2'=>$inputHora2,
                    'inputAttr1'=>'ingreso_date_medico',
                    'inputAttr2'=>'ingreso_time_medico'
                ));
            }if($inputTipo=='Asistente Médica'){
                $TotalIndicador= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE
                                                                ing.ingreso_date_am='$inputFechaI' AND
                                                                ing.ingreso_time_am BETWEEN '$inputHora1' AND '$inputHora2'"));
            }if($inputTipo=='Derechohabientes'){
                $TotalDh_NA= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                        WHERE
                                                            pac.paciente_derechohabiente='Si' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico='$inputFechaI' AND
                                                            ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
                $TotalDh_NB=0;
                $TotalNoDh_NA= count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing
                                                        WHERE
                                                            pac.paciente_derechohabiente='No' AND 
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ing.ingreso_date_medico='$inputFechaI' AND
                                                            ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
                $TotalNoDh_NB=0;
            }    
        }
        
        $this->setOutputV2(array(
            'TotalIndicador'=>$TotalIndicador,
            'TotalDerechoHabientes'=> $TotalDh_NA+$TotalDh_NB,
            'TotalNoDerechoHabientes'=>$TotalNoDh_NA+$TotalNoDh_NB
        ));
    }
    public function __AjaxTriageTurnos($data) {
        $inputFecha=$data['inputFecha'];
        $inputHora1=$data['inputHora1'];
        $inputHora2=$data['inputHora2'];
        $inputAttr1=$data['inputAttr1'];
        $inputAttr2=$data['inputAttr2'];
        return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                                ing.$inputAttr1='$inputFecha' AND
                                                                ing.$inputAttr2 BETWEEN '$inputHora1' AND '$inputHora2'"));
    }
    public function __AjaxTriageTurnosNoche($data) {
        $inputFecha=$data['inputFecha'];
        $inputAttr1=$data['inputAttr1'];
        $inputAttr2=$data['inputAttr2'];
        return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                                ing.$inputAttr1=DATE_ADD('$inputFecha', INTERVAL 1 DAY) AND
                                                                ing.$inputAttr2 BETWEEN '00:00' AND '06:59:59'"));
    }
    public function AjaxIndicadorTriageClasificacion() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $sqlRojo= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='Rojo' AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        $sqlNaranja= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='Naranja' AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        $sqlAmarillo= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='Amarillo' AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        $sqlVerde= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='Verde' AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        $sqlAzul= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='Azul' AND
                                                            ing.ingreso_date_medico BETWEEN '$inputFechaI' AND '$inputFechaF'");
        $this->setOutputV2(array(
            'Rojo'=>count($sqlRojo),
            'Naranja'=>count($sqlNaranja),
            'Amarillo'=>count($sqlAmarillo),
            'Verde'=>count($sqlVerde),
            'Azul'=>count($sqlAzul),
        ));
    }
    public function AjaxIndicadorTriageClasificacionTurnos() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputTurno= $this->input->post('inputTurno');
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
            $sqlRojoNA= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Rojo',
            ));
            $sqlRojoNB= $this->__AjaxTriageClasificacionNoche(array(
                'inputFecha'=>$inputFechaI,
                'inputColor'=>'Rojo',
            ));
            $sqlRojo=$sqlRojoNA+$sqlRojoNB;
            $sqlNaranjaNA= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Naranja',
            ));
            $sqlNaranjaNB= $this->__AjaxTriageClasificacionNoche(array(
                'inputFecha'=>$inputFechaI,
                'inputColor'=>'Naranja',
            ));
            $sqlNaranja=$sqlNaranjaNA+$sqlNaranjaNB;
            $sqlAmarilloNA= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Amarillo',
            ));
            $sqlAmarilloNB= $this->__AjaxTriageClasificacionNoche(array(
                'inputFecha'=>$inputFechaI,
                'inputColor'=>'Amarillo',
            ));
            $sqlAmarillo=$sqlAmarilloNA+$sqlAmarilloNB;
            $sqlVerdeNA= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Verde',
            ));
            $sqlVerdeNB= $this->__AjaxTriageClasificacionNoche(array(
                'inputFecha'=>$inputFechaI,
                'inputColor'=>'Verde',
            ));
            $sqlVerde=$sqlVerdeNA+$sqlVerdeNB;

            $sqlAzulNA= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Azul',
            ));
            $sqlAzulNB= $this->__AjaxTriageClasificacionNoche(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Azul',
            ));
            $sqlAzul=$sqlAzulNA+$sqlAzulNB;
        }else{
            $sqlRojo= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Rojo',
            ));
            $sqlNaranja= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Naranja',
            ));
            $sqlAmarillo= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Amarillo',
            ));
            $sqlVerde= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Verde',
            ));
            $sqlAzul= $this->__AjaxTriageClasificacion(array(
                'inputFecha'=>$inputFechaI,
                'inputHora1'=>$inputHora1,
                'inputHora2'=>$inputHora2,
                'inputColor'=>'Azul',
            ));
        }
        
        $this->setOutputV2(array(
            'Rojo'=>$sqlRojo,
            'Naranja'=>$sqlNaranja,
            'Amarillo'=>$sqlAmarillo,
            'Verde'=>$sqlVerde,
            'Azul'=>$sqlAzul,
        ));
    }
    public function __AjaxTriageClasificacion($data) {
        $inputFecha=$data['inputFecha'];
        $inputHora1=$data['inputHora1'];
        $inputHora2=$data['inputHora2'];
        $inputColor=$data['inputColor'];
        return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='$inputColor' AND
                                                            ing.ingreso_date_medico='$inputFecha' AND
                                                            ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
    }
    public function __AjaxTriageClasificacionNoche($data) {
        $inputFecha=$data['inputFecha'];
        $inputColor=$data['inputColor'];
        return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE 
                                                            ing.ingreso_clasificacion='$inputColor' AND
                                                            ing.ingreso_date_medico=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND
                                                            ing.ingreso_time_medico BETWEEN '00:00' AND '06:59:59'"));
    }
    public function GraficasTriage() {
        $this->load->view('Triage/IndicadorTipos');
    }
    public function AjaxIndicadorTriageClasificacion_() {
        $ColorClasificacion= $this->input->get_post('Color');
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputTurno= $this->input->get_post('inputTurno');
        $inputFiltro= $this->input->get_post('inputFiltro');
        $Esponetaneo= $this->_Espontaneo($ColorClasificacion, $inputFechaI, $inputFechaF, 'Si',$inputTurno,$inputFiltro);
        $Referido= $this->_Espontaneo($ColorClasificacion, $inputFechaI, $inputFechaF, 'No',$inputTurno,$inputFiltro);
        $Hombres= $this->_Sexo($ColorClasificacion, $inputFechaI, $inputFechaF, 'HOMBRE',$inputTurno,$inputFiltro);
        $Mujeres= $this->_Sexo($ColorClasificacion, $inputFechaI, $inputFechaF, 'MUJER',$inputTurno,$inputFiltro);
        $this->setOutput(array(
            'Espontaneo'=>$Esponetaneo,
            'Referido'=>$Referido,
            'Hombres'=>$Hombres,
            'Mujeres'=>$Mujeres
        ));
    }
    public function _Espontaneo($ColorClasificacion,$inputInicio,$inputFin,$Tipo,$Turno,$Filtro) {
        if($Filtro=='Fechas'){
            return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing
                                    INNER JOIN sigh_pacientes_info_ing pi 
                                    ON (
                                                    ing.ingreso_id=pi.ingreso_id AND 
                                                    ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pi.info_procedencia_esp='$Tipo' AND
                                                    ing.ingreso_date_medico BETWEEN '$inputInicio' AND '$inputFin'

                                    ) "));
        }else{
            if($Turno=='Mañana'){
                $inputHora1='07:00';
                $inputHora2='13:59';
            }if($Turno=='Tarde'){
                $inputHora1='14:00';
                $inputHora2='20:59';
            }if($Turno=='Noche'){
                $inputHora1='21:00';
                $inputHora2='23:59';
            }
            if($Turno=='Noche'){
                return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing
                                    INNER JOIN sigh_pacientes_info_ing pi 
                                    ON (
                                                    ing.ingreso_id=pi.ingreso_id AND 
                                                    ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pi.info_procedencia_esp='$Tipo' AND
                                                    ing.ingreso_date_medico='$inputInicio' AND
                                                    ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'

                                    ) "))+count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing
                                    INNER JOIN sigh_pacientes_info_ing pi 
                                    ON (
                                                    ing.ingreso_id=pi.ingreso_id AND 
                                                    ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pi.info_procedencia_esp='$Tipo' AND
                                                    ing.ingreso_date_medico=DATE_ADD('$inputInicio',INTERVAL 1 DAY) AND
                                                    ing.ingreso_time_medico BETWEEN '00:00' AND '06:59'

                                    ) "));
            }else{
                return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing
                                    INNER JOIN sigh_pacientes_info_ing pi 
                                    ON (
                                                    ing.ingreso_id=pi.ingreso_id AND 
                                                    ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pi.info_procedencia_esp='$Tipo' AND
                                                    ing.ingreso_date_medico='$inputInicio' AND
                                                    ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'

                                    ) "));
            }
            
        }
        
    }
    public function _Sexo($ColorClasificacion,$inputInicio,$inputFin,$Sexo,$Turno,$Filtro) {
        if($Filtro=='Fechas'){
            return count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing , sigh_pacientes AS pac WHERE
                                                    pac.paciente_id=ing.paciente_id AND  ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pac.paciente_sexo='$Sexo' AND ing.ingreso_date_medico BETWEEN '$inputInicio' AND '$inputFin'"));
        }else{
            if($Turno=='Mañana'){
                $inputHora1='07:00';
                $inputHora2='13:59';
            }if($Turno=='Tarde'){
                $inputHora1='14:00';
                $inputHora2='20:59';
            }if($Turno=='Noche'){
                $inputHora1='21:00';
                $inputHora2='23:59';
            }
            if($Turno=='Noche'){
                
                return  count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing , sigh_pacientes AS pac WHERE
                                                    pac.paciente_id=ing.paciente_id AND  ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pac.paciente_sexo='$Sexo' AND ing.ingreso_date_medico='$inputInicio' AND
                                                    ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"))+
                        count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing , sigh_pacientes AS pac WHERE
                                                    pac.paciente_id=ing.paciente_id AND  ing.ingreso_clasificacion='$ColorClasificacion',INTERVAL 1 DAY) AND
                                                    pac.paciente_sexo='$Sexo' AND ing.ingreso_date_medico=DATE_ADD('$inputInicio' AND
                                                    ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
            }else{
                return  count($this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing , sigh_pacientes AS pac WHERE
                                                    pac.paciente_id=ing.paciente_id AND  ing.ingreso_clasificacion='$ColorClasificacion' AND
                                                    pac.paciente_sexo='$Sexo' AND ing.ingreso_date_medico='$inputInicio' AND
                                                    ing.ingreso_time_medico BETWEEN '$inputHora1' AND '$inputHora2'"));
            }
        }
        
    }
    public function IndicadorTriage() {
        $acceso_tipo=$_GET['tipo'];
        $acceso_fecha=$_GET['fecha'];
        $acceso_turno=$_GET['turno'];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT 
                                os_empleados.empleado_id,empleado_matricula, empleado_nombre, empleado_ap,empleado_am,
                                acceso_tipo, acceso_fecha, acceso_turno
                                FROM os_accesos, os_empleados WHERE 
					os_accesos.empleado_id=os_empleados.empleado_id AND
                                        os_accesos.acceso_tipo='$acceso_tipo' AND 
                                        os_accesos.acceso_fecha='$acceso_fecha' AND
                                        os_accesos.acceso_turno='$acceso_turno' GROUP BY os_empleados.empleado_id");
        $this->load->view('Graficas/IndicadorTriage_Empleados',$sql);
    }
    public function IndicadorTriagePacientes() {
        $acceso_tipo=$_GET['tipo'];
        $acceso_fecha=$_GET['fecha'];
        $acceso_turno=$_GET['turno'];
        $empleado_id=$_GET['empleado'];
        $sql['Empleado']= $this->config_mdl->sqlGetDataCondition('os_empleados',array(
            'empleado_id'=>$empleado_id
        ))[0];
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT 
                triage_nombre, triage_nombre_ap,triage_nombre_am,os_triage.triage_id
                FROM os_accesos, os_triage WHERE 
                    os_accesos.triage_id=os_triage.triage_id AND
                    os_accesos.empleado_id=$empleado_id AND
                    os_accesos.acceso_tipo='$acceso_tipo' AND 
                    os_accesos.acceso_fecha='$acceso_fecha' AND
                    os_accesos.acceso_turno='$acceso_turno'");
        $this->load->view('Graficas/IndicadorTriage_Pacientes',$sql);
    }
    /*INDICADORES CONSULTORIOS*/
    public function AjaxGraficasConsultorios() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputServicio=$this->input->get_post('inputServicio');
        $sql= $this->config_mdl->sqlQuery(" SELECT ce.ce_id FROM sigh_consultorios_especialidad AS ce
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                    es.especialidad_id=esc.especialidad_id AND
                                                    es.especialidad_id=$inputServicio AND 
                                                    ce.ce_fe BETWEEN '$inputFechaI' AND '$inputFechaF'
                                            )");
        $this->setOutput(array(
            'TotalServicio'=>count($sql)
        ));
    }
    public function AjaxGraficasConsultoriosTurnos() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputTurno=$this->input->get_post('inputTurno');
        $inputServicio=$this->input->get_post('inputServicio');
        if($inputTurno=='Noche'){
            $NocheA= count($this->config_mdl->sqlQuery(" SELECT ce.ce_id FROM sigh_consultorios_especialidad AS ce
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                    es.especialidad_id=esc.especialidad_id AND
                                                    es.especialidad_id=$inputServicio AND 
                                                    ce.ce_fe='$inputFechaI' AND
                                                    ce.ce_he BETWEEN '21:00' AND '23:59'
                                            )"));
            $NocheB= count($this->config_mdl->sqlQuery(" SELECT ce.ce_id FROM sigh_consultorios_especialidad AS ce
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                    es.especialidad_id=esc.especialidad_id AND
                                                    es.especialidad_id=$inputServicio AND 
                                                    ce.ce_fe=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                    ce.ce_he BETWEEN '00:00' AND '06:59'
                                            )"));
            $sql=$NocheA+$NocheB;
        }else{
            if($inputTurno=='Mañana'){
                $inputHora1='07:00';
                $inputHora2='13:59';
            }if($inputTurno=='Tarde'){
                $inputHora1='14:00';
                $inputHora2='20:59';
            }
            $sql= count($this->config_mdl->sqlQuery(" SELECT ce.ce_id FROM sigh_consultorios_especialidad AS ce
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                    es.especialidad_id=esc.especialidad_id AND
                                                    es.especialidad_id=$inputServicio AND 
                                                    ce.ce_fe='$inputFechaI' AND
                                                    ce.ce_he BETWEEN '$inputHora1' AND '$inputHora2'
                                            )"));
        }
        
        $this->setOutput(array(
            'TotalServicio'=>$sql
        ));
    }
    public function GraficasConsultorios() {
        $this->load->view('Consultorios/IndicadorDetalles');
    }
    public function AjaxGraficasConsultorios_ST7() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputServicio=$this->input->get_post('inputServicio');
        $inputFiltro=$this->input->get_post('inputFiltro');
        $inputTurno=$this->input->get_post('inputTurno');
        if($inputFiltro=='Fechas'){
            $sqlST7= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe BETWEEN '$inputFechaI' AND '$inputFechaF'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=ing.ingreso_id AND
                                                pac.info_lugar_accidente='TRABAJO')"));
            $sqlSinST7= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe BETWEEN '$inputFechaI' AND '$inputFechaF'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=tri.ingreso_id AND
                                                pac.info_lugar_accidente!='TRABAJO' AND pac.info_lugar_accidente!='')"));    
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
                $sqlST7NocheA= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe='$inputFechaI' AND 
                                                ce.ce_he BETWEEN '$inputHora1' AND '$inputHora2'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=tri.ingreso_id AND
                                                pac.info_lugar_accidente='TRABAJO')"));
                $sqlST7NocheB= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND 
                                                ce.ce_he BETWEEN '00:00' AND '06:59'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=ing.ingreso_id AND
                                                pac.ing_lugar_accidente='TRABAJO')"));
                $sqlSinST7NocheA= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe='$inputFechaI' AND 
                                                ce.ce_he BETWEEN '$inputHora1' AND '$inputHora2'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=ing.ingreso_id AND
                                                pac.info_lugar_accidente!='TRABAJO' AND pac.info_lugar_accidente!='')"));
                $sqlSinST7NocheB= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND 
                                                ce.ce_he BETWEEN '00:00' AND '06:59'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=ing.ingreso_id AND
                                                pac.info_lugar_accidente!='TRABAJO' AND pac.info_lugar_accidente!='')"));
                $sqlSinST7=$sqlSinST7NocheA+$sqlSinST7NocheB;
                $sqlST7=$sqlST7NocheA+$sqlST7NocheB;
            }else{
                $sqlST7= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe='$inputFechaI' AND 
                                                ce.ce_he BETWEEN '$inputHora1' AND '$inputHora2'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=ing.ingreso_id AND
                                                pac.info_lugar_accidente='TRABAJO')"));
                $sqlSinST7= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                            INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                            INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                            INNER JOIN sigh_especialidades es ON (
                                                es.especialidad_id=esc.especialidad_id AND
                                                es.especialidad_nombre='$inputServicio' AND 
                                                ce.ce_fe='$inputFechaI' AND 
                                                ce.ce_he BETWEEN '$inputHora1' AND '$inputHora2'
                                            )
                                            INNER JOIN sigh_pacientes_info_ing pac ON (
                                                pac.ingreso_id=ing.ingreso_id AND
                                                pac.info_lugar_accidente!='TRABAJO' AND pac.info_lugar_accidente!='')"));    
            }
        }
        
        $this->setOutput(array(
            'ConST7'=>$sqlST7,
            'SinST7'=>$sqlSinST7
        ));
    }
    public function AjaxGraficasConsultorios_Incapacidad(){
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputServicio=$this->input->get_post('inputServicio');
        $inputFiltro=$this->input->get_post('inputFiltro');
        $inputTurno=$this->input->get_post('inputTurno');
        if($inputFiltro=='Fechas'){
            $sqlConIncapacidad= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe BETWEEN '$inputFechaI' AND '$inputFechaF'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias!='')"));
            $sqlSinIncapacidad= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe BETWEEN '$inputFechaI' AND '$inputFechaF'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias<=>NULL)"));
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
                $sqlConIncapacidadNocheA= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe='$inputFechaI' AND
                                                        ce.ce_he BETWEEN '$inputHora1' AND '$inputHora1'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias!='')"));
                $sqlConIncapacidadNocheB= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                        ce.ce_he BETWEEN '00:00' AND '06:59'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias!='')"));
                $sqlSinIncapacidadNocheA= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe='$inputFechaI' AND
                                                        ce.ce_he BETWEEN '$inputHora1' AND '$inputHora1'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias<=>NULL)"));
                $sqlSinIncapacidadNocheB= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe=DATE_ADD('$inputFechaI', INTERVAL 1 DAY) AND
                                                        ce.ce_he BETWEEN '00:00' AND '06:59'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias<=>NULL)"));
                $sqlSinIncapacidad=$sqlSinIncapacidadNocheA+$sqlSinIncapacidadNocheB;
                $sqlConIncapacidad=$sqlConIncapacidadNocheA+$sqlConIncapacidadNocheB;
            }else{
                $sqlConIncapacidad= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe='$inputFechaI' AND
                                                        ce.ce_he BETWEEN '$inputHora1' AND '$inputHora1'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias!='')"));
                $sqlSinIncapacidad= count($this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_pacientes_ingresos AS ing 
                                                    INNER JOIN sigh_consultorios_especialidad ce ON ce.ingreso_id=ing.ingreso_id
                                                    INNER JOIN sigh_especialidades_consultorios esc ON esc.consultorio_nombre=ce.ce_asignado_consultorio 
                                                    INNER JOIN sigh_especialidades es ON (
                                                        es.especialidad_id=esc.especialidad_id AND
                                                        es.especialidad_nombre='$inputServicio' AND 
                                                        ce.ce_fe='$inputFechaI' AND
                                                        ce.ce_he BETWEEN '$inputHora1' AND '$inputHora1'
                                                    )
                                                    INNER JOIN sigh_hojafrontal hf ON (
                                                        ing.ingreso_id=hf.ingreso_id AND
                                                        hf.hf_incapacidad_dias<=>NULL)"));
            }
        }
        
        $this->setOutput(array(
            'ConIncapacidad'=>$sqlConIncapacidad,
            'SinIncapacidad'=>$sqlSinIncapacidad
        ));
    }
    public function AjaxIndicadorConsultorios() {
        $inputFilter= $this->input->post('inputFilter');
        $inputTurno= $this->input->post('inputTurno');
        $inputDateStart= $this->input->post('inputDateStart');
        $inputDateEnd= $this->input->post('inputDateEnd');
        
        
        $sqlConsultorios= $this->config_mdl->sqlGetDataCondition('sigh_especialidades_consultorios');
        $col='';
        foreach ($sqlConsultorios as $value) {
            if($inputFilter=='Fechas'){
                $sqlTotal= $this->config_mdl->sqlQuery("SELECT 
                                                            COUNT(ce.ce_id) AS total
                                                    FROM 
                                                            sigh_especialidades_consultorios AS cons,sigh_consultorios_especialidad AS ce, 
                                                            sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,sigh_empleados AS emp 
                                                    WHERE
                                                            emp.empleado_id=ce.ce_crea AND
                                                            ing.ingreso_id=ce.ingreso_id AND
                                                            ing.paciente_id=pac.paciente_id AND
                                                            ce.ce_asignado_consultorio=cons.consultorio_nombre AND
                                                            ce.ce_status='Salida' AND 
                                                            ce.ce_fs BETWEEN '$inputDateStart' AND '$inputDateEnd' AND
                                                            ce.ce_asignado_consultorio='".$value['consultorio_nombre']."'");
                $Total=$sqlTotal[0]['total'];
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
                    $sqlTotal1= $this->config_mdl->sqlQuery("SELECT 
                                                                COUNT(ce.ce_id) AS total
                                                            FROM 
                                                                    sigh_especialidades_consultorios AS cons,sigh_consultorios_especialidad AS ce, 
                                                                    sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,sigh_empleados AS emp
                                                            WHERE
                                                                    emp.empleado_id=ce.ce_crea AND
                                                                    ing.ingreso_id=ce.ingreso_id AND
                                                                    ing.paciente_id=pac.paciente_id AND
                                                                    ce.ce_asignado_consultorio=cons.consultorio_nombre AND
                                                                    ce.ce_status='Salida' AND
                                                                    ce.ce_fs='$inputDateStart' AND
                                                                    ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                    ce.ce_asignado_consultorio='".$value['consultorio_nombre']."'");
                    $sqlTotal2= $this->config_mdl->sqlQuery("SELECT 
                                                                COUNT(ce.ce_id) AS total
                                                            FROM 
                                                                    sigh_especialidades_consultorios AS cons,sigh_consultorios_especialidad AS ce, 
                                                                    sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,sigh_empleados AS emp 
                                                            WHERE
                                                                    emp.empleado_id=ce.ce_crea AND
                                                                    ing.ingreso_id=ce.ingreso_id AND
                                                                    ing.paciente_id=pac.paciente_id AND
                                                                    ce.ce_asignado_consultorio=cons.consultorio_nombre AND
                                                                    ce.ce_status='Salida' AND
                                                                    ce.ce_fs=DATE_ADD('$inputDateStart', INTERVAL 1 DAY) AND
                                                                    ce.ce_hs BETWEEN '00:00' AND '06:59' AND
                                                                    ce.ce_asignado_consultorio='".$value['consultorio_nombre']."'");
                    $Total=$sqlTotal1[0]['total']+$sqlTotal2[0]['total'];
                }else{
                    $sqlTotal= $this->config_mdl->sqlQuery("SELECT 
                                                                COUNT(ce.ce_id) AS total
                                                            FROM 
                                                                sigh_especialidades_consultorios AS cons,sigh_consultorios_especialidad AS ce, 
                                                                sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,sigh_empleados AS emp 
                                                            WHERE
                                                                    emp.empleado_id=ce.ce_crea AND
                                                                    ing.ingreso_id=ce.ingreso_id AND
                                                                    ing.paciente_id=pac.paciente_id AND
                                                                    ce.ce_asignado_consultorio=cons.consultorio_nombre AND
                                                                    ce.ce_status='Salida' AND
                                                                    ce.ce_fs='$inputDateStart' AND
                                                                    ce.ce_hs BETWEEN '$inputHora1' AND '$inputHora2' AND
                                                                    ce.ce_asignado_consultorio='".$value['consultorio_nombre']."'");
                    $Total=$sqlTotal[0]['total'];
                }
            }
            
            
            
            $col.=   '<a href="'. base_url().'Urgencias/Graficas/IndicadorConsultoriosDetalles?inputFilter='.$inputFilter.'&inputTurno='.$inputTurno.'&inputDateStart='.$inputDateStart.'&inputDateEnd='.$inputDateEnd.'&Servicio='.$value['consultorio_nombre'].'" target="_blank">
                        <div class="col-xs-4">
                            <h4 class="m-t-5 m-b-5 text-center semi-bold">'.$Total.' Pacientes</h4>
                            <hr class="hr-style-black m-t-5 m-b-5">
                            <h5 class="m-t-5 m-b-5 text-nowrap text-center"">'.$value['consultorio_nombre'].'</h5>
                        </div>
                    </a>';
            
            
        }
        $this->setOutput(array('cols'=>$col,'action'=>1));
        
    }
    public function IndicadorConsultoriosDetalles() {
        $inputFilter= $this->input->get_post('inputFilter');
        $inputTurno= $this->input->get_post('inputTurno');
        $inputDateStart= $this->input->get_post('inputDateStart');
        $inputDateEnd= $this->input->get_post('inputDateEnd');
        $inputServicio= $this->input->get_post('Servicio');
        if($inputFilter=='Fechas'){
            $sql['sql1']= $this->config_mdl->sqlQuery("SELECT 
                                                        ing.ingreso_id, ing.ingreso_date_medico, ing.ingreso_time_medico,ce.ce_fe, ce.ce_he,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn,
                                                        emp.empleado_id,emp.empleado_matricula, emp.empleado_nombre, emp.empleado_ap, emp.empleado_am
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
        $this->load->view('Consultorios/IndicadorDetalles',$sql);
    }
    
    
    public function AjaxIndicadorObservacion() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputFiltro=$this->input->get_post('inputFiltro');
        $inputTurno=$this->input->get_post('inputTurno');
        if($this->input->post('inputTipo')=='Ingreso'){
            $Attr1='observacion_fe';
            $Attr2='observacion_he';
        }else{
            $Attr1='observacion_fs';
            $Attr2='observacion_hs';
        }
        if($inputFiltro=='Fechas'){
            $sql= count($this->config_mdl->sqlQuery("SELECT obs.observacion_id FROM sigh_observacion AS obs
                                                WHERE 
                                                obs.$Attr1 BETWEEN '$inputFechaI' AND '$inputFechaF'")); 
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
                $sqlNocheA= count($this->config_mdl->sqlQuery("SELECT obs.observacion_id FROM sigh_observacion AS obs
                                                WHERE 
                                                obs.$Attr1='$inputFechaI' AND
                                                obs.$Attr2 BETWEEN '$inputHora1' AND '$inputHora2'"));
                $sqlNocheB= count($this->config_mdl->sqlQuery("SELECT obs.observacion_id FROM sigh_observacion AS obs
                                                WHERE 
                                                obs.$Attr1=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                obs.$Attr2 BETWEEN '00:00' AND '06:59'"));
                $sql=$sqlNocheA+$sqlNocheB;
            }else{
                $sql= count($this->config_mdl->sqlQuery("SELECT obs.observacion_id FROM sigh_observacion AS obs
                                                WHERE 
                                                obs.$Attr1='$inputFechaI' AND
                                                obs.$Attr2 BETWEEN '$inputHora1' AND '$inputHora2'"));
            }
        }
        $this->setOutput(array(
            'TotalIndicador'=>$sql
        ));
        
    }
    public function AjaxIndicadorPisos() {
        $inputFechaI=$this->input->get_post('inputFechaI');
        $inputFechaF=$this->input->get_post('inputFechaF');
        $inputFiltro=$this->input->get_post('inputFiltro');
        $inputTurno=$this->input->get_post('inputTurno');
        if($this->input->post('inputTipo')=='Ingreso'){
            $Attr1='ap_f_ingreso';
            $Attr2='ap_h_ingreso';
        }else{
            $Attr1='ap_f_salida';
            $Attr2='ap_h_salida';
        }
        if($inputFiltro=='Fechas'){
            $sql= count($this->config_mdl->sqlQuery("SELECT pisos.ap_id FROM os_areas_pacientes AS pisos
                                                    WHERE 
                                                    pisos.$Attr1 BETWEEN '$inputFechaI' AND '$inputFechaF'")); 
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
                $sqlNocheA= count($this->config_mdl->sqlQuery("SELECT pisos.ap_id FROM os_areas_pacientes AS pisos
                                                    WHERE 
                                                    pisos.$Attr1='$inputFechaI' AND
                                                    pisos.$Attr2 BETWEEN '$inputHora1' AND '$inputHora2'")); 
                $sqlNocheB= count($this->config_mdl->sqlQuery("SELECT pisos.ap_id FROM os_areas_pacientes AS pisos
                                                    WHERE 
                                                    pisos.$Attr1=DATE_ADD('$inputFechaI',INTERVAL 1 DAY) AND
                                                    pisos.$Attr2 BETWEEN '00:00' AND '06:59'")); 
                $sql=$sqlNocheA+$sqlNocheB;
            }else{
                $sql= count($this->config_mdl->sqlQuery("SELECT pisos.ap_id FROM os_areas_pacientes AS pisos
                                                    WHERE 
                                                    pisos.$Attr1='$inputFechaI' AND
                                                    pisos.$Attr2 BETWEEN '$inputHora1' AND '$inputHora2'")); 
            }
        }
        $this->setOutput(array(
            'TotalIndicador'=>$sql
        ));
    }
    public function AnalisisDeIngresos() {
        $this->load->view('Triage/AnalisisIngresos');
    }
    public function AjaxAnalisisDeIngresos() {
        $inputFecha= $this->input->post('inputFecha');
        $inputTipo= $this->input->post('inputTipo');
        if($inputTipo=='Enfermera'){
            $attr_date="ingreso_date_enfermera";
            $attr_time="ingreso_time_enfermera";
        }else{
            $attr_date="ingreso_date_medico";
            $attr_time="ingreso_time_medico";
        }
        
        $sql0=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '00:00' AND '00:59'"));
        $sql1=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '01:00' AND '01:59'"));
        $sql2=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '02:00' AND '02:59'"));
        $sql3=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '03:00' AND '03:59'"));
        $sql4=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '04:00' AND '04:59'"));
        $sql5=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '05:00' AND '05:59'"));
        $sql6=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '06:00' AND '06:59'"));
        $sql7=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '07:00' AND '07:59'"));
        $sql8=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '08:00' AND '08:59'"));
        $sql9=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '09:00' AND '09:59'"));
        $sql10=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '10:00' AND '10:59'"));
        $sql11=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '11:00' AND '11:59'"));
        $sql12=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '12:00' AND '12:59'"));
        $sql13=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '13:00' AND '13:59'"));
        $sql14=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '14:00' AND '14:59'"));
        $sql15=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '15:00' AND '15:59'"));
        $sql16=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '16:00' AND '16:59'"));
        $sql17=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '17:00' AND '17:59'"));
        $sql18=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '18:00' AND '18:59'"));
        $sql19=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '19:00' AND '19:59'"));
        $sql20=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '20:00' AND '20:59'"));
        $sql21=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '21:00' AND '21:59'"));
        $sql22=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '22:00' AND '22:59'"));
        $sql23=count( $this->config_mdl->sqlQuery("SELECT ing.ingreso_id FROM sigh_pacientes_ingresos AS ing WHERE ing.$attr_date='$inputFecha' AND ing.$attr_time BETWEEN '23:00' AND '23:59'"));
        $this->setOutput(array(
            'sql0'=>$sql0,
            'sql1'=>$sql1,
            'sql2'=>$sql2,
            'sql3'=>$sql3,
            'sql4'=>$sql4,
            'sql5'=>$sql5,
            'sql6'=>$sql6,
            'sql7'=>$sql7,
            'sql8'=>$sql8,
            'sql9'=>$sql9,
            'sql10'=>$sql10,
            'sql11'=>$sql11,
            'sql12'=>$sql12,
            'sql13'=>$sql13,
            'sql14'=>$sql14,
            'sql15'=>$sql15,
            'sql16'=>$sql16,
            'sql17'=>$sql17,
            'sql18'=>$sql18,
            'sql19'=>$sql19,
            'sql20'=>$sql20,
            'sql21'=>$sql21,
            'sql22'=>$sql22,
            'sql23'=>$sql23,
        ));
    }
}
