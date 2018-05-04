<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered" style="margin-top: -20px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;">Ortopedia - Admisión Continua</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-user-plus"></i>
                                </span>
                                <input type="text" name="triage_id" class="form-control" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>FOLIO</th>
                                        <th style="width: 35%">PACIENTE</th>
                                        <th>FECHA DE ENVÍO</th>
                                        <th>INGRESO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_id']?></td>
                                        <td><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                                        <td><?=$value['ac_envio_fecha']?> <?=$value['ac_envio_hora']?></td>
                                        <td><?=$value['ac_ingreso_fecha']?> <?=$value['ac_ingreso_hora']?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url()?>Sections/Documentos/Expediente/<?=$value['triage_id']?>/?tipo=Observación" target="_blank">
                                                <i class="fa fa-pencil-square-o icono-accion"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/OrtopediaAdmisionContinua.js?'). md5(microtime())?>" type="text/javascript"></script> 