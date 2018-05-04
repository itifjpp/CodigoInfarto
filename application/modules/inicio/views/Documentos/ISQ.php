<?php ob_start(); ?>
<page backtop="20mm">
    <page_header>
        <img src="assets/doc/observacion/ISQ.png" style="position: absolute;width: 100%;">
    </page_header>
    <div style="position: absolute;top: 60px">
        <div style="position: absolute;top: 11px;left: 150px;font-size: 11px;"><?=$triage['triage_nombre']?> <?=$triage['triage_nombre_ap']?> <?=$triage['triage_nombre_am']?></div>
        <div style="position: absolute;top: 11px;left: 599px;font-size: 11px;"><?=  date('d/m/Y')?></div>
        
        <div style="position: absolute;top: 40px;left: 420px;font-size: 11px;"><?=$triage['triage_paciente_sexo']=='HOMBRE'? 'X' : ''?></div>
        <div style="position: absolute;top: 40px;left: 510px;font-size: 11px;"><?=$triage['triage_paciente_sexo']=='MUJER'? 'X' : ''?></div>
        
        <div style="position: absolute;top: 35px;left: 110px;font-size: 11px;width: 200px"><?=$isq['isq_servicio_area']?> </div>
        <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$triage['triage_fecha_nac'])); ?>
        <div style="position: absolute;top: 40px;left: 599px;font-size: 11px;"><?=$fecha->y?> Años</div>
        <div style="position: absolute;top: 70px;left: 170px;font-size: 11px;"><?=$PINFO['pum_nss']?> <?=$PINFO['pum_nss_agregado']?></div>     
        <div style="position: absolute;top: 70px;left: 390px;font-size: 11px;"><?=$isq['isq_turno']=='M'? 'X':''?></div>
        <div style="position: absolute;top: 70px;left: 450px;font-size: 11px;"><?=$isq['isq_turno']=='V'? 'X':''?></div>
        <div style="position: absolute;top: 70px;left: 510px;font-size: 11px;"><?=$isq['isq_turno']=='N'? 'X':''?></div>
        <div style="position: absolute;top: 70px;left: 599px;font-size: 11px;"><?=$triage['triage_id']?></div>
    </div>
    
    <page_footer></page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('LISTA_PARA_PREVENIR_ISQ.pdf');
?>