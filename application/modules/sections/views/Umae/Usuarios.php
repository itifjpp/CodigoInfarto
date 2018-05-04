<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;text-align: center">
                        <center>
                            <b style="font-size: 20px"><?=$info['unidadmedica_tipo']?></b><br>
                            <b style="font-size: 13px"><?=$info['unidadmedica_nombre']?></b><br>
                        </center>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form class="umae-config-usuarios">
                            <div class="col-md-12">
                                <div class="md-form-group ">
                                   <label><b>IMPORTAR LISTA DE USUARIOS (FORMATO EXCEL)</b></label>   
                                   <input type="file" class="md-input upload-archivo" name="usuarios_file" required="">
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-md-offset-2">
                                <input type="hidden" name="csrf_token">
                                <button class="btn back-imss pull-right" >
                                    <i class="fa fa-cloud-upload"></i> IMPORTAR
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="<?= base_url()?>Sections/Configuracion/Finalizar">
                                    <button class="btn back-imss pull-right" type="button">OMITIR Y CONTINUAR</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Sections/UMAE.js?'). md5(microtime())?>" type="text/javascript"></script>