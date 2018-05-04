<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px;color:#2196F3">
            <li><a href="<?= base_url()?>Um/Encuestas">ENCUESTAS</a></li>
            <li><a href="<?= base_url()?>Um/Encuestas/EncuestaPreguntas?enc=<?=$_GET['enc']?>">PREGUNTAS</a></li>
        </ol> 
        <div class="box-inner col-md-12 col-centered" style="margin-top: 50px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">GESTIÓN PREGUNTAS</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right um-enc-preg-add-edit" data-id="0" data-pregunta="" data-enc="<?=$_GET['enc']?>" data-accion="add">
                        <i class="mdi-av-my-library-add i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>NOMBRE DE LA ENCUESTA</th>
                                        <th>PREGUNTA</th>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>

                                    <tr id="<?=$value['pregunta_id']?>">
                                        <td><?=$value['pregunta_id']?></td>
                                        <td><?=$value['encuesta_nombre']?></td>
                                        <td><?=$value['pregunta_nombre']?></td>
                                        <td class="text-center">
                                            <a href="<?=  base_url()?>Um/Encuestas/EncuestaPreguntasRespuetas?pregunta=<?=$value['pregunta_id']?>&enc=<?=$_GET['enc']?>">
                                                <i class="fa fa-pencil-square-o tip color-imss i-20" data-original-title="Agregar Respuestas"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-pencil color-imss i-20 pointer um-enc-preg-add-edit" data-id="<?=$value['pregunta_id']?>" data-pregunta="<?=$value['pregunta_nombre']?>" data-enc="<?=$_GET['enc']?>"  data-accion="edit"></i>&nbsp;
                                            <i class="fa fa-trash-o color-imss i-20 pointer um-enc-preg-del" data-id="<?=$value['pregunta_id']?>"></i>
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
<script src="<?= base_url('assets/js/UnidadMedica.js?').md5(microtime())?>" type="text/javascript"></script>