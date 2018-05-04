<?php ob_start(); ?>
<page backleft="12.5mm" backright="15mm" backtop="20mm" backbottom="5mm">
    <div style="position: absolute;top: -5px">
        <div style="position: absolute;left: 250px">
            <barcode type="C128A" value="<?=$_GET['codigo']?>" style="height: 80px;width: 200px" ></barcode>
        </div>
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('INSUMOS'.$_GET['codigo'].'.pdf');
?>
