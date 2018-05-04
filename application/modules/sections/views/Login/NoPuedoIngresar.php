<?=Modules::run('Sections/Menu/loadHeaderBasico')?>
<div class="row m-t-10">
    <div class="col-md-6 col-centered">
        <div class="grid simple">
            <div class="grid-title sigh-background-primary">
                <h4 class="color-white no-margin">¡NO PUEDO INGRESAR AL SISTEMA!</h4>
            </div>
            <div class="grid-body">
                <form name="form" class="row-login-no-puedo-ingresar">
                    <div class="form-group">
                        <h5 class="no-margin line-height">POR FAVOR COMPLETE EL SIGUIENTE FORMULARIO PARA PODER AYUDARLO CON SU INGRESO AL SISTEMA</h5>
                    </div>
                    <div class="form-group">
                        <div class="transparent">
                            <input type="password" name="empleado_matricula" required="" autocomplete="off" class="form-control" placeholder="INGRESAR N° DE EMPLEADO">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="transparent">
                            <input type="password" name="empleado_matricula" required="" autocomplete="off" class="form-control" placeholder="INGRESAR SU NOMBRE COMPLETO">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="mensaje_descripcion" placeholder="DESCRIPCIÓN BREVE DE PORQUE NO PUEDE INGRESAR..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block" disabled="">ENVIAR</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?=Modules::run('Sections/Menu/loadFooterBasico')?>
<script src="<?=  base_url()?>assets/js/sections/login.js?<?= md5(microtime())?>"></script>