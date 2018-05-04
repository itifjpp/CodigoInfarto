<?php ob_start(); ?>
<page backtop="20mm">
    <page_header>
        <img src="assets/doc/observacion/CIRUGIA_SEGURA.png" style="position: absolute;width: 100%;margin-top:20px;margin-left: -5px;">
        <style>
            table, td, th {border: 1px solid #ddd;text-align: left;
            }table {border-collapse: collapse;width: 100%;}
            th, td {padding: 15px;}
    </style>
    </page_header>
    <div style="position: absolute;top: 0px">
        <div style="position: absolute;top: -40px;left: 130px;font-size: 11px;width: 240px;padding-top: 5px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></div>
        <div style="position: absolute;top: -40px;left: 465px;font-size: 11px;width: 240px;padding-top: 5px"><?=  date('d/m/Y')?></div>
        
        <div style="position: absolute;top: -17px;left: 53px;font-size: 11px;width: 240px;padding-top: 5px">
            <?php
            $sqlPUM=$this->config_mdl->_get_data_condition('paciente_info',array(
                'triage_id'=>$triage['triage_id']
            ))[0];
            ?>
            <?=$sqlPUM['pum_nss']?> <?=$sqlPUM['pum_nss_agregado']?>
        </div>
        <div style="position: absolute;top: -17px;left: 260px;font-size: 11px;width: 240px;padding-top: 5px"><?=$triage['triage_nombre']?> <?=$triage['triage_nombre_ap']?> <?=$triage['triage_nombre_am']?></div>
        <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$triage['triage_fecha_nac'])); ?>
        <div style="position: absolute;top: 4px;left: 60px;font-size: 11px;width: 240px;padding-top: 5px"><?=$fecha->y?></div>
        
        <div style="position: absolute;top: 4px;left: 113px;font-size: 11px;padding-top: 5px"><?=$triage['triage_paciente_sexo']=='HOMBRE'? 'H': ''?></div>
        <div style="position: absolute;top: 4px;left: 130px;font-size: 11px;padding-top: 5px"><?=$triage['triage_paciente_sexo']=='MUJER'? 'M': ''?></div>
        <div style="position: absolute;top: 4px;left: 180px;font-size: 9px;padding-top: 5px"><?=$observacion['observacion_cama']?></div>
        <div style="position: absolute;top: 4px;left: 347px;font-size: 9px;padding-top: 5px"><?=  substr($cs['cirugiasegura_procedimiento'], 0,42 )?></div>
        <div style="position: absolute;top: 22px;left: 30px;font-size: 9px;padding-top: 5px"><?=  substr($cs['cirugiasegura_procedimiento'], 42,300 )?></div>
    </div>
    
    <page_footer></page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Cirugia Segura.pdf');
?>