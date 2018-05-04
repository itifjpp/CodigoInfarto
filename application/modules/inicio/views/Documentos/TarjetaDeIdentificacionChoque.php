<?php ob_start(); ?>
<page backtop="85mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/doc/TARJETA_DE_IDENTIFICACION.png" style="position: absolute;width: 100%;margin-top: 0px;margin-left: -5px;">
        <div style="position: absolute;margin-top: 15px">
            <div style="position: absolute;top: -16px;background: black;color:white;padding: 5px 0px 5px 0px;width: 680px;height: 10px;left: 40px;text-align: center;border-radius: 5px;text-transform: uppercase;font-weight: bold">
                COLOR DE CLASIFICACIÓN: <?=$info['triage_color']?>
            </div>
            <?php 
            $sqlPUM=$this->config_mdl->_get_data_condition('paciente_info',array(
                'triage_id'=>$info['triage_id']
            ))[0];
            ?>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['triage_fecha_nac'])); ?>
            <div style="position: absolute;top: 40px;left: 625px;font-size: 20px;width: 90px;padding: 2px;text-align: center"><b><?=$cama['cama_nombre']?></b></div>
            <div style="position: absolute;top: 146px;left: 104px;font-size: 12px;text-transform: uppercase"><b><?=$cama['area_nombre']?></b></div>
            <div style="position: absolute;top: 146px;left: 564px;font-size: 12px;text-transform: uppercase"><b><?=$choque['choque_cama_fe']?> <?=$choque['choque_cama_he']?></b></div>
            <div style="position: absolute;top: 164px;left: 104px;font-size: 20px;text-transform: uppercase"><b><?=$sqlPUM['pum_nss']?> <?=$sqlPUM['pum_nss_agregado']?></b></div>
            <div style="position: absolute;top: 231px;left: 317px;font-size: 12px;text-transform: uppercase;width: 400px">
                <?=$tarjeta['ti_enfermedades']?>
            </div>
            <div style="position: absolute;top: 251px;left: 110px;font-size: 12px;text-transform: uppercase;width: 607px">
                <?=$tarjeta['ti_alergias']?>
            </div>
            <div style="position: absolute;top: 287px;left: 40px;font-size: 10px;text-transform: uppercase;width: 480px;">
                <?=$hojafrontal['hf_diagnosticos']?>
            </div>
            <div style="position: absolute;top: 194px;left: 34px;font-size: 25px;text-transform: uppercase">
                <b>
                    <?=$info['triage_nombre_ap']?> <?=$info['triage_nombre_am']?> <?=$info['triage_nombre']?> / <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS' ?>
                </b>
            </div>
            <style>
                .circulo{
                    /*background: red;*/
                    width: 40px;height: 40px;
                    border-radius: 22px;
                    position: absolute;
                    border:1px solid black;
                    top: 280px;
                    left: 550px;
                }
            </style>
            <div class="circulo"></div>
            <div style="position: absolute;top: 324px;left: 535px;font-size: 9px">Riesgo por Ulceras</div>
            <div style="position: absolute;top: 324px;left: 626px;font-size: 9px">Riesgo de Caidas</div>
            <img src="assets/doc/Captura.png" style="position: absolute;top: 270px;left: 630px;width: 60px">
        </div>
        <div style="position: absolute;top: 470px">
            <div style="margin-left: 280px;">
                <barcode type="C128A" value="<?=$info['triage_id']?>" style="height: 20px;" ></barcode>
            </div>
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