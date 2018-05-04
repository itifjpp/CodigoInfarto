<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default " style="margin-top: -20px">
                    <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                    <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>CONTRATOS</b>&nbsp;
                    </span>
                    <a style="margin-left: 30px !important;" href="<?=  base_url()?>Abasto/MinimaInvacion/NuevoContrato?accion=add" target="_blank" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Nuevo Contrato">
                        <i class="mdi-content-add i-24" ></i>
                    </a>
                </div>
                    <div class="panel-body b-b b-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" id="buscar" name="procedimiento" placeholder="BUSCAR PROCEDIMIENTO">
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <table class="table table-hover table-bordered footable table-filtros" data-page-size="7" data-filter="#buscar" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th>CONTRATO</th>
                                                <th>ACCION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($CONTRATOS AS $value) { ?>
                                            <tr>
                                                <td><?= $value['contrato_nombre']?></td>
                                                <td style="width:15%">
                                                    &nbsp;<a href="<?=base_url()?>Abasto/MinimaInvacion/NuevoContrato?accion=edit&contrato_id=<?= $value['contrato_id']?>" target="_blank">
                                                        <i class="fa fa-pencil i-16 pointer icono-accion" title="Editar"></i>
                                                    </a>
                                                    &nbsp;<i class="fa fa-trash i-16 icono-accion eliminar-Proced_Contr pointer" data-id="<?= $value['contrato_id']?>" data-tipo="contrato" data-nombre="<?= $value['contrato_nombre']?>" title="Eliminar"></i>
                                                </td>
                                           </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot class="hide-if-no-paging">
                                            <tr>
                                                <td colspan="4" id="footerCeldas" class="text-center">
                                                    <ul class="pagination"></ul>
                                                </td>
                                            </tr>
                                        </tfoot>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>



