<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12">
                <div class="md-whiteframe-z0 bg-white">

                    <div class="tab-content p m-b-md b-t b-t-2x">
                        <div role="tabpanel" class="tab-pane animated fadeIn active" id="tab_1">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <ul class="timeline" ng-class="{'timeline-center': center}">
                                        <li class="tl-header ">
                                            <div class="btn btn-default back-imss">
                                                <h5 style="text-transform: uppercase;text-align: left"><b>PACIENTE:</b> <?=$info['triage_nombre']?> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?></h5>
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
                                                    <div class="text-lt p-h m-b-sm">Hora Cero</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$info['triage_horacero_f']?>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$info['triage_horacero_h']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_HORACERO['empleado_nombre']?> <?=$E_HORACERO['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php if($info['triage_fecha']!=''):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow  left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Triage Enfermería
                                                        <?php if($this->UMAE_AREA=='Administrador'){?>
                                                        <a href="<?=  base_url()?>Triage/Paciente/<?=$this->uri->segment(4)?>/?via=Paciente" target="_blank">
                                                            <button class="btn btn-icon btn-rounded bg-white waves-effect tip" data-placement="right" data-original-title="Editar información" style="position: absolute;right: 5px;top: 1px">
                                                                <i class="fa fa-pencil color-black"></i>
                                                            </button>
                                                        </a>
                                                        <?php }?>
                                                    </div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$info['triage_fecha']?>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?=$info['triage_hora']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_ET['empleado_nombre']?> <?=$E_ET['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($info['triage_fecha_clasifica']!=''):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Triage Médico
                                                        
                                                        <ul class="list-inline " style="float: right;margin-top: -5px;margin-right:-10px">
                                                            <li class="dropdown">
                                                                <a md-ink-ripple="" data-toggle="dropdown" class="btn btn-icon btn-rounded bg-white waves-effect" aria-expanded="false" style="position: absolute;right: 0px;top: -18px">
                                                                    <i class="mdi-navigation-more-vert text-md color-black"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/Clasificacion/<?=$this->uri->segment(4)?>')">
                                                                            Generar Documento de clasificación
                                                                        </a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$info['triage_fecha_clasifica']=='' ? 'Sin especificar' : $info['triage_fecha_clasifica']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$info['triage_hora_clasifica']=='' ? 'Sin especificar' : $info['triage_hora_clasifica']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_MT['empleado_nombre']=='' ? 'No Especificado' :$E_MT['empleado_nombre']?> <?=$E_MT['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="tl-header">
                                            <div class="btn btn-default text-left">
                                               
                                                Destino: 
                                                <?=$info['triage_consultorio_nombre']?><br>
                                                <?php 
                                                $dif_hc=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                    'Tiempo1'=> str_replace('/', '-', $info['triage_horacero_f']).' '.$info['triage_horacero_h'],
                                                    'Tiempo2'=>str_replace('/', '-', $info['triage_fecha_clasifica']).' '.$info['triage_hora_clasifica']
                                                ));
                                                echo $dif_hc->h .' Horas ' .$dif_hc->i.' Minutos'; 
                                                ?>
                                                <?php if($this->UMAE_AREA=='Administrador'){?>
                                                <i class="fa fa-gear icono-accion link-cambiar-destino"  style="position: absolute;top: 5px;right: 5px" data-triage="<?=$this->uri->segment(4)?>" data-destino-id="<?=$info['triage_consultorio']?>" data-destino-nombre="<?=$info['triage_consultorio_nombre']?>"></i>
                                                <?php }?>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        
                                        <?php if($am['asistentesmedicas_fecha']!=''): ?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Asistentes Médicas
                                                        <ul class="list-inline " style="float: right;margin-top: -5px;margin-right:-10px">
                                                            <li class="dropdown">
                                                                <a md-ink-ripple="" data-toggle="dropdown" class="btn btn-icon btn-rounded bg-white waves-effect" aria-expanded="false" style="position: absolute;right: 0px;top: -18px">
                                                                    <i class="mdi-navigation-more-vert text-md color-black"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                                                    <?php if($ce['ce_asignado_consultorio']=='Consultorio CPR'){?>
                                                                    <li>
                                                                        <a href="<?=  base_url()?>inicio/documentos/NotaValoracion/<?=$this->uri->segment(4)?>">Nota de Valoración</a>
                                                                    </li>
                                                                    <?php }else if($ce['ce_asignado_consultorio']=='Consultorio Cirugía Maxilofacial'){?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/NotaValoracionCm/<?=$this->uri->segment(4)?>')">Nota de Valoración</a>
                                                                    </li>
                                                                    <?php }else{?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/HojaFrontal/<?=$this->uri->segment(4)?>')">Hoja Frontal</a>
                                                                    </li>
                                                                    <?php }?>
                                                                    <?php if($PINFO['pia_lugar_accidente']=='TRABAJO'){?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/ST7/<?=$this->uri->segment(4)?>')">Generar ST7</a>
                                                                    </li>
                                                                    <?php }?>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$am['asistentesmedicas_fecha']=='' ? 'Sin especificar' : $am['asistentesmedicas_fecha']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$am['asistentesmedicas_hora']=='' ? 'Sin especificar' : $am['asistentesmedicas_hora']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_AM['empleado_nombre']=='' ? 'No Especificado' :$E_AM['empleado_nombre']?> <?=$E_AM['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($ce['ce_fe']!=''): ?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Ingreso Consultorios de Especialidad
                                                        
                                                        <ul class="list-inline " style="float: right;margin-top: -5px;margin-right:-10px">
                                                            <li class="dropdown">
                                                                <a md-ink-ripple="" data-toggle="dropdown" class="btn btn-icon btn-rounded bg-white waves-effect" aria-expanded="false" style="position: absolute;right: 0px;top: -18px">
                                                                    <i class="mdi-navigation-more-vert text-md color-black"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                                                    <?php if($ce['ce_asignado_consultorio']=='Consultorio CPR'){?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/NotaValoracion/<?=$this->uri->segment(4)?>')">Nota de Valoración</a>
                                                                    </li>
                                                                    <?php }else if($ce['ce_asignado_consultorio']=='Consultorio Cirugía Maxilofacial'){?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/NotaValoracionCm/<?=$this->uri->segment(4)?>')">Nota de Valoración</a>
                                                                    </li>
                                                                    <?php }else{?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/HojaFrontalCE/<?=$this->uri->segment(4)?>')">Hoja Frontal Emitido por CE</a>
                                                                    </li>
                                                                    <?php }?>
                                                                    <?php if($PINFO['pia_lugar_accidente']=='TRABAJO'){?>
                                                                    <li>
                                                                        <a href="#" onclick="AbrirDocumento('<?=  base_url()?>inicio/documentos/ST7/<?=$this->uri->segment(4)?>')">Generar ST7</a>
                                                                    </li>
                                                                    <?php }?>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$ce['ce_fe']=='' ? 'Sin especificar' : $ce['ce_fe']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$ce['ce_fe']=='' ? 'Sin especificar' : $ce['ce_fe']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_CE['empleado_nombre']=='' ? 'No Especificado' :$E_CE['empleado_nombre']?> <?=$E_CE['empleado_apellidos']?><br>
                                                        <i class="fa fa-medkit "></i> <?=$ce['ce_asignado_consultorio']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <?php endif;?>
                                        <?php if($ce['ce_fs']!=''):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Egreso Consultorios de Especialidad</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$ce['ce_fs']=='' ? 'Sin especificar' : $ce['ce_fs']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$ce['ce_hs']=='' ? 'Sin especificar' : $ce['ce_hs']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_CE['empleado_nombre']=='' ? 'No Especificado' :$E_CE['empleado_nombre']?> <?=$E_CE['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="tl-header">
                                            <div class="btn btn-default">
                                                Alta a: <?=$ce['ce_hf']?><br>
                                                <?php 
                                                $dif_am_ce=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                    'Tiempo1'=> str_replace('/', '-', $am['asistentesmedicas_fecha']).' '.$am['asistentesmedicas_hora'],
                                                    'Tiempo2'=>str_replace('/', '-', $ce['ce_fs']).' '.$ce['ce_hs']
                                                ));
                                                echo $dif_am_ce->h .' Horas ' .$dif_am_ce->i.' Minutos'; 
                                                ?>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($observacion['observacion_fl']!=''):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Ingreso Observación</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$observacion['observacion_fl']=='' ? 'Sin especificar' : $observacion['observacion_fl']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$observacion['observacion_hl']=='' ? 'Sin especificar' : $observacion['observacion_hl']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_OC['empleado_nombre']=='' ? 'No Especificado' :$E_OC['empleado_nombre']?> <?=$E_OC['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($observacion['observacion_fs']!=''):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Egreso Observación</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px">
                                                        <i class="fa fa-calendar"></i> <?=$observacion['observacion_fs']=='' ? 'Sin especificar' : $observacion['observacion_fs']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$observacion['observacion_hs']=='' ? 'Sin especificar' : $observacion['observacion_hs']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_OC['empleado_nombre']=='' ? 'No Especificado' :$E_OC['empleado_nombre']?> <?=$E_OC['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="tl-header">
                                            <div class="btn btn-default">
                                                <?=$observacion['observacion_alta']?><br>
                                                <?php 
                                                $dif_am_ob=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                    'Tiempo1'=> str_replace('/', '-', $am['asistentesmedicas_fecha']).' '.$am['asistentesmedicas_hora'],
                                                    'Tiempo2'=>str_replace('/', '-', $observacion['observacion_fs']).' '.$observacion['observacion_hs']
                                                ));
                                                echo $dif_am_ob->h .' Horas ' .$dif_am_ob->i.' Minutos'; 
                                                ?>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($choque['observacion_fl']!='' ):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Ingreso Choque</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$choque['observacion_fl']=='' ? 'Sin especificar' : $choque['observacion_fl']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$choque['observacion_hl']=='' ? 'Sin especificar' : $choque['observacion_hl']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_EC['empleado_nombre']=='' ? 'No Especificado' :$E_EC['empleado_nombre']?> <?=$E_EC['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($choque['observacion_fs']!=''):?>
                                        <li class="tl-item">
                                            <div class="tl-wrap b-info">
                                                <span class="tl-date text-muted"></span>
                                                <div class="tl-content panel panel-card w-xl <?=$background?> w-auto-xs" style="padding-top: 10px;padding-bottom: 0px;color: white!important">
                                                    <span class="arrow left pull-top" style="border-color: <?=$background_boder?>"></span>
                                                    <div class="text-lt p-h m-b-sm">Egreso Choque</div>
                                                    <div class="p b-t b-light" style="padding: 10px 16px 10px 16px;background: #256659">
                                                        <i class="fa fa-calendar"></i> <?=$choque['observacion_fs']=='' ? 'Sin especificar' : $choque['observacion_fs']?>&nbsp;&nbsp;
                                                        <i class="fa fa-clock-o"></i> <?=$choque['observacion_hs']=='' ? 'Sin especificar' : $choque['observacion_hs']?><br>
                                                        <i class="fa fa-user"></i> <?=$E_EC['empleado_nombre']=='' ? 'No Especificado' :$E_EC['empleado_nombre']?> <?=$E_EC['empleado_apellidos']?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="tl-header">
                                            <div class="btn btn-default"><?=$choque['observacion_alta']?></div>
                                        </li>
                                        <?php endif;?>
                                        <?php if($egreso['egreso_fecha']!=''):?>
                                        <li class="tl-header">
                                            <br>
                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                            <div class="btn btn-default">
                                                Alta Asistente Médica<br>
                                                <?php 
                                                echo $egreso['egreso_fecha'].' '.$egreso['egreso_hora'];
                                                ?>
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
                                                <span><?=$value['acceso_tipo']?></span><br>
                                                <span>
                                                    <i class="fa fa-clock-o"></i> <?=$value['acceso_fecha']?> <?=$value['acceso_hora']?>&nbsp;&nbsp;
                                                    <i class="fa fa-user"></i> <?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?>
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
