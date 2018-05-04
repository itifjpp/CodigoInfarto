<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-top: -10px;">
            <li>
                <a href="#">INICIO</a>
            </li>
            <li>
                <a href="<?= base_url()?>Triage/Enfermeriatriage">BUSCAR PACIENTE</a>
            </li>
            <li><a href="#" class="">CAPTURAR INFORMACIÓN DEL PACIENTE</a> </li>
        </ul>
        <div class="row margin-top-20">
            <div class="col-xs-9 col-centered ">
                <div class="grid simple">
                    <div class="paciente-sexo-mujer hide hidden" style="background: pink;width: 99.80%;height: 10px;margin: 1px 1px -2px 1px;border-radius: 4px 4px 0px 0px"></div>
                    <div class="grid-title sigh-background-secundary">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 class="no-margin color-white text-uppercase semi-bold width100">CAPTURAR INFORMACIÓN DEL PACIENTE</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <h4 class="color-white text-right no-margin text-uppercase width100">
                                    <span class="paciente_sexo"><?=$info['paciente_sexo']?></span>
                                    <span class="info_indicio_embarazo" style="color:pink"><?=$info['info_indicio_embarazo']!='' && $info['paciente_sexo']=='MUJER' ?' | Indicio de Embarazo':''?></span>
                                    <span class="paciente_fn">
                                        <?php 
                                        if($info['paciente_fn']!=''){
                                            $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                            echo ' | '.$fecha->y.' Años '.$fecha->m.' Meses';
                                        }
                                        ?>
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="grid-body ">
                        <form class="guardar-triage-enfermeria">
                            <div class="row">
                                <div class="col-xs-12 ">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>INGRESAR R.F.C</label>
                                                <input type="text" name="paciente_rfc" value="<?=$info['paciente_rfc']?>" class="form-control t-uc" required="" placeholder="INGRESAR R.F.C">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>DERECHOHABIENTE</label>
                                                <div class="radio m-t-15 radio-success">
                                                    <input id="paciente_derechohabiente_si" type="radio" name="paciente_derechohabiente" value="SI" data-value="<?=$info['paciente_derechohabiente']?>">
                                                    <label for="paciente_derechohabiente_si">SI</label>
                                                    <input id="paciente_derechohabiente_no" type="radio" name="paciente_derechohabiente" value="NO">
                                                    <label for="paciente_derechohabiente_no">NO</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>
                                                    <span class="label label-success">FOLIO SIMEF</span>
                                                </label>
                                                <input type="text" name="ingreso_folio_simef" class="form-control" value="<?=$info['ingreso_folio_simef']?>" required="ingreso_folio_simet">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group" >
                                                <label>APELLIDO PATERNO</label>
                                                <input type="text" class="form-control t-uc" name="paciente_ap"  value="<?=$info['paciente_ap']?>">   
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group" >
                                                <label>APELLIDO MATERNO</label>
                                                <input type="text" class="form-control t-uc" name="paciente_am"  value="<?=$info['paciente_am']?>">   
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group" >
                                                <label>NOMBRE </label>
                                                <input type="text" class="form-control t-uc" name="paciente_nombre" required="" placeholder="" value="<?=$info['paciente_nombre']?>">   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:-15px">
                                        <div class="col-xs-4">
                                            <div class="form-group" >
                                                <label>FECHA DE NACIMIENTO</label>
                                                <input type="text" class="form-control dd-mm-yyyy" name="paciente_fn" required="" placeholder="__/__/____" value="<?=$info['paciente_fn']?>">   
                                            </div>   
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label >SELECCIONAR SEXO</label>
                                                <select class="width100" name="paciente_sexo" required="" data-value="<?=$info['paciente_sexo']?>">
                                                    <option value="">SELECCIONAR SEXO</option>
                                                    <option value="HOMBRE">HOMBRE</option>
                                                    <option value="MUJER">MUJER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group triage_paciente_sexo hide" >
                                                <label>INDICIO DE EMBARAZO:</label>
                                                <div class="radio radio-success" style="margin-top: 10px">
                                                    <input id="info_indicio_embarazo_si" type="radio" name="info_indicio_embarazo" value="Si" data-value="<?=$info['info_indicio_embarazo']?>">
                                                    <label for="info_indicio_embarazo_si">SI</label>
                                                    <input id="info_indicio_embarazo_no" type="radio" name="info_indicio_embarazo" value="No" data-value="<?=$info['info_indicio_embarazo']?>" checked="">
                                                    <label for="info_indicio_embarazo_no">NO</label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-xs-4">
                                            <div class="form-group no-margin">
                                                <label>PROCEDENCIA ESPONTÁNEA</label>&nbsp;
                                                <div class="radio radio-success" style="margin-top: -20px">
                                                    <input id="info_procedencia_esp_si" type="radio" name="info_procedencia_esp" data-value="<?=$info['info_procedencia_esp']?>" value="Si" >
                                                    <label for="info_procedencia_esp_si">SI</label>
                                                    <input id="info_procedencia_esp_no" type="radio" name="info_procedencia_esp" value="No" checked="">
                                                    <label for="info_procedencia_esp_no">NO</label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xs-8">
                                            <input  class="form-control m-t-10" required="" type="hidden" name="info_procedencia_esp_lugar" placeholder="LUGAR DE PROCEDENCIA" value="<?=$info['info_procedencia_esp_lugar']?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-no-espontaneo">
                                            <div class="form-group m-t-5">
                                                <label>HOSPITAL DE PROCEDENCIA</label>
                                                <select name="info_procedencia_hospital" data-value="<?=$info['info_procedencia_hospital']?>" required="" class="width100">
                                                    <option value="">SELECCIONAR</option>
                                                    <option value="UMF">UMF</option>
                                                    <option value="HGZ">HGZ</option>
                                                    <option value="CMF">CMF</option>
                                                    <option value="OTRA UNIDAD DE LA INSTITUCIÓN">OTRA UNIDAD DE LA INSTITUCIÓN</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-no-espontaneo">
                                            <div class="form-group m-t-5">
                                                <label class="mayus-bold">NOMBRE/NUMERO DEL HOSPITAL</label>
                                                <input type="text" class="form-control t-uc" name="info_procedencia_hospital_num" required=""  value="<?=$info['info_procedencia_hospital_num']?>">   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 <?=SiGH_ENFERMERIA_SOLICITAR_OD=='No' ?'hidden' : 'm-t-5'?>">
                                    <div class="form-group">
                                        <label class="mayus-bold">OXIMETRÍA</label>
                                        <input type="text" name="sv_oximetria" value="<?=$SignosVitales['sv_oximetria']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 hide ">
                                    <div class="form-group">
                                        <label class="mayus-bold">DEXTROSTIX</label>
                                        <input type="text" name="sv_dextrostix" value="<?=$SignosVitales['sv_dextrostix']?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 <?=SiGH_ENFERMERIA_SOLICITAR_OD=='No' ?'hidden' : 'm-t-5'?>">
                                    <div class="form-group">
                                        <label class="mayus-bold">GLICEMIA CAPILAR</label>
                                        <input type="text" name="sv_glicemia" value="<?=$SignosVitales['sv_glicemia']?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group" >
                                        <label>TENSIÓN ARTERIAL </label>
                                        <div class="row">
                                            <div class="col-xs-6" style="padding-right: 0px;">
                                                <input type="text" class="form-control sv"  name="sv_sistolica" data-title="SISTÓLICA" placeholder="EJ. 120" value="<?=$SignosVitales['sv_sistolica']?>" >   
                                            </div>
                                            <div class="col-xs-1" style="padding: 0px">
                                                <h5 class="no-margin text-center" style="font-size: 30px">/</h5>
                                            </div>
                                            <div class="col-xs-5" style="padding-right: 0px;padding-left: 0px
                                                 ">
                                                <input type="text" class="form-control sv"  name="sv_diastolica" data-title="DIASTÓLICA" placeholder="EJ. 80" value="<?=$SignosVitales['sv_diastolica']?>" >   
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>TEMPERATURA</label>
                                        <input type="text" class="form-control sv" name="sv_temp" placeholder="TEMPERATURA" data-title="TEMPERATURA" value="<?=$SignosVitales['sv_temp']?>">   
                                    </div><!--TEMPERATURE-->
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label>FRECUENCIA CARD.</label>
                                        <input type="text" class="form-control sv" name="sv_fc" placeholder="FRECUENCIA CARD." data-title="FRECUENCIA CARD."  value="<?=$SignosVitales['sv_fc']?>">   
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                         <label>FRECUENCIA RESP.</label>
                                         <input type="text" class="form-control sv" name="sv_fr" placeholder="FRECUENCIA RESP." data-title="FRECUENCIA RESP."  value="<?=$SignosVitales['sv_fr']?>">   
                                    </div>
                                </div>
                                <div class="col-xs-offset-6 col-xs-3">
                                    <button type="button" class="btn btn-block btn-danger" onclick="location.href=base_url+'Triage/Enfermeriatriage'">Cancelar</button>
                                </div>
                                <div class="col-xs-3">
                                    <input type="hidden" name="via" value="<?=$_GET['via']?>">
                                    <input type="hidden" name="ingreso_id" value="<?=$this->uri->segment(3)?>">
                                    <input type="hidden" name="sv_via" value="Manual">
                                    <input type='hidden' name="empleado_id" value="<?=$this->UMAE_USER?>">
                                    <input type="hidden" name="paciente_id" value="<?=$info['paciente_id']?>">
                                    <input type='hidden' name="empleado_area" value="<?=$this->UMAE_AREA?>">
                                    <input type="hidden" name="ingreso_validar_indentificador" value="<?=$info['ingreso_validar_indentificador']=='' ? 'No': $info['ingreso_validar_indentificador']?>"> 
                                    <input type="hidden" name="ingreso_pv" value="<?=$info['ingreso_pv']=='' ?'Primera vez' :'Subsecuente'?>">
                                    <button class="btn btn-block sigh-background-primary" type="submit" >Guardar</button>                     
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/libs/moment.js?')?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/Enfermeriatriage.js?').date('YmdHis')?>" type="text/javascript"></script>