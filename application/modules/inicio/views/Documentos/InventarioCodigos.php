<?php ob_start(); ?>
<page backtop="10mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <div style="position: absolute;margin-top: 10px">
        <?php foreach ($Gestion as $val){?>
        <div style="float: left;display: inline;width: 200px;padding: 12px">
            <barcode type="C128A" value="<?=$val['inventario_id']?>" style="height: 80px;width: 200px;" ></barcode>
        </div>
        <?php }?>
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
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('IMPRESIÓN DE CODIGOS DE BARRA DEL INVENTARIO DE RANGOS');
    $pdf->Output('IMPRESIÓN DE CODIGOS DE BARRA DEL INVENTARIO DE RANGOS.pdf');
?>