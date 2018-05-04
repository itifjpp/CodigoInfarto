<?php ob_start(); ?>
<page backtop="15mm">
    <page_header></page_header>
    <div style="position: absolute;">
        <img src="assets/doc/ST7/sigh_st7_1.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
        <div style="width: 310px;margin-top: 30px;margin-left: 20px;position: absolute;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="width: 90%">
                        <p style="text-transform: uppercase;font-size: 10px;font-weight: bold;margin: 0px;line-height: 1.2;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 9px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;line-height: 1.2;text-align: left">DIRECCIÓN DE PRESTACIONES ECONÓMICAS Y SOCIALES</p>
                        <p style="text-transform: uppercase;font-size: 9px;font-weight: 300;margin-top: 2px;margin-bottom: 0px;line-height: 1.2;text-align: left">COORDINACIÓN DE SALUD EN EL TRABAJO</p>
                        <p style="text-transform: uppercase;font-size: 9px;font-weight: 300;margin-top: 8px;margin-bottom: 0px;line-height: 1.2;text-align: left">AVISO DE ATENCIÓN MÉDICA INICIAL Y CALIFICACIÓN DE PROBABLE ACCIDENTE DE TRABAJO ST-7</p>
                    </td>
                 </tr>
             </table>
         </div>
        <div style="position: absolute;top: 48px;left: 395px;font-size: 8px"><?=$Empresa['empresa_nombre']?></div>
        <div style="position: absolute;top: 70px;left: 395px;font-size: 8px"><?=$DirEmpresa['directorio_cn']?></div>
        <div style="position: absolute;top: 101px;left: 393px;font-size: 8px;width: 320px;">
            <?=$DirEmpresa['directorio_colonia']?> <?=$DirEmpresa['directorio_municipio']?> <?=$DirEmpresa['directorio_estado']?>
        </div>
        <?php 
        $ObtenerEdad= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
        ?>
        <div style="position: absolute;top: 146px;left: 26px;font-size: 12px"><b><?php if($ST7_FOLIO['st7_folio_id']!=''){?>FOLIO: <?=$ST7_FOLIO['st7_folio_id']?><?php }?></b></div>
        <div style="position: absolute;top: 128px;left: 395px;font-size: 8px"><?=$DirEmpresa['directorio_cp']?></div>
        <div style="position: absolute;top: 128px;left: 580px;font-size: 8px"><?=$DirEmpresa['directorio_telefono']?></div>
        <div style="position: absolute;top: 148px;left: 395px;font-size: 8px"><?=$Empresa['empresa_rp']?></div>
        
        <div style="position: absolute;top: 170px;left: 32px;font-size: 8px"><?=$info['paciente_nss']?> <?=$info['paciente_nss_agregado']?></div>
        <div style="position: absolute;top: 170px;left: 255px;font-size: 8px;text-transform: uppercase"><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?></div>
        
        <div style="position: absolute;top: 192px;left: 32px;font-size: 8px"><?=$info['info_identificacion']?></div>
        <div style="position: absolute;top: 192px;left: 367px;font-size: 8px"><?=$info['paciente_curp']?></div>
        <div style="position: absolute;top: 192px;left: 663px;font-size: 8px"><?=$ObtenerEdad->y?> Años</div>
        
        <div style="position: absolute;top: 214px;left: 45px;font-size: 8px">
        <?=$info['paciente_sexo']=='HOMBRE' ? 'X' :''?>
        </div>
        <div style="position: absolute;top: 214px;left: 72px;font-size: 8px">
        <?=$info['paciente_sexo']=='MUJER' ? 'X' :''?>
        </div>
        <div style="position: absolute;top: 219px;left: 105px;font-size: 8px"><?=$info['paciente_estadocivil']?></div>
        <div style="position: absolute;top: 219px;left: 196px;font-size: 8px"><?=$DirPaciente['directorio_cn']?></div>
        <div style="position: absolute;top: 219px;left: 500px;font-size: 8px"><?=$DirPaciente['directorio_colonia']?></div>
        <div style="position: absolute;top: 252px;left: 32px;font-size: 8px"><?=$DirPaciente['directorio_municipio']?> <?=$DirPaciente['directorio_estado']?></div>
        <div style="position: absolute;top: 252px;left: 410px;font-size: 8px"><?=$DirPaciente['directorio_telefono']?></div>
        <div style="position: absolute;top: 252px;left: 510px;font-size: 8px"><?=$DirPaciente['directorio_cp']?></div>
        <div style="position: absolute;top: 252px;left: 615px;font-size: 8px;width: 100px"><?=$info['info_umf']?></div>
        <div style="position: absolute;top: 290px;left: 32px;font-size: 8px;width: 68px;"><?=$info['info_delegacion']?></div>
        <div style="position: absolute;top: 290px;left: 110px;font-size: 8px;width: 85px;"><?=$info['info_dia_pa']?></div>
        <div style="position: absolute;top: 290px;left: 225px;font-size: 8px"><?=$Empresa['empresa_he']?> - <?=$Empresa['empresa_hs']?></div>
        <div style="position: absolute;top: 298px;left: 330px;font-size: 8px"><?=  explode('/', $info['info_fecha_accidente'])[0]?></div>
        <div style="position: absolute;top: 298px;left: 380px;font-size: 8px"><?=  explode('/', $info['info_fecha_accidente'])[1]?></div>
        <div style="position: absolute;top: 298px;left: 425px;font-size: 8px"><?=  explode('/', $info['info_fecha_accidente'])[2]?></div>
        <div style="position: absolute;top: 298px;left: 470px;font-size: 8px"><?=  $info['info_hora_accidente']?></div>
        <?php 
            $ingreso_am= explode(' ', $info['ingreso_date_am']);
        ?>
        <div style="position: absolute;top: 298px;left: 525px;font-size: 8px"><?=  explode('-', $ingreso_am[0])[2]?></div>
        <div style="position: absolute;top: 298px;left: 575px;font-size: 8px"><?=  explode('-', $ingreso_am[0])[1]?></div>
        <div style="position: absolute;top: 298px;left: 620px;font-size: 8px"><?=  explode('-', $ingreso_am[0])[0]?></div>
        <div style="position: absolute;top: 298px;left: 665px;font-size: 8px"><?=  $info['ingreso_time_am']?></div>
        
        <div style="position: absolute;top: 330px;left: 32px;font-size: 8px;width: 660px;text-align: justify;line-height: 1.5">
            <?=  $info['asistentesmedicas_da']?>
        </div>
        <div style="position: absolute;top: 410px;left: 32px;font-size: 8px;width: 660px;text-align: justify;line-height: 1.5">
            <?=  $info['asistentesmedicas_dl']?>
        </div>
        <div style="position: absolute;top: 510px;left: 32px;font-size: 8px;width: 660px;text-align: justify;line-height: 1.5">
            <?=  $hojafrontal['hf_diagnosticos']=='' ? $info['asistentesmedicas_ip'] : $hojafrontal['hf_diagnosticos']?>
        </div>
        <div style="position: absolute;top: 570px;left: 32px;font-size: 8px;width: 660px;text-align: justify;line-height: 1.5">
            <?=  $info['asistentesmedicas_tratamientos']?>
        </div>
        <div style="position: absolute;top: 634px;left: 225px;font-size: 8px;">
            <?=$info['asistentesmedicas_ss_in']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 634px;left: 296px;font-size: 8px;">
            <?=$info['asistentesmedicas_ss_in']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 634px;left: 530px;font-size: 8px;">
            <?=$info['asistentesmedicas_ss_ie']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 634px;left: 590px;font-size: 8px;">
            <?=$info['asistentesmedicas_ss_ie']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 670px;left: 224px;font-size: 8px;">
            <?=$info['asistentesmedicas_oc_hr']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 670px;left: 298px;font-size: 8px;">
            <?=$info['asistentesmedicas_oc_hr']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 668px;left: 334px;font-size: 8px;width: 368px">
            <?=$info['asistentesmedicas_am']?>
        </div>
        <div style="position: absolute;top: 717px;left: 140px;font-size: 8px;">
            <?=$info['asistentesmedicas_incapacidad_am']=='Si' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 717px;left: 190px;font-size: 8px;">
            <?=$info['asistentesmedicas_incapacidad_am']=='No' ? 'X' : ''?>
        </div>
        <div style="position: absolute;top: 720px;left: 230px;font-size: 8px;">
            <?= explode('/', $info['asistentesmedicas_incapacidad_fi'])[0]?>
        </div>
        <div style="position: absolute;top: 720px;left: 260px;font-size: 8px;">
            <?= explode('/', $info['asistentesmedicas_incapacidad_fi'])[1]?>
        </div>
        <div style="position: absolute;top: 720px;left: 290px;font-size: 8px;">
            <?= explode('/', $info['asistentesmedicas_incapacidad_fi'])[2]?>
        </div>
        <div style="position: absolute;top: 720px;left: 350px;font-size: 11px;">
            <?=$info['asistentesmedicas_incapacidad_folio']?>
        </div>
        <div style="position: absolute;top: 720px;left: 480px;font-size: 8px;">
            <?=$info['asistentesmedicas_incapacidad_da']!='' ?$info['asistentesmedicas_incapacidad_da'].' Dias' :'' ?>
        </div>
        <div style="position: absolute;top: 710px;left: 582px;font-size: 8px;width: 113px">
            <?=$ce['ce_hf']?>
        </div>
        <div style="position: absolute;top: 755px;left: 33px;font-size: 8px;width: 160px;">
            <?=$info['asistentesmedicas_mt']?>
        </div>
        <div style="position: absolute;top: 755px;left: 257px;font-size: 8px;width: 130px;">
            <?=$info['asistentesmedicas_mt_m']?>
        </div>
        <div style="position: absolute;top: 755px;left: 528px;font-size: 8px;width: 160px">
            <?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?><br>
        </div>
    </div>
</page>
<page pageset="old" >
    <div style="margin-top: 5px;font-size: 20px;font-weight: 200;width: 100%;margin-right: 20px;position: absolute">
        <img src="assets/doc/ST7/ST7_2.png" style="position: absolute;width: 100%;margin-top: 10px;margin-left: -5px;">
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','en','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('ST7 - '.$info['paciente_ap'].' '.$info['paciente_am'].' '.$info['paciente_nombre']);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('ST7.pdf');
?>