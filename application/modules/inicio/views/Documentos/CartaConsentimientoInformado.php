<?php ob_start(); ?>
<page backtop="20mm">
    <page_header>
        <img src="assets/doc/observacion/CONSENTIMIENTO_TRANSFUSION.png" style="position: absolute;width: 100%;">
    </page_header>
    <div style="position: absolute;top: 150px">
        <div style="position: absolute;top: 10px;left: 250px;font-size: 12px;"><?=$cci['cci_la_que_suscribe']?></div>
        <?php $cci_fecha=  explode('/', $cci['cci_fecha']);s?>
        <div style="position: absolute;top: -5px;left: 483px;font-size: 11px;"><?=$cci_fecha[0]?></div>
        <div style="position: absolute;top: -5px;left: 540px;font-size: 11px;"><?=$cci_fecha[1]?></div>
        <div style="position: absolute;top: -4px;left: 622px;font-size: 10px;"><?=$cci_fecha[2]?></div>
        <div style="position: absolute;top: 23px;left: 254px;font-size: 11px;"><?=$cci['cci_caracter']=='Paciente'? 'X':''?></div>
        <div style="position: absolute;top: 23px;left: 414px;font-size: 11px;"><?=$cci['cci_caracter']=='Familiar del Paciente'? 'X':''?></div>
        <div style="position: absolute;top: 23px;left: 562px;font-size: 11px;"><?=$cci['cci_caracter']=='Representante Legal'? 'X':''?></div>
        <div style="position: absolute;top: 23px;left: 627px;font-size: 11px;"><?=$cci['cci_caracter']=='Testigo'? 'X':''?></div>
        
        <div style="position: absolute;top: 35px;left: 250px;font-size: 11px;"><?=$observacion['observacion_medico_nombre']?></div>
        <div style="position: absolute;top: 100px;left: 140px;font-size: 11px;;width: 500px"><?=$st['solicitudtransfucion_diagnostico']?></div>
    
        <div style="position: absolute;top: 170px;left:310px;font-size: 11px;"><?=$cci['cci_tipo_ct']=='Concentrado de eritrocito'? 'X':''?></div>
        <div style="position: absolute;top: 170px;left:383px;font-size: 11px;"><?=$cci['cci_tipo_ct']=='Plasma'? 'X':''?></div>
        <div style="position: absolute;top: 170px;left:480px;font-size: 11px;"><?=$cci['cci_tipo_ct']=='Plaquetas'? 'X':''?></div>
        <div style="position: absolute;top: 170px;left:622px;font-size: 11px;"><?=$cci['cci_tipo_ct']=='Crioprecipitado'? 'X':''?></div>
        <div style="position: absolute;top: 370px;left:253px;font-size: 11px;width: 250px;"><?=$cci['cci_pronostico']?></div>
    </div>
    
    <page_footer></page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CLASIFICACIÓN DE PACIENTES (TRIAGE).pdf');
?>