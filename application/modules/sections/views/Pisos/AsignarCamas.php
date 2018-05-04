<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12 col-centered">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase"><b>ASIGNACIÓN DE CAMAS AL PISO:</b> <?=$info[0]['piso_nombre']?></span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select class="form-control" name="area_id">
                                        <option value="">Seleccionar Área</option>
                                        <?php foreach ($Areas as $Areas):?>
                                        <option value="<?=$Areas['area_id']?>"><?=$Areas['area_nombre']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <input type="hidden" name="piso_id" value="<?=$this->uri->segment(4)?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block btn-obtener-camas">Aplicar</button>  
                                </div>
                            </div>
                        </div>
                        <div class="row col-camas">
                            
                        </div>
                        <div class="row">
                            <hr>
                            <h3 class="text-center"><b>CAMAS ASIGNADAS</b></h3><br>
                            <div class="col-camas-asignadas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Pisos.js?'). md5(microtime())?>" type="text/javascript"></script>