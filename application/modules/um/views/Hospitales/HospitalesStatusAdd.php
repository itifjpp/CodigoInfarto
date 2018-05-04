<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-9 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <a href="<?=  base_url()?>Um/Hospitales/Reportes?hos=<?=$_GET['hos']?>" class="md-btn md-fab m-b red " style="position: absolute;left: -30px;top: 13px">
                        <i class="mdi-navigation-arrow-back i-24"></i>
                    </a>
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">REPORTE DE STATUS DEL HOSPITAL</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form class="ReporteStatusHospitales">
                            <div class="col-md-6">
                                <div class="">
                                    <input type="text" name="status_fecha" required="" value="<?=$info['status_fecha']?>" class="form-control dp-yyyy-mm-dd" placeholder="SELECCIONAR FECHA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="status_hora" data-value="<?=$info['status_hora']?>" required="">
                                        <option value="">SELECCIONAR HORA</option>
                                        <option value="08:00">08:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="21:00">21:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>DISPONIBILIDAD DE CAMAS Y SERVICIOS</b>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CAMAS HOSPITALIZACIÓN</label>
                                    <input name="s1_camas_hospitalacion" value="<?=$info['s1_camas_hospitalacion']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CAMAS ADULTOS</label>
                                    <input name="s1_camas_adultos" value="<?=$info['s1_camas_adultos']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CAMAS ADULTOS QUEMADOS</label>
                                    <input name="s1_camas_adultos_quemados" value="<?=$info['s1_camas_adultos_quemados']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CAMAS PEDIATRÍA</label>
                                    <input name="s1_camas_pediatria" value="<?=$info['s1_camas_pediatria']?>" required=""  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CUNAS</label>
                                    <input name="s1_cunas" value="<?=$info['s1_cunas']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CUNAS QUEMADOS</label>
                                    <input name="s1_cunas_quemados" value="<?=$info['s1_cunas_quemados']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">CAMAS DE TERAPIA INTENSIVA</label>
                                    <input name="s1_camas_terapia_intensiva" value="<?=$info['s1_camas_terapia_intensiva']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">ESPACIOS URGENCIAS</label>
                                    <input name="s1_espacios_urgencias" value="<?=$info['s1_espacios_urgencias']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>ADMISIÓN DE PACIENTES RELACIONAS CON EL SISMO</b>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">TOTAL</label>
                                    <input type="number" name="s2_total_derechohabiente" value="<?=$info['s2_total_derechohabiente']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">DERECHOHABIENTES</label>
                                    <input type="number" name="s2_derechohabiente" value="<?=$info['s2_derechohabiente']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">NO DERECHOHABIENTES</label>
                                    <input type="number" name="s2_noderechohabiente" value="<?=$info['s2_noderechohabiente']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>REPORTE DE DEFUNCIONES</b>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  class="mayus-bold">RELACIONADOS AL SISMO</label>
                                    <input type="number" name="s3_defunciones_no_sismo" value="<?=$info['s3_defunciones_no_sismo']?>" required=""  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mayus-bold">NO RELACIONADOS AL SISMO</label>
                                    <input type="number" name="s3_defunciones_si_sismo" value="<?=$info['s3_defunciones_si_sismo']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>DAÑOS QUE PREVALECEN EN LA UNIDAD PARA SER EVALUADOS POR PERSONAL ESPECIALIZADO</b>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="s4_daños" data-value="<?=$info['s4_daños']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="ALGUNO">ALGUNO</option>
                                        <option value="NINGUNO">NINGUNO</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="s4_daños_comentarios" rows="1" placeholder="COMENTARIOS" class="form-control"><?=$info['s4_daños_comentarios']?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>CAMAS OCUPADAS</b>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="number" name="s5_camas_ocupadas" value="<?=$info['s5_camas_ocupadas']?>" required="" placeholder="CAMAS OCUPADAS" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>DISPONIBILIDAD DE HEMOCOMPONENTES</b>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="mayus-bold">PAQUETES GLOBULARES</label>
                                    <input name="s6_paquetas_globulares" required="" value="<?=$info['s6_paquetas_globulares']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="mayus-bold">PLASMA</label>
                                    <input name="s6_plasmas" required="" value="<?=$info['s6_plasmas']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="mayus-bold">ENVIOS</label>
                                    <input type="number" name="s6_envios" required="" value="<?=$info['s6_envios']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="mayus-bold">RECIBIDOS</label>
                                    <input type="number" name="s6_recibidos" required="" value="<?=$info['s6_recibidos']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="s6_comentarios" placeholder="COMENTARIOS" class="form-control"><?=$info['s6_comentarios']?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>ANÁLISIS DE NECESIDADES</b>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="s7_analisis_necesidades_pro" data-value="<?=$info['s7_analisis_necesidades_pro']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="SIN PROBLEMA">SIN PROBLEMA</option>
                                        <option value="CON PROBLEMAS">CON PROBLEMAS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="s7_analisis_necesidades" rows="1" placeholder="ANÁLISIS DE NECESIDADES" class="form-control"><?=$info['s7_analisis_necesidades']?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>EGRESO DE PACIENTES ESPECIFICANDO DESTINO</b>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">TOTAL</label>
                                    <input type="number" name="s6_egreso_total" required="" value="<?=$info['s6_egreso_total']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">HOSPITALIZACIÓN</label>
                                    <input type="number" name="s6_egreso_hospitalizacion" required="" value="<?=$info['s6_egreso_hospitalizacion']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">DEFUNCIÓN</label>
                                    <input type="number" name="s6_egreso_defuncion" required="" value="<?=$info['s6_egreso_defuncion']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">TRASLADOS</label>
                                    <input type="number" name="s6_egreso_traslado" required="" value="<?=$info['s6_egreso_traslado']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">DOMICILIO</label>
                                    <input type="number" name="s6_egreso_domicilio" required="" value="<?=$info['s6_egreso_domicilio']?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="s6_egreso_comentarios" placeholder="COMENTARIOS" class="form-control"><?=$info['s6_egreso_comentarios']?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>ABASTO DE MEDICAMENTOS Y ESTADO DE LA RED DE FRIO</b>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mayus-bold">PORCENTAJE DE ABASTO DE MEDICAMENTOS</label>
                                    <input type="number"  name="s9_abasto_porcentaje" required="" value="<?=$info['s9_abasto_porcentaje']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mayus-bold">DIAS DE ABASTO DE MEDICAMENTOS</label>
                                    <input type="number" name="s9_abasto_dias" required="" value="<?=$info['s9_abasto_dias']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="s9_abasto_comentarios" rows="2" placeholder="COMENTARIOS" class="form-control"><?=$info['s9_abasto_comentarios']?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">VENTILADORES DISPONIBLES</label>
                                    <input type="number" name="s9_ventiladores" required="" value="<?=$info['s9_ventiladores']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">QUIRÓFANOS DISPONIBLES</label>
                                    <input type="number" name="s9_sala_quirofanos" required="" value="<?=$info['s9_sala_quirofanos']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">RED FRÍA</label>
                                    <select name="s9_red_fria" class="form-control" data-value="<?=$info['s9_red_fria']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>PROBLEMAS DE OPERACIÓN DE EQUIPOS CRETICOS Y SOPORTE</b>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">TOMOGRAFIA</label>
                                    <select name="s10_tomografia" class="form-control" data-value="<?=$info['s10_tomografia']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">RESONADOR</label>
                                    <select name="s10_resonador" class="form-control" data-value="<?=$info['s10_resonador']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">RAYOS "X"</label>
                                    <select name="s10_rayos_x" class="form-control" data-value="<?=$info['s10_rayos_x']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">HEMOCOMPONENTES</label>
                                    <select name="s10_hemocomponentes" class="form-control" data-value="<?=$info['s10_hemocomponentes']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">VENTILADORES</label>
                                    <select name="s10_ventiladores" class="form-control" data-value="<?=$info['s10_ventiladores']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">DESFRIBRILADORES</label>
                                    <select name="s10_desfibriladores" class="form-control" data-value="<?=$info['s10_desfibriladores']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 back-imss" style="width: 102.5%;margin-left: -10px;padding: 4px;text-align: center;margin-bottom: 10px">
                                <b>EQUIPO DE SOPORTE DE LA UNIDAD</b>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">EVELADORES</label>
                                    <select name="s11_elevadores" class="form-control" data-value="<?=$info['s11_elevadores']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">SUMINISTRO DE LUZ EXTERNO</label>
                                    <select name="s11_suministro_de_luz" class="form-control" data-value="<?=$info['s11_suministro_de_luz']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">PLANTA DE LUZ</label>
                                    <select name="s11_planta_de_luz" class="form-control" data-value="<?=$info['s11_planta_de_luz']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">COMBUSTIBLE PLANTA DE LUZ</label>
                                    <input type="number" name="s11_combustible_planta_de_luz" value="<?=$info['s11_combustible_planta_de_luz']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">TANQUE TERMO OXIGENO</label>
                                    <input type="number" name="s11_tanque_termo_oxigeno" value="<?=$info['s11_tanque_termo_oxigeno']?>" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="mayus-bold">GENERADOR DE VAPOR</label>
                                    <select name="s11_generador_de_vapor" class="form-control" data-value="<?=$info['s11_generador_de_vapor']?>">
                                        <option value="">SELECCIONAR</option>
                                        <option value="FUNCIONANDO">FUNCIONANDO</option>
                                        <option value="NO FUNCIONANDO">NO FUNCIONANDO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-offset-8 col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="hospital_id" value="<?=$_GET['hos']?>">
                                    <input type="hidden" name="status_id" value="<?=$_GET['st']?>">
                                    <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                    <input type="hidden" name="csrf_token">
                                    <button class="btn back-imss btn-block">GUARDAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/UmHospitales.js?<?= md5(microtime())?>"></script>


