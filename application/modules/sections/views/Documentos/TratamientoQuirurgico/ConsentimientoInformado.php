<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered" style="margin-top: -20px">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center" style="">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>CARTA DE CONSENTIMIENTO INFORMADO</b>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 20px 0px;">
                        <form class="cci">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">El (la) que suscribe Sr..(Sra);</b></label>
                                        <input name="cci_la_que_suscribe" value="<?=$cci[0]['cci_la_que_suscribe']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">Fecha</b></label>
                                        <input name="cci_fecha" value="<?=$cci[0]['cci_fecha']=='' ? date('d/m/Y'): $cci[0]['cci_fecha']?>" class="form-control dd-mm-yyyy">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">En mi carácter de</b></label><br>
                                        <label class="md-check">
                                            <input type="radio" name="cci_caracter"  data-value="<?=$cci[0]['cci_caracter']?>" value="Paciente" class="has-value">
                                            <i class="indigo"></i>Paciente
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="cci_caracter"  data-value="<?=$cci[0]['cci_caracter']?>" value="Familiar del Paciente" class="has-value">
                                            <i class="indigo"></i>Familiar del Paciente
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="cci_caracter"  data-value="<?=$cci[0]['cci_caracter']?>" value="Representante Legal" class="has-value">
                                            <i class="indigo"></i>Representante Legal
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="cci_caracter"  data-value="<?=$cci[0]['cci_caracter']?>" value="Testigo" class="has-value">
                                            <i class="indigo"></i>Testigo
                                        </label>&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">Manifiesto que el dr</b></label>
                                        <input name="ci_mmc" value="<?=$observacion[0]['observacion_medico_nombre']?>" readonly="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">Diagnositicos principales</b></label>
                                        <input name="ci_mmc" value="<?=$st[0]['solicitudtransfucion_diagnostico']?>" readonly="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b style="text-transform: uppercase">Tipo de componente a transfundir</b></label><br>
                                        <label class="md-check">
                                            <input type="radio" name="cci_tipo_ct"  data-value="<?=$cci[0]['cci_tipo_ct']?>" value="Concentrado de eritrocito" class="has-value">
                                            <i class="indigo"></i>Concentrado de eritrocito
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="cci_tipo_ct"  data-value="<?=$cci[0]['cci_tipo_ct']?>" value="Plasma" class="has-value">
                                            <i class="indigo"></i>Plasma
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="cci_tipo_ct"  data-value="<?=$cci[0]['cci_tipo_ct']?>" value="Plaquetas" class="has-value">
                                            <i class="indigo"></i>Plaquetas
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="cci_tipo_ct"  data-value="<?=$cci[0]['cci_tipo_ct']?>" value="Crioprecipitado" class="has-value">
                                            <i class="indigo"></i>Crioprecipitado
                                        </label>&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class=""><b style="text-transform: uppercase">Pronostico</b></label>
                                        
                                        <textarea class="md-input" name="cci_pronostico" maxlength="100" rows="1"><?=$cci[0]['cci_pronostico']?></textarea>
                                    </div>
                                    <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                    <input type="hidden" name="tratamiento_id" value="<?=$this->uri->segment(4)?>">
                                    <input type="hidden" name="csrf_token">
                                </div>
                                <div class="col-md-3 col-md-offset-9 pull-right">
                                    <button class="btn btn-primary btn-block" style="margin-top: 10px">Guardar</button>
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