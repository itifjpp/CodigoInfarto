<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white semi-bold">GESTIÓN DE ÁREAS OBSERVACIÓN, CORTA ESTANCIA, PISOS, CHOQUE</h4>
                        <a href="#" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right" onclick="AbrirVista(base_url+'Areas/AgregarArea?area=0&accion=add',500,500)">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">N°</th>
                                            <th style="width: 30%">ÁREA</th>
                                            <th style="width: 30%">MODULO</th>
                                            <th style="width: 15%" >CAMAS</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>

                                        <tr id="<?=$value['area_id']?>">
                                            <td><?=$value['area_id']?></td>
                                            <td><?=$value['area_nombre']?></td>
                                            <td><?=$value['area_modulo']?> </td>
                                            <td>
                                                <?php if($value['area_camas']=='Si'){?>
                                                <b><?php echo  Modules::run('areas/TotalCama',array('area_id'=>$value['area_id']))?></b> Camas
                                                <?php }else{?>
                                                No Aplica
                                                <?php }?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?=  base_url()?>areas/GestionCamas/<?=$value['area_id']?>">
                                                    <i class="fa fa-bed tip i-20 sigh-color" data-original-title="Agregar Camas"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-pencil i-20 sigh-color pointer" onclick="AbrirVista(base_url+'Areas/AgregarArea?area=<?=$value['area_id']?>&accion=edit',500,500)"></i>&nbsp;
                                                <i class="fa fa-trash-o i-20 sigh-color pointer del-area" data-id="<?=$value['area_id']?>"></i>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
<script src="<?= base_url('assets/js/areas/areas.js?').md5(microtime())?>" type="text/javascript"></script>