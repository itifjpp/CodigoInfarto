<?php ob_start(); ?>
<page backtop="30mm" backbottom="7mm" backleft="10mm" backright="10mm">
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
                    <h4 style="text-align: left;margin-top: -15px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h4>
                </td>
            </tr>
        </table>
        
        
    </page_header>
    <div style="">
        <h4 style="text-align: center">REPORTE DE CAMAS EN ESTADO DE LIMPIEZA</h4>
        <style>
            .table_re td, th {  border: 1px solid #ddd;text-align: left;  }
            .table_re {border-collapse: collapse;width: 100%;}
            .table_re th, td {padding: 5px;}
        </style>
        <table class="table_re" style="width: 100%">
            <thead>
                <tr>
                    <th style="font-size: 9px">FECHA Y HORA</th>
                    <th style="font-size: 9px">TIPO</th>
                    <th style="font-size: 9px">ÁREA</th>
                    <th style="font-size: 9px">CAMA</th>
                    <th style="font-size: 9px">TIEMPO TRANS.</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <tr>
                    <td style="font-size: 10px;width: 18%"><?=$value['cama_fh_estatus']=='' ? 'SIN DETERMINAR':$value['cama_fh_estatus']?> </td>
                    <td style="font-size: 10px;width: 15%;text-transform: uppercase"><?=$value['area_modulo']?></td>
                    <td style="font-size: 10px;width: 30%;text-transform: uppercase"><?=$value['area_nombre']?></td>
                    <td style="font-size: 10px;width: 18%;text-transform: uppercase"><?=$value['cama_nombre']?></td>
                    <td style="font-size: 10px">
                        <?php 
                        $TT='';
                        if($value['cama_fh_estatus']!=''){
                            $Tiempo= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$value['cama_fh_estatus'],
                                'Tiempo2'=> date('Y-m-d H:i:s') 
                            ));  
                            $TT=$Tiempo->d.' Días '.$Tiempo->h.' Hrs '.$Tiempo->i.' Min';
                        }else{
                            $TT='SIN DETERMINAR';
                        }
                        
                        ?>
                        <?=$TT?>
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
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DE CAMAS OCUPADAS');
    $pdf->Output('REPORTE DE CAMAS OCUPADAS.pdf');
?>