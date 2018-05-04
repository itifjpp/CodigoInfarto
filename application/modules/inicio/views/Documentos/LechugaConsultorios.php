<?php ob_start(); ?>
<page backleft="0mm" backright="0mm" backtop="122mm">
    <page_header backleft="10mm" backright="10mm">
        <div style="position: absolute">
            <img src="assets/doc/sigh_lechiga4306.png" style="position: absolute;width: 100%">
            <div style="width: 445px;margin-top: 5px;margin-left: 0px;position: absolute">
                <table style="width: 100%;border:1px solid red!important" border="0">
                    <tr style="border: none!important">
                        <td style="width: 10%;border: none!important;border:1px solid white">
                            <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 38px">
                        </td>
                        <td style="text-align: left;width: 90%;border:1px solid white">
                            <p style="text-transform: uppercase;font-size: 12px;font-weight: bold;margin: 0px;text-align: left"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                            <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        </td>
                     </tr>
                 </table>
             </div>
            <qrcode value="<?= md5($info['ingreso_id'])?>"  style="width: 40px;position: absolute;right: 7px;top: 14px"></qrcode>
            <div style="position: absolute;margin-left: 00px;margin-top: 90px;font-size: 11px;width: 170px;text-align: center">
                <?=$this->sigh->getInfo('hospital_tipo')?>
            </div>
            <div style="position: absolute;margin-left: 200px;margin-top: 90px;font-size: 11px"><?=  date('d/m/Y')?></div>
            <div style="position: absolute;margin-left:330px;margin-top: 90px;font-size: 11px;width: 100px;text-align: center"><?=$medico['empleado_matricula']?></div>
            <div style="position: absolute;margin-left:605px;margin-top: 90px;font-size: 6.5px;width: 55px;text-align: center"><?=$this->UMAE_AREA?></div>
            <div style="position: absolute;margin-left: 660px;margin-top: 90px;font-size: 6px;width: 35px;text-align: center">
                <?= Modules::run('Config/ObtenerTurno')?>
            </div>
            <div style="position: absolute;margin-left:310px;margin-top: 130px;font-size: 10px;"><?=$medico['empleado_nombre']?> <?=$medico['empleado_ap']?> <?=$medico['empleado_am']?></div>
        </div>
    </page_header>
    <div style="position: absolute;">
        <style>
            table{border: 1px solid black; }
            td, th { border: 1px solid black; }
            
            table {border-collapse: collapse;width: 100%;}
            td {vertical-align: central;}
        </style>
        <?php $i=0; foreach ($HojasFrontales as $value) { $i++;?>
        <?php
        $sqlCe=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
            'ingreso_id'=>$value['ingreso_id']
        ))
        ?>
        <table style="width:762.5px;margin-left: 0px;font-size: 5.8px;margin-top: 5px;" border="0">
            <tr >
                <td style="width: 3.3%;padding: 3px;font-size: 10px;" rowspan="3">
                    <?=$i?>
                    
                </td>
                <td style="width: 5.1%;padding: 3px;text-align: center" rowspan="3">
                    <?=$sqlCe[0]['ce_fe']?>  <?=$sqlCe[0]['ce_he']?><br>
                    <span style="font-size: 10px;margin-top: 5px"><?=$value['hf_urgencia']=='Urgencia Real'?'R':'S'?></span>
                </td>
                <td style="padding: 3px;font-size: 10px" colspan="28">
                    <b>HOJA FRONTAL</b> | <?= $value['hf_diagnosticos']?>
                </td>
            </tr>
            <tr style="width: 100%">
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"><?=$value['hf_atencion']=='1° VEZ' ? 'X':''?></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"><?=$sqlCe[0]['ce_status']=='Salida' ? 'X' : ''?></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"><?=$value['hf_receta_por']!='' ? 'X':''?></td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;">
                    <?php 
                    $sqlAm=$this->config_mdl->sqlGetDataCondition('sigh_asistentesmedicas',array(
                        'ingreso_id'=>$value['ingreso_id']
                    ),'asistentesmedicas_incapacidad_ga')[0]
                    ?>
                    <?=$sqlAm['asistentesmedicas_incapacidad_ga']=='Si' ? 'X' : ''?>
                </td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">
                    <?=$info['info_lugar_accidente']=='TRABAJO' ? 'X' : ''?>
                </td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:24.3%;padding: 3px;font-size: 10px;"><?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;text-align: center;font-size: 10px;"></td>
            </tr>
            <tr style="width: 100%">
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">1</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">2</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">3</td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;">4</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">5</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">6</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">7</td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;">8</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">9</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">10</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">11</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">12</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">13</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">14</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">15</td>
                <td style="width:24.3%;padding: 3px;font-size: 10px;" colspan="9">
                    
                    <?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?>
                </td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
            </tr>
        </table>
        <?php }?>
        <?php foreach ($Notas as $value_n) { $i++;?>
        <?php
        $sqlCe=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
            'ingreso_id'=>$value_n['ingreso_id']
        ))
        ?>
        <table style="width:762.5px;margin-left: 0px;font-size: 5.8px;margin-top: 5px;" border="0">
            <tr >
                <td style="width: 3.3%;padding: 3px" rowspan="3"><?=$i?></td>
                <td style="width: 5.1%;padding: 3px;text-align: center" rowspan="3"><?=$value_n['notas_fecha']?><br>  <?=$value_n['notas_hora']?></td>
                <td style="padding: 3px;font-size: 10px;width: 90%;text-transform: uppercase" colspan="28">
                    <?php 
                    $sqlNota=$this->config_mdl->sqlGetDataCondition('sigh_nota',array(
                       'notas_id'=>$value_n['notas_id'] 
                    ),'nota_diagnostico');
                    ?>
                    <b><?=$value_n['notas_tipo']?></b> | <?=$sqlNota[0]['nota_diagnostico']?>
                </td>
            </tr>
            <tr style="width: 100%">
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;"></td>
                <td style="width:24.3%;padding: 3px;font-size: 10px;"><?=$value_n['paciente_nombre']?> <?=$value_n['paciente_am']?> <?=$value_n['paciente_am']?></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
                <td style="width: 2.45%;font-size: 10px;"></td>
            </tr>
            <tr style="width: 100%">
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">1</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">2</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">3</td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;">4</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">5</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">6</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">7</td>
                <td style="width:2.3%;padding: 3px;text-align: center;font-size: 10px;">8</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">9</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">10</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">11</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">12</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">13</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">14</td>
                <td style="width:2.5%;padding: 3px;text-align: center;font-size: 10px;">15</td>
                <td style="width:24.3%;padding: 3px;font-size: 10px;" colspan="9">
                    <?=$value_n['paciente_nss']?> <?=$value_n['paciente_nss_agregado']?>
                </td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
                <td style="width: 2.45%;padding: 3px;font-size: 10px;"></td>
            </tr>
        </table>
        <?php }?>
    </div>
    <page_footer></page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->SetTitle('DOCUMENTO 4.30.6 CONSULTORIOS');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('DOCUMENTO 4.30.6 CONSULTORIOS.pdf');
?>