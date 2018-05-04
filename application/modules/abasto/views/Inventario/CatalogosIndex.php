<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>CATALOGOS</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="catalogo_titulo" class="form-control" placeholder="Buscar Catalogo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#catalogo_titulo" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>CATALOGO</th>
                                        <th style="width: 50%">DESCRIPCIÓN</th>
                                        <th style="width: 8%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['catalogo_titulo']?></td>
                                        <td>
                                            <span class="tip pointer" data-original-title="<?=$value['catalogo_descripcion']?>"><?= substr($value['catalogo_descripcion'], 0,90)?>... </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url()?>Abasto/Inventario/Sistemas?catalogo=<?=$value['catalogo_id']?>">
                                                <i class="fa fa-share-square-o icono-accion tip" data-original-title="Sistemas"></i>
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
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>