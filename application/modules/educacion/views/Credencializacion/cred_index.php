<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row"> 
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white text-uppercase">VALIDAR IMPRESIÓN DE CREDENCIAL</h4>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                    <select name="credencial_tipo" class="width100">
                                        <option value="Registro de Impresión">Registro de Impresión</option>
                                        <option value="Registro de Entrega">Registro de Entrega</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" name="empleado_num_emp" class="form-control" placeholder="INGRESAR N° DE EMPLEADO">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>    
            </div>
            
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>