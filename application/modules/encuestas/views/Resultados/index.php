<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px;color:#2196F3">
            <li><a href="<?= base_url()?>Ensat/Resultados">ENCUESTAS</a></li>
            <?php if(isset($_GET['tipo'])){?>
            <li><a href="<?= base_url()?>Ensat/Resultados?enc=<?=$_GET['enc']?>&tipo=Preguntas">PREGUNTAS</a></li>
            <?php }?>
        </ol> 
        <div class="box-inner col-md-10 col-centered" style="margin-top: 50px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><?=!isset($_GET['tipo']) ? 'ENCUESTAS': 'PREGUNTAS'?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered footable table-striped table-no-padding" data-limit-navigation="7" data-filter="#filter" data-page-size="5">
                                <thead>
                                    <tr>
                                        <th>NOMBRE DE LA ENCUESTA</th>
                                        <?= isset($_GET['tipo'])? '<th>PREGUNTA</th>': ''?>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>

                                    <tr id="<?=$value['encuesta_id']?>">
                                        <td><?=$value['encuesta_nombre']?></td>
                                        <?= isset($_GET['tipo'])? '<td>'.$value['pregunta_nombre'].'</td>': ''?>
                                        <td class="text-center">
                                            <?php if(!isset($_GET['tipo'])){?>
                                            <a href="<?=  base_url()?>Ensat/Resultados?enc=<?=$value['encuesta_id']?>&tipo=Preguntas">
                                                <i class="fa fa-pencil-square-o tip i-20 color-imss" data-original-title="Preguntas"></i>
                                            </a>
                                            <?php }else{?>
                                            <a href="<?= base_url()?>Ensat/PreguntasGraficas?preg=<?=$value['pregunta_id']?>&tipo=Preguntas">
                                                <i class="fa fa-bar-chart-o color-imss i-20 tip" data-original-title="Graficas"></i>
                                            </a>
                                            <?php }?>
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