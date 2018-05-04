<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple ">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">AREAS DE ACCESO</h4>
                        <a md-ink-ripple="" class="md-btn btn-add md-fab m-b red waves-effect pull-right">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b ">
                                    <span class="input-group-addon sigh-background-secundary no-border" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <table class="table footable table-bordered table-no-padding" data-filter="#filter" data-page-size="6">
                                    <thead>
                                        <tr>
                                            <th style="width: 6%">N°</th>
                                            <th style="width: 35%">ÁREA DE ACCESO</th>
                                            <th style="width: 25%">ROL PERTENECIENTE</th>
                                            <th style="width: 14%">ESTATUS</th>
                                            <th style="width: 20%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($Gestion as $value) {?>
                                        <tr id="<?=$value['areas_acceso_id']?>">
                                            <td><?=$value['areas_acceso_id']?></td>
                                            <td><?=$value['areas_acceso_nombre']?></td>
                                            <td><?=$value['rol_nombre']?></td>
                                            <td>
                                                <?php if($value['areas_acceso_status']=='hidden'){?>
                                                No Disponible
                                                <?php }else{?>
                                                Disponible
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if($value['areas_acceso_status']=='hidden'){?>
                                                <i class="fa fa-check sigh-color i-20 pointer tip available-not-available-access" data-id="<?=$value['areas_acceso_id']?>" data-accion="" data-original-title="Mostrar esta área de acceso"></i>&nbsp;
                                                <?php }else{?>
                                                <i class="fa fa-times sigh-color i-20 pointer tip available-not-available-access" data-id="<?=$value['areas_acceso_id']?>" data-accion="hidden" data-original-title="Ocultar esta área de acceso"></i>&nbsp;
                                                <?php }?>
                                                <i data-id="<?=$value['areas_acceso_id']?>" class="tip fa fa-pencil pointer sigh-color i-20"></i>&nbsp&nbsp
                                                <i data-id="<?=$value['areas_acceso_id']?>" class="tip fa fa-trash-o pointer sigh-color i-20"></i>
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
<input type="hidden" name="SiGH_OBSERVACION_ENFERMERIA" value="<?=SiGH_OBSERVACION_ENFERMERIA?>">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Areasacceso.js?'). md5(microtime())?>" type="text/javascript"></script>