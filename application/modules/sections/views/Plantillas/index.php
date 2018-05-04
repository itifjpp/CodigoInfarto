<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">Plantillas</h4>
                        <a  href="" md-ink-ripple="" class="btn sigh-background-primary waves-effect pull-right add-plantilla" style="margin-top: -10px;margin-right: -10px">
                            <i class="material-icons i-24 color-white">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 0px">
                                <table class="table footable table-bordered table-no-padding" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th >N°</th>
                                            <th >PLANTILLA</th>
                                            <th style="width: 20%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach ($Gestion as $value) { $i++?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$value['plantilla_nombre']?></td>
                                            <td>
                                                <a href="<?=  base_url()?>Sections/Plantillas/Contenidos/<?=$value['plantilla_id']?>/?limit=<?=$value['plantilla_limit']?>" >
                                                    <i class="fa fa-plus i-20 sigh-color tip" data-original-title="Agregar Contenido"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-pencil i-20 sigh-color edit-plantilla pointer" data-id="<?=$value['plantilla_id']?>" data-nombre="<?=$value['plantilla_nombre']?>"></i>&nbsp;
                                                <i class="fa fa-trash-o i-20 sigh-color pointer eliminar-plantilla" data-id="<?=$value['plantilla_id']?>"></i>

                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="5" class="text-center">
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
<script src="<?= base_url()?>assets/js/sections/Plantillas.js?date=<?= date('YmdHis')?>" type="text/javascript"></script>