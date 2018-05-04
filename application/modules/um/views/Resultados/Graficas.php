<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px;color:#2196F3">
            <li><a href="<?= base_url()?>Um/Encuestas/Resultados">ENCUESTAS</a></li>
            <li><a href="<?= base_url()?>Um/Encuestas/Resultados?enc=<?=$pregunta['encuesta_id']?>&tipo=Preguntas">PREGUNTAS</a></li>
            <li><a href="#">RESULTADOS DE PREGUNTAS</a></li>
        </ol> 
        <div class="box-inner col-md-10 col-centered" style="margin-top: 50px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><b>PREGUNTA:</b> <?=$pregunta['pregunta_nombre']?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12 load-graficas">
                            <center>
                                <i class="fa fa-spinner fa-pulse fa-4x"></i><br>
                                <h5>GRAFICANDO RESULTADOS DE LA PREGUNTA</h5>
                            </center>
                        </div>
                        <div class="col-md-12 hide GraficaResultadosEncuestas">
                            <canvas id="GraficaResultadosEncuestas" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-12">
                            <?php foreach ($Respuestas as $value) {
                            $Res=$value['respuesta_id'];
                            $sqlTotal=$this->config_mdl->sqlQuery("SELECT result.resultado_id FROM um_encuestas_resultados result 
                                                                    INNER JOIN um_encuestas_preguntas_respuestas res
                                                                    ON (res.respuesta_id=result.respuesta_id AND res.respuesta_id=$Res)");    
                            ?>
                            <div class="respuesta_resultados" data-respuesta="<?=$value['respuesta_nombre']?>" data-value="<?=count($sqlTotal)?>"></div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="GraficasEncuestas" value="Si">
<input type="hidden" name="Pregunta" value="<?=$pregunta['pregunta_id']?>">
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/UnidadMedica.js?').md5(microtime())?>" type="text/javascript"></script>