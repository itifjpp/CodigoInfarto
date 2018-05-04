<?php ob_start(); ?>
<page>
    <page_header>
        <img src="assets/doc/sighFichaResidentes.png" style="position: absolute;width: 100%;margin-top: -20px;margin-left: -5px;">
        <div style="position: absolute;top: 140px">
            <?php if(file_exists('assets/img/perfiles/'.$info['empleado_image_credencial']) && $info['empleado_image_credencial']!=''){?>
            <img src="assets/img/perfiles/<?=$info['empleado_image_credencial']?>" style="width: 120px;margin-top: 49px;margin-left: 37.5px">
            <?php }else{?>
            <img src="assets/img/perfiles/default_.png" style="width: 140px;margin-top: 55px;margin-left: 30px">
            <?php }?>
            <div style="position: absolute;margin-top: 53px;margin-left: 225px;font-size: 12px"><?=$info['empleado_nombre']?> <?=$info['empleado_ap']?> <?=$info['empleado_am']?></div>
            
            <div style="position: absolute;margin-top: 80px;margin-left: 207px;font-size: 12px"><?=$info['empleado_curp']?></div>
            <?php 
            if($info['empleado_fn']!=''){
                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['empleado_fn'])); 
            }       
            ?>
            <div style="position: absolute;margin-top: 80px;margin-left: 488px;font-size: 12px"><?=$fecha->y?> Años</div>
            
            <div style="position: absolute;margin-top: 106px;margin-left: 200px;font-size: 12px"><?=$info['empleado_sexo']=='M' ?'Hombre':'Mujer'?></div>
            <div style="position: absolute;margin-top: 106px;margin-left: 510px;font-size: 12px"><?=$info['empleado_estadocivil']?></div>
            
            <div style="position: absolute;margin-top: 133px;margin-left: 300px;font-size: 12px"><?=$info['empleado_fn']?></div>
            <div style="position: absolute;margin-top: 133px;margin-left: 582px;font-size: 12px"><?=$info['empleado_lugar_nac']?></div>
            
            <div style="position: absolute;margin-top: 159px;margin-left: 254px;font-size: 12px"><?=$info['empleado_nacionalidad']?></div>
            <div style="position: absolute;margin-top: 159px;margin-left: 510px;font-size: 12px">S/E</div>
            
            <div style="position: absolute;margin-top: 186px;margin-left: 80px;font-size: 12px"><?=$Ropa['ropa_talla']?></div>
            <div style="position: absolute;margin-top: 186px;margin-left: 210px;font-size: 12px"><?=$Ropa['ropa_saco']?></div>
            <div style="position: absolute;margin-top: 186px;margin-left: 420px;font-size: 12px"><?=$Ropa['ropa_tipo']?></div>
            <div style="position: absolute;margin-top: 186px;margin-left: 590px;font-size: 12px"><?=$Ropa['ropa_calzado']?></div>
            
            <div style="position: absolute;margin-top: 212px;margin-left: 140px;font-size: 12px"><?=$Directorio['directorio_email']?></div>
            
            <?php 
            $font_calle1='';
            $mt_calle1='';
            
            if(strlen($Directorio['directorio_calle'])>=20){
                $font_calle1='10';
                $mt_calle1='273';
            }else{
                $font_calle1='12px';
                $mt_calle1='281';
            }
            $font_colonia1='';
            $mt_colonia1='';
            if(strlen($Directorio['directorio_colonia'])>=20){
                $font_colonia1='10';
                $mt_colonia1='273';
            }else{
                $font_colonia1='12px';
                $mt_colonia1='281';
            }
            $font_municipio='';
            $mt_municipio='';
            if(strlen($Directorio['directorio_municipio'])>=20){
                $font_municipio='10';
                $mt_municipio='273';
            }else{
                $font_municipio='12px';
                $mt_municipio='281';
            }
            ?>
            <div style="position: absolute;margin-top: <?=$mt_calle1?>px;margin-left: 75px;font-size: <?=$font_calle1?>px;width: 180px;"><?=$Directorio['directorio_calle']?></div>
            <div style="position: absolute;margin-top: <?=$mt_colonia1?>px;margin-left: 310px;font-size: <?=$font_colonia1?>px;width: 155px;"><?=$Directorio['directorio_colonia']?></div>
            <div style="position: absolute;margin-top: <?=$mt_municipio?>px;margin-left: 555px;font-size: <?=$font_municipio?>px;width: 140px;"><?=$Directorio['directorio_municipio']?></div>
            
            <div style="position: absolute;margin-top: 306px;margin-left: 92px;font-size: 12px"><?=$Directorio['directorio_estado']?></div>
            <div style="position: absolute;margin-top: 306px;margin-left: 310px;font-size: 12px"><?=$Directorio['directorio_cp']?></div>
            <div style="position: absolute;margin-top: 306px;margin-left: 520px;font-size: 12px"><?=$Directorio['directorio_telefono']?></div>
            
            <div style="position: absolute;margin-top: 372px;margin-left: 105px;font-size: 12px"><?=$Familiar['familiar_nombre']?> <?=$Familiar['familiar_apellidos']?></div>
            <div style="position: absolute;margin-top: 372px;margin-left: 565px;font-size: 12px"><?=$Familiar['familiar_parentesco']?></div>
            <?php 
            $font_calle2='';
            $mt_calle2='';
            if(strlen($Directorio2['directorio_calle'])>=20){
                $font_calle2='10';
                $mt_calle2='390';
            }else{
                $font_calle2='12px';
                $mt_calle2='397';
            }
            $font_colonia2='';
            $mt_colonia2='';
            if(strlen($Directorio2['directorio_colonia'])>=20){
                $font_colonia2='10';
                $mt_colonia2='390';
            }else{
                $font_colonia2='12px';
                $mt_colonia2='397';
            }
            $font_municipio2='';
            $mt_municipio2='';
            if(strlen($Directorio2['directorio_municipio'])>=20){
                $font_municipio2='10';
                $mt_municipio2='390';
            }else{
                $font_municipio2='12px';
                $mt_municipio2='397';
            }
            ?>
            <div style="position: absolute;margin-top: <?=$mt_calle2?>px;margin-left: 75px;font-size: <?=$font_calle2?>px;width: 180px;"><?=$Directorio2['directorio_calle']?></div>
            <div style="position: absolute;margin-top: <?=$mt_colonia2?>px;margin-left: 310px;font-size: <?=$font_colonia2?>px;width: 155px;"><?=$Directorio2['directorio_colonia']?></div>
            <div style="position: absolute;margin-top: <?=$mt_municipio2?>px;margin-left: 555px;font-size: <?=$font_municipio2?>px;width: 140px;"><?=$Directorio2['directorio_municipio']?></div>
            
            <div style="position: absolute;margin-top: 424px;margin-left: 92px;font-size: 12px"><?=$Directorio2['directorio_estado']?></div>
            <div style="position: absolute;margin-top: 424px;margin-left: 320px;font-size: 12px"><?=$Directorio2['directorio_cp']?></div>
            <div style="position: absolute;margin-top: 424px;margin-left: 520px;font-size: 12px"><?=$Directorio2['directorio_telefono']?></div>
            <?php 
            $font_universidad='';
            $mt_universidad='';
            
            $font_especialidad='';
            $mt_especialidad='';
            if(strlen($ua['eua_universidad'])>=20){
                $font_universidad='10';
                $mt_universidad='485';
            }else{
                $mt_universidad='491';
                $font_universidad='12';
            }
            
            if(strlen($ua['eua_especialidad'])>=25){
                $font_especialidad='10';
                $mt_especialidad='485';
            }else{
                $mt_especialidad='491';
                $font_especialidad='12';
            }
            ?>
            <div style="position: absolute;margin-top: <?=$mt_universidad?>px;margin-left: 220px;font-size: <?=$font_universidad?>px;width: 220px;">
                <?=$ua['eua_universidad'] ?>
            </div>
            <div style="position: absolute;margin-top:  <?=$mt_especialidad?>px;margin-left: 520px;font-size: <?=$font_especialidad?>px;;width: 160px;"><?=$ua['eua_especialidad']?></div>
            
            <div style="position: absolute;margin-top: 518px;margin-left: 195px;font-size: 12px"><?=$ua['eua_promedio']?></div>
            <div style="position: absolute;margin-top: 518px;margin-left:614px;font-size: 12px"><?=$info['empleado_ingreso']?></div>
            
            <div style="position: absolute;margin-top: 544px;margin-left:220px;font-size: 12px"><?=$ua['eua_examen_ingles']?></div>
            <div style="position: absolute;margin-top: 544px;margin-left:520px;font-size: 12px"><?=$ua['eua_examen_ingles_cal']?></div>
            
            <?php foreach ($Documentos as $docs) {?>
            <div style="position: absolute;margin-top: 618px;margin-left:192px;font-size: 12px"><?=$docs['documento_tipo']=='OFICIO DE PRESENTACIÓN'? 'X':''?></div>
            <div style="position: absolute;margin-top: 618px;margin-left:420px;font-size: 12px"><?=$docs['documento_tipo']=='CONSTANCIA DE NO INHABILITACIÓN'? 'X':''?></div>
            <div style="position: absolute;margin-top: 618px;margin-left:538px;font-size: 12px"><?=$docs['documento_tipo']=='CURP'? 'X':''?></div>
            <div style="position: absolute;margin-top: 618px;margin-left:670px;font-size: 12px"><?=$docs['documento_tipo']=='CALIFICACIONES'? 'X':''?></div>
            
            <div style="position: absolute;margin-top: 645px;margin-left:192px;font-size: 12px"><?=$docs['documento_tipo']=='ACTA DE NACIMIENTO'? 'X':''?></div>
            <div style="position: absolute;margin-top: 645px;margin-left:420px;font-size: 12px"><?=$docs['documento_tipo']=='CONSTANCIA DE SERVICIO SOCIAL'? 'X':''?></div>
            <div style="position: absolute;margin-top: 645px;margin-left:538px;font-size: 12px"><?=$docs['documento_tipo']=='TITULO PROFESIONAL'? 'X':''?></div>
            <div style="position: absolute;margin-top: 645px;margin-left:670px;font-size: 12px"><?=$docs['documento_tipo']=='CEDULA PROFESIONAL'? 'X':''?></div>
            
            <div style="position: absolute;margin-top: 670px;margin-left:192px;font-size: 12px"><?=$docs['documento_tipo']=='CONSTANCIA DE INFOSAT'? 'X':''?></div>
            <div style="position: absolute;margin-top: 670px;margin-left:420px;font-size: 12px"><?=$docs['documento_tipo']=='ACTA DE EXAMEN PROFESIONAL'? 'X':''?></div>
            <div style="position: absolute;margin-top: 670px;margin-left:670px;font-size: 12px"><?=$docs['documento_tipo']=='CURRICULUM VITAE'? 'X':''?></div>
            
            <div style="position: absolute;margin-top: 695px;margin-left:192px;font-size: 12px"><?=$docs['documento_tipo']=='CONSTANCIA DE ENARM'? 'X':''?></div>
            <div style="position: absolute;margin-top: 695px;margin-left:420px;font-size: 12px"><?=$docs['documento_tipo']=='CONSTANCIA DE INTERNADO'? 'X':''?></div>
            <div style="position: absolute;margin-top: 695px;margin-left:670px;font-size: 12px"><?=$docs['documento_tipo']=='6 FOTOS TAMAÑO INFANTIL A COLOR'? 'X':''?></div>
            
            
            <?php }?>
        </div> 
    </page_header>
    <page_footer></page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('FICHA DE INGRESO DE MÉDICO RESIDENTE');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('FICHA DE INGRESO DE MÉDICO RESIDENTE.pdf');
?>