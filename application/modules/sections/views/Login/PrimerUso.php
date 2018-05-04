<?=Modules::run('Sections/Menu/loadHeaderBasico')?>
<div class="row" style="margin-top: 50px">
    <div class="col-md-8 col-centered">
        <div class="grid simple">
            <div class="grid-title">
                <h5 class="no-margin line-height semi-bold">ESTAMOS A UNOS PASOS PARA PODER HACER USO DE EL <b>SiGH</b>, AHORA SOLO DEBEMOS CAPTURAR INFORMACIÓN SOBRE ESTA UNIDAD MÉDICA</h5>
            </div>
            <div class="grid-body">
                <div class="row">
                    <form class="form-PrimerUso">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mayus-bold">NOMBRE DEL HOSPITAL</label>
                                <input type="text" name="hospital_nombre"class="form-control" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mayus-bold">TIPO DE HOSPITAL</label>
                                <input type="text" name="hospital_tipo" class="form-control" required="" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="mayus-bold">CLASIFICACIÓN</label>
                                <input type="text" name="hospital_clasificacion" class="form-control" required="" >
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="mayus-bold">DIRECCIÓN</label>
                                <textarea name="hospital_direccion" rows="1" placeholder="Dirección..." class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="hospital_acerca_de" rows="5" placeholder="Acerca de..." class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="hospital_mision" rows="3" placeholder="Misión..." class="form-control"></textarea>
                                    </div> 
                                    <div class="form-group">
                                        <textarea name="hospital_vision" rows="3" placeholder="Visión..." class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="retrievingfilename" class="html5imageupload" data-width="300" data-height="400" data-url="<?=  base_url()?>config/upload_image_pt?tipo=img" style="width: 100%">
                                <input type="file" name="thumb" style="height: 200px!important">
                            </div>
                            <div class="form-group margin-top-10">
                                <input type="hidden" name="hospital_logo" value="" id="filename">
                                <button class="btn back-imss btn-block pull-right">GUARDAR</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 col-finish hide">
                        <h4 class="line-height text-center">LA INFORMACIÓN DE LA UNIDAD MÉDICA HA SIDO GUARDADA CORRECTAMENTE, YA PUEDES INICIAR SESIÓN PARA REALIZAR LAS CONFIGURACIÓNES NECESARIAS, GRACIAS.</h4>
                        <button class="btn back-imss center-content" onclick="location.reload();">ACEPTAR Y CONTINUAR</button>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<input type="hidden" name="PrimerUso" value="Si">
<?=Modules::run('Sections/Menu/loadFooterBasico')?>
<script src="<?=  base_url()?>assets/js/sections/login.js?<?= md5(microtime())?>"></script>