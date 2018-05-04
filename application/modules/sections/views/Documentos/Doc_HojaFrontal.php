<?=Modules::run('Sections/Menu/loadHeader'); ?> 
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/libs/light-bootstrap/all.min.css" />
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered" >
                <div class="grid simple">
                    <div class="grid-body sigh-background-secundary" style="padding: 18px">
                        <?php if($SignosVitales['sv_ta']==''){?>
                        <div class="row ">
                            <div class="col-md-12 col-centered" >
                                <h6 class="color-white no-margin semi-bold text-center">EN ESPERA DE CAPTURA DE SIGNOS VITALES</h6>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="row ">
                            <div class="col-md-12 col-centered" style="">
                                <h6 class="color-white no-margin text-right" style="margin-top: -15px!important;font-size: 10px">
                                    FECHA Y HORA DE REGISTRO: <?=$info['ingreso_date_horacero']?> <?=$info['ingreso_time_horacero']?>
                                </h6>
                            </div>
                        </div>
                        <div class="row  m-t-5">
                            <div class="col-md-3 text-center">
                                <h5 class="color-white no-margin semi-bold">T.A</h5>
                                <h2 class="color-white no-margin"> <?=$SignosVitales['sv_ta']?></h2>
                            </div>
                            <div class="col-md-3  text-center" >
                                <h5 class="color-white no-margin semi-bold">TEMP</h5>
                                <h2 class="color-white no-margin"> <?=$SignosVitales['sv_temp']?> °C</h2>
                            </div>
                            <div class="col-md-3  text-center" >
                                <h5 class="color-white no-margin semi-bold">F.C</h5>
                                <h2 class="color-white no-margin"> <?=$SignosVitales['sv_fc']?> X MIN</h2>
                            </div>
                            <div class="col-md-3  text-center" >
                                <h5 class="color-white no-margin semi-bold">F.R</h5>
                                <h2 class="color-white no-margin"> <?=$SignosVitales['sv_fr']?> X MIN</h2>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="grid simple" style="margin-top: -10px">
                    <div class="" >
                        <?php if($_GET['tipo']=='Choque'){?>
                        <div class="hf_donador hide back-imss" style="height: 60px;width: 100%;text-align: left;margin-bottom: -35px;">
                            <span style="font-size: 30px;padding: 8px 5px 0px 14px;color: white"><b>POSIBLE DONADOR</b></span>
                        </div>
                        <?php }?>
                        <div class="grid-title sigh-background-secundary" style="">
                            <div class="row" style="">
                                <div style="position: relative">
                                    <div style="top:-14px;position: absolute;height: 90px;width: 35px;left: -1px;" class="<?= Modules::run('Config/ColorClasificacion',array('color'=>$info['ingreso_clasificacion']))?>"></div>
                                </div>
                                <div class="col-xs-8 text-left" style="padding-left: 50px">
                                    <h3 class="color-white text-uppercase no-margin semi-bold text-nowrap-user" style="height: 30px!important"><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?></h3>
                                    <h4 class="color-white text-uppercase m-t-5">
                                        <?=$info['paciente_sexo']?> | 
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
                                        ?> | <?=$info['info_procedencia_esp']=='Si' ? 'ESPONTANEA:&nbsp; '.$info['info_procedencia_esp_lugar'] : ' : '.$info['info_procedencia_hospital'].' '.$info['info_procedencia_hospital_num']?> | <?=$info['ingreso_clasificacion']?>
                                    </h4>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <h3 class="color-white text-uppercase no-margin semi-bold">EDAD</h3>
                                    <h2 class="color-white no-margin text-nowrap-user" style="height: 30px!important">
                                        <?php 
                                        if($info['paciente_fn']!=''){
                                            $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                            echo $fecha->y.' Año(s) '.$fecha->m.' Meses';
                                        }else{
                                            echo 'S/E';
                                        }
                                        ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="grid-body">
                            <form class="guardar-solicitud-hf">
                                <div class="row <?=$SignosVitales['sv_ta']==''? '':'hide'?>">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="semi-bold">TENSIÓN ARTERIAL</label>
                                            <input type="text" name="sv_ta" value="<?=$SignosVitales['sv_ta']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="semi-bold">TEMPERATURA</label>
                                            <input type="text" name="sv_temp" value="<?=$SignosVitales['sv_temp']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="semi-bold">FRECUENCIA CARDIACA</label>
                                            <input type="text" name="sv_fc" value="<?=$SignosVitales['sv_fc']?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="semi-bold">FRECUENCIA RESPIRATORIA</label>
                                            <input type="text" name="sv_fr" value="<?=$SignosVitales['sv_fr']?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12" >
                                        <?php 
                                        $ActionInContent='';
                                        if($_GET['accion']=='Editar' && $hojafrontal[0]['hf_via']=='Choque'){
                                            $ActionInContent='no-selectable';
                                        }
                                        ?>
                                        <div class="form-group <?=$ActionInContent?>">
                                            <h5 class="no-margin semi-bold">INTOXICACIÓN</h5>
                                            <div class="row m-t-5 ">
                                                <div class="col-md-2" style="padding-right: 0px">
                                                    <div class="radio radio-success">
                                                        <input id="hf_intoxitacion_si" type="radio" name="hf_intoxitacion" value="Si" data-value="<?=$hojafrontal[0]['hf_intoxitacion']?>">
                                                        <label for="hf_intoxitacion_si">Si</label>
                                                        <input id="hf_intoxitacion_no" type="radio" name="hf_intoxitacion" value="No" checked="">
                                                        <label for="hf_intoxitacion_no">No</label>
                                                    </div>
                          
                                                </div>
                                                <div class="col-md-10 hf_intoxitacion hide" style="padding-left: 0px">
                                                    <input type="text" name="hf_intoxitacion_descrip" value="<?=$hojafrontal[0]['hf_intoxitacion_descrip']?>" class="form-control" placeholder="ESPECIFICAR..." style="margin-top: -10px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group <?=$ActionInContent?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5 class="no-margin semi-bold">URGENCIA</h5>
                                                    <div class="radio radio-success m-t-10">
                                                        <input id="hf_urgencia_si" type="radio" name="hf_urgencia" data-value="<?=$hojafrontal[0]['hf_urgencia']?>"  value="Urgencia Real">
                                                        <label for="hf_urgencia_si">Urgencia Real</label>
                                                        <input id="hf_urgencia_no" type="radio" name="hf_urgencia" data-value="<?=$hojafrontal[0]['hf_urgencia']?>" value="Urgencia Sentida" checked="checked">
                                                        <label for="hf_urgencia_no">Urgencia Sentida</label>
                                                    </div>       
                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="no-margin semi-bold">ATENCIÓN</h5>
                                                    <input type="text" value="<?=$info['ingreso_pv']?>" class="form-control m-t-5">
                                                </div>
                                                <div class="col-md-5">
                                                    <h5 class="no-margin semi-bold">ESPECIALIADAD</h5>
                                                    <select name="hf_especialidad" class="width100 m-t-5" data-value="<?=Modules::run('Consultorios/ObtenerEspecialidad',array('Consultorio'=>$ce[0]['ce_asignado_consultorio']))?>" data-value-2="<?=$hojafrontal[0]['hf_especialidad']?>">
                                                    <?php foreach ($Especialidades as $value) {?>
                                                        <option value="<?=$value['especialidad_nombre']?>"><?=$value['especialidad_nombre']?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group <?=$ActionInContent?>">
                                            <h5 class="semi-bold no-margin">MOTIVO DE URGENCIA 
                                                <i class="material-icons pointer sigh-color i-20" onclick="AbrirVista(base_url+'Sections/Plantillas/SeleccionarContenido?plantilla=Motivo de Urgencia&input=hf_motivo&type=textarea')">library_add</i>
                                            </h5>
                                            <textarea class="form-control m-t-5" rows="3" name="hf_motivo"><?=$hojafrontal[0]['hf_motivo']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row <?=$ActionInContent?>">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">MECANISMO DE LESIÓN</h5>
                                                    <select class="select2 width100 m-t-5" id="hf_mecanismolesion" name="hf_mecanismolesion[]" data-value="<?=$hojafrontal[0]['hf_mecanismolesion']?>" multiple="">
                                                        <option value="Arma blanca">Arma blanca</option>
                                                        <option value="Traumatismo directo">Traumatismo directo</option>
                                                        <option value="ACC. Vial">ACC. Vial</option>
                                                        <option value="Maquinaria">Maquinaria</option>
                                                        <option value="Mordedura">Mordedura</option>
                                                        <option value="Caida">Caida</option>
                                                        <option value="Otros">Otros</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mecanismo-lesion-caida hide">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="hf_mecanismolesion_mtrs" value="<?=$hojafrontal[0]['hf_mecanismolesion_mtrs']?>" placeholder="Mtrs de la Caida">
                                                </div>
                                            </div>  
                                            <div class="col-md-6 mecanismo-lesion-otros hide" >
                                                <div class="form-group">
                                                    <input type="text" name="hf_mecanismolesion_otros" class="form-control" value="<?=$hojafrontal[0]['hf_mecanismolesion_otros']?>" placeholder="Otros">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="no-margin semi-bold">QUEMADURA</h5>
                                                <select class="select2 width100 m-t-5" id="hf_quemadura" multiple="" name="hf_quemadura[]" data-value="<?=$hojafrontal[0]['hf_quemadura']?>">
                                                    <option value="Fuego Directo">Fuego Directo</option>
                                                    <option value="Corriente Electrica">Corriente Electrica</option>
                                                    <option value="Escaldadura">Escaldadura</option>
                                                    <option value="Quimica">Quimica</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 quemadura-otros hide">
                                                <div class="form-group">
                                                    <input type="text" name="hf_quemadura_otros" value="<?=$hojafrontal[0]['hf_quemadura_otros']?>" class="form-control" style="margin-top: 23px" placeholder="Otros">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12 <?=$ActionInContent?>">
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">ANTECEDENTES 
                                                <i class="material-icons pointer sigh-color i-20" onclick="AbrirVista(base_url+'Sections/Plantillas/SeleccionarContenido?plantilla=Antecedentes&input=hf_antecedentes&type=textarea')">library_add</i>
                                            </h5>
                                            <textarea class="form-control hf_antecedentes m-t-5" rows="4" name="hf_antecedentes"><?=$hojafrontal[0]['hf_antecedentes']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">EXPLORACIÓN FÍSICA
                                                <i class="material-icons pointer sigh-color i-20" onclick="AbrirVista(base_url+'Sections/Plantillas/SeleccionarContenido?plantilla=Exploración Física&input=hf_exploracionfisica&type=textarea')">library_add</i>
                                            </h5>
                                            <textarea class="form-control hf_exploracionfisica m-t-5" id="hf_exploracionfisica" rows="4" name="hf_exploracionfisica"><?=$hojafrontal[0]['hf_exploracionfisica']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">INTERPRETACIÓN
                                                <i class="material-icons pointer sigh-color i-20"  onclick="AbrirVista(base_url+'Sections/Plantillas/SeleccionarContenido?plantilla=Interpretación&input=hf_interpretacion&type=textarea')">library_add</i>
                                            </h5>
                                            <textarea class="form-control hf_interpretacion m-t-5" rows="4" name="hf_interpretacion"><?=$hojafrontal[0]['hf_interpretacion']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="fieldset">
                                            <legend class="legend">
                                                DIAGNÓSTICOS&nbsp;&nbsp;
                                                <a  onclick="AbrirVista(base_url+'Sections/Documentos/VideoDx',500,300)" class="cie10-dx-video pointer" style="color: red">
                                                    <span class="text-right"><i class="fa fa-video-camera"></i> VER VIDEO</span>
                                                </a>
                                            </legend>
                                            <button type="button" onclick="AbrirVista(base_url+'Sections/Documentos/HistorialDx?ingreso=<?=$_GET['folio']?>',1000,600)" class="btn pull-left btn-success" style="">
                                                <i class="fa fa-history"></i> VER HISTORIAL DX
                                            </button><br>
                                            <a  onclick="AbrirVista(base_url+'Sections/Documentos/Dx?ingreso=<?=$_GET['folio']?>&temp=<?=$_GET['temp']?>&input=hf_diagnosticos&Especialidad='+$('select[name=hf_especialidad]').val(),600,530)" md-ink-ripple="" class="md-btn md-fab m-b red pointer" style="position: absolute;right: 18px;top: -12px">
                                                <i class="material-icons i-24 color-white">library_add</i>
                                            </a>
                                            <br>
                                            <table class="table table-bordered table-no-padding footable table-dx-pac m-t-15" data-page-size="5">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 17%">FECHA & HORA</th>
                                                        <th style="width: 15%">TIPO</th>
                                                        <th style="width: 27%">DX</th>
                                                        <th style="width: 27%" colspan="2">DX CIE10</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot class="hide-if-no-paging">
                                                    <tr >
                                                        <td class="text-center" colspan="5">
                                                            <ul class="pagination"></ul>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-12">
                                        <div class="form-group no-selectable">
                                            <h5 class="no-margin semi-bold">DIAGNÓSTICO</h5>
                                            <textarea class="form-control hf_diagnosticos no-selectable m-t-5" required="" rows="3" name="hf_diagnosticos"><?=$hojafrontal[0]['hf_diagnosticos']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">TRATAMIENTO</h5>
                                            <div class="row m-t-5">
                                                <div class="col-md-6" style="padding-right: 0px">
                                                    <select class="select2 width100" name="hf_trataminentos[]" multiple="" id="hf_trataminentos" data-value="<?=$hojafrontal[0]['hf_trataminentos']?>">
                                                        <option value="Curación">Curación</option>
                                                        <option value="Sutura">Sutura</option>
                                                        <option value="Vendaje">Vendaje</option>
                                                        <option value="Ferula">Ferula</option>
                                                        <option value="Vacunas">Vacunas</option>
                                                        <option value="Otros">Otros</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 hf_trataminentos_otros hide" >
                                                    <input type="text" name="hf_trataminentos_otros" placeholder="Otros" value="<?=$hojafrontal[0]['hf_trataminentos_otros']?>" class="form-control">
                                                </div>
                                                <div class="col-md-3 hf_trataminentos_por">
                                                    <input type="number" name="hf_trataminentos_por" value="<?=$hojafrontal[0]['hf_trataminentos_por']?>" placeholder="N° de Dias" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <h5 class="semi-bold no-margin">RECETA POR 
                                                <i class="material-icons pointer sigh-color i-20" onclick="AbrirVista(base_url+'Sections/Plantillas/SeleccionarContenido?plantilla=Receta&input=hf_receta_por&type=textarea')">library_add</i>
                                            </h5>
                                            <textarea class="form-control m-t-5" rows="6" name="hf_receta_por"><?=$hojafrontal[0]['hf_receta_por']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold"> INDICACIONES 
                                                <i class="material-icons pointer sigh-color i-20" onclick="AbrirVista(base_url+'Sections/Plantillas/SeleccionarContenido?plantilla=Indicaciones&input=hf_indicaciones&type=textarea')">library_add</i>
                                            </h5>
                                            <textarea class="form-control hf_indicaciones m-t-5" rows="6" name="hf_indicaciones"><?=$hojafrontal[0]['hf_indicaciones']?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 <?=$ActionInContent?>">
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">NOTIFICACIÓN AL MINISTERIO PUBLICO</h5>
                                            <div class="radio radio-success m-t-10">
                                                <input id="hf_ministeriopublico_si" type="radio" name="hf_ministeriopublico" data-value="<?=$hojafrontal[0]['hf_ministeriopublico']?>" value="Si">
                                                <label for="hf_ministeriopublico_si">Si</label>
                                                <input id="hf_ministeriopublico_no" type="radio" name="hf_ministeriopublico" data-value="<?=$hojafrontal[0]['hf_ministeriopublico']?>" value="No" checked="checked">
                                                <label for="hf_ministeriopublico_no">No</label>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-md-4 <?=$ActionInContent?>">
                                        <?php if($_GET['tipo']=='Choque'){?>
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">SERVICIO TRATANTE</h5>
                                            <select name="hf_servicio_tratante" class="width100 m-t-5" data-value="<?=$hojafrontal[0]['hf_servicio_tratante']?>" style="margin-top: -6px">
                                            <?php foreach ($Especialidades as $value) {?>
                                                <option value="<?=$value['especialidad_nombre']?>"><?=$value['especialidad_nombre']?></option>
                                            <?php }?>
                                            </select>
                                        </div>
                                        <?php } ?>
                                        <?php if( $_GET['tipo']=='Consultorios'){?>
                                        <div class="form-group">
                                            <?php if($ce[0]['ce_status']=='Salida'){?>
                                            <h5 class="no-margin semi-bold line-height">ALTA A : <?=$ce[0]['ce_hf']?></h5>
                                            <?php }else{?>
                                            <h5 class="no-margin semi-bold">ALTA A :</h5>
                                            <select name="hf_alta" data-value="<?=$hojafrontal[0]['hf_alta']?>" class="width100 m-t-5">
                                                <option value="Domicilio">Alta a Domicilio</option>
                                                <option value="Se interna al servicio de Observación">Se interna al servicio de Observación</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                            <?php }?>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <div class="col-md-2 hf_alta_otros hide <?=$ActionInContent?>">
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">.</h5>
                                            <input type="text" name="hf_alta_otros" placeholder="Otros" value="<?=$hojafrontal[0]['hf_alta_otros']?>" class="form-control m-t-5">
                                        </div>
                                    </div>
                                    <div class="col-md-12 <?=$_GET['tipo']=='Choque' ?'hide':'' ?>" >
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5 class="no-margin semi-bold">AMERITA INCAPACIDAD</h5>
                                                    <div class="radio radio-success m-t-5">
                                                        <input id="asistentesmedicas_incapacidad_am_si" type="radio" name="asistentesmedicas_incapacidad_am" data-value="<?=$am[0]['asistentesmedicas_incapacidad_am']?>" required=""  value="Si" class="  hojafrontal-info">
                                                        <label for="asistentesmedicas_incapacidad_am_si">Si</label>
                                                        <input id="asistentesmedicas_incapacidad_am_no" type="radio" name="asistentesmedicas_incapacidad_am" data-value="<?=$am[0]['asistentesmedicas_incapacidad_am']?>" required="" checked="" value="No" class=" hojafrontal-info">
                                                        <label for="asistentesmedicas_incapacidad_am_no">No</label>
                                                        <input id="asistentesmedicas_incapacidad_am_expide" type="radio" name="asistentesmedicas_incapacidad_am" data-value="<?=$am[0]['asistentesmedicas_incapacidad_am']?>" required=""  value="Se Expide en su Unidad de Referencia" class="has-value  hojafrontal-info">
                                                        <label for="asistentesmedicas_incapacidad_am_expide">Se expide en su Unidad de Referencia</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <h5 class="no-margin semi-bold">GENERAR INCAPACIDAD</h5>
                                                    <div class="radio radio-success m-t-5">
                                                        <input id="asistentesmedicas_incapacidad_ga_si" type="radio" name="asistentesmedicas_incapacidad_ga" disabled="" data-value="<?=$am[0]['asistentesmedicas_incapacidad_ga']?>" required="" value="Si" class="  hojafrontal-info">
                                                        <label for="asistentesmedicas_incapacidad_ga_si">Si</label>
                                                        <input id="asistentesmedicas_incapacidad_ga_no" type="radio" name="asistentesmedicas_incapacidad_ga" disabled="" data-value="<?=$am[0]['asistentesmedicas_incapacidad_ga']?>" required="" checked="" value="No" class="hojafrontal-info">
                                                        <label for="asistentesmedicas_incapacidad_ga_no">No</label>
                                                    </div>

                                                </div>
                                                <div class="col-md-3">
                                                    <select name="asistentesmedicas_incapacidad_tipo" disabled="" data-value="<?=$am[0]['asistentesmedicas_incapacidad_tipo']?>" class="width100 m-t-10" >
                                                        <option value="">Tipo de Incapacidad</option>
                                                        <option value="Inicial">Inicial</option>
                                                        <option value="Subsecuente">Subsecuente</option>
                                                        <option value="Recaida">Recaida</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 " >
                                                    <input type="hidden" name="asistentesmedicas_incapacidad_dias_a" value="<?=$am[0]['asistentesmedicas_incapacidad_dias_a']?>" class="form-control  hojafrontal-info" placeholder="Dias acomulados" style="margin-top: 15px">
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px">
                                                <div class="col-md-3" >
                                                    <input type="text" name="asistentesmedicas_incapacidad_folio" value="<?=$am[0]['asistentesmedicas_incapacidad_folio']?>" readonly="" class="form-control  hojafrontal-info" placeholder="Folio">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="asistentesmedicas_incapacidad_fi"  value="<?=$am[0]['asistentesmedicas_incapacidad_fi']?>" readonly=""   class="form-control d-m-y  hojafrontal-info" placeholder="Fecha de Inicio de Incapacidad">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="asistentesmedicas_incapacidad_da" value="<?=$am[0]['asistentesmedicas_incapacidad_da']?>" readonly="" class="form-control  hojafrontal-info" placeholder="Dias Autorizados" >
                                                </div>
                                                <div class="col-md-3" style="">
                                                    <div class="radio radio-success m-t-5">
                                                        <input id="hf_incapacidad_ptr_eg_ptr" type="radio" name="hf_incapacidad_ptr_eg" data-value="<?=$hojafrontal[0]['hf_incapacidad_ptr_eg']?>" value="PTR" class="has-value">
                                                        <label for="hf_incapacidad_ptr_eg_ptr">PTR</label>
                                                        <input id="hf_incapacidad_ptr_eg_eg" type="radio" name="hf_incapacidad_ptr_eg" data-value="<?=$hojafrontal[0]['hf_incapacidad_ptr_eg']?>" value="EG" class="has-value">
                                                        <label for="hf_incapacidad_ptr_eg_eg">EG</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <h5 class="semi-bold no-margin">MÉDICO TRATANTE</h5>
                                                    <input type="text" name="asistentesmedicas_mt" value="<?=$INFO_USER[0]['empleado_nombre'].' '.$INFO_USER[0]['empleado_ap'].' '.$INFO_USER[0]['empleado_am']?>" readonly="" class="form-control m-t-5">
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="semi-bold no-margin">MATRICULA</h5>
                                                    <input type="text" name="asistentesmedicas_mt_m" value="<?=$INFO_USER[0]['empleado_matricula']?>" readonly="" class="form-control m-t-5">
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    <input type="hidden" name="info_lugar_accidente" value="<?=$info['info_lugar_accidente']?>">
                                    <div class="col-md-12 col-hojafrontal-info hide  <?=$_GET['tipo']=='Choque'?'hide':''?>" >
                                        <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                            <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">DATOS DE TRABAJO REQUISITADOS POR LA ASISTENTE MÉDICA</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide col-hojafrontal-info <?=$_GET['tipo']=='Choque'?'hidden':''?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">EMPRESA</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_nombre']?>" readonly="" class="form-control m-t-5">
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">REGISTRO PATRONAL</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_rp']?>" readonly="" class="form-control m-t-5">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">MODALIDAD</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_modalidad']?>" readonly="" class="form-control m-t-5">
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">FECHA DE ÚLTIMO MOVIMIENTO</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_fum']?>" readonly="" class="form-control m-t-5">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">TELÉFONO (LADA)</h5>
                                                    <input type="text" value="<?=$DirEmpresa['directorio_telefono']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">COLONIA</h5>
                                                    <input type="text" value="<?=$DirEmpresa['directorio_colonia']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">HORA ENTRADA</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_he']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">CÓDIGO POSTAL</h5>
                                                    <input type="text" value="<?=$DirEmpresa['directorio_cp']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">MUNICIPIO</h5>
                                                    <input type="text" value="<?=$DirEmpresa['directorio_municipio']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">HORA SALIDA</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_he']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">CALLE Y NÚMERO</h5>
                                                    <input type="text" value="<?=$DirEmpresa['directorio_cn']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">ESTADO</h5>
                                                    <input type="text" value="<?=$DirEmpresa['directorio_estado']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                                <div class="form-group">
                                                    <h5 class="no-margin semi-bold">DÍA DE DESCANCO P. AL ACCIDENTE</h5>
                                                    <input type="text" value="<?=$Empresa['empresa_he']?>" readonly="" class="form-control m-t-5"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-left col-hojafrontal-info hide <?=$_GET['tipo']=='Choque'?'hidden':''?>">
                                        <div class="form-group" style="border-bottom: 2px solid <?=$this->sigh->getInfo('hospital_back_secundary')?>">
                                            <h5 class="m-b-5 m-t-5 semi-bold" style="color: <?=$this->sigh->getInfo('hospital_back_primary')?>">DATOS DE LA ST7</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide col-hojafrontal-info <?=$_GET['tipo']=='Choque'?'hidden':''?>">
                                        <div class="form-group">
                                            <h5 class="m-b-5 m-t-5 semi-bold">OMITIR DATOS DE ST7</h5>
                                            <label class="md-check">
                                                <input type="radio" name="asistentesmedicas_omitir" data-value="<?=$am[0]['asistentesmedicas_omitir']?>" value="Si" class="has-value  hojafrontal-info">
                                                <i class="green"></i>Si
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" name="asistentesmedicas_omitir" data-value="<?=$am[0]['asistentesmedicas_omitir']?>" checked="" value="No" class="has-value  hojafrontal-info">
                                                <i class="green"></i>No
                                            </label>
                                        </div>
                                        <div class="form-group asistentesmedicas_omitir">
                                            <h5 class="no-margin semi-bold">SEÑALAR CLARAMENTE COMO OCURRIO EL ACCIDENTE</h5>
                                            <textarea name="asistentesmedicas_da" required="" maxlength="500" class="form-control hojafrontal-info m-t-5" rows="3"><?=$am[0]['asistentesmedicas_da']?></textarea>
                                        </div>
                                        <div class="form-group asistentesmedicas_omitir">
                                            <h5 class="no-margin semi-bold">DESCRIPCIÓN DE LA(S) LESIÓN(ES) Y TEMPO DE EVOLUCIÓN</h5>
                                            <textarea name="asistentesmedicas_dl" required="" maxlength="500" class="form-control  hojafrontal-info m-t-5" rows="3"><?=$am[0]['asistentesmedicas_dl']?></textarea>
                                        </div>
                                        <div class="form-group asistentesmedicas_omitir">
                                            <h5 class="no-margin semi-bold">IMPRESIÓN DIAGNOSTICA</h5>
                                            <textarea name="asistentesmedicas_ip" maxlength="400" class="form-control  hojafrontal-info m-t-5" rows="3"><?=$am[0]['asistentesmedicas_ip']?></textarea>
                                        </div>
                                        <div class="form-group asistentesmedicas_omitir">
                                            <h5 class="no-margin semi-bold">TRATAMIENTOS</h5>
                                            <textarea name="asistentesmedicas_tratamientos" required="" maxlength="400" class="form-control  hojafrontal-info m-t-5" rows="3"><?=$am[0]['asistentesmedicas_tratamientos']?></textarea>
                                        </div>
                                        <div class="form-group asistentesmedicas_omitir">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="semi-bold m-t-5 m-b-10">SIGNOS Y SINTOMAS</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="no-margin semi-bold">Intoxicación Alcoholica</h5>
                                                            <div class="radio radio-success m-t-5">
                                                                <input id="asistentesmedicas_ss_in_si" type="radio" name="asistentesmedicas_ss_in" data-value="<?=$am[0]['asistentesmedicas_ss_in']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                                <label for="asistentesmedicas_ss_in_si">Si</label>
                                                                <input id="asistentesmedicas_ss_in_no" type="radio" name="asistentesmedicas_ss_in" checked="" data-value="<?=$am[0]['asistentesmedicas_ss_in']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                                <label for="asistentesmedicas_ss_in_no">No</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 class="no-margin semi-bold">Intoxicación por Enervantes</h5>
                                                            <div class="radio radio-success m-t-5">
                                                                <input id="asistentesmedicas_ss_ie_si" type="radio" name="asistentesmedicas_ss_ie" data-value="<?=$am[0]['asistentesmedicas_ss_ie']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                                <label for="asistentesmedicas_ss_ie_si">Si</label>
                                                                <input id="asistentesmedicas_ss_ie_no" type="radio" name="asistentesmedicas_ss_ie" checked="" data-value="<?=$am[0]['asistentesmedicas_ss_ie']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                                <label for="asistentesmedicas_ss_ie_no">No</label>
                                                            </div>
                                                        </div>        
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="semi-bold m-t-5 m-b-10">OTRAS CONDICIONES</h5>
                                                    <h5 class=" semi-bold m-t-10">Hubo riña</h5>
                                                    <div class="radio radio-success m-t-5">
                                                        <input id="asistentesmedicas_oc_hr_si" type="radio" name="asistentesmedicas_oc_hr" data-value="<?=$am[0]['asistentesmedicas_oc_hr']?>" required="" value="Si" class="has-value  hojafrontal-info">
                                                        <label for="asistentesmedicas_oc_hr_si">Si</label>
                                                        <input id="asistentesmedicas_oc_hr_no" type="radio" name="asistentesmedicas_oc_hr" checked="" data-value="<?=$am[0]['asistentesmedicas_oc_hr']?>" required="" value="No" class="has-value  hojafrontal-info">
                                                        <label for="asistentesmedicas_oc_hr_no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group asistentesmedicas_omitir">
                                            <h5 class="no-margin semi-bold">ATENCIÓN MÉDICA PREVIA EXTRAINSTITUCIONAL</h5>
                                            <textarea name="asistentesmedicas_am" maxlength="200" class="form-control hojafrontal-info m-t-5" rows="2"><?=$am[0]['asistentesmedicas_am']?></textarea>
                                        </div>
                                    </div>
                                    <?php if($_GET['tipo']=='Choque'){?>
                                    <hr style="margin-top: 30px;">
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <div class="form-group">
                                            <h5 class="no-margin semi-bold">POSIBLE DONADOR</h5>&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" name="po_donador"  data-value="<?=$po[0]['po_donador']?>" value="Si" class="has-value">
                                                <i class="indigo"></i>Si
                                            </label>&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" name="po_donador" checked="" value="No" class="has-value">
                                                <i class="indigo"></i>No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="margin-top: 10px">
                                        <div class="form-group po_donador hide" style="margin-top: -10px">
                                            <select class="width100" name="po_criterio" data-value="<?=$po[0]['po_criterio']?>">
                                                <option value="">Seleccionar</option>
                                                <option value="Lesión encefalica severa">Lesión encefalica severa</option>
                                                <option value="Glasgow">Glasgow</option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php }?>
                                    <div class="col-md-offset-6 col-md-3">
                                        <button type="button" class="btn btn-danger btn-block" onclick="window.top.close()">Cancelar</button>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="hidden" name="ingreso_id" value="<?=$_GET['folio']?>">
                                        <input type="hidden" name="hf_id" value="<?=$_GET['hf']?>">
                                        <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                                        <input type="hidden" name="tipo" value="<?=$_GET['tipo']?>">
                                        <input type="hidden" name="ce_status" value="<?=$ce[0]['ce_status']?>">
                                        <input type="hidden" name="temp" value="<?=$_GET['temp']?>">
                                        <button class="btn sigh-background-secundary btn-block" type="submit">Guardar</button>    
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
<input type="hidden" name="getDX" value="Si">
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/sections/Documentos.js?md5='). md5(microtime())?>" type="text/javascript"></script>