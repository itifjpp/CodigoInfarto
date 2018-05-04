<?php ob_start(); ?>
<page backright="0mm">
    <div style="position: absolute;top: -5px">
        <div style="position: absolute;left: 250px">
            <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 80px;width: 200px" ></barcode>
        </div>
        
        <div style="position: absolute;left: 460px;width: 430px;">
            <b style="font-size: 19px;"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></b>
            <b style="margin-top: 6px;font-size: 15px"><?=$info['paciente_nombre']=='' ? 'PSEUDONIMO: '.$info['paciente_pseudonimo'] : $info['paciente_ap'].' '.$info['paciente_am'].' '.$info['paciente_nombre']?> </b><br>
            <b style="margin-top: 4px;font-size:12px"><b>R.F.C: <?=$info['paciente_rfc']?></b></b><br>
            <b style="margin-top: 4px;font-size:12px">FECHA DE NAC: <?=$info['paciente_fn']?></b>
        </div>
        <div style="position: absolute;left: 858px;">
            <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 80px;">
        </div>
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Pulsera.pdf');
?>