<?php ob_start(); ?>
<page backtop="85mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/doc/CONSENTIMIENTO_INFORMADO.png" style="position: absolute;width: 100%;margin-top: 0px;margin-left: -5px;">
        <div style="position: absolute;">
            <div style="width: 550px;margin-top: 55px;margin-left: 90px">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 10%">
                             <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                        </td>
                        <td style="text-align: center;width: 80%">
                            <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                            <p style="text-transform: uppercase;font-size: 10px;font-weight: 300;margin-top: 3px;margin-bottom: 0px">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                            <p style="text-transform: uppercase;font-size: 10px;font-weight: 300;margin-top: 3px;margin-bottom: 0px">UNIDAD DE ATENCIÓN MÉDICA</p>
                            <p style="text-transform: uppercase;font-size: 10px;font-weight: 300;margin-top: 3px;margin-bottom: 0px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        </td>
                        <td style="width: 10%;text-align: right">
                            <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 55px;"></qrcode>
                        </td>
                    </tr>
                </table>
            </div>    
        </div>
        
        <div style="position: absolute;margin-top: 15px">
            <div style="position: absolute;top: 185px;left: 450px;font-size: 12px;text-transform: uppercase;width: 190px;">
                <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b>
            </div>
            <div style="position: absolute;top: 219px;left: 482px;font-size: 10px;text-transform: uppercase;width: 160px;">
                
                <b><?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?></b>
            </div>
            <div style="position: absolute;top: 233px;left: 440px;font-size: 12px;text-transform: uppercase;">
                <b><?=$info['paciente_sexo']?></b>
            </div>
            <div style="position: absolute;top: 233px;left: 580px;font-size: 12px;text-transform: uppercase;">
                <?php 
                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['paciente_fn']));?>
                <b><?=$fecha->y?> AÑOS</b>
            </div>
            <div style="position: absolute;top: 307px;left: 120px;font-size: 10px;text-transform: uppercase;">
                <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b>
            </div>
        </div>
        <div style="position: absolute;top: 1000px">
            <div style="margin-left: 280px;">
                <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
            </div>
        </div>
    </page_header>
    
    <page_footer>
        
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('Consentimiento Informado');
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Consentimiento Informado.pdf');
?>