<?php ob_start(); ?>
<page backtop="65mm" backbottom="65mm" backleft="56" backright="15mm">
    <page_header>
        <style>
            table, td, th {text-align: left;}
            table {border-collapse: collapse;width: 100%;}
            th, td {padding: 5px;}
        </style>
        <img src="assets/doc/sigh_430128_hf.png" style="position: absolute;width: 805px;margin-top: 0px;margin-left: -10px;">
        
        <div style="width: 270px;margin-top: 45px;margin-left: 40px;position: absolute">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 10px;margin-bottom: 0px">NOTAS MÉDICAS Y PRESCRIPCIONES</p>
                    </td>
                    <td style="width: 10%;text-align: right">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                 </tr>
             </table>
        </div>
        <div style="position: absolute;margin-top: -50px">
            <div style="position: absolute;margin-left: 435px;margin-top: 105px;width: 270px;text-transform: uppercase;font-size: 20px;text-align: left;">
                <b><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?></b>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 150px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>R.F.C:</b> <?=$info['paciente_rfc']?>
            </div>
            <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn'])); ?>
            <div style="position: absolute;margin-left: 437px;margin-top: 166px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -2px">
                    <b>EDAD:</b> <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
                </p>
                <p style="margin-top: -10px">
                    <b>C.M.F:</b> <?=$info['info_umf']?>
                </p>
                <p style="margin-top: -10px">
                    <b><?=$hoja['hf_atencion']?></b> 
                </p>
                
            </div>
            <div style="position: absolute;margin-left: 540px;margin-top: 166px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -2px">
                    <b>FOLIO:</b> <?=$info['ingreso_id']?>
                </p>
                <p style="margin-top: -10px">
                    <b>PROCEDE:</b> <?=$info['info_procedencia_esp']=='Si' ? 'ESPONTANEO' : 'REFERENCIADO'?>
                </p>
                <p style="margin-top: -10px">
                    <b>HORA CERO:</b> <?=$info['ingreso_date_horacero']?> <?=$info['ingreso_time_horacero']?>
                </p>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 205px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <p style="margin-top: -1px">
                    <b>MÉD.:</b> <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?> <?=$Medico['empleado_matricula']?>
                </p>
                <?php if($info['ingreso_am']!=''){?>
                <p style="margin-top: -9px">
                    <b>AM:</b> <?=$AsistenteMedica['empleado_nombre']?> <?=$AsistenteMedica['empleado_ap']?> <?=$AsistenteMedica['empleado_am']?>
                </p>
                <p style="margin-top: -11px">
                    <b>HORA A.M:</b> <?=$am['asistentesmedicas_fecha']?> <?=$am['asistentesmedicas_hora']?>
                </p>
                <?php } ?>
            </div>
            <div style="position: absolute;margin-left: 437px;margin-top: 263px;width: 270px;text-transform: uppercase;font-size: 11px;">
                <b>HOJA FRONTAL</b>
            </div>
            
            <div style="position: absolute;margin-top:229px;margin-left: 134px ">
                <?php 
                $sqlChoque=$this->config_mdl->_get_data_condition('sigh_choque',array(
                    'ingreso_id'=>$info['ingreso_id']
                ));
                $sqlObs=$this->config_mdl->_get_data_condition('sigh_observacion',array(
                    'ingreso_id'=>$info['ingreso_id']
                ));
                if(empty($sqlChoque)){
                    echo $this->config_mdl->_get_data_condition('sigh_camas',array(
                        'cama_id'=>$sqlObs[0]['observacion_cama']
                    ))[0]['cama_nombre'];
                }else{
                    echo $this->config_mdl->_get_data_condition('sigh_camas',array(
                        'cama_id'=>$sqlChoque[0]['cama_id']
                    ))[0]['cama_nombre'];
                }
                ?>
            </div>
            <div style="position: absolute;margin-top:228px;margin-left: 44px;text-transform: uppercase ">
                <b>CLASIFICACIÓN:</b> <?=$info['ingreso_clasificacion']?>
            </div>
            <div style="position: absolute;margin-top:224px;margin-left: 382px ">:[[page_cu]]/[[page_nb]]</div>
            
            <div style="position: absolute;margin-left: 50px;margin-top: 276px;width: 150px;font-size: 7px;text-align: center;">
                <h6><b>FECHA DE CREACIÓN DOCUMENTO MÉDICO:</b> <?=$hoja['hf_fg']?> <?=$hoja['hf_hg']?></h6>
            </div>
            <div style="position: absolute;margin-left: 66px;margin-top: 320px;width: 130px;font-size: 12px;text-align: center">
                
                <h4>Tensión Arterial</h4>
                <h1 style="margin-top: -10px"><?=$SignosVitales['sv_ta']?></h1>
                <br><br>
                <h4>Temperatura</h4>
                <h1 style="margin-top: -10px"><?=$SignosVitales['sv_temp']?> °C</h1>
                <br><br>
                <h4>Frecuencia Cardiaca</h4>
                <h1 style="margin-top: -10px"><?=$SignosVitales['sv_fc']?> X Min</h1>
                
                <h4>Frecuencia Respiratoria</h4>
                <h1 style="margin-top: -10px"><?=$SignosVitales['sv_fr']?> X Min</h1>
            </div>
            <div style="rotate: 90; position: absolute;margin-left: 50px;margin-top: 336px;text-transform: uppercase;font-size: 12px;">
                <?=$Enfermera['empleado_nombre']?> <?=$Enfermera['empleado_ap']?> <?=$Enfermera['empleado_am']?> <?=$info['ingreso_enfermera']?> <br><br><br>
            </div>
            <div style="position: absolute;top: 910px;left: 215px;width: 240px;font-size: 9px;text-align: center">
                <?=$Medico['empleado_nombre']?> <?=$Medico['empleado_ap']?> <?=$Medico['empleado_am']?><br>
                <span style="margin-top: -6px;margin-bottom: -8px">____________________________________</span><br>
                <b>NOMBRE DEL MÉDICO</b>
            </div>
            <div style="position: absolute;top: 910px;left: 480px;width: 110px;font-size: 9px;text-align: center">
                <?=$Medico['empleado_matricula']?> <br>
                <span style="margin-top: -6px;margin-bottom: -8px">_________________</span><br>
                <b>MATRICULA</b>
            </div>
            <div style="position: absolute;top: 910px;left: 590px;width: 110px;font-size: 9px;text-align: center">
                <br>
                <span style="margin-top: -6px;margin-bottom: -8px">_________________</span><br>
                <b>FIRMA</b>
            </div>
            <div style="margin-left: 280px;margin-top: 980px">
                <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 40px;" ></barcode>
            </div>
            
        </div>   
        
    </page_header>
    <div style="font-size: 12px;">
        <?php if($info['ingreso_am']!=''){?>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>DOMICILIO: </b> <?=$DirPaciente['directorio_cn']?> <?=$DirPaciente['directorio_colonia']?> <?=$DirPaciente['directorio_cp']?> <?=$DirPaciente['directorio_municipio']?> <?=$DirPaciente['directorio_estado']?>
        </p>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>EN CASO NECESARIO LLAMAR: </b> <?=$info['info_responsable_nombre']?> <?php if($info['info_responsable_parentesco']!=''){?>(<?=$info['info_responsable_parentesco']?>)<?php }?>
        </p>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>TELEFONO: </b> <?=$info['info_responsable_telefono']=='' ? 'Sin Especificar' : $info['info_responsable_telefono']?>
        </p>
        <?php }?>
        <?php if($info['info_lugar_accidente']=='TRABAJO'){ ?>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>EMPRESA: </b> <?=$Empresa['empresa_nombre']?>
        </p>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>DOMICILIO DE LA EMPRESA: </b> <?=$DirEmpresa['directorio_cn'].' '.$DirEmpresa['directorio_colonia'].' '.$DirEmpresa['directorio_cp'].' '.$DirEmpresa['directorio_municipio'].' '.$DirEmpresa['directorio_estado'];?>
        </p>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>TELEFONO DE LA EMPRESA: </b> <?=$DirEmpresa['directorio_telefono']=='' ? 'Sin Especificar': $DirEmpresa['directorio_telefono']?>
        </p>
        <?php }?>
        <?php if($info['ingreso_am']!=''){?>
        <p style="margin-top: -10px;text-transform: uppercase">
            <b>FECHA & HORA DE ACCIDENTE: </b> <?=$info['info_fecha_accidente']?> <?=$info['info_hora_accidente']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>LUGAR: </b> <?=$info['info_lugar_accidente']?>
        </p>
        <p style="margin-top: -10px;;text-transform: uppercase">
            <b>PROCEDENCIA: </b> <?=$info['info_lugar_procedencia']?>
        </p>
        <?php }?>
    </div>
    <span style="text-align: justify">
        <?php if($hoja['hf_motivo']!=''){?>
        <h3 style="margin-bottom: -6px">MOTIVO DE URGENCIA</h3>
        <?=$hoja['hf_motivo']?>
        <br>
        <?php }?>
        <?php if($hoja['hf_mecanismolesion']!='' || $hoja['hf_mecanismolesion_otros'])?>
        <h3 style="margin-bottom: -6px">MECANISMO DE LESIÓN</h3>
        <?=$hoja['hf_mecanismolesion']?> <?=$hoja['hf_mecanismolesion_otros']?><br>
        <?=$hoja['hf_mecanismolesion_mtrs']!='' ? 'Caida '.$hoja['hf_mecanismolesion_mtrs'].' Metros':'' ?>
        <br>
        <?php if($hoja['hf_quemadura']!='' || $hoja['hf_quemadura_otros']!=''){?>
        <h3 style="margin-bottom: -6px;" >QUEMADURAS</h3>
        <?=$hoja['hf_quemadura']?> <?=$hoja['hf_quemadura_otros']?> 
        <br>
        <?php }?>
        <h3 style="margin-bottom: -6px">ANTECEDENTES</h3>
        <?=$hoja['hf_antecedentes']?>
        <br>
        <h3 style="margin-bottom: -6px">EXPLORACIÓN FÍSICA</h3>
        <?=$hoja['hf_exploracionfisica']?>
        <br>
        <h3 style="margin-bottom: -6px">INTERPRETACIÓN</h3>
        <?=$hoja['hf_interpretacion']?>
        <br>
        <h3 style="margin-bottom: -6px">DIAGNÓSTICOS</h3>
        <?=$hoja['hf_diagnosticos']?>
        <br>
        <?php if(!empty($Dxs)){?>
        <table class="table" style="width: 100%;margin-top: 0px;">
            <tbody>
                <?php foreach ($Dxs as $value) {?>
                <tr>
                    <td style="width: 100%;text-transform: uppercase;line-height: 1.4">
                        <span<b>TIPO:</b> <?=$value['dx_tipo']?><br>
                        <b>DX: </b><?=$value['dx_dx']?><br>
                        <b>CIE10: </b> <?=$value['id10']?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
       
        <br>
        <?php }?>
        
        <?php if($hoja['hf_trataminentos']!='' && $hoja['hf_trataminentos_otros']!=''){?>
        <h3 style="margin-bottom: -6px">TRATAMIENTOS</h3>
        <?=$hoja['hf_trataminentos']?> 
        <?=$hoja['hf_trataminentos_otros']!='' ? ' '.$hoja['hf_trataminentos_otros'] : ''?> <?=$hoja['hf_trataminentos_por']!='' ? ' POR:'.$hoja['hf_trataminentos_por'].' Dias' : ''?>
        <br>
        <?php }?>
        <h3 style="margin-bottom: -6px">RECETA POR</h3>
        <?=$hoja['hf_receta_por']?>
        <br>
        <h3 style="margin-bottom: -6px">INDICACIONES</h3>
        <?=$hoja['hf_indicaciones']?>
        <?php if($hoja['hf_ministeriopublico']=='Si'){?>
        <br>
        <h3 style="margin-bottom: -6px">NOTIFICACIÓN AL MINISTERIO PUBLICO: <?=$hoja['hf_ministeriopublico']=='Si' ? 'Si' : 'No'?></h3>
        <?php }?>
        <br>
        <h3 style="margin-bottom: -6px">AMERITA INCAPACIDAD: <?=$am['asistentesmedicas_incapacidad_am']?></h3>
        <?php if($am['asistentesmedicas_incapacidad_am']=='Si'){?>
        <b>Tipo de Incapacidad: </b><?=$am['asistentesmedicas_incapacidad_tipo']?><br>
        <?=$am['asistentesmedicas_incapacidad_folio']!='' ? '<b>Folio: </b>'.$am['asistentesmedicas_incapacidad_folio'].'<br>' : ''?>
        <?=$am['asistentesmedicas_incapacidad_fi']!='' ? '<b>Fecha de Inicio de Incapacidad: </b>'.$am['asistentesmedicas_incapacidad_fi'].'<br>' : ''?>
        <?=$am['asistentesmedicas_incapacidad_da']!='' ? '<b>Dias Autorizados: </b>'.$am['asistentesmedicas_incapacidad_da'].'<br>' : ''?>
        <?php }?>
    </span>
    <page_footer>

    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('HOJA FONTRAL');
    $pdf->Output($Nota['notas_tipo'].'.pdf');
?>