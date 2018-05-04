<?php ob_start(); ?>
<page backtop="45mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="<?= base_url()?>assets/img/logo_left.jpg" style="width: 90%;position: absolute;left: 30px;right: 10px">
        <h4 style="text-align: center;margin-top: 20px"><?=$this->UM_TIPO?></h4>
        <h4 style="text-align: center;margin-top: -6px"><?=$this->UM_CLASIFICACION?> | <?=$this->UM_NOMBRE?></h4>
    </page_header>
    <div style="">
        
        <style>
            table, td, th {    border: 1px solid #ddd;text-align: left;}
            table {border-collapse: collapse;width: 100%;}
            th, td {padding: 5px;}
        </style>
        <table style="width: 100%">
            <thead>
                <tr style="background: #256659;color: white;">
                    <th colspan="5" style="text-align: center;border:0px;text-transform: uppercase"><b>REPORTE ACTUAL DE ESTADOS DE CAMAS DEL <?=$this->UMAE_AREA?></b></th>
                </tr>
                <tr>
                    <th style=";font-size: 12px;">ÁREA</th>
                    <th style=";font-size: 12px;">CAMA</th>
                    <th style=";font-size: 12px;">ESTADO</th>
                    <th style=";font-size: 12px;">FECHA & HORA</th>
                    <th style=";font-size: 12px;">T.T</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <tr>
                    <td style=";font-size: 12px;;width: 20%"><?=$value['area_nombre']?></td>
                    <td style=";font-size: 12px;;width: 20%"><?=$value['cama_nombre']?></td>
                    <td style=";font-size: 12px;;width: 15%"><?=$value['cama_status']?></td>
                    <td style=";font-size: 12px;;width: 20%"><?=$value['cama_fh_estatus']?></td>
                    <td style=";font-size: 12px;;width: 25%">
                        <?php  
                        if($value['cama_fh_estatus']!=''){
                            $Tiempo=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=> date('Y-m-d H:i:s'),
                                'Tiempo2'=> $value['cama_fh_estatus'],
                            ));
                            echo $Tiempo->d.' Dias '.$Tiempo->h.' Hrs '.$Tiempo->i.' Min ';
                        }else{
                            echo 'Sin Determinar';
                        }
                        
                        ?>
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
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle($this->UMAE_AREA.' - Reporte actual de estados de camas');
    $pdf->Output($this->UMAE_AREA.' - Reporte actual de estados de camas.pdf');
?>