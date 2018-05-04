<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500">Menu Nivel 3</span>
                        <a class="md-btn md-fab m-b green waves-effect btn-add-mn3 pull-right" data-id="<?=$_GET['m']?>">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control " id="filter" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <table id="ver-tabla-cirugias" class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="15">
                            <thead>
                                <tr>
                                    <th data-hide="all">Menu Nivel 2</th>
                                    <th>Menu Nivel 3</th>
                                    <th>Url</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['menuN3_id']?>" >
                                    <td><?=$value['menuN2_menu']?> </td>
                                    <td><?=$value['menuN3_menu']?></td>
                                    <td><?=$value['menuN3_url']?></td>
                                    <td class="text-center ">
                                        <button  class="btn btn-xs blue waves-effect color-white btn-edit-mn3" data-id="<?=$value['menuN3_id']?>">Editar</button>
                                        <button class="btn btn-xs red waves-effect btn-delete-mn3 color-white" data-id="<?=$value['menuN3_id']?>">Eliminar</button>
                                    </td>
                                </tr>
                            <?php }?>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Menus.js?'). md5(microtime())?>" type="text/javascript"></script>