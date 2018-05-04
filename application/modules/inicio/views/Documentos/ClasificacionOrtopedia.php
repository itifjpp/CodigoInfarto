<?php ob_start(); ?>
<page>
    <page_header>
       
        
    </page_header>
    <img src="assets/doc/ClasificacionOrt.jpg" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
        <div style="position: absolute;top: 25px;left: 60px;font-size: 10px;width: 83%;height: 10px;padding: 10px;text-transform: uppercase;background: black;color: white;border-radius: 5px;text-align: center;font-weight: bold">
            DESTINO: <?=$info[0]['triage_consultorio_nombre']?>
        </div>
        <div style="position: absolute;top: 70px;left: 60px;font-size: 10px;width: 83%;height: 10px;padding: 10px;text-transform: uppercase;border:1px solid black">
            <b>DIAGNOSTICO: </b><?=$AdmisionContinua['ac_diagnostico']?>
        </div>
        <div style="position: absolute;top: 239px;left: 200px;font-size: 10px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></div>
        <div style="position: absolute;top: 237px;left: 440px;font-size: 10px"><?=  explode('-', $info[0]['triage_fecha_clasifica'])[2]?></div>
        <div style="position: absolute;top: 237px;left: 490px;font-size: 10px"><?=  explode('-', $info[0]['triage_fecha_clasifica'])[1]?></div>
        <div style="position: absolute;top: 237px;left: 530px;font-size: 10px"><?=  explode('-', $info[0]['triage_fecha_clasifica'])[0]?></div>
        <div style="position: absolute;top: 237px;left: 625px;font-size: 10px"><?=  explode(':', $info[0]['triage_hora_clasifica'])[0]?></div>
        <div style="position: absolute;top: 237px;left: 650px;font-size: 10px"><?=  explode(':', $info[0]['triage_hora_clasifica'])[1]?></div>
        <!---Seccion 2-->
        <div style="position: absolute;top: 260px;left: 115px;font-size: 10px"><?=$info[0]['triage_nombre_ap']?> <?=$info[0]['triage_nombre_am']?> <?=$info[0]['triage_nombre']?></div>
        <!---Seccion 3-->
        <?php if($_GET['via']=='Choque'){?>
        <div style="position: absolute;top: 304px;left: 145px;font-size: 10px"><?=  explode('/', $class_choque[0]['sv_ta'])[0]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=  explode('/', $class_choque[0]['sv_ta'])[1]?></div> 
        <div style="position: absolute;top: 304px;left: 280px;font-size: 10px"><?=$class_choque[0]['sv_temp']?></div>
        <div style="position: absolute;top: 304px;left: 455px;font-size: 10px"><?=$class_choque[0]['sv_fc']?></div>
        <div style="position: absolute;top: 304px;left: 630px;font-size: 10px"><?=$class_choque[0]['sv_fr']?></div>
        <?php }else{?>
        <div style="position: absolute;top: 304px;left: 145px;font-size: 10px"><?=  explode('/', $SignosVitales['sv_ta'])[0]?>&nbsp;&nbsp;&nbsp;&nbsp;<?=  explode('/', $SignosVitales['sv_ta'])[1]?></div> 
        <div style="position: absolute;top: 304px;left: 280px;font-size: 10px"><?=$SignosVitales['sv_temp']?></div>
        <div style="position: absolute;top: 304px;left: 455px;font-size: 10px"><?=$SignosVitales['sv_fc']?></div>
        <div style="position: absolute;top: 304px;left: 630px;font-size: 10px"><?=$SignosVitales['sv_fr']?></div>
        <?php }?>
        <!--Seccion 4 Pregunta 1-->
        <div style="position: absolute;top: 370px;left: 370px;font-size: 10px"><?php if($clasificacion[0]['triage_preg1_s1']==0){echo 'X';}?></div>
        <div style="position: absolute;top: 370px;left: 570px;font-size: 10px"><?php if($info[0]['triage_preg1_s1']!=0){echo 'X';}?></div>
        <!--Seccion 4 Pregunta 2-->
        <div style="position: absolute;top: 385px;left: 370px;font-size: 10px"><?php if($clasificacion[0]['triage_preg2_s1']==0){echo 'X';}?></div>
        <div style="position: absolute;top: 385px;left: 570px;font-size: 10px"><?php if($clasificacion[0]['triage_preg2_s1']!=0){echo 'X';}?></div>
        <!--Seccion 4 Pregunta 3-->
        <div style="position: absolute;top: 400px;left: 370px;font-size: 10px"><?php if($clasificacion[0]['triage_preg3_s1']==0){echo 'X';}?></div>
        <div style="position: absolute;top: 400px;left: 570px;font-size: 10px"><?php if($clasificacion[0]['triage_preg3_s1']!=0){echo 'X';}?></div>
        <!--Seccion 4 Pregunta 4-->
        <div style="position: absolute;top: 415px;left: 370px;font-size: 10px"><?php if($clasificacion[0]['triage_preg4_s1']==0){echo 'X';}?></div>
        <div style="position: absolute;top: 415px;left: 570px;font-size: 10px"><?php if($clasificacion[0]['triage_preg4_s1']!=0){echo 'X';}?></div>
        <!--Seccion 4 Pregunta 5-->
        <div style="position: absolute;top: 430px;left: 370px;font-size: 10px"><?php if($clasificacion[0]['triage_preg5_s1']==0){echo 'X';}?></div>
        <div style="position: absolute;top: 430px;left: 570px;font-size: 10px"><?php if($clasificacion[0]['triage_preg5_s1']!=0){echo 'X';}?></div>
        <!--Seccion 4 Total-->
        <div style="position: absolute;top: 443px;left: 580px;font-size: 10px"><?=$clasificacion[0]['triege_preg_puntaje_s1']?></div>
        <!--Seccion 5 Pregunta 1-->
        <div style="position: absolute;top: 505px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg1_s2']?></div>
        <!--Seccion 5 Pregunta 2-->
        <div style="position: absolute;top: 518px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg2_s2']?></div>
        <!--Seccion 5 Pregunta 3-->
        <div style="position: absolute;top: 536px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg3_s2']?></div>
        <!--Seccion 5 Pregunta 4-->
        <div style="position: absolute;top: 550px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg4_s2']?></div>
        <!--Seccion 5 Pregunta 5-->
        <div style="position: absolute;top: 563px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg5_s2']?></div>
        <!--Seccion 5 Pregunta 6-->
        <div style="position: absolute;top: 574px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg6_s2']?></div>
        <!--Seccion 5 Pregunta 7-->
        <div style="position: absolute;top: 590px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg7_s2']?></div>
        <!--Seccion 5 Pregunta 8-->
        <div style="position: absolute;top: 605px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg8_s2']?></div>
        <!--Seccion 5 Pregunta 9-->
        <div style="position: absolute;top: 619px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg9_s2']?></div>
        <!--Seccion 5 Pregunta 10-->
        <div style="position: absolute;top: 630px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg10_s2']?></div>
        <!--Seccion 5 Pregunta 11-->
        <div style="position: absolute;top: 648px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg11_s2']?></div>
        <!--Seccion 5 Pregunta 12-->
        <div style="position: absolute;top: 667px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg12_s2']?></div>
        <!--Seccion 5 Total-->
        <div style="position: absolute;top: 680px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triege_preg_puntaje_s2']?></div>
        <!--Seccion 6 Pregunta l-->
        <div style="position: absolute;top: 730px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg1_s3']?></div>
        <!--Seccion 6 Pregunta 2-->
        <div style="position: absolute;top: 740px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg2_s3']?></div>
        <!--Seccion 6 Pregunta 3-->
        <div style="position: absolute;top: 753px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg3_s3']?></div>
        <!--Seccion 6 Pregunta 4-->
        <div style="position: absolute;top: 765px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg4_s3']?></div>
        <!--Seccion 6 Pregunta 4-->
        <div style="position: absolute;top: 776px;left: 630px;font-size: 10px"><?=$clasificacion[0]['triage_preg5_s3']?></div>
        <!--Seccion 6 Total Final-->
        <div style="position: absolute;top: 790px;left: 627px;font-size: 10px"><?=$clasificacion[0]['triage_puntaje_total']?></div>
        <div style="position: absolute;top: 893px;left: 95px;font-size:9px;width: 140px;text-align: center" >
            <?=$medico[0]['empleado_nombre']?> <?=$medico[0]['empleado_am']?> <?=$medico[0]['empleado_am']?>
        </div>
        <div style="position: absolute;top: 893px;left: 310px;font-size:9px;width:126px;text-align: center">
            <?=$medico[0]['empleado_matricula']?>
        </div>
        <div style="position: absolute;left: 280px;top: 980px">
            <barcode type="C128A" value="<?=$info[0]['triage_id']?>" style="height: 20px;" ></barcode>
        </div>
        <page_footer>
            
            <?php 
            if($clasificacion[0]['triage_puntaje_total']>30){
                $color='#E50914';
                $color_name='Rojo';
                $tiempo='Inmediatamente';
            }if($clasificacion[0]['triage_puntaje_total']>=21 && $clasificacion[0]['triage_puntaje_total']<=30){
                $color='#FF7028';
                $color_name='Naranja';
                $tiempo='10 Minutos';
            }if($clasificacion[0]['triage_puntaje_total']>=11 && $clasificacion[0]['triage_puntaje_total']<=20){
                $color='#FDE910';
                $color_name='Amarillo';
                $tiempo='11-60 Minutos';
            }if($clasificacion[0]['triage_puntaje_total']>=6 && $clasificacion[0]['triage_puntaje_total']<=10){
                $color='#4CBB17';
                $color_name='Verde';
                $tiempo='61-120 Minutos';
            }if($clasificacion[0]['triage_puntaje_total']<=5){
                $color='#0000FF';
                $color_name='Azul';
                $tiempo='121-240 Minutos';
            }
            
            ?> 
            <div style="height: 15px;width: 85%;background: black;margin: auto;color: white;text-align: center;padding: 10px;border-radius: 5px;font-weight: bold;text-transform: uppercase">
                Puntaje Total:<?=$clasificacion[0]['triage_puntaje_total']?> | Color : <?=$color_name?> <?=$tiempo?>
            </div>
        </page_footer>
</page>
<?php if(isset($_GET['sol'])){?>
<page backtop="72mm" backbottom="50mm" backleft="12" backright="12mm">
    <page_header>
        <img src="<?=  base_url()?>assets/doc/SolicitudRxMt.jpg" style="position: absolute;width: 805px;margin-top: -30px;margin-left: -10px;">
        <div style="position: absolute;margin-top: 15px">
            <div style="position: absolute;margin-left: 437px;margin-top: 15px;width: 270px;text-transform: uppercase;font-size: 21px;">
                <b><?=$info[0]['triage_nombre']?> <?=$info[0]['triage_nombre_ap']?> <?=$info[0]['triage_nombre_am']?></b>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 65px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>N.S.S:</b> <?=$PINFO['pum_nss']?> <?=$PINFO['pum_nss_agregado']?>
            </div>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info[0]['triage_fecha_nac'])); ?>
            <div style="position: absolute;margin-left: 437px;margin-top: 79px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>EDAD:</b> <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 92px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>SEXO:</b> <?=$info[0]['triage_paciente_sexo']?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 105px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>MÉDICO:</b> <?=$medico[0]['empleado_nombre']?> <?=$medico[0]['empleado_ap']?> <?=$medico[0]['empleado_am']?>
            </div>
            <div style="position: absolute;margin-left: 420px;margin-top: 130px">
                <barcode type="C128A" value="<?=$info[0]['triage_id']?>" style="height: 40px;" ></barcode>
            </div>
        </div>
            <?php 
                $sqlSolicitudesRx=$this->config_mdl->sqlGetDataCondition('um_rx_solicitudes',array(
                    'solicitud_id'=>$_GET['sol']
                ));
                ?>
        <div style="position: absolute;left: 50px;margin-top: 248px;font-size: 12px;text-align: center;text-transform: uppercase">
            <b>FECHA:</b> <?=$sqlSolicitudesRx[0]['solicitud_fecha']?>
        </div>
        <div style="position: absolute;width: 510px;left: 193px;margin-top: 500px;font-size: 8px;text-align: center;text-transform: uppercase">
            <?=$medico[0]['empleado_nombre']?> <?=$medico[0]['empleado_ap']?> <?=$medico[0]['empleado_am']?> <?=$medico[0]['empleado_matricula']?> 
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
            $sqlEstudios=$this->config_mdl->sqlQuery("SELECT solicitud_fecha,solicitud_hora,ra_nombre,estudio_nombre FROM um_rx_solicitudes_estudios, um_rx_solicitudes, um_rx_ra, um_rx_ra_estudios
                                                WHERE 
                                                um_rx_solicitudes_estudios.solicitud_id=um_rx_solicitudes.solicitud_id AND
                                                um_rx_solicitudes_estudios.estudio_id=um_rx_ra_estudios.estudio_id AND
                                                um_rx_ra_estudios.ra_id=um_rx_ra.ra_id AND um_rx_solicitudes.solicitud_id=".$_GET['sol']);
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
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>