<?php ob_start(); ?>
<page backtop="10mm" backbottom="7mm" backleft="60mm" backright="10mm">
    <div style="position: absolute;margin-top: 10px">

        <br>
        <?php foreach ($Gestion as $val){?>
        <barcode type="C128A" value="<?=$val['material_id']?>" style="height: 80px;width: 200px" ></barcode><br><br>
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
    $pdf->pdf->SetTitle('SOLICITUD Y CONSUMO DE MATERIALES DE OSTEOSINTESIS');
    $pdf->Output('SOLICITUD Y CONSUMO DE MATERIALES DE OSTEOSINTESIS.pdf');
?>