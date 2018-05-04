<?php ob_start(); ?>
<page backtop="50mm" backbottom="7mm" backleft="11mm" backright="11mm">
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
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: bold;text-align: center">LISTA DE USUARIOS CON ABANDONO AL SERVICIO DE CONSULTORIOS</h5>
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
                <th style="width: 15%">N° DE INGRESO</th>
                <th style="width: 30%">NOMBRE DEL PACIENTE</th>
                <th style="width: 15%">CLASIFICACIÓN</th>
                <th style="width: 20%">INGRESO</th>
                <th style="width: 20%">ÚLTIMA LLAMADA</th>
            </tr>
        </thead>
        <?php $i=0; foreach ($Gestion as $value) {?>
        <tr>
            <td style="width: 15%"><?=$value['ingreso_id']?></td>
            <td style="width: 30%"><?=$value['paciente_nombre']?> <?=$value['paciente_am']?> <?=$value['paciente_ap']?></td>
            <td style="width: 15%"><?=$value['ingreso_clasificacion']?></td>
            <td style="width: 20%"><?=$value['ingreso_date_horacero']?> <?=$value['ingreso_time_horacero']?></td>
            <td style="width: 20%"><?=$value['lista_espera_date']?> <?=$value['lista_espera_time']?></td>
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
    $pdf->pdf->SetTitle('LISTA DE USUARIOS CON ABANDONO AL SERVICIO DE CONSULTORIOS');
    $pdf->Output('LISTA DE USUARIOS CON ABANDONO AL SERVICIO DE CONSULTORIOS.pdf');
?>