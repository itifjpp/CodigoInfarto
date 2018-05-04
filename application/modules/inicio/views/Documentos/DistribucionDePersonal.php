<?php ob_start(); ?>
<page backtop="40mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/img/logo_left.jpg" style="width: 97%;margin-left: 10px">
        <table style="width: 100%;margin-left: 10px">
            <tr>
                <td style="width: 100%">
                    <h2 style="text-align: center;margin-top: 10px"><?=$this->sigh->getInfo('hospital_tipo')?></h2>
                    <h4 style="text-align: center;margin-top: -10px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h4>
                </td>
            </tr>
        </table>
    </page_header>
    <div style="position: absolute;margin-top: 10px">
        
        <style>
            .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;}
            .table {border-collapse: collapse;width: 100%;}
            .table th, .table td {padding: 5px;}
        </style>
        <h4>REPORTE DE DISTRIBUCION DE PERSONAL </h4>
        <table style="width: 100%;font-size: 11px" class="table">
            <tr>
                <th style="width: 50%">JEFE DE URGENCIAS</th>
                <th style="width: 25%">FECHA</th>
                <th style="width: 25%">TURNO</th>
            </tr>
            <tr>
                <td><?=$Dp['empleado_nombre']?> <?=$Dp['empleado_ap']?> <?=$Dp['empleado_am']?></td>
                <td><?=$Dp['distribucion_fecha']?></td>
                <td style="text-transform: uppercase"><?=$Dp['distribucion_turno']?></td>
            </tr>
        </table>
        <h4>PERSONAL</h4>
        <table style="width: 100%;font-size: 11px" class="table">
                <thead>
                    <tr>
                        <th>MATRICULA</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>ÁREA</th>
                        <th>TIPO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Gestion as $value) {?>
                    <tr>
                        <td style="width: 15%"><?=$value['empleado_matricula']?></td>
                        <td style="width: 25%"><?=$value['empleado_nombre']?></td>
                        <td style="width: 20%"><?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                        <td style="width: 20%"><?=$value['dp_area']?></td>
                        <td style="width: 20%"><?=$value['dp_tipo']?></td>
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
    $pdf=new HTML2PDF('P','A4','es','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DE DISTRIBUCIÓN DE PERSONAL');
    $pdf->Output('REPORTE DE DISTRIBUCIÓN DE PERSONAL.pdf');
?>