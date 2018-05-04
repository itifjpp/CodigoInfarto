<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb" style="margin-top: -20px">
                <li><a style="text-transform: uppercase" href="#">Inicio</a></li>
                <li><a style="text-transform: uppercase" href="<?=  base_url()?>Abasto/Inventario"><?=$material['catalogo_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Inventario/Sistemas?catalogo=<?=$_GET['catalogo']?>"><?=$sistema['sistema_titulo']?></a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Inventario/Elementos?catalogo=<?=$_GET['catalogo']?>&sistema=<?=$_GET['sistema']?>"><?= substr($elemento['elemento_titulo'], 0,15)?>...</a></li>
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/Inventario/Rangos?catalogo=<?=$_GET['catalogo']?>&sistema=<?=$_GET['sistema']?>&elemento=<?=$_GET['elemento']?>"><?= substr($elemento['elemento_titulo'], 0,15)?>...</a></li>
                <li><a style="text-transform: uppercase" href="#">Existencia</a></li>
            </ol>
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>EXISTENCIAS</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="sistema_id" class="form-control" placeholder="Buscar ...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable" data-page-size="10" data-filter="#sistema_id" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th style="width: 60%">ELEMENTO</th>
                                        <th style="width: 15%">RANGOS</th>
                                        <th>ESTATUS</th>                                        
                                        <th>ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <td><?=$value['rango_titulo']?></td>
                                        <td>
                                            <?php if($value['existencia_status']=='Disponible'){?>
                                            <span class="label green">Disponible&nbsp;</span>
                                            <?php }else{?>
                                            <span class="label red">Consumido</span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <i class="fa fa-barcode icono-accion pointer" onclick="AbrirDocumento(base_url+'Abasto/Inventario/GenerarCodigo/'+<?=$value['existencia_id']?>)"></i>
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