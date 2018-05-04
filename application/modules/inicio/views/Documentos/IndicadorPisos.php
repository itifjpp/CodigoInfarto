<?php ob_start(); ?>
<page backtop="20mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <div style="margin-top: 20px;margin-left: 30px;margin-right: 40px">
            <table>
                <tr>
                    <td style="width: 60%;text-align: left">
                        <?php if($_GET['TIPO_ACCCION']=='INGRESO'){?>
                        <b>INGRESO DE PACIENTES A PISOS</b> 
                        <?php }else{?>
                         <b>ALTAS DE PACIENTES DE PISOS</b> 
                        <?php }?>
                    </td>
                    <td style="width: 40%;text-align: right">
                        <b>FECHA Y HORA: </b> <?= date('d/m/Y')?> <?= date('H:i')?><br>
                        <b>TOTAL: </b> <?= count($Gestion)?>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <div style="position: absolute;margin-top: 10px">
        
        <style>
            table {border-collapse: collapse;width: 100%;}
            th, td {text-align: left;padding: 8px;}
            tr:nth-child(even){background-color: #f2f2f2}
            th {background-color: #4CAF50;color: white;}
        </style>
        <table style="width: 100%">
                <thead>
                    <tr>
                        <th style=";font-size: 9px;">N.S.S</th>
                        <th style=";font-size: 9px;">PACIENTE</th>
                        <th style=";font-size: 9px;">CAMA</th>
                        <th style=";font-size: 9px;">PISO</th>
                        <th style=";font-size: 9px;">SERVICIO</th>
                        <th style="font-size: 9px">HORA INGRESO</th>
                        <th style="font-size: 9px">HORA EGRESO</th>
                        <th style="font-size: 9px">T.T</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Gestion as $value) {?>
                    <tr>
                        <td style="width: 16%;font-size: 10px;"><?=$value['triage_paciente_afiliacion']?></td>
                        <td style="width: 18%;text-transform: uppercase;font-size: 9px;"><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                        <td style="width: 6%;text-transform: uppercase;font-size: 9px;"><?=$value['cama_nombre']?></td>
                        <td style="width: 12%;text-transform: uppercase;font-size: 9px;"><?=$value['piso_nombre']?></td>
                        <td style="width: 16%;text-transform: uppercase;font-size: 9px;"><?=$value['area_nombre']?></td>
                        <td style="width: 10%;text-transform: uppercase;font-size: 9px;"><?=$value['ap_f_ingreso']?> <?=$value['ap_h_ingreso']?></td>
                        <td style="width: 10%;text-transform: uppercase;font-size: 9px;"><?=$value['ap_f_salida']?> <?=$value['ap_h_salida']?></td>
                        <td style="width: 12%;text-transform: uppercase;font-size: 9px;">
                            <?php if($value['ap_f_salida']!=''){?>
                            <?= Modules::run('Config/TiempoTranscurrido',array(
                                'Tiempo1_fecha'=>$value['ap_f_ingreso'],
                                'Tiempo1_hora'=>$value['ap_h_ingreso'],
                                'Tiempo2_fecha'=>$value['ap_f_salida'],
                                'Tiempo2_hora'=>$value['ap_h_salida'],
                            ))?> Minutos
                            <?php }else{?>
                            NO APLICA
                            <?php }?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
    </div>
    <page_footer>
        <div style="text-align:right">
            Página [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTES DE INGRESOS Y ALTAS EN PISOS');
    $pdf->Output('REPORTES DE INGRESOS Y ALTAS EN PISOS.pdf');
?>