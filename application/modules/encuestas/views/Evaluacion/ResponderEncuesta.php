<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row margin-top-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary" >
                <h2 class="color-white no-margin semi-bold text-center"><?=$this->sigh->getInfo('hospital_siglas_des')?> </h2>
                <h2 class="color-white m-t-10 text-center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></h2>
            </div>
            <div class="grid-body">
                <?php if(!empty($Encuesta)){?>
                <form class="ensat-evaluacion" method="GET">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                <h2 class="text-uppercase semi-bold line-height"><i class="fa fa-pencil-square-o"></i> <?=$Encuesta[0]['encuesta_nombre']?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php 
                        $Preguntas=$this->config_mdl->sqlGetDataCondition('sigh_encuestas_preg',array(
                            'encuesta_id'=>$Encuesta[0]['encuesta_id']
                        ));
                        $i=0;
                        foreach ($Preguntas as $preg) {
                            $i++;
                        ?>
                        <div class="col-md-12 col_pregunta<?=$preg['pregunta_id']?>">
                            <div class="form-group">
                                <h3 class="line-height" ><?=$i?>.- <?=$preg['pregunta_nombre']?></h3>
                                <div class="row">
                                    <?php 
                                    $Respuesta=$this->config_mdl->sqlQuery('SELECT * FROM sigh_encuestas_respuestas AS res, sigh_encuestas_preg_res AS preg
                                                                            WHERE res.respuesta_id = preg.respuesta_id
                                                                            AND preg.pregunta_id ='.$preg['pregunta_id']);
                                    foreach ($Respuesta as $resp) {
                                    ?>
                                    <div class="col-sm-2 text-center " >
                                        <img src="<?= base_url()?>assets/img/emoji/<?=$resp['respuesta_icon']?>" class="input-encuesta-satisfaccion" data-value="<?=$Encuesta[0]['encuesta_id']?>;<?=$preg['pregunta_id']?>;<?=$resp['respuesta_id']?>" style="width: 60px;height: 60px"><br>
                                        <h4 class="semi-bold"><?=$resp['respuesta_nombre']?></h4>
                                    </div>
                                <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <div class="col-sm-offset-6 col-sm-6">
                            <input type="hidden" name="empleado_id" value="0">
                            <input type="hidden" name="encuesta_id" value="<?=$Encuesta[0]['encuesta_id']?>">
                            <input type="hidden" name="TotalPreguntas" value="<?=count($Preguntas)?>">
                            <input type="hidden" name="TotalRespondidas" value="">
                        </div>
                    </div>    
                </form>
                <?php }else{?>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">NO HAY ENCUESTAS DISPONIBLES</h2>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="EnsatEncuestaEvaluacion" value="Si">
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>

<script src="<?= base_url('assets/js/Encuestas.js?').md5(microtime())?>" type="text/javascript"></script>