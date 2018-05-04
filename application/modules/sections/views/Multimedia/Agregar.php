<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-7 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Multimedia</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="" >
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 0px">
                            <form class="form-guardar-multimedia">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>TITULO</b></label>
                                            <input type="text" name="multimedia_titulo" value="<?=$info['multimedia_titulo']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>SELECCIONAR ARCHIVO</b></label>
                                            <input type="file" name="multimedia_url" required="" class="upload-archivo">
                                        </div>
                                    </div>
                                    <div class="col-md-offset-4 col-md-4">
                                        <div class="form-group">
                                            <button type="button" onclick="location.href=base_url+'Sections/Multimedia';" class="btn btn-primary btn-block">CANCELAR</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="csrf_token">
                                            <input type="hidden" name="multimedia_id" value="<?=$_GET['m']?>">
                                            <button type="submit" class="btn btn-primary btn-block">GUARDAR</button>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Multimedia.js')?>" type="text/javascript"></script>