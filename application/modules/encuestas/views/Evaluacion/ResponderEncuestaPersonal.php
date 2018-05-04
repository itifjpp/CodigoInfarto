<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="<?= base_url()?>Inicio">Inicio</a></li>
            <li><a href="#">Responder Encuesta de Evaluación</a></li>
        </ol> 
        <div class="row margin-top-10">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-body">
                        <?php 
                            $sqlCheck=$this->config_mdl->sqlQuery("SELECT enc.encuesta_id FROM sigh_encuestas AS enc, sigh_encuestas_usuarios AS enc_user 
                                WHERE enc.encuesta_id=enc_user.encuesta_id AND 
                                enc.encuesta_external=".$_GET['external']." AND enc.encuesta_para='".$_GET['tipo']."' AND enc_user.empleado_id=".$this->UMAE_USER);
                        if(empty($sqlCheck)){    
                        ?>
                        
                        <form class="ensat-evaluacion" method="GET">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                        <h2 class="text-uppercase semi-bold line-height no-margin"><i class="fa fa-pencil-square-o"></i> <?=$Encuesta[0]['encuesta_nombre']?></h2>
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
                                        <h3 class="line-height m-t-5 m-b-5" ><?=$i?>.- <?=$preg['pregunta_nombre']?></h3>
                                        <div class="row">
                                            
                                            <?php 
                                            $Respuesta=$this->config_mdl->sqlQuery('SELECT * FROM sigh_encuestas_respuestas AS res
                                                                                    WHERE res.pregunta_id ='.$preg['pregunta_id']);
                                            foreach ($Respuesta as $resp) {
                                            ?>
                                            <div class="col-xs-12 text-left " >
                                                <label class="md-check m-t-5">
                                                    <input type="radio" name="respuesta_<?=$preg['pregunta_id']?>" class="has-value input-encuesta-evaluacion" data-value="<?=$Encuesta[0]['encuesta_id']?>;<?=$preg['pregunta_id']?>;<?=$resp['respuesta_id']?>">
                                                    <i class="indigo"></i><?=$resp['respuesta_nombre']?>
                                                </label>

                                            </div>
                                        <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-md-12">
                                    <button class="btn sigh-background-secundary pull-right btn-encuesta-evaluacion-end" type="button">FINALIZAR ENCUESTA DE EVALUACIÓN</button>
                                    <input type="hidden" name="empleado_id" value="<?=$this->UMAE_USER?>">
                                    <input type="hidden" name="encuesta_id" value="<?=$Encuesta[0]['encuesta_id']?>">
                                    <input type="hidden" name="TotalPreguntas" value="<?=count($Preguntas)?>">
                                    <input type="hidden" name="TotalRespondidas" value="">
                                </div>
                            </div>    
                        </form>
                        <?php }else{?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>">
                                    <h3 class="text-uppercase semi-bold line-height no-margin"><i class="fa fa-pencil-square-o"></i> <?=$Encuesta[0]['encuesta_nombre']?></h3>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $Preguntas=$this->config_mdl->sqlGetDataCondition('sigh_encuestas_preg',array(
                                'encuesta_id'=>$Encuesta[0]['encuesta_id']
                            ));
                            $i=0;
                            foreach ($Preguntas as $preg) {
                                $i++;
                            ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="line-height m-t-5 m-b-5" ><?=$i?>.- <?=$preg['pregunta_nombre']?></h4>
                                    <?php 
                                    $sqlResponse=$this->config_mdl->sqlQuery("SELECT preg.pregunta_nombre,resp.respuesta_nombre FROM 
                                                                                sigh_encuestas AS enc,sigh_encuestas_usuarios_res AS users_res, 
                                                                                sigh_encuestas_usuarios As users,sigh_encuestas_preg As preg,
                                                                                sigh_encuestas_respuestas AS resp WHERE resp.encuesta_id=0 AND resp.pregunta_id=preg.pregunta_id AND
                                                                                enc.encuesta_id=preg.encuesta_id AND enc.encuesta_id=users.encuesta_id AND
                                                                                users_res.pregunta_id=preg.pregunta_id AND users_res.respuesta_id=resp.respuesta_id AND users_res.eu_id=users.eu_id AND 
                                                                                preg.pregunta_id=".$preg['pregunta_id']);
                                    ?>
                                    <h5 class="no-margin"><b>R:</b> <?=$sqlResponse[0]['respuesta_nombre']?> </h5>
                                </div>
                            </div>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

<input type="hidden" name="EnsatEncuestaEvaluacion" value="Si">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Encuestas.js?').md5(microtime())?>" type="text/javascript"></script>