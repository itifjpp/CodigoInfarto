<?php 
    ob_start(); 
    $sqlMedico=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
        'empleado_id'=>$Hoja['empleado_id']
    ))[0];
    $NombreMedico=$Medico['empleado_nombre'].' '.$Medico['empleado_ap'].' '.$Medico['empleado_am'];
    $MatriculaMedico=$Medico['empleado_matricula'];
?>
<page backtop="0mm" backbottom="45mm" backleft="10mm" backright="0mm">
    <img src="assets/doc/HOJA_A_HOS_O-min.png" style="position: absolute;width: 94%;">
    <div style="position: absolute;margin-top: 15px">
        <div style="position: absolute;margin-left:78px;margin-top: 154px;text-transform: uppercase;font-size: 10px;">
            <b><?=$info['paciente_nombre']?> <?=$info['paciente_ap']?> <?=$info['paciente_am']?></b>
        </div>

        <div style="position: absolute;margin-left:445px;margin-top: 152px;text-transform: uppercase;font-size: 10px;">
            <b><?=$Hoja['ha_fecha_ingreso']?> <?=$Hoja['ha_hora_ingreso']?></b>
        </div>

        <div style="position: absolute;margin-left:185px;margin-top: 169px;text-transform: uppercase;font-size: 10px;">
            <b><?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?></b>
        </div>
        
        <div style="position: absolute;margin-left:475px;margin-top: 171px;text-transform: uppercase;font-size: 10px;">
            <b><?=$Hoja['ha_fecha_eg']?> <?=$Hoja['ha_hora_eg']?></b>
        </div>

        <div style="position: absolute;margin-left:215px;margin-top: 188px;text-transform: uppercase;font-size: 10px;">
            <b><?=$Hoja['ha_especialidad']?></b>
        </div>
        
        <div style="position: absolute;margin-top:190px;margin-left: 434px;font-size: 10px ">
            <?php 
            if($info['ingreso_en']=='Pisos'){
                $sqlPisos=$this->config_mdl->sqlGetDataCondition('sigh_pisos_areas',array(
                    'ingreso_id'=>$info['ingreso_id']
                ),'cama_id');
                echo $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
                    'cama_id'=>$sqlPisos[0]['cama_id']
                ),'cama_nombre')[0]['cama_nombre'];
            }else if($info['triage_en']=='Choque'){
                $sqlChoque=$this->config_mdl->sqlGetDataCondition('sigh_choque',array(
                    'ingreso_id'=>$info['ingreso_id']
                ),'cama_id');
                echo $this->config_mdl->sqlGetDataCondition('sigh_camas',array(
                    'cama_id'=>$sqlChoque[0]['cama_id']
                ),'cama_nombre')[0]['cama_nombre'];
            }else if($info['triage_en']=='Observación'){
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
        <div style="position: absolute;margin-left: 44px;margin-top: 248px">
            <?=$Hoja['ha_motivo_egreso']=='CURACIÓN'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 298px;margin-top: 248px">
            <?=$Hoja['ha_motivo_egreso']=='ABANDONO'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 248px">
            <?=$Hoja['ha_motivo_egreso']=='VOLANTARIO'? 'X':''?> 
        </div>
        <div style="position: absolute;margin-left: 44px;margin-top: 268px">
            <?=$Hoja['ha_motivo_egreso']=='DEFUNCIÓN'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 298px;margin-top: 268px">
            <?=$Hoja['ha_motivo_egreso']=='MEJORIA'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 268px">
            <?=$Hoja['ha_motivo_egreso']=='TRANSITORIO'? 'X':''?>
        </div>
        
        <div style="position: absolute;margin-left: 44px;margin-top: 312px">
            <?=$Hoja['ha_envio']=='CONSULTA DE ESPECIALIDAD DEL MISMO HOSPITAL'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 298px;margin-top: 312px">
            <?=$Hoja['ha_envio']=='MEDICINA FAMILIAR'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 44px;margin-top: 332px">
            <?=$Hoja['ha_envio']=='OTRO HOSPITAL DEL IMSS'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 298px;margin-top: 332px">
            <?=$Hoja['ha_envio']=='OTRA INSTITUCIÓN'? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 90px;margin-top: 377px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_ingreso']?></b>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 377px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_ingreso_c']?></b>
        </div>
        
        <div style="position: absolute;margin-left: 152px;margin-top: 393px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_ingreso_prin']?></b>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 393px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_ingreso_prin_c']?></b>
        </div>
        
        <div style="position: absolute;margin-left: 152px;margin-top: 410px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_1_sec']?></b>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 410px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_1_sec_c']?></b>
        </div>
        
        <div style="position: absolute;margin-left: 152px;margin-top: 426px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_2_sec']?></b>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 426px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_dx_2_sec_c']?></b>
        </div>
        
        <div style="position: absolute;margin-left: 152px;margin-top: 441px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_com_1_intra']?></b>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 441px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_com_1_intra_c']?></b>
        </div>
        <div style="position: absolute;margin-left: 152px;margin-top: 456px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_com_2_intra']?></b>
        </div>
        <div style="position: absolute;margin-left: 550px;margin-top: 456px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_com_2_intra_c']?></b>
        </div>
        
        <div style="position: absolute;margin-left: 70px;margin-top: 501px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_egreso_df_dx1']?></b>
        </div>
        <div style="position: absolute;margin-left: 70px;margin-top: 517px;font-size: 8px;text-transform: uppercase">
            <b><?=$Hoja['ha_egreso_df_dx2']?></b>
        </div>
        
        <div style="position: absolute;margin-left: 35px;margin-top: 537px;text-transform: uppercase">
            <?=$Hoja['ha_egreso_df_autopsia']=='No' && $Hoja['ha_motivo_egreso']=='DEFUNCIÓN' ? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 410px;margin-top: 537px;text-transform: uppercase">
            <?=$Hoja['ha_egreso_df_autopsia']=='Si' && $Hoja['ha_motivo_egreso']=='DEFUNCIÓN' ? 'X':''?>
        </div>
        
        <div style="position: absolute;margin-left: 37px;margin-top: 587px;text-transform: uppercase">
            <?=$Hoja['ha_programa']=='PUERPERIO BAJO RIESGO' ? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 285px;margin-top: 587px;text-transform: uppercase">
            <?=$Hoja['ha_programa']=='CIRUGIA AMBULATORIA' ? 'X':''?>
        </div>
        <div style="position: absolute;margin-left: 520px;margin-top: 587px;text-transform: uppercase">
            <?=$Hoja['ha_programa']=='NINGUNO DE ESTOS' ? 'X':''?>
        </div>
        
        <div style="position: absolute;margin-left: 38px;margin-top: 633px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='PASTILLAS S/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 175px;margin-top: 633px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='PASTILLAS C/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 305px;margin-top: 633px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='DIU S/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 410px;margin-top: 633px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='DIU C/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 540px;margin-top: 633px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='O.T.B S/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 38px;margin-top: 653px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='O.T.B C/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 175px;margin-top: 653px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='INYECTABLE S/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 305px;margin-top: 653px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='INYECTABLE C/R'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 410px;margin-top: 653px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='VASECTOMIA'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 540px;margin-top: 653px;text-transform: uppercase">
            <?=$Hoja['ha_planificacion']=='NINGUNO'? 'X' :''?>
        </div>
        <div style="position: absolute;margin-left: 38px;margin-top: 708px">
            <?=$Hoja['ha_ramo_seguro']=='RIESGO DE TRABAJO CONFIRMADO'?'X':''?>
        </div>
        <div style="position: absolute;margin-left: 284px;margin-top: 708px">
            <?=$Hoja['ha_ramo_seguro']=='RIESGO DE TRABAJO PROBABLE'?'X':''?>
        </div>
        <div style="position: absolute;margin-left: 558px;margin-top: 708px">
            <?=$Hoja['ha_ramo_seguro']=='INVALIDEZ'?'X':''?>
        </div>
        <div style="position: absolute;margin-left: 135px;margin-top: 741px;font-size: 10px">
            <?=$Hoja['ha_n_recetas']?>
        </div>
        <?php 
        if($Hoja['ha_medico_autoriza']==''){
            $medico=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                'empleado_id'=>$Hoja['empleado_id']
            ))[0];
        }else{
            $medico=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                'empleado_id'=>$Hoja['ha_medico_autoriza']
            ))[0];
        }
        ?>
        <div style="position: absolute;margin-left:28px;margin-top:800px;text-align: center;width: 200px;font-size: 10px;">
            <?=$medico['empleado_nombre']?> <?=$medico['empleado_ap']?> <?=$medico['empleado_am']?><br>
            <span style="margin-top: -5px;margin-bottom: -5px">_______________________________</span><br>
            <b>NOMBRE</b>
        </div>
        <div style="position: absolute;margin-left:250px;margin-top:800px;text-align: center;width: 180px;font-size: 10px">
            <?=$medico['empleado_matricula']?><br>
            <span style="margin-top: -5px;margin-bottom: -5px">________________________________</span><br>
            <b>MATRICULA</b>
        </div>
        <div style="position: absolute;margin-left:450px;margin-top:800px;text-align: center;width: 180px;font-size: 10px">
            <br>
            <span style="margin-top: -5px;margin-bottom: -5px">_______________________________</span><br>
            <b>FIRMA</b>
        </div>
    </div>  
    
    <page_footer>
        
    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','en',true,'UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('HOJA DE ALTA HOSPITALARIA');
    $pdf->Output('HOJA DE ALTA HOSPITALARIA.pdf');
?>