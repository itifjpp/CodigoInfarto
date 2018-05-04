<?php 
    ob_start(); 
    $sqlMedico=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
        'empleado_id'=>$Hoja['empleado_id']
    ))[0];
    $NombreMedico=$Medico['empleado_nombre'].' '.$Medico['empleado_ap'].' '.$Medico['empleado_am'];
    $MatriculaMedico=$Medico['empleado_matricula'];
?>
<page backtop="60mm" backbottom="60mm" backleft="58" backright="15mm">
    <page_header>
        <img src="assets/doc/sigh_430128.png" style="position: absolute;width: 805px;margin-top: 0px;margin-left: -10px;">
        <div style="width: 300px;margin-top: 45px;margin-left: 40px;position: absolute;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        
                    </td>
                    <td style="width: 10%;text-align: right">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 10px;margin-bottom: 0px;text-align: center">NOTAS MÉDICAS Y PRESCRIPCIONES</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute;margin-top: -50px">
            <div style="position: absolute;margin-left: 437px;margin-top: 105px;width: 270px;text-transform: uppercase;font-size: 21px;">
                <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 170px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>N.S.S:</b> <?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?>
            </div>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn'])); ?>
            <div style="position: absolute;margin-left: 437px;margin-top: 184px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>EDAD:</b> <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 198px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>SEXO:</b> <?=$info['paciente_sexo']?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 213px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -1px">
                    <b>MÉD.:</b> <?=$NombreMedico?>
                </p>
                <p style="margin-top: -9px">
                    <b>AM:</b> <?=$AsistenteMedica['empleado_nombre']?> <?=$AsistenteMedica['empleado_ap']?> <?=$AsistenteMedica['empleado_am']?>
                </p>
            </div>
            <div style="position: absolute;margin-top:222px;margin-left: 134px ">
                <?php 
                if($info['ingreso_en']=='Pisos'){
                    $sqlPisos=$this->config_mdl->sqlGetDataCondition('sigh_areas_pacientes',array(
                        'ingreso_id'=>$info['ingreso_id']
                    ),'cama_id');
                    echo $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
                        'cama_id'=>$sqlPisos[0]['cama_id']
                    ),'cama_nombre')[0]['cama_nombre'];
                }if($info['ingreso_en']=='Choque'){
                    $sqlChoque=$this->config_mdl->sqlGetDataCondition('sigh_choque',array(
                        'ingreso_id'=>$info['ingreso_id']
                    ),'cama_id');
                    echo $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
                        'cama_id'=>$sqlChoque[0]['cama_id']
                    ),'cama_nombre')[0]['cama_nombre'];
                }if($info['ingreso_en']=='Observación'){
                    $sqlObs=$this->config_mdl->sqlGetDataCondition('sigh_observacion',array(
                        'ingreso_id'=>$info['ingreso_id']
                    ),'observacion_cama');
                    echo $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
                        'cama_id'=>$sqlObs[0]['observacion_cama']
                    ),'cama_nombre')[0]['cama_nombre'];
                }else{
                    echo 'SIN ESPECIFICAR';
                }
                
                ?>
            </div>
            <div style="position: absolute;margin-top:222px;margin-left: 382px ">:[[page_cu]]/[[page_nb]]</div>
            
            <div style="position: absolute;text-align: center;margin-left: 60px;margin-top: 290px;width: 140px;text-transform: uppercase;font-size: 12px;">
                <?=$Hoja['ha_fecha']?> <?=$Hoja['ha_hora']?><br><br><br>
            </div>
            <div style="position: absolute;margin-left: 66px;margin-top: 320px;width: 130px;font-size: 12px;text-align: center">
                <?php 
                if($SignosVitalesNotas['sv_ta']!='' || $SignosVitalesNotas['sv_temp']!=''){
                    $sv_ta=$SignosVitalesNotas['sv_ta'];
                    $sv_temp=$SignosVitalesNotas['sv_temp'];
                    $sv_fc=$SignosVitalesNotas['sv_fc'];
                    $sv_fr=$SignosVitalesNotas['sv_fr'];
                }else{
                    $sv_ta=$SignosVitalesTriage['sv_ta'];
                    $sv_temp=$SignosVitalesTriage['sv_temp'];
                    $sv_fc=$SignosVitalesTriage['sv_fc'];
                    $sv_fr=$SignosVitalesTriage['sv_fr'];
                }
                ?>
                <h4>Tensión Arterial</h4>
                <h1 style="margin-top: -10px;font-size: 20px"><?=$sv_ta?></h1>
                <h4>Temperatura</h4>
                <h1 style="margin-top: -10px;font-size: 20px"><?=$sv_temp?> °C</h1>
                <h4>Frecuencia Cardiaca</h4>
                <h1 style="margin-top: -10px;font-size: 20px"><?=$sv_fc?> X Min</h1>
                <h4>Frecuencia Respiratoria</h4>
                <h1 style="margin-top: -10px;font-size: 20px"><?=$sv_fr?> X Min</h1>
            </div>
            <div style="rotate: 90; position: absolute;margin-left: 50px;margin-top: 336px;text-transform: uppercase;font-size: 12px;">
                <?php $sqlEmpleadoSV=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$SignosVitales['empleado_id']
                ),'empleado_nombre,empleado_ap,empleado_am')[0];?>
                <?php $sqlEmpleadoSV['empleado_nombre']?> <?php $sqlEmpleadoSV['empleado_ap']?> <?php $sqlEmpleadoSV['empleado_am']?> <?php $SignosVitales['sv_fecha']?> <?php $SignosVitales['sv_hora']?><br><br><br>
            </div>
            
            
            <?php if($Hoja['ha_medico_autoriza']=='' || $Hoja['ha_medico_autoriza']==0){?>
            <div style="position: absolute;top: 910px;left: 215px;width: 240px;font-size: 9px;text-align: center">
                <?=$NombreMedico?><br>
                <span style="margin-top: -6px;margin-bottom: -8px">____________________________________</span><br>
                <b>NOMBRE DEL MÉDICO TRATANTE</b>
            </div>
            <div style="position: absolute;top: 910px;left: 480px;width: 110px;font-size: 9px;text-align: center">
                <?=$MatriculaMedico?> <br>
                <span style="margin-top: -6px;margin-bottom: -8px">_________________</span><br>
                <b>MATRICULA</b>
            </div>
            <div style="position: absolute;top: 910px;left: 590px;width: 110px;font-size: 9px;text-align: center">
                <br>
                <span style="margin-top: -6px;margin-bottom: -8px">_________________</span><br>
                <b>FIRMA</b>
            </div>
            <?php }else{
            $MedicoSupervisa='';
            $MedicoAutorizo='';
            if($Hoja['ha_medico_autoriza']==$Hoja['ha_medico_supervisa']){
                $sqlM1=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$Hoja['ha_medico_superviso']
                ))[0];
                $MedicoSupervisa=$sqlM1['empleado_nombre'].' '.$sqlM1['empleado_ap'].' '.$sqlM1['empleado_am'].'<br>'.$sqlM1['empleado_matricula'];
                $MedicoAutorizo=$sqlM1['empleado_nombre'].' '.$sqlM1['empleado_ap'].' '.$sqlM1['empleado_am'].'<br>'.$sqlM1['empleado_matricula'];
            }else{
                $sqlM1=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$Hoja['ha_medico_supervisa']
                ))[0];
                $sqlM2=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$Hoja['ha_medico_autoriza']
                ))[0];
                $MedicoSupervisa=$sqlM1['empleado_nombre'].' '.$sqlM1['empleado_ap'].' '.$sqlM1['empleado_am'].'<br>'.$sqlM1['empleado_matricula'];
                $MedicoAutorizo=$sqlM2['empleado_nombre'].' '.$sqlM2['empleado_ap'].' '.$sqlM2['empleado_am'].'<br>'.$sqlM2['empleado_matricula'];
            }
                
            ?>
            <div style="position: absolute;top: 905px;left: 200px;width: 200px;font-size: 7.5px;text-align: center">
                <?=$NombreMedico?><br><?=$MatriculaMedico?><br>
                <span style="margin-top: -6px;margin-bottom: -8px">____________________________________</span><br>
                <b>NOMBRE DEL MÉDICO RESIDENTE</b>
            </div>
            <?php if($Hoja['ha_medico_supervisa']!=''){?>
            <div style="position: absolute;top: 905px;left: 360px;width: 200px;font-size: 7.5px;text-align: center">
                <?=$MedicoSupervisa?><br>
                <span style="margin-top: -6px;margin-bottom: -8px">____________________________________</span><br>
                <b>NOMBRE DEL MÉDICO QUE SUPERVISA</b>
            </div>
            <?php }?>
            <div style="position: absolute;top: 905px;left: 520px;width: 200px;font-size: 7.5px;text-align: center">
                <?=$MedicoAutorizo?><br>
                <span style="margin-top: -6px;margin-bottom: -8px">____________________________________</span><br>
                <b>NOMBRE DEL MÉDICO QUE AUTORIZÓ</b>
            </div>
            <?php }?>
            <div style="margin-left: 280px;margin-top: 980px">
                <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
            </div>
            <div style="position: absolute;top: 262px;;width: 500px;;left: 205px;font-size: 12px;text-transform: uppercase;text-align: center;font-weight: bold">
                HOJA DE ALTA HOSPITALARIA
            </div>
        </div>   
        
    </page_header>
    <style>
        .table, .table td, .table th {    
            font-size: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th, .table td {
            padding: 5px;
        }
    </style>
    <span style="text-align: justify">
        <table style="width: 100%;margin-left: -1px;font-size: 15px">
            <tr>
                <td style="width:45%"><b>INGRESO:</b> <?=$Hoja['ha_fecha_ingreso']?></td>
                <td style="width:50%;"><b>EGRESO:</b> <?=$Hoja['ha_fecha_hora_eg']?></td>
            </tr>
            <tr>
                <td colspan="2"><b>TOTAL DE DIAS EN ESTANCIA:</b><?=$Hoja['ha_total_dias_estancia']?></td>
            </tr>
        </table>
        <h4 style="font-weight: normal;text-align: left;margin-top: 3px;;font-size: 15px"><b>MOTIVO DE EGRESO:</b><?=$Hoja['ha_motivo_egreso']?></h4>
        <h4 style="font-weight: normal;margin-top: -11px;text-align: left;font-size: 15px"><b>ENVÍO A:</b><?=$Hoja['ha_envio']?></h4>
        <?php 
        $sqlDx=$this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria_dx',array(
            'ha_id'=>$Hoja['ha_id']
        ));
        if(!empty($sqlDx)){?>
       
        <h4 style="text-align: center;font-size: 15px"><b>DIAGNOSTICOS</b></h4>
        <table style="width: 100%" class="table">
            <thead>
                <tr>
                    <th>TIPO</th>
                    <th>CODIFICACIÓN</th>
                    <th>DIAGNOSTICO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sqlDx as $value) {?>
                <tr>
                    <td style="width: 25%"><?=$value['dx_tipo']?></td>
                    <td style="width: 15%"><?=$value['dx_codificacion']?></td>
                    <td style="width: 58%"><?=$value['dx_']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php }?>
        <?php 
        $sqlPro=$this->config_mdl->sqlGetDataCondition('doc_ha_hospitalaria_pro',array(
            'ha_id'=>$Hoja['ha_id']
        ));
        if(!empty($sqlPro)){?>
       
        <h4 style="text-align: center;font-size: 15px"><b>PROCEDIMIENTOS</b></h4>
        <table style="width: 100%" class="table">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>CODIFICACIÓN</th>
                    <th>PROCEDIMIENTO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sqlPro as $value) {?>
                <tr>
                    <td style="width: 25%"><?=$value['pro_fecha']?></td>
                    <td style="width: 15%"><?=$value['pro_codificacion']?></td>
                    <td style="width: 58%"><?=$value['pro_codificacion']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php }?>
        <br>
        <?php if($Hoja['ha_motivo_egreso']=='DEFUNCIÓN'){?>
        
        <h4 style="font-weight: normal;margin-top: 5px;text-align: left;text-transform: uppercase;font-size: 15px"><b>EGRESO POR DEFUNCIÓN</b></h4>
        <ul style="margin-top: -20px;font-size: 10px">
            <li>
                <b>DIAGNOSTICO PRIMARIO: </b><?=$Hoja['ha_egreso_df_dx1']?>
            </li>
            <li style="margin-top: 0px">
                <b>DIAGNOSTICO SECUNDARIO: </b><?=$Hoja['ha_egreso_df_dx2']?>
            </li>
        </ul>
        
        
        <h5 style="font-weight: normal;margin-top: 0px;text-align: left;text-transform: uppercase;font-size: 15px"><b>AUTOPSIA: </b><?=$Hoja['ha_egreso_df_autopsia']?></h5>
        <?php }?>
        <h5 style="font-weight: normal;margin-top: -11px;text-align: left;text-transform: uppercase;font-size: 15px"><b>RAMO DE SEGURO: </b><?=$Hoja['ha_ramo_seguro']?></h5>
        <h5 style="font-weight: normal;margin-top: -11px;text-align: left;text-transform: uppercase;font-size: 15px"><b>N° DE RECETAS: </b><?=$Hoja['ha_n_recetas']?></h5>
    </span>
    <page_footer>
        
    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','en',true,'UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('HOJA DE ALTA HOSPITALARIA');
    $pdf->Output('HOJA DE ALTA HOSPITALARIA.pdf');
?>