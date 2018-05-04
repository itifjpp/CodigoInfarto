<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered" style="margin-top: -20px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;">ASISTENTE MÉDICA ORTOPEDIA - ADMISIÓN CONTINUA</span>
                    <a href="<?=  base_url()?>Asistentesmedicas/Indicadores" md-ink-ripple="" target="_blank" class="md-btn hidden md-fab m-b green waves-effect pull-right tip " data-original-title="Indicadores">
                        <i class="fa fa-line-chart i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" name="triage_id" class="form-control" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>FOLIO</th>
                                        <th style="width: 30%">PACIENTE</th>
                                        <th>HORA CLAS.</th>
                                        <th>HORA A.M</th>
                                        <th>TIEMPO TRANS.</th>
                                        <th>ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_id']?></td>
                                        <td class="<?= Modules::run('Config/ColorClasificacion',array('color'=>$value['triage_color']))?>" style="color: white"><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                                        <td><?=$value['triage_fecha_clasifica']?> <?=$value['triage_hora_clasifica']?></td>
                                        <td><?=$value['asistentesmedicas_fecha']?> <?=$value['asistentesmedicas_hora']?></td>
                                        <td>
                                            <?= Modules::run('Config/TiempoTranscurrido',array(
                                                'Tiempo1_fecha'=>$value['triage_fecha_clasifica'],
                                                'Tiempo1_hora'=>$value['triage_hora_clasifica'],
                                                'Tiempo2_fecha'=>$value['asistentesmedicas_fecha'],
                                                'Tiempo2_hora'=>$value['asistentesmedicas_hora'],
                                            ))?> Minutos
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url()?>Ortopedia/Asistentesmedicas/Paciente/<?=$value['triage_id']?>" target="_blank">
                                                <i class="fa fa-pencil icono-accion tip" data-original-title="Editar datos"></i>
                                            </a>
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
<input type="hidden" value="Asistente Médica Ortopedia" name="AsistenteMedicaTipo">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script> 