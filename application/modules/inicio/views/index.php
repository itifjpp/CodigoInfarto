<?=Modules::run('Sections/Menu/loadHeader')?>
<div class="page-content">
    <div class="content">
        <div class="grid simple">
            <div class="grid-body">
                <div class="row ">
                    <div class="col-md-2">
                        <img src="<?= base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" style="width:160px;margin: 30px auto;display: table" >
                    </div>
                    <div class="col-md-10">
                        <h2 class="text-left" style="margin-top: 0px;"><b><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></b></h2>
                        <h4 class="line-height text-justify" style=""><?=$this->sigh->getInfo('hospital_acerca_de')?></h4>

                    </div>
                </div>
            </div>
        </div>
        <div class="grid simple row-result-encuestas-status hide">
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="margin: 0px"><b><i class="fa fa-pencil-square-o sigh-color"></i> RESULTADO DE LA ENCUESTA DE SATISFACCIÓN</b></h2>
                    </div>
                </div>
                <div class="row row-result-ensat-loading">
                    <div class="col-md-12 text-center">
                        <br>
                        <i class="fa fa-spinner fa-pulse fa-4x"></i>
                    </div>
                </div>
                <div class="row row-result-ensat-load hide" style="margin-top: 10px">
                    <div class="col-md-4 no-padding">
                        <h5 ><i class="fa fa-calendar-o sigh-color"></i><b> FECHA:</b> <span class="result-ensat-fecha"></span></h5>
                    </div>
                    <div class="col-md-4 no-padding">
                        <h5 ><i class="fa fa-clock-o sigh-color"></i><b> TURNO: </b><span class="result-ensat-turno text-uppercase"></span></h5>
                    </div>
                    <div class="col-md-4 no-padding">
                        <h5 ><i class="fa fa-pencil-square-o sigh-color"></i> <b> TOTAL ENCUESTAS: </b><span class="result-ensat-totals">SIN DETERMINAR</span></h5>
                    </div>
                </div>
                <div class="row-result-encuestas row-result-ensat-load hide"></div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-6">
                <div class="grid simple ">
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="margin: 0px"><b><i class="fa fa-star sigh-color"></i> MISIÓN</b></h2>
                                <h5 class="line-height text-justify" ><?=$this->sigh->getInfo('hospital_mision')?></h5>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="grid simple ">
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 style="margin: 0px"><b><i class="fa fa-star sigh-color"></i> VISIÓN</b></h2>
                                <h5 class="line-height text-justify" ><?=$this->sigh->getInfo('hospital_vision')?></h5>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="no-margin" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>;display: inline-block">NOTICIAS</h4>
            </div>
        </div>
        <div class="row m-t-10">
            <?php foreach ($Noticias as $not){?>
            <div class="col-md-4">
                <div class="grid simple">
                    <a href="<?= base_url()?>Sections/Noticias/Detalles?not=<?= $not['noticia_id']?>">
                        <div class="grid-body no-padding">
                            <img src="<?= base_url()?>assets/Noticias/<?=$not['noticia_portada']?>" style="width: 100%;">
                            <div class="noticia-img">
                                <div class="description">
                                    <h5 class="text-nowrap color-white no-margin"><?=$not['noticia_titulo']?></h5>
                                    <hr class="hr-style-white">
                                    <h6 class="color-white" style="font-size: 10px;margin-bottom: 4px;margin-top: 0px">FECHA Y HORA: <?=$not['noticia_fecha_gen']?></h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="no-margin" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_primary')?>;display: inline-block">NORMATIVAS</h4>
            </div>
        </div>
        <div class="row m-t-10">
            <?php foreach ($Normativas as $norma){?>
            <div class="col-md-4">
                <div class="grid simple">
                    
                    <div class="grid-body no-padding">
                        <a href="<?= base_url()?>Sections/Normativas/Detalles?norma=<?= $norma['normativa_id']?>">
                            <img src="<?= base_url()?>assets/Normativas/<?=$norma['normativa_portada']?>" style="width: 100%;">
                        </a>
                        <div class="noticia-img">
                            <div class="description">
                                
                                <h5 class="text-nowrap color-white no-margin"><?=$norma['normativa_titulo']?></h5>
                                <?php 
                                $sqlCheckEncuesta=$this->config_mdl->sqlGetDataCondition('sigh_encuestas',array(
                                    'encuesta_para'=>'NORMATIVAS',
                                    'encuesta_estado'=>'true',
                                    'encuesta_external'=>$norma['normativa_id']
                                ));
                                if(!empty($sqlCheckEncuesta)){
                                ?>

                                <i class="fa fa-pencil-square-o i-24 pointer tip" data-original-title="RESPONDER ENCUESTA DE EVALUACIÓN" onclick="location.href=base_url+'Encuestas/ResponderEncuesta?enc=<?=$sqlCheckEncuesta[0]['encuesta_id']?>&external=<?=$norma['normativa_id']?>&tipo=NORMATIVAS'" style="position: absolute;right: 6px;bottom: 6px"></i>
                                <?php }?>
                                <hr class="hr-style-white">
                                <h6 class="color-white" style="font-size: 10px;margin-bottom: 4px;margin-top: 0px">Institución: <?=$norma['normativa_institucion']?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<input type="hidden" name="ResultEnsat" value="Si">
<?=Modules::run('Sections/Menu/loadFooter')?>
<script src="<?= base_url()?>assets/js/Inicio.js?<?= md5(microtime())?>" type="text/javascript"></script>