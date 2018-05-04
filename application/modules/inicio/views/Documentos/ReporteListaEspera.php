<?php ob_start(); ?>
<page backtop="58mm" backbottom="7mm" backleft="12mm" backright="10mm">
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
                        <?php if($_GET['tipo']=='Asignados'){?>
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 30px;margin-bottom: 0px;text-align: center;text-transform: uppercase">REPORTE DE PACIENTES ASIGNADOS</p>
                        <?php }else{?>
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 30px;margin-bottom: 0px;text-align: center;text-transform: uppercase">REPORTE DE PACIENTES EN CONSULTORIOS EN LISTA DE ESPERA</p>
                        <?php }?>
                        
                    </td>
                </tr>
            </table>
            <table style="margin-top: 20px;width: 100%">
                <tr>
                    <td style="width: 50%">
                    </td>
                    <td style="width: 50%;text-align: right">
                        
                        <h5 style="margin: 0px 0px 5px 0px;font-weight: 300">FECHA : <?= date('Y-m-d H:i')?></h5>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <style>
        .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;font-size: 9px}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 10%">FOLIO</th>
                <th style="width: 25%">PACIENTE</th>
                <th style="width: 15%">SEXO</th>
                <th style="width: 15%">CLASIFICACION</th>
                <th style="width: 17%">T. TRANSCURRIDO</th>
                <th>EVENTOS DE AUSENCIA</th>
            </tr>
        </thead>
        <?php foreach ($Gestion as $value) {?>
        <?php 
        if($value['lista_espera_date']!=''){
            $Diff= Modules::run('Config/CalcularTiempoTranscurrido',array(
                'Tiempo1'=>$value['lista_espera_date'].' '.$value['lista_espera_time'],
                'Tiempo2'=> date('Y-m-d H:i')
            ));

        }
        ?>
        <tr>
            <td><?=$value['ingreso_id']?></td>
            <td><?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?></td>
            <td><?=$value['paciente_sexo']?></td>
            <td><?=$value['ingreso_clasificacion']?></td>
            <td ><?=$Diff->d?> Días <?=$Diff->h?> Hrs <?=$Diff->i?> Min</td>
            <td ><?=$value['lista_espera_eventos']?> Eventos</td>
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
    $pdf->pdf->SetTitle('LISTA DE ESPERA CONSULTORIOS');
    $pdf->Output('LISTA DE ESPERA CONSULTORIOS.pdf');
?>