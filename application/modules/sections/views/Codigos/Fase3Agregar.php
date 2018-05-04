<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">AGREGAR CODIGO FASE 3</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form class="form-codigos-agregar-f3">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="mayus-bold">FASE</label>
                                    <input type="text" name="ci_f3_fase" class="form-control" value="<?=$info['ci_f3_fase']?>">
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">TIEMPO</label>
                                    <input type="text" name="ci_f3_tiempo" class="form-control" value="<?=$info['ci_f3_tiempo']?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="ci_f2_id" value="<?=$_GET['f2']?>">
                                    <input type="hidden" name="ci_f3_id" value="<?=$_GET['f3']?>">
                                    <input type="hidden" name="f3_accion" value="<?=$_GET['a']?>">
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