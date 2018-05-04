<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-11 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white semi-bold">ENCUESTAS</h4>
                        <a href="<?= base_url()?>Encuestas/Encuesta?encuesta=0&action=add" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right">
                            <i class="material-icons i-24 color-white">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th>N</th>
                                            <th>NOMBRE DE LA ENCUESTA</th>
                                            <th>TIPO DE ENCUESTA</th>
                                            <th>ESTADO</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>

                                        <tr id="<?=$value['encuesta_id']?>">
                                            <td><?=$value['encuesta_id']?></td>
                                            <td><?=$value['encuesta_nombre']?></td>
                                            <td><?=$value['encuesta_tipo']?></td>
                                            <td><?=$value['encuesta_estado']?></td>
                                            <td class="text-center">
                                                <a href="<?=  base_url()?>Encuestas/EncuestaPreguntas?enc=<?=$value['encuesta_id']?>">
                                                    <i class="fa fa-list tip i-20 sigh-color" data-original-title="Agregar Preguntas"></i>
                                                </a>&nbsp;
                                                
                                                <?php if($value['encuesta_estado'] == 'true') {?>
                                                <i class="fa fa-times i-20 sigh-color pointer del-area cambiar-estado-encuesta tip" data-id="<?=$value['encuesta_id']?>" data-estado="false" data-original-title="No Publicar Esta Encuesta"></i>&nbsp;
                                                <?php }else {?>
                                                <i class="fa fa-check i-20 sigh-color pointer del-area cambiar-estado-encuesta tip" data-id="<?=$value['encuesta_id']?>" data-estado="true" data-original-title="Publicar Esta Encuesta"></i>&nbsp;
                                                <?php } ?>
                                                
                                                <?php if($value['encuesta_tipo']=='SATISFACCIÓN'){?>
                                                <a href="<?= base_url()?>Encuestas/EncuestasAreas?enc=<?=$value['encuesta_id']?>">
                                                    <i class="fa fa-window-restore sigh-color i-20 tip" data-original-title="Agregar Áreas"></i>
                                                </a>&nbsp;
                                                <a href="<?= base_url()?>Encuestas/ConfiguracionEncuesta?encuesta=<?=$value['encuesta_id']?>">
                                                    <i class="fa fa-pencil-square-o i-20 tip sigh-color pointer" data-original-title="Configuración General de la Encuesta" data-id="<?=$value['encuesta_id']?>"></i>
                                                </a>
                                                <?php }else{?>
                                                <i class="fa fa-window-restore sigh-color i-20 no-accion"></i>&nbsp;
                                                <i class="fa fa-pencil-square-o i-20 no-accion"></i>
                                                <?php }?>
                                                <a href="<?= base_url()?>Encuestas/Encuesta?encuesta=<?=$value['encuesta_id']?>&action=edit">
                                                    <i class="fa fa-pencil i-20 sigh-color pointer tip" data-original-title="Editar Encuesta"></i>
                                                </a>
                                                &nbsp;
                                                <i class="fa fa-trash-o i-20 sigh-color pointer tip del-area eliminar_encuesta" data-original-title="Eliminar Encuesta" data-id="<?=$value['encuesta_id']?>"></i>
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
<script src="<?= base_url('assets/js/Encuestas.js?').md5(microtime())?>" type="text/javascript"></script>