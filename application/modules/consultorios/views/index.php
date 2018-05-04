<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">LISTA DE PACIENTES EN CONSULTORIOS (<?=count($Gestion)?> PACIENTES)</h4>
                        <a href="<?=  base_url()?>Consultorios/Indicadores" class="btn sigh-background-primary pull-right hide" style="position: absolute;right: 20px;top: 5px">
                            <i class="fa fa-bar-chart i-24 color-white"></i>
                        </a>
                    </div>
                    <div class="grid-body">
                        
                        <div class="row ">
                            <div class="col-md-4 col-loading-process">
                                <div class="input-group ">
                                    <span class="input-group-addon no-border sigh-background-primary" >
                                        <i class="fa fa-user-plus"></i>
                                    </span>
                                    <input type="number" class="form-control" minlength="0" name="ingreso_id" data-total="<?=count($Gestion)?>" placeholder="INGRESAR N° DE FOLIO DE INGRESO">
                                </div>
                            </div>
                            <div class="col-md-2 col-loading-process" style="position: relative;">
                                <a href="#" class="btn sigh-background-primary pull-right btn-lista-espera tip" data-original-title="Llamar Paciente Aleatoriamente" style="position: absolute;top: -3px;left: 0px">
                                    <i class="material-icons i-24 color-white">person_add</i>
                                </a>
                            </div>
                            <div class="col-md-8 col-waiting-btn-call hide">
                                <h4 class="m-t-10 m-b-5">Espere por favor. Liberando botón de llamada en <span class="time-waiting-btn">8</span> Segundos...</h4>
                            </div>
                            <div class="col-md-offset-2 col-md-4">
                                <a href="<?= base_url()?>Consultorios/ListarPacientesEnEspera">
                                    <div class="alert alert-success pointer"  style="margin-top: -4px">
                                        <h4 class="no-margin"><i class="fa fa-user"></i> <span class="ce-lista-espera-total"><?=$TotalEspera?></span> Pacientes En Lista de Espera</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12 <?= count($Gestion)>=5 ? '':'hide'?> m-t-10">
                                <div class="alert alert-danger no-margin">
                                    <h5 class="no-margin semi-bold">VERIFICAR SITUACIÓN DE PACIENTES DE LA LISTA PARA DARLOS DE ALTA</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            
                            <div class="col-md-12">
                                <input type="hidden" name="totalListaConsultorio" value="<?= count($Gestion)?>">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#filter" data-limit-navigation="7"data-page-size="15">
                                    <thead>
                                        <tr style="background: <?=$this->sigh->getInfo('hospital_back_primary')?>!important">
                                            <th style="width: 15%" data-sort-ignore="true">FOLIO SiGH</th>
                                            <th style="width: 27%;" data-sort-ignore="true">NOMBRE PACIENTE</th>
                                            <th style="width: 20%" data-sort-ignore="true">T. TRANSCURRIDO</th>
                                            <th style="width: 20%" data-sort-ignore="true"><span class="label label-info">FOLIO SIMEF</span></th>
                                            <th data-sort-ignore="true">ESTATUS</th>
                                            <th data-sort-ignore="true" style="width: 15%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {
                                        $t_c=Modules::run('Config/CalcularTiempoTranscurrido',array('Tiempo1'=> str_replace('/', '-', $value['ce_fe']).' '.$value['ce_he'],'Tiempo2'=>date('d-m-Y').' '.date('H:i')));
                                        if($t_c->h<7 || $t_c->d>0){}
                                        ?>
                                        <tr id="<?=$value['ingreso_id']?>" >
                                            <td class="pointer">
                                                <span class="label <?= Modules::run("config/getBgClasification",$value['ingreso_clasificacion'])?> color-white">
                                                <?=$value['ingreso_id']?>
                                                </span>
                                            </td>
                                            <td style="font-size: 12px">
                                                
                                                <?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?>
                                                    
                                                <?php 
                                                $sqlListaEspera=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
                                                    'ingreso_id'=>$value['ingreso_id']
                                                ));
                                                if(!empty($sqlListaEspera)){
                                                ?>
                                                <div style="position: relative">
                                                    <span class="label label-success tip" style="position: absolute;top: -28px;right: 0px" data-original-title="<?=$sqlListaEspera[0]['lista_espera_eventos']?> Eventos de llamada"><?=$sqlListaEspera[0]['lista_espera_eventos']?></span>
                                                </div>
                                                <?php }?>
                                            </td>
                                            <td ><?=$t_c->d?> Días <?=$t_c->h?> Hrs <?=$t_c->i?> Min</td>
                                            
                                            <td ><?=$value['ingreso_folio_simef']?></td>
                                            <td>
                                                <?=$value['ce_status']?>
                                                <?php if($value['ce_status']=='Interconsulta'){
                                                    echo '<br>';
                                                    $sqlInterconsulta=$this->config_mdl->sqlGetDataCondition('sigh_doc430200',array(
                                                        'ingreso_id'=>$value['ingreso_id'],
                                                        'doc_modulo'=>'Consultorios',
                                                    ));
                                                    $Total= count($sqlInterconsulta);
                                                    $Evaluados=0;
                                                    foreach ($sqlInterconsulta as $value_st) {
                                                    ?>
                                                            <?php 
                                                            if($value_st['doc_estatus']=='En Espera'){
                                                            ?>
                                                            <p>
                                                                <span class="label label-warning pointer text-nowrap" onclick="AbrirDocumento(base_url+'Inicio/Documentos/DOC430200/<?=$value_st['doc_id']?>')"><?=$value_st['doc_servicio_solicitado']?></span>
                                                            </p>
                                                            <?php   
                                                            }else{
                                                                $Evaluados++;
                                                            ?>
                                                            <p>
                                                            <a href="#" onclick="AbrirVista(base_url+'Consultorios/InterconsultasDetalles?inter=<?=$value_st['doc_id']?>')" >
                                                                <span class="label label-success"><?=$value_st['doc_servicio_solicitado']?></span>
                                                            </a>
                                                            </p>
                                                            <?php
                                                            }

                                                        }
                                                }?>
                                            </td>
                                            <td >
                                                <div class="dropdown hide" >
                                                    <button class="btn sigh-background-primary dropdown-toggle btn-small" type="button" data-toggle="dropdown">ACCIONES...
                                                    <span class="caret"></span></button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="<?=  base_url()?>Sections/Documentos/Expediente/<?=$value['ingreso_id']?>/?tipo=Consultorios" class="hide"><i class="fa fa-folder-open-o i-20 sigh-color tip"></i>&nbsp;&nbsp;EXPEDIENTE DEL PACIENTE</a>
                                                        </li>
                                                        <li class="hide">
                                                            <a href="#" class="interconsulta-paciente" data-ce="<?=$value['ce_id']?>" data-consultorio="<?=$value['ingreso_consultorio']?>;<?=$value['ingreso_consultorio_nombre']?>" data-id="<?=$value['ingreso_id']?>">
                                                                <i class="fa fa-drivers-license-o i-20 sigh-color tip  pointer"  data-original-title="Solicitar Interconsulta"></i>&nbsp;&nbsp;SOLICITAR INTERCONSULTA
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="consultorios-altapaciente" data-consultorio="<?=$value['ce_id']?>" data-ingreso="<?=$value['ingreso_id']?>">
                                                                <i class="fa fa-share-square-o sigh-color i-20"></i> ALTA
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <i class="fa fa-bullhorn sigh-color i-20 consultorios-llamar-paciente pointer tip" data-original-title="Llamar paciente en pantalla" data-artyompaciente="<?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?> FAVOR DE PASAR A <?=$this->UMAE_AREA?>"></i>&nbsp;
                                                <a href="#" class="consultorios-altapaciente" data-consultorio="<?=$value['ce_id']?>" data-ingreso="<?=$value['ingreso_id']?>">
                                                    <i class="fa fa-share-square-o sigh-color i-20"></i> ALTA
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <?php 
                                                $sqlSv=$this->config_mdl->sqlGetDataCondition('sigh_pacientes_sv',array(
                                                    'ingreso_id'=>$value['ingreso_id'],
                                                    'sv_tipo'=>'Triage'
                                                ))[0];
                                                $sqlObsClass=$this->config_mdl->sqlGetDataCondition('sigh_pacientes_clasificacion_ing',array(
                                                    'ingreso_id'=>$value['ingreso_id']
                                                ))[0];
                                                ?>
                                                <h5 class="no-margin line-height"><b>OXIMETRÍA:</b> <?=$sqlSv['sv_oximetria']?> &nbsp;&nbsp;&nbsp;<b>GLICEMIA CAPILAR:</b> <?=$sqlSv['sv_glicemia']?>&nbsp;&nbsp;&nbsp;<b>TENSIÓN ARTERIAL:</b> <?=$sqlSv['sv_sistolica']?>/<?=$sqlSv['sv_diastolica']?>&nbsp;&nbsp;&nbsp;<b>TEMPERATURA:</b> <?=$sqlSv['sv_temp']?>&nbsp;&nbsp;&nbsp;<b>F CARDIACA:</b> <?=$sqlSv['sv_fc']?>&nbsp;&nbsp;&nbsp;<b>R. RESPIRATORIA:</b> <?=$sqlSv['sv_fr']?></h5>
                                                <h5 class="no-margin line-height text-uppercase"><b>NOTAS TRIAGE: </b><?=$sqlObsClass['clasificacion_observacion']?></h5>
                                                <h5 class="no-margin line-height text-uppercase <?=$sqlObsClass['clasificacion_notas']=='' ?'hide' :''?>"><b style="color: red">NOTAS: </b><?=$sqlObsClass['clasificacion_notas']?></h5>
                                                
                                            </td>
                                        </tr>
                                        <tr style="margin-bottom: 4px!important">
                                            <td colspan="6" class="" style="background: #E5E9EC"></td>
                                        </tr>
                                        <tr >
                                            <td colspan="6" class="" ></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <ul class="pagination"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>            
                            </div>
                            <div class="col-md-12 hide">
                                <div class="alert alert-danger">
                                    <h5 class="no-margin text-uppercase">Al término de su horario de consulta no debe tener pacientes su tabla de pacientes.</h5>
                                </div>
                            </div>
                            <input type="hidden" name="WaitingBtnCall" value="<?=$_GET['WaitingBtnCall']?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="especialidad_nombre" value="<?= Modules::run('Consultorios/ObtenerEspecialidad',array('Consultorio'=>$this->UMAE_AREA))?>">
<?= Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Consultorios.js?<?= date('YmdHis')?>" type="text/javascript"></script>