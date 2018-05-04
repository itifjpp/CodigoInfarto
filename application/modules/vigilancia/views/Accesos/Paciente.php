<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-sm-8 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 20px;font-weight: 500;text-transform: uppercase">
                        <b><?=$this->sigh->getInfo('hospital_tipo')?></b><br>
                        <h5 style="margin-bottom: 0px;margin-top: -2px"><?=$this->sigh->getInfo('hospital_nombre')?></h5>
                    </span>
                    <a class="md-btn md-fab m-b red pull-left tip" href="<?= base_url()?>Vigilancia/Accesos" data-original-title="Regresar" data-placement="left" style="position: absolute;left: 0px;top: 15px">
                        <i class="mdi-navigation-arrow-back i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="text-transform: uppercase!important">
                        <div class="col-sm-12">
                            <?php $Paciente=$this->uri->segment(3);?>
                            <h3 style="margin-top: -5px"><b>PACIENTE:</b> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?></h3>
                            <?php 
                            
                            $sqlVisitas=$this->config_mdl->sqlGetDataCondition('um_poc_familiares',array(
                                'triage_id'=>$Paciente,
                                'familiar_acceso'=>'EN VISITA'
                            ));
                            if(empty($sqlVisitas)){
                                $VisitaAccion='';
                            }else{
                                $VisitaAccion='hide';
                            }
                            if($_GET['tipo']=='Pisos'){
                                $sqlPisosCheck=$this->config_mdl->sqlGetDataCondition('os_areas_pacientes',array(
                                    'triage_id'=>$Paciente
                                ));
                                if(empty($sqlPisosCheck)){
                                    $sqlCama= $this->config_mdl->_query("SELECT * FROM doc_43051 , os_camas, os_pisos, os_pisos_camas, os_areas WHERE
                                                                    os_areas.area_id=os_camas.area_id AND
                                                                    doc_43051.cama_id=os_camas.cama_id AND
                                                                    os_pisos.piso_id=os_pisos_camas.piso_id AND
                                                                    os_pisos_camas.cama_id=os_camas.cama_id AND
                                                                    doc_43051.triage_id=".$Paciente)[0];
                                }else{
                                    $sql43051=$this->config_mdl->sqlGetDataCondition('doc_43051',array(
                                        'triage_id'=>$Paciente
                                    ));
                                    
                                    $sqlCama= $this->config_mdl->_query("SELECT * FROM os_areas_pacientes , os_camas, os_pisos, os_pisos_camas, os_areas WHERE
                                                                    os_areas.area_id=os_camas.area_id AND
                                                                    os_areas_pacientes.cama_id=os_camas.cama_id AND
                                                                    os_pisos.piso_id=os_pisos_camas.piso_id AND
                                                                    os_pisos_camas.cama_id=os_camas.cama_id AND
                                                                    os_areas_pacientes.triage_id=".$Paciente)[0];
                                    $sqlCamaOld= $this->config_mdl->_query("SELECT * FROM doc_43051 , os_camas, os_areas WHERE
                                                                    os_areas.area_id=os_camas.area_id AND
                                                                    doc_43051.cama_id=os_camas.cama_id AND
                                                                    doc_43051.triage_id=".$Paciente)[0];
                                }
                            }else{
                                $sqlCama=$this->config_mdl->_query("SELECT * FROM os_camas, os_areas, os_observacion WHERE os_camas.area_id=os_areas.area_id AND
                                                os_observacion.observacion_cama=os_camas.cama_id AND os_observacion.triage_id=".$Paciente)[0];
                            }
                            if($_GET['tipo']=='Pisos'){?>
                            <h4 style="margin-top: 20px"><b><i class="fa fa-hospital-o icono-accion"></i> PISO:</b> <?=$sqlCama['piso_nombre']?></h4>
                            <?php }?>
                            <h4 style="line-height: 1.6">
                                <b><i class="fa fa-bed icono-accion"></i> CAMA:</b> <?=$sqlCama['cama_nombre']?>
                            </h4>                            
                            <h4 style="line-height: 1.6">
                                <b><i class="fa fa-window-restore icono-accion"></i> SERVICIO:</b> <?=$sqlCama['area_nombre']?>
                            </h4>
                            <h4 style="line-height: 1.6">
                                <b><i class="fa fa-clock-o"></i> HORARIO DE VISITA:</b> <?=$sqlCama['area_horario_visita']=='' ?'SIN ESPECIFICAR' : $sqlCama['area_horario_visita']?>
                            </h4>                            
                        </div>
                    </div>
                </div>
                <div class="panel-heading p teal-900 back-imss text-center" style="padding: 4px;margin-top: -10px">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>FAMILIARES CON PASE A VISITA</b><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tbody>
                                    <?php foreach ($Familiares as $value) {?>
                                    <tr>
                                        <td style="padding: 0px;">
                                            <?php if($value['familiar_perfil']!=''){?>
                                            <img src="<?= base_url()?>assets/img/familiares/<?=$value['familiar_perfil']?>?<?=md5(microtime())?>" class="view-img pointer" onclick="ViewImage($(this).attr('src'),'small')" style="width: 70px">
                                            <?php }else{?>
                                            <?php }?>
                                        </td>
                                        <td><?=$value['familiar_nombre']?> <?=$value['familiar_nombre_ap']?> <?=$value['familiar_nombre_am']?></td>
                                        <td><?=$value['familiar_parentesco']?></td>
                                        <td>
                                           
                                            <?=$value['familiar_acceso']=='' || $value['familiar_acceso']=='EN ESPERA'? 'NO APLICA':'EN VISITA'?>
                                        </td>
                                        <td style="padding: 4px">
                                            <?php if($value['familiar_acceso']=='' || $value['familiar_acceso']=='EN ESPERA'){?>
                                            <i class="mdi-social-person-add fa-3x text-color-imss pointer acceso-paciente <?=$VisitaAccion?>" data-acceso="EN VISITA" data-id="<?=$value['familiar_id']?>"></i>
                                            <?php }else{?>
                                            <i class="fa fa-share-square-o fa-3x text-color-imss pointer acceso-paciente" data-acceso="EN ESPERA" data-id="<?=$value['familiar_id']?>"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php if(empty($Familiares)){?>
                                    <tr>
                                        <td>NO SE HAN ESPECIFICADO FAMILIARES CON PASE A VISITA, FAVOR PASAR CON ASISTENTE MÉDICA PARA AGREGARLOS</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if(!empty($sqlVisitas)){?>
                <div class="red " style="padding: 5px">
                    <h5 class="text-center">EL PACIENTE ACTUALMENTE TIENE UN VISITA</h5>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Vigilancia.js?').md5(microtime())?>" type="text/javascript"></script>