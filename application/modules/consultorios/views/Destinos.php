<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary" >
                        <h4 class="color-white semi-bold ">DESTINOS</h4>
                        <a href="#" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right btn-add-dest" data-id="0" data-destino="" data-action="add">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#filter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 90%">Destino</th>
                                            <th style="width: 10%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['destino_nombre']?></td>
                                            <td>
                                                <i class="fa fa-pencil pointer sigh-color i-20 btn-add-dest" data-id="<?=$value['destino_id']?>" data-destino="<?=$value['destino_nombre']?>" data-action="edit"></i>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 destino-eliminar pointer" data-id="<?=$value['destino_id']?>"></i>
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
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Consultorios.js?time=<?= md5(microtime())?>"></script>