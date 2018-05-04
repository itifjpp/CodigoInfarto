<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">CAMBIAR IMAGEN DE PERFIL</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <div id="retrievingfilename" class="html5imageupload" data-width="500" data-height="400" data-url="<?=  base_url()?>config/upload_image_pt?tipo=img/perfiles" >
                                    <input type="file" name="thumb" style="height: 200px!important">
                                </div>
                                <form class="guardar-img-perfil">
                                    <input type="hidden" name="empleado_perfil" id="filename">
                                    <input type="hidden" name="csrf_token">
                                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Usuarios.js?'). md5(microtime())?>" type="text/javascript"></script>