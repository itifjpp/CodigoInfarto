<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px;color:#2196F3">
            <li><a href="<?= base_url()?>Ensat/Resultados">ENCUESTAS</a></li>
            <li><a href="<?= base_url()?>Ensat/Resultados?enc=<?=$pregunta['encuesta_id']?>&tipo=Preguntas">PREGUNTAS</a></li>
            <li><a href="#">RESULTADOS DE PREGUNTAS</a></li>
        </ol> 
        <div class="box-inner col-md-10 col-centered" style="margin-top: 50px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><b>PREGUNTA:</b> <?=$pregunta['pregunta_nombre']?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss border-back-imss">
                                        <i class="fa fa-calendar color-white"></i>
                                    </span>
                                    <input type="text" class="dp-yyyy-mm-dd form-control" name="inputFecha" value="<?=$_GET['inputFecha']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss border-back-imss">
                                        <i class="fa fa-calendar color-white"></i>
                                    </span>
                                    <select class="form-control" name="inputTurno">
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="preg" value="<?=$_GET['preg']?>">
                                <input type="hidden" name="tipo" value="<?=$_GET['tipo']?>">
                                <button class="btn back-imss btn-block">Graficar</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <?php if(isset($_GET['inputFecha'])){?>
                        <div class="col-md-12 load-graficas">
                            <center>
                                <i class="fa fa-spinner fa-pulse fa-4x"></i><br>
                                <h5>GRAFICANDO RESULTADOS DE LA PREGUNTA</h5>
                            </center>
                        </div>
                        <div class="col-md-12 hide GraficaResultadosEncuestas">
                            <canvas id="GraficaResultadosEncuestas" style="height: 250px"></canvas>
                        </div>
                        <?php }?>
                        <div class="col-md-12">
                            
                            <?php 
                            if(isset($_GET['inputFecha'])){
                                $inputTurno=$_GET['inputTurno'];
                                $inputFecha=$_GET['inputFecha'];
                                
                                foreach ($Respuestas as $value) {
                                    $Res=$value['respuesta_id'];
                                    $sqlTotal=$this->config_mdl->sqlQuery("SELECT result.resultado_id FROM um_ensat_encuestas_resultados result 
                                                                            INNER JOIN um_ensat_encuesta_preg_res res
                                                                            ON (
                                                                                                res.respuesta_id=result.respuesta_id AND 
                                                                                                res.respuesta_id=$Res AND 
                                                                                                result.resultado_turno='$inputTurno' AND 
                                                                                                result.resultado_fecha='$inputFecha' 
                                                                                 )");    
                            ?>
                                    <div class="respuesta_resultados" data-respuesta="<?=$value['respuesta_nombre']?>" data-value="<?=count($sqlTotal)?>"></div>
                            <?php 
                            }
                            }?>
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
<script src="<?= base_url('assets/js/Ensat.js?').md5(microtime())?>" type="text/javascript"></script>