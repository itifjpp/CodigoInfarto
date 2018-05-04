<?php
/**
 * Description of Listas
 *
 * @author felipe de jesus
 */
require_once APPPATH.'modules/config/controllers/Config.php';
class Listas extends Config{
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        date_default_timezone_set('America/Mexico_City');
    }
    public function rx() {
        $this->load->view('listas/listas_rx');
    }
    public function ce() {
        $this->load->view('listas/listas_ce');
    }
    public function AjaxPacientesEnConsultorios() {
        $sql_check=  $this->config_mdl->sqlQuery("SELECT ce.ce_id FROM sigh_consultorios_especialidad_llamada AS ce_ll,  sigh_pacientes_ingresos AS ing,sigh_consultorios_especialidad AS ce
                                                    WHERE ing.ingreso_id=ce.ingreso_id AND
                                                    ce.ce_id=ce_ll.ce_id_ce AND ce.ce_status='Asignado' ORDER BY ce.ce_id DESC LIMIT 10 ");
        
        if(!empty($sql_check)){
            
            $sql=  $this->config_mdl->sqlQuery("SELECT ce_ll.cel_id, ing.ingreso_id, pac.paciente_nombre, 
                pac.paciente_ap,pac.paciente_am, ce.ce_fe, ce.ce_he,ce.ce_asignado_consultorio, ing.ingreso_clasificacion,ce_artyom
                FROM sigh_pacientes_ingresos AS ing, sigh_consultorios_especialidad AS ce, sigh_consultorios_especialidad_llamada AS ce_ll,
                sigh_pacientes AS pac
                WHERE 
                pac.paciente_id=ing.paciente_id AND ce.ingreso_id=ing.ingreso_id AND
                ce_ll.ce_id_ce=ce.ce_id AND ce.ce_status='Asignado' AND ce_ll.cel_id=(SELECT MAX(ce_ll.cel_id) FROM
                sigh_consultorios_especialidad_llamada AS ce_ll, sigh_consultorios_especialidad AS ce WHERE
                ce_ll.ce_id_ce=ce.ce_id AND ce.ce_status='Asignado')  ORDER BY ce_ll.cel_id ASC")[0];
            //if(!empty($sql)){
            if($sql['ingreso_id']!=''){
                $TiempoMax=Modules::run('Config/CalcularTiempoTranscurrido',array(
                        'Tiempo1'=> date('Y-m-d H:i'),
                        'Tiempo2'=> $sql['ce_fe'].' '.$sql['ce_he']));
                if($TiempoMax->i<=3){
                    if($sql['paciente_nombre']!=''){
                        if($sql['ce_artyom']<=3){
                            $ArtyomPaciente=$sql['paciente_nombre'].' '.$sql['paciente_ap'].' '.$sql['paciente_am'].' FAVOR DE PASAR A '.$sql['ce_asignado_consultorio'];
                            
                        }else{
                            $ArtyomPaciente='';
                            $result='';
                        }
                        if($TiempoMax->i>0){
                                $MinMax=$TiempoMax->i.' Minutos';
                            }else{
                                $MinMax ='Un momento';
                            }
                            $this->config_mdl->sqlUpdate('sigh_consultorios_especialidad',array(
                                'ce_artyom'=>$sql['ce_artyom']+1
                            ),array(
                                'ingreso_id'=>$sql['ingreso_id']
                            ));
                            $result='<div class="col-xs-5 sigh-background-secundary" style="height:105px;position:relative;padding-left:40px">
                                        <div class="'.Modules::run('Config/ColorClasificacion',array('color'=>$sql['ingreso_clasificacion'])).'" style="position:absolute;width:33px;left:0px;height:105px;"></div>
                                        <h3 class="color-white m-t-10 text-center semi-bold" style="font-size:38px;line-height:1.2">'.$sql['ce_asignado_consultorio'].'</h3>
                                    </div>
                                    <div class="col-xs-7 sigh-background-secundary" style="height:105px;width:56.8%">
                                        <h3 class="color-white" style="line-height:1.2;font-weight: bold;font-size: 35px;text-transform: uppercase;margin-top:2px">'.$sql['paciente_nombre'].' '.$sql['paciente_ap'].' '.$sql['paciente_am'].'</h3>
                                        <h6 class="color-white no-margin" style="font-size:14px;position:absolute;bottom:2px;text-transform: uppercase">LLAMADO HACE: '.$MinMax.'</h6>
                                    </div>';
                            $existe='MAX_CE_LLAMADA:'.$sql['ingreso_id'];
                            
                    }else{
                        $ArtyomPaciente='';
                        $result='';
                    }
                }else{
                    $ArtyomPaciente='';
                    $result='';
                }
            }else{
                $result='';
                $existe='MAX_CE_LLAMADA:0';
            }
        }else{
            $result='';
            $existe='MAX_CE_LLAMADA:0';
        }
        $sql_ce=  $this->config_mdl->sqlQuery("SELECT ce_ll.cel_id, ing.ingreso_id, pac.paciente_nombre, 
                                    pac.paciente_ap,pac.paciente_am,pac.paciente_sexo, ce.ce_fe, ce.ce_he,ce.ce_asignado_consultorio, ing.ingreso_clasificacion
                                    FROM sigh_pacientes_ingresos AS ing, sigh_consultorios_especialidad AS ce, sigh_consultorios_especialidad_llamada AS ce_ll,
                                    sigh_pacientes AS pac WHERE 
                                    pac.paciente_id=ing.paciente_id AND ce.ingreso_id=ing.ingreso_id AND
                                    ce_ll.ce_id_ce=ce.ce_id AND ce.ce_status='Asignado'  ORDER BY ce_ll.cel_id DESC LIMIT 10");
        $TOTAL_LISTA= 0;
        foreach ($sql_ce as $value) {
            
            $ingreso=new DateTime($value['ce_fe'].' '.$value['ce_he']);  
            $hoy=new DateTime(date('Y-m-d H:i')); 
            $tiempo=$ingreso->diff($hoy);
            if($tiempo->i>0){
                $clock=$tiempo->i.' Minutos</h6>';
            }else{
                $clock='Un momento';
            }
            if($value['paciente_sexo']=='HOMBRE'){
                $ColorSexo='bg-blue';
            }else{
                $ColorSexo='bg-pink';
            }
            if($value['ingreso_clasificacion']!=''){
                $ColorClasificacion=Modules::run('Config/ColorClasificacion',array('color'=>$value['ingreso_clasificacion']));
            }else{
                $ColorClasificacion='sigh-background-primary';
            }
            if($tiempo->i<59 && $tiempo->h==0 && $tiempo->d==0){
                $TOTAL_LISTA++;
                $result_ce.='<div class="col-xs-6 "  >
                                <div class="row" style="padding:5px">
                                    <div class="col-xs-1 '.$ColorClasificacion.'" style="height:85px"></div>
                                    <div class="col-xs-4 sigh-background-primary" style="height:85px">
                                        <h4 class="color-white text-center semi-bold">'.$value['ce_asignado_consultorio'].'</h4>
                                        <h6 class="color-white" style="font-size:12px;position:absolute;bottom: -8px;"><i class="fa fa-clock-o"></i> '.$value['ce_fe'].' '.$value['ce_he'].'</h6>
                                    </div>
                                    
                                    <div class="col-xs-7 sigh-background-primary" style="height:85px;width:55%;padding-left:0px;padding-right:0px">
                                        <h3 class="color-white bold" style="line-height:1.2;text-transform: uppercase;margin-top:8px;font-size:22px">'.$value['paciente_nombre'].' '.$value['paciente_ap'].' '.$value['paciente_am'].'</h3>
                                        <h6 class="color-white semi-bold" style="text-transform: uppercase;font-size:12px;position:absolute;bottom: -8px;"><i class="fa fa-bullhorn"></i> Llamado Hace: '.$clock.'</h6>
                                        <div style="position:absolute;height:15px;width:15px;top:0px;right: 0px;" class="'.$ColorSexo.'"></div>
                                    </div>
                                </div>        
                            </div>';
            }
        }

        $this->setOutput(array(
            'ArtyomPaciente'=>$ArtyomPaciente,
            'ListaPacientesLast'=>$result,
            'ListaPacientesAll'=>$result_ce,'MAX'=>$existe,
            'TOTAL_ACTUAL'=> count($sql_check),
            'ListaAccion'=>'0',
            'TOTAL_LISTA'=>$TOTAL_LISTA,
            'ULTIMA_ACTUALIZACION'=> date('Y-m-d H:i:s')
        ));
        
    }
    public function AjaxListaCeVerificar() {
        $TotalLista= $this->config_mdl->_query("SELECT * FROM os_triage, os_consultorios_especialidad, os_consultorios_especialidad_llamada
            WHERE 
            os_consultorios_especialidad.triage_id=os_triage.triage_id AND
            os_consultorios_especialidad.ce_id=os_consultorios_especialidad_llamada.ce_id_ce AND
            os_consultorios_especialidad.ce_status='Asignado'");
        $this->setOutput(array('TotalListaCe'=> count($TotalLista)));
    }
    public function Interconsultas() {
        $this->load->view('Listas/ListaInterconsultas');
    }
    public function AjaxInterconsultas() {
        $sql= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id,ing.ingreso_clasificacion,pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, 
                doc.doc_fecha, doc.doc_hora, doc.doc_modulo, doc.doc_servicio_envia, doc.doc_diagnostico, doc.doc_servicio_solicitado,
                doc.empleado_envia, doc.doc_estatus, doc.doc_id
                FROM sigh_pacientes_ingresos AS ing, sigh_pacientes AS pac, sigh_doc430200 AS doc WHERE 
                doc.doc_estatus='En Espera' AND ing.paciente_id=pac.paciente_id AND ing.ingreso_id=doc.ingreso_id");
        $cols='';
        foreach ($sql as $value) {
            $Diff=Modules::run('Config/getTimeElapsed',array(
                'Time1'=> date('d-m-Y').' '. date('H:i'),
                'Time2'=> $value['doc_fecha'].' '.$value['doc_hora'],
            ));
            if(strlen($value['doc_servicio_solicitado'])>20){
                $font_ss='12px';
            }else{
                $font_ss='14px';
            }
            $cols.='<div class="col-xs-4 m-t-5">
                        <div class="row">
                            <div class="col-xs-1 '.$this->getBgClasification($value['ingreso_clasificacion']).'" style="height: 100px"></div>
                            <div class="col-xs-10 sigh-background-secundary" style="padding-left:5px">
                                <h4 class="color-white text-nowrap"><i class="fa fa-user"></i> '.$value['paciente_nombre'].' '.$value['paciente_ap'].' '.$value['paciente_am'].'</h4>
                                <h6 class="color-white text-nowrap no-margin text-uppercase"><b>S. ENVÍA</b>: '.$value['doc_servicio_envia'].'</h6>
                                <h6 class="color-white text-nowrap no-margin text-uppercase"><b>S. SOLICITADO </b>:'.$value['doc_servicio_solicitado'].'</h6>
                                <h6 class="color-white text-nowrap" style="margin-bottom:-0px;margin-top:0px"><i class="fa fa-calendar"></i> '.$value['doc_fecha'].' '.$value['doc_hora'].' &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> '.$Diff->d.' Dias '.$Diff->h.' Hrs '.$Diff->i.' Min</h6>
                            </div>
                        </div>
                    </div>';         
        }
        $this->setOutput(array('cols'=>$cols,'page_reload'=>'0'));
    }
    public function ListaEsperaConsultorios() {
        $this->load->view('Listas/ListaEsperaConsultorios');
    }
    public function AjaxListaEsperaConsultorios() {
        $sql= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,
                                                        lista.lista_espera_id,
                                                        lista.lista_espera_envio, lista.lista_espera_fecha, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera') ORDER BY lista.lista_espera_id ASC");
        $cols='';
        foreach ($sql as $value){
            $Diff= Modules::run('Config/CalcularTiempoTranscurrido',array(
                'Tiempo1'=>$value['lista_espera_envio'],
                'Tiempo2'=> date('Y-m-d H:i')
            )); 
            $cols.='<div class="col-xs-4 m-t-5">
                        <div class="row">
                            <div class="col-xs-1 '.$this->getBgClasification($value['ingreso_clasificacion']).'" style="height: 90px"></div>
                            <div class="col-xs-10 sigh-background-secundary">
                                <h4 class="color-white text-nowrap"><i class="fa fa-user"></i> '.$value['paciente_nombre'].' '.$value['paciente_ap'].' '.$value['paciente_am'].'</h4>
                                <h4 class="color-white text-nowrap"><i class="fa fa-trello"></i> '.$value['ingreso_consultorio_nombre'].'</h4>
                                <h6 class="color-white text-nowrap" style="margin-bottom:-0px"><i class="fa fa-calendar"></i> '.$value['lista_espera_envio'].' &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> '.$Diff->d.' Dias '.$Diff->h.' Hrs '.$Diff->i.' Min</h6>
                            </div>
                        </div>
                    </div>';
        }
        $this->setOutput(array('cols'=>$cols));
    }
    public function PacientesEnEspera() {
        $this->load->view('Listas/PacientesEnEspera');
    }
    public function AjaxPacientesEnEspera() {
        $sql= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,
                                                        ing.ingreso_date_enfermera,ingreso_time_enfermera,ing.ingreso_date_medico,ing.ingreso_time_medico,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,paciente_fn,
                                                        lista.lista_espera_id,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND lista.lista_espera_date_envio!='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera') ORDER BY lista.lista_espera_id ASC");
        $tr='';
        foreach ($sql as $value) {
            $Diff= $this->getTimeElapsed(array(
                'Time1'=>$value['lista_espera_date_envio'].' '.$value['lista_espera_time_envio'],
                'Time2'=> date('Y-m-d H:i:s')
            ));
            $Edad= $this->CalcularEdad_($value['paciente_fn']);
            $sqlSv= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
               'ingreso_id'=>$value['ingreso_id'] ,
                'sv_tipo'=>'Triage'
            ))[0];
            $tr.=   '<tr>
                        <td class="'.$this->getBgClasification($value['ingreso_clasificacion']).'"></td>
                        <td>'.$value['ingreso_id'].'</td>
                        <td>'.$value['paciente_nombre'].' '.$value['paciente_ap'].' '.$value['paciente_am'].'</td>
                        <td>'.$value['paciente_sexo'].'</td>
                        <td>'.($Edad->y==0 ? $Edad->m .' Meses':$Edad->y.' Años').'</td>
                        <td>'.$value['ingreso_date_enfermera'].' '.$value['ingreso_time_enfermera'].'</td>
                        <td>'.$value['ingreso_date_medico'].' '.$value['ingreso_time_medico'].'</td>
                        <td>'.$value['ingreso_clasificacion'].'</td>
                        <td>'.$Diff->d.' Días '.$Diff->h.' Hrs '.$Diff->i.' Min</td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <h5 class="no-margin">
                                <span class="semi-bold">OXIMETRÍA: </span>'.$sqlSv['sv_oximetria'].'&nbsp;&nbsp;
                                <span class="semi-bold">G. CAPILAR: </span>'.$sqlSv['sv_glicemia'].'&nbsp;&nbsp;
                                <span class="semi-bold">T. ARTERIAL: </span>'.$sqlSv['sv_sistolica'].'/'.$sqlSv['sv_diastolica'].'&nbsp;&nbsp;
                                <span class="semi-bold">TEMP: </span>'.$sqlSv['sv_temp'].'&nbsp;&nbsp;
                                <span class="semi-bold">F. CARDIACA: </span>'.$sqlSv['sv_fc'].'&nbsp;&nbsp;
                                <span class="semi-bold">F. RESPIRATORIA: </span>'.$sqlSv['sv_fr'].'
                            </h5>
                        </td>
                    </tr>';
        }
        $sqlTurnos= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_le_llamados');
        $this->setOutput(array(
            'action'=>1,
            'tr'=>$tr,
            'le_total'=> "<i class='fa fa-users'></i> " .count($sql),
            'le_turno_amarillo'=>$sqlTurnos[0]['llamado_espera_amarillo'].'/'.$sqlTurnos[1]['llamado_espera_amarillo'],
            'le_turno_verde'=>$sqlTurnos[0]['llamado_espera_verde'].'/'.$sqlTurnos[1]['llamado_espera_verde'],
            'le_turno_azul'=>$sqlTurnos[0]['llamado_espera_azul'].'/'.$sqlTurnos[1]['llamado_espera_azul'],
        ));
    }
    public function AjaxPacientesEnEsperaConsultorios() {
        $sql= $this->config_mdl->sqlQuery("SELECT ing.ingreso_id, ing.ingreso_clasificacion,ing.ingreso_consultorio_nombre,
                                                        ing.ingreso_date_enfermera,ingreso_time_enfermera,ing.ingreso_date_medico,ing.ingreso_time_medico,
                                                        pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_sexo,paciente_fn,
                                                        lista.lista_espera_id,
                                                        lista.lista_espera_date_envio,lista.lista_espera_time_envio, lista.lista_espera_date,lista.lista_espera_time, lista.lista_espera_eventos, lista.lista_espera_estado FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE
                                                        lista.lista_espera_estatus='' AND lista.lista_espera_date_envio!='' AND
                                                        ing.paciente_id=pac.paciente_id AND ing.ingreso_id=lista.ingreso_id AND lista.lista_espera_estado IN ('Ausente','En Espera') ORDER BY lista.lista_espera_id ASC");
        $tr='';
        foreach ($sql as $value) {
            $Diff= $this->getTimeElapsed(array(
                'Time1'=>$value['lista_espera_date_envio'].' '.$value['lista_espera_time_envio'],
                'Time2'=> date('Y-m-d H:i:s')
            ));
            $Edad= $this->CalcularEdad_($value['paciente_fn']);
            $sqlSv= $this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
               'ingreso_id'=>$value['ingreso_id'] ,
                'sv_tipo'=>'Triage'
            ))[0];
            $tr.=   '<tr>
                        <td class="'.$this->getBgClasification($value['ingreso_clasificacion']).'"></td>
                        <td>'.$value['ingreso_id'].'</td>
                        <td>'.$value['paciente_nombre'].' '.$value['paciente_ap'].' '.$value['paciente_am'].'</td>
                        <td>'.$value['paciente_sexo'].'</td>
                        <td>'.($Edad->y==0 ? $Edad->m .' Meses':$Edad->y.' Años').'</td>
                        <td>'.$value['ingreso_date_enfermera'].' '.$value['ingreso_time_enfermera'].'- '.$value['ingreso_time_medico'].'</td>
                        <td>'.$value['ingreso_clasificacion'].'</td>
                        <td>'.$Diff->d.' Días '.$Diff->h.' Hrs '.$Diff->i.' Min</td>
                        <td rowspan="2" class="text-center">
                            <i class="fa fa-user-plus i-20 m-t-20 pointer consultorios-agregar-paciente-manual" data-id="'.$value['ingreso_id'].'"></i>
                        </td>    
                    </tr>
                    <tr>
                        <td colspan="8">
                            <h5 class="no-margin">
                                <span class="semi-bold">OXIMETRÍA: </span>'.$sqlSv['sv_oximetria'].'&nbsp;&nbsp;
                                <span class="semi-bold">G. CAPILAR: </span>'.$sqlSv['sv_glicemia'].'&nbsp;&nbsp;
                                <span class="semi-bold">T. ARTERIAL: </span>'.$sqlSv['sv_sistolica'].'/'.$sqlSv['sv_diastolica'].'&nbsp;&nbsp;
                                <span class="semi-bold">TEMP: </span>'.$sqlSv['sv_temp'].'&nbsp;&nbsp;
                                <span class="semi-bold">F. CARDIACA: </span>'.$sqlSv['sv_fc'].'&nbsp;&nbsp;
                                <span class="semi-bold">F. RESPIRATORIA: </span>'.$sqlSv['sv_fr'].'
                            </h5>
                        </td>
                    </tr>';
        }
        $sqlTurnos= $this->config_mdl->sqlGetDataCondition('sigh_consultorios_le_llamados');
        $this->setOutput(array(
            'action'=>1,
            'tr'=>$tr,
            'le_total'=> "<i class='fa fa-users'></i> " .count($sql),
            'le_turno_amarillo'=>$sqlTurnos[0]['llamado_espera_amarillo'].'/'.$sqlTurnos[1]['llamado_espera_amarillo'],
            'le_turno_verde'=>$sqlTurnos[0]['llamado_espera_verde'].'/'.$sqlTurnos[1]['llamado_espera_verde'],
            'le_turno_azul'=>$sqlTurnos[0]['llamado_espera_azul'].'/'.$sqlTurnos[1]['llamado_espera_azul'],
        ));
    }
}

