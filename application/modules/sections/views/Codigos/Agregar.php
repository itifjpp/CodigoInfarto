<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">AGREGAR CODIGO</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form class="form-codigoinfarto-agregar">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="mayus-bold">CODIGO</label>
                                    <input type="text" name="ci_codigo" class="form-control" value="<?=$info['ci_codigo']?>">
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">COLOR</label>
                                    <input type="text" name="ci_color" class="form-control" value="<?=$info['ci_color']?>">
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">COLOR HEXADECIMAL</label>
                                    <input type="text" name="ci_color_hex" class="form-control" value="<?=$info['ci_color_hex']?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="ci_id" value="<?=$_GET['ci']?>">
                                    <input type="hidden" name="ci_accion" value="<?=$_GET['a']?>">
                                    <button class="btn btn-block back-imss">GUARDAR</button>
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
<script src="<?= base_url('assets/js/sections/Codigos.js?'). md5(microtime())?>" type="text/javascript"></script>