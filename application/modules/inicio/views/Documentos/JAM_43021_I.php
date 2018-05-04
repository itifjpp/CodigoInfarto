<?php ob_start(); ?>
<page backleft="12.5mm" backright="10mm" backtop="71mm" backbottom="15mm">
    <page_header>
        <div style="position: absolute;">
            <img src="assets/doc/JAM_43021_I.png" style="position: absolute;width: 100%">
            <div style="position: absolute;margin-left: 136px;margin-top: 190px;font-size: 11px"><?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></div>
            <div style="position: absolute;margin-left: 880px;margin-top: 190px;font-size: 11px">: [[page_cu]]/[[page_nb]]</div>
            <div style="position: absolute;margin-left: 976px;margin-top: 190px;font-size: 9px">: <?=$_GET['fecha']?></div>
        </div>
    </page_header>
    <div style="position: absolute;">
        <style>
            table{border: 1px solid black; }
            td, th {border: 1px solid black; }
            table {border-collapse: collapse;width: 100%;}
            td {vertical-align: bottom;}
            .th_1{padding: 5px 2px 15px 2px;text-align: center}
            .th_2{padding: 5px 5px 15px 5px;}
        </style>
        <table style="width: 947px;margin-top: -1px;">
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <?php
                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['paciente_fn'])); 
                ?>
                <tr style="width: 100%">
                    <td style="width: 12.3%;font-size: 9px"><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
                    <td style="width: 16.54%;font-size: 9px"><?=$value['paciente_ap']?> <?=$value['paciente_am']?> <?=$value['paciente_nombre']?></td>
                    <td style="width: 5%;font-size: 9px"><?=$fecha->y==0 ? $fecha->m.' Meses':$fecha->y.' Años'?></td>
                    
                    <td style="width: 6.2%;font-size: 9px"><?=$value['info_procedencia_hospital']?></td>
                    <td style="width: 6.6%;font-size: 9px"><?=$value['info_procedencia_hospital_num']?></td>
                    <td style="width: 8.2%;font-size: 9px"><?=$value['info_delegacion']?></td>
                    <td style="width: 7.8%;font-size: 9px">
                        <?php 
                        if($value['doc_destino']=='Choque'){
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_choque, sigh_camas WHERE sigh_camas.cama_id=sigh_choque.cama_id AND
                            sigh_choque.ingreso_id=".$value['ingreso_id'])[0];
                            echo $Obs['choque_ac_h'];
                        }else{
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_observacion, sigh_camas WHERE sigh_camas.cama_id=sigh_observacion.observacion_cama AND
                            sigh_observacion.ingreso_id=".$value['ingreso_id'])[0];
                            echo $Obs['observacion_he'];
                        }
                        ?>
                    </td>
                    <td style="width: 5.2%;font-size: 9px"><?=$Obs['cama_nombre']?></td>
                    <td style="width: 14.4%;font-size: 9px">
                        <?php 
                            $sqlHojaFrontal=$this->config_mdl->sqlQuery("SELECT empleado_matricula FROM sigh_empleados AS emp, sigh_hojafrontal AS hf
                                WHERE emp.empleado_id=hf.empleado_id AND
                                hf.ingreso_id=".$value['ingreso_id']);
                            if(!empty($sqlHojaFrontal)){
                                echo $sqlHojaFrontal[0]['empleado_matricula'];
                            }else{
                                $sqlMedicoTriage=$this->config_mdl->sqlQuery("SELECT empleado_matricula FROM sigh_empleados AS emp, sigh_ingresos AS ing
                                    WHERE emp.empleado_id=ing.ingreso_medico_id AND
                                    ing.ingreso_id=".$value['ingreso_id']);
                                echo $sqlMedicoTriage[0]['empleado_matricula'];
                            }
                            
                        ?>
                    </td>
                    <td style="width: 22.16%;font-size: 9px">
                        <?=$value['doc_destino']=='Choque' ? 'Choque': 'Observación'?>
                    </td>
                </tr>
                <?php }?>
                <?php foreach ($Gestion2 as $value) {?>
                <?php
                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['paciente_fn'])); 
                ?>
                <tr style="width: 100%">
                    <td style="width: 12.3%;font-size: 9px"><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
                    <td style="width: 16.54%;font-size: 9px"><?=$value['paciente_ap']?> <?=$value['paciente_am']?> <?=$value['paciente_nombre']?></td>
                    <td style="width: 5%;font-size: 9px"><?=$fecha->y==0 ? $fecha->m.' Meses':$fecha->y.' Años'?></td>
                    
                    <td style="width: 6.2%;font-size: 9px"><?=$value['info_procedencia_hospital']?></td>
                    <td style="width: 6.6%;font-size: 9px"><?=$value['info_procedencia_hospital_num']?></td>
                    <td style="width: 8.2%;font-size: 9px"><?=$value['info_delegacion']?></td>
                    <td style="width: 7.8%;font-size: 9px">
                        <?php 
                        if($value['doc_destino']=='Choque'){
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_choque, sigh_camas WHERE sigh_camas.cama_id=sigh_choque.cama_id AND
                            sigh_choque.ingreso_id=".$value['ingreso_id'])[0];
                            echo $Obs['choque_ac_h'];
                        }else{
                            $Obs=$this->config_mdl->sqlQuery("SELECT * FROM sigh_observacion, sigh_camas WHERE sigh_camas.cama_id=sigh_observacion.observacion_cama AND
                            sigh_observacion.ingreso_id=".$value['ingreso_id'])[0];
                            echo $Obs['observacion_he'];
                        }
                        ?>
                    </td>
                    <td style="width: 5.2%;font-size: 9px"><?=$Obs['cama_nombre']?></td>
                    <td style="width: 14.4%;font-size: 9px"></td>
                    <td style="width: 22.16%;font-size: 9px">
                        <?=$value['doc_destino']=='Choque' ? 'Choque': 'Observación'?>
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
    $pdf->pdf->SetTitle('Ingresos Registros 4-30-21/35/90 I');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('Ingresos Registros 4-30-21/35/90 I.pdf');
?>