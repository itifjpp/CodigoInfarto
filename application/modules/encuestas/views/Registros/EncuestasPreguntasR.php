<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="<?= base_url()?>Encuestas">ENCUESTAS</a></li>
            <li><a href="<?= base_url()?>Encuestas/EncuestaPreguntas?enc=<?=$_GET['enc']?>">PREGUNTAS</a></li>
            <li><a href="$">RESPUESTAS</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">RESPUESTAS</h4>
                        <a href="#" md-ink-ripple="" class="md-btn md-fab m-b red pull-right enc-preg-res-action" data-id="0" data-respuesta="" data-valor="" data-pregunta="<?=$_GET['preg']?>" data-action="add">
                            <i class="material-icons i-24 color-white ">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th style="width: 85%">RESPUESTAS</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>

                                        <tr id="<?=$value['pregunta_id']?>">
                                            <td><?=$value['respuesta_nombre']?></td>
                                            <td class="text-center">
                                                <?php if($value['encuesta_tipo']=='EVALUACIÓN'){?>
                                                <a href="<?= base_url()?>Encuestas/PreguntasRespuestas?enc=<?=$value['encuesta_id']?>&preg=<?=$value['pregunta_id']?>">
                                                    <i class="fa fa-pencil-square-o sigh-color i-20 tip" data-original-title="Agregar Respuestas"></i>
                                                </a>
                                                <?php }?>
                                                <i class="fa fa-pencil sigh-color i-20 pointer tip ensat-enc-preg-add-edit" data-original-title="Edicar Pregunta" data-id="<?=$value['pregunta_id']?>" data-pregunta="<?=$value['pregunta_nombre']?>" data-encabezado="<?=$value['pregunta_encabezado']?>" data-encuesta="<?=$_GET['enc']?>"  data-action="edit"></i>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 pointer tip del-area" data-original-title="Eliminar Pregunta" data-id="<?=$value['area_id']?>"></i>
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