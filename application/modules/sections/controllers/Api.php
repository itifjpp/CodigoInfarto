<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
class Api extends MX_Controller{
    private $BD_UM;
    public function __construct() {
        parent::__construct(); 
        $this->BD_UM = $this->load->database('default', TRUE); 
        date_default_timezone_set('America/Mexico_City');
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
    }
    public function TiempoTranscurrido($info) {
        $fecha1=  new DateTime($info['fecha1']);
        $fecha2=  new DateTime($info['fecha2']); 
        return $fecha1->diff($fecha2); 
    }
   
    public function PacientesPorSexo() {
        if(isset($_POST['fi']) || isset($_GET['fi'])){
            $FECHA_INICIO= $this->input->get_post('fi');
            $FECHA_FIN=$this->input->get_post('ff');
            
            $sqlHombres= $this->BD_UM->query("SELECT triage_id FROM os_triage WHERE os_triage.triage_paciente_sexo='HOMBRE' AND
                                                os_triage.triage_fecha BETWEEN '$FECHA_INICIO' AND '$FECHA_FIN' AND os_triage.triage_fecha!=''")->result_array();
            $sqlMujeres= $this->BD_UM->query("SELECT triage_id FROM os_triage WHERE os_triage.triage_paciente_sexo='MUJER' AND
                                                os_triage.triage_fecha BETWEEN '$FECHA_INICIO' AND '$FECHA_FIN' AND os_triage.triage_fecha!=''")->result_array(); 
            $this->setOutput(array(
                'TOTAL_PACIENTES_HOMBRES'=> count($sqlHombres),
                'TOTAL_PACIENTES_MUJERES'=> count($sqlMujeres),
                'TOTAL_ROJO'=> $this->ClasificacionPacientes('Rojo', $FECHA_INICIO, $FECHA_FIN),
                'TOTAL_NARANJA'=> $this->ClasificacionPacientes('Naranja', $FECHA_INICIO, $FECHA_FIN),
                'TOTAL_AMARILLO'=> $this->ClasificacionPacientes('Amarillo', $FECHA_INICIO, $FECHA_FIN),
                'TOTAL_VERDE'=> $this->ClasificacionPacientes('Verde', $FECHA_INICIO, $FECHA_FIN),
                'TOTAL_AZUL'=> $this->ClasificacionPacientes('Azul', $FECHA_INICIO, $FECHA_FIN),
                'TIEMPO_TRANSCURRIDO'=> $this->TiempoTranscurrido(array(
                    'fecha1'=>$FECHA_INICIO,
                    'fecha2'=>$FECHA_FIN
                ))
            ));
        }else{
            $this->setOutput(array(
                'ERROR AL PROCESAR LA PETICIÓN'
            ));
        }
    }
    public function ClasificacionPacientes($Color,$fi,$ff) {
        return $this->BD_UM
                ->query("SELECT COUNT(triage_id) AS TOTAL FROM os_triage WHERE os_triage.triage_fecha_clasifica!='' AND
                        os_triage.triage_color='$Color' AND os_triage.triage_fecha_clasifica BETWEEN '$fi' AND '$ff' ")
                ->result_array()[0]['TOTAL'];
    }
    public function setOutput($json) {
        $this->output->set_content_type('application/json')->set_output(json_encode($json,JSON_PRETTY_PRINT));
    }  

}
