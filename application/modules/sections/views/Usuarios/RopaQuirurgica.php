<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-sm-6 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center ">
                    <span style="font-size: 20px;font-weight: 500;text-transform: uppercase">
                        <h1 class="no-margin"><b><?=$this->sigh->getInfo('hospital_tipo')?></b></h1>
                        <h4 style="margin-bottom: 0px;"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h4>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-sm-12">
                            <fieldset class="fieldset">
                                <legend class="legend" style="width: 70%"><i class="fa fa-medkit color-imss"></i> RECIBO Y ENTREGA DE ROPA QUIRÚRGICA</legend>
                                <div class="form-group" style="margin-top: 20px">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss border-back-imss">
                                            <i class="fa fa-user-plus"></i>
                                        </span>
                                        <input type="text" class="form-control" name="empleado_id" placeholder="INGRESAR MATRICULA DEL USUARIO">
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