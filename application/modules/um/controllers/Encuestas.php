<?php

/**
 * Description of Encuestas
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Encuestas extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('um_encuestas');
        $this->load->view('Encuestas/Encuestas',$sql);
    }
    public function AjaxEncuesta() {
        $data=array(
            'encuesta_nombre'=> $this->input->post('encuesta_nombre'),
            'encuesta_estado'=> $this->input->post('encuesta_estado')
        );
        if($this->input->post('encuesta_accion')=='add'){
            $this->config_mdl->_insert('um_encuestas',$data);
        }else{
            $this->config_mdl->_update_data('um_encuestas',$data,array(
                'encuesta_id'=> $this->input->post('encuesta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function EncuestaPreguntas() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM um_encuestas, um_encuestas_preguntas WHERE
                                                    um_encuestas.encuesta_id=um_encuestas_preguntas.encuesta_id AND
                                                    um_encuestas.encuesta_id=".$_GET['enc']);
        $this->load->view('Encuestas/EncuestasPreguntas',$sql);
    }
    public function AjaxEncuestaPreguntas() {
        $data=array(
            'pregunta_nombre'=> $this->input->post('pregunta_nombre'),
            'encuesta_id'=> $this->input->post('encuesta_id')
        );
        if($this->input->post('pregunta_accion')=='add'){
            $this->config_mdl->_insert('um_encuestas_preguntas',$data);
        }else{
            $this->config_mdl->_update_data('um_encuestas_preguntas',$data,array(
                'pregunta_id'=> $this->input->post('pregunta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function EncuestaPreguntasRespuetas() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM 
                                                    um_encuestas_preguntas, um_encuestas_preguntas_respuestas WHERE
                                                    um_encuestas_preguntas.pregunta_id=um_encuestas_preguntas_respuestas.pregunta_id AND
                                                    um_encuestas_preguntas.pregunta_id=".$_GET['pregunta']);
        $this->load->view('Encuestas/EncuestasPreguntasRespuetas',$sql);
    }
    public function AjaxencuestaPreguntasRespuetas(){
        $data=array(
            'respuesta_nombre'=> $this->input->post('respuesta_nombre'),
            'respuesta_icon'=> $this->input->post('respuesta_icon'),
            'pregunta_id'=> $this->input->post('pregunta_id')
        );
        if($this->input->post('respuesta_accion')=='add'){
            $this->config_mdl->_insert('um_encuestas_preguntas_respuestas',$data);
        }else{
            $this->config_mdl->_update_data('um_encuestas_preguntas_respuestas',$data,array(
                'respuesta_id'=> $this->input->post('respuesta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarPreguntas() {
        $this->config_mdl->_delete_data('um_encuestas_preguntas',array(
            'pregunta_id'=> $this->input->post('pregunta_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarRespuestas() {
        $this->config_mdl->_delete_data('um_encuestas_preguntas_respuestas',array(
            'respuesta_id'=> $this->input->post('respuesta_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    /**/
    public function AjaxVerificarEncuestas() {
            $Evaluacion='';
            $Encuesta= $this->config_mdl->sqlGetDataCondition('um_encuestas',array(
                'encuesta_estado'=>'true'
            ));
            $Preguntas= $this->config_mdl->sqlGetDataCondition('um_encuestas_preguntas',array(
                'encuesta_id'=>$Encuesta[0]['encuesta_id']
            ));
            $Num=0;
            foreach ($Preguntas as $preg) {
                $Num++;
                $Evaluacion.='<div class="col-md-12 col_pregunta'.$preg['pregunta_id'].'">';
                    $Evaluacion.='<div class="form-group">
                                    <label class="mayus-bold" style="font-size: 13px">'.$Num.'.- '.$preg['pregunta_nombre'].'</label>';
                        $Evaluacion.='<div class="row">';
                                        $sqlRespuestas= $this->config_mdl->sqlGetDataCondition('um_encuestas_preguntas_respuestas',array(
                                            'pregunta_id'=>$preg['pregunta_id']
                                        ));
                                        foreach ($sqlRespuestas as $resp) {
                                            $Evaluacion.='<div class="col-md-2 text-center pointer input-radio-save" data-value="'.$Encuesta[0]['encuesta_id'].';'.$preg['pregunta_id'].';'.$resp['respuesta_id'].'">';
                                                $Evaluacion.='<img src="'. base_url().'assets/img/emoji/'.$resp['respuesta_icon'].'"  style="width: 40px;height: 40px"><br>';
                                                $Evaluacion.='<h6 class="">'.$resp['respuesta_nombre'].'</h6>';
                                            $Evaluacion.='</div>';
                                        }
                            $Evaluacion.='</div>';
                    $Evaluacion.='</div>';
                $Evaluacion.='</div>';
            }
            $Evaluacion.='<input type="hidden" name="TotalPreguntas" value="'.count($Preguntas).'">';
            $Evaluacion.='<div class="col-md-12 hide">';
                $Evaluacion.='<input type="hidden" name="EncuestaId" value="'.$Encuesta[0]['encuesta_id'].'">';
            $Evaluacion.='</div>';
            $this->setOutput(array('accion'=>'1','Encuesta'=>$Evaluacion,'EncuestaNombre'=>$Encuesta[0]['encuesta_nombre']));  
    }
    public function AjaxResultadoEncuestas() {
        
        $this->setOutputV2($this->input->post());
    }
    public function AjaxFinalizarEncuesta() {
        $this->config_mdl->sqlInsert('um_encuestas_usuario',array(
            'eu_fecha'=> date('Y-m-d'),
            'eu_hora'=> date('H:i:s'),
            'eu_area'=> $this->UMAE_AREA,
            'eu_ip'=>$_SERVER['REMOTE_ADDR'],
            'encuesta_id'=> $this->input->post('encuesta_id'),
            'empleado_id'=> $this->UMAE_USER
        ));
        $sqlLastEU= $this->config_mdl->sqlGetLastId('um_encuestas_usuario','eu_id');
        foreach ($this->input->post('EncuestasRespondidas') as $value) {
            $this->config_mdl->sqlInsert('um_encuestas_resultados',array(
                'resultado_fecha'=> date('Y-m-d'),
                'resultado_hora'=> date('H:i:s'),
                'resultado_turno'=> $this->ObtenerTurno(),
                'respuesta_id'=> $value['respuesta_id'],
                'pregunta_id'=> $value['pregunta_id'],
                'encuesta_id'=> $value['encuesta_id'],
                'eu_id'=>$sqlLastEU,
                'empleado_id'=> $this->UMAE_USER,
            ));
        }
        $this->setOutput(array('accion'=>'1','post'=>$this->input->post('EncuestasRespondidas')));
    }
    public function Resultados() {
        if(!isset($_GET['tipo'])){
            $sql['Gestion']= $this->config_mdl->sqlGetData('um_encuestas');
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM um_encuestas, um_encuestas_preguntas WHERE um_encuestas.encuesta_id=um_encuestas_preguntas.encuesta_id
                                                                    AND um_encuestas.encuesta_id=".$_GET['enc']);
        }
        $this->load->view('Resultados/index',$sql);
    }
    public function PreguntasGraficas() {
        $sql['pregunta']= $this->config_mdl->sqlGetDataCondition('um_encuestas_preguntas',array(
            'pregunta_id'=>$_GET['preg']
        ))[0];
        $sql['Respuestas']= $this->config_mdl->sqlGetDataCondition('um_encuestas_preguntas_respuestas',array(
            'pregunta_id'=>$_GET['preg']
        ));
        $this->load->view('Resultados/Graficas',$sql);
    }
    public function AjaxEstadoEncuesta() {
        $this->config_mdl->sqlUpdate('um_encuestas',array(
            'encuesta_estado'=> $this->input->post('encuesta_estado')
        ),array(
            'encuesta_id'=> $this->input->post('encuesta_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function ResultadosEvaluacion() {
        $this->load->view('Encuestas/ResultadosEvaluacion');
    }
    public function AjaxResultadosUrg() {
        $inputTurno= $this->input->post('inputTurno');
        $inputFecha = $this->input->post('inputFecha');
        $sqlEncuesta= $this->config_mdl->sqlGetDataCondition("um_encuestas",array(
            'encuesta_estado'=>'true'
        ));
        $col='';
        foreach ($sqlEncuesta as $enc) {
            $sqlPreguntas= $this->config_mdl->sqlGetDataCondition('um_encuestas_preguntas',array(
               'encuesta_id'=>$enc['encuesta_id'] 
            ));
            $TotalGlobal=0;
            foreach ($sqlPreguntas as $preg) {
                if($inputTurno=='Noche'){
                    $sqlTotal= count($this->config_mdl->sqlQuery("SELECT result.resultado_id FROM um_encuestas_resultados AS result WHERE 
                        result.resultado_fecha='$inputFecha' AND result.resultado_turno='Noche A' AND 
                        result.pregunta_id=".$preg['pregunta_id']))+count($this->config_mdl->sqlQuery("SELECT result.resultado_id FROM um_encuestas_resultados AS result WHERE 
                        result.resultado_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND result.resultado_turno='Noche B' AND 
                        result.pregunta_id=".$preg['pregunta_id']));
                    
                    $sqlResult= $this->config_mdl->sqlQuery("SELECT SUM(res.respuesta_valor) AS total FROM um_encuestas_resultados AS result, um_encuestas_preguntas_respuestas as res WHERE 
                            result.resultado_fecha='$inputFecha' AND result.resultado_turno='Noche A' AND 
                            result.respuesta_id=res.respuesta_id AND
                            result.pregunta_id=".$preg['pregunta_id'])[0]['total']+$this->config_mdl->sqlQuery("SELECT SUM(res.respuesta_valor) AS total FROM um_encuestas_resultados AS result, um_encuestas_preguntas_respuestas as res WHERE 
                            result.resultado_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND result.resultado_turno='Noche B' AND 
                            result.respuesta_id=res.respuesta_id AND
                            result.pregunta_id=".$preg['pregunta_id'])[0]['total'];
                    
                    $ResultFinal=$sqlResult/$sqlTotal*10;
                }else{
                    
                    $sqlTotal= count($this->config_mdl->sqlQuery("SELECT result.resultado_id FROM um_encuestas_resultados AS result WHERE 
                        result.resultado_fecha='$inputFecha' AND result.resultado_turno='$inputTurno' AND 
                            result.pregunta_id=".$preg['pregunta_id']));
                    $sqlResult= $this->config_mdl->sqlQuery("SELECT SUM(res.respuesta_valor) AS total FROM um_encuestas_resultados AS result, um_encuestas_preguntas_respuestas as res WHERE 
                            result.resultado_fecha='$inputFecha' AND result.resultado_turno='$inputTurno' AND 
                            result.respuesta_id=res.respuesta_id AND
                            result.pregunta_id=".$preg['pregunta_id']);
                    $ResultFinal=$sqlResult[0]['total']/$sqlTotal*10;
                }
                if($ResultFinal<79.9){
                    $Color='#B71C1C';
                }else if($ResultFinal<89.9){
                    $Color='#FDD835';
                }else{
                    $Color='#4CAF50';
                }
                $TotalGlobal=$TotalGlobal+$ResultFinal;
                $col.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
                                    <h6 class="text-center" style="margin-bottom: 0px"><strong>'.$preg['pregunta_encabezado'].'</strong></h6>
                                    <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'. round($ResultFinal, 1).'%</strong></h1>
                                </div>';
            }
            $col.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
                                    <h6 class="text-center" style="margin-bottom: 0px"><strong>CALIFICACIÓN GLOBAL ENCUESTA</strong></h6>
                                    <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'.(round($TotalGlobal/ count($sqlPreguntas),1)).'%</strong></h1>
                                </div>'; 
            
        }
        $this->setOutput(array('cols'=>$col,'EncuestaTurno'=>$inputTurno,'EncuestaFecha'=>$inputFecha,'EncuestaTotal'=>'Sin determinar'));
    }
}
