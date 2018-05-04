<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="<?= base_url()?>Encuestas">ENCUESTAS</a></li>
            <li><a href="#">CONFIGURACIÓN DE RESPUESTAS</a></li>
        </ol> 
        <div class="row m-t-10">
            <div class="col-md-7 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white semi-bold">RESPUESTAS</h4>
                        <a href="#" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right" onclick="AbrirVista(base_url+'Encuestas/EncuestaRespuesta?encuesta=<?=$_GET['encuesta']?>&respuesta=0&action=add',500,400)">
                            <i class="material-icons i-24 color-white">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th>RESPUESTA</th>
                                            <th>VALOR</th>
                                            <th>ICONO</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Respuestas as $value) {?>

                                        <tr id="<?=$value['encuesta_id']?>">
                                            <td><?=$value['respuesta_nombre']?></td>
                                            <td><?=$value['respuesta_valor']?></td>
                                            <td><img  src="<?= base_url()?>assets/img/emoji/<?=$value['respuesta_icon']?>" style="width:25px;margin-top: -5px"></td>
                                            <td class="text-center">
                                                <i class="fa fa-pencil i-20 sigh-color pointer" onclick="AbrirVista(base_url+'Encuestas/EncuestaRespuesta?encuesta=<?=$_GET['encuesta']?>&respuesta=<?=$value['respuesta_id']?>&action=edit',500,400)"></i>&nbsp;
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