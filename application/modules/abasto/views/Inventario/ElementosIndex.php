<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb" style="margin-top: -20px">
                <li><a style="text-transform: uppercase" href="#">Inicio</a></li>
                <li><a style="text-transform: uppercase" href="<?=  base_url()?>Abasto/Inventario"><?=$material['catalogo_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Inventario/Sistemas?catalogo=<?=$_GET['catalogo']?>"><?=$sistema['sistema_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="#">ELEMENTOS</a></li>
            </ol>
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>ELEMENTOS</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="elemento_id" class="form-control" placeholder="Buscar Elemento">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#elemento_id" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>CATALOGO</th>
                                        <th>SISTEMA</th>
                                        <th style="width: 30%">ELEMENTO</th>
                                        <th style="width: 25%">DESCRIPCIÓN</th>
                                        <th style="width: 16%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['catalogo_titulo']?></td>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <td>
                                            <span class="tip pointer" data-original-title="<?=$value['elemento_descripcion']?>"><?= substr($value['elemento_descripcion'], 0,30)?>... </span>
                                        </td>
                                        <td>
                                            <i class="fa fa-image icono-accion view-image pointer" data-image="<?= base_url()?>assets/materiales/<?=$value['elemento_img']?>"></i>&nbsp;
                                            <a href="<?= base_url()?>Abasto/Inventario/Rangos?catalogo=<?=$value['catalogo_id']?>&sistema=<?=$value['sistema_id']?>&elemento=<?=$value['elemento_id']?>">
                                                <i class="fa fa-share-square-o icono-accion tip" data-original-title="Tamaños"></i>
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