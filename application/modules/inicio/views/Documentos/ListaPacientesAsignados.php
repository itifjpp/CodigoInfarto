<?php ob_start(); ?>
<page backtop="20mm" backbottom="10mm" backleft="5mm" backright="10mm">
    <page_header>
        <h4 style="text-align: center">Lista de Pacientes Asignados a Consultorios</h4>
        <h4 style="text-align: center;margin-top: -5px">Total de Pacientes :<?= count($Gestion)?> Pacientes</h4>
    </page_header>
    <style>
        table { border-collapse: collapse;width: 100%; }
        th, td {text-align: left;padding: 5px;}
        tr:nth-child(even){background-color: #f2f2f2}
        th {background-color: #4CAF50;color: white;}
    </style>
    <div style="position: absolute;top: 30px">
        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 15%;font-size: 11px">Nombre</th>
                    <th style="width: 10%;font-size: 11px">Ingreso</th>
                    <th style="width: 17%;font-size: 11px">Tiempo Consultorio</th>
                    <th style="width: 13%;font-size: 11px">Consultorio</th>
                    <th style="width: 25%;font-size: 11px">Médico</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <?php $t_c=Modules::run('Config/CalcularTiempoTranscurrido',array('Tiempo1'=> str_replace('/', '-', $value['ce_fe']).' '.$value['ce_he'],'Tiempo2'=>date('d-m-Y').' '.date('H:i')));?>
                <tr id="<?=$value['triage_id']?>" >
                    <td style="font-size: 9px;" >
                        <?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> 
                    </td>
                    <td style="font-size: 9px;"><?=$value['ce_fe']?> <?=$value['ce_he']?></td>
                    <td style="font-size: 9px;"><?=$t_c->d?> Días <?=$t_c->h?> Horas <?=$t_c->i?> Minutos</td>
                    <td style="font-size: 9px;"><?=$value['ce_asignado_consultorio']?></td>
                    <td style="font-size: 9px;"><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                </tr>

                <?php }?>
            </tbody>
        </table>
    </div>
    <page_footer>
        <h6 style="text-align: center">Página [[page_cu]]/[[page_nb]]</h6>
    </page_footer>
    
        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->setTitle('Lista de Pacientes');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Lista de Pacientes.pdf');
?>