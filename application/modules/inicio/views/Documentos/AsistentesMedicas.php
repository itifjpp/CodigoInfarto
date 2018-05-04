<?php ob_start(); ?>
<page backtop="20mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <div style="margin-top: 20px;margin-left: 30px;margin-right: 40px">
            <table>
                <tr>
                    <td style="width: 60%;text-align: left"><b>ASISTENTE MÉDICA :</b> <?=$Am['empleado_nombre']?> <?=$Am['empleado_ap']?> <?=$Am['empleado_am']?></td>
                    <td style="width: 40%;text-align: right">
                        <b>FECHA Y HORA: </b> <?= date('d/m/Y')?> <?= date('H:i')?><br>
                        <b>TOTAL DE ST7: </b> <?= count($Gestion)?>
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
                        <th style="width: 8%;font-size: 9px;">FOLIO</th>
                        <th style="width: 10%;font-size: 9px;">PACIENTE</th>
                        <th style="width: 10%;font-size: 9px;">ASISTENTE MÉDICA</th>
                        <th style="width: 10%;font-size: 9px;">MÉDICO TRATANTE</th>
                        <th style="width: 10%;font-size: 9px;">PROCEDENCIA</th>
                        <th style="width: 10%;font-size: 9px">COLOR</th>
                        <th style="width: 13%;font-size: 9px">INCAPACIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Gestion as $value) {?>
                    <tr>
                        <td style=";font-size: 12px;"><?=$value['triage_id']?></td>
                        <td style="text-transform: uppercase;font-size: 9px;"><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                        <td style="text-transform: uppercase;font-size: 9px;"><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?> <?=$value['empleado_am']?></td>
                        <td style="text-transform: uppercase;font-size: 9px;">
                            <?= Modules::run('Inicio/Documentos/Medico',array('triage_id'=>$value['triage_id']))?> 
                        </td>
                        <td style="text-transform: uppercase;font-size: 9px;">
                            <?php
                            $sqlPIA=$this->config_mdl->_get_data_condition('paciente_info',array(
                                'triage_id'=>$value['triage_id']
                            ))[0];
                            ?>
                            <?=$sqlPIA['pia_procedencia_espontanea']=='Si' ? $sqlPIA['pia_procedencia_espontanea_lugar'] : $sqlPIA['pia_procedencia_hospital'].' '.$sqlPIA['pia_procedencia_hospital_num']?>
                        </td>
                        <td ><?=$value['triage_color']?></td>
                        <td>
                            <?=$value['asistentesmedicas_incapacidad_ga']=='Si' ? $value['asistentesmedicas_incapacidad_da'].' Dias' : 'No'?>
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
    $pdf->pdf->SetTitle('REPORTES DE PACIENTES CON ST7');
    $pdf->Output('REPORTES DE PACIENTES CON ST7.pdf');
?>