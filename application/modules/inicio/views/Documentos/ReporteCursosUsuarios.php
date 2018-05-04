<?php ob_start(); ?>
<page backtop="65mm" backbottom="7mm" backleft="11mm" backright="11mm">
    <page_header>
        <style>
            .my_table, .my_table td, .my_table th {  
                border: none;
                text-align: left;
            }
        </style>
        <div style="width: 680px;margin-top: 45px;margin-left: 40px;position: absolute;">
            <table style="width: 100%" class="my_table">
                <tr style="">
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 50px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">COORDINACIÓN DE ENSEÑANZA E INVESTIGACIÓN.</p>
                        
                    </td>
                    <td style="width: 10%;text-align: right;">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 30px;margin-bottom: 0px;text-align: center"></p>
                    </td>
                </tr>
            </table>
            <table style="margin-top: 30px;width: 100%">
                <tr>
                    <td style="width: 100%">
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: bold;text-align: center">REPORTE DE USUARIOS QUE ASISTIERÓN AL CURSO</h5>
                        <h5 style="margin: 10px 0px 5px 0px;font-weight: 300;text-transform: uppercase"><b>NOMBRE DEL CURSO:</b> <?=$info['curso_nombre']?></h5>
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: 300;text-transform: uppercase"><b>FECHA DEL CURSO:</b> <?=$info['curso_fecha']?></h5>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <style>
        .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style>
    <table class="table" style="font-size: 9px">
        <thead>
            <tr>
                <th style="width: 4%">N°</th>
                <th style="width: 15%">N° DE EMPLEADO</th>
                <th style="width: 25%">NOMBRE</th>
                <th style="width: 25%">CARGO</th>
                <th style="width: 15%">FECHA INGRESO</th>
                <th style="width: 15%">FECHA EGRESO</th>
            </tr>
        </thead>
        <?php $i=0; foreach ($Gestion as $value) {$i++;?>
        <tr>
            <td style="width: 4%"><?=$i?></td>
            <td style="width: 15%"><?=$value['empleado_matricula']?></td>
            <td style="width: 25%"><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
            <td style="width: 26%"><?=$value['empleado_categoria']=='' ?'SIN ESPECIFICAR':$value['empleado_categoria']?></td>
            <td style="width: 15%"><?=$value['ce_fecha_ingreso']?> <?=$value['ce_hora_ingreso']?></td>
            <td style="width: 15%"><?=$value['ce_fecha_egreso']?> <?=$value['ce_hora_egreso']?></td>
        </tr> 
        <?php }?>
    </table>
    <page_footer>
        <div style="text-align:right">
            Página [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('Reporte de productividad horacero');
    $pdf->Output('Reporte de productividad horacero.pdf');
?>