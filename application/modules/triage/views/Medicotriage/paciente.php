<?= modules::run('Sections/Menu/loadHeader'); ?> 

<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <div class="row sigh-background-secundary" style="margin-top: -15px;padding: 10px;margin-bottom: -14px">
                            <div class="col-md-8" style="padding-left:10px">
                                <h3 class="color-white no-margin text-uppercase">
                                    <b><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?> </b>
                                </h3>
                                <h4 class="color-white no-margin">
                                    <?=$info['paciente_sexo']?> <?=$info['paciente_sexo']=='Si' ? '| Posible Embarazo' : ''?> |
                                    <?php 
                                        if($info['paciente_fn']!=''){
                                            $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                            if($fecha->y<15){
                                                echo 'PEDIATRICO';
                                            }if($fecha->y>15 && $fecha->y<60){
                                                echo 'ADULTO';
                                            }if($fecha->y>60){
                                                echo 'GERIATRICO';
                                            }
                                        }else{
                                            echo 'S/E';
                                        }
                                    ?> | <?=$info['info_procedencia_esp']=='Si' ? 'ESPONTANEA: '.$info['info_procedencia_esp_lugar'] : ': '.$info['info_procedencia_hospital'].' '.$info['info_procedencia_hospital_num']?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <h5 class="color-white no-margin">EDAD</h5>
                                <h1 class="color-white no-margin">
                                    <?php 
                                    if($info['paciente_fn']!=''){
                                        $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                        echo $fecha->y.' <span style="font-size:25px"><b>Años</b></span>';
                                    }else{
                                        echo 'S/E';
                                    }
                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="grid-title">
                        <div class="row sigh-background-secundary" style="margin-top: 0px">
                            <div class="col-md-12 " style="margin-bottom: 0px;">
                                <h6 class="color-white" style="font-size: 8px;text-align: right;">
                                    FECHA Y HORA DE REGISTRO: 
                                    <b><?=$info['ingreso_date_horacero']?> <?=$info['ingreso_time_horacero']?></b>
                                </h6>
                            </div>
                            <div class="col-md-3 text-center back-imss" style="padding-left: 0px;padding: 0px;">
                                <h5 class="color-white no-margin semi-bold">TENSIÓN ARTERIAL</h5>
                                <h3 class="color-white no-margin"> <?=$SignosVitales['sv_sistolica']?>/<?=$SignosVitales['sv_diastolica']?></h3><br>
                            </div>
                            <div class="col-md-3  text-center back-imss" style="border-left: 1px solid white;padding: 0px;">
                                <h5 class="color-white no-margin semi-bold">TEMPERATURA</h5>
                                <h3 class="color-white no-margin"> <?=$SignosVitales['sv_temp']?> °C</h3>
                            </div>
                            <div class="col-md-3  text-center back-imss" style="border-left: 1px solid white;padding: 0px;">
                                <h5 class="color-white no-margin semi-bold">FRECUENCIA CARDIACA  </h5>
                                <h3 class="color-white no-margin"> <?=$SignosVitales['sv_fc']?> X MIN</h3>
                            </div>
                            <div class="col-md-3  text-center back-imss" style="border-left: 1px solid white;padding: 0px;">
                                <h5 class="color-white no-margin semi-bold">FRECUENCIA RESPIRATORIA </h5>
                                <h3 class="color-white no-margin"> <?=$SignosVitales['sv_fr']?> X MIN</h3>
                            </div>
                        </div>
                        <div class="row sigh-background-secundary <?=SiGH_ENFERMERIA_SOLICITAR_OD=='Si'? '': 'hide'?>">
                            <div class="col-md-3 text-center back-imss m-t-10" style="padding-left: 0px;padding: 0px;">
                                <h5 class="color-white no-margin semi-bold">OXIMETRIÁ</h5>
                                <h3 class="color-white no-margin"> <?=$SignosVitales['sv_oximetria']?></h3><br>
                            </div>
                            <div class="col-md-3 text-center back-imss m-t-10" style="border-left: 1px solid white;padding-left: 0px;padding: 0px;">
                                <h5 class="color-white no-margin semi-bold">GLICEMIA CAPILAR</h5>
                                <h3 class="color-white no-margin"> <?=$SignosVitales['sv_glicemia']?></h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="grid-body" style="margin-top: -7px">
                        <form class="agregar-paso2">
                            <?php if(SiGH_EXCEPCION_CMT=='Si'){ ?>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group " style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">OMITIR CLASIFICACIÓN</h5>
                                    </div>
                                </div>
                                <div class="col-md-4 m-b-15" >
                                    <label class="md-check mayus-bold">
                                        <input type="radio" name="clasificacion_omision" value="Si">
                                        <i class="blue"></i>Si
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="md-check mayus-bold">
                                        <input type="radio" name="clasificacion_omision" value="No" checked="">
                                        <i class="blue"></i>No
                                    </label>
                                </div>
                                <div class="col-md-12 row-clasificacion-omitida hide m-t-10">
                                    <div class="form-group " style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                        <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">ELEGIR COLOR DE CLASIFICACIÓN</h5>
                                    </div>
                                    <div class="form-group">
                                        
                                        <label class="md-check mayus-bold">
                                            <input type="radio" name="clasificacionColor" value="Rojo" >
                                            <i class="blue"></i>Rojo
                                        </label>&nbsp;&nbsp;
                                        <label class="md-check mayus-bold">
                                            <input type="radio" name="clasificacionColor" value="Naranja" >
                                            <i class="blue"></i>Naranja
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check mayus-bold">
                                            <input type="radio" name="clasificacionColor" value="Amarillo">
                                            <i class="blue"></i>Amarillo
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check mayus-bold">
                                            <input type="radio" name="clasificacionColor" value="Verde" >
                                            <i class="blue"></i>Verde
                                        </label>&nbsp;&nbsp;&nbsp;
                                        <label class="md-check mayus-bold">
                                            <input type="radio" name="clasificacionColor" value="Azul">
                                            <i class="blue"></i>Azul
                                        </label>&nbsp;&nbsp;&nbsp;
                                        
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <div class="row m-t-10" >
                                <div class="col-md-12 col-omitir-clasificacion">
                                    <table class="evaluar-medico-area-efectiva table table-bordered  table-striped" >
                                        <caption class="text-center sigh-background-secundary">
                                            <h5 class="text-uppercase semi-bold color-white no-margin">Evalúa la necesidad de atención inmediata</h5>
                                        </caption>
                                        <thead class="" >
                                            <tr>
                                                <th style="width: auto" class="text-center">
                                                    <h5 class="no-margin semi-bold">PARÁMETRO</h5>
                                                </th>
                                                <th style="width: auto" class="text-center">
                                                    <h5 class="no-margin semi-bold">AUSENTE</h5>
                                                </th>
                                                <th style="width: auto" class="text-center">
                                                    <h5 class="no-margin semi-bold">PRESENTE</h5>
                                                </th>
                                            </tr>      
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Pérdida súbita del estado de alerta</h6>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" checked="" name="clasificacion_preg1_s1" value="0" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg1_s1" value="31" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Apnea</h6>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg2_s1" checked="" value="0" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                        
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg2_s1" value="31" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                        
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Ausencia de pulso</h6>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg3_s1" checked="" value="0" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg3_s1" value="31" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Intubación de vía respiratoria</h6>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" checked="" name="clasificacion_preg4_s1" value="0" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td> 
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg4_s1" value="31" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Angor o equivalente</h6>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg5_s1" checked="" value="0" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="md-check">
                                                            <input type="radio" name="clasificacion_preg5_s1" value="31" class="has-value input-radio-medico">
                                                            <i class="green"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 col-omitir-clasificacion" >
                                    <br>
                                    <table class="evaluar-medico-area-efectiva table table-striped table-bordered table-no-padding">
                                        <caption class="mayus-bold text-center sigh-background-secundary">
                                            <h5 class="no-margin text-uppercase semi-bold color-white">Evalúa el motivo de atención y algún otro dato relevante que se detecte en el paciente</h5>
                                        </caption>
                                        <thead>
                                            <tr>
                                                <th style="width: 20%" class="mayus-bold">
                                                    <h6 class="no-margin semi-bold">PARÁMETRO</h6>
                                                </th>
                                                <th style="width: 75%" colspan="4" class="mayus-bold">
                                                    <h6 class="no-margin semi-bold">PUNTUACIÓN</h6></th>
                                                <th style="width: 10%"  class="mayus-bold">
                                                    <h6 class="no-margin semi-bold">PUNTAJE</h6>
                                                </th>
                                            </tr>      
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td ></td>
                                                <td colspan="">0</td>
                                                <td>5</td>
                                                <td>10</td>
                                                <td colspan="2">15</td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Traumatismo</h6>
                                                </td>
                                                <td >
                                                    <label class="md-check ">
                                                        <input type="radio" name="clasificacion_preg1_s2" value="0" checked="" class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Menor: cuando es única y no pone en riesgo la vida ni la función de algún órgano o sistema;">
                                                        <input type="radio" name="clasificacion_preg1_s2" value="5" class="has-value input-radio-medico" >
                                                        <i class="green"></i>Menor
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Moderado: cuando siendo única o múltiple, pone en riesgo la función del órgano o sistema afectado en forma transitoria">
                                                        <input type="radio" name="clasificacion_preg1_s2" value="10" class="has-value input-radio-medico" >
                                                        <i class="green"></i>Moderado
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Mayor: cuando es múltiple, ha provocado fracturas expuestas y/o pone en riesgo la vida o función del órgano o sistema">
                                                        <input type="radio" name="clasificacion_preg1_s2" value="15" class="has-value input-radio-medico" >
                                                        <i class="green"></i>Mayor
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Herida(s)</h6></td>
                                                <td>
                                                    <label class="md-check tip" >
                                                        <input type="radio" name="clasificacion_preg2_s2" value="0" checked="" class="has-value input-radio-medico" >
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Superficial: cuando sólo involucra piel y tejido celular subcutáneo;">
                                                        <input type="radio" name="clasificacion_preg2_s2" value="5" class="has-value input-radio-medico" >
                                                        <i class="green"></i>Superficial
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="No penetrante: cuando sobrepasa los planos anteriores, pero no involucra alguna cavidad;">
                                                        <input type="radio" name="clasificacion_preg2_s2" value="10" class="has-value input-radio-medico" >
                                                        <i class="green"></i>No Penetrante
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Extensa-profunda: cuando involucra la apertura de una o más de las cavidades corporales (cráneo, tórax o abdomen), o cuando por ser múltiples o de gran tamaño ponen en peligro inminente la vida o la función de órganos o sistemas.">
                                                        <input type="radio" name="clasificacion_preg2_s2" value="15" class="has-value input-radio-medico" >
                                                        <i class="green"></i>Extensa-profunda:
                                                    </label>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td  class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Aumento del trabajo respiratorio</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check">
                                                        <input type="radio" name="clasificacion_preg3_s2" value="0" checked="" class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>

                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Leve: cuando sólo se observa un incremento en la frecuencia respiratoria;">
                                                        <input type="radio" name="clasificacion_preg3_s2" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>Leve
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Moderado: cuando se observa un incremento del trabajo de los músculos accesorios de la respiración,los intercostales;">
                                                        <input type="radio" name="clasificacion_preg3_s2" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>Moderado
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Severo: cuando el incremento; además, de lo anterior, involucran los músculos abdominales y del cuello.">
                                                        <input type="radio" name="clasificacion_preg3_s2" value="15" class="has-value input-radio-medico">
                                                        <i class="green"></i>Severo
                                                    </label>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Cianosis</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" checked="" name="clasificacion_preg4_s2" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Leve: cuando está presente en labios y lechos ungueales;">
                                                        <input type="radio" name="clasificacion_preg4_s2" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>Leve
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Moderada: cuando además de lo anterior está presente en las extremidades;">
                                                        <input type="radio" name="clasificacion_preg4_s2" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>Moderado
                                                    </label>

                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Severa: cuando es generalizada.">
                                                        <input type="radio" name="clasificacion_preg4_s2" value="15" class="has-value input-radio-medico">
                                                        <i class="green"></i>Severo
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Palidez</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Severa: cuando es generalizada.">
                                                        <input type="radio" name="clasificacion_preg5_s2" value="0" checked="" class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Leve: cuando está circunscrita a las regiones distales (lóbulos de las orejas, punta de los dedos, punta de la nariz, etc.);">
                                                        <input type="radio" name="clasificacion_preg5_s2" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>Leve
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Moderada: cuando abarca palmas, labios, lengua, mucosa oral y palpebral;">
                                                        <input type="radio" name="clasificacion_preg5_s2" value="10"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Moderado
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Severa: cuando es generalizada y la decoloración es intensa.">
                                                        <input type="radio" name="clasificacion_preg5_s2" value="15"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Severo
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Hemorragia</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg6_s2" checked="" value="0"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Inactiva-leve: cuando no hay extravasación sanguínea al momento de la evaluación o el volumen perdido es aproximadamente menor al 15% y causa síntomas clínicos mínimos sobre la frecuencia cardiaca, la tensión arterial o el estado de alerta;">
                                                        <input type="radio" name="clasificacion_preg6_s2" value="5"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Inactiva-Leve
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Moderada: cuando el volumen perdido es aproximadamente entre el 15 y el 30%, la frecuencia cardiaca es mayor de 100 latidos por minuto, pero menor a 140, puede haber ansiedad o confusión y la tensión arterial aun se mantiene dentro de la normalidad;">
                                                        <input type="radio" name="clasificacion_preg6_s2" value="10"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Moderado
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Severa: cuando el volumen perdido es aproximadamente mayor al 30%, la frecuencia cardiaca supera los 140 latidos por minuto o es menor de 60; la tensión arterial ha descendido de la normalidad y neurológicamente puede existir confusión o letargo.">
                                                        <input type="radio" name="clasificacion_preg6_s2" value="15"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Severa
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Dolor (Escala análoga visual 0-10)</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg7_s2" checked="" value="0"  class="has-value input-radio-medico">
                                                        <i class="green"></i>0
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg7_s2" value="5"  class="has-value input-radio-medico">
                                                        <i class="green"></i>1-4/10
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg7_s2" value="10"  class="has-value input-radio-medico">
                                                        <i class="green"></i>5-8/10
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg7_s2" value="15"  class="has-value input-radio-medico">
                                                        <i class="green"></i>9-10/10
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Intoxicación o auto-daño</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg8_s2" value="0" checked=""  class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                               </td>
                                                <td>

                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg8_s2" value="10"  class="has-value input-radio-medico">
                                                        <i class="green"></i>Dudosa
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg8_s2" value="15" class="has-value input-radio-medico">
                                                        <i class="green"></i>Evidente
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Convulsiones</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg9_s2" value="0" checked=""  class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg9_s2" value="10"class="has-value input-radio-medico">
                                                        <i class="green"></i>Estado Postictal
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg9_s2" value="15"class="has-value input-radio-medico">
                                                        <i class="green"></i>Presente
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Escala de Glasgow Neurológico</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg10_s2" value="0" checked="" class="has-value input-radio-medico">
                                                        <i class="green"></i>15
                                                    </label>

                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg10_s2" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>14-12
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg10_s2" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>11-8
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg10_s2" value="15" class="has-value input-radio-medico">
                                                        <i class="green"></i><8
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Deshidratación</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" checked="" name="clasificacion_preg11_s2" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg11_s2" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>Leve
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg11_s2" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>Moderado
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg11_s2" value="15" class="has-value input-radio-medico">
                                                        <i class="green"></i>Presente
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Psicosis, agitación o violencia</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" checked="" name="clasificacion_preg12_s2" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>Ausente
                                                    </label>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="Está conformada por los signos vitales y cuando sea necesario la medición de glucemia capilar del paciente. En esta sección la escala de medición tiene los valores normales ubicados en la columna central y las desviaciones de la normalidad a izquierda o derecha de acuerdo a que sean menores de la normalidad o mayores a la misma; la primera desviación (menos grave) se le da un valor de 5 puntos y la segunda desviación (más grave) se le asignan 10 puntos.">
                                                        <input type="radio" name="clasificacion_preg12_s2" value="15" class="has-value input-radio-medico">
                                                        <i class="green"></i>Presente
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <table class="evaluar-medico-area-efectiva table table-striped table-bordered table-no-padding" >
                                        <thead>
                                            <tr>
                                                <th style="width: auto" class="mayus-bold">
                                                    <h6 class="no-margin semi-bold">PARÁMETRO</h6>
                                                </th>
                                                <th style="width: auto" colspan="5" class="mayus-bold">
                                                    <h6 class="no-margin semi-bold">PUNTUACIÓN</h6>
                                                </th>
                                                <th style="width: auto" class="mayus-bold">
                                                    <h6 class="no-margin semi-bold">PUNTAJE</h6>
                                                </th>
                                            </tr>      
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td >10</td>
                                                <td >5</td>
                                                <td>0</td>
                                                <td>5</td>
                                                <td>10</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Frecuencia Cardiaca</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg1_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i><40
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg1_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>40 -59 
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg1_s3" checked="" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>60 – 100
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg1_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>101 – 140
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg1_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>>140
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Temperatura °C</h6></td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg2_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i><34.5
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg2_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>34.5 - 35.9 
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg2_s3" checked="" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>36 – 37
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg2_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>37.1 – 39
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg2_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>>39
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Frecuencia Respiratoria</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg3_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i><8
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg3_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>8 - 12 
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg3_s3" checked="" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>13 – 18
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg3_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>19 – 25
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg3_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>>25
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Tensión Arterial</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg4_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i><70 /50
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg4_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>70/50 - 90/60 
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg4_s3" checked="" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>91/61 – 120/80
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg4_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>121/81 - 160/110 
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg4_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>>160/110
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="mayus-bold">
                                                    <h6 class="no-margin text-uppercase">Glicemia capilar</h6>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg5_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i><40
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio" name="clasificacion_preg5_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>40 -60 
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg5_s3" checked="" value="0" class="has-value input-radio-medico">
                                                        <i class="green"></i>61 – 140
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg5_s3" value="5" class="has-value input-radio-medico">
                                                        <i class="green"></i>141 – 400
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="md-check tip" data-original-title="">
                                                        <input type="radio"  name="clasificacion_preg5_s3" value="10" class="has-value input-radio-medico">
                                                        <i class="green"></i>>400
                                                    </label>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="clasificacionObservacion" class="form-control" rows="5" maxlength="590" placeholder="AGREGAR OBSERVACIONES..."></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="row ">
                                
                            </div>
                            <div class="row hide"><br><br>
                                <input type="hidden" name="SolicitudRx" value="Si">
                                <div class="col-md-12 col-omitir-clasificacion" style="padding: 0px">
                                    <table class="table table-bordered table-striped table-solicitudes-rx-triage">
                                        <caption class="text-center sigh-background-secundary">
                                            <h5 class="no-margin semi-bold color-white">SOLICITUDES DE ESTUDIOS DE RX</h5>
                                            <button class="btn btn-circle btn-60 red btn-rx-nueva-solicitud" data-id="0" data-dx="" data-ingreso="<?=$this->uri->segment(3)?>" data-accion="add" style="position: absolute;top: -16px;right: 0px">
                                                <i class="material-icons color-white i-tiny" >library_add</i>
                                            </button>
                                        </caption>
                                        <thead>
                                            <tr>
                                                <th style="width: 20%">FECHA & HORA</th>
                                                <th>DX PRESUNCIONAL</th>
                                                <th style="width: 25%">M. SOLICITANTE</th>
                                                <th style="width: 15%">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12 back-imss pointer hide">
                                    <h5 class=" text-center mayus-bold">CODIGO INFARTO</h5>
                                    <button class="btn btn-circle btn-60 red col-seleccionar-codigo" data-id="0" data-dx="" data-triage="<?=$this->uri->segment(3)?>" data-accion="add" style="position: absolute;top: -16px;right: 0px">
                                        <i class="fa fa-heartbeat color-white i-tiny"></i>
                                    </button>
                                </div>
                                <div class="col-md-12 col-seleccion-codigo"></div>
                            </div>
                            <div class="test"></div>
                            <div class="row">
                                <div class="col-md-offset-9 col-md-3">
                                    <input type="hidden" name="ingreso_id" value="<?=$this->uri->segment(3)?>">
                                    <input type="hidden" name="paciente_id" value="<?=$info['paciente_id']?>">
                                    <input type="hidden" name="ingreso_destino_triage" value="">
                                    <input type="hidden" name="ingreso_solicitud_rx" value="No" >
                                    <input type="hidden" name="ingreso_enviar_a" placeholder="ingreso_enviar_a">
                                    <input type="hidden" name="ac_diagnostico" placeholder="ac_diagnostico" ">
                                    <input type="hidden" name="paciente_nombre" placeholder="paciente_nombre">
                                    <input type="hidden" name="paciente_ap" placeholder="paciente_ap">
                                    <input type="hidden" name="paciente_am" placeholder="paciente_am">
                                    <input type="hidden" name="ingreso_vigenciaacceder" value="" placeholder="ingreso_vigenciaacceder">
                                    <input type="hidden" name="paciente_fn" placeholder="paciente_fn">
                                    <input type="hidden" name="paciente_sexo" placeholder="paciente_sexo">
                                    <input type="hidden" name="paciente_nss" placeholder="paciente_nss">
                                    <input type="hidden" name="paciente_nss_agregado" placeholder="paciente_nss_agregado">
                                    <input type="hidden" name="info_umf" placeholder="info_umf">
                                    <input type="hidden" name="info_delegacion" placeholder="info_delegacion">
                                    <input type="hidden" name="ingreso_consultorio" placeholder="ingreso_consultorio">
                                    <input type="hidden" name="ingreso_consultorio_nombre" placeholder="ingreso_consultorio_nombre">
                                    <input type="hidden" name="paciente_curp" placeholder="paciente_curp" value="<?=$info['paciente_curp']?>">
                                    <input type="hidden" name="solicitud_id" placeholder="solicitud_id">
                                    <input type="hidden" name="clasificacion_notas" value="">
                                    <br>
                                    <button class="btn pull-right sigh-background-primary btn-submit-paso2 btn-block" type="submit" style="margin-bottom: -10px">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="alert alert-danger msj-clasificacion"  style="position: fixed;width: 25%; top: 64px;right: -1px;border:0px transparent;display: none">
                <h3 class=" no-margin color-white">0</h3>
            </div>
        </div>
    </div>
</div>

<?= modules::run('Sections/Menu/loadFooter'); ?> 

<input type="hidden" name="SIGH_VALIDAR_VIGENCIA" value="<?=SIGH_VALIDAR_VIGENCIA?>">
<input type="hidden" name="ConfigDestinosMT" value="<?=$this->ConfigDestinosMT?>">
<script src="<?= base_url('assets/js/Medicotriage.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>