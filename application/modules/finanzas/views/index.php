<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>FINANZAS</strong><br>
                    </span>
                    
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="triage_id" class="form-control" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#filter_medico_choque" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th data-hide="all">TIPO DE PACIENTE</th>
                                        <th>NOMBRE/PSEUDONIMO</th>
                                        <th>N.S.S</th>
                                        <th>SEXO</th>
                                        <th>INGRESO</th>
                                        <th>ESTATUS</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td ><?=$value['triage_tipo_paciente']?></td>
                                        <td><?=$value['triage_nombre']=='' ? $value['triage_nombre_pseudonimo'] : $value['triage_nombre'].' '.$value['triage_nombre_ap'].' '.$value['triage_nombre_am']?> </td>
                                        <td>
                                            <?=$value['triage_paciente_afiliacion_armado']!='' ? '<b style="color:#F44336">ARMADO:</b> '.$value['triage_paciente_afiliacion_armado'].'<br>': ''?>
                                            <?=$value['triage_paciente_afiliacion']!='' ? '<b>NSS:</b> '.$value['triage_paciente_afiliacion']: ''?>
                                        </td>
                                        <td><?=$value['triage_paciente_sexo']?></td>
                                        <td><?=$value['triage_horacero_f']?> <?=$value['triage_horacero_h']?></td>
                                        <td>
                                            <?php if($value['finanza_status']=='Ingreso'){?>
                                            <span class="label orange">Ingreso</span>
                                            <?php }if($value['finanza_status']=='Verificado'){?>
                                            <span class="label green">Verificado</span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <i class="fa fa-user-plus icono-accion pointer tip paciente-verificado" data-id="<?=$value['finanza_id']?>" data-original-title="Agregar paciente como verificado"></i>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Finanzas.js?').md5(microtime())?>" type="text/javascript"></script>