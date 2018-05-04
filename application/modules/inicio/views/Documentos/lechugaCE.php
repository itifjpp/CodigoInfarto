<?php ob_start(); ?>
<page backleft="10mm" backright="10mm" backtop="7mm">
    <page_header>
        
    </page_header>
    <div style="position: absolute;">
        <img src="assets/doc/lechuga/4_30_6BUENA_1.png" style="position: absolute;width: 100%;">
        <div style="position: absolute;margin-left: 180px;margin-top: 83px;font-size: 11px"><?=  date('d/m/Y')?></div>
        <div style="position: absolute;margin-left: 546px;margin-top: 81px;font-size: 6px;width: 47px;"><?=$_SESSION['UMAE_AREA']?></div>
    
        <div style="position: absolute;margin-left: 280px;margin-top: 120px;font-size: 11px;"><?=$medico['empleado_nombre']?> <?=$medico['empleado_ap']?> <?=$medico['empleado_am']?></div>
        
        <div hidden="" style="position: absolute;margin-left: 467px;margin-top: 230px;font-size: 11px;"><?=$info['triage_paciente_accidente_lugar']=='HOGAR'? '_____________': ''?></div>
        <div hidden style="position: absolute;margin-left: 467px;margin-top: 240px;font-size: 11px;"><?=$info['triage_paciente_accidente_lugar']=='TRABAJO'? '_____________': ''?></div>
        <div hidden style="position: absolute;margin-left: 467px;margin-top: 250px;font-size: 11px;"><?=$info['triage_paciente_accidente_lugar']=='VIA PUBLICA'? '_____________': ''?></div>
        
        <div hidden style="position: absolute;margin-left: 467px;margin-top: 260px;font-size: 11px;"><?=$info['triage_paciente_accidente_lugar']=='C. RECREATIVO'? '_____________': ''?></div>
        <div hidden style="position: absolute;margin-left: 467px;margin-top: 270px;font-size: 11px;"><?=$info['triage_paciente_accidente_lugar']=='ESCUELA'? '_____________': ''?></div>
        <div hidden style="position: absolute;margin-left: 467px;margin-top: 280px;font-size: 11px;"><?=$info['triage_paciente_accidente_lugar']=='TRAYECTO'? '_____________': ''?></div>
        <style>
            table{border: 1px solid black; }
            td, th {border: 1px solid black; }
            table {border-collapse: collapse;width: 100%;}
            td {vertical-align: bottom;}
            .th_1{padding: 5px 2px 15px 2px;text-align: center}
            .th_2{padding: 5px 5px 15px 5px;}
        </style>
        <br><br>
        <table style="width: 100%">
            <?php $i=0; foreach ($Gestion as $value) { $i++;?>
            <tr>
                <td class="th_1" style="font-size: 10px;width: 3.5%"><?=$i?></td>
                <td style="width: 5%;font-size: 9px" class="th_2"><?=$value['ce_he']?></td>
                <td style="width: 91%">
                    <table style="width: 95.5%;border-bottom: 0px;margin-left: -1px;margin-bottom: -3px;margin-top: -2px">
                        <tr>
                            <th colspan="28" style="font-size: 9px;padding-left: 5px;padding-top: 3px; width: 80%;font-weight: 100;padding-bottom: 0px;">
                                <span><?=$value['hf_diagnosticos_lechaga']?></span>
                            </th>
                        </tr>
                        <tr style=";border-top: 0px;height: 20px">
                            <td style="width: 2%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px;;height: 5px"></td>
                            <td style="width: 2.5%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.7%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.9%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.7%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 14.2%;padding: 3px;font-size: 8px;border-top: 0px">
                                <table cellspacing="0" cellpadding="0" border="0" style="border: 1px solid transparent">
                                    <tr style="border: 1px solid transparent">
                                        <td style="border: 1px solid transparent"><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                                    </tr>
                                    <tr style="border: 1px solid transparent">
                                        <td style="border: 1px solid transparent"><?=$value['triage_paciente_afiliacion']?></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 1.5%;padding: 3px 2px 3px 2px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-top: 0px"></td>
                        </tr>
                        <tr style=";border-bottom: 0px;display: none">
                            <td style="width: 2%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">1</td>
                            <td style="width: 2.5%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">2</td>
                            <td style="width: 2.7%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">3</td>
                            <td style="width: 2.8%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">4</td>
                            <td style="width: 2.6%;padding: 3px 5px 3px 5px; font-size: 8px;border-bottom: 0px">5</td>
                            <td style="width: 2.6%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">6</td>
                            <td style="width: 2.7%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">7</td>
                            <td style="width: 2.7%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">8</td>
                            <td style="width: 2.7%;padding: 3px 5px 3px 5px;font-size: 8px;border-bottom: 0px">9</td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px">10</td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px">11</td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px">12</td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px">13</td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px">14</td>
                            <td style="width: 2%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px">15</td>
                            <td style="width: 49.3%;padding: 3px 3.5px 3px 3.5px;font-size: 8px;border-bottom: 0px" colspan="8">Alta a <?=$value['hf_alta']?></td>
                            <td style="width: 2.7%;padding: 3px 5px 5px 3px;font-size: 8px;border-bottom: 0px"></td>
                            <td style="width: 2.7%;padding: 3px 5px 5px 3px; font-size: 8px;border-bottom: 0px"></td>
                            <td style="width: 2.7%;padding: 3px 5px 5px 3px;font-size: 8px;border-bottom: 0px"></td>
                            <td style="width: 2.7%;padding: 3px 5px 5px 3px;font-size: 8px;border-bottom: 0px"></td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
            <?php }?>
        </table>
        
        
    </div>
    <page_footer></page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('FORMATO_4.30.6_LECHUGA.pdf');
?>