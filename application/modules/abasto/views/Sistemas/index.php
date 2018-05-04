<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered" style="margin-top: 10px"> 
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>SISTEMAS</strong><br>
                    </span>
                    <a href="#" onclick="AbrirVista(base_url+'Abasto/Sistemas/NuevoSistema?sistema=0&accion=add',600,600)" class="md-btn md-fab m-b red waves-effect pull-right tip ">
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
                                    <input type="text" name="sistema_id" class="form-control" placeholder="Buscar Sistema...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-hover table-bordered footable table-no-padding" data-page-size="4" data-filter="#sistema_id" style="font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th>SISTEMA</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th style="width: 20%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['sistema_titulo']?></td>
                                            <td>
                                                <span class="tip pointer" data-original-title="<?=$value['sistema_descripcion']?>"><?= substr($value['sistema_descripcion'], 0,90)?>... </span>
                                            </td>
                                            <td>
                                                <i class="fa fa-image i-16 icono-accion view-image pointer" data-image="<?= base_url()?>assets/materiales/<?=$value['sistema_img']?>"></i>&nbsp;
                                                <a onclick="AbrirVista(base_url+'Abasto/Sistemas/NuevoSistema?sistema=<?=$value['sistema_id']?>&accion=edit',600,600)" href="#">
                                                    <i class="fa fa-pencil i-20 color-imss "></i>
                                                </a>&nbsp;
                                                <a href="<?= base_url()?>Abasto/Sistemas/Elementos?sistema=<?=$value['sistema_id']?>">
                                                    <i class="fa fa-window-restore i-20 color-imss tip" data-original-title="Agregar Elementos"></i>
                                                </a>&nbsp;
                                                <?php if($value['sistema_status'] != 1) {?>
                                                <i class="fa fa-trash-o i-20 pointer color-imss abs-sistema-eliminar" data-id="<?=$value['sistema_id']?>" ></i>
                                                <?php } ?>
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
<script src="<?= base_url('assets/js/Abasto/AbsSistemas.js?').md5(microtime())?>" type="text/javascript"></script>