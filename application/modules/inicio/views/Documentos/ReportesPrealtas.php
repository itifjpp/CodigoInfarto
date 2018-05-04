<?php ob_start(); ?>
<page backtop="30mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <table style="width: 100%;border: transparent!important;margin-left: 38px;">
            <tr style="">
                <td style="padding: 0p;">
                    <img src="assets/img/imss.png" style="width: 50px;height: 60px;margin-top: -10px">
                </td>
                <td style="width: 83%;">
                    <h4 style="text-align: left;margin-top: 4px;font-size: 25px">INSTITUTO MEXICANO DEL SEGURO SOCIAL</h4>
                    <h4 style="text-align: left;margin-top: -15px"><?=$this->sigh->getInfo('hospital_tipo')?></h4>
                    <h3 style="text-align: left;margin-top: -15px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h3>
                </td>
            </tr>
        </table>
        
        
    </page_header>
    <div style="">
        
        <style>
            .table_re td, th {  border: 1px solid #ddd;text-align: left;  }
            .table_re {border-collapse: collapse;width: 100%;}
            .table_re th, td {padding: 5px;}
        </style>
        <table class="table_re" style="width: 100%">
            <thead>
                <tr>
                    <th style="font-size: 9px">N° DE FOLIO</th>
                    <th style="font-size: 9px">PACIENTE</th>
                    <th style="font-size: 9px">FECHA DE PRE-ALTA</th>
                    <th style="font-size: 9px">CAMA</th>
                    <th style="font-size: 9px">SERVICIO</th>
                    <th style="font-size: 9px">ESTADO VALIDACIÓN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <tr>
                    <td style="font-size: 9px;"><?=$value['triage_id']?></td>
                    <td style="font-size: 9px;width: 30%"><?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> <?=$value['triage_nombre']?></td>
                    <td style="font-size: 9px;width: 17%"><?=$value['prealta_fecha']?> <?=$value['prealta_hora']?></td>
                    <td style="font-size: 9px;width: 10%"><?=$value['cama_nombre']?></td>
                    <td style="font-size: 9px;width: 15%"><?=$value['area_nombre']?></td>
                    <td style="font-size: 9px;width: 18%"><?=$value['prealta_confirm']=='' ? 'PRE-ALTA':$value['prealta_confirm']?></td>

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
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DE CAMAS OCUPADAS');
    $pdf->Output('REPORTE DE CAMAS OCUPADAS.pdf');
?>