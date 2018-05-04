<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-sm-8 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 20px;font-weight: 500;text-transform: uppercase">
                        <h1 class="no-margin"><b><?=$this->sigh->getInfo('hospital_tipo')?></b></h1>
                        <h4 style="margin-bottom: 0px;"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h4>
                    </span>
                    <a class="md-btn md-fab m-b red pull-left tip" href="<?= base_url()?>RopaQuirurgica" data-original-title="Regresar" data-placement="left" style="position: absolute;left: 0px;top: 15px">
                        <i class="mdi-navigation-arrow-back i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-xs-12">
                            <fieldset class="fieldset">
                                <legend class="legend" style="width: 50%">RECIBO Y ENTREGA DE ROPA QUIRÚRGICA</legend>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="<?= base_url()?>assets/img/perfiles/<?=$info['empleado_perfil']?>" style="width: 100%">
                                    </div>
                                    <div class="col-xs-9">
                                        <h4>
                                            <strong>USUARIO: </strong> <?=$info['empleado_nombre']?> <?=$info['empleado_apellidos']?>
                                        </h4>
                                        <h4>
                                            <strong>MATRICULA: </strong> <?=$info['empleado_matricula']?>
                                        </h4>
                                        <h4>
                                            <strong>CATEGORÍA: </strong> <?=$info['empleado_categoria']?>
                                        </h4>
                                        <?php if(!empty($RopaQuirurgica)){?>
                                        <h4>
                                            <strong>FECHA DE RECEPCIÓN DE ROPA: </strong> <?=$RopaQuirurgica[0]['rq_r_fecha']?>
                                        </h4>
                                        <?php }?>
                                        <div class="row" >
                                            <div class="col-xs-8">
                                                <button class="btn back-imss btn-block btn-rq-accion <?=!empty($RopaQuirurgica) ? 'hide':''?>"  data-id="<?=$info['empleado_id']?>" data-hospital="<?=$this->sigh->getInfo('hospital_id')?>" data-accion="Recibir" style="margin-top:40px">RECIBIR</button>
                                                <button class="btn btn-imss-success btn-rq-accion btn-block <?=empty($RopaQuirurgica) ? 'hide':''?>"  data-id="<?=$info['empleado_id']?>" data-hospital="<?=$this->sigh->getInfo('hospital_id')?>" data-accion="Entregar" style="margin-top: 00px">ENTREGAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Usuarios.js?'). md5(microtime())?>" type="text/javascript"></script>