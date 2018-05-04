<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered" style="margin-top: 10px"> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>GESTIÓN DE CONTRATOS</strong><br>
                    </span>
                    <a href="<?=  base_url()?>Abasto/Contratos/Agregar?contrato=0&accion=add" class="md-btn md-fab m-b red waves-effect pull-right tip ">
                        <i class="mdi-av-my-library-add i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">  
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7" style="margin-top: -20px;">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" name="contrato_id" class="form-control" placeholder="Buscar Contratos...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-hover table-bordered footable" data-page-size="4" data-filter="#contrato_id" style="font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th>CONTRATO</th>
                                            <th>NOMBRE DEL PROVEEDOR</th>
                                            <th style="width: 18%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['contrato_nombre']?></td>
                                            <td><?=$value['proveedor_nombre']?></td>
                                            <td>
                                                <a href="<?= base_url()?>Abasto/Contratos/Agregar?contrato=<?=$value['contrato_id']?>&accion=edit">
                                                    <i class="fa fa-pencil i-20 color-imss"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-trash-o pointer color-imss i-20 abs-contrato-eliminar" data-id="<?=$value['contrato_id']?>"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="3" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Abasto/AbsContratos.js?').md5(microtime())?>" type="text/javascript"></script>