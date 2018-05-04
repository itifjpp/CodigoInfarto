<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12">
                <div class="md-whiteframe-z0 bg-white">

                    <div class="tab-content p m-b-md b-t b-t-2x">
                        <div role="tabpanel" class="tab-pane animated fadeIn active" id="tab_1">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5><b>NOMBRE / PSEUDONIMO: </b><?=$info['triage_nombre']=='' ? $info['triage_nombre_pseudonimo'] : $info['triage_nombre'].' '.$info['triage_nombre_ap'].' '.$info['triage_nombre_am']?></h5>
                                    <?=$info['triage_paciente_afiliacion_armado']!='' ? '<h5><i class="fa fa-warning" style="color:#F44336"></i> <b>N.S.S ARMADO: </b> '.$info['triage_paciente_afiliacion_armado'].'</h5>' : ''?>
                                    <?=$info['triage_paciente_afiliacion']!='' ? '<h5><b>N.S.S: </b> '.$info['triage_paciente_afiliacion'].'</h5>' : ''?>
                                </div>
                                <div class="col-md-6 ">
                                    <ul class="timeline" ng-class="{'timeline-center': center}">
                                        <li class="tl-header">
                                            <div class="btn btn-default">
                                                <h5 style="text-transform: uppercase;text-align: left"><b>INGRESO A CHOQUE</b></h5>
                                            </div>
                                        </li>
                                        <?php 
                                        if($info['triage_color']!=''){
                                            $background= Modules::run('Config/ColorClasificacion',array('color'=>$info['triage_color']));
                                            $background_boder= Modules::run('Config/ColorClasificacionBorder',array('color'=>$info['triage_color']));
                                        }else{
                                            $background= 'back-imss';
                                            $background_boder='#256659';
                                        }
                                        ?>
                                        
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info ">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content <?=$background?> panel panel-card w-xl w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top " r style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Ingreso Choque</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$IngresoChoque['acceso_fecha']?>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$IngresoChoque['acceso_hora']?><br>
                                                        <i class="fa fa-user"></i> <?=$IngresoChoque['empleado_nombre']?> <?=$IngresoChoque['empleado_ap']?> <?=$IngresoChoque['empleado_am']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php if($choque['cama_id']!=''){?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info ">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content <?=$background?> panel panel-card w-xl w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top " r style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Enfermería Choque
                                                        <div class="card-tools">
                                                            <ul class="list-inline">
                                                                <li class="dropdown">
                                                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-flat  md-btn-circle waves-effect" style="background: white!important;color: black!important;margin-top: -8px;margin-right: -7px">
                                                                        <i class="mdi-navigation-more-vert text-md"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                                                        <li><a href="#" onclick="AbrirDocumento(base_url+'Sections/Pacientes/SignosVitales/<?=$info['triage_id']?>')"><i class="fa fa-stethoscope icono-accion"></i> Signos Vitales</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$IngresoChoqueEnf['acceso_fecha']?>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$IngresoChoqueEnf['acceso_hora']?><br>
                                                        <i class="fa fa-bed"></i> <?=$Cama['cama_nombre']?><br>
                                                        <i class="fa fa-user"></i> <?=$IngresoChoqueEnf['empleado_nombre']?> <?=$IngresoChoqueEnf['empleado_ap']?> <?=$IngresoChoqueEnf['empleado_am']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php }?>
                                        <?php if($choque['medico_id']!=''){?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info ">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content <?=$background?> panel panel-card w-xl w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top " r style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Médico Choque
                                                        <div class="card-tools">
                                                            <ul class="list-inline">
                                                                <li class="dropdown">
                                                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-flat  md-btn-circle waves-effect" style="background: white!important;color: black!important;margin-top: -8px;margin-right: -7px">
                                                                        <i class="mdi-navigation-more-vert text-md"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                                                        <li><a href="#" onclick="window.open(base_url+'Sections/Documentos/Expediente/'+<?=$info['triage_id']?>+'/?tipo=Choque&url=Enfermera','_blank')"><i class="fa fa-files-o icono-accion"></i> Expediente</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$IngresoChoqueMed['acceso_fecha']?>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$IngresoChoqueMed['acceso_hora']?><br>
                                                        
                                                        <i class="fa fa-user"></i> <?=$IngresoChoqueMed['empleado_nombre']?> <?=$IngresoChoqueMed['empleado_am']?> <?=$IngresoChoqueMed['empleado_am']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php }?>
                                        <?php if($choque['choque_alta']!=''):?>
                                        <li class="tl-header">
                                            <br>
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                            <div class="btn btn-default">
                                                Alta a: <?=$choque['choque_alta']?>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                    </ul>      
                                </div>
                                <div class="col-md-6">
                                    
                                    <table class="table table-hover table-bordered">
                                        <tr class="back-imss">
                                            <th>
                                                <h5 style="margin-top: 4px;margin-bottom: 2px">HISTORIAL DETALLADO DEL PACIENTE</h5>
                                                <a href="<?=  base_url()?>Sections/Documentos/Expediente/<?=$this->uri->segment(4)?>/?tipo=Consultorios&url=Enfermeria" target="_blank">
                                                <button class="btn  blue pull-right" style="margin-top: -25px;color:white">
                                                    Ver Expediente&nbsp;
                                                    <i class="fa fa-share-square-o "style="font-size: 15px"></i>
                                                </button>
                                                </a>
                                            </th>
                                        </tr>
                                        <?php foreach ($Historial as $value) {?>
                                        <tr>
                                            <td>
                                                <?=$value['acceso_tipo']?><br>
                                                <span>
                                                    <i class="fa fa-clock-o"></i> <?=$value['acceso_fecha']?> <?=$value['acceso_hora']?>&nbsp;&nbsp;
                                                    <i class="fa fa-user"></i> <?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Pacientes.js?'). md5(microtime())?>" type="text/javascript"></script>
