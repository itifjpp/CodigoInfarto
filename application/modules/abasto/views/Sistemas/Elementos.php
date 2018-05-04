<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb">
            <li><a href="<?= base_url()?>Abasto/Sistemas">Sistemas</a></li>
            <li><?=$Sistema['sistema_titulo']?></li>
            <li>Elementos</li>
        </ol>
        <div class="box-inner col-md-12 col-centered" style="margin-top: 40px"> 
            
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;">
                        GESTIÓN DE ELEMENTOS
                    </span>
                    <a href="#" onclick="AbrirVista(base_url+'Abasto/Sistemas/NuevoElemento?sistema=<?=$_GET['sistema']?>&elemento=0&accion=add',600,600)" class="md-btn md-fab m-b red waves-effect pull-right tip">
                        <i class="mdi-av-my-library-add i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">  
                    <div class="row">
                        <div class="col-md-7" >
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss no-border">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" id="elemento_id" class="form-control" placeholder="Buscar Elemento">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable table-no-padding" data-page-size="4" data-filter="#elemento_id" >
                                <thead>
                                    <tr>
                                        <th>SISTEMA</th>
                                        <th>ELEMENTO</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th style="width: 15%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['sistema_titulo']?></td>
                                        <td><?=$value['elemento_titulo']?></td>
                                        <td>
                                            <span class="tip pointer" data-original-title="<?=$value['elemento_descripcion']?>"><?= substr($value['elemento_descripcion'], 0,30)?>... </span>
                                        </td>
                                        <td>
                                            <i class="fa fa-image i-16 icono-accion view-image pointer" data-image="<?= base_url()?>assets/materiales/<?=$value['elemento_img']?>"></i>&nbsp;
                                            <a href="#" onclick="AbrirVista(base_url+'Abasto/Sistemas/NuevoElemento?sistema=<?=$_GET['sistema']?>&elemento=<?=$value['elemento_id']?>&accion=edit',600,600)">
                                                <i class="fa fa-pencil i-20 color-imss" ></i>
                                            </a>&nbsp;
                                            <a href="<?= base_url()?>Abasto/Sistemas/Rangos?sistema=<?=$value['sistema_id']?>&elemento=<?=$value['elemento_id']?>">
                                                <i class="fa fa-sort-numeric-asc i-20 color-imss tip" data-original-title="Agregar Rangos"></i>
                                            </a>&nbsp;
                                            <?php if($value['elemento_status'] != 1) {?>
                                            <i class="fa fa-trash-o i-20 color-imss pointer abs-elemento-eliminar" data-id="<?=$value['elemento_id']?>"></i>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php }?>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Abasto/AbsSistemas.js?').md5(microtime())?>" type="text/javascript"></script>