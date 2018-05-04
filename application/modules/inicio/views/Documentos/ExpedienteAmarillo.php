<?php ob_start(); ?>
<page backtop="0mm" backbottom="10mm" backleft="0">
    <page_header>
    </page_header>
        <div style="position: absolute;margin-top: 15px;margin-left:-10px">
            <div style="rotate:90;position:absolute;top:40px;font-size:55px;left:10px;width:430px;text-align:right;">
                <b><?=$PINFO['pum_nss']?></b><br>
                <b><?=$PINFO['pum_nss_agregado']?></b>
            </div>
            <?php
            $Nombre=$info['triage_nombre'];
            $Apellidos=$info['triage_nombre_ap'].' '.$info['triage_nombre_am'];
            if(strlen($Nombre)>=15){
                $FontSize='50px';
            }else{
                $FontSize='60px';
            }
            if(strlen($Apellidos)>16){
                $FontSizeA='25px';
            }else{
                $FontSizeA='25px';
            }
             ?>
            <div style="rotate:90;position:absolute;margin-top:480px;font-size:<?=$FontSize?>;left:10px;width:580px;">
                <b><?=$Nombre?></b>
            </div>
            <div style="position:absolute;margin-top:260px;font-size:25px;left:205px;width:500px;text-align: center">
                <b>C.U.R.P: <?=$info['triage_paciente_curp']?></b>
            </div>
            <div style="position:absolute;margin-top:300px;font-size:40px;left:205px;width:500px;text-align: center">
                <b>VIGENCIA DE ACCEDER</b>
            </div>
            <div style="position:absolute;margin-top:428px;font-size:<?=$FontSizeA?>;left:100px;width:335px;text-align:center">
                <b><?=$info['triage_nombre_ap']?></b>
            </div>
            <div style="position:absolute;margin-top:428px;font-size:<?=$FontSizeA?>;left:435px;width:335px;text-align:center">
                <b><?=$info['triage_nombre_am']?></b>
            </div>
            <div style="position:absolute;margin-top:485px;font-size:12px;left:170px;width:380px;text-align:left;text-transform:uppercase">
                <?=$DirEmpresa['directorio_cn']?> <?=$DirEmpresa['directorio_colonia']?> <?=$DirEmpresa['directorio_cp']?> <?=$DirEmpresa['directorio_municipio']?> <?=$DirEmpresa['directorio_estado']?>
            </div>
            <div style="position:absolute;margin-top:520px;font-size:12px;left:170px;width:380px;text-align:left;text-transform:uppercase">
                <?=$Empresa['empresa_nombre']?>
            </div>
            <div style="position:absolute;margin-top:540px;font-size:12px;left:170px;width:380px;text-align:left;text-transform:uppercase">
               <?=$DirPaciente['directorio_cn']?> <?=$DirPaciente['directorio_colonia']?> <?=$DirPaciente['directorio_cp']?> <?=$DirPaciente['directorio_municipio']?> <?=$DirPaciente['directorio_estado']?>
            </div>
            <div style="position:absolute;margin-top:484px;font-size:13px;left:650px;width:150px;text-align:left">
                <?=$DirEmpresa['directorio_telefono']?>
            </div>
            <div style="position:absolute;margin-top:550px;font-size:13px;left:670px;width:150px;text-align:left">
                <?=$DirPaciente['directorio_telefono']?>
            </div>
            <div style="position:absolute;margin-top:656px;font-size:18px;left:90px;width:100px;text-align:center">
                <b><?=$PINFO['pum_umf']?></b>
            </div>
            <div style="position:absolute;margin-top:656px;font-size:18px;left:340px;width:285px;text-align:center">
                <b><?=$PINFO['pum_delegacion']?></b>
            </div>
            <div style="position:absolute;margin-top:656px;font-size:18px;left:620px;width:100px;text-align:center">
                <b><?=date('d')?></b>
            </div>
            <div style="position:absolute;margin-top:656px;font-size:18px;left:660px;width:100px;text-align:center">
                <b><?=date('m')?></b>
            </div>
            <div style="position:absolute;margin-top:656px;font-size:18px;left:715px;width:100px;text-align:center">
                <b><?=date('Y')?></b>
            </div>
        </div>   
        
    <page_footer></page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle($info['triage_nombre'].' '.$info['triage_nombre_ap'].' '.$info['triage_nombre_am'].' - Expediente Amarillo');
    $pdf->Output('Expediente Amarillo.pdf');
?>