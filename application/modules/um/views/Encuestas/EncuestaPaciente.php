<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row" id="FullScreen">
    <div class="box-cell">
        <div class="box-inner col-sm-12 col-centered" style="margin-top: 10px">
            
            <div class="panel panel-default ">
                <?php if(!empty($Encuestas)){?>
                <div class="panel-heading p teal-900 back-imss pantalla-completa">
                    <span style="font-size: 30px;font-weight: 500;text-transform: uppercase">
                        <b>REALIZAR ENCUESTA COMO </b>
                    </span>
                    <div style="position: relative">
                        <div style="position: absolute;right: 0px;top: -34px;">
                            <i class="pointer pantalla-completa accion-windows fa fa-arrows-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="ensat-encuesta-paciente">
                        <div class="row">
                            <div class="col-md-12">    
                                <label class="ui-checks ui-checks-lg mayus-bold" style="font-size: 25px">
                                    <input type="radio" name="tipo_paciente" value="Anonimo" checked="">
                                    <i class="indigo"></i>Paciente Anónimo
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="ui-checks ui-checks-lg mayus-bold" style="font-size: 25px">
                                    <input type="radio" name="tipo_paciente" value="Identificado">
                                    <i class="indigo"></i>Paciente Identificado
                                </label>    
                            </div>
                            <div class="col-md-12 col-folio-paciente hide" style="margin-top: 10px">
                                <div class="input-group m-b">
                                    <span class="input-group-addon back-imss border-back-imss">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="number" class="form-control" name="triage_id" placeholder="INGRESAR N° DE FOLIO" style="font-size: 25px; padding: 25px;">
                                </div>
                            </div>
                            <div class="col-sm-offset-6 col-sm-6" style="margin-top: 20px">
                                <button class="btn back-imss btn-block" type="submit" style="font-size: 30px">Continuar</button>
                            </div>
                        </div>                    
                    </form>
                </div>
                <?php }else{?>
                <div class="panel-body b-b red">
                    <h4 class="mayus-bold text-center">NO HAY ENCUESTAS DISPONIBLES</h4>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Ensat.js?').md5(microtime())?>" type="text/javascript"></script>