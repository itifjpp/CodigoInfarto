<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/CatalogoPrincipalConsumo">Mínima Invasión</a></li>
                <li><a style="text-transform: uppercase" href="#">Categorías</a></li>
            </ol>
                <div class="card back-imss">
                    <div class="lt p text-center">
                        <h3 style="margin-top: 0px;margin-bottom: 0px">
                            CATEGOR&Iacute;AS
                        </h3>
                    </div>
                </div>
                <a style="margin-top: -60px;" href="<?=  base_url()?>Abasto/MinimaInvacion/NuevaCategoria?accion=add&name=<?= $_GET['name']?>" target="_blank" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Nueva Categoria">
                    <i class="mdi-content-add i-24" ></i>
                </a>
            <?php 
            If($_GET['name']=='instrumental') {
                foreach ($TOTAL_INS AS $value) { ?>

                <div class="col-md-4">
                    <div class="card">
                        <ul class="nav nav-sm navbar-tool pull-right">
                            <li class="dropdown">
                                <a md-ink-ripple data-toggle="dropdown">
                                    <i class="mdi-navigation-more-vert i-24"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-scale pull-up pull-bottom pull-right text-color">
                                    <?php if($value['categoria_status'] != 1) {?>
                                    <li class="eliminar-categoria" data-id_categoria="<?=$value['categoria_id']?>" data-nombre_categoria="<?= $value['categoria_nombre']?>">
                                        <a href="#">
                                            <i class="fa fa-trash-o i-16 icono-accion"></i>&nbsp;&nbsp;Eliminar
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <li class="editar-categoria">
                                        <a href="<?=  base_url()?>Abasto/MinimaInvacion/NuevaCategoria?accion=edit&name=<?= $_GET['name']?>&id_categoria=<?=$value['categoria_id']?>" target="_blank">
                                            <i class="fa fa-edit i-16 icono-accion"></i>&nbsp;&nbsp;Editar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <a href="<?= base_url()?>Abasto/MinimaInvacion/Charolas?name=<?= $_GET['name']?>&categoria_id=<?= $value['categoria_id']?>">
                            <div class="lt p text-center">
                                <h4><?= $value['categoria_nombre']?></h4>
                                <p><?= substr($value['categoria_descripcion'],0, 40)?>...</p>
                            </div>
                        </a>
                    </div>
                </div>

            <?php }
            } else if($_GET['name']=='equipamiento'){
                foreach ($TOTAL_INS AS $value) {
            ?>
                <div class="col-md-4">
                    <div class="card">
                        <ul class="nav nav-sm navbar-tool pull-right">
                            <li class="dropdown">
                                <a md-ink-ripple data-toggle="dropdown">
                                    <i class="mdi-navigation-more-vert i-24"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-scale pull-up pull-bottom pull-right text-color">
                                    <?php if($value['categoria_status'] != 1) {?>
                                    <li class="eliminar-categoria" data-id_categoria="<?=$value['categoria_id']?>" data-nombre_categoria="<?= $value['categoria_nombre']?>">
                                        <a href="#">
                                            <i class="fa fa-trash-o i-16 icono-accion"></i>&nbsp;&nbsp;Eliminar
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <li class="editar-categoria">
                                        <a href="#">
                                            <i class="fa fa-edit i-16 icono-accion"></i>&nbsp;&nbsp;Editar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <a href="<?= base_url()?>Abasto/MinimaInvacion/ConsumoTotalEqui?name=<?= $_GET['name']?>&categoria_id=<?= $value['categoria_id']?>">
                            <div class="lt p text-center">
                                <h4><?= $value['categoria_nombre']?></h4>
                                <p><?= substr($value['categoria_descripcion'],0, 40)?>...</p>
                            </div>
                        </a>
                    </div>
                </div>

            <?php } } ?>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>

