<?php ob_start(); ?>
<page backtop="0mm" backbottom="7mm" backleft="0mm" backright="0mm">
    <page_header>
        
    </page_header>
    <div style="margin-top: 20px;">
        <img src="assets/doc/sigh_430200.png" style="position: absolute;width: 100%;margin-left: -5px;"> 
        <div style="width: 670px;margin-top: 45px;margin-left: 40px;position: absolute">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        
                    </td>
                    <td style="width: 10%;text-align: right">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 10px;margin-bottom: 0px">SOLICITUD DE SERVICIO (INTERCONSULTA) 4-30-200</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute;margin-top: 168px;margin-left: 227px;font-size: 10px;"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></div>
        <div style="position: absolute;margin-top: 186px;margin-left: 54px;font-size: 10px;">
            FECHA DE ELABORACIÓN<br>
            <?=$doc['doc_fecha']?>
        </div>
        <div style="position: absolute;margin-top: 186px;margin-left: 240px;font-size: 10px;">
            FECHA EN QUE SE PRESENTA EL PACIENTE<br>
            <?=$am['asistentesmedicas_fecha']?>
        </div>
        <div style="position: absolute;margin-top: 200px;margin-left: 486px;font-size: 10px;"><?=$doc['doc_fecha']?></div>
        <div style="position: absolute;margin-top: 256px;margin-left: 53px;font-size: 12px;width: 420px;">
            <?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?>
        </div>
        <div style="position: absolute;margin-top: 255px;margin-left: 486px;font-size: 12px;width: 220px;"><?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?></div>
        <div style="position: absolute;margin-top: 304px;margin-left: 54px;font-size: 12px;width: 420px;"><?=$doc['doc_servicio_envia']?></div>
        <div style="position: absolute;margin-top: 304px;margin-left: 485px;font-size: 11px;width: 220px;"><?=$doc['doc_servicio_solicitado']?></div>
        <div style="position: absolute;margin-top: 336px;margin-left: 54px;font-size: 10px;width: 650px;"><?=$doc['doc_diagnostico']?></div>
        <div style="position: absolute;margin-top: 400px;margin-left: 50px;font-size: 10px;width: 180px;"><?=$medico['empleado_nombre']?> <?=$medico['empleado_ap']?> <?=$medico['empleado_am']?></div>
        <div style="position: absolute;margin-top: 400px;margin-left: 246px;font-size: 10px;width: 225px;"><?=$medico['empleado_matricula']?></div>
        <div style="position: absolute;margin-top: 450px;margin-left: 300px;font-size: 10px;">
            <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
        </div>
        <br><br>
        <hr style="position: absolute;border: 1px dashed black;margin-top: 510px" >
    </div>
    
    <div style="margin-top: 500px;position: absolute">
        <img src="assets/doc/sigh_430200.png" style="position: absolute;width: 100%;margin-left: -5px;"> 
        <div style="width: 670px;margin-top: 45px;margin-left: 40px;position: absolute">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        
                    </td>
                    <td style="width: 10%;text-align: right">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 10px;margin-bottom: 0px">SOLICITUD DE SERVICIO (INTERCONSULTA) 4-30-200</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute;margin-top: 168px;margin-left: 227px;font-size: 10px;"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></div>
        <div style="position: absolute;margin-top: 186px;margin-left: 54px;font-size: 10px;">
            FECHA DE ELABORACIÓN<br>
            <?=$doc['doc_fecha']?>
        </div>
        <div style="position: absolute;margin-top: 186px;margin-left: 240px;font-size: 10px;">
            FECHA EN QUE SE PRESENTA EL PACIENTE<br>
            <?=$am['asistentesmedicas_fecha']?>
        </div>
        <div style="position: absolute;margin-top: 200px;margin-left: 486px;font-size: 10px;"><?=$doc['doc_fecha']?></div>
        <div style="position: absolute;margin-top: 256px;margin-left: 53px;font-size: 12px;width: 420px;">
            <?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?>
        </div>
        <div style="position: absolute;margin-top: 255px;margin-left: 486px;font-size: 12px;width: 220px;"><?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?></div>
        <div style="position: absolute;margin-top: 304px;margin-left: 54px;font-size: 12px;width: 420px;"><?=$doc['doc_servicio_envia']?></div>
        <div style="position: absolute;margin-top: 304px;margin-left: 485px;font-size: 11px;width: 220px;"><?=$doc['doc_servicio_solicitado']?></div>
        <div style="position: absolute;margin-top: 336px;margin-left: 54px;font-size: 10px;width: 650px;"><?=$doc['doc_diagnostico']?></div>
        <div style="position: absolute;margin-top: 400px;margin-left: 50px;font-size: 10px;width: 180px;"><?=$medico['empleado_nombre']?> <?=$medico['empleado_ap']?> <?=$medico['empleado_am']?></div>
        <div style="position: absolute;margin-top: 400px;margin-left: 246px;font-size: 10px;width: 225px;"><?=$medico['empleado_matricula']?></div>
        <div style="position: absolute;margin-top: 450px;margin-left: 300px;font-size: 10px;">
            <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
        </div>
    </div>
    <page_footer>
        <div style="margin-left: 280px;">
            
        </div>
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
    $pdf->pdf->SetTitle('SOLICITUD DE SERVICIOS (INTERCONSULTA) 4 30 200');
    $pdf->Output('SOLICITUD DE SERVICIOS (INTERCONSULTA) 4 30 200.pdf');
?>