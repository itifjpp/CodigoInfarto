<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-20">
    <div class="col-md-11 col-centered">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary" style="">
                <div class="row" style="">
                    <div style="position: relative">
                        <div style="top:-14px;position: absolute;height: 90px;width: 35px;left: -1px;" class="<?= Modules::run('Config/ColorClasificacion',array('color'=>$info['ingreso_clasificacion']))?>"></div>
                    </div>
                    <div class="col-sm-9 text-left" style="padding-left: 50px">
                        <h3 class="color-white text-uppercase no-margin semi-bold"><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?></h3>
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
                    <div class="col-sm-3 text-right">
                        <h3 class="color-white text-uppercase no-margin semi-bold">EDAD</h3>
                        <h2 class="color-white no-margin">
                            <?php 
                            if($info['paciente_fn']!=''){
                                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                echo $fecha->y.'<span style="font-size:20px"><b>Años</b></span>';
                            }else{
                                echo 'S/E';
                            }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="grid-body">
                <form class="Form-Hoja-Alta-Hospitalaria">
                    <div class="row" >
                        <div class="col-sm-3 hide">
                            <div class="form-group">
                                <label class="mayus-bold">Tensión Arterial</label>
                                <input type="text" class="form-control"  name="sv_ta" value="<?=$SignosVitales['sv_ta']?>" >   
                            </div>
                        </div>
                        <div class="col-sm-3 hide">
                            <div class="form-group">
                                <label class="mayus-bold">Temperatura</label>
                                <input type="text" class="form-control" name="sv_temp"  value="<?=$SignosVitales['sv_temp']?>">   
                            </div>
                        </div>
                        <div class="col-sm-3 hide">
                            <div class="form-group">
                                <label class="mayus-bold">Frecuencia Cardiaca</label>
                                <input type="text" class="form-control" name="sv_fc" value="<?=$SignosVitales['sv_fc']?>">  
                            </div>
                        </div>
                        <div class="col-sm-3 hide">
                            <div class="form-group">
                                <label class="mayus-bold">Frecuencia Respiratoria</label>
                                <input type="text" class="form-control" name="sv_fr" value="<?=$SignosVitales['sv_fr']?>">     
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="mayus-bold">MOTIVO DE EGRESO</label>
                                <select class="width100" name="ha_motivo_egreso" required="" data-value="<?=$Hoja['ha_motivo_egreso']?>">
                                    <option value="">SELECCIONAR MOTIVO DE EGRESO</option>
                                    <option value="CURACIÓN">CURACIÓN</option>
                                    <option value="ABANDONO">ABANDONO</option>
                                    <option value="VOLUNTARIO">VOLUNTARIO</option>
                                    <option value="DEFUNCIÓN">DEFUNCIÓN</option>
                                    <option value="MEJORIA">MEJORIA</option>
                                    <option value="TRANSITORIO">TRANSITORIO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="mayus-bold">ENVÍO A</label>
                                <select class="width100" name="ha_envio" required="" data-value="<?=$Hoja['ha_envio']?>">
                                    <option value="">SELECCIONAR ENVÍO</option>
                                    <option value="CONSULTA DE ESPECIALIDAD DEL MISMO HOSPITAL">CONSULTA DE ESPECIALIDAD DEL MISMO HOSPITAL</option>
                                    <option value="MEDICINA FAMILIAR">MEDICINA FAMILIAR</option>
                                    <option value="OTRO HOSPITAL DEL IMSS">OTRO HOSPITAL DEL IMSS</option>
                                    <option value="OTRA INSTITUCIÓN">OTRA INSTITUCIÓN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="mayus-bold">ESPECIAL. O SERVICIO DE EGRESO</label>
                                <input type="text" name="ha_especialidad" value="<?=$Hoja['ha_especialidad']?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12"></div>

                        <div class="col-sm-3">
                            <?php
                            $TiempoEstancia= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$info['ingreso_date_horacero'].' '.$info['ingreso_time_horacero'],
                                'Tiempo2'=> date('Y-m-d H:i:s')
                            ));
                            ?>
                            <div class="form-group">
                                <label class="mayus-bold">FECHA DE INGRESO</label>
                                <input type="text" class="form-control dp-yyyy-mm-dd" name="ha_fecha_ingreso" value="<?=$Hoja['ha_fecha_ingreso']=='' ? $info['ingreso_date_horacero'] : $Hoja['ha_fecha_ingreso']?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">HORA DE INGRESO</label>
                                <input type="text" class="form-control clockpicker" name="ha_hora_ingreso" value="<?=$Hoja['ha_hora_ingreso']=='' ? $info['ingreso_time_horacero'] : $Hoja['ha_hora_ingreso']?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">FECHA DE EGRESO</label>
                                <input type="text" class="form-control dp-yyyy-mm-dd" name="ha_fecha_eg" value="<?=$Hoja['ha_fecha_eg']=='' ? date('Y-m-d') :$Hoja['ha_fecha_eg']?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">HORA DE EGRESO</label>
                                <input type="text" class="form-control clockpicker" name="ha_hora_eg" value="<?=$Hoja['ha_hora_eg']=='' ? date('H:i') :$Hoja['ha_hora_eg']?>">
                            </div>
                        </div>
                        <div class="col-sm-4 hide">
                            <div class="form-group">
                                <label class="mayus-bold">TOTAL DE DIAS EN ESTANCIA</label>
                                <input type="text" class="form-control"  name="ha_total_dias_estancia" value="<?=$Hoja['ha_total_dias_estancia']=='' ? $TiempoEstancia->m.' MESES '.$TiempoEstancia->d.' DÍAS '.$TiempoEstancia->h.' HRS':$Hoja['ha_total_dias_estancia']?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <caption class="back-imss text-center" style="padding: 5px">
                                    <b>DIAGNOSTICOS</b>
                                </caption>
                                <thead>
                                    <tr>
                                        <th style="width: 80%">TIPO DE DIAGNOSTICO</th>
                                        <th>CODIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_ingreso" value="<?=$Hoja['ha_dx_ingreso']?>" maxlength="90" placeholder="DIAGNOSTICO DE INGRESO" class="form-control">
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_ingreso_c" value="<?=$Hoja['ha_dx_ingreso_c']?>" placeholder="CODIFICACIÓN" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_ingreso_prin" value="<?=$Hoja['ha_dx_ingreso_prin']?>" maxlength="80" placeholder="DIAGNOSTICO DE INGRESO PRINCIPAL" class="form-control">
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_ingreso_prin_c" value="<?=$Hoja['ha_dx_ingreso_prin_c']?>" placeholder="CODIFICACIÓN" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_1_sec" value="<?=$Hoja['ha_dx_1_sec']?>" maxlength="80" placeholder="1 DIAGNOSTICO SECUNDARIO" class="form-control">
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_1_sec_c" value="<?=$Hoja['ha_dx_1_sec_c']?>" placeholder="CODIFICACIÓN" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_2_sec" value="<?=$Hoja['ha_dx_2_sec']?>" maxlength="80" placeholder="2 DIAGNOSTICO SECUNDARIO" class="form-control">
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_dx_2_sec_c" value="<?=$Hoja['ha_dx_2_sec_c']?>" placeholder="CODIFICACIÓN" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_com_1_intra" value="<?=$Hoja['ha_com_1_intra']?>" maxlength="80" placeholder="1 COMPLICACIÓN INTRA" class="form-control">
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_com_1_intra_c" value="<?=$Hoja['ha_com_1_intra_c']?>"  placeholder="CODIFICACIÓN" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_com_2_intra" value="<?=$Hoja['ha_com_2_intra']?>" maxlength="80" placeholder="2 COMPLICACIÓN INTRA" class="form-control">
                                        </td>
                                        <td style="padding: 0px">
                                            <input type="text" name="ha_com_2_intra_c" value="<?=$Hoja['ha_com_2_intra_c']?>" placeholder="CODIFICACIÓN" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 hide" >
                            <a href="#" class="md-btn md-fab m-b red waves-effect btn-add-dx-hoja-alta" data-id="0" data-tipo="" data-dx="" data-ha="<?=$this->uri->segment(4)?>" data-accion="add" data-key-temp="<?=$_GET['temp']?>" style="position: absolute;right: 10px">
                                <i class="mdi-av-my-library-add i-24 color-white"></i>
                            </a>
                            <table class="table table-dx-hah table-bordered table-no-padding table-striped" style="margin-top: 30px">
                                <caption class="back-imss text-center" style="padding: 5px">
                                    <b>DIAGNOSTICOS</b>
                                </caption>
                                <thead>
                                    <tr>
                                        <th style="width: 20%">TIPO DE DX</th>
                                        <th>CODIFICACIÓN</th>
                                        <th style="width: 65%">DX</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 hide">
                            <a href="#" class="md-btn md-fab m-b red waves-effect btn-add-proc-hoja-alta" data-id="0" data-fecha="" data-pro="" data-ha="<?=$this->uri->segment(4)?>" data-accion="add" data-key-temp="<?=$_GET['temp']?>" style="position: absolute;right: 10px">
                                <i class="mdi-av-my-library-add i-24 color-white"></i>
                            </a>
                            <table class="table table-procedimientos-hah table-bordered table-no-padding table-striped" style="margin-top: 30px">
                                <caption class="back-imss text-center" style="padding: 5px">
                                    <b>PROCEDIMIENTOS</b>
                                </caption>
                                <thead>
                                    <tr>
                                        <th>CODIFICACIÓN</th>
                                        <th>FECHA</th>
                                        <th style="width: 50%">PROCEDIMIENTO</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-dx-defuncion hide">
                            <div class="form-group">
                                <label class="mayus-bold">EGRESO POR DEFUNCIÓN</label>
                                <textarea class="form-control" name="ha_egreso_df_dx1" placeholder="DIAGNOSTICO PRIMARIO" rows="2" maxlength="120"><?=$Hoja['ha_egreso_df_dx1']?></textarea>
                                <br>
                                <textarea class="form-control" name="ha_egreso_df_dx2" placeholder="DIAGNOSTICO SECUNDARIO" rows="2" maxlength="120"><?=$Hoja['ha_egreso_df_dx2']?></textarea>
                            </div>
                            <div class="form-group" >
                                <label class="md-check">
                                    <input type="radio" name="ha_egreso_df_autopsia" value="Si" data-value="<?=$Hoja['ha_egreso_df_autopsia']?>">
                                    <i class="blue"></i>CON AUTOPSIA
                                </label>&nbsp;&nbsp;&nbsp;
                                <label class="md-check">
                                    <input type="radio" name="ha_egreso_df_autopsia" value="No" checked="">
                                    <i class="blue"></i>SIN AUTOPSIA
                                </label>   
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="mayus-bold">PROGRAMA DONDE SE ATENDIO EL PACIENTE</label>
                                <select class="width100" name="ha_programa" data-value="<?=$Hoja['ha_programa']?>">
                                    <option value="">SELECCIONAR</option>
                                    <option value="PUERPERIO BAJO RIESGO">PUERPERIO BAJO RIESGO</option>
                                    <option value="CIRUGIA AMBULATORIA">CIRUGIA AMBULATORIA</option>
                                    <option value="NINGUNO DE ESTOS">NINGUNO DE ESTOS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="mayus-bold">METODO DE PLANIFICACIÓN FAMILIAR</label>
                                <select class="width100" name="ha_planificacion" data-value="<?=$Hoja['ha_planificacion']?>">
                                    <option value="">SELECCIONAR</option>
                                    <option value="PASTILLAS S/R">PASTILLA S/R</option>
                                    <option value="PASTILLAS C/R">PASTILLA C/R</option>
                                    <option value="DIU S/R">DIU S/R</option>
                                    <option value="DIU C/R">DIU C/R</option>
                                    <option value="O.T.B S/R">O.T.B S/R</option>
                                    <option value="O.T.B C/R">O.T.B C/R</option>
                                    <option value="INYECTABLE S/R">INYECTABLE S/R</option>
                                    <option value="INYECTABLE C/R">INYECTABLE C/R</option>
                                    <option value="VASECTOMIA">VASECTOMIA</option>
                                    <option value="NINGUNO">NINGUNO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="mayus-bold">RAMA DE SEGURO</label>
                                <select class="width100" name="ha_ramo_seguro" required="" data-value="<?=$Hoja['ha_ramo_seguro']?>">
                                    <option value="">SELECCIONAR RAMO DE SEGURO</option>
                                    <option value="RIESGO DE TRABAJO CONFIRMADO">RIESGO DE TRABAJO CONFIRMADO</option>
                                    <option value="RIESGO DE TRABAJO PROBABLE">RIESGO DE TRABAJO PROBABLE</option>
                                    <option value="INVALIDEZ">INVALIDEZ</option>
                                    <option value="ENFERMEDAD GENERAL">ENFERMEDAD GENERAL</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="mayus-bold">NUMERO DE RECETAS</label>
                                <input type="number" name="ha_n_recetas" value="<?=$Hoja['ha_n_recetas']?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <?php 
                            $getRol=$this->config_mdl->sqlQuery("SELECT rol_nombre FROM sigh_areasacceso AS area, sigh_roles AS rol WHERE 
                            area.areas_acceso_rol=rol.rol_id AND
                            area.areas_acceso_nombre='$this->UMAE_AREA'")[0]
                        ?>
                        <?php if($getRol['rol_nombre']=='Médico Residente'){?>
                        <div class="col-sm-6 hide">
                            <div class="form-group ">
                                <label class="mayus-bold">MÉDICO QUE SUPERVISA</label>
                                <select class="select2 width100" name="ha_medico_supervisa" data-value="<?=$Hoja['ha_medico_supervisa']?>">
                                    <option value="">SELECCIONAR MÉDICO QUE SUPERVISA</option>
                                    <?php foreach ($Medicos as $value) {?>
                                    <option value="<?=$value['empleado_id']?>"><?=$value['empleado_ap']?> <?=$value['empleado_am']?> <?=$value['empleado_nombre']?> - <?=$value['empleado_matricula']?></option>
                                    <?php }?>
                                </select>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label class="mayus-bold">MÉDICO QUE AUTORIZA</label>
                                <select class="select2 width100" required="" name="ha_medico_autoriza" data-value="<?=$Hoja['ha_medico_autoriza']?>">
                                    <option value="">SELECCIONAR MÉDICO QUE AUTORIZA</option>
                                    <?php foreach ($Medicos as $value) {?>
                                    <option value="<?=$value['empleado_id']?>"><?=$value['empleado_ap']?> <?=$value['empleado_am']?> <?=$value['empleado_nombre']?> - <?=$value['empleado_matricula']?></option>
                                    <?php }?>
                                </select>

                            </div>
                        </div>
                        <?php }else{?>
                        <?php }?>
                        <div class="col-md-offset-8 col-md-4">
                            <input type="hidden" name="csrf_token" >
                            <input type="hidden" name="ingreso_id" value="<?=$_GET['folio']?>"> 
                            <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                            <input type="hidden" name="ha_id" value="<?=$this->uri->segment(4)?>">
                            <input type="hidden" name="ha_temp" value="<?=$_GET['temp']?>">
                            <input type="hidden" name="via" value="<?=$_GET['via']?>">
                            <input type="hidden" name="inputVia" value="<?=$_GET['inputVia']?>">
                            <input type="hidden" name="doc_id" value="<?=$_GET['doc_id']?>">
                            <button class="btn sigh-background-secundary pull-right btn-block" type="submit" style="margin-bottom: -10px">Guardar</button>                     
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="TIPO_MEDICO" value="<?=$this->UMAE_AREA?>">
<input type="hidden" name="PasteImg" value="Si">
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>