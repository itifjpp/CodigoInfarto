<?php ob_start(); ?>
<page backtop="40mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/img/logo_left.jpg" style="width: 50%;position: absolute;left: 30px;right: 10px">
        <h4 style="text-align: center;margin-top: 20px"><?=$this->sigh->getInfo('hospital_tipo')?></h4>
        <h4 style="text-align: center;margin-top: -6px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h4>
    </page_header>
    <div style="position: absolute;margin-top: 10px">
        
        <style>
            table, td, th {    border: 1px solid #ddd;text-align: left;}
            table {border-collapse: collapse;width: 100%;}
            th, td {padding: 5px;}
        </style>
        <table style="width: 100%">
                <thead>
                    <tr>
                        <th colspan="5">
                            <b>SEGUIMIENTO DE PACIENTES EN EL ÁREA DE URGENCIAS</b>
                        </th>
                        <th colspan="2">
                            <b>FECHA Y HORA: </b> <?= date('d/m/Y')?> <?= date('H:i')?><br>
                            <b>TOTAL: </b> <?= count($Gestion)?>
                        </th>
                    </tr>
                    <tr>
                        <th style=";font-size: 9px;">ÁREA</th>
                        <th style=";font-size: 9px;">CAMA</th>
                        <th style=";font-size: 9px;">FOLIO</th>
                        <th style=";font-size: 9px;">PACIENTE</th>
                        <th style=";font-size: 9px;">INGRESO</th>
                        <th style="font-size: 9px">TIEMPO EN CAMA</th>
                        <th style="font-size: 9px">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Gestion as $value) {
                        $Tiempo=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=> date('d-m-Y').' '. date('H:i'),
                                'Tiempo2'=> str_replace('/', '-', $value['cama_ingreso_f'].' '.$value['cama_ingreso_h']),
                        ));
                        if($Tiempo->d==0 && $Tiempo->h>=12 && $Tiempo->h<18 ){
                            $Estado="Mayor a 12 Horas";
                        }else if($Tiempo->d==0 && $Tiempo->h>=18 ){
                            $Estado="Mayor a 18 Horas";
                        }else if($Tiempo->d>0 ){
                            $Estado="Mayor a 24 Horas";
                        }else{
                            $Estado="Menor a 12 Horas";
                        }
                        $sqlInfo=$this->config_mdl->sqlGetDataCondition('os_triage',array(
                            'triage_id'=>$value['cama_dh']
                        ),'triage_id,triage_nombre,triage_nombre_ap,triage_nombre_am')[0]
                    ?>
                    <tr>
                        <td style="width: 20%;font-size: 10px;"><?=$value['area_nombre']?> <?=$value['area_nombre_ap']?> <?=$value['area_nombre_am']?></td>
                        <td style="width: 15%;text-transform: uppercase;font-size: 9px;"><?=$value['cama_nombre']?></td>
                        <td style="width: 9%;text-transform: uppercase;font-size: 9px;"><?=$sqlInfo['triage_id']?></td>
                        <td style="width: 22%;text-transform: uppercase;font-size: 9px;"><?=$sqlInfo['triage_nombre_ap']?> <?=$sqlInfo['triage_nombre_am']?> <?=$sqlInfo['triage_nombre']?></td>
                        <td style="width: 10%;text-transform: uppercase;font-size: 9px;"><?=$value['cama_ingreso_f']?> <?=$value['cama_ingreso_h']?></td>
                        <td style="width: 12%;text-transform: uppercase;font-size: 9px;">
                            <?=$Tiempo->d?> Dias <?=$Tiempo->h?> Horas
                        </td>
                        <td style="width: 12%;text-transform: uppercase;font-size: 9px;">
                            <?=$Estado?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
    </div>
    <page_footer>
        <div style="text-align:right">
            Página [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','es','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DE CAMAS OCUPADAS');
    $pdf->Output('REPORTE DE CAMAS OCUPADAS.pdf');
?>