<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <a href="<?=  base_url()?>Arimac/Vigencias" class="md-btn md-fab m-b red " style="position: absolute;left: -10px;top: 13px">
                            <i class="mdi-navigation-arrow-back i-24"></i>
                        </a>
                        <strong>ESTADO DE VIGENCIA ACCEDER</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mayus-bold">APELLIDO PATERNO</label>
                                <input type="text" readonly="" class="form-control" value="<?=$info['triage_nombre_ap']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mayus-bold">APELLIDO MATERNO</label>
                                <input type="text" readonly="" class="form-control" value="<?=$info['triage_nombre_am']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mayus-bold">NOMBRE</label>
                                <input type="text" readonly="" class="form-control" value="<?=$info['triage_nombre']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mayus-bold">SEXO</label>
                                <input type="text" readonly="" class="form-control" value="<?=$info['triage_paciente_sexo']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mayus-bold">N.S.S</label>
                                <input type="text" readonly="" class="form-control" value="<?=$info['pum_nss']?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="mayus-bold">N.S.S AGREGADO</label>
                                <input type="text" readonly="" class="form-control" value="<?=$info['pum_nss_agregado']?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <?php if($info['info_vigencia_acceder']=='NO'){?>
                            <div class="alert alert-danger">
                                <h5 style="margin-top: 0px;margin-bottom: 0px"><b>ESTADO:</b> PACIENTE NO VIGENTE POR ACCEDER</h5>
                            </div>
                            <?php }else if($info['info_vigencia_acceder']=='SI'){?>
                            <div class="alert alert-success">
                                <h5 style="margin-top: 0px;margin-bottom: 0px"><b>ESTADO:</b> PACIENTE VIGENTE POR ACCEDER</h5>
                            </div>
                            <?php }else{?>
                            <div class="alert alert-danger">
                                <h5 style="margin-top: 0px;margin-bottom: 0px"><b>ESTADO:</b> NO VALIDADO POR ACCEDER</h5>
                            </div>
                            <?php }?>
                            <?php if($info['info_vigencia_arimac']!=''){?>
                                <?php 
                                $sqlAutoriza=$this->config_mdl->sqlGetDataCondition('os_empleados',array(
                                    'empleado_id'=>$info['info_vigencia_autorizacion']
                                ))[0]
                                ?>
                                <?php if($info['info_vigencia_arimac']=='Si'){?>
                                <div class="alert alert-success" style="margin-top: -10px">
                                    <h5 style="margin-top: 0px;margin-bottom: 0px;text-transform: uppercase;line-height: 1.6">
                                        <b>ESTADO:</b> AUTORIZACIÓN DE VIGENCIA POR ARIMAC<br>
                                        <b>AUTORIZÓ:</b> <?=$sqlAutoriza['empleado_nombre']?> <?=$sqlAutoriza['empleado_apellidos']?><br>
                                        <b>TIPO DE AUTORIZACIÓN: </b><?=$info['info_vigencia_autorizacion_tipo']?>
                                    </h5>
                                    
                                </div>
                                <?php }else{?>
                                <div class="alert alert-danger" style="margin-top: -10px">
                                    <h5 style="margin-top: 0px;margin-bottom: 0px;text-transform: uppercase;line-height: 1.6">
                                        <b>ESTADO:</b> NO AUTORIZACIÓN DE VIGENCIA POR ARIMAC<br>
                                        <b>AUTORIZÓ:</b> <?=$sqlAutoriza['empleado_nombre']?> <?=$sqlAutoriza['empleado_apellidos']?><br>
                                        <b>TIPO DE AUTORIZACIÓN: </b><?=$info['info_vigencia_autorizacion_tipo']?>
                                    </h5>
                                    
                                </div>
                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="col-md-offset-6 col-md-6">
                            <?php if($info['info_vigencia_arimac']=='' && $info['info_vigencia_acceder']=='NO'){?>
                            <button class="btn btn-block back-imss btn-vigencia-arimac" data-id="<?=$_GET['folio']?>">VALIDAR VIGENCIA</button>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Arimac.js?').md5(microtime())?>" type="text/javascript"></script>