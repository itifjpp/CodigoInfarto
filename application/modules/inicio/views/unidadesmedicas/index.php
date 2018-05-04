<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">UNIDADES MÉDICAS</span>
                    <a href="<?=  base_url()?>inicio/unidadesmedicas/add/0" target="_blank" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <table class="table m-b-none" ui-jp="footable" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                    <thead>
                        <tr>
                            <th data-sort-ignore="true">Tipo</th>
                            <th data-sort-ignore="true">Unidad Médica</th>
                            <th data-sort-ignore="true">N° Unidad</th>
                            <th data-sort-ignore="true">Nivel</th>
                            <th data-sort-ignore="true">Titular</th>
                            
                            <th data-sort-ignore="true">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($Gestion as $value) {?>
                        <tr id="<?=$value['unidadmedica_id']?>">
                            <td><?=$value['unidadmedica_tipo']?></td>
                            <td><?=$value['unidadmedica_nombre']?> </td>
                            <td><?=$value['unidadmedica_num']?></td>
                            <td><?=$value['unidadmedica_nivel']?></td>
                            <td><?=$value['unidadmedica_titular']?></td>
                            <td>
                                <a href="<?=  base_url()?>inicio/unidadesmedicas/add/<?=$value['unidadmedica_id']?>" target="_blank">
                                    <i class="fa fa-pencil icono-accion"></i>
                                </a>
                            </td>
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
<?= modules::run('Sections/Menu/footer'); ?>