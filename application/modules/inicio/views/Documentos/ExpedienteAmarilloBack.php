<?php ob_start(); ?>
<page backtop="0mm" backbottom="10mm" backleft="0">
    <div style="position: absolute;left: 320px;top: 100px">
            <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 40px;" ></barcode>
    </div>
</page>

<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle($info['triage_nombre'].' '.$info['triage_nombre_ap'].' '.$info['triage_nombre_am'].' - Expediente Amarillo');
    $pdf->Output('Expediente Amarillo.pdf');
?>