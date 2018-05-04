<?= modules::run('Sections/Menu/loadHeaderBasico'); ?>
<div class="row">
    <div class="col-xs-12 m-t-10">
        <div class="grid simple">
            <div class="grid-title sigh-background-primary">
                <h4 class="no-margin color-white">OBTENER UN N° DE REGISTRO</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-xs-12">
                        <label class="md-check">
                            <input type="radio" name="input_obtener_n_registro" value="Buscar" class="has-value" checked="">
                            <i class="indigo"></i>TENGO UN N° DE EMPLEADO
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="md-check">
                            <input type="radio" name="input_obtener_n_registro" value="Nuevo" class="has-value">
                            <i class="indigo"></i>NO TENGO UN N° DE EMPLEADO
                        </label>
                    </div>

                </div>
                <div class="row m-t-10 row-n-empleado-si">
                    <div class="col-xs-8">
                        <input type="text" name="empleado_matricula" class="form-control" placeholder="N° DE EMPLEADO">
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block sigh-background-primary btn-n-empleado-si">BUSCAR</button>
                    </div>
                </div>
                <div class="row m-t-20 row-n-empleado-no hide">
                    
                    <div class="col-xs-12">
                        <button class="btn btn-block sigh-background-primary btn-n-empleado-no-next">ACEPTAR</button>
                    </div>
                </div>
                <div class="row row-n-empleado-si-rs hide m-t-10">
                    <div class="col-xs-12">
                        <h6 class="line-height">ES POSIBLE QUE ALGÚN OTRO USUARIO TENGA ASIGNADO EL MISMO N° DE EMPLEADO. POR FAVOR SELECCIONAR EL QUE LE CORRESPONDA</h6>
                    </div>
                    <div class="col-xs-12">
                        <table class="table table-bordered table-no-padding">
                            <thead>
                                <tr>
                                    <th>N° DE REGISTRO</th>
                                    <th>N° DE EMPLEADO</th>
                                    <th>EMPLEADO</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="col-xs-offset-8 col-xs-4">
                        <button class="btn btn-block sigh-background-primary btn-n-empleado-si-next">CONTINUAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url()?>assets/js/EducacionRegistro.js?<?= md5(microtime())?>" type="text/javascript"></script> 