<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500"><b>CONFIGURACIÓN PARA LA PERSONALIZACIÓN DEL SISTEMA DE TRIAGE</b></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form class="umae-config">
                            <div class="col-md-12">
                                <div class="md-form-group">
                                    <input type="text" class="md-input" name="unidadmedica_nombre" required="">
                                    <label><b>NOMBRE DE LA UNIDAD MÉDICA</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form-group">
                                    <input type="text" class="md-input" name="unidadmedica_tipo" required="">
                                    <label><b>TIPO DE UNIDAD MÉDICA</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form-group">
                                    <select name="unidadmedica_clasificacion" class="md-input" required="">
                                        <option value=""></option>
                                        <option value="UMF">UMF</option>
                                        <option value="HGZ">HGZ</option>
                                        <option value="UMAE">UMAE</option>
                                    </select>
                                    <label><b>CLASIFICACIÓN</b></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="md-form-group">
                                    <input type="text" class="md-input"  name="unidadmedica_direccion" required="">
                                    <label><b>DIRECCIÓN DE LA UNIDAD MÉDICA</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form-group">
                                    <input type="text" class="md-input" name="unidadmedica_administrador" required="">
                                    <label><b>NOMBRE DEL ADMINISTRADOR</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form-group">
                                    <input type="text" class="md-input" name="unidadmedica_administrador_ap" required="">
                                    <label><b>APELLIDOS DEL ADMINISTRADOR</b></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="md-form-group">
                                    <input type="text" class="md-input" name="unidadmedica_user" required="">
                                    <label><b>USUARIO O MATRICULA DE ADMINISTRADOR</b></label>
                                </div>
                                <div class="md-form-group" style="margin-top: -20px">
                                    <label style="color: #6f7b8a!important;font-size: 11px;opacity: 0.6;"><b>SELECCIONAR IMAGEN DE LA UNIDAD MÉDICA</b></label>
                                    <input type="file" class="md-input upload-archivo" name="unidadmedica_logo" placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="unidadmedica_bd_user" value="<?=$_GET['user']?>" class="form-control">
                                    <input type="hidden" name="unidadmedica_bd_pass" value="<?=$_GET['pass']?>" class="form-control">
                                    <input type="hidden" name="unidadmedica_bd_ip" value="<?=$_GET['ip']?>" class="form-control">
                                    <button class="btn back-imss pull-right" type="submit">GUARDAR Y CONTINUAR</button>
                                </div>
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