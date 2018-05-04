<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Gestión de Pisos</span>
                    </div>
                    <div class="panel-body b-b b-light">
                        
                        <table class="table table-bordered table-hover footable"  data-filter="#filter" data-page-size="15">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Piso</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['piso_id']?>" >
                                    <td><?=$value['piso_id']?> </td>
                                    <td><?=$value['piso_nombre']?></td>
                                    <td class="text-center ">
                                        <a href="<?=  base_url()?>Sections/Pisos/AsignarCamas/<?=$value['piso_id']?>" target="_blank">
                                            <i class="fa fa-plus-circle icono-accion tip" data-original-title="Asignar Camas"></i>
                                        </a>&nbsp;
                                        <i class="fa fa-pencil icono-accion pointer" style="opacity: 0.4"></i>&nbsp;
                                        <i class="fa fa-trash-o icono-accion pointer" style="opacity: 0.4"></i>
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