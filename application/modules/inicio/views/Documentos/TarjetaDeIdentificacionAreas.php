<?php ob_start(); ?>
<page backtop="85mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/doc/TI_PISOS.png" style="position: absolute;width: 100%;margin-top: 46px;margin-left: -5px;">
        <div style="position: absolute;margin-top: 60px">
            <div style="position: absolute;top: -16px;background: black;color:white;padding: 5px 0px 5px 0px;width: 680px;height: 10px;left: 40px;text-align: center;border-radius: 5px;text-transform: uppercase;font-weight: bold">
                COLOR DE CLASIFICACIÓN: <?=$info['triage_color']?>
            </div>
            <?php 
            $sqlPUM=$this->config_mdl->_get_data_condition('paciente_info',array(
                'triage_id'=>$info['triage_id']
            ))[0];
            ?>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['triage_fecha_nac'])); ?>
            <div style="position: absolute;top: 40px;left: 625px;font-size: 40px;width: 90px;padding: 2px;text-align: center;">
                <b><?=$cama['cama_nombre']?></b>
            </div>
            <div style="position: absolute;top: 146px;left: 38px;font-size: 12px;text-transform: uppercase">
                <b>SERVICIO: <?=$cama['area_nombre']?></b>
            </div>
            <div style="position: absolute;top: 146px;left: 418px;font-size: 12px;text-transform: uppercase;width: 300px;text-align: right">
                <b>FECHA Y ÁREA DE INGRESO: <?=$areas['ap_f_ingreso']?> <?=$choque['ap_h_ingreso']?></b>
            </div>
            <div style="position: absolute;top: 164px;left: 38px;font-size: 20px;text-transform: uppercase">
                <b>N.S.S: <?=$sqlPUM['pum_nss']?> <?=$sqlPUM['pum_nss_agregado']?></b>
            </div>
            <div style="position: absolute;top: 164px;left: 418px;font-size: 20px;text-transform: uppercase;width: 300px;text-align: right">
                <b>EDAD: <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS' ?></b>
            </div>
            
            
            
            <div style="position: relative;margin-top: 200px;margin-left: 34px">
                <div style="margin-left: -5px;font-size: 50px;text-transform: uppercase;padding: 0px;text-align: left;width: 690px">
                    <b>
                        <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?>
                    </b>
                </div>
                <div style="font-size: 12px;text-transform: uppercase;width: 400px;margin-top: 10px">
                    <b>ENFERMEDADES CRONICODEGENERATIVAS:</b> <?=$tarjeta['ti_enfermedades']?>
                </div>
                <div style="margin-top:10px;font-size: 12px;text-transform: uppercase;width: 400px;">
                    <b>ALERGIAS:</b> <?=$tarjeta['ti_alergias']?>
                </div>
                <div style="margin-top:10px;font-size: 10px;text-transform: uppercase;width: 400px;">
                    <b>DIAGNOSTICOS: </b><?=$hojafrontal['hf_diagnosticos']?>
                </div>
                <div style="margin-top: 70px">
                    <div style="margin-left: 260px;">
                        <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 40px;" ></barcode>
                    </div>
                </div>
                <style>
                    .circulo{width: 90px;height: 90px;border-radius: 47px;position: absolute;border:2px solid black;top: 140px;left: 470px;}
                </style>
                <div class="circulo"></div>
                <div style="position: absolute;top: 240px;left: 460px;font-size: 9px">RIESGOS POR ULCERAS</div>
                <div style="position: absolute;top: 240px;left: 590px;font-size: 9px">RIESGO DE CAIDAS</div>
                <img src="assets/doc/Triangulo.png" style="position: absolute;top: 140px;left: 570px;width: 120px">
                
            </div>
            
            
        </div>
        <div style="position: absolute;top: 470px">
            
        </div>
    </page_header>
    
    <page_footer>
        
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('Tarjeta de Identificación');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Tarjeta de Identificación.pdf');
?>