<?php ob_start(); ?>
<page backleft="0mm" backright="0mm" backtop="76mm">
    <page_header>
        <div style="position: absolute">
            <img src="assets/doc/JAM_43021_E.png" style="position: absolute;width: 100%">
            <div style="position: absolute;margin-left: 136px;margin-top: 190px;font-size: 11px"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></div>
            <div style="position: absolute;margin-left: 920px;margin-top: 190px;font-size: 11px">:[[page_cu]]/[[page_nb]]</div>
            <div style="position: absolute;margin-left: 978px;margin-top: 190px;font-size: 9px">: <?=$_GET['fecha']?></div>
        </div>
    </page_header>
    <div style="position: absolute;">
        <style>
            table{border: 1px solid black; }td, th {border: 1px solid black; }
            table {border-collapse: collapse;width: 100%;}
            td {vertical-align: bottom;}.th_1{padding: 5px 2px 15px 2px;text-align: center}.th_2{padding: 5px 5px 15px 5px;}
        </style>
        <table style="width: 990px;margin-left: 45.8px;margin-top: -1px">
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <tr style="width: 100%">
                    <td style="width: 8.9%;font-size: 9px"><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
                    <td style="width: 15.8%;font-size: 9px"><?=$value['paciente_ap']?> <?=$value['paciente_am']?> <?=$value['paciente_nombre']?></td>
                    <td style="width: 7.5%;font-size: 9px">
                        <?php 
                        if($value['doc_destino']=='Choque'){
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_choque AS choque, sigh_camas AS cama WHERE cama.cama_id=choque.cama_id AND
                            choque.ingreso_id=".$value['ingreso_id'])[0];
                            $Alta=$Obs['choque_alta'];
                        }else{
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_observacion AS obs, sigh_camas AS cama WHERE cama.cama_id=obs.observacion_cama AND
                            obs.ingreso_id=".$value['ingreso_id'])[0];
                            $Alta=$Obs['observacion_alta'];
                        }
                        ?>
                        <?=$value['doc_hora']?>
                    </td>
                    <td style="width: 5.2%;font-size: 9px;text-align: center"><?=$Obs['cama_nombre'];?></td>
                    <td style="width: 6.6%;font-size: 9px;text-align: center">
                        <?=$Alta=='Alta a domicilio' || $Alta=='Alta Desconocido' ? 'X' : ''?>
                    </td>
                    <td style="width: 5.3%;font-size: 10px;;text-align: center">
                        
                    </td>
                    <td style="width: 12%;font-size: 10px;;text-align: center">
                        
                        <?=$Alta=='Alta e ingreso a hospitalización' ? 'X' : ''?>
                    </td>
                    <td style="width:7.28%;font-size: 10px;;text-align: center">
                        <?=$Alta=='' ? '' : ''?>
                    </td>
                    <td style="width: 7.30%;font-size: 10px;;text-align: center">
                        <?=$Alta=='Alta e ingreso quirófano' ? 'X' : ''?>
                    </td>
                    <td style="width: 7.1%;font-size: 9px;text-align: center">
                    </td>
                    <td style="width: 17.1%;font-size: 9px">
                        <?php 
                        $sqlDiagnostico=$this->config_mdl->sqlQuery("SELECT hf_diagnosticos_lechaga FROM sigh_hojafrontal WHERE ingreso_id=".$value['ingreso_id']);
                        echo $sqlDiagnostico[0]['hf_diagnosticos_lechaga']
                        ?>
                    </td>
                </tr>
                <?php }?>
                <?php foreach ($Gestion1 as $value) {?>
                <tr style="width: 100%">
                    <td style="width: 8.9%;font-size: 9px"><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
                    <td style="width: 15.8%;font-size: 9px"><?=$value['paciente_ap']?> <?=$value['paciente_am']?> <?=$value['paciente_nombre']?></td>
                    <td style="width: 7.5%;font-size: 9px">
                        <?php 
                        if($value['doc_destino']=='Choque'){
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_choque AS choque, sigh_camas AS cama WHERE cama.cama_id=choque.cama_id AND
                            choque.ingreso_id=".$value['ingreso_id'])[0];
                            $Alta=$Obs['choque_alta'];
                        }else{
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_observacion AS obs, sigh_camas AS cama WHERE cama.cama_id=obs.observacion_cama AND
                            obs.ingreso_id=".$value['ingreso_id'])[0];
                            $Alta=$Obs['observacion_alta'];
                        }
                        ?>
                        <?=$value['doc_hora']?>
                    </td>
                    <td style="width: 5.2%;font-size: 9px;text-align: center"><?=$Obs['cama_nombre'];?></td>
                    <td style="width: 6.6%;font-size: 9px;text-align: center">
                        <?=$Alta=='Alta a domicilio' || $Alta=='Alta Desconocido' ? 'X' : ''?>
                    </td>
                    <td style="width: 5.3%;font-size: 10px;;text-align: center">
                        
                    </td>
                    <td style="width: 12%;font-size: 10px;;text-align: center">
                        
                        <?=$Alta=='Alta e ingreso a hospitalización' ? 'X' : ''?>
                    </td>
                    <td style="width:7.28%;font-size: 10px;;text-align: center">
                        <?=$Alta=='' ? '' : ''?>
                    </td>
                    <td style="width: 7.30%;font-size: 10px;;text-align: center">
                        <?=$Alta=='Alta e ingreso quirófano' ? 'X' : ''?>
                    </td>
                    <td style="width: 7.1%;font-size: 9px;text-align: center">
                    </td>
                    <td style="width: 17.1%;font-size: 9px">
                        <?php 
                        $sqlDiagnostico=$this->config_mdl->sqlQuery("SELECT hf_diagnosticos_lechaga FROM sigh_hojafrontal WHERE ingreso_id=".$value['ingreso_id']);
                        echo $sqlDiagnostico[0]['hf_diagnosticos_lechaga']
                        ?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        
        
    </div>
    <page_footer>
        <table style="width: 100%;border:0px solid transparent!important;margin-left: 21px">
            <tr style="border:0px solid transparent!important">
                <td style="width: 45%;text-align: right;border:0px solid transparent!important">[[page_cu]]/[[page_nb]]</td>
                <td style="width: 49%;text-align: right;border:0px solid transparent!important">Clave 2430 003 040</td>
            </tr>
        </table>
    </page_footer>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->setTitle('Egreso Registros 4-30-21/35/90 E');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Egreso Registros 4-30-21/35/90 E.pdf');
?>