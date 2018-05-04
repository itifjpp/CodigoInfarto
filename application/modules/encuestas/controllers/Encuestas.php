<?php

/**
 * Description of Ensat
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Encuestas extends Config{
    public function index() {
        $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_encuestas');
        $this->load->view('Registros/Encuestas',$sql);
    }
    public function Encuesta() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_encuestas',array(
            'encuesta_id'=> $_GET['encuesta']
        ))[0];
        $sql['Equipos']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales_equipos',array(
            'hospital_id'=> $this->sigh->getInfo('hospital_id')
        ));
        $this->load->view('Registros/Encuesta',$sql);
    }
    public function AjaxEncuesta() {
        $data=array(
            'encuesta_nombre'=> $this->input->post('encuesta_nombre'),
            'encuesta_area'=> $this->input->post('encuesta_area'),
            'encuesta_fecha'=> date('Y-m-d H:i'),
            'equipo_id'=> $this->input->post('equipo_id'),
            'encuesta_tipo'=> $this->input->post('encuesta_tipo'),
            'encuesta_para'=> $this->input->post('encuesta_para'),
            'encuesta_external'=> $this->input->post('encuesta_external'),
            'encuesta_estado'=> 'false'
        );
        if($this->input->post('encuesta_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_encuestas',$data);
        }else{
            unset($data['encuesta_fecha']);
            unset($data['encuesta_estado']);
            $this->config_mdl->sqlUpdate('sigh_encuestas',$data,array(
                'encuesta_id'=> $this->input->post('encuesta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxCambiarEstado() {
        $this->config_mdl->_update_data('sigh_encuestas',array(
            'encuesta_estado'=>$this->input->post('encuesta_estado')
        ),array(
            'encuesta_id'=> $this->input->post('encuesta_id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function AjaxEliminarEncuesta() {
        $this->config_mdl->_delete_data('sigh_encuestas',array(
            'encuesta_id'=>$this->input->post('id')
        ));
        $this->setOutput(array('accion'=>'1'));
    }
    public function ConfiguracionEncuesta() {
        $sql['Respuestas']= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_respuestas',array(
            'encuesta_id'=> $_GET['encuesta']
        ));
        $this->load->view('Registros/EncuestasConfiguracion',$sql);
    }
    public function EncuestasAreas() {
        $sql['AreasAcceso']= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_status'=>''
        ));
        $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT areas.areas_acceso_nombre, areas_enc.area_id, areas_enc.encuesta_id FROM sigh_encuestas AS enc, sigh_encuestas_areas AS areas_enc, sigh_areasacceso AS areas
                                                        WHERE areas_enc.encuesta_id=enc.encuesta_id AND areas_enc.area_id=areas.areas_acceso_id AND
                                                        enc.encuesta_id=".$_GET['enc']);
        $this->load->view('Registros/EncuestasAreas',$sql);
    }
    public function AjaxEncuestasAreas() {
        $data=array(
            'encuesta_id'=> $this->input->post('encuesta_id'),
            'area_id'=> $this->input->post('area_id')
        );
        
        if($this->input->post('action')=='add'){
            $check= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_areas',$data);
            if(empty($check)){
                $this->config_mdl->sqlInsert('sigh_encuestas_areas',$data);
                $this->setOutput(array('action'=>1));
            }else{
                $this->setOutput(array('action'=>2));
            }
        }else{
            $this->config_mdl->sqlDelete('sigh_encuestas_areas',$data);
            $this->setOutput(array('action'=>1));
        }
    }
    public function EncuestaRespuesta() {
        $sql['info']= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_respuestas',array(
            'respuesta_id'=> $_GET['respuesta']
        ))[0];
        $this->load->view('Registros/EncuestasRespuestas',$sql);
    }
    public function AjaxEncuestaRespuesta() {
        $data=array(
            'respuesta_nombre'=> $this->input->post('respuesta_nombre'),
            'respuesta_valor'=> $this->input->post('respuesta_valor'),
            'respuesta_icon'=> $this->input->post('respuesta_icon'),
            'encuesta_id'=> $this->input->post('encuesta_id')
        );
        if($this->input->post('respuesta_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_encuestas_respuestas',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_encuestas_respuestas',$data,array(
                'respuesta_id'=> $this->input->post('respuesta_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function EncuestaPreguntas() {
        $sql['Gestion']= $this->config_mdl->_query("SELECT * FROM sigh_encuestas, sigh_encuestas_preg WHERE
                                                    sigh_encuestas.encuesta_id=sigh_encuestas_preg.encuesta_id AND
                                                    sigh_encuestas.encuesta_id=".$_GET['enc']);
        $this->load->view('Registros/EncuestasPreguntas',$sql);
    }
    public function AjaxEncuestaPreguntas() {
        $data=array(
            'pregunta_nombre'=> $this->input->post('pregunta_nombre'),
            'pregunta_encabezado'=> $this->input->post('pregunta_encabezado'),
            'encuesta_id'=> $this->input->post('encuesta_id')
        ); 
        if($this->input->post('pregunta_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_encuestas_preg',$data);
            
            //AGREGAMOS LAS RESPUESTAS A LA DETERMINADA PREGUNTA
            $sqlLastId= $this->config_mdl->sqlGetLastId('sigh_encuestas_preg','pregunta_id');
            $sqlRespuestas= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_respuestas',array(
                'encuesta_id'=> $this->input->post('encuesta_id')
            ));
            foreach ($sqlRespuestas as $value) {
                $this->config_mdl->sqlInsert('sigh_encuestas_preg_res',array(
                    'respuesta_id'=>$value['respuesta_id'],
                    'pregunta_id'=> $sqlLastId
                ));
            }
        }else{
            $this->config_mdl->sqlUpdate('sigh_encuestas_preg',$data,array(
                'pregunta_id'=> $this->input->post('pregunta_id')
            ));
        }
        $this->setOutput(array('accion'=>'1'));
    }
    public function PreguntasRespuestas() {
        $sql['Gestion']= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_respuestas',array(
            'pregunta_id'=>$_GET['preg']
        ));
        $this->load->view('Registros/EncuestasPreguntasR',$sql);
    }
    public function AjaxPreguntasRespuestas() {
        $data=array(
            'respuesta_nombre'=> $this->input->post('respuesta_nombre'),
            'respuesta_valor'=> $this->input->post('respuesta_valor'),
            'respuesta_icon'=>'N/A',
            'pregunta_id'=> $this->input->post('pregunta_id'),
            'encuesta_id'=>0
        );
        if($this->input->post('respuesta_action')=='add'){
            $this->config_mdl->sqlInsert('sigh_encuestas_respuestas',$data);
        }else{
            $this->config_mdl->sqlUpdate('sigh_encuestas_respuestas',$data,array(
                'respuesta_id'=> $this->input->post('respuesta_id')
            ));
        }
        $this->setOutput(array('action'=>1));
    }
    public function ResponderEncuesta() {
        if(isset($_GET['enc'])){
            $sql['Encuesta'] = $this->config_mdl->sqlQuery("SELECT * FROM sigh_encuestas AS encuesta, sigh_hospitales_equipos AS equipo WHERE encuesta.encuesta_estado='true' AND encuesta.encuesta_id=".$_GET['enc']);
            $this->load->view('Evaluacion/ResponderEncuestaPersonal',$sql);
        }else{
            $sql['Encuesta'] = $this->config_mdl->sqlQuery("SELECT * FROM sigh_encuestas AS encuesta, sigh_hospitales_equipos AS equipo WHERE
            encuesta.equipo_id=equipo.equipo_id AND encuesta.encuesta_estado='true' AND equipo.equipo_ip='".$this->sigh->getEquipoIp()."'");
            $this->load->view('Evaluacion/ResponderEncuesta',$sql);
        }
        
        
    }

    public function AjaxResultadoEncuestas() {
        $this->config_mdl->sqlInsert('sigh_encuestas_usuarios',array(
            'eu_fecha'=> date('Y-m-d'),
            'eu_hora'=> date('H:i:s'),
            'eu_turno'=>$this->ObtenerTurno(),
            'eu_ip'=>$_SERVER['REMOTE_ADDR'],
            'empleado_id'=> $this->input->post('empleado_id'),
            'encuesta_id'=> $this->input->post('encuesta_id')
        ));
        $sqlLastId= $this->config_mdl->sqlGetLastId('sigh_encuestas_usuarios','eu_id');
        foreach ($this->input->post('EnsatRespuestas') as $value) {
            $this->config_mdl->sqlInsert('sigh_encuestas_usuarios_res',array(
                'resultado_fecha'=> date('Y-m-d'),
                'resultado_hora'=> date('H:i:s'),
                'resultado_turno'=> $this->ObtenerTurno(),
                'respuesta_id'=> $value['respuesta_id'],
                'pregunta_id'=> $value['pregunta_id'],
                'encuesta_id'=> $value['encuesta_id'],
                'eu_id'=>$sqlLastId
            ));      
        }
        $this->setOutputV2(array(
            'acion'=>'1',
        ));
    }
    public function actualizar() {
        $sql= $this->config_mdl->sqlQuery("SELECT * FROM sigh_encuestas_usuarios as us, sigh_encuestas_usuarios_res AS res WHERE us.eu_id=res.eu_id GROUP BY us.eu_id");
        foreach ($sql as $value) {
            $this->config_mdl->sqlUpdate('sigh_encuestas_usuarios',array(
                'eu_fecha'=>$value['resultado_fecha'],
                'eu_hora'=>$value['resultado_hora'],
                'eu_turno'=>$value['resultado_turno'],
                'eu_ip'=>'Manual',
                'encuesta_id'=>$value['encuesta_id']
            ),array(
                'eu_id'=>$value['eu_id']
            ));
        }
    }
    public function Resultados() {
        if(!isset($_GET['tipo'])){
            $sql['Gestion']= $this->config_mdl->sqlGetData('sigh_encuestas');
        }else{
            $sql['Gestion']= $this->config_mdl->sqlQuery("SELECT * FROM sigh_encuestas, sigh_encuestas_preg WHERE sigh_encuestas.encuesta_id=sigh_encuestas_preg.encuesta_id
                                                                    AND sigh_encuestas.encuesta_id=".$_GET['enc']);
        }
        $this->load->view('Resultados/index',$sql);
    }
    public function PreguntasGraficas() {
        $sql['pregunta']= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_preg',array(
            'pregunta_id'=>$_GET['preg']
        ))[0];
        $sql['Respuestas']= $this->config_mdl->sqlGetDataCondition('sigh_encuesta_res',array(
            'pregunta_id'=>$_GET['preg']
        ));
        $this->load->view('Resultados/Graficas',$sql);
    }
    public function AjaxResultadosEncuestas() {
        $obtenterTurno= $this->ObtenerTurno();
        $Hoy = date('Y-m-d');
        $Ayer = strtotime ( '-1 day' , strtotime ( $Hoy ) ) ;
        $Ayer = date ( 'Y-m-d' , $Ayer );
        $sqlEncuesta= $this->config_mdl->sqlGetDataCondition("sigh_encuestas",array(
            'encuesta_estado'=>'true',
            //'encuesta_tipo'=>'SATISFACCIÓN'
        ));
        $hide_row='false';
        foreach ($sqlEncuesta as $enc) {
            $sqlArea= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
                'areas_acceso_nombre'=> $this->UMAE_AREA
            ))[0];
            $sqlCheck= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_areas',array(
                'encuesta_id'=>$enc['encuesta_id'],
                'area_id'=>$sqlArea['areas_acceso_id']
            ));
            if(!empty($sqlCheck)){
                $row.='<div class="row m-b-10">';
                    $row.='<div class="col-md-12" style="padding-left:0px">';
                        $row.='<h5 class="text-uppercase" style="display:inline-block;border-bottom:2px solid '.$this->sigh->getInfo('hospital_back_primary').'"><i class="fa fa-pencil-square-o sigh-color"></i> '.$enc['encuesta_nombre'].' - '.$enc['encuesta_area'].'</h5>';
                    $row.='</div>';
                $sqlPreguntas= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_preg',array(
                   'encuesta_id'=>$enc['encuesta_id'] 
                ));
                $TotalGlobal=0;

                foreach ($sqlPreguntas as $preg) {
                    if($obtenterTurno=='Noche A' || $obtenterTurno=='Noche B'){
                        $sqlTotal=count($this->config_mdl->sqlQuery("SELECT users_res.respuesta_id AS total FROM 
                                        sigh_encuestas_respuestas AS encuesta_res, 
                                        sigh_encuestas_preg AS preg,
                                        sigh_encuestas_preg_res AS preg_res, 
                                        sigh_encuestas_usuarios AS users, 
                                        sigh_encuestas_usuarios_res AS users_res
                                        WHERE
                                        encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                        preg.pregunta_id=preg_res.pregunta_id AND
                                        users_res.eu_id=users.eu_id AND
                                        users_res.respuesta_id=encuesta_res.respuesta_id AND
                                        users_res.pregunta_id=preg.pregunta_id AND
                                        users.eu_fecha='$Ayer' AND users.eu_turno='Noche A' AND users_res.pregunta_id=".$preg['pregunta_id']))+
                                count($this->config_mdl->sqlQuery("SELECT users_res.respuesta_id AS total FROM 
                                        sigh_encuestas_respuestas AS encuesta_res, 
                                        sigh_encuestas_preg AS preg,
                                        sigh_encuestas_preg_res AS preg_res, 
                                        sigh_encuestas_usuarios AS users, 
                                        sigh_encuestas_usuarios_res AS users_res
                                        WHERE
                                        encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                        preg.pregunta_id=preg_res.pregunta_id AND
                                        users_res.eu_id=users.eu_id AND
                                        users_res.respuesta_id=encuesta_res.respuesta_id AND
                                        users_res.pregunta_id=preg.pregunta_id AND
                                        users.eu_fecha=DATE_ADD('$Ayer', INTERVAL 1 DAY) AND users.eu_turno='Noche B' AND users_res.pregunta_id=".$preg['pregunta_id']));

                        $sqlResult=$this->config_mdl->sqlQuery("SELECT SUM(encuesta_res.respuesta_valor) AS total FROM 
                                        sigh_encuestas_respuestas AS encuesta_res, 
                                        sigh_encuestas_preg AS preg,
                                        sigh_encuestas_preg_res AS preg_res, 
                                        sigh_encuestas_usuarios AS users, 
                                        sigh_encuestas_usuarios_res AS users_res
                                        WHERE
                                        encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                        preg.pregunta_id=preg_res.pregunta_id AND
                                        users_res.eu_id=users.eu_id AND
                                        users_res.respuesta_id=encuesta_res.respuesta_id AND
                                        users_res.pregunta_id=preg.pregunta_id AND
                                        users.eu_fecha='$Ayer' AND users.eu_turno='Noche A' AND users_res.pregunta_id=".$preg['pregunta_id'])[0]['total']+
                                $this->config_mdl->sqlQuery("SELECT SUM(encuesta_res.respuesta_valor) AS total FROM 
                                        sigh_encuestas_respuestas AS encuesta_res, 
                                        sigh_encuestas_preg AS preg,
                                        sigh_encuestas_preg_res AS preg_res, 
                                        sigh_encuestas_usuarios AS users, 
                                        sigh_encuestas_usuarios_res AS users_res
                                        WHERE
                                        encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                        preg.pregunta_id=preg_res.pregunta_id AND
                                        users_res.eu_id=users.eu_id AND
                                        users_res.respuesta_id=encuesta_res.respuesta_id AND
                                        users_res.pregunta_id=preg.pregunta_id AND
                                        users.eu_fecha=DATE_ADD('$Ayer',INTERVAL 1 DAY) AND users.eu_turno='Noche B' AND users_res.pregunta_id=".$preg['pregunta_id'])[0]['total'];


                        $ResultFinal=$sqlResult/$sqlTotal*10;
                    }else{
                        $sqlTotal=  count($this->config_mdl->sqlQuery("SELECT users_res.respuesta_id AS total FROM 
                                        sigh_encuestas_respuestas AS encuesta_res, 
                                        sigh_encuestas_preg AS preg,
                                        sigh_encuestas_preg_res AS preg_res, 
                                        sigh_encuestas_usuarios AS users, 
                                        sigh_encuestas_usuarios_res AS users_res
                                        WHERE
                                        encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                        preg.pregunta_id=preg_res.pregunta_id AND
                                        users_res.eu_id=users.eu_id AND
                                        users_res.respuesta_id=encuesta_res.respuesta_id AND
                                        users_res.pregunta_id=preg.pregunta_id AND
                                        users.eu_fecha='$Ayer' AND users.eu_turno='Mañana' AND users_res.pregunta_id=".$preg['pregunta_id']));
                        $sqlResult=$this->config_mdl->sqlQuery("SELECT SUM(encuesta_res.respuesta_valor) AS total FROM 
                                        sigh_encuestas_respuestas AS encuesta_res, 
                                        sigh_encuestas_preg AS preg,
                                        sigh_encuestas_preg_res AS preg_res, 
                                        sigh_encuestas_usuarios AS users, 
                                        sigh_encuestas_usuarios_res AS users_res
                                        WHERE
                                        encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                        preg.pregunta_id=preg_res.pregunta_id AND
                                        users_res.eu_id=users.eu_id AND
                                        users_res.respuesta_id=encuesta_res.respuesta_id AND
                                        users_res.pregunta_id=preg.pregunta_id AND
                                        users.eu_fecha='$Ayer' AND users.eu_turno='Mañana' AND users_res.pregunta_id=".$preg['pregunta_id']);
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
                    $row.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
                                        <h6 class="text-center m-t-5 m-b-5 text-nowrap-user" style="height:10px!important">'.$preg['pregunta_encabezado'].'</h6>
                                        <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'. round($ResultFinal, 1).'%</strong></h1>
                                    </div>';
                }
                $row.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
                                        <h6 class="text-center m-t-5 m-b-5 text-nowrap-user" style="height:10px!important">CALIFICACIÓN GLOBAL ENCUESTA</h6>
                                        <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'.(round($TotalGlobal/ count($sqlPreguntas),1)).'%</strong></h1>
                                    </div>'; 

                $row.='</div>';
            }else{
                //$hide_row='true';
            }
        }
        if(empty($sqlEncuesta)){
            $hide_row='true';
            $row.='<div class="row m-t-10">';
                $row.='<div class="col-md-12">';
                    $row.='<h4 class="text-center" style="color:red">NO HAY ENCUESTAS QUE MOSTRAR PARA ESTA ÁREA</h4>';
                $row.='</div>';
            $row.='</div>';
        }
        $this->setOutput(array(
            'rows'=>$row,
            'EnsatTurno'=>$obtenterTurno,
            'EnsatFecha'=>$Ayer,
            'EnsatTotal'=>'',
            'hide_row'=>$hide_row
        ));
    }
    
    public function ResultadosEvaluacion() {
        $this->load->view('Resultados/ResultadosEvaluacion');
    }
    public function AjaxResultadosEnsatUrg() {
//        $inputTurno= $this->input->post('inputTurno');
//        $inputFecha = $this->input->post('inputFecha');
//        $sqlEncuesta= $this->config_mdl->sqlGetDataCondition("sigh_encuestas",array(
//            'encuesta_estado'=>'true'
//        ));
//        $col='';
//        foreach ($sqlEncuesta as $enc) {
//            $sqlPreguntas= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_preg',array(
//               'encuesta_id'=>$enc['encuesta_id'] 
//            ));
//            $TotalGlobal=0;
//            foreach ($sqlPreguntas as $preg) {
//                if($inputTurno=='Noche'){
//                    $sqlTotal= count($this->config_mdl->sqlQuery("SELECT result.resultado_id FROM sigh_encuestas_usuarios_res AS result WHERE 
//                        result.resultado_fecha='$inputFecha' AND result.resultado_turno='Noche A' AND 
//                        result.pregunta_id=".$preg['pregunta_id']))+count($this->config_mdl->sqlQuery("SELECT result.resultado_id FROM sigh_encuestas_usuarios_res AS result WHERE 
//                        result.resultado_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND result.resultado_turno='Noche B' AND 
//                        result.pregunta_id=".$preg['pregunta_id']));
//                    
//                    $sqlResult= $this->config_mdl->sqlQuery("SELECT SUM(res.respuesta_valor) AS total FROM sigh_encuestas_usuarios_res AS result, sigh_encuesta_res as res WHERE 
//                            result.resultado_fecha='$inputFecha' AND result.resultado_turno='Noche A' AND 
//                            result.respuesta_id=res.respuesta_id AND
//                            result.pregunta_id=".$preg['pregunta_id'])[0]['total']+$this->config_mdl->sqlQuery("SELECT SUM(res.respuesta_valor) AS total FROM sigh_encuestas_usuarios_res AS result, sigh_encuesta_res as res WHERE 
//                            result.resultado_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND result.resultado_turno='Noche B' AND 
//                            result.respuesta_id=res.respuesta_id AND
//                            result.pregunta_id=".$preg['pregunta_id'])[0]['total'];
//                    
//                    $ResultFinal=$sqlResult/$sqlTotal*10;
//                }else{
//                    
//                    $sqlTotal= count($this->config_mdl->sqlQuery("SELECT result.resultado_id FROM sigh_encuestas_usuarios_res AS result WHERE 
//                        result.resultado_fecha='$inputFecha' AND result.resultado_turno='$inputTurno' AND 
//                            result.pregunta_id=".$preg['pregunta_id']));
//                    $sqlResult= $this->config_mdl->sqlQuery("SELECT SUM(res.respuesta_valor) AS total FROM sigh_encuestas_usuarios_res AS result, sigh_encuesta_res as res WHERE 
//                            result.resultado_fecha='$inputFecha' AND result.resultado_turno='$inputTurno' AND 
//                            result.respuesta_id=res.respuesta_id AND
//                            result.pregunta_id=".$preg['pregunta_id']);
//                    $ResultFinal=$sqlResult[0]['total']/$sqlTotal*10;
//                }
//                if($ResultFinal<79.9){
//                    $Color='#B71C1C';
//                }else if($ResultFinal<89.9){
//                    $Color='#FDD835';
//                }else{
//                    $Color='#4CAF50';
//                }
//                $TotalGlobal=$TotalGlobal+$ResultFinal;
//                $col.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
//                                    <h6 class="text-center" style="margin-bottom: 0px"><strong>'.$preg['pregunta_encabezado'].'</strong></h6>
//                                    <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'. round($ResultFinal, 1).'%</strong></h1>
//                                </div>';
//            }
//            $col.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
//                                    <h6 class="text-center" style="margin-bottom: 0px"><strong>CALIFICACIÓN GLOBAL ENCUESTA</strong></h6>
//                                    <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'.(round($TotalGlobal/ count($sqlPreguntas),1)).'%</strong></h1>
//                                </div>'; 
//            
//        }
        $this->setOutput(array('cols'=>$col,'EnsatTurno'=>$inputTurno,'EnsatFecha'=>$inputFecha,'EnsatTotal'=>'Sin determinar'));
    }
    public function RealTime() {
        $this->load->view('EncuestasRealTime');
    }
    public function AjaxResultadosRealTime() {
        $inputTurno= $this->ObtenerTurno();
        $inputFecha = date('Y-m-d');
        $sqlEncuesta= $this->config_mdl->sqlGetDataCondition("sigh_encuestas",array(
            'encuesta_estado'=>'true'
        ));
        $row='';
        foreach ($sqlEncuesta as $enc) {
            $row.='<div class="row m-b-10">';
                $row.='<div class="col-md-12" style="padding-left:0px">';
                    $row.='<h5 class="text-uppercase" style="display:inline-block;border-bottom:2px solid '.$this->sigh->getInfo('hospital_back_primary').'"><i class="fa fa-pencil-square-o sigh-color"></i> '.$enc['encuesta_nombre'].' - '.$enc['encuesta_area'].'</h5>';
                $row.='</div>';
            $sqlPreguntas= $this->config_mdl->sqlGetDataCondition('sigh_encuestas_preg',array(
               'encuesta_id'=>$enc['encuesta_id'] 
            ));
            $TotalGlobal=0;
            foreach ($sqlPreguntas as $preg) {
                if($inputTurno=='Noche'){
                          $sqlTotal=count($this->config_mdl->sqlQuery("SELECT users_res.respuesta_id AS total FROM 
                                    sigh_encuestas_respuestas AS encuesta_res, 
                                    sigh_encuestas_preg AS preg,
                                    sigh_encuestas_preg_res AS preg_res, 
                                    sigh_encuestas_usuarios AS users, 
                                    sigh_encuestas_usuarios_res AS users_res
                                    WHERE
                                    encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                    preg.pregunta_id=preg_res.pregunta_id AND
                                    users_res.eu_id=users.eu_id AND
                                    users_res.respuesta_id=encuesta_res.respuesta_id AND
                                    users_res.pregunta_id=preg.pregunta_id AND
                                    users.eu_fecha='$inputFecha' AND users.eu_turno='Noche A' AND users_res.pregunta_id=".$preg['pregunta_id']))+
                            count($this->config_mdl->sqlQuery("SELECT users_res.respuesta_id AS total FROM 
                                    sigh_encuestas_respuestas AS encuesta_res, 
                                    sigh_encuestas_preg AS preg,
                                    sigh_encuestas_preg_res AS preg_res, 
                                    sigh_encuestas_usuarios AS users, 
                                    sigh_encuestas_usuarios_res AS users_res
                                    WHERE
                                    encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                    preg.pregunta_id=preg_res.pregunta_id AND
                                    users_res.eu_id=users.eu_id AND
                                    users_res.respuesta_id=encuesta_res.respuesta_id AND
                                    users_res.pregunta_id=preg.pregunta_id AND
                                    users.eu_fecha=DATE_ADD('$inputFecha', INTERVAL 1 DAY) AND users.eu_turno='Noche B' AND users_res.pregunta_id=".$preg['pregunta_id']));
                    
                    $sqlResult=$this->config_mdl->sqlQuery("SELECT SUM(encuesta_res.respuesta_valor) AS total FROM 
                                    sigh_encuestas_respuestas AS encuesta_res, 
                                    sigh_encuestas_preg AS preg,
                                    sigh_encuestas_preg_res AS preg_res, 
                                    sigh_encuestas_usuarios AS users, 
                                    sigh_encuestas_usuarios_res AS users_res
                                    WHERE
                                    encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                    preg.pregunta_id=preg_res.pregunta_id AND
                                    users_res.eu_id=users.eu_id AND
                                    users_res.respuesta_id=encuesta_res.respuesta_id AND
                                    users_res.pregunta_id=preg.pregunta_id AND
                                    users.eu_fecha='$inputFecha' AND users.eu_turno='Noche A' AND users_res.pregunta_id=".$preg['pregunta_id'])[0]['total']+
                            $this->config_mdl->sqlQuery("SELECT SUM(encuesta_res.respuesta_valor) AS total FROM 
                                    sigh_encuestas_respuestas AS encuesta_res, 
                                    sigh_encuestas_preg AS preg,
                                    sigh_encuestas_preg_res AS preg_res, 
                                    sigh_encuestas_usuarios AS users, 
                                    sigh_encuestas_usuarios_res AS users_res
                                    WHERE
                                    encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                    preg.pregunta_id=preg_res.pregunta_id AND
                                    users_res.eu_id=users.eu_id AND
                                    users_res.respuesta_id=encuesta_res.respuesta_id AND
                                    users_res.pregunta_id=preg.pregunta_id AND
                                    users.eu_fecha=DATE_ADD('$inputFecha',INTERVAL 1 DAY) AND users.eu_turno='Noche B' AND users_res.pregunta_id=".$preg['pregunta_id'])[0]['total'];
                    
                    
                    $ResultFinal=$sqlResult/$sqlTotal*10;
                }else{
                    
                    $sqlTotal=  count($this->config_mdl->sqlQuery("SELECT users_res.respuesta_id AS total FROM 
                                    sigh_encuestas_respuestas AS encuesta_res, 
                                    sigh_encuestas_preg AS preg,
                                    sigh_encuestas_preg_res AS preg_res, 
                                    sigh_encuestas_usuarios AS users, 
                                    sigh_encuestas_usuarios_res AS users_res
                                    WHERE
                                    encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                    preg.pregunta_id=preg_res.pregunta_id AND
                                    users_res.eu_id=users.eu_id AND
                                    users_res.respuesta_id=encuesta_res.respuesta_id AND
                                    users_res.pregunta_id=preg.pregunta_id AND
                                    users.eu_fecha='$inputFecha' AND users.eu_turno='$inputTurno' AND users_res.pregunta_id=".$preg['pregunta_id']));
                    
                    $sqlResult=$this->config_mdl->sqlQuery("SELECT SUM(encuesta_res.respuesta_valor) AS total FROM 
                                    sigh_encuestas_respuestas AS encuesta_res, 
                                    sigh_encuestas_preg AS preg,
                                    sigh_encuestas_preg_res AS preg_res, 
                                    sigh_encuestas_usuarios AS users, 
                                    sigh_encuestas_usuarios_res AS users_res
                                    WHERE
                                    encuesta_res.respuesta_id=preg_res.respuesta_id AND 
                                    preg.pregunta_id=preg_res.pregunta_id AND
                                    users_res.eu_id=users.eu_id AND
                                    users_res.respuesta_id=encuesta_res.respuesta_id AND
                                    users_res.pregunta_id=preg.pregunta_id AND
                                    users.eu_fecha='$inputFecha' AND users.eu_turno='$inputTurno' AND users_res.pregunta_id=".$preg['pregunta_id']);
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
                $row.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
                                    <h6 class="text-center text-nowrap-user" style="height:10px!important">'.$preg['pregunta_encabezado'].'</h6>
                                    <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'. round($ResultFinal, 1).'%</strong></h1>
                                </div>';
            }
            $row.='<div class="col-md-2" style="background: #EFEFEF;border-right: 2px solid white;border-left: 6px solid '.$Color.'" >
                                    <h6 class="text-center text-nowrap-user" style="height:10px!important">CALIFICACIÓN GLOBAL ENCUESTA</h6>
                                    <h1 class="text-center" style="color: '.$Color.';margin: 4px;font-size: 3.1em;"><strong>'.(round($TotalGlobal/ count($sqlPreguntas),1)).'%</strong></h1>
                                </div>'; 
            $row.='</div>';
            
        }
        $this->setOutput(array('rows'=>$row,'EnsatTurno'=>$inputTurno,'EnsatFecha'=>$inputFecha,'EnsatTotal'=>'NO APLICA'));
    }
}
