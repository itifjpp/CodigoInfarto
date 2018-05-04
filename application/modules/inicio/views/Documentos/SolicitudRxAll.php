<?php ob_start(); ?>
<page backtop="72mm" backbottom="50mm" backleft="12" backright="12mm">
    <page_header>
        <img src="assets/doc/sigh_rx.jpg" style="position: absolute;width: 805px;margin-top: -30px;margin-left: -10px;">
        <div style="width: 340px;margin-top: 17px;margin-left: 40px;position: absolute;">
            <table >
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 90%;height: 80px">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <p style="text-transform: uppercase;font-size: 14px;font-weight: bold;margin-top: 0px;margin-bottom: 0px">SOLICITUD DE ESTUDIOS RADIOGRÁFICOS</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute;margin-top: 15px">
            <div style="position: absolute;margin-left: 437px;margin-top: 15px;width: 270px;text-transform: uppercase;font-size: 21px;">
                <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 65px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>N.S.S:</b> <?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?>
            </div>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn'])); ?>
            <div style="position: absolute;margin-left: 437px;margin-top: 79px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>EDAD:</b> <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 92px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>SEXO:</b> <?=$info['paciente_sexo']?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 105px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>MÉDICO:</b> <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?>
            </div>
            <div style="position: absolute;margin-left: 420px;margin-top: 130px">
                <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
            </div>
            <div style="position: absolute;margin-left: 660px;margin-top: 130px">
                <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
            </div>
        </div>
        <div style="position: absolute;left: 50px;margin-top: 248px;font-size: 12px;text-align: center;text-transform: uppercase">
            <b>FECHA:</b> <?=$sqlSolicitudesRx[0]['solicitud_fecha']?>
        </div>
        <div style="position: absolute;width: 510px;left: 193px;margin-top: 500px;font-size: 8px;text-align: center;text-transform: uppercase">
            <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?> <?=$Medico['empleado_matricula']?> 
            <p style="margin-bottom: 3px;margin-top: -8px">_____________________________________________________</p>
            NOMBRE DEL MÉDICO Y MATRICULA
        </div>
    </page_header>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, td, th {   
            font-size: 12px;
            text-align: left;
        }
        td,th{
            padding: 5px;
        }
    </style>
    <span style="text-align: justify">
        <table >
            <thead>
                <tr>
                    <td></td>
                    <td style="width: 78.5%;font-size: 15px;text-align: justify;text-transform: uppercase">
                        <b>DX PRESUNCIONAL:</b> <?=$sqlSolicitudesRx[0]['solicitud_dx_presuncional']?>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 13px"><b>REGIÓN ANATOMICA</b></td>
                    <td style="font-size: 13px"><b>ESTUDIO SOLICITADO</b></td>
                </tr>
            </thead>
            <tbody>
            <?php 
            $sqlEstudios=$this->config_mdl->sqlQuery("SELECT solicitud_fecha,solicitud_hora,ra_nombre,estudio_nombre FROM sigh_rx_solicitudes_estudios, sigh_rx_solicitudes, sigh_rx_ra, sigh_rx_ra_estudios
                                                WHERE 
                                                sigh_rx_solicitudes_estudios.solicitud_id=sigh_rx_solicitudes.solicitud_id AND
                                                sigh_rx_solicitudes_estudios.estudio_id=sigh_rx_ra_estudios.estudio_id AND
                                                sigh_rx_ra_estudios.ra_id=sigh_rx_ra.ra_id AND sigh_rx_solicitudes.solicitud_id=".$_GET['sol']);
            foreach ($sqlEstudios as $es) {?>
                <tr>
                    <td style="width: 21.5%"><?=$es['ra_nombre']?></td>
                    <td style="width: 78.5%"><?=$es['estudio_nombre']?></td>
                </tr>
        
            <?php }?>
            </tbody>
        </table>
    </span>
    <page_footer>
        
    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','en',true,'UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('SOLICITUD DE RX');
    $pdf->Output('SOLICITUD DE RX.pdf');
?>