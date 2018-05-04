<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Educacion/Ua">Unidades Académicas</a></li>
            <li><a href="#">Agregar Unidad Académica</a></li>
        </ol> 
        <div class="row m-t-10"> 
            
            <div class="col-md-8 col-centered" >
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">AGREGAR NUEVA UNIDAD ACADÉMICA</h4>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-12">
                                <form class="ua-agregar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NOMBRE DE LA UNIDAD ACADÉMICA</label>
                                                <input type="text" required="" name="ua_nombre" class="form-control" value="<?=$info['ua_nombre']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>INCORPORACIÓN</label>
                                                <input type="text" name="ua_incorporacion" value="<?=$info['ua_incorporacion']?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>DIRECCIÓN DE LA UNIDAD ACADÉMICA</label>
                                                <input type="text" required="" name="ua_direccion" id="ua_direccion" class="form-control" value="<?=$info['ua_direccion']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TELEFONO</label>
                                                <input type="text" required="" name="ua_telefono" class="form-control" value="<?=$info['ua_telefono']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>EMAIL</label>
                                                <input type="text" required="" name="ua_email" class="form-control" value="<?=$info['ua_email']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-offset-8 col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="ua_id" value="<?=$_GET['ua']?>">
                                                <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                                <button class="btn sigh-background-secundary pull-right btn-block">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWAP28Ei9Vt9VGbCj1TlaKZJEPscO7elM&libraries=places"></script>
<script>
    var input = document.getElementById('ua_direccion');
    var searchBox = new google.maps.places.SearchBox(input);
</script>