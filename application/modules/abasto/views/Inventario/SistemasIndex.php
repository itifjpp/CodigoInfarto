<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb" style="margin-top: -20px">
                <li><a style="text-transform: uppercase" href="#">Inicio</a></li>
                <li><a style="text-transform: uppercase" href="<?=  base_url()?>Abasto/Inventario"><?=$material['catalogo_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="#">Sistemas</a></li>
            </ol>  
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>SISTEMAS</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="sistema_id" class="form-control" placeholder="Buscar Sistema...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#sistema_id" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">CATALOGO</th>
                                        <th style="width: 20%">SISTEMA</th>
                                        <th style="width: 30%">DESCRIPCIÓN</th>
                                        <th style="width: 10%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['catalogo_titulo']?></td>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <td>
                                            <span class="tip pointer" data-original-title="<?=$value['sistema_descripcion']?>"><?= substr($value['sistema_descripcion'], 0,90)?>... </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url()?>Abasto/Inventario/Elementos?catalogo=<?=$value['catalogo_id']?>&sistema=<?=$value['sistema_id']?>">
                                                <i class="fa fa-share-square-o icono-accion tip" data-original-title="Elementos"></i>
                                            </a>&nbsp;
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