<?=Modules::run('Sections/Menu/index'); ?>
<?php 

    $fecha=$_GET['inputFecha'];
    $hora=$_GET['inputHora'];
    $sqlInfo= $this->config_mdl->sqlQuery("SELECT * FROM um_hospitales, um_hospitales_status WHERE um_hospitales.hospital_id=um_hospitales_status.hospital_id AND
                um_hospitales_status.status_fecha='$fecha' AND  um_hospitales_status.status_hora='$hora'");

    $s1_camas_hospitalacion=0;
    $s1_camas_adultos=0;
    $s1_camas_adultos_quemados=0;
    $s1_camas_pediatria=0;
    $s1_cunas=0;
    $s1_cunas_quemados=0;
    $s1_camas_terapia_intensiva=0;
    $s1_espacios_urgencias=0;
    $s2_total_derechohabiente=0;
    $s2_derechohabiente=0;
    $s2_noderechohabiente=0;
    $s3_defunciones_si_sismo=0;
    $s3_defunciones_no_sismo=0;
    $s4_daños=0;
    $s5_camas_ocupadas=0;
    $s6_paquetas_globulares=0;
    $s6_plasmas=0;
    $s6_envios=0;
    $s6_recibidos=0;
    $s7_analisis_necesidades_pro=0;
    $s6_egreso_hospitalizacion=0;
    $s6_egreso_domicilio=0;
    $s6_egreso_defuncion=0;
    $s6_egreso_traslado=0;
    $s6_egreso_total=0;
    $s9_abasto_porcentaje=0;
    $s9_abasto_dias=0;
    $s9_ventiladores=0;
    $s9_sala_quirofanos=0;
    $s9_red_fria=0;
    $s10_tomografia=0;
    $s10_resonador=0;
    $s10_rayos_x=0;
    $s10_hemocomponentes=0;
    $s10_ventiladores=0;
    $s10_desfibriladores=0;
    $s11_elevadores=0;
    $s11_suministro_de_luz=0;
    $s11_planta_de_luz=0;
    $s11_combustible_planta_de_luz=0;
    $s11_tanque_termo_oxigeno=0;
    $s11_generador_de_vapor=0;
    foreach ($sqlInfo as $value) {
        $Hospital_.=$value['hospital_nombre'].', ';
        $s1_camas_hospitalacion=$s1_camas_hospitalacion+$value['s1_camas_hospitalacion'];
        $s1_camas_adultos=$s1_camas_adultos+$value['s1_camas_adultos'];
        $s1_camas_adultos_quemados=$s1_camas_adultos_quemados+$value['s1_camas_adultos_quemados'];
        $s1_camas_pediatria=$s1_camas_pediatria+$value['s1_camas_pediatria'];
        $s1_cunas=$s1_cunas+$value['s1_cunas'];
        $s1_cunas_quemados=$s1_cunas_quemados+$value['s1_cunas_quemados'];
        $s1_camas_terapia_intensiva=$s1_camas_terapia_intensiva+$value['s1_camas_terapia_intensiva'];
        $s1_espacios_urgencias=$s1_espacios_urgencias+$value['s1_espacios_urgencias'];
        $s2_total_derechohabiente=$s2_total_derechohabiente+$value['s2_total_derechohabiente'];
        $s2_derechohabiente=$s2_derechohabiente+$value['s2_derechohabiente'];
        $s2_noderechohabiente=$s2_noderechohabiente+$value['s2_noderechohabiente'];
        $s3_defunciones_si_sismo=$s3_defunciones_si_sismo+$value['s3_defunciones_si_sismo'];
        $s3_defunciones_no_sismo=$s3_defunciones_no_sismo+$value['s3_defunciones_no_sismo'];
        if($value['s4_daños']=='ALGUNO'){
            $s4_daños=$s4_daños+50;
        }else{
            $s4_daños=$s4_daños+0;
        }
        $s5_camas_ocupadas=$s5_camas_ocupadas+$value['s5_camas_ocupadas'];
        $s6_paquetas_globulares=$s6_paquetas_globulares+$value['s6_paquetas_globulares'];
        $s6_plasmas=$s6_plasmas+$value['s6_plasmas'];
        $s6_envios=$s6_envios+$value['s6_envios'];
        $s6_recibidos=$s6_recibidos+$value['s6_recibidos'];
        if($value['s7_analisis_necesidades_pro']=='SIN PROBLEMA'){
            $s7_analisis_necesidades_pro=$s7_analisis_necesidades_pro+0;
        }else{
            $s7_analisis_necesidades_pro=$s7_analisis_necesidades_pro+50;
        }
        $s6_egreso_hospitalizacion=$s6_egreso_hospitalizacion+$value['s6_egreso_hospitalizacion'];
        $s6_egreso_domicilio=$s6_egreso_domicilio+$value['s6_egreso_domicilio'];
        $s6_egreso_defuncion=$s6_egreso_defuncion+$value['s6_egreso_defuncion'];
        $s6_egreso_traslado=$s6_egreso_traslado+$value['s6_egreso_traslado'];
        $s6_egreso_total=$s6_egreso_total+$value['s6_egreso_total'];
        $s9_abasto_porcentaje=$s9_abasto_porcentaje+$value['s9_abasto_porcentaje'];
        $s9_abasto_dias=$s9_abasto_dias+$value['s9_abasto_dias'];
        $s9_ventiladores=$s9_ventiladores+$value['s9_ventiladores'];
        $s9_sala_quirofanos=$s9_sala_quirofanos+$value['s9_sala_quirofanos'];
        if($value['s9_red_fria']=='FUNCIONANDO'){
            $s9_red_fria=$s9_red_fria+100;
        }else{
            $s9_red_fria=$s9_red_fria+50;
        }
        if($value['s10_tomografia']=='FUNCIONANDO'){
            $s10_tomografia=$s10_tomografia+100;
        }else{
            $s10_tomografia=$s10_tomografia+50;
        }
        if($value['s10_resonador']=='FUNCIONANDO'){
            $s10_resonador=$s10_resonador+100;
        }else{
            $s10_resonador=$s10_resonador+50;
        }
        if($value['s10_rayos_x']=='FUNCIONANDO'){
            $s10_rayos_x=$s10_rayos_x+100;
        }else{
            $s10_rayos_x=$s10_rayos_x+50;
        }
        if($value['s10_hemocomponentes']=='FUNCIONANDO'){
            $s10_hemocomponentes=$s10_hemocomponentes+100;
        }else{
            $s10_hemocomponentes=$s10_hemocomponentes+50;
        }
        if($value['s10_ventiladores']=='FUNCIONANDO'){
            $s10_ventiladores=$s10_ventiladores+100;
        }else{
            $s10_ventiladores=$s10_ventiladores+50;
        }
        if($value['s10_desfibriladores']=='FUNCIONANDO'){
            $s10_desfibriladores=$s10_desfibriladores+100;
        }else{
            $s10_desfibriladores=$s10_desfibriladores+50;
        }
        if($value['s11_elevadores']=='FUNCIONANDO'){
            $s11_elevadores=$s11_elevadores+100;
        }else{
            $s11_elevadores=$s11_elevadores+50;
        }
        if($value['s11_suministro_de_luz']=='FUNCIONANDO'){
            $s11_suministro_de_luz=$s11_suministro_de_luz+100;
        }else{
            $s11_suministro_de_luz=$s11_suministro_de_luz+50;
        }
        if($value['s11_planta_de_luz']=='FUNCIONANDO'){
            $s11_planta_de_luz=$s11_planta_de_luz+100;
        }else{
            $s11_planta_de_luz=$s11_planta_de_luz+50;
        }
        $s11_combustible_planta_de_luz=$s11_combustible_planta_de_luz+$value['s11_combustible_planta_de_luz'];
        $s11_tanque_termo_oxigeno=$s11_tanque_termo_oxigeno+$value['s11_tanque_termo_oxigeno'];
        if($value['s11_generador_de_vapor']=='FUNCIONANDO'){
            $s11_generador_de_vapor=$s11_generador_de_vapor+100;
        }else{
            $s11_generador_de_vapor=$s11_generador_de_vapor+50;
        }

    }
?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">REPORTE GENERAL DE ESTADOS ACTUALES DE LOS HOSPITALES</span>
                </div>
                <div class="panel-body b-b b-light" style="padding: 14px;">
                    <div class="row" style="margin-top: 10px">
                        <form action="<?= base_url()?>Um/Hospitales/ReporteGeneral" method="GET">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="inputFecha" value="<?=$_GET['inputFecha']?>" class="form-control dp-yyyy-mm-dd" required="" placeholder="SELECCIONAR FECHA">
                                </div>
                            </div>    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="inputHora"  required="" data-value="<?=$_GET['inputHora']?>">
                                        <option value="">SELECCIONAR HORA</option>
                                        <option value="08:00">08:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="21:00">21:00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn back-imss btn-block">BUSCAR</button>
                            </div>
                        </form>
                        
                    </div>
                    <?php if(!empty($sqlInfo)){?>
                    <div class="row">
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px;">
                            <h5 style="text-transform: uppercase;line-height: 1.6;font-weight: bolder">
                                <?= trim($Hospital_,', ')?><br>
                                
                            </h5>
                            <h6>REPORTE DE LOS ESTADOS ACTUALES DE LOS HOSPITALES DEL <?=$_GET['inputFecha']?> A LAS <?=$_GET['inputHora']?></h6>
                            <a href="<?= base_url()?>Um/Hospitales/ReporteGeneralCharts?inputFecha=<?= base64_encode($_GET['inputFecha'])?>&inputHora=<?= base64_encode($_GET['inputHora'])?>" target="_blank" class="md-btn md-fab m-b red waves-effect pull-right " style="position: absolute;right: 70px;top:5px">
                                <i class="fa fa-bar-chart-o i-24"></i>
                            </a>
                            <a href="<?= base_url()?>Sections/Reportes/ReporteStatusHospitalGeneral?inputFecha=<?= base64_encode($_GET['inputFecha'])?>&inputHora=<?= base64_encode($_GET['inputHora'])?>" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect pull-right " style="position: absolute;right: 10px;top:5px">
                                <i class="fa fa-cloud-download i-24"></i>
                            </a>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>DISPONIBILIDAD DE CAMAS Y SERVICIOS</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h3><?=$s1_camas_hospitalacion?></h3>
                                    <h6><b>CAMAS TOTAL</b></h6>
                                </div>
                                <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                                    <h3><?=$s1_camas_adultos?></h3>
                                    <h6><b>CAMAS ADULTOS</b></h6>
                                </div>
                                <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                                    <h3><?=$s1_camas_adultos_quemados?></h3>
                                    <h6><b>CAMAS ADUL. QUEMADOS</b></h6>
                                </div>
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-4 text-center" >
                                    <h3><?=$s1_camas_pediatria?></h3>
                                    <h6><b>CAMAS PEDIATRICOS</b></h6>
                                </div>
                                
                                <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                                    <h3><?=$s1_cunas?></h3>
                                    <h6><b>CUNAS</b></h6>
                                </div>
                                <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                                    <h3><?=$s1_cunas_quemados?></h3>
                                    <h6><b>CUNAS QUEMADOS</b></h6>
                                </div>
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-6 text-center" >
                                    <h3><?=$s1_camas_terapia_intensiva?></h3>
                                    <h6><b>CAMAS TERAPIA DIS.</b></h6>
                                </div>
                                
                                <div class="col-md-6 text-center " style="border-left: 2px solid #256659">
                                    <h3><?=$s1_espacios_urgencias?></h3>
                                    <h6><b>ESPACIOS URGENCIAS</b></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-CamasTotales">
                                <?php foreach ($sqlInfo as $value) {?>
                                <span data-value="<?=$value['s1_camas_hospitalacion']?>" data-hospital="<?=$value['hospital_nombre']?>"></span>
                                <?php }?>
                            </div>
                            <canvas id="ChartCamasTotales" style="height: 250px;"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>ADMISIÓN DE PACIENTES RELACIONADOS CON EL SISMO</h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <h5><?=$s2_derechohabiente?></h5>
                            <h5><b>DERECHOHABIENTES</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s2_noderechohabiente?></h5>
                            <h5><b>NO DERECHOHABIENTES</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s2_total_derechohabiente?></h5>
                            <h5><b>TOTAL</b></h5>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>REPORTE DE DEFUNCIONES</h5>
                        </div>
                        <div class="col-md-6 text-center" >
                            <h5><?=$s3_defunciones_si_sismo?></h5>
                            <h5><b>RELACIONADOS CON EL SISMO</b></h5>
                        </div>
                        <div class="col-md-6 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s3_defunciones_no_sismo?></h5>
                            <h5><b>NO RELACIONADOS CON EL SISMO</b></h5>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>DAÑOS QUE PREVALECEN EN LA UNIDAD PARA SER EVALUADOS POR EL PERSONAL ESPCIALIZADO</h5>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4><b><?=$s4_daños?></b></h4>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px">
                            <h5>CAMAS OCUPADAS</h5>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4><b><?=$s5_camas_ocupadas?> CAMAS</b></h4>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>DISPONIBILIDAD DE HEMOCOMPONENTES</h5>
                        </div>
                        <div class="col-md-3 text-center">
                            <h5><?=$s6_paquetas_globulares?></h5>
                            <h5><b>PAQUETES GLOBULARES</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s6_plasmas?></h5>
                            <h5><b>PLASMA</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s6_envios?></h5>
                            <h5><b>ENVIOS</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s6_recibidos?></h5>
                            <h5><b>RECIBIDOS</b></h5>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>ANÁLISIS DE NECESIDADES</h5>
                        </div>
                        <div class="col-md-12 text-center">
                            <h4><b><?=$s7_analisis_necesidades_pro?></b></h4>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>EGRESO DE PACIENTES ESPECIFICANDO DESTINO</h5>
                        </div>
                        <div class="col-md-3 text-center" >
                            <h5><?=$s6_egreso_hospitalizacion?></h5>
                            <h5><b>HOSPITALIZADOS</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s6_egreso_domicilio?></h5>
                            <h5><b>DOMICILIO</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s6_egreso_defuncion?></h5>
                            <h5><b>DEFUNCIÓN</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s6_egreso_traslado?></h5>
                            <h5><b>TRASLADO</b></h5>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-4 text-center col-centered">
                            <h5><?=$s6_egreso_total?></h5>
                            <h5><b>TOTAL</b></h5>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>ABASTO DE MEDICAMENTOS Y ESTADO DE LA RED DE FRÍO</h5>
                        </div>
                        <div class="col-md-3 text-center">
                            <h5><?=$s9_abasto_porcentaje?></h5>
                            <h5><b>PORCENTAJE</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s9_abasto_dias?></h5>
                            <h5><b>DÍAS GARANTIZADOS</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s9_ventiladores?></h5>
                            <h5><b>VENTILADORES DISPONIBLES</b></h5>
                        </div>
                        <div class="col-md-3 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s9_sala_quirofanos?></h5>
                            <h5><b>QUIRÓFANOS DISPONIBLES</b></h5>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-3 text-center col-centered" >
                            <h5><?=$s9_red_fria/count($sqlInfo)?>%</h5>
                            <h5><b>RED DE FRÍO</b></h5>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>PORCENTAJE DE OPERACIÓN DE EQUIPOS CRITICOS</h5>
                        </div>
                        <div class="col-md-4 text-center" >
                            <h5><?=$s10_tomografia/ count($sqlInfo)?>%</h5>
                            <h5><b>TOMOGRAFÍA</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s10_resonador/ count($sqlInfo)?>%</h5>
                            <h5><b>RESONADOR</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s10_rayos_x/count($sqlInfo)?>%</h5>
                            <h5><b>RAYOS "X"</b></h5>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-4 text-center" >
                            <h5><?=$s10_hemocomponentes/ count($sqlInfo)?>%</h5>
                            <h5><b>HEMOCOMPONENTES</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s10_ventiladores/count($sqlInfo)?>%</h5>
                            <h5><b>VENTILADORES</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s10_desfibriladores/count($sqlInfo)?>%</h5>
                            <h5><b>DESFIBRILADORES</b></h5>
                        </div>
                        <div class="col-md-12 back-imss text-center" style="margin-bottom: 10px;margin-top: 10px">
                            <h5>EQUIPO DE SOPORTE DE LA UNIDAD</h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <h5><?=$s11_elevadores/count($sqlInfo)?>%</h5>
                            <h5><b>ELEVADORES</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s11_suministro_de_luz/count($sqlInfo)?>%</h5>
                            <h5><b>SUMINISTRO DE LUZ EXTERNO</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s11_planta_de_luz/count($sqlInfo)?>%</h5>
                            <h5><b>PLANTA DE LUZ</b></h5>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-4 text-center">
                            <h5><?=$s11_combustible_planta_de_luz?></h5>
                            <h5><b>SUPERVISIÓN DE COMBUSTIBLE DE LA PLANTA DE LUZ</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s11_tanque_termo_oxigeno?></h5>
                            <h5><b>TANQUE TERMO DE OXÍGENO</b></h5>
                        </div>
                        <div class="col-md-4 text-center" style="border-left: 2px solid #256659">
                            <h5><?=$s11_generador_de_vapor/count($sqlInfo)?>%</h5>
                            <h5><b>GENERADOR DE VAPOR</b></h5>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<input type="hidden" name="ShoChartCamas" value="Si">
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/UmHospitales.js?<?= md5(microtime())?>"></script>


