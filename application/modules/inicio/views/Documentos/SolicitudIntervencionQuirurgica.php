<?php ob_start(); ?>
<page backtop="10mm"> 
    <page_header>
        
    </page_header>
    <img src="assets/doc/observacion/ConsentimientoInformado_1.png" style="position: absolute;width: 100%;margin-top: 0px;margin-left: -5px;">
        <style>
            table, td, th {border: 1px solid #ddd;text-align: left;
            }table {border-collapse: collapse;width: 100%;}
            th, td {padding: 15px;}
    </style>
    <div style="position: absolute;top: 10px">
        <?php 
        $sqlPUM=$this->config_mdl->_get_data_condition('paciente_info',array(
            'triage_id'=>$triage['triage_id']
        ))[0];
        ?>
        <div style="position: absolute;top: 20px;left: 470px;font-size: 12px;width: 240px;padding-top: 5px"><?=$this->UM_CLASIFICACION?> | <?=$this->UM_NOMBRE?></div>
        <div style="position: absolute;top: 70px;left: 470px;font-size: 12px;width: 240px;padding-top: 5px"><?=$triage['triage_nombre']?> <?=$triage['triage_nombre_ap']?> <?=$triage['triage_nombre_am']?></div>
        <div style="position: absolute;top: 115px;left: 470px;font-size: 12px;width: 240px;padding-top: 5px"><?=$sqlPUM['pum_nss']?> <?=$sqlPUM['pum_nss_agregado']?></div>
        <div style="position: absolute;top: 155px;left: 470px;font-size: 12px;width: 240px;padding-top: 5px"><?=$triage['triage_paciente_edad']?> Años</div>
        <div style="position: absolute;top: 190px;left: 470px;font-size: 10px;width: 240px;padding-top: 2px;">
            <?=$DirPaciente['directorio_cn']?> <?=$DirPaciente['directorio_colonia']?> <?=$DirPaciente['directorio_municipio']?> <?=$DirPaciente['directorio_estado']?> <?=$DirPaciente['directorio_cp']?>, Tel: <?=$DirPaciente['directorio_telefono']?> 
        </div>
        <div style="position: absolute;top: 266px;left: 480px;font-size: 11px;width: 240px;padding-top: 2px;text-align: center">
            <?=$ci['ci_nmc']?><br>
            <?=$ci['ci_mmc']?>
        </div>
        
        <div style="position: absolute;top: 115px;left: 18px;font-size: 11px;width: 280px;padding-top: 2px;">
            <?=$ci['ci_servicio']?>
        </div>
        <div style="position: absolute;top: 115px;left: 310px;font-size: 11px;width: 140px;padding-top: 2px;">
            <?=$observacion['observacion_cama_nombre']?>
        </div>
        <div style="position: absolute;top: 160px;left: 18px;font-size: 11px;width: 140px;padding-top: 0px;">
            <?=$ci['ci_fecha_solicitud']?>
        </div>
        <div style="position: absolute;top: 160px;left: 178px;font-size: 11px;width: 120px;padding-top: 0px;">
            <?=$ci['ci_fecha_solicitada']?>
        </div>
        <div style="position: absolute;top: 160px;left: 310px;font-size: 11px;width: 120px;padding-top: 0px;">
            <?=$ci['ci_hora_deseada']?>
        </div>
        <div style="position: absolute;top: 250px;left: 90px;font-size: 11px;">
            <?=$ci['ci_prioridad']=='Prioridad Alta' ? 'X': ''?>
        </div>
        <div style="position: absolute;top: 250px;left: 240px;font-size: 11px;">
            <?=$ci['ci_prioridad']=='Prioridad Media' ? 'X': ''?>
        </div>
        <div style="position: absolute;top: 250px;left: 390px;font-size: 11px;">
            <?=$ci['ci_prioridad']=='Prioridad Baja' ? 'X': ''?>
        </div>
        <div style="position: absolute;top: 310px;left: 17px;font-size: 11px;width: 700px;padding-top: 0px;">
            <?=$ci['ci_diagnostico']?>
        </div>
        <div style="position: absolute;top: 350px;left: 17px;font-size: 11px;width: 500px;padding-top: 0px;">
            <?=$ci['ci_operacion_planeada']?>
        </div>
        <div style="position: absolute;top: 350px;left: 595px;font-size: 11px;">
            <?=$ci['ci_operacion_eu']=='Electiva' ? 'X': 'X'?>
        </div>
        <div style="position: absolute;top: 350px;left: 685px;font-size: 11px;">
            <?=$ci['ci_operacion_eu']=='Urgencia' ? 'X': 'X'?>
        </div>
        <div style="position: absolute;top: 380px;left: 105px;font-size: 11px;">
            <?=$st['solicitudtransfucion_gs_abo']?>
        </div>
        <div style="position: absolute;top: 380px;left: 210px;font-size: 11px;">
            <?=$st['solicitudtransfucion_gs_rhd']?>
        </div>
        <div style="position: absolute;top: 380px;left: 437px;font-size: 11px;">
            <?=$st['solicitudtransfucion_disponible']?>
        </div>
        <div style="position: absolute;top: 380px;left: 643px;font-size: 11px;">
            <?=$st['solicitudtransfucion_reserva']?>
        </div>
        <div style="position: absolute;top: 420px;left: 190px;font-size: 11px;">
            <?=$ci['ci_ap']=='Local' ? 'X': ''?>
        </div>
        <div style="position: absolute;top: 420px;left: 285px;font-size: 11px;">
            <?=$ci['ci_ap']=='Regional' ? 'X': ''?>
        </div>
        <div style="position: absolute;top: 420px;left: 399px;font-size: 11px;">
            <?=$ci['ci_ap']=='General' ? 'X': ''?>
        </div>
        <div style="position: absolute;top: 450px;left: 17px;font-size: 11px;">
            <?=$ci['ci_tec']?>
        </div>
        <div style="position: absolute;top: 425px;left: 480px;font-size: 11px;width: 240px;padding-top: 2px;text-align: center">
            <?=$ci['ci_njs']?>
        </div>
    </div>
    <page_footer> </page_footer>

        
</page>
<page pageset="old">
    <div style="margin-top: 20px;">
        <img src="<?=  base_url()?>assets/doc/observacion/ConsentimientoInformado_2.png" style="position: absolute;width: 100%;margin-top: 20px;margin-left: -5px;">
    </div>
</page>
<page pageset="old">
    <div style="margin-top: 0px;font-size: 20px;font-weight: 200;width: 100%;margin-right: 20px;">
        <img src="<?=  base_url()?>assets/doc/observacion/ConsentimientoInformado_3.png" style="position: absolute;width: 100%;margin-top: 20px;margin-left: -5px;">
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('SOLICITUD DE INTERVENCIÓN QUIRÚRGICO');
    $pdf->Output('SOLICITUD DE INTERVENCIÓN QUIRÚRGICO.pdf');
?>