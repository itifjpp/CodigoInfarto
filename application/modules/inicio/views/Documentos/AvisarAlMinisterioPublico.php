<?php ob_start(); ?>
<page backtop="80mm" backbottom="35mm" backleft="58" backright="15mm">
    <page_header>
        <img src="assets/doc/AMP.png" style="position: absolute;width: 100%;margin-top: 0px;">
        <div style="width: 686px;margin-top: 45px;margin-left: 30px;position: absolute">
            <table style="width: 100%">
                <tr>
                    <td style="width: 12%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 70px">
                    </td>
                    <td style="text-align: left;width: 76%">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        
                    </td>
                    <td style="width: 12%;text-align: right">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 70px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center">
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 10px;margin-bottom: 0px">AVISO AL MINISTERIO PÚBLICO</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute;margin-top: 15px">
            <div style="position: absolute;margin-left: 560px;margin-top:130px;width: 220px;text-transform: uppercase;font-size: 12px;">
                <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
            </div>
            <div style="position: absolute;margin-left: 50px;margin-top: 200px;width: 220px;text-transform: uppercase;font-size: 12px">
                <?=$this->sigh->getInfo('hospital_tipo')?>  <?=$this->sigh->getInfo('hospital_nombre')?>
            </div>
            <div style="position: absolute;margin-left: 355px;margin-top: 200px;width: 80px;text-transform: uppercase;font-size: 12px;">
                <?=$AvisoMp['mp_fecha']?>
            </div>
            <div style="position: absolute;margin-left: 590px;margin-top: 200px;width: 80px;text-transform: uppercase;font-size: 12px;">
                <b><?=$AvisoMp['mp_hora']?></b>
            </div>
            <div style="position: absolute;margin-left: 50px;margin-top: 260px;width: 200px;text-transform: uppercase;font-size: 12px;">
                G.A.M 3 EN TURNO
            </div>
            <div style="position: absolute;margin-left: 50px;margin-top: 380px;width: 655px;text-transform: uppercase;font-size: 12px;line-height: 1.4">
                DE ACUERDO CON LO DISPUESTO CON LA PROCURADURIA DE JUSTICIA DEL DISTRITO FEDERAL Y TERRITORIOS FEDERALES NOTIFICO QUE: <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b> ESTA INTERNADO EN EL <?=$this->sigh->getInfo('hospital_siglas_des')?>
            </div>
            <div style="position: absolute;margin-left: 340px;margin-top: 483px;width: 400px;text-transform: uppercase;font-size: 12px;">
                <b>
                    <?php 
                    if($AvisoMp['mp_area']=='Consultorios'){
                        $sqlConsultorio=$this->config_mdl->_get_data_condition('sigh_consultorios_especialidad',array(
                            'ingreso_id'=>$info['ingreso_id']
                        ))[0];
                        echo Modules::run('Consultoriosespecialidad/ObtenerServicioConsultorio',array(
                                'Consultorio'=>$sqlConsultorio['ce_asignado_consultorio']
                        ));
                    }if($AvisoMp['mp_area']=='Observacion'){
                        $sqlObs=$this->config_mdl->_query("SELECT * FROM sigh_observacion AS obs, sigh_areas AS area, sigh_camas AS cama WHERE
                            cama.area_id=area.area_id AND
                            area.area_id=obs.observacion_area AND ingreso_id=".$info['ingreso_id'])[0];
                        echo $sqlObs['area_nombre'];
                    }if($AvisoMp['mp_area']=='Choque'){
                        
                    }
                    ?>
                </b>
            </div>
            <div style="position: absolute;margin-left: 50px;margin-top: 465px;width: 660px;text-transform: uppercase;font-size: 12px;line-height: 1.2">
                <b>DOMICILIO:</b> <?=$this->sigh->getInfo('hospital_direccion')?><br>
                <b>TELEFONO: </b><?=$this->sigh->getInfo('hospital_telefono')?>
            </div>
            <div style="position: absolute;margin-left: 170px;margin-top: 507px;width: 660px;text-transform: uppercase;font-size: 12px;">
                URGENCIAS
            </div>
            <?php if($AvisoMp['mp_area']=='Observacion'){?>
            <div style="position: absolute;margin-left: 530px;margin-top: 540px;width: 660px;text-transform: uppercase;font-size: 13px;">
                <b>EN LA CAMA: </b><?=$sqlObs['cama_nombre']?>
            </div>
            <?php }?>
            <div style="position: absolute;margin-left: 50px;margin-top: 540px;width: 655px;text-transform: uppercase;font-size: 13px;">
                <?php 
                $sqlHojaFrontal=$this->config_mdl->sqlGetDataCondition('sigh_hojafrontal',array(
                    'ingreso_id'=>$info['ingreso_id']
                ),'hf_diagnosticos')[0];
                echo $sqlHojaFrontal['hf_diagnosticos']
                ?>
            </div>
            
            <div style="position: absolute;margin-left: 42px;margin-top: 668px;width: 110px;text-transform: uppercase;font-size: 8px;;text-align: center">
                <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?>
            </div>
            <div style="position: absolute;margin-left: 160px;margin-top: 672px;width: 110px;text-transform: uppercase;font-size: 8px;text-align: center">
                <?=$Medico['empleado_matricula']?>
            </div>
            
            <div style="position: absolute;margin-left: 400px;margin-top: 668px;width: 110px;text-transform: uppercase;font-size: 8px;text-align: center">
                <?=$Ts['empleado_nombre']?> <?=$Ts['empleado_ap']?> <?=$Ts['empleado_am']?>
            </div>
            <div style="position: absolute;margin-left: 525px;margin-top: 672px;width: 110px;text-transform: uppercase;font-size: 8px;text-align: center">
                <?=$Ts['empleado_matricula']?>
            </div>
        </div>   
        
    </page_header>
    <page_footer></page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle("DOCUMENTO DE AVISO AL MINISTERIO PÚBLICO");
    $pdf->Output('DOCUMENTO DE AVISO AL MINISTERIO PÚBLICO.pdf');
?>