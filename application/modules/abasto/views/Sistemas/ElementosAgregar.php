<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered" style="margin-top: 10px">
        <div class="box-inner">
            <div class="panel panel-default ">
                <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>NUEVO ELEMENTO</b>&nbsp;
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="guardar-elemento">
                        <div class="row" >
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label><b>NOMBRE</b> </label>
                                    <input class="form-control" name="elemento_titulo" required=""  value="<?=$info['elemento_titulo']?>">   
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group" >
                                    <label><b>CLAVE PRESUPUESTAL</b> </label>
                                    <input class="form-control" name="elemento_clave" value="<?=$info['elemento_clave']?>">   
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div id="retrievingfilename" class="html5imageupload" data-width="300" data-height="200" data-url="<?=  base_url()?>config/upload_image_pt?tipo=materiales" style="width: 100%">
                                    <input type="file" name="thumb" style="height: 90px!important;">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label><b>DESCRIPCIÓN</b></label>
                                    <textarea class="form-control" rows="2" name="elemento_descripcion"><?=$info['elemento_descripcion']?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <button class="btn btn-imss-cancel btn-block" type="button" onclick="window.top.close()">Cancelar</button>
                            </div>
                            <div class="col-xs-6">
                                <input type="hidden" name="elemento_img" value="<?=$info['elemento_img']?>" id="filename">
                                <input type="hidden" name="csrf_token" >
                                <input type="hidden" name="sistema_id" value="<?=$_GET['sistema']?>">
                                <input type="hidden" name="elemento_id" value="<?=$_GET['elemento']?>">
                                <input type="hidden" name="accion" value="<?=$_GET['accion']?>">

                                <button class="btn back-imss btn-block" type="submit">Guardar</button>                     
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Abasto/AbsSistemas.js?').md5(microtime())?>" type="text/javascript"></script>