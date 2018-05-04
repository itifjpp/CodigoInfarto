<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-top: -10px;">
            <li>
                <a href="#">INICIO</a>
            </li>
            <li>
                <a href="<?= base_url()?>Areas">AREAS</a>
            </li>
            <li><a href="#" class="">AGREGAR CAMAS</a> </li>
        </ul>
        <div class="row m-t-10">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">Gestión de camas del área de : <b><?=$info['area_nombre']?></b></h4>
                        <a href="#"  md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right add-cama-area" data-area="<?=$this->uri->segment(3)?>">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon no-border sigh-background-secundary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-striped table-no-padding"  data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th data-sort-ignore="true">N°</th>
                                            <th data-sort-ignore="true">CAMA</th>
                                            <th data-sort-ignore="true">AISLADO</th>
                                            <th data-sort-ignore="true" class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>

                                        <tr id="<?=$value['cama_id']?>">
                                            <td><?=$value['cama_id']?></td>
                                            <td><?=$value['cama_nombre']?> </td>
                                            <td><?=$value['cama_aislado']='' ? 'N/E' : $value['cama_aislado']?> </td>
                                            <td class="text-center">
                                                <i class="fa fa-pencil i-20 sigh-color pointer edit-cama" data-id="<?=$value['cama_id']?>" data-genero="<?=$value['cama_genero']?>" data-cama="<?=$value['cama_nombre']?>" data-aislado="<?=$value['cama_aislado']?>" data-area="<?=$value['area_id']?>"></i>&nbsp;
                                                <i class="fa fa-trash-o i-20 sigh-color pointer del-cama" data-id="<?=$value['cama_id']?>"></i>
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
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/areas/areas.js?').md5(microtime())?>" type="text/javascript"></script>