<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-10 col-centered" style="margin-top: -20px">
        <div class="box-inner padding">
            <style>hr.style-eight {border: 0;border-top: 4px double #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -0.7em;font-size: 1.2em;padding: 0 0.20em;background: white;}</style>
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss text-center" style="">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b><?=$_GET['TipoNota']?></b>
                    </span>
                </div>
                <style> .wysiwyg-text-align-center {text-align: center;}</style>
                <div class="panel-body b-b b-light">
                    <div class="card-body" style="padding: 20px 0px;">
                        <form class="Form-Notas-HojaFrontal">
                            <div class="row">
                                <div class="col-md-12" style="margin-top: -20px">
                                    <div class="form-group">
                                        <b>PACIENTE: </b><?=$info['triage_nombre']?> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?>&nbsp;&nbsp;&nbsp;
                                        <b>T.A: </b><?=$info['triage_tension_arterial']?>&nbsp;&nbsp;&nbsp;
                                        <b>F.C: </b><?=$info['triage_frecuencia_cardiaco']?>&nbsp;&nbsp;&nbsp;
                                        <b>F.R: </b><?=$info['triage_frecuencia_respiratoria']?>&nbsp;&nbsp;&nbsp;
                                        <b>TEMP: </b><?=$info['triage_temperatura']?> °C&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <textarea class="form-control" name="nota_nota" rows="20"><?=$Nota['nota_nota']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><b>DIAGNOSTICO BREVE</b></label>
                                        <textarea class="form-control" name="nota_diagnostico" rows="4"><?=$Nota['nota_diagnostico']?></textarea>
                                    </div> 
                                    <div class="form-group">
                                        <?php if($Consultorios['ce_status']=='Salida'){?>
                                        <label><b>ALTA A: </b></label> <?=$Consultorios['ce_hf']?>
                                        <?php }else{?>
                                        <label><b>ALTA A: </b></label>
                                        <div class="row">
                                            <div class="col-md-2" style="padding-right: 0px">
                                                <label class="md-check">
                                                    <input type="radio" name="hf_alta" data-value="<?=$Consultorios['ce_hf']?>" value="Domicilio" class="has-value">
                                                    <i class="indigo"></i>Domicilio
                                                </label>
                                            </div>
                                            <div class="col-md-4" style="padding: 0px">
                                                <label class="md-check">
                                                    <input type="radio" name="hf_alta" data-value="<?=$Consultorios['ce_hf']?>" value="Observación" class="has-value">
                                                    <i class="indigo"></i>Se interna al servicio de Observación
                                                </label>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <input type="hidden" name="pia_lugar_accidente" value="<?=$PINFO['pia_lugar_accidente']?>">
                                
                                <div class="col-md-12 hide col-hojafrontal-info"><hr class="style-eight" data-titulo="Datos de st7"></div>
                                <div class="col-md-12 hide col-hojafrontal-info">
                                    <div class="form-group">
                                        <label><b>OMITIR DATOS DE ST7</b></label><br>
                                        <label class="md-check">
                                            <input type="radio" name="asistentesmedicas_omitir" data-value="<?=$AsistenteMedica['asistentesmedicas_omitir']?>" value="Si" class="has-value  hojafrontal-info">
                                            <i class="amber"></i>Si
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="asistentesmedicas_omitir" data-value="<?=$AsistenteMedica['asistentesmedicas_omitir']?>" checked="" value="No" class="has-value  hojafrontal-info">
                                            <i class="amber"></i>No
                                        </label>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>SEÑALAR CLARAMENTE COMO OCURRIO EL ACCIDENTE</b></label>
                                        <textarea name="asistentesmedicas_da" required="" maxlength="500" class="form-control hojafrontal-info" rows="3"><?=$AsistenteMedica['asistentesmedicas_da']?></textarea>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>DESCRIPCIÓN DE LA(S) LESIÓN(ES) Y TEMPO DE EVOLUCIÓN</b></label>
                                        <textarea name="asistentesmedicas_dl" required="" maxlength="500" class="form-control  hojafrontal-info" rows="3"><?=$AsistenteMedica['asistentesmedicas_dl']?></textarea>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>IMPRESIÓN DIAGNOSTICA</b></label>
                                        <textarea name="asistentesmedicas_ip" required="" maxlength="400" class="form-control  hojafrontal-info" rows="3"><?=$AsistenteMedica['asistentesmedicas_ip']?></textarea>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>TRATAMIENTOS</b></label>
                                        <textarea name="asistentesmedicas_tratamientos" required="" maxlength="400" class="form-control  hojafrontal-info" rows="3"><?=$AsistenteMedica['asistentesmedicas_tratamientos']?></textarea>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>SIGNOS Y SINTOMAS</b></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Intoxicación Alcoholica</label>&nbsp;&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_in" data-value="<?=$AsistenteMedica['asistentesmedicas_ss_in']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                    <i class="amber"></i>Si
                                                </label>
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_in" data-value="<?=$AsistenteMedica['asistentesmedicas_ss_in']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                    <i class="amber"></i>No
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Intoxicación por Enervantes</label>&nbsp;&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_ie" data-value="<?=$AsistenteMedica['asistentesmedicas_ss_ie']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                    <i class="pink"></i>Si
                                                </label>
                                                <label class="md-check">
                                                    <input type="radio" name="asistentesmedicas_ss_ie" data-value="<?=$AsistenteMedica['asistentesmedicas_ss_ie']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                    <i class="pink"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>OTRAS CONDICIONES</b></label><br>
                                        <label>Hubo riña</label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check">
                                            <input type="radio" name="asistentesmedicas_oc_hr" data-value="<?=$AsistenteMedica['asistentesmedicas_oc_hr']?>" value="Si" required="" class="has-value  hojafrontal-info">
                                            <i class="orange"></i>Si
                                        </label>
                                        <label class="md-check">
                                            <input type="radio" name="asistentesmedicas_oc_hr" data-value="<?=$AsistenteMedica['asistentesmedicas_oc_hr']?>" value="No" required="" class="has-value  hojafrontal-info">
                                            <i class="orange"></i>No
                                        </label>
                                    </div>
                                    <div class="form-group asistentesmedicas_omitir">
                                        <label><b>ATENCIÓN MÉDICA PREVIA EXTRAINSTITUCIONAL</b></label>
                                        <textarea name="asistentesmedicas_am" maxlength="200" class="form-control hojafrontal-info" required="" rows="2"><?=$AsistenteMedica['asistentesmedicas_am']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-6">
                                    <button class="btn btn-primary pull-right btn-block" onclick="window.top.close()">Cancelar</button>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="csrf_token" >
                                    <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>"> 
                                    <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                    <input type="hidden" name="notas_id" value="<?=$this->uri->segment(4)?>">
                                    <input type="hidden" name="notas_tipo" value="Hoja Frontal">
                                    <input type="hidden" name="via" value="<?=$_GET['via']?>">
                                    <input type="hidden" name="doc_id" value="<?=$_GET['doc_id']?>">
                                    <button class="btn btn-primary pull-right btn-block" type="submit" style="margin-bottom: -10px">Guardar</button>                     
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
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>