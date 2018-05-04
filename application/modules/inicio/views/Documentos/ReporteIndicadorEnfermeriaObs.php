<?php ob_start(); ?>
<page backtop="65mm" backbottom="7mm" backleft="12mm" backright="10mm">
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
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 11px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                    </td>
                    <td style="width: 10%;text-align: right;">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 50px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 30px;margin-bottom: 0px;text-align: center;text-transform: uppercase">REPORTE DE PRODUCTIVIDAD - <?=$_GET['tipo']?></p>
                    </td>
                </tr>
            </table>
            <table style="margin-top: 30px;width: 100%">
                <tr>
                    <td style="width: 50%">
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: 300">USUARIO: <?=$Usuario['empleado_nombre']?> <?=$Usuario['empleado_ap']?> <?=$Usuario['empleado_am']?></h5>
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: 300">MATRICULA: <?=$Usuario['empleado_matricula']?></h5>
                    </td>
                    <td style="width: 50%;text-align: right">
                        
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: 300">FECHA INICIO : <?=$_GET['start']?></h5>
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: 300">FECHA TERMINO : <?=$_GET['end']?></h5>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <style>
        .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;font-size: 10px}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 25%">FOLIO DE INGRESO</th>
                <th style="width: 25%">PACIENTE</th>
                <th style="width: 25%">NSS</th>
                <?php if($_GET['tipo']=='Ingreso Enfermería Observación'){?>
                <th style="width: 25%">INGRESO</th>
                <?php }else{?>
                <th style="width: 25%">EGRESO</th>
                <?php }?>
                
            </tr>
        </thead>
        <?php foreach ($Gestion as $value) {?>
        <tr>
            <td><?=$value['ingreso_id']?></td>
            <td><?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?></td>
            <td><?=$value['paciente_nss']?> <?=$value['paciente_nss_agregado']?></td>
            <td>
                <?php if($_GET['tipo']=='Ingreso Enfermería Observación'){?>
                <?=$value['observacion_fe']?> <?=$value['observacion_he']?>
                <?php }else{?>
                <?=$value['observacion_fs']?> <?=$value['observacion_hs']?>
                <?php }?>
                
            </td>
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
    $pdf->pdf->SetTitle('Reporte de productividad '.$this->UMAE_AREA);
    $pdf->Output('Reporte de productividad '.$this->UMAE_AREA.'.pdf');
?>