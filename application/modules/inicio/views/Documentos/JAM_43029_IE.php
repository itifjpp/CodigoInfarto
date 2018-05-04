<?php ob_start(); ?>
<page backleft="12.5mm" backright="15mm" backtop="65mm" backbottom="5mm">
    <page_header>
        <div style="position: absolute">
            <img src="assets/doc/JAM_43029_IE.png" style="position: absolute;width: 100%;">
            <div style="position: absolute;margin-left: 136px;margin-top: 176px;font-size: 11px"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></div>
            <div style="position: absolute;margin-left: 840px;margin-top: 176px;font-size: 11px">: [[page_cu]]/[[page_nb]]</div>
            <div style="position: absolute;margin-left: 956px;margin-top: 176px;font-size: 9px">: <?=$_GET['fecha']?></div>
        </div>
    </page_header>
    <div style="position: absolute;">

        <style>
            table{border: 1px solid black; }
            td, th {border: 1px solid black; }
            table {border-collapse: collapse;width: 100%;}
            td {vertical-align: bottom;}
        </style>
        <table style="width: 100%;margin-top: -1px;margin-left: 0px">
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <tr style="width: 949px">
                    <td style="width: 6%;font-size: 8px"><span class="es inline-block"><?=$value['ingreso_id']?></span></td>
                    <td style="width: 9.5%;font-size: 9px;text-transform: uppercase"><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
                    <td style="width: 17.1%;font-size: 8px;text-transform: uppercase"><?=$value['paciente_ap']?> <?=$value['paciente_am']?> <?=$value['paciente_nombre']?></td>
                    <td style="width: 5.6%;font-size: 9px">
                        <?=$value['ingreso_time_am']?>
                    </td>
                    <td style="width: 6.6%;font-size: 9px"><?=$value['info_umf']?></td>
                    <td style="width: 4.8%;font-size: 9px"></td>
                    <td style="width: 5.85%;font-size: 9px"><?=$value['info_delegacion']?></td>
                    <td style="width: 6.2%;font-size: 9px"><?=$value['info_procedencia_esp']?></td>
                    <td style="width: 8.05%;font-size: 9px"></td>
                    
                    <td style="width: 13.86%;font-size: 9px">
                        <?php 
                        $sqlDiagnostico=$this->config_mdl->sqlQuery("SELECT hf_diagnosticos,hf_hg,hf_fg FROM sigh_hojafrontal WHERE ingreso_id=".$value['ingreso_id']);
                        ?>
                        <?php 
                            $sqlConsultorio=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
                                'ingreso_id'=>$value['ingreso_id']
                            ))[0];
                            echo $sqlConsultorio['ce_hf']
                        ?>
                        <?php 
                        if(!empty($sqlDiagnostico)){
                            $Tiempo= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$value['ingreso_date_am'].' '.$value['ingreso_time_am'],
                                'Tiempo2'=>$sqlDiagnostico[0]['hf_fg'].' '.$sqlDiagnostico[0]['hf_hg']
                            ));
                            echo '<br>T.T: '.$Tiempo->h.' Horas '.$Tiempo->i.' Minutos';
                        }else{
                            $Tiempo= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$value['ingreso_date_am'].' '.$value['ingreso_time_am'],
                                'Tiempo2'=> date('Y-m-d').' '. date('H:i:s') 
                            ));
                            if($Tiempo->d>0 || $Tiempo->h>6){
                                echo '<br><span style="color:red">POSIBLE ABANDONO</span>';
                            }
                        }
                        ?>
                    </td>
                    <td style="width: 4%;font-size: 9px">
                        
                        <?=$sqlDiagnostico[0]['hf_hg']?>
                        
                        
                    </td>
                    <td style="width: 16.5%;font-size: 9px">
                        <?=$sqlDiagnostico[0]['hf_diagnosticos']?>
                    </td>
                </tr>
                <?php }?>
                <?php foreach ($Gestion2 as $value) {?>
                <tr style="width: 949px">
                    <td style="width: 6%;font-size: 8px"><span class="es inline-block"><?=$value['ingreso_id']?></span></td>
                    <td style="width: 9.5%;font-size: 9px;text-transform: uppercase"><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
                    <td style="width: 17.1%;font-size: 8px;text-transform: uppercase"><?=$value['paciente_ap']?> <?=$value['paciente_am']?> <?=$value['paciente_nombre']?></td>
                    <td style="width: 5.6%;font-size: 9px">
                        <?=$value['ingreso_time_am']?>
                    </td>
                    <td style="width: 6.6%;font-size: 9px"><?=$value['info_umf']?></td>
                    <td style="width: 4.8%;font-size: 9px"></td>
                    <td style="width: 5.85%;font-size: 9px"><?=$value['info_delegacion']?></td>
                    <td style="width: 6.2%;font-size: 9px"><?=$value['info_procedencia_esp']?></td>
                    <td style="width: 8.05%;font-size: 9px"></td>
                    
                    <td style="width: 13.86%;font-size: 9px">
                        <?php 
                        $sqlDiagnostico=$this->config_mdl->sqlQuery("SELECT hf_diagnosticos,hf_hg,hf_fg FROM sigh_hojafrontal WHERE ingreso_id=".$value['ingreso_id']);
                        ?>
                        <?php 
                            $sqlConsultorio=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_especialidad',array(
                                'ingreso_id'=>$value['ingreso_id']
                            ))[0];
                            echo $sqlConsultorio['ce_hf']
                        ?>
                        <?php 
                        if(!empty($sqlDiagnostico)){
                            $Tiempo= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$value['ingreso_date_am'].' '.$value['ingreso_time_am'],
                                'Tiempo2'=>$sqlDiagnostico[0]['hf_fg'].' '.$sqlDiagnostico[0]['hf_hg']
                            ));
                            echo '<br>T.T: '.$Tiempo->h.' Horas '.$Tiempo->i.' Minutos';
                        }else{
                            $Tiempo= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$value['ingreso_date_am'].' '.$value['ingreso_time_am'],
                                'Tiempo2'=> date('Y-m-d').' '. date('H:i:s') 
                            ));
                            if($Tiempo->d>0 || $Tiempo->h>6){
                                echo '<br><span style="color:red">POSIBLE ABANDONO</span>';
                            }
                        }
                        ?>
                    </td>
                    <td style="width: 4%;font-size: 9px">
                        <?=$sqlDiagnostico[0]['hf_hg']?>
                    </td>
                    <td style="width: 16.5%;font-size: 9px">
                        <?=$sqlDiagnostico[0]['hf_diagnosticos']?>
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
    $pdf->pdf->SetTitle('CONSULTAS, VISITAS Y CURACIONES 4-30-29/72');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('CONSULTAS, VISITAS Y CURACIONES 4-30-29/72.pdf');
?>