<?php ob_start(); ?>
<page backtop="20mm" backbottom="15mm" backleft="10mm" backright="10mm">
    <page_header>
        <style>
            .table-header{
                width: 100%;border:transparent;margin-left: 38px;
            }
        </style>
        <table class="table-header">
            <tr style="">
                <td style="padding: 0p;">
                    <img src="assets/img/imss.png" style="width: 50px;height: 60px;margin-top: -10px">
                </td>
                <td style="width: 83%;">
                    <h4 style="text-align: left;margin-top: 4px;font-size: 25px">INSTITUTO MEXICANO DEL SEGURO SOCIAL</h4>
                    <h4 style="text-align: left;font-size: 20px;margin-top: -14px"><?=$Hospital['hospital_nombre']?></h4>
                </td>
            </tr>
        </table>
        
        
    </page_header>
    <div style="">
        <h4 style="text-align: center">REPORTE DEL ESTADO ACTUAL DEL HOSPITAL  DEL <?=$info['status_fecha']?> ALAS <?=$info['status_hora']?></h4>
        <style>
            .table_, .table_ td, .table_ th {    border: 1px solid #ddd;text-align: left;}
            .table_ {border-collapse: collapse;width: 100%;}
            .table_ th, .table_ td {padding: 5px;}
        </style>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" colspan="2">
                        <b>DISPONIBILIDAD DE CAMAS Y SERVICIOS</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 70%;font-size: 9px">CAMAS TOTAL</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_camas_hospitalacion']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">CAMAS ADULTOS</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_camas_adultos']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">CAMAS ADULTOS QUEMADOS</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_camas_adultos_quemados']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">CAMAS PEDÍATRICAS</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_camas_pediatria']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">CUNAS</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_cunas']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">CUNAS QUEMADOS</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_cunas_quemados']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">CAMAS DE TERAPIA DISPONIBLES</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_camas_terapia_intensiva']?></td>
                </tr>
                <tr>
                    <td style="width: 70%;font-size: 9px">ESPACIOS URGENCIAS</td>
                    <td style="width: 30%;font-size: 9px"><?=$info['s1_espacios_urgencias']?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" colspan="3">
                        <b>ADMISIÓN DE PACIENTES RELACIONADOS CON EL SISMO</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 32%;font-size: 9px"><b>TOTAL:</b> <?=$info['s2_total_derechohabiente']?></td>
                    <td style="width: 34%;font-size: 9px"><b>DERECHOHABIENTES:</b> <?=$info['s2_derechohabiente']?></td>
                    <td style="width: 34%;font-size: 9px"><b>NO DERECHOHABIENTES:</b> <?=$info['s2_noderechohabiente']?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" colspan="3">
                        <b>REPORTE DE DEFUNCIONES</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 50%;font-size: 9px"><b>RELACIONADOS CON EL SISMO:</b> <?=$info['s3_defunciones_si_sismo']?></td>
                    <td style="width: 50%;font-size: 9px"><b>NO RELACIONADOS CON EL SISMO:</b> <?=$info['s3_defunciones_no_sismo']?></td>
                    
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" >
                        <b>DAÑOS QUE PREVALEVEN EN LA UNIDAD PARA SER EVALUADOS POR EL PERSONAL ESPECIALIDADO</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 100%;font-size: 9px"><?=$info['s4_daños']?></td>
                </tr>
                <?php if($info['s4_daños_comentarios']!=''){?>
                <tr>
                    <td style="width: 100%;font-size: 9px"><b>COMENTARIOS:</b> <?=$info['s4_daños_comentarios']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                <tr>
                    <th style="font-size: 10px"><b>CAMAS OCUPADAS</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 10px;text-align: left;width: 100%" >
                        <?=$info['s5_camas_ocupadas']?> CAMAS
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" colspan="2">
                        <b>DISPONIBILIDAD DE HEMOCOMPONENTES</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 50%;font-size: 9px">PAQUETAS GLOBUlARES</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_paquetas_globulares']?></td>
                </tr>
                <tr>
                    <td style="width: 50%;font-size: 9px">PLASMA</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_plasmas']?></td>
                </tr>
                <tr >
                    <td style="width: 50%;font-size: 9px">ENVIADOS</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_envios']?></td>
                </tr>
                <tr>
                    <td style="width: 50%;font-size: 9px">RECIBIDOS</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_recibidos']?></td>
                </tr>
                <?php if($info['s6_comentarios']!=''){?>
                <tr>
                    <td colspan="2" style="font-size: 9px;width: 100%"><b>COMENTARIOS: </b><?=$info['s6_comentarios']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" >
                        <b>ANÁLISIS DE NECESIDADES</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 100%;font-size: 9px"><?=$info['s7_analisis_necesidades_pro']?></td>
                </tr>
                <?php if($info['s7_analisis_necesidades']!=''){?>
                <tr>
                    <td style="width: 100%;font-size: 9px"><b>COMENTARIOS: </b><?=$info['s7_analisis_necesidades']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                
                <tr>
                    <th style="font-size: 10px;text-align: center;" colspan="2">
                        <b>EGRESOS DE PACIENTES ESPECIFICANDO DESTINO</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 50%;font-size: 9px">HOSPITALIZADOS</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_egreso_hospitalizacion']?></td>
                </tr>
                <tr>
                    <td style="width: 50%;font-size: 9px">DOMICILIO</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_egreso_domicilio']?></td>
                </tr>
                <tr>
                    <td style="width: 50%;font-size: 9px">DEFUNCIÓN</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_egreso_defuncion']?></td>
                </tr>
                <tr>
                    <td style="width: 50%;font-size: 9px">TRASLADO</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_egreso_traslado']?></td>
                </tr>
                <tr>
                    <td style="width: 50%;font-size: 9px">TOTAL</td>
                    <td style="width: 50%;font-size: 9px"><?=$info['s6_egreso_total']?></td>
                </tr>
                <?php if($info['s6_egreso_comentarios']!=''){?>
                <tr>
                    <td style="width: 100%;font-size: 9px" colspan="2"><b>COMENTARIO:</b> <?=$info['s6_egreso_comentarios']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>      
</page>
<page backtop="20mm" backbottom="15mm" backleft="10mm" backright="10mm">
    <page_header>
        <style>
            .table-header{
                width: 100%;border:transparent;margin-left: 38px;
            }
        </style>
        <table class="table-header">
            <tr style="">
                <td style="padding: 0p;">
                    <img src="<?= base_url()?>assets/img/imss.png" style="width: 50px;height: 60px;margin-top: -10px">
                </td>
                <td style="width: 83%;">
                    <h4 style="text-align: left;margin-top: 4px;font-size: 25px">INSTITUTO MEXICANO DEL SEGURO SOCIAL</h4>
                    <h4 style="text-align: left;font-size: 20px;margin-top: -14px"><?=$Hospital['hospital_nombre']?></h4>
                </td>
            </tr>
        </table>
        
        
    </page_header>
    <div style="">
        <h4 style="text-align: center">REPORTE DEL ESTADO ACTUAL DEL HOSPITAL  DEL <?=$info['status_fecha']?> ALAS <?=$info['status_hora']?></h4>
        <table class="table_">
            <thead>
                <tr>
                    <th colspan="2" style="font-size: 10px;text-align: center;">
                        <b>ABASTO DE MEDICAMENTOS Y ESTADO DE LA RED DE FRÍO</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 9px;width: 50%">PORCENTAJE</td>
                    <td style="font-size: 9px;width: 50%"><?=$info['s9_abasto_porcentaje']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;width: 50%">DÍAS</td>
                    <td style="font-size: 9px;width: 50%"><?=$info['s9_abasto_dias']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">VENTILADORES DISPONIBLES</td>
                    <td style="font-size: 9px;"><?=$info['s9_ventiladores']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">QUIRÓFANOS DISPONIBLES</td>
                    <td style="font-size: 9px;"><?=$info['s9_sala_quirofanos']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">RED DE FRÍO</td>
                    <td style="font-size: 9px;"><?=$info['s9_red_fria']?></td>
                </tr>
                <?php if($info['s9_abasto_comentarios']!=''){?>
                <tr>
                    <td style="font-size: 9px;width: 100%" colspan="2"><b>COMENTARIOS: </b><?=$info['s9_abasto_comentarios']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                <tr>
                    <th colspan="2" style="font-size: 10px;text-align: center;">
                        <b>PROBLEMAS DE OPERACIÓN EN EQUIPOS CRITICOS Y SOPORTE</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 9px;width: 50%">TOMOGRAFÍA</td>
                    <td style="font-size: 9px;width: 50%"><?=$info['s10_tomografia']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;width: 50%">RESONADOR</td>
                    <td style="font-size: 9px;width: 50%"><?=$info['s10_resonador']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">RAYOS "X"</td>
                    <td style="font-size: 9px;"><?=$info['s10_rayos_x']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">HEMOCOMPONENTES</td>
                    <td style="font-size: 9px;"><?=$info['s10_hemocomponentes']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">VENTILDORES</td>
                    <td style="font-size: 9px;"><?=$info['s10_ventiladores']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">DISFIBRILADORES</td>
                    <td style="font-size: 9px;"><?=$info['s10_desfibriladores']?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table_">
            <thead>
                <tr>
                    <th colspan="2" style="font-size: 10px;text-align: center;">
                        <b>EQUIPO DE SOPORTE DE LA UNIDAD</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 9px;width: 50%">ELEVADORES</td>
                    <td style="font-size: 9px;width: 50%"><?=$info['s11_elevadores']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;width: 50%">SUMINISTRO DE LUZ EXTERNO</td>
                    <td style="font-size: 9px;width: 50%"><?=$info['s11_suministro_de_luz']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">PLANTA DE LUZ</td>
                    <td style="font-size: 9px;"><?=$info['s11_planta_de_luz']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">SUPERVISIÓN DE COMBUSTIBLE PLANTA DE LUZ</td>
                    <td style="font-size: 9px;"><?=$info['s11_combustible_planta_de_luz']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">TANQUE TERMO DE OXÍGENO</td>
                    <td style="font-size: 9px;"><?=$info['s11_tanque_termo_oxigeno']?></td>
                </tr>
                <tr>
                    <td style="font-size: 9px;">GENERADOR DE VAPOR</td>
                    <td style="font-size: 9px;"><?=$info['s11_generador_de_vapor']?></td>
                </tr>
            </tbody>
        </table>
    </div>      
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DEL STATUS DEL HOSPITAL');
    $pdf->Output('REPORTE DEL STATUS DEL HOSPITAL.pdf');
?>