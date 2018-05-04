<?php ob_start(); ?>
<page>
    <page_header>
        <img src="assets/doc/observacion/BANCO_SANGRE.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
        <style>
            table, td, th {border: 1px solid #ddd;text-align: left;
            }table {border-collapse: collapse;width: 100%;}
            th, td {padding: 15px;}
    </style>
    </page_header>
    <div style="position: absolute;top: 100px">
        <div style="position: absolute;top: 40px;left: 480px;font-size: 12px;width: 240px;padding-top: 5px"><?=$triage['triage_nombre']?> <?=$triage['triage_nombre_ap']?> <?=$triage['triage_nombre_am']?></div>
        <div style="position: absolute;top: 16px;left: 60px;font-size: 11px"><?=$st['solicitudtransfucion_sangre']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 16px;left: 150px;font-size: 11px"><?=$st['solicitudtransfucion_plasma']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 16px;left: 235px;font-size: 11px"><?=$st['solicitudtransfucion_suspensionconcentrada']!='' ? 'X' :'' ?></div>
        
        <div style="position: absolute;top: 40px;left: 32px;font-size: 11px"><?=$st['solicitudtransfucion_otros']!='' ? 'X' :'X' ?></div>
        <div style="position: absolute;top: 40px;left: 92px;font-size: 11px"><?=$st['solicitudtransfucion_otros_val']?></div>
        
        <div style="position: absolute;top: 62px;left: 32px;font-size: 11px"><?=$st['solicitudtransfucion_ordinaria']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 63px;left: 165px;font-size: 11px"><?=$st['solicitudtransfucion_urgente']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 63px;left: 348px;font-size: 11px"><?=$st['solicitudtransfucion_urgente_vol']?></div>
        
        
        <div style="position: absolute;top: 85px;left: 130px;font-size: 11px"><?=$st['solicitudtransfucion_operacion_dia']?></div>
        <div style="position: absolute;top: 85px;left: 330px;font-size: 11px"><?=$st['solicitudtransfucion_operacion_hora']?></div>
        
        <div style="position: absolute;top: 108px;left: 380px;font-size: 11px"><?=$st['solicitudtransfucion_disponible']?></div>
        <div style="position: absolute;top: 108px;left: 550px;font-size: 11px"><?=$st['solicitudtransfucion_reserva']?></div>
        
        <div style="position: absolute;top: 130px;left: 180px;font-size: 11px"><?=$st['solicitudtransfucion_gs_abo']?></div>
        <div style="position: absolute;top: 130px;left: 320px;font-size: 11px"><?=$st['solicitudtransfucion_gs_rhd']?></div>
        <div style="position: absolute;top: 130px;left: 380px;font-size: 11px"><?=$st['solicitudtransfucion_gs_ignora']!='' ? 'X' :'X' ?></div>
        
        <div style="position: absolute;top: 153px;left: 100px;font-size: 11px;width: 270px;"><?=$st['solicitudtransfucion_diagnostico']?></div>
        <div style="position: absolute;top: 153px;left: 410px;font-size: 11px;"><?=$st['solicitudtransfucion_hb']?></div>
        <div style="position: absolute;top: 153px;left: 550px;font-size: 11px;"><?=$st['solicitudtransfucion_ht']?></div>
    
        <div style="position: absolute;top: 176px;left: 70px;font-size: 11px;"><?=$triage['triage_paciente_edad']?> Años</div>
        <div style="position: absolute;top: 176px;left: 288px;font-size: 11px;"><?=$triage['triage_paciente_sexo']?></div>
        
        <div style="position: absolute;top: 176px;left: 520px;font-size: 11px;"><?=$st['solicitudtransfucion_transfuciones_previas']?></div>
        
        <div style="position: absolute;top: 199px;left: 205px;font-size: 11px;"><?=$st['solicitudtransfucion_reacciones_postransfuncionales']?></div>
        <div style="position: absolute;top: 199px;left: 490px;font-size: 11px;"><?=$st['solicitudtransfucion_fecha_ultima']?></div>
        
        <div style="position: absolute;top: 222px;left: 145px;font-size: 11px;"><?=$st['solicitudtransfucion_embarazo_previo']?></div>
        <div style="position: absolute;top: 222px;left: 610px;font-size: 11px;"><?=$st['solicitudtransfucion_pfh']?></div>
        
        <div style="position: absolute;top: 269px;left: 150px;font-size: 10px;"><?=$this->UM_CLASIFICACION?> | <?=$this->UM_NOMBRE?></div>
        <div style="position: absolute;top: 269px;left: 390px;font-size: 10px;">Observación & Urgencias</div>
        <div style="position: absolute;top: 269px;left: 595px;font-size: 10px;"><?=$observacion['observacion_cama_nombre']?></div>
        
        <div style="position: absolute;top: 291px;left:71px;font-size: 11px;"><?=$observacion['observacion_medico_nombre']?></div>
        <div style="position: absolute;top: 291px;left:400px;font-size: 11px;"><?=$st['solicitudtransfucion_solicita_f']?></div>
        <div style="position: absolute;top: 291px;left:590px;font-size: 11px;"><?=$st['solicitudtransfucion_solicita_h']?></div>
        
        <div style="position: absolute;top: 313px;left:125px;font-size: 11px;"><?=$st['solicitudtransfucion_recibio_nombre']?></div>
        <div style="position: absolute;top: 313px;left:400px;font-size: 11px;"><?=$st['solicitudtransfucion_recibio_f']?></div>
        <div style="position: absolute;top: 313px;left:590px;font-size: 11px;"><?=$st['solicitudtransfucion_recibio_h']?></div>
    </div>
    <div style="position: absolute;top: 601px">
        <div style="position: absolute;top: 40px;left: 480px;font-size: 12px;width: 240px;padding-top: 5px"><?=$triage['triage_nombre']?> <?=$triage['triage_nombre_ap']?> <?=$triage['triage_nombre_am']?></div>
        <div style="position: absolute;top: 16px;left: 60px;font-size: 11px"><?=$st['solicitudtransfucion_sangre']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 16px;left: 150px;font-size: 11px"><?=$st['solicitudtransfucion_plasma']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 16px;left: 235px;font-size: 11px"><?=$st['solicitudtransfucion_suspensionconcentrada']!='' ? 'X' :'' ?></div>
        
        <div style="position: absolute;top: 42px;left: 32px;font-size: 11px"><?=$st['solicitudtransfucion_otros']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 42px;left: 92px;font-size: 11px"><?=$st['solicitudtransfucion_otros_val']?></div>
        
        <div style="position: absolute;top: 63px;left: 32px;font-size: 11px"><?=$st['solicitudtransfucion_ordinaria']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 64px;left: 165px;font-size: 11px"><?=$st['solicitudtransfucion_urgente']!='' ? 'X' :'' ?></div>
        <div style="position: absolute;top: 63px;left: 348px;font-size: 11px"><?=$st['solicitudtransfucion_urgente_vol']?></div>
        
        
        <div style="position: absolute;top: 85px;left: 130px;font-size: 11px"><?=$st['solicitudtransfucion_operacion_dia']?></div>
        <div style="position: absolute;top: 85px;left: 330px;font-size: 11px"><?=$st['solicitudtransfucion_operacion_hora']?></div>
        
        <div style="position: absolute;top: 108px;left: 380px;font-size: 11px"><?=$st['solicitudtransfucion_disponible']?></div>
        <div style="position: absolute;top: 108px;left: 550px;font-size: 11px"><?=$st['solicitudtransfucion_reserva']?></div>
        
        <div style="position: absolute;top: 130px;left: 180px;font-size: 11px"><?=$st['solicitudtransfucion_gs_abo']?></div>
        <div style="position: absolute;top: 130px;left: 320px;font-size: 11px"><?=$st['solicitudtransfucion_gs_rhd']?></div>
        <div style="position: absolute;top: 130px;left: 380px;font-size: 11px"><?=$st['solicitudtransfucion_gs_ignora']!='' ? 'X' :'' ?></div>
        
        <div style="position: absolute;top: 153px;left: 100px;font-size: 11px;width: 270px;"><?=$st['solicitudtransfucion_diagnostico']?></div>
        <div style="position: absolute;top: 153px;left: 410px;font-size: 11px;"><?=$st['solicitudtransfucion_hb']?></div>
        <div style="position: absolute;top: 153px;left: 550px;font-size: 11px;"><?=$st['solicitudtransfucion_ht']?></div>
        <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$triage['triage_fecha_nac'])); ?>
        <div style="position: absolute;top: 176px;left: 70px;font-size: 11px;"><?=$fecha->y?> Años</div>
        <div style="position: absolute;top: 176px;left: 288px;font-size: 11px;"><?=$triage['triage_paciente_sexo']?></div>
        
        <div style="position: absolute;top: 176px;left: 520px;font-size: 11px;"><?=$st['solicitudtransfucion_transfuciones_previas']?></div>
        
        <div style="position: absolute;top: 199px;left: 205px;font-size: 11px;"><?=$st['solicitudtransfucion_reacciones_postransfuncionales']?></div>
        <div style="position: absolute;top: 199px;left: 490px;font-size: 11px;"><?=$st['solicitudtransfucion_fecha_ultima']?></div>
        
        <div style="position: absolute;top: 222px;left: 145px;font-size: 11px;"><?=$st['solicitudtransfucion_embarazo_previo']?></div>
        <div style="position: absolute;top: 222px;left: 610px;font-size: 11px;"><?=$st['solicitudtransfucion_pfh']?></div>
        
        <div style="position: absolute;top: 269px;left: 150px;font-size: 10px;"><?=$this->UM_CLASIFICACION?> | <?=$this->UM_NOMBRE?></div>
        <div style="position: absolute;top: 269px;left: 390px;font-size: 10px;">Observación & Urgencias</div>
        <div style="position: absolute;top: 269px;left: 595px;font-size: 10px;"><?=$observacion['observacion_cama_nombre']?></div>
        
        <div style="position: absolute;top: 291px;left:71px;font-size: 11px;"><?=$observacion['observacion_medico_nombre']?></div>
        <div style="position: absolute;top: 291px;left:400px;font-size: 11px;"><?=$st['solicitudtransfucion_solicita_f']?></div>
        <div style="position: absolute;top: 291px;left:590px;font-size: 11px;"><?=$st['solicitudtransfucion_solicita_h']?></div>
        
        <div style="position: absolute;top: 313px;left:125px;font-size: 11px;"><?=$st['solicitudtransfucion_recibio_nombre']?></div>
        <div style="position: absolute;top: 313px;left:400px;font-size: 11px;"><?=$st['solicitudtransfucion_recibio_f']?></div>
        <div style="position: absolute;top: 313px;left:590px;font-size: 11px;"><?=$st['solicitudtransfucion_recibio_h']?></div>
    </div>
    <page_footer>
        


    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>