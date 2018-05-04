<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Sections/Hospitales">Hospitales</a></li>
            <li><a href="<?= base_url()?>Sections/Hospitales/ws?hos=<?=$_GET['hospital']?>">Configuración del Sitio Web</a></li>
            <li><a href="#">Agregar Configuración</a></li>
        </ol> 
        <div class="grid simple col-md-6 col-centered" style="margin-top: 10px!important">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">AGREGAR CONFIGURACIÓN</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <form class="form-add-ws">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>URL DEL SITIO WEB</label>
                                <input type="text" name="ws_url" value="<?=$info['ws_url']?>" class="form-control" required="" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>USUARIO DE BD</label>
                                <input type="text" name="ws_bd_user" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CONTRASEÑA DE BD</label>
                                <input type="text" name="ws_bd_password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NOMBRE DE BD</label>
                                <input type="text" name="ws_bd_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DIRECCIÓN IP</label>
                                <input type="text" name="ws_bd_ip" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="ws_id" value="<?=$info['ws_id']?>" id="filename">
                                <input type="hidden" name="csrf_token">
                                <input type="hidden" name="hospital_id" value="<?=$_GET['hospital']?>">
                                <input type="hidden" name="ws_accion" value="<?=$_GET['a']?>">
                                <button class="btn sigh-background-secundary pull-right">GUARDAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Hospitales.js?'). md5(microtime())?>" type="text/javascript"></script>