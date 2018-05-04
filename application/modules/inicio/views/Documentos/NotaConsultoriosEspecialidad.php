<?php ob_start(); ?>
<page backtop="85mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/doc/asistentesmedicas_c.png" style="position: absolute;width: 100%;margin-top: 0px;margin-left: -5px;">
     <div style="position: absolute;margin-top: 15px">
        <div style="position: absolute;top: 86px;left: 67px;font-size: 11px"><?=$am['asistentesmedicas_fecha']?></div>
        <div style="position: absolute;top: 86px;left: 250px;font-size: 11px"><?=$am['asistentesmedicas_hora']?></div>
        <div style="position: absolute;top: 86px;left: 430px;font-size: 11px"><?=$am['asistentesmedicas_hoja']?></div>
        <div style="position: absolute;top: 86px;left: 580px;font-size: 11px"><?=$am['asistentesmedicas_renglon']?></div>
        <?php
        $sqlPUM=$this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=>$info['triage_id']
        ))[0];
        ?>
        <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['triage_fecha_nac'])); ?>
        <!--2 fila-->
        <div style="position: absolute;top: 106px;left: 80px;font-size: 11px;text-transform: uppercase"><?=$info['triage_nombre']?> <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?></div>
        <div style="position: absolute;top: 106px;left: 417px;font-size: 11px;text-transform: uppercase"><?=$info['triage_paciente_sexo']?></div>
        <div style="position: absolute;top: 106px;left: 511px;font-size: 11px"><?=$fecha->y?></div>
        <div style="position: absolute;top: 106px;left: 571px;font-size: 11px"><?=$fecha->m?> </div>
        <!--3 fila-->
        <div style="position: absolute;top: 126px;left: 109px;font-size: 11px;;text-transform: uppercase"><?=$sqlPUM['pum_nss_armado']=='' ? $sqlPUM['pum_nss'].' '.$sqlPUM['pum_nss_agregado'] : $sqlPUM['pum_nss_armado']?></div>
        <div style="position: absolute;top: 126px;left: 435px;font-size: 11px;text-transform: uppercase"><?=$sqlPUM['pum_umf']?></div>
        
        <div style="position: absolute;top: 146px;left: 85px;font-size: 11px;text-transform: uppercase"><?=$DirPaciente['directorio_cn']?> <?=$DirPaciente['directorio_colonia']?> <?=$DirPaciente['directorio_cp']?> <?=$DirPaciente['directorio_municipio']?> <?=$DirPaciente['directorio_estado']?> </div>
        
        <div style="position: absolute;top: 165px;left: 186px;font-size: 11px;;text-transform: uppercase"><?=$sqlPUM['pic_responsable_nombre']?></div>
        <div style="position: absolute;top: 165px;left: 500px;font-size: 11px;text-transform: uppercase"><?=$sqlPUM['pic_responsable_telefono']?></div>
        <div style="position: absolute;top: 185px;left: 80px;font-size: 11px;text-transform: uppercase"><?=  substr($Empresa['empresa_nombre'], 0,50)?></div>
        <?php 
        $DirecccionEmpresa=$DirEmpresa['directorio_cn'].' '.$DirEmpresa['directorio_colonia'].' '.$DirEmpresa['directorio_cp'].' '.$DirEmpresa['directorio_municipio'].' '.$DirEmpresa['directorio_estado'];
        if(strlen($DirecccionEmpresa)>=54){
        ?>
        <div style="position: absolute;top: 178px;left: 400px;font-size: 9px;text-transform: uppercase;width: 310px;">
            <?=$DirecccionEmpresa?>
        </div>
        <?php }else{?>
        <div style="position: absolute;top: 185px;left: 400px;font-size: 10px;text-transform: uppercase;">
            <?=$DirecccionEmpresa?>
        </div>
        <?php }?>
        <div style="position: absolute;top: 205px;left: 130px;font-size: 11px;text-transform: uppercase"><?=$info['triage_paciente_medico_tratante']?></div>
        <div style="position: absolute;top: 205px;left: 505px;font-size: 11px;text-transform: uppercase"><?=$info['triage_paciente_asistente_medica']?></div>
        
        
        <div style="position: absolute;top: 245px;left: 135px;font-size: 11px;text-transform: uppercase"><?=$sqlPUM['pia_fecha_accidente']?></div>
        <div style="position: absolute;top: 245px;left: 263px;font-size: 11px;text-transform: uppercase"><?=$sqlPUM['pia_hora_accidente']?></div>
        <div style="position: absolute;top: 245px;left: 380px;font-size: 11px;text-transform: uppercase"><?=$sqlPUM['pia_lugar_accidente']?></div>
        <div style="position: absolute;top: 245px;left: 554px;font-size: 11px;text-transform: uppercase"><?=$sqlPUM['pia_lugar_procedencia']?></div>
        
    </div>   
    </page_header>
    <h5 style="margin-top: -20px">
        <b>MÉDICO :</b> <?=$Medico['empleado_nombre']?> <?=$Medico['empleados_apellidos']?>
    </h5>
    <h5 style="margin-top: -26px;text-align: right;">
        <b>FECHA Y HORA :</b> <?=$Nota['notas_fecha']?> <?=$Nota['notas_hora']?>
    </h5>
    <h4><b>NOTA DE VALORACIÓN</b></h4>
    <span style="text-align: justify"><?=$Nota['nota_nota']?></span>
    <br>
    <?php if($Nota['nota_diagnostico']!=''){?>
    <h5><b>DIAGNOSTICO</b></h5>
    <span style="text-align: justify"><?=$Nota['nota_diagnostico']?></span>
    <?php } ?>
    <page_footer>
        <div style="margin-left: 280px;">
            <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 20px;" ></barcode>
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
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('NOTA DE VALORACIÓN');
    $pdf->Output('NOTA DE VALORACIÓN.pdf');
?>