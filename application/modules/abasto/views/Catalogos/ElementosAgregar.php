<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-8 col-centered">
        <div class="box-inner padding">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>NUEVO ELEMENTO</b>&nbsp;
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body">
                        <form class="guardar-elemento">
                            <div class="row row-sm" style="margin-left: -40px">
                                <div class="col-sm-8">
                                    <div class="form-group" style="margin-top: -15px">
                                        <label><b>NOMBRE</b> </label>
                                        <input class="form-control" name="elemento_titulo" required=""  value="<?=$info['elemento_titulo']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group" style="margin-top: -15px">
                                        <label><b>CLAVE PRESUPUESTAL</b> </label>
                                        <input class="form-control" name="elemento_clave" value="<?=$info['elemento_clave']?>">   
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="retrievingfilename" class="html5imageupload" data-width="400" data-height="300" data-url="<?=  base_url()?>config/upload_image_pt?tipo=materiales" style="width: 98%;">
                                        <input type="file" name="thumb" style="height: 170px!important;">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label><b>DESCRIPCIÓN</b></label>
                                        <textarea class="form-control" rows="2" name="elemento_descripcion"><?=$info['elemento_descripcion']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="button" onclick="location.href=base_url+'Abasto/Catalogos/Elementos?catalogo=<?=$_GET['catalogo']?>&sistema=<?=$_GET['sistema']?>'" style="margin-bottom: -10px">Cancelar</button>
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="elemento_img" value="<?=$info['elemento_img']?>" id="filename">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="sistema_id" value="<?=$_GET['sistema']?>">
                                    <input type="hidden" name="elemento_id" value="<?=$_GET['elemento']?>">
                                    <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                    
                                    <button class="md-btn md-raised m-b btn-fw back-imss waves-effect no-text-transform pull-right" type="submit" style="margin-bottom: -10px">Guardar</button>                     
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>