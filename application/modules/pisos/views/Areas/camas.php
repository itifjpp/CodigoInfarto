<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered" style="margin-top: -20px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Gestión de camas del área de :<b><?=$info['area_nombre']?></b></span>
                    <a href="#"  md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right add-cama-area" data-area="<?=$this->uri->segment(3)?>">
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
                            <table class="table table-bordered table-hover footable"  data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-sort-ignore="true">N°</th>
                                        <th data-sort-ignore="true">Cama</th>
                                        <th data-sort-ignore="true">Aislado</th>
                                        <th>Para</th>
                                        <th data-sort-ignore="true" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>

                                    <tr id="<?=$value['cama_id']?>">
                                        <td><?=$value['cama_id']?></td>
                                        <td><?=$value['cama_nombre']?> </td>
                                        <td><?=$value['cama_aislado']='' ? 'N/E' : $value['cama_aislado']?> </td>
                                        <td><?=$value['cama_genero']?></td>
                                        <td class="text-center">
                                            <i class="fa fa-pencil icono-accion pointer edit-cama" data-id="<?=$value['cama_id']?>" data-genero="<?=$value['cama_genero']?>" data-cama="<?=$value['cama_nombre']?>" data-aislado="<?=$value['cama_aislado']?>" data-area="<?=$value['area_id']?>"></i>&nbsp;
                                            <i class="fa fa-trash-o icono-accion pointer del-cama" data-id="<?=$value['cama_id']?>"></i>
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