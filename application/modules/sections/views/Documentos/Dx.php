<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-20" >
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary text-center" style="">
                <h4 class="color-white no-margin semi-bold">AGREGAR DIAGNÓSTICOS</h4>
            </div>
            <div class="grid-body">
                <form class="form-add-dx-paciente">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <select class="width100" name="dx_tipo" required="">
                                    <option value="">SELECCIONAR TIPO DE DIAGNÓSTICO...</option>
                                    <?php if($Check==0){?>
                                    <option value="PRIMARIO">PRIMARIO</option>
                                    <?php }?>
                                    <option value="SECUNDARIO">SECUNDARIO</option>
                                </select>
                            </div>
                            <div class="form-group form-dx-primario hide">
                                <div class="alert alert-warning text-uppercase" style="padding: 6px">
                                    <h6 style="margin: 0px;font-size: 10px" class="line-height">YA SE HA AGREGADO <?= count($DxPrimario)?>  DX PARA ESTE PACIENTE DE LA ESPECIALIDAD DE <b><?=$_GET['Especialidad']?></b></h6>
                                    <hr class="hr-style1">
                                    <ol>
                                        <?php foreach ($DxPrimario as $value){?>
                                        <li>
                                            <h6 style="margin: 0px;font-size: 10px" class="line-height">
                                                <b>DX:</b> <?=$value['dx_dx']?><br>
                                                <b>MÉDICO:</b> <?=$value[0]['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?>
                                            </h6>
                                        </li>
                                        <?php }?>
                                    </ol>
                                    <h6 style="margin: 0px;font-size: 10px" class="line-height">
                                    <b>¿DESEA AGREGAR OTRO DX PRIMARIO PARA ESTA ESPECIALIDAD?</b><br>
                                    <label class="md-check">
                                        <input type="radio" name="ADD_MORE_DX" value="SI"><i class="blue"></i>SI
                                    </label>&nbsp;&nbsp;
                                    <label class="md-check">
                                        <input type="radio" name="ADD_MORE_DX" value="NO" checked=""><i class="blue"></i>NO
                                    </label>
                                    </h6>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="dx_dx" rows="2" required="" placeholder="AGREGAR DIAGNOSTICO..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="mayus-bold text-center">Diagnósticos cie10</label>
                                <select name="cie10_n1" class="width100" required="">
                                    <option value="" selected="">Seleccionar uno de la Lista...</option>
                                    <option value="19:XIX">XIX Traumatismos, envenenamientos y algunas otras consecuencias de causa externa</option>
                                    <option value="1:I">I Ciertas enfermedades infecciosas y parasitarias</option>
                                    <option value="2:II">II Neoplasias</option>
                                    <option value="3:III">III Enfermedades de la sangre y de los organos hematopoyeticos y otros trastornos que afectan el mecanismo de la inmunidad</option>
                                    <option value="4:IV">IV Enfermedades endocrinas, nutricionales y metabolicas</option>
                                    <option value="5:V">V Trastornos mentales y del comportamiento</option>
                                    <option value="6:VI">VI Enfermedades del sistema nervioso</option>
                                    <option value="7:VII">VII Enfermedades del ojo y sus anexos</option>
                                    <option value="8:VIII">VIII Enfermedades del oido y de la apofisis mastoides</option>
                                    <option value="9:IX">IX Enfermedades del sistema circulatorio</option>
                                    <option value="10:X">X Enfermedades del sistema respiratorio</option>
                                    <option value="11:XI">XI Enfermedades del aparato digestivo</option>
                                    <option value="12:XII">XII Enfermedades de la piel y el tejido subcutaneo</option>
                                    <option value="13:XIII">XIII Enfermedades del sistema osteomuscular y del tejido conectivo</option>
                                    <option value="14:XIV">XIV Enfermedades del aparato genitourinario</option>
                                    <option value="15:XV">XV Embarazo, parto y puerperio</option>
                                    <option value="16:XVI">XVI Ciertas afecciones originadas en el periodo perinatal</option>
                                    <option value="17:XVII">XVII Malformaciones congenitas, deformidades y anomalias cromosomicas</option>
                                    <option value="18:XVIII">XVIII Sintomas, signos y hallazgos anormales clinicos y de laboratorio, no clasificados en otra parte</option>

                                    <option value="20:XX">XX Causas extremas de morbilidad y de mortalidad</option>
                                    <option value="21:XXI">XXI Factores que influyen en el estado de salud y contacto con los servicios de salud</option>
                                </select>
                            </div>
                            <div class="form-group cie10_n2">
                                <select name="cie10_n2" id="cie10_n2" class="width100" required=""></select>
                            </div>
                            <div class="form-group cie10_n3">
                                <select name="cie10_n3" id="cie10_n3" class="width100" required=""></select>
                            </div>
                            <div class="form-group cie10_n4">
                                <select name="cie10_n4" id="cie10_n4" class="width100" required=""></select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <input type="hidden" name="dx_especialidad" value="<?=$_GET['Especialidad']?>">
                            <input type="hidden" name="dx_temp" value="<?=$_GET['temp']?>">
                            <input type="hidden" name="ingreso_id" value="<?=$_GET['ingreso']?>">
                            <input type="hidden" name="input_text" value="<?=$_GET['input']?>">
                            <input type="hidden" name="DxPrimario" value="<?=count($DxPrimario)?>">
                            <button class="md-btn md-fab md-fab-bottom-right pos-fix red" data-accion="No" data-dx="<?=$DxPrimario[0]['dx_dx']?>| DX CIE10:<?=$DxPrimario[0]['cie10_n4']?>">
                                <i class="material-icons i-24 color-white">check</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>
