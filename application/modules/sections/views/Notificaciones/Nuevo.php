<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">NUEVO MENSAJE DE REPORTE DE INCIDENTE</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <form class="nueva-notificacion" enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <label class="mayus-bold">Titulo</label>
                                    <input type="text" name="notificacion_titulo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">Descripción de incidente</label>
                                    <textarea  name="notificacion_descripcion" placeholder="Breve descripcón del incidente, en caso de ser un problema con un paciente anotar N° de paciente" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">Anexar archivos:</label>
                                    <input type="file" name="anexo_archivo[]" class="form-control upload-archivo" multiple="">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="csrf_token">
                                    <button type="submit" class="btn btn-primary pull-right">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Notificaciones.js?'). md5(microtime())?>" type="text/javascript"></script>