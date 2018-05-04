<?= modules::run('Sections/Menu/HeaderBasico'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered" >
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">TARJETA DE IDENTIFICACIÓN</span>
                </div>
                <div class="panel-body b-b b-light">
                    <form class="form-tarjeta-identificacion">
                        <div class="row-sm">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="mayus-bold">Enfermedades Cronicodegenerativas</label>
                                    <textarea class="form-control" name="ti_enfermedades" maxlength="50"><?=$info['ti_enfermedades']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="mayus-bold">Alergias</label>
                                    <textarea class="form-control" name="ti_alergias" maxlength="85"><?=$info['ti_alergias']?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row-sm">
                            <div class="col-sm-12">
                                <table style="width: 100%">
                                    <tr>
                                        <td style="padding-right: 6px">
                                            <button class="btn btn-imss-cancel btn-block" type="button" onclick="window.top.close();">Cancelar</button>
                                        </td>
                                        <td style="padding-left: 6px">
                                            <input type="hidden" name="triage_id" value="<?=$this->uri->segment(4)?>">
                                            <input type="hidden" name="csrf_token">
                                            <button class="btn back-imss btn-block" >Guardar</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>        
                    </form>                
                </div>     
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/PisosEnfermeria.js?').md5(microtime())?>" type="text/javascript"></script>