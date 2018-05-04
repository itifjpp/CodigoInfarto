<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered" style="margin-top: -20px">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center;text-transform: uppercase">DATOS DEL PACIENTE Y CLASIFICACIÓN</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="card-body" >
                        <form class="guardar-triage-choque">
                            <div class="row row-sm" style="margin-left: -40px">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="md-form-group" style="margin-top: -35px">
                                                <label>Nombre </label>
                                                <input class="md-input" name="triage_nombre" required="" placeholder="Ejemplo: Fuentes Cervantes Manuel Alejandro." value="<?=$info['triage_nombre']?> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?>">   
                                                
                                            </div>          
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group" style="margin-top: -35px">
                                                <label>Fecha de Nac</label>
                                                <input class="md-input dd-mm-yyyy" name="triage_fecha_nac" required="" placeholder="Ej. 03/03/2013" value="<?=$info['triage_fecha_nac']?>">   
                                            </div>                   
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form-group" style="margin-top: -10px">
                                                <label>Procedencia Espontánea: </label>&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="triage_procedencia_espontanea" value="Si" checked="" class="has-value "><i class="green"></i>SI
                                                </label>&nbsp;&nbsp;
                                                <label class="md-check">
                                                    <input type="radio" name="triage_procedencia_espontanea" value="No"><i class="green"></i>NO
                                                </label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input class="md-input " required="" style="" type="text" name="triage_procedencia" placeholder="Lugar de Procedencia" value="<?=$info['triage_procedencia']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-no-espontaneo hidden">
                                            <div class="form-group" style="margin-top: -15px">
                                                <select name="triage_hospital_procedencia" data-value="<?=$info['triage_hospital_procedencia']?>" class="md-input">
                                                    <option value="">Seleccionar Hospital de Procedencia</option>
                                                    <option value="UMF">UMF</option>
                                                    <option value="HGZ">HGZ</option>
                                                    <option value="UMAE">UMAE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-no-espontaneo hidden">
                                            <div class="form-group" style="margin-top: -15px">
                                                <input class="md-input" placeholder="Nombre Hospital/ Numero Ejemplo: 36" name="triage_hostital_nombre_numero"  value="<?=$info['triage_hostital_nombre_numero']?>">   
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_2.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Tensión arterial: </label>
                                        </a>
                                        <input class="md-input " placeholder="Ejemplo: 130/90" name="triage_tension_arterial"  value="<?=$info['triage_tension_arterial']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_1.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Temperatura: </label>
                                        </a>
                                        <input class="md-input" placeholder="Ejemplo: 37" name="triage_temperatura"  value="<?=$info['triage_temperatura']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_3.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Frecuencia cardiaca o pulso: </label>
                                        </a>
                                        <input class="md-input" placeholder="Ejemplo: 78" name="triage_frecuencia_cardiaco"  value="<?=$info['triage_frecuencia_cardiaco']?>">   
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="md-form-group" style="margin-top: -20px">
                                        <a href="<?=  base_url()?>assets/triage/anexo_4.pdf" target="blank" style="cursor: pointer;color: #5697E6">
                                            <label>Frecuencia respiratoria: </label>
                                        </a>
                                        <input class="md-input" placeholder="Ejemplo: 37" name="triage_frecuencia_respiratoria"  value="<?=$info['triage_frecuencia_respiratoria']?>">   
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="row">
                                    <br><br>
                                    <style>table {border-collapse: collapse; width: 100%;}th, td {text-align: left;padding: 8px;}tr:nth-child(even){background-color: #f2f2f2} th {background-color: #4CAF50;color: white;}</style>
                                    <table class="evaluar-medico-area-efectiva" style="margin-top: -20px">
                                        <thead>
                                            <tr>
                                                <th style="width: auto" class="text-center">Parámetro</th>
                                                <th style="width: auto" class="text-center">Ausente</th>
                                                <th style="width: auto" class="text-center">Presente</th>
                                            </tr>      
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td >Pérdida súbita del estado de alerta</td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg1_s1" value="0" checked="" class="has-value">
                                                            <i class="red"></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg1_s1" value="31" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Apnea</td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg2_s1" value="0" checked="" class="has-value">
                                                            <i></i>
                                                        </label>
                                                        
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg2_s1" value="31" class="has-value">
                                                            <i></i>
                                                        </label>
                                                        
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Ausencia de pulso</td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg3_s1" value="0" checked="" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg3_s1" value="31" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Intubación de vía respiratoria</td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg4_s1" checked="" value="0" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg4_s1" value="31" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Angor o equivalente</td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg5_s1" value="0" checked="" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <label class="ui-checks ui-checks-lg">
                                                            <input type="radio" name="triage_preg5_s1" value="31" class="has-value">
                                                            <i></i>
                                                        </label>
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <p class="text-center">
                                    <strong style="text-transform: uppercase">
                                        Evalúa el motivo de atención y algún otro dato relevante que se detecte en el paciente
                                    </strong>
                                </p>
                                <br>
                                <table class="evaluar-medico-area-efectiva">
                                    <thead>
                                        <tr>
                                            <th style="width: auto" >Parámetro</th>
                                            <th style="width: auto" colspan="4">Puntuación</th>
                                            <th style="width: auto">Puntaje</th>
                                        </tr>      
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td ></td>
                                            <td colspan="">0</td>
                                            <td>5</td>
                                            <td>10</td>
                                            <td>15</td>
                                        </tr>
                                        <tr>
                                            <td >Traumatismo</td>
                                            <td >
                                                <label class="ui-checks ui-checks-lg">
                                                    <input type="radio" name="triage_preg1_s2" value="0" checked="" class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Menor: cuando es única y no pone en riesgo la vida ni la función de algún órgano o sistema;">
                                                    <input type="radio" name="triage_preg1_s2" value="5" class="has-value" >
                                                    <i></i>Menor
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Moderado: cuando siendo única o múltiple, pone en riesgo la función del órgano o sistema afectado en forma transitoria">
                                                    <input type="radio" name="triage_preg1_s2" value="10" class="has-value" >
                                                    <i></i>Moderado
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Mayor: cuando es múltiple, ha provocado fracturas expuestas y/o pone en riesgo la vida o función del órgano o sistema">
                                                    <input type="radio" name="triage_preg1_s2" value="15" class="has-value" >
                                                    <i></i>Mayor
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Herida(s)</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" >
                                                    <input type="radio" name="triage_preg2_s2" value="0" checked="" class="has-value" >
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Superficial: cuando sólo involucra piel y tejido celular subcutáneo;">
                                                    <input type="radio" name="triage_preg2_s2" value="5" class="has-value" >
                                                    <i></i>Superficial
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="No penetrante: cuando sobrepasa los planos anteriores, pero no involucra alguna cavidad;">
                                                    <input type="radio" name="triage_preg2_s2" value="10" class="has-value" >
                                                    <i></i>No Penetrante
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Extensa-profunda: cuando involucra la apertura de una o más de las cavidades corporales (cráneo, tórax o abdomen), o cuando por ser múltiples o de gran tamaño ponen en peligro inminente la vida o la función de órganos o sistemas.">
                                                    <input type="radio" name="triage_preg2_s2" value="15" class="has-value" >
                                                    <i></i>Extensa-profunda:
                                                </label>
                                                
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Aumento del trabajo respiratorio</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg">
                                                    <input type="radio" name="triage_preg3_s2" value="0" checked="" class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                                
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Leve: cuando sólo se observa un incremento en la frecuencia respiratoria;">
                                                    <input type="radio" name="triage_preg3_s2" value="5" class="has-value">
                                                    <i></i>Leve
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Moderado: cuando se observa un incremento del trabajo de los músculos accesorios de la respiración,los intercostales;">
                                                    <input type="radio" name="triage_preg3_s2" value="10" class="has-value">
                                                    <i></i>Moderado
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Severo: cuando el incremento; además, de lo anterior, involucran los músculos abdominales y del cuello.">
                                                    <input type="radio" name="triage_preg3_s2" value="15" class="has-value">
                                                    <i></i>Severo
                                                </label>
                                                
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Cianosis</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" checked="" name="triage_preg4_s2" value="0" class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Leve: cuando está presente en labios y lechos ungueales;">
                                                    <input type="radio" name="triage_preg4_s2" value="5" class="has-value">
                                                    <i></i>Leve
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Moderada: cuando además de lo anterior está presente en las extremidades;">
                                                    <input type="radio" name="triage_preg4_s2" value="10" class="has-value">
                                                    <i></i>Moderado
                                                </label>
                                                
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Severa: cuando es generalizada.">
                                                    <input type="radio" name="triage_preg4_s2" value="15" class="has-value">
                                                    <i></i>Severo
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Palidez</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Severa: cuando es generalizada.">
                                                    <input type="radio" name="triage_preg5_s2" value="0" checked="" class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Leve: cuando está circunscrita a las regiones distales (lóbulos de las orejas, punta de los dedos, punta de la nariz, etc.);">
                                                    <input type="radio" name="triage_preg5_s2" value="5" class="has-value">
                                                    <i></i>Leve
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Moderada: cuando abarca palmas, labios, lengua, mucosa oral y palpebral;">
                                                    <input type="radio" name="triage_preg5_s2" value="10"  class="has-value">
                                                    <i></i>Moderado
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Severa: cuando es generalizada y la decoloración es intensa.">
                                                    <input type="radio" name="triage_preg5_s2" value="15"  class="has-value">
                                                    <i></i>Severo
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Hemorragia</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg6_s2" checked="" value="0"  class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Inactiva-leve: cuando no hay extravasación sanguínea al momento de la evaluación o el volumen perdido es aproximadamente menor al 15% y causa síntomas clínicos mínimos sobre la frecuencia cardiaca, la tensión arterial o el estado de alerta;">
                                                    <input type="radio" name="triage_preg6_s2" value="5"  class="has-value">
                                                    <i></i>Inactiva-Leve
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Moderada: cuando el volumen perdido es aproximadamente entre el 15 y el 30%, la frecuencia cardiaca es mayor de 100 latidos por minuto, pero menor a 140, puede haber ansiedad o confusión y la tensión arterial aun se mantiene dentro de la normalidad;">
                                                    <input type="radio" name="triage_preg6_s2" value="10"  class="has-value">
                                                    <i></i>Moderado
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Severa: cuando el volumen perdido es aproximadamente mayor al 30%, la frecuencia cardiaca supera los 140 latidos por minuto o es menor de 60; la tensión arterial ha descendido de la normalidad y neurológicamente puede existir confusión o letargo.">
                                                    <input type="radio" name="triage_preg6_s2" value="15"  class="has-value">
                                                    <i></i>Severa
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Dolor (Escala análoga visual 0-10)</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg7_s2" checked="" value="0"  class="has-value">
                                                    <i></i>0
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg7_s2" value="5"  class="has-value">
                                                    <i></i>1-4/10
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg7_s2" value="10"  class="has-value">
                                                    <i></i>5-8/10
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg7_s2" value="15"  class="has-value">
                                                    <i></i>9-10/10
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Intoxicación o auto-daño</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg8_s2" value="0" checked=""  class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                           </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg8_s2" value="10"  class="has-value">
                                                    <i></i>Dudosa
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg8_s2" value="15" class="has-value">
                                                    <i></i>Evidente
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Convulsiones</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg9_s2" value="0" checked=""  class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td></td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg9_s2" value="10"class="has-value">
                                                    <i></i>Estado Postictal
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg9_s2" value="15"class="has-value">
                                                    <i></i>Presente
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Escala de Glasgow Neurológico</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg10_s2" value="0" checked="" class="has-value">
                                                    <i></i>15
                                                </label>
                                                
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg10_s2" value="5" class="has-value">
                                                    <i></i>14-12
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg10_s2" value="10" class="has-value">
                                                    <i></i>11-8
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg10_s2" value="15" class="has-value">
                                                    <i></i><8
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Deshidratación</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" checked="" name="triage_preg11_s2" value="0" class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg11_s2" value="5" class="has-value">
                                                    <i></i>Leve
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg11_s2" value="10" class="has-value">
                                                    <i></i>Moderado
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg11_s2" value="15" class="has-value">
                                                    <i></i>Presente
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Psicosis, agitación o violencia</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" checked="" name="triage_preg12_s2" value="0" class="has-value">
                                                    <i></i>Ausente
                                                </label>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="Está conformada por los signos vitales y cuando sea necesario la medición de glucemia capilar del paciente. En esta sección la escala de medición tiene los valores normales ubicados en la columna central y las desviaciones de la normalidad a izquierda o derecha de acuerdo a que sean menores de la normalidad o mayores a la misma; la primera desviación (menos grave) se le da un valor de 5 puntos y la segunda desviación (más grave) se le asignan 10 puntos.">
                                                    <input type="radio" name="triage_preg12_s2" value="15" class="has-value">
                                                    <i></i>Presente
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><br>
                                <table class="evaluar-medico-area-efectiva" >
                                    <thead>
                                        <tr>
                                            <th style="width: auto" >Parámetro</th>
                                            <th style="width: auto" colspan="5">Puntuación</th>
                                            <th style="width: auto">Puntaje</th>
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
                                            <td >Glicemia capilar</td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg5_s3" value="10" class="has-value">
                                                    <i></i><40
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio" name="triage_preg5_s3" value="5" class="has-value">
                                                    <i></i>40 -60 
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio"  name="triage_preg5_s3" checked="" value="0" class="has-value">
                                                    <i></i>61 – 140
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio"  name="triage_preg5_s3" value="5" class="has-value">
                                                    <i></i>141 – 400
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ui-checks ui-checks-lg tip" data-original-title="">
                                                    <input type="radio"  name="triage_preg5_s3" value="10" class="has-value">
                                                    <i></i>>400
                                                </label>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                    <input type="hidden" name="choque_tipo" value="Choque">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="triage_id" value="<?=$this->uri->segment(3)?>">
                                    <input type="hidden" name="triage_consultorio">
                                    <input type="hidden" name="triage_consultorio_nombre">
                                    <input type="hidden" name="triage_solicitud_rx" value="No">
                                    <input type="hidden" name="triage_enviar_a" >
                                    <br>
                                    <button class="btn btn-primary pull-right back-imss btn-triage-choque" type="submit" style="margin-bottom: -10px">
                                        Guardar y Continuar
                                    </button>                     
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
<script src="<?= base_url('assets/js/Enfermeriatriage.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/Choque.js?').md5(microtime())?>" type="text/javascript"></script>