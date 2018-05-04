<?php ob_start(); ?>
<page>
    <page_header>
       <img src="assets/doc/sigh_clasificacion.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
       <div style="position: absolute;">
           <div style="width: 650px;margin-top: 55px;margin-left: 52px;">
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
                            <p style="text-transform: uppercase;font-size: 10px;font-weight: bold;margin-top: 8px;margin-bottom: 0px">CLASIFICACIÓN DE PACIENTES (TRIAGE)</p>
                        </td>
                        <td style="width: 10%;text-align: right">
                            <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 60px;"></qrcode>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="position: absolute;top: 10px;left: 43px;font-size: 10px;width: 645px;height: 10px;padding: 10px;text-transform: uppercase;background: black;color: white;border-radius: 5px;text-align: center;font-weight: bold">
                DESTINO: <?=$info['ingreso_destino_triage']?> - <?=$info['ingreso_consultorio_nombre']?>
            </div>
            <div style="position: absolute;top: 155px;left: 184px;font-size: 10px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></div>
            
            <div style="position: absolute;top: 155px;left: 440px;font-size: 10px"><?=  explode('-', $info['ingreso_date_medico'])[2]?></div>
            <div style="position: absolute;top: 155px;left: 490px;font-size: 10px"><?=  explode('-', $info['ingreso_date_medico'])[1]?></div>
            <div style="position: absolute;top: 155px;left: 530px;font-size: 10px"><?=  explode('-', $info['ingreso_date_medico'])[0]?></div>
            <div style="position: absolute;top: 155px;left: 635px;font-size: 10px"><?=  explode(':', $info['ingreso_time_medico'])[0]?></div>
            <div style="position: absolute;top: 155px;left: 655px;font-size: 10px"><?=  explode(':', $info['ingreso_time_medico'])[1]?></div>
            <!---Seccion 2-->
            <div style="position: absolute;top: 178px;left: 105px;font-size: 10px"><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?></div>
            <!---Seccion 3-->
            <?php if($_GET['via']=='Choque'){?>
            <div style="position: absolute;top: 225px;left: 130px;font-size: 10px"><?=$class_choque['sv_sistolica']?>/<?=$class_choque['sv_diastolica']?></div> 
            <div style="position: absolute;top: 225px;left: 280px;font-size: 10px"><?=$class_choque['sv_temp']?></div>
            <div style="position: absolute;top: 225px;left: 455px;font-size: 10px"><?=$class_choque['sv_fc']?></div>
            <div style="position: absolute;top: 225px;left: 630px;font-size: 10px"><?=$class_choque['sv_fr']?></div>
            <?php }else{?>
            <div style="position: absolute;top: 225px;left: 130px;font-size: 10px"><?=$SignosVitales['sv_sistolica']?>/<?=$SignosVitales['sv_diastolica']?></div> 
            <div style="position: absolute;top: 225px;left: 260px;font-size: 10px"><?=$SignosVitales['sv_temp']?> °C</div>
            <div style="position: absolute;top: 225px;left: 465px;font-size: 10px"><?=$SignosVitales['sv_fc']?></div>
            <div style="position: absolute;top: 225px;left: 645px;font-size: 10px"><?=$SignosVitales['sv_fr']?></div>
            <?php }?>
            <?php if($this->ConfigSolicitarOD=='Si'){?>
            <div style="position: absolute;top: 208px;left: 50px;font-size: 10px">
                <b>Oximetría:</b> <?=$SignosVitales['sv_oximetria']?>
            </div>
            <div style="position: absolute;top: 208px;left: 530px;font-size: 10px">
                <b>Dextrostix:</b> <?=$SignosVitales['sv_dextrostix']?>
            </div>
            <?php }?>
            <!--Seccion 4 Pregunta 1-->
            <div style="position: absolute;top: 292px;left: 370px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg1_s1']==0){echo 'X';}?></div>
            <div style="position: absolute;top: 292px;left: 570px;font-size: 10px"><?php if($info['clasificacion_preg1_s1']!=0){echo 'X';}?></div>
            <!--Seccion 4 Pregunta 2-->
            <div style="position: absolute;top: 310px;left: 370px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg2_s1']==0){echo 'X';}?></div>
            <div style="position: absolute;top: 310px;left: 570px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg2_s1']!=0){echo 'X';}?></div>
            <!--Seccion 4 Pregunta 3-->
            <div style="position: absolute;top: 326px;left: 370px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg3_s1']==0){echo 'X';}?></div>
            <div style="position: absolute;top: 326px;left: 570px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg3_s1']!=0){echo 'X';}?></div>
            <!--Seccion 4 Pregunta 4-->
            <div style="position: absolute;top: 340px;left: 370px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg4_s1']==0){echo 'X';}?></div>
            <div style="position: absolute;top: 340px;left: 570px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg4_s1']!=0){echo 'X';}?></div>
            <!--Seccion 4 Pregunta 5-->
            <div style="position: absolute;top: 355px;left: 370px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg5_s1']==0){echo 'X';}?></div>
            <div style="position: absolute;top: 355px;left: 570px;font-size: 10px"><?php if($Clasificacion['clasificacion_preg5_s1']!=0){echo 'X';}?></div>
            <!--Seccion 4 Total-->
            <div style="position: absolute;top: 370px;left: 595px;font-size: 10px"><?=$Clasificacion['clasificacion_preg_puntaje_s1']?></div>

            <!--Seccion 5 Pregunta 1-->
            <div style="position: absolute;top: 440px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg1_s2']?></div>
            <!--Seccion 5 Pregunta 2-->
            <div style="position: absolute;top: 453px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg2_s2']?></div>
            <!--Seccion 5 Pregunta 3-->
            <div style="position: absolute;top: 468px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg3_s2']?></div>
            <!--Seccion 5 Pregunta 4-->
            <div style="position: absolute;top: 486px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg4_s2']?></div>
            <!--Seccion 5 Pregunta 5-->
            <div style="position: absolute;top: 498px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg5_s2']?></div>
            <!--Seccion 5 Pregunta 6-->
            <div style="position: absolute;top: 510px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg6_s2']?></div>
            <!--Seccion 5 Pregunta 7-->
            <div style="position: absolute;top: 528px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg7_s2']?></div>
            <!--Seccion 5 Pregunta 8-->
            <div style="position: absolute;top: 545px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg8_s2']?></div>
            <!--Seccion 5 Pregunta 9-->
            <div style="position: absolute;top: 557px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg9_s2']?></div>
            <!--Seccion 5 Pregunta 10-->
            <div style="position: absolute;top: 575px;left: 648px;font-size: 10px"><?=$Clasificacion[0]['clasificacion_preg10_s2']?></div>
            <!--Seccion 5 Pregunta 11-->
            <div style="position: absolute;top: 590px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg11_s2']?></div>
            <!--Seccion 5 Pregunta 12-->
            <div style="position: absolute;top: 608px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg12_s2']?></div>
            <!--Seccion 5 Total-->
            <div style="position: absolute;top: 626px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg_puntaje_s2']?></div>

            <!--Seccion 6 Pregunta l-->
            <div style="position: absolute;top: 676px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg1_s3']?></div>
            <!--Seccion 6 Pregunta 2-->
            <div style="position: absolute;top: 690px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg2_s3']?></div>
            <!--Seccion 6 Pregunta 3-->
            <div style="position: absolute;top: 702px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg3_s3']?></div>
            <!--Seccion 6 Pregunta 4-->
            <div style="position: absolute;top: 714px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg4_s3']?></div>
            <!--Seccion 6 Pregunta 4-->
            <div style="position: absolute;top: 726px;left: 648px;font-size: 10px"><?=$Clasificacion['clasificacion_preg5_s3']?></div>
            <!--Seccion 6 Total Final-->
            <div style="position: absolute;top: 740px;left: 646px;font-size: 10px"><?=$Clasificacion['clasificacion_puntaje_total']?></div>
            
            
            <?php foreach ($ClasificacionSettings as $class) {?>
            <?php if($class['clasificacion_color']=='Rojo'){?>
            <div style="position: absolute;top: 780px;left: 110px;font-size: 9px;width: 95px;line-height: 1.4;text-align: center"><?=$class['clasificacion_descripcion']?><br><?=$class['clasificacion_tiempo']?></div>
            <?php } ?>
            <?php if($class['clasificacion_color']=='Naranja'){?>
            <div style="position: absolute;top: 780px;left: 210px;font-size: 9px;width: 120px;line-height: 1.4;text-align: center"><?=$class['clasificacion_descripcion']?><br><?=$class['clasificacion_tiempo']?></div>
            <?php } ?>
            <?php if($class['clasificacion_color']=='Amarillo'){?>
            <div style="position: absolute;top: 780px;left: 332px;font-size: 9px;width: 120px;line-height: 1.4;text-align: center"><?=$class['clasificacion_descripcion']?><br><?=$class['clasificacion_tiempo']?></div>
            <?php } ?>
            <?php if($class['clasificacion_color']=='Verde'){?>
            <div style="position: absolute;top: 780px;left: 456px;font-size: 9px;width: 106px;line-height: 1.4;text-align: center"><?=$class['clasificacion_descripcion']?><br><?=$class['clasificacion_tiempo']?></div>
            <?php } ?>
            <?php if($class['clasificacion_color']=='Azul'){?>
            <div style="position: absolute;top: 780px;left: 568px;font-size: 9px;width: 130px;line-height: 1.4;text-align: center"><?=$class['clasificacion_descripcion']?><br><?=$class['clasificacion_tiempo']?></div>
            <?php } ?>
            
            <?php }?>
            
            
            
            
            
            
            
            <div style="position: absolute;top: 848px;left: 60px;font-size:9px;width: 200px;text-align: center;">
                <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?>
            </div>
            <div style="position: absolute;top: 848px;left: 280px;font-size:9px;width:200px;text-align: center;">
                <?=$Medico['empleado_matricula']?>
            </div>
            <?php if($Clasificacion['clasificacion_observacion']!=''){?>
            <div style="width: 660px;margin: auto;font-size: 11px;top: 905px;padding: 0px;position: absolute;left: 43px;padding: 0px;text-align: justify">
                <b>Observaciones: </b><?=$Clasificacion['clasificacion_observacion']?>
            </div>
            <?php }?>
            <div style="position: absolute;left: 280px;top: 970px">
                <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
            </div>
        </div> 
    </page_header>
    <page_footer>

        <?php 
        $sqlGetClass=$this->config_mdl->sqlGetDataCondition('sigh_clasificacion_settings',array(
            'clasificacion_color'=>$Clasificacion['clasificacion_color']
        ))[0];
        ?>
        
        <div style="height: 15px;width: 645px;background: black;margin: auto;color: white;text-align: center;padding: 10px;border-radius: 5px;font-weight: bold;text-transform: uppercase">
            <?php if($Clasificacion['clasificacion_omision']=='No'){ ?>PUNTAJE TOTAL:<?=$Clasificacion['clasificacion_puntaje_total']?> | <?php }?>COLOR : <?=$sqlGetClass['clasificacion_color']?> <?=$sqlGetClass['clasificacion_tiempo']?>
        </div>
    </page_footer>
</page>
<?php if(isset($_GET['sol'])){?>
<page backtop="72mm" backbottom="50mm" backleft="12" backright="12mm">
    <page_header>
        <img src="<?=  base_url()?>assets/doc/sigh_rx.jpg" style="position: absolute;width: 805px;margin-top: -30px;margin-left: -10px;">
        <div style="width: 340px;margin-top: 17px;margin-left: 40px;position: absolute;">
            <table >
                <tr>
                    <td style="width: 10%">
                        <img src="<?= base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
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
                <b><?=$info['paciente_ap']?> <?=$info['paciente_ap']?> <?=$info['paciente_nombre']?></b>
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
            <?php 
                $sqlSolicitudesRx=$this->config_mdl->sqlGetDataCondition('sigh_rx_solicitudes',array(
                    'solicitud_id'=>$_GET['sol']
                ));
                ?>
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
<?php }?>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('CLASIFICACIÓN DE PACIENTES');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>