<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered" style="margin-top: -20px"> 
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Gestión de Áreas</span>
                    <a href="#"   md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right add-area">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" name="" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table footable table-bordered table-hover" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-sort-ignore="true">N°</th>
                                        <th data-sort-ignore="true">Área</th>
                                        <th data-sort-ignore="true">Tipo</th>
                                        <th data-sort-ignore="true">Camas</th>
                                        <th data-sort-ignore="true" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>

                                    <tr id="<?=$value['area_id']?>">
                                        <td><?=$value['area_id']?></td>
                                        <td><?=$value['area_nombre']?> </td>
                                        <td><?=$value['area_tipo']?> </td>
                                        <td>
                                            <?php if($value['area_camas']=='Si'){?>
                                            <?= Modules::run('Pisos/Areas/TotalCama',array('area_id'=>$value['area_id']))?> Camas
                                            <?php }else{?>
                                            No Aplica
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?=  base_url()?>Pisos/Areas/GestionCamas/<?=$value['area_id']?>" target="_blank">
                                                <i class="fa fa-bed tip icono-accion" data-original-title="Agregar Camas"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-pencil icono-accion pointer edit-area" data-id="<?=$value['area_id']?>" data-area="<?=$value['area_nombre']?>" data-cama="<?=$value['area_camas']?>" data-tipo="<?=$value['area_tipo']?>"></i>&nbsp;
                                            <i class="fa fa-trash-o icono-accion pointer del-area" data-id="<?=$value['area_id']?>"></i>
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
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/PisosAreas.js?').md5(microtime())?>" type="text/javascript"></script>