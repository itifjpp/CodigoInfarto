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
                        <form class="umae-config-consultorios">
                            <div class="col-md-12 text-center">
                                <h4>AGREGAR CONSULTORIOS</h4>
                                <hr>
                            </div>
                            <div class="col-md-5">
                                <div class="md-form-group">
                                    <input class="md-input" name="consultorio_nombre" required="">
                                    <label>NOMGRE DEL CONSULTORIO</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="md-form-group" style="margin-top: -20px">
                                    <label>CONSULTORIO DE ESPECIALIDAD</label><br>
                                    <label class="md-check">
                                        <input type="radio" name="consultorio_especialidad" value="Si">
                                        <i class="indigo"></i>Si
                                    </label>&nbsp;&nbsp;&nbsp;
                                    <label class="md-check">
                                        <input type="radio" name="consultorio_especialidad" value="No" checked="">
                                        <i class="indigo"></i>No
                                    </label>
                                </div>
                                
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" name="csrf_token">
                                <button class="btn back-imss pull-right">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <table class="table table-bordered table-consultorios">
                                <thead>
                                    <tr>
                                        <th>CONSULTORIO</th>
                                        <th>ESPECILIDAD</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <a href="<?= base_url()?>Sections/Configuracion/Usuarios">
                                <button class="btn back-imss pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OMITIR Y CONTINUAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Sections/UMAE.js?'). md5(microtime())?>" type="text/javascript"></script>