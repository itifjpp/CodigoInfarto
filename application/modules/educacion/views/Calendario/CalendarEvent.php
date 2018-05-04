<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top:-10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Educacion/Calendario">Calendario</a></li>
            <li><a href="<?= base_url()?>Educacion/Calendario/Events?cal=<?=$_GET['cal']?>">Eventos</a></li>
            <li><a href="#">Agregar/Editar Evento</a></li>
        </ol>
        <div class="row m-t-5">
            <div class="col-md-8 col-centered">
                <div class="grid simple " >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">AGREGAR NUEVO EVENTO</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form class="createEventCalendar">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>TÍTULO DEL EVENTO</label>
                                        <input type="text" name="event_title" required class="form-control" placeholder="TÍTULO DEL EVENTO">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>FECHA Y HORA DE INICIO</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" name="event_start_date" placeholder="FECHA DE INICIO" class="form-control dp-yyyy-mm-dd">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" name="event_start_time" placeholder="HORA DE INCIO" class="form-control clockpicker-bottom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>FECHA Y HORA DE TERMINO</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" name="event_end_date" required placeholder="FECHA DE TERMINO" class="form-control dp-yyyy-mm-dd">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" name="event_end_time" required placeholder="HORA DE TERMINO" class="form-control clockpicker-bottom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>AÑADIR UNA UBICACIÓN</label>
                                        <input type="text" name="event_location" id="event_location" required class="form-control" placeholder="AÑADIR UNA UBICACIÓN">
                                    </div>
                                    <div class="form-group">
                                        <label>AÑADIR DESCRIPCIÓN</label>
                                        <textarea name="event_description" maxlength="600" required class="form-control" rows="5" placeholder="AÑADIR UNA DESCRIPCIÓN"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <h6 class="line-height" style="color:#F44336">EVITAR USAR <b>"DOBLES COMILLAS"</b> EN LOS TEXTOS ESCRITOS EN VEZ DE ESTO UTILIZAR <b>'COMILLAS SIMPLEAS'</b>  O <b>``ÀPOSTROFES´´</b></h6>
                                    </div>
                                </div>
                                <div class="col-xs-offset-8 col-xs-4">
                                    <input type="hidden" name="calendar_id" value="<?=$_GET['cal']?>">
                                    <button class="btn btn-block sigh-background-secundary" type="submit">GUARDAR</button>
                                </div>
                            </form>
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
    var input = document.getElementById('event_location');
    var searchBox = new google.maps.places.SearchBox(input);
</script>