<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered" style="margin-top: -20px">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center" style="">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>Lista de Verificación Para Prevenir ISQ</b>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 20px 0px;">
                        <form class="isq">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">Servicio o áreas</b></label>
                                        <input name="isq_servicio_area" value="<?=$isq[0]['isq_servicio_area']?>" class="md-input">
                                    </div>
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">Turno</b></label><br>
                                        <label class="md-check">
                                            <input type="radio" name="isq_turno"  data-value="<?=$isq[0]['isq_turno']?>" value="M" class="has-value">
                                            <i class="indigo"></i>M
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="isq_turno"  data-value="<?=$isq[0]['isq_turno']?>" value="V" class="has-value">
                                            <i class="indigo"></i>V
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="isq_turno"  data-value="<?=$isq[0]['isq_turno']?>" value="N" class="has-value">
                                            <i class="indigo"></i>N
                                        </label>&nbsp;&nbsp;&nbsp;
                                    </div><br><br>
                                    <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                    <input type="hidden" name="tratamiento_id" value="<?=$this->uri->segment(4)?>">
                                    <input type="hidden" name="csrf_token">
                                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
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
<script src="<?= base_url('assets/js/sections/TratamientoQuirurgico.js?'). md5(microtime())?>" type="text/javascript"></script>