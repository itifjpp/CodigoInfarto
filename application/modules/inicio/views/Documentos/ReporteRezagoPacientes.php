<?php ob_start(); ?>
<page backtop="35mm" backbottom="20mm" backleft="12mm" backright="12mm">
    <page_header>
        
        <div style="width: 990px;margin-top: 25px;margin-left: 40px;position: absolute;">
            <table style="width: 100%" class="my_table">
                <tr style="">
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 80px;margin-top: -5px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 16px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center">DIRECCIÓN DE PRESTACIONES MÉDICAS</p>
                        <p style="text-transform: uppercase;font-size: 12px;font-weight: 300;margin-top: 3px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                    </td>
                    <td style="width: 10%;text-align: right;">
                        <qrcode value="<?= sha1(date('Y-m-d H:i:s'))?>" ec="Q" style="width: 80px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 00px;margin-bottom: 0px;text-align: center;text-transform: uppercase">LISTA DE REZAGO DE PACIENTES EN ESPERA PARA INGRESO A CONSULTORIOS</p>
                    </td>
                </tr>
            </table>
        </div>
    </page_header>
    <style>
        .table, .table td  {    border: 1px solid #ddd;text-align: left;}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 5px;}
    </style>
    <div style="position: absolute;top: 30px">
        
        <?php 
        $Amarillo=0;
        $Verde=0;
        $Azul=0;
        
        foreach ($Lista as $contador) {
            if($contador['ingreso_clasificacion']=='Amarillo'){
                $Amarillo++;
            }if($contador['ingreso_clasificacion']=='Verde'){
                $Verde++;
            }if($contador['ingreso_clasificacion']=='Azul'){
                $Azul++;
            }
        }
        ?>
        <h5 style="text-align: right"><?=$Amarillo?> AMARILLOS | <?=$Verde?> VERDES | <?=$Azul?> AZULES | <?= count($Lista)?> PACIENTES EN ESPERA</h5>
        <table class="table">
            <thead>
                <tr style="background: <?=$this->sigh->getInfo('hospital_back_primary')?>;color: white">
                    <th style="width: 4%;font-size: 11px">N°</th>
                    <th style="width: 10%;font-size: 11px">FOLIO</th>
                    <th style="width: 25%;font-size: 11px">PACIENTE</th>
                    <th style="width: 7%;font-size: 11px">SEXO</th>
                    <th style="width: 7%;font-size: 11px">EDAD</th>
                    <th style="width: 20%;font-size: 11px">ENFERMERA/MEDICO TRIAGE</th>
                    <th style="width: 12%;font-size: 11px">CLASIFICACION</th>
                    <th style="width: 15%;font-size: 11px">TIEMPO DE ESPERA</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;foreach ($Lista as $value) {$i++;?>
                <?php
                $Edad= Modules::run('Config/ModCalcularEdad',array('fecha'=>$value['paciente_fn']));
                $Diff= Modules::run('Config/getTimeElapsed',array(
                    'Time1'=>$value['lista_espera_date_envio'].' '.$value['lista_espera_time_envio'],
                    'Time2'=> date('Y-m-d H:i:s')
                ));
                ?>
                <tr id="" >
                    <td style="font-size: 9px"><?=$i?></td>
                    <td style="font-size: 9px"><?=$value['ingreso_id']?></td>
                    <td style="font-size: 9px;" >
                        <?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?>
                    </td>
                    <td style="font-size: 9px;"><?=$value['paciente_sexo']?></td>
                    <td style="font-size: 9px;"><?=($Edad->y==0 ? $Edad->m.' Meses': $Edad->y.' Años')?></td>
                    <td style="font-size: 9px;"><?=$value['ingreso_date_enfermera']?> <?=$value['ingreso_time_enfermera']?> / <?=$value['ingreso_time_medico']?> </td>
                    <td style="font-size: 9px;"><?=$value['ingreso_clasificacion']?></td>
                    <td style="font-size: 9px;"><?=$Diff->d?> Días <?=$Diff->h?> Hrs <?=$Diff->i?> Min</td>
                </tr>

                <?php }?>
            </tbody>
        </table>
    </div>
    <page_footer>
        <div style="text-align: center;line-height: 1.4;font-size: 10px">
            __________________________________________<br>
            NOMBRE Y FIRMA
        </div>
        <h6 style="text-align: center;">Página [[page_cu]]/[[page_nb]]</h6>
    </page_footer>
    
        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->setTitle('LISTA DE REZAGO DE PACIENTES EN ESPERA PARA INGRESO A CONSULTORIOS');
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('LISTA DE REZAGO DE PACIENTES EN ESPERA PARA INGRESO A CONSULTORIOS.pdf');
?> 