<?php ob_start(); ?>
<page>
    <page_header>
        <img src="assets/doc/sigh_hojafrontal_am.png" style="position: absolute;width: 100%;margin-top: -15px;margin-left: -5px;">
    </page_header>
    <div style="position: absolute;">
        <div style="width: 700px;margin-top: -10px;margin-left: 20px;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: center;width: 80%">
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 3px;margin-bottom: 0px">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 3px;margin-bottom: 0px">UNIDAD DE ATENCIÓN MÉDICA</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: bold;margin-top: 3px;margin-bottom: 0px"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                    </td>
                    <td style="width: 10%;text-align: right">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 60px;"></qrcode>
                    </td>
                 </tr>
             </table>
         </div>
        <div style="position: absolute;top: 86px;left: 67px;font-size: 11px"><?= $info['ingreso_date_am']?></div>
        <div style="position: absolute;top: 86px;left: 250px;font-size: 11px"><?= $info['ingreso_time_am']?></div>
        <div style="position: absolute;top: 86px;left: 430px;font-size: 11px"></div>
        <div style="position: absolute;top: 86px;left: 580px;font-size: 11px"></div>
        <!--2 fila-->
        <div style="position: absolute;top: 106px;left: 80px;font-size: 11px;text-transform: uppercase">
            <?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?>
        </div>
        <div style="position: absolute;top: 106px;left: 417px;font-size: 11px;text-transform: uppercase">
            <?=$info['paciente_sexo']?>
        </div>
        <?php 
        $ObtenerEdad= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
        ?>
        <div style="position: absolute;top: 106px;left: 514px;font-size: 11px">
            <?=$ObtenerEdad->y?>
        </div>
        <div style="position: absolute;top: 106px;left: 575px;font-size: 11px">
            <?=$ObtenerEdad->m?> 
        </div>
        <!--3 fila-->
        <div style="position: absolute;top: 126px;left: 109px;font-size: 11px;;text-transform: uppercase">
            <?=$info['paciente_nss']!='' ? $info['paciente_nss'].' - '.$info['paciente_nss_agregado'] : $info['paciente_nss_armado']?>
        </div>
        <div style="position: absolute;top: 126px;left: 435px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_umf']?>
        </div>
        <div style="position: absolute;top: 146px;left: 85px;font-size: 11px;text-transform: uppercase">
            <?=$DirPaciente['directorio_cn']?> <?=$DirPaciente['directorio_colonia']?> <?=$DirPaciente['directorio_cp']?> <?=$DirPaciente['directorio_municipio']?> <?=$DirPaciente['directorio_estado']?> 
        </div>  
        <div style="position: absolute;top: 165px;left: 186px;font-size: 11px;;text-transform: uppercase">
            <?=$info['info_responsable_nombre']?> <?=$info['info_responsable_parentesco']!='' ? '(' .$info['info_responsable_parentesco'].')' : ''?>
        </div>
        <div style="position: absolute;top: 165px;left: 500px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_responsable_telefono']?>
        </div>
        <div style="position: absolute;top: 185px;left: 80px;font-size: 11px;text-transform: uppercase">
            <?=  substr($Empresa['empresa_nombre'], 0,50)?>
        </div>
        <?php 
        $DirecccionEmpresa=$DirEmpresa['directorio_cn'].' '.$DirEmpresa['directorio_colonia'].' '.$DirEmpresa['directorio_cp'].' '.$DirEmpresa['directorio_municipio'].' '.$DirEmpresa['directorio_estado'];
        if(strlen($DirecccionEmpresa)>=54){
        ?>
        <div style="position: absolute;top: 178px;left: 400px;font-size: 9px;text-transform: uppercase;width: 310px;">
            <?=$DirecccionEmpresa?>
        </div>
        <?php }else{?>
        <div style="position: absolute;top: 185px;left: 400px;font-size: 10px;text-transform: uppercase;">
            <?=$DirecccionEmpresa?>
        </div>
        <?php }?>
        <div style="position: absolute;top: 205px;left: 130px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_mt']?>
        </div>
        <div style="position: absolute;top: 205px;left: 505px;font-size: 11px;text-transform: uppercase">
            <?=$am['empleado_nombre']?> <?=$am['empleado_ap']?> <?=$am['empleado_am']?>
        </div>
        <div style="position: absolute;top: 245px;left: 135px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_fecha_accidente']?>
        </div>
        <div style="position: absolute;top: 245px;left: 263px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_hora_accidente']?>
        </div>
        <div style="position: absolute;top: 245px;left: 380px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_lugar_accidente']?>
        </div>
        <div style="position: absolute;top: 245px;left: 554px;font-size: 11px;text-transform: uppercase">
            <?=$info['info_lugar_procedencia']?>
        </div> 
        <div style="position: absolute;left: 280px;top: 980px">
            <barcode type="C128A" value="<?=$info['ingreso_id']?>" style="height: 20px;" ></barcode>
        </div>
    </div>
    <page_footer></page_footer>    
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('HOJA FRONTAL EMITIDA POR AM');
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('HOJA FRONTAL EMITIDA POR AM.pdf');
?>