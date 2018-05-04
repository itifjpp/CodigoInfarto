<?php ob_start(); ?>
<page backtop="0mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <div style="position: relative">
        <img src="assets/doc/DOC43051.png" style="position: absolute;width: 100%;margin-top: 32px;margin-left: -5px;">
        <div style="position: absolute;top: 110px;left: 42px;font-size: 20px;width:338px;">
            <b><?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?></b>
        </div>
        <div style="position: absolute;top: 175px;left: 42px;font-size: 15px;width:100px;">
            <b><?=$info['triage_paciente_sexo']?></b>
        </div>
        <div style="position: absolute;top: 175px;left: 180px;font-size: 15px;width:100px;">
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['triage_fecha_nac'])); ?>
            <b><?=$fecha->y==0 ? $fecha->m.' Meses' : $fecha->y.' Años'?></b>
        </div>
        <div style="position: absolute;top:100px;left: 395px;font-size: 9px;;">
           FECHA GENEREACIÓN DOC: <?=$Asignacion['ac_fecha']?>
        </div>
        <div style="position: absolute;top: 124px;left: 400px;font-size: 9px;width:132px;">
           <?=$PINFO['pum_nss']?> <?=$PINFO['pum_nss_agregado']?>
        </div>
        <div style="position: absolute;top: 124px;left: 545px;font-size: 9px;width:70px;">
           <?=$PINFO['pum_umf']?>
        </div>
        <div style="position: absolute;top: 145px;left: 455px;">
            <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 40px;" ></barcode>
        </div>
        <!---DATOS DE LA EMPRESA-->
        <div style="position: absolute;top: 215px;left: 44px;font-size: 8px;width:545px;">
            <?=$Empresa['empresa_nombre']=='' ? 'Sin Especificar' : $Empresa['empresa_nombre'] ?> - 
            <?=$dirEmpresa['directorio_cn']?>
            <?=$dirEmpresa['directorio_colonia']?> 
            <?=$dirEmpresa['directorio_cp']?> 
            <?=$dirEmpresa['directorio_municipio']?>   
            <?=$dirEmpresa['directorio_estado']?>
        </div>
        <div style="position: absolute;top: 215px;left: 545px;font-size: 9px;">
            <?=$dirEmpresa['directorio_telefono']?>
        </div>
        <!---DATOS DEL PACIENTE-->
        <div style="position: absolute;top: 244px;left: 44px;font-size: 9px;width:278px;">
            <?=$dirPaciente['directorio_cn']?> <?=$dirPaciente['directorio_colonia']?> <?=$dirPaciente['directorio_cp']?>
        </div>
        <div style="position: absolute;top: 244px;left: 330px;font-size: 9px;width:95px">
            <?=$dirPaciente['directorio_municipio']?>
        </div>
        <div style="position: absolute;top: 244px;left: 438px;font-size: 9px;width:90px;">
           <?=$dirPaciente['directorio_estado']?>
        </div>
        <div style="position: absolute;top: 244px;left:545px;font-size: 9px;">
            <?=$dirPaciente['directorio_telefono']?>
        </div>
        <!---DATOS DEL RESPONSABLE-->
        <div style="position: absolute;top: 274px;left: 46px;font-size: 9px;width:310px;">
            <?=$PINFO['pic_responsable_nombre']?>
        </div>
        <div style="position: absolute;top: 274px;left: 545px;font-size: 9px;">
            <?=$PINFO['pic_responsable_parentesco']?>
        </div>

        <div style="position: absolute;top: 305px;left: 44px;font-size: 9px;width:278px;">
            <?=$dirFamiliar['directorio_cn']?> <?=$dirFamiliar['directorio_colonia']?> <?=$dirFamiliar['directorio_cp']?>
        </div>
        <div style="position: absolute;top: 305px;left: 328px;font-size: 9px;width:90px;">
            <?=$dirFamiliar['directorio_municipio']?>
        </div>
        <div style="position: absolute;top: 305px;left: 434px;font-size: 9px;width:95px;">
           <?=$dirFamiliar['directorio_estado']?>
        </div>
        <div style="position: absolute;top: 305px;left: 544px;font-size: 9px;">
            <?=$PINFO['pic_responsable_telefono']?>
        </div>

        <!--DATOS DE INGRESO-->
        <div style="position: absolute;top: 335px;left: 44px;font-size: 9px;">
            <?=$AsistenteMedicaIngreso['asistentesmedicas_fecha']?> <?=$AsistenteMedicaIngreso['asistentesmedicas_hora']?> Urgencias
        </div>
        <div style="position: absolute;top: 352px;left: 40px;font-size: 9px;width: 148px;text-align: justify;">
            <?= mb_substr($Diagnostico['hf_diagnosticos'], 0,240,'UTF-8')?>
        </div>
        <div style="position: absolute;top: 335px;left: 200px;font-size: 9px;width: 120px;;">
            <?=$cama['area_nombre']?>
        </div>
        <div style="position: absolute;top: 335px;left: 330px;font-size: 9px;">
            <?=$cama['cama_nombre']?>
        </div>
        <div style="position: absolute;top: 335px;left: 352px;width: 75px;font-size: 9px;text-align: right;">
            <?=$Piso['piso_nombre']?>
        </div>
        <div style="position: absolute;top: 335px;left: 437px;font-size: 9px;width: 200px;;">
            <?=$AsistenteMedica['empleado_nombre']?> <?=$AsistenteMedica['empleado_ap']?> <?=$AsistenteMedica['empleado_am']?>
        </div>
        <div style="position: absolute;top: 365px;left: 202px;font-size: 9px">
            <?=$Asignacion['ac_ingreso_servicio']?>
        </div>
        <div style="position: absolute;top: 365px;left: 330px;font-size: 9px">
            <?=$Asignacion['ac_ingreso_medico']?>
        </div>
        <div style="position: absolute;top: 365px;left: 545px;font-size: 9px">
            <?=$Asignacion['ac_ingreso_matricula']?>
        </div>
        <div style="position: absolute;top: 395px;left: 202px;font-size: 9px">
            <?=$Asignacion['ac_salida_servicio']?>
        </div>
        <div style="position: absolute;top: 395px;left: 330px;font-size: 9px">
            <?=$Asignacion['ac_salida_medico']?>
        </div>
        <div style="position: absolute;top: 395px;left: 545px;font-size: 9px;">
            <?=$Asignacion['ac_salida_matricula']?>
        </div>
    </div>
    <div style="position: relative;margin-top: 20px">
        <img src="<?=  base_url()?>assets/doc/DOC43051.png" style="position: absolute;width: 100%;margin-top: 32px;margin-left: -5px;">
        <div style="position: absolute;top: 110px;left: 42px;font-size: 20px;width:338px;">
            <b><?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?></b>
        </div>
        <div style="position: absolute;top: 175px;left: 42px;font-size: 15px;width:100px;">
            <b><?=$info['triage_paciente_sexo']?></b>
        </div>
        <div style="position: absolute;top: 175px;left: 180px;font-size: 15px;width:100px;">
            <b><?=$fecha->y==0 ? $fecha->m.' Meses' : $fecha->y.' Años'?></b>
        </div>
        <div style="position: absolute;top:100px;left: 395px;font-size: 9px;;">
           FECHA GENEREACIÓN DOC: <?=$Asignacion['ac_fecha']?>
        </div>
        <div style="position: absolute;top: 124px;left: 400px;font-size: 9px;width:132px;">
           <?=$PINFO['pum_nss']?> <?=$PINFO['pum_nss_agregado']?>
        </div>
        <div style="position: absolute;top: 124px;left: 545px;font-size: 9px;width:70px;">
           <?=$PINFO['pum_umf']?>
        </div>
        <div style="position: absolute;top: 145px;left: 455px;">
            <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 40px;" ></barcode>
        </div>
        <!---DATOS DE LA EMPRESA-->
        <div style="position: absolute;top: 215px;left: 44px;font-size: 8px;width:545px;">
            <?=$Empresa['empresa_nombre']=='' ? 'Sin Especificar' : $Empresa['empresa_nombre'] ?> - 
            <?=$dirEmpresa['directorio_cn']?>
            <?=$dirEmpresa['directorio_colonia']?> 
            <?=$dirEmpresa['directorio_cp']?> 
            <?=$dirEmpresa['directorio_municipio']?>   
            <?=$dirEmpresa['directorio_estado']?>
        </div>
        <div style="position: absolute;top: 215px;left: 545px;font-size: 9px;">
            <?=$dirEmpresa['directorio_telefono']?>
        </div>
        <!---DATOS DEL PACIENTE-->
        <div style="position: absolute;top: 244px;left: 44px;font-size: 9px;width:278px;">
            <?=$dirPaciente['directorio_cn']?> <?=$dirPaciente['directorio_colonia']?> <?=$dirPaciente['directorio_cp']?>
        </div>
        <div style="position: absolute;top: 244px;left: 330px;font-size: 9px;width:95px">
            <?=$dirPaciente['directorio_municipio']?>
        </div>
        <div style="position: absolute;top: 244px;left: 438px;font-size: 9px;width:90px;">
           <?=$dirPaciente['directorio_estado']?>
        </div>
        <div style="position: absolute;top: 244px;left:545px;font-size: 9px;">
            <?=$dirPaciente['directorio_telefono']?>
        </div>
        <!---DATOS DEL RESPONSABLE-->
        <div style="position: absolute;top: 274px;left: 46px;font-size: 9px;width:310px;">
            <?=$PINFO['pic_responsable_nombre']?>
        </div>
        <div style="position: absolute;top: 274px;left: 545px;font-size: 9px;">
            <?=$PINFO['pic_responsable_parentesco']?>
        </div>

        <div style="position: absolute;top: 305px;left: 44px;font-size: 9px;width:278px;">
            <?=$dirFamiliar['directorio_cn']?> <?=$dirFamiliar['directorio_colonia']?> <?=$dirFamiliar['directorio_cp']?>
        </div>
        <div style="position: absolute;top: 305px;left: 328px;font-size: 9px;width:90px;">
            <?=$dirFamiliar['directorio_municipio']?>
        </div>
        <div style="position: absolute;top: 305px;left: 434px;font-size: 9px;width:95px;">
           <?=$dirFamiliar['directorio_estado']?>
        </div>
        <div style="position: absolute;top: 305px;left: 544px;font-size: 9px;">
            <?=$PINFO['pic_responsable_telefono']?>
        </div>

        <!--DATOS DE INGRESO-->
        <div style="position: absolute;top: 335px;left: 44px;font-size: 9px;">
            <?=$AsistenteMedicaIngreso['asistentesmedicas_fecha']?> <?=$AsistenteMedicaIngreso['asistentesmedicas_hora']?> Urgencias
        </div>
        <div style="position: absolute;top: 352px;left: 40px;font-size: 9px;width: 148px;text-align: justify;">
            <?= mb_substr($Diagnostico['hf_diagnosticos'], 0,240,'UTF-8')?>
        </div>
        <div style="position: absolute;top: 335px;left: 200px;font-size: 9px;width: 120px;;">
            <?=$cama['area_nombre']?>
        </div>
        <div style="position: absolute;top: 335px;left: 330px;font-size: 9px;">
            <?=$cama['cama_nombre']?>
        </div>
        <div style="position: absolute;top: 335px;left: 352px;width: 75px;font-size: 9px;text-align: right;">
            <?=$Piso['piso_nombre']?>
        </div>
        <div style="position: absolute;top: 335px;left: 437px;font-size: 9px;width: 200px;;">
            <?=$AsistenteMedica['empleado_nombre']?> <?=$AsistenteMedica['empleado_ap']?> <?=$AsistenteMedica['empleado_am']?> 
        </div>
        <div style="position: absolute;top: 365px;left: 202px;font-size: 9px">
            <?=$Asignacion['ac_ingreso_servicio']?>
        </div>
        <div style="position: absolute;top: 365px;left: 330px;font-size: 9px">
            <?=$Asignacion['ac_ingreso_medico']?>
        </div>
        <div style="position: absolute;top: 365px;left: 545px;font-size: 9px">
            <?=$Asignacion['ac_ingreso_matricula']?>
        </div>
        <div style="position: absolute;top: 395px;left: 202px;font-size: 9px">
            <?=$Asignacion['ac_salida_servicio']?>
        </div>
        <div style="position: absolute;top: 395px;left: 330px;font-size: 9px">
            <?=$Asignacion['ac_salida_medico']?>
        </div>
        <div style="position: absolute;top: 395px;left: 545px;font-size: 9px;">
            <?=$Asignacion['ac_salida_matricula']?>
        </div>
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('4-30-51');
    $pdf->Output('DOC_43_0_51.pdf');
?>