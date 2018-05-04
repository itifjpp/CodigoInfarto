<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>PRECIOS DE ATENCIÓN</strong><br>
                    </span>
                    <a href="<?=  base_url()?>Finanzas/PreciosAtencionAdd/0/?a=add" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Gestión y Asignación de Camas">
                        <i class="fa fa-plus i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-credit-card"></i>
                                </span>
                                <input type="text" id="filter_precios_atencion" class="form-control" placeholder="Ingresar N° de Paciente">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#filter_precios_atencion" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Precio</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td ><?=$value['pa_concepto']?></td>
                                        <td><?=$value['pa_costo']?> </td>
                                        <td style="width: 60%">
                                            <?=$value['pa_descripcion']?>
                                        </td>
                                        <td>
                                            <a href="<?=  base_url()?>Finanzas/PreciosAtencionAdd/<?=$value['pa_id']?>/?a=edit">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>&nbsp;&nbsp;
                                            <i class="fa fa-trash-o icono-accion eliminar-pa pointer" data-id="<?=$value['pa_id']?>"></i>
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