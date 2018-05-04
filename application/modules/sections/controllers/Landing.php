<?php

/**
 * Description of Landing
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Landing extends Config{
    public function __construct() {
        parent::__construct();
        error_reporting(1);
    }

    public function index() {
        $this->load->view('Landing/index');
    }
    public function GraficaColor() {
        $this->load->view('Landing/Graficas');
    }
    public function PacientesPorSexo() {
        $FECHA_INICIO= $this->input->get_post('fi');
        $FECHA_FIN=$this->input->get_post('ff');
//        $sqlHombres= $this->config_mdl->sqlQuery("SELECT triage_id FROM os_triage WHERE os_triage.triage_paciente_sexo='HOMBRE' AND
//                                            os_triage.triage_fecha BETWEEN '$FECHA_INICIO' AND '$FECHA_FIN' AND os_triage.triage_fecha!=''");
//        $sqlMujeres= $this->config_mdl->sqlQuery("SELECT triage_id FROM os_triage WHERE os_triage.triage_paciente_sexo='MUJER' AND
//                                            os_triage.triage_fecha BETWEEN '$FECHA_INICIO' AND '$FECHA_FIN' AND os_triage.triage_fecha!=''"); 
        $this->setOutput(array(
            //'TOTAL_PACIENTES_HOMBRES'=> count($sqlHombres),
            //'TOTAL_PACIENTES_MUJERES'=> count($sqlMujeres),
            'TOTAL_ROJO'=> $this->ClasificacionPacientes('Rojo', $FECHA_INICIO, $FECHA_FIN),
            'TOTAL_NARANJA'=> $this->ClasificacionPacientes('Naranja', $FECHA_INICIO, $FECHA_FIN),
            'TOTAL_AMARILLO'=> $this->ClasificacionPacientes('Amarillo', $FECHA_INICIO, $FECHA_FIN),
            'TOTAL_VERDE'=> $this->ClasificacionPacientes('Verde', $FECHA_INICIO, $FECHA_FIN),
            'TOTAL_AZUL'=> $this->ClasificacionPacientes('Azul', $FECHA_INICIO, $FECHA_FIN), 
        ));
        
    }
    public function AjaxCalcularTiempoPromedio() {
        $FECHA_INICIO= $this->input->get_post('fi');
        $FECHA_FIN=$this->input->get_post('ff');
        $sql= $this->config_mdl->sqlQuery("SELECT t.triage_fecha_clasifica, t.triage_hora_clasifica FROM os_triage AS t WHERE t.triage_fecha_clasifica BETWEEN '$FECHA_INICIO' AND '$FECHA_FIN'");
        $TiempoPromedio=0;
        foreach ($sql as $value) {
            $tt= $this->TiempoTranscurrido(array(
                'fecha1'=>$value['triage_horacero_f'].' '.$value['triage_horacero_h'],
                'fecha1'=>$value['triage_fecha_clasifica'].' '.$value['triage_hora_clasifica']
            ));
            $tt_=$tt->h*60+$tt->i;
            $TiempoPromedio=$tt_+$TiempoPromedio;
        }
        $DEaDE=$this->TiempoTranscurrido(array(
                'fecha1'=>$FECHA_INICIO,
                'fecha2'=>$FECHA_FIN
            ));
        $this->setOutput(array(
            'TiempoPromedio'=>ceil($TiempoPromedio/count($sql)),
            'FechaDiferencia'=>$DEaDE->m.' Meses '.$DEaDE->d.' Días'
        ));
    }
    public function ClasificacionPacientes($Color,$fi,$ff) {
        return $this->config_mdl
                ->sqlQuery("SELECT COUNT(triage_id) AS TOTAL FROM os_triage WHERE os_triage.triage_fecha_clasifica!='' AND
                        os_triage.triage_color='$Color' AND os_triage.triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ")[0]['TOTAL'];
    }
    public function AjaxGraficaColor() {
        $ColorClasificacion= $this->input->get_post('Clasificacion');
        $inputInicio= $this->input->get_post('inputFi');
        $inputFin= $this->input->get_post('inputFf');
        $Esponetaneo= $this->Espontaneo($ColorClasificacion, $inputInicio, $inputFin, 'Si');
        $Referido= $this->Espontaneo($ColorClasificacion, $inputInicio, $inputFin, 'No');
        $Hombres= $this->Sexo($ColorClasificacion, $inputInicio, $inputFin, 'HOMBRE');
        $Mujeres= $this->Sexo($ColorClasificacion, $inputInicio, $inputFin, 'MUJER');
        $this->setOutput(array(
            'Espontaneo'=>$Esponetaneo,
            'Referido'=>$Referido,
            'Hombres'=>$Hombres,
            'Mujeres'=>$Mujeres
        ));
    }
    public function Espontaneo($ColorClasificacion,$inputInicio,$inputFin,$Tipo) {
        return count($this->config_mdl->sqlQuery("SELECT t.triage_id FROM os_triage AS t
                                    INNER JOIN paciente_info pi 
                                    ON (
                                                    t.triage_id=pi.triage_id AND 
                                                    t.triage_color='$ColorClasificacion' AND
                                                    pi.pia_procedencia_espontanea='$Tipo' AND
                                                    t.triage_fecha_clasifica BETWEEN '$inputInicio' AND '$inputFin'

                                    ) "));
    }
    public function Sexo($ColorClasificacion,$inputInicio,$inputFin,$Sexo) {
        return count($this->config_mdl->sqlQuery("SELECT t.triage_id FROM os_triage AS t
                                    INNER JOIN paciente_info pi 
                                    ON (
                                                    t.triage_id=pi.triage_id AND 
                                                    t.triage_color='$ColorClasificacion' AND
                                                    t.triage_paciente_sexo='$Sexo' AND
                                                    t.triage_fecha_clasifica BETWEEN '$inputInicio' AND '$inputFin'

                                    ) "));
    }
    public function TiempoTranscurrido($info) {
        $fecha1=  new DateTime($info['fecha1']);
        $fecha2=  new DateTime($info['fecha2']); 
        return $fecha1->diff($fecha2); 
    }
}
