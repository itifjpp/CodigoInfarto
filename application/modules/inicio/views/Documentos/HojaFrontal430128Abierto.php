<?php ob_start(); ?>
<page backtop="80mm" backbottom="50mm" backleft="56" backright="15mm">
    <page_header>
        <style>
            table, td, th {text-align: left;}
            table {border-collapse: collapse;width: 100%;}
            th, td {padding: 5px;}
        </style>
        <img src="assets/doc/DOC430128_HF.png" style="position: absolute;width: 805px;margin-top: 0px;margin-left: -10px;">
        <div style="position: absolute;margin-top: 15px">
            <div style="position: absolute;top: 80px;left: 120px;width: 270px;">
                <b><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></b>
            </div>
            <div style="position: absolute;margin-left: 435px;margin-top: 105px;width: 270px;text-transform: uppercase;font-size: 20px;text-align: left;">
                <b><?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?></b>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 150px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>N.S.S:</b> <?=$PINFO['pum_nss']?> <?=$PINFO['pum_nss_agregado']?>
            </div>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['triage_fecha_nac'])); ?>
            <div style="position: absolute;margin-left: 437px;margin-top: 166px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -2px">
                    <b>EDAD:</b> <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
                </p>
                <p style="margin-top: -10px">
                    <b>UMF:</b> <?=$PINFO['pum_umf']?>
                </p>
                <p style="margin-top: -10px">
                    <b><?=$hoja['hf_atencion']?></b> 
                </p>
                
            </div>
            <div style="position: absolute;margin-left: 540px;margin-top: 166px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -2px">
                    <b>FOLIO:</b> <?=$info['triage_id']?>
                </p>
                <p style="margin-top: -10px">
                    <b>PROCEDE:</b> <?=$PINFO['pia_procedencia_espontanea']=='Si' ? 'ESPONTANEO' : 'REFERENCIADO'?>
                </p>
                <p style="margin-top: -10px">
                    <b>HORA CERO:</b> <?=$info['triage_horacero_f']?> <?=$info['triage_horacero_h']?>
                </p>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 205px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -1px">
                    <b>MÉD.:</b> <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?> <?=$Medico['empleado_matricula']?>
                </p>
                <p style="margin-top: -9px">
                    <b>AM:</b> <?=$AsistenteMedica['empleado_nombre']?> <?=$AsistenteMedica['empleado_ap']?> <?=$AsistenteMedica['empleado_am']?>
                </p>
                <p style="margin-top: -11px">
                    <b>HORA A.M:</b> <?=$am['asistentesmedicas_fecha']?> <?=$am['asistentesmedicas_hora']?>
                </p>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 263px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>HOJA INICIAL</b>
            </div>
            
            <div style="position: absolute;margin-top:229px;margin-left: 134px ">
                <?php 
                $sqlChoque=$this->config_mdl->_get_data_condition('os_choque_v2',array(
                    'triage_id'=>$info['triage_id']
                ));
                $sqlObs=$this->config_mdl->_get_data_condition('os_observacion',array(
                    'triage_id'=>$info['triage_id']
                ));
                if(empty($sqlChoque)){
                    echo $this->config_mdl->_get_data_condition('os_camas',array(
                        'cama_id'=>$sqlObs[0]['observacion_cama']
                    ))[0]['cama_nombre'];
                }else{
                    echo $this->config_mdl->_get_data_condition('os_camas',array(
                        'cama_id'=>$sqlChoque[0]['cama_id']
                    ))[0]['cama_nombre'];
                }
                ?>
            </div>
            <div style="position: absolute;margin-top:228px;margin-left: 44px;text-transform: uppercase ">
                <b>CLASIFICACIÓN:</b> <?=$info['triage_color']?>
            </div>
            <div style="position: absolute;margin-top:228px;margin-left: 382px ">:[[page_cu]]/[[page_nb]]</div>
            
            <div style="position: absolute;margin-left: 50px;margin-top: 276px;width: 150px;font-size: 7px;text-align: center;">
                <h6><b>FECHA DE CREACIÓN DOCUMENTO MÉDICO:</b> <?=$hoja['hf_fg']?> <?=$hoja['hf_hg']?></h6>
            </div>
            <div style="position: absolute;margin-left: 66px;margin-top: 320px;width: 130px;font-size: 12px;text-align: center">
                
                <h4>Tensión Arterial</h4>
                <h2 style="margin-top: -10px"><?=$SignosVitales['sv_ta']?></h2>
                <br><br>
                <h4>Temperatura</h4>
                <h2 style="margin-top: -10px"><?=$SignosVitales['sv_temp']?> °C</h2>
                <br><br>
                <h4>Frecuencia Cardiaca</h4>
                <h2 style="margin-top: -10px"><?=$SignosVitales['sv_fc']?> X Min</h2>
                
                <h4>Frecuencia Respiratoria</h4>
                <h2 style="margin-top: -10px"><?=$SignosVitales['sv_fr']?> X Min</h2>
            </div>
            <div style="rotate: 90; position: absolute;margin-left: 50px;margin-top: 336px;text-transform: uppercase;font-size: 12px;">
                <?=$Enfermera['empleado_nombre']?> <?=$Enfermera['empleado_ape']?> <?=$Enfermera['empleado_am']?> <?=$info['triage_fecha']?> <?=$info['triage_hora']?><br><br><br>
            </div>
            <div style="position: absolute;top: 910px;left: 215px;width: 240px;font-size: 9px;text-align: center">
                <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?><br>
                <span style="margin-top: -6px;margin-bottom: -8px">____________________________________</span><br>
                <b>NOMBRE DEL MÉDICO</b>
            </div>
            <div style="position: absolute;top: 910px;left: 430px;width: 160px;font-size: 9px;text-align: center">
                <?=$Medico['empleado_cedula']?> - <?=$Medico['empleado_matricula']?> <br>
                <span style="margin-top: -6px;margin-bottom: -8px">_____________________________</span><br>
                <b>CÉDULA Y MATRICULA</b>
            </div>
            <div style="position: absolute;top: 910px;left: 590px;width: 110px;font-size: 9px;text-align: center">
                <br>
                <span style="margin-top: -6px;margin-bottom: -8px">_________________</span><br>
                <b>FIRMA</b>
            </div>
            <div style="margin-left: 280px;margin-top: 980px">
                <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 40px;" ></barcode>
            </div>
            
        </div>   
        
    </page_header>
    <span style="text-align: justify">
        <?=$hoja['hf_motivo']?>
        <br>
        <h3 style="margin-bottom: -6px">DIAGNOSTICOS</h3>
        <?=$hoja['hf_diagnosticos']?>
        <br>
        <h3 style="margin-bottom: -6px">PLAN</h3>
        <?=$hoja['hf_antecedentes']?>
        <br>
        <h3 style="margin-bottom: -6px">PRONOSTICO</h3>
        <?=$hoja['hf_indicaciones']?>
        <br>
        <h3 style="margin-bottom: -6px">ESTADO DE SALUD</h3>
        <?=$hoja['hf_interpretacion']?>
        <br>
        <h3 style="margin-bottom: -6px">ACCIÓN: <?=$hoja['hf_alta']?></h3>
    </span>
    <page_footer>

    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('HOJA INICIAL');
    $pdf->Output($Nota['notas_tipo'].'.pdf');
?>