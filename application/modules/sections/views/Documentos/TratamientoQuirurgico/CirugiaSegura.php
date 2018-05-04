<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered" style="margin-top: -20px">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center" style="">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>Cirugía Segura</b>
                    </span>
                </div>
                <style> .wysiwyg-text-align-center {text-align: center;}</style>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 20px 0px;">
                        <form class="cirugia-segura">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">Unidad Hospitalaria</b></label>
                                        <input name="" value="UMAE | Dr. Victorio de la Fuente Narváez" readonly="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">Edad</b></label>
                                        <input name="" value="<?=$triage[0]['triage_paciente_edad']?>" readonly="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">N.S.S</b></label>
                                        <input name="" value="<?=$triage[0]['triage_paciente_afiliacion']?>" readonly="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">Sexo</b></label>
                                        <input name="" value="<?=$triage[0]['triage_paciente_sexo']?>" readonly="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">Paciente</b></label>
                                        <input name="" value="<?=$triage[0]['triage_nombre']?> <?=$triage[0]['triage_nombre_ap']?> <?=$triage[0]['triage_nombre_am']?>" readonly="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">N° Cama</b></label>
                                        <input  value="<?=$observacion[0]['observacion_cama_nombre']?>" class="form-control" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">Procedimiento Quirúrgico</b></label>
                                        <textarea class="form-control" rows="1" maxlength="100" name="cirugiasegura_procedimiento" ><?=$cs[0]['cirugiasegura_procedimiento']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-offset-10">
                                    <input type="hidden" name="tratamiento_id" value="<?=$this->uri->segment(4)?>">
                                    <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                    <input type="hidden" name="csrf_token">
                                    <button type="submit" class="btn btn-primary btn-block pull-right">Guardar</button>
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