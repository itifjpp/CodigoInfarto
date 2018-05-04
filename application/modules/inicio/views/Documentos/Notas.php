<?php 
    ob_start(); 
    $sqlMedico=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
        'empleado_id'=>$Nota['empleado_id']
    ))[0];
    $NombreMedico=$Medico['empleado_nombre'].' '.$Medico['empleado_ap'] .' '.$Medico['empleado_am'];
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
            <div style="position: absolute;margin-left: 437px;margin-top: 105px;width: 270px;text-transform: uppercase;font-size: 21px;line-height: 1.2">
                <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 170px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>R.F.C:</b> <?=$info['paciente_rfc']?>
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
                    <?php if($info['info_am']!=''){ ?>
                    <b>AM:</b> <?=$AsistenteMedica['empleado_nombre']?> <?=$AsistenteMedica['empleado_ap']?> <?=$AsistenteMedica['empleado_am']?>
                    <?php } ?>
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
                } else if($info['ingreso_en']=='Choque'){
                    $sqlChoque=$this->config_mdl->sqlGetDataCondition('sigh_choque',array(
                        'ingreso_id'=>$info['ingreso_id']
                    ),'cama_id');
                    echo $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
                        'cama_id'=>$sqlChoque[0]['cama_id']
                    ),'cama_nombre')[0]['cama_nombre'];
                }else if($info['ingreso_en']=='Observación'){
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
                <?=$Nota['notas_fecha']?> <?=$Nota['notas_hora']?><br><br><br>
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
            
            <?php if($Nota['notas_medico_autoriza']==''){?>
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
            if($Nota['notas_medico_autoriza']==$Nota['notas_medico_superviso']){
                $sqlM1=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$Nota['notas_medico_supervisa']
                ))[0];
                $MedicoSupervisa=$sqlM1['empleado_nombre'].' '.$sqlM1['empleado_ap'].' '.$sqlM1['empleado_am'].'<br>'.$sqlM1['empleado_matricula'];
                $MedicoAutorizo=$sqlM1['empleado_nombre'].' '.$sqlM1['empleado_ap'].' '.$sqlM1['empleado_am'].'<br>'.$sqlM1['empleado_matricula'];
            }else{
                $sqlM1=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$Nota['notas_medico_supervisa']
                ))[0];
                $sqlM2=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                    'empleado_id'=>$Nota['notas_medico_autoriza']
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
            <?php if($Nota['notas_medico_supervisa']!=''){?>
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
            <div style="position: absolute;top: 258px;;width: 500px;;left: 205px;font-size: 12px;text-transform: uppercase;text-align: center;font-weight: bold">
                <?=$Nota['notas_tipo']?>
            </div>
        </div>   
        
    </page_header>
    
    <span style="text-align: justify;width: 100%">
        <br>
        <?=$Nota['nota_nota']?>
        <?php if($Nota['nota_diagnostico']!=''):?>
        <br><br><br>
        <b>DIAGNÓSTICOS</b><br><br>
        <?=$Nota['nota_diagnostico']?><br>
        <table class="table" style="width: 100%;margin-top: 10px">
            <tbody>
                <?php foreach ($Dxs as $value) {?>
                <tr>
                    <td style="width: 100%;text-transform: uppercase;line-height: 1.4">
                        <span<b>TIPO:</b> <?=$value['dx_tipo']?><br>
                        <b>DX: </b><?=$value['dx_dx']?><br>
                        <b>CIE10: </b> <?=$value['id10']?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php endif;?>
        <?php 
        $sqlAnexos=$this->config_mdl->sqlGetDataCondition('sigh_notas_anexos',array(
            'notas_id'=>$Nota['notas_id']
        ));
        foreach ($sqlAnexos as $value) {
        ?>
        <img src="assets/NotasAnexos/<?=$value['anexo_img']?>" style="width: 100%">
        <?php }?>
    </span>
    <page_footer>
        
    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','en',true,'UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle($Nota['notas_tipo']);
    $pdf->Output($Nota['notas_tipo'].'.pdf');
?>