<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">REPORTAR CONSUMO DE MATERIALES</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" >
                                    <i class="fa fa-medkit"></i>
                                </span>
                                <input type="text" class="form-control" name="existencia_id" data-triage="<?=$_GET['folio']?>" data-quirofano="<?=$_GET['quirofano']?>" placeholder="Ingresar N° Codigo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">CATALOGO</th>
                                        <th style="width: 20%">SISTEMA</th>
                                        <th style="width: 30%">ELEMENTO</th>
                                        <th>TAMAÑO</th>
                                        <th>CODIGO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['catalogo_titulo']?></td>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <td><?=$value['rango_titulo']?></td>
                                        <td><?=$value['existencia_id']?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="7" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Quirofano.js?').md5(microtime())?>" type="text/javascript"></script>