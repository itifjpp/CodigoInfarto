<?php ob_start(); ?>
<page backtop="30mm" backbottom="15mm" backleft="10mm" backright="10mm">
    <page_header>
        <style>
            .table-header{
                width: 100%;border:transparent;margin-left: 38px;
            }
        </style>
        <table class="table-header">
            <tr style="">
                <td style="padding: 0p;">
                    <img src="assets/img/imss.png" style="width: 50px;height: 60px;margin-top: -10px">
                </td>
                <td style="width: 83%;">
                    <h4 style="text-align: left;margin-top: 4px;font-size: 25px">INSTITUTO MEXICANO DEL SEGURO SOCIAL</h4>
                    <h4 style="text-align: left;margin-top: -15px"><?=$this->sigh->getInfo('hospital_tipo')?></h4>
                    <h3 style="text-align: left;margin-top: -15px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h3>
                </td>
            </tr>
        </table>
        
        
    </page_header>
    <div style="">
        <h4 style="text-align: center">REPORTES DE PACIENTES INGRESADOS AL SERVICIO DE URGENCIAS 2017-09-19 13:40:00 HASTA LAS <?= date('Y-m-d H:i:s')?></h4>
        <style>
            .table_re td, th {  border: 1px solid #ddd;text-align: left;  }
            .table_re {border-collapse: collapse;width: 100%;}
            .table_re th, td {padding: 5px;}
        </style>
        <table class="table_re" style="width: 100%">
            <thead>
                <tr>
                    <th style="font-size: 9px">N°</th>
                    <th style="font-size: 9px">FOLIO</th>
                    <th style="font-size: 9px">NOMBRE</th>
                    <th style="font-size: 9px">A. PATERNO</th>
                    <th style="font-size: 9px">A. MATERNO</th>
                    <th style="font-size: 9px">C.U.R.P & N.S.S</th>
                    <th style="font-size: 9px">EDAD</th>
                    <th style="font-size: 9px">SEXO</th>
                    <th style="font-size: 9px">CLASIFICACIÓN</th>
                    <th style="font-size: 9px">DX</th>
                    <th style="font-size: 9px">FECHA & HORA</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($Gestion2 as $value) {$i++;?>
                <tr>
                    <td style="font-size: 9px"><?=$i?></td>
                    <td style="font-size: 8px;width: 5.5%"><?=$value['triage_id']?> </td>
                    <td style="font-size: 8px;width: 11%;text-transform: uppercase"><?=$value['triage_nombre']?></td>
                    <td style="font-size: 8px;width: 8%;text-transform: uppercase"><?=$value['triage_nombre_ap']?></td>
                    <td style="font-size: 8px;width: 8%;text-transform: uppercase"><?=$value['triage_nombre_am']?></td>
                    <td style="font-size: 8px;width: 10%;text-transform: uppercase">
                        <?=$value['triage_paciente_curp']?>
                        <?php 
                        $sqlNss=$this->config_mdl->sqlGetDataCondition('paciente_info',array(
                                'triage_id'=>$value['triage_id']
                        ),'pum_nss,pum_nss_agregado')[0]
                        ;?>
                        <br><?=$sqlNss['pum_nss']?> <?=$sqlNss['pum_agregado']?>
                    </td>
                    <td style="font-size: 8px;width: 5%;text-transform: uppercase">
                        <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['triage_fecha_nac'])); ?>
                        <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
                    </td>
                    <td style="font-size: 8px;width: 6%;text-transform: uppercase"><?=$value['triage_paciente_sexo']?></td>
                    
                    <td style="font-size: 8px;width: 6%;text-transform: uppercase"><?=$value['triage_color']?></td>
                    <td style="font-size: 8px;width: 25%;text-transform: uppercase">
                        <?php 
                        $sqlDx=$this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
                            'triage_id'=>$value['triage_id']
                        ),'hf_diagnosticos')[0];
                        ?>
                        <?=$sqlDx['hf_diagnosticos']?>
                    </td>
                    <td style="font-size: 8px;width: 10%;text-transform: uppercase"><?=$value['acceso_fecha']?> <?=$value['acceso_hora']?></td>
                </tr>
                <?php }?>
                <?php  foreach ($Gestion as $value) {$i++?>
                <tr>
                    <td style="font-size: 9px"><?=$i?></td>
                    <td style="font-size: 8px;width: 5.5%"><?=$value['triage_id']?> </td>
                    <td style="font-size: 8px;width: 11%;text-transform: uppercase"><?=$value['triage_nombre']?></td>
                    <td style="font-size: 8px;width: 8%;text-transform: uppercase"><?=$value['triage_nombre_ap']?></td>
                    <td style="font-size: 8px;width: 8%;text-transform: uppercase"><?=$value['triage_nombre_am']?></td>
                    <td style="font-size: 8px;width: 10%;text-transform: uppercase">
                        <?=$value['triage_paciente_curp']?>
                        <?php 
                        $sqlNss=$this->config_mdl->sqlGetDataCondition('paciente_info',array(
                                'triage_id'=>$value['triage_id']
                        ),'pum_nss,pum_nss_agregado')[0]
                        ;?>
                        <br><?=$sqlNss['pum_nss']?> <?=$sqlNss['pum_agregado']?>
                    </td>
                    <td style="font-size: 8px;width: 5%;text-transform: uppercase">
                        <?php $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['triage_fecha_nac'])); ?>
                        <?=$fecha->y==0 ? $fecha->m.' MESES' : $fecha->y.' AÑOS'?>
                    </td>
                    <td style="font-size: 8px;width: 6%;text-transform: uppercase"><?=$value['triage_paciente_sexo']?></td>
                    
                    <td style="font-size: 8px;width: 6%;text-transform: uppercase"><?=$value['triage_color']?></td>
                    <td style="font-size: 8px;width: 25%;text-transform: uppercase">
                        <?php 
                        $sqlDx=$this->config_mdl->sqlGetDataCondition('os_consultorios_especialidad_hf',array(
                            'triage_id'=>$value['triage_id']
                        ),'hf_diagnosticos')[0];
                        ?>
                        <?=$sqlDx['hf_diagnosticos']?>
                    </td>
                    <td style="font-size: 8px;width: 10%;text-transform: uppercase"><?=$value['acceso_fecha']?> <?=$value['acceso_hora']?></td>
                </tr>
                <?php }?>
            </tbody>
            </table>
    </div>      
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DE CAMAS OCUPADAS');
    $pdf->Output('REPORTE DE CAMAS OCUPADAS.pdf');
?>