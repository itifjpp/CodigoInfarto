<?php ob_start(); ?>
<page backtop="50mm" backbottom="7mm" backleft="12mm" backright="10mm">
    <page_header>
        <style>
            .my_table, .my_table td, .my_table th {  
                border: none;
                text-align: left;
            }
        </style>
        <div style="width: 1000px;margin-top: 45px;margin-left: 40px;position: absolute;">
            <table style="width: 100%" class="my_table">
                <tr style="">
                    <td style="width: 10%">
                        <img src="assets/img/<?=$this->sigh->getInfo('hospital_img_doc')?>" style="width: 70px">
                    </td>
                    <td style="text-align: left;width: 80%">
                        <p style="text-transform: uppercase;font-size: 15px;font-weight: bold;margin: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_siglas_des')?></p>
                        <p style="text-transform: uppercase;font-size: 14px;font-weight: 300;margin-top: 5px;margin-bottom: 0px;text-align: center"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></p>
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: 300;margin-top: 5px;margin-bottom: 0px;text-align: center">COORDINACIÓN DE ENSEÑANZA E INVESTIGACIÓN</p>
                    </td>
                    <td style="width: 10%;text-align: right;">
                        <qrcode value="<?= md5($info['ingreso_id'])?>" ec="Q" style="width: 70px;"></qrcode>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <p style="text-transform: uppercase;font-size: 13px;font-weight: bold;margin-top: 20px;margin-bottom: 0px;text-align: center;text-transform: uppercase">LISTADO DE USUARIOS REGISTRADOS EN EL PROCESO DE PREREGISTRO DE RESIDENTES E INTERNOS</p>
                    </td>
                </tr>
            </table>
            
        </div>
    </page_header>
    <style>
        .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;font-size: 9px}
        .table {border-collapse: collapse;width: 100%;}
        .table th, .table td {padding: 4px;}
    </style>
    <table class="table">
        <thead>
            <tr>
                <th >N° REGISTRO</th>
                <th >N° EMPLEADO</th>
                <th >NOMBRE COMPLETO</th>
                <th >CURP</th>
                <th >RFC</th>
                <th>ESPECIALIDAD</th>
                <th>CATEGORIA</th>
                <th>INGRESO AL ISSSTE</th>
                
            </tr>
        </thead>
        <?php foreach ($sqlUsers as $value) {?>
        <tr>
            <td style="width: 8%"><?=$value['empleado_id']?></td>
            <td style="width: 9%"><?=$value['empleado_matricula']!='' ? $value['empleado_matricula']:'SIN ASIGNAR'?></td>
            <td style="width: 19%"><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
            <td style="width: 12%"><?=$value['empleado_curp']?></td>
            <td style="width: 12%"><?=$value['empleado_rfc']?></td>
            <td style="width: 16%"><?=$value['eua_especialidad']?></td>
            <td style="width: 12%"><?=$value['empleado_categoria']?></td>
            <td style="width: 11%"><?=$value['empleado_ingreso']?></td>
            
        </tr>
        <?php }?>
    </table>
    <page_footer>
        <div style="text-align:right">
            PÁGINA [[page_cu]]/[[page_nb]]
        </div>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('L','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('LISTADO DE PREREGISTRO DE RESIDENTE E INTERNOS');
    $pdf->Output('LISTADO DE PREREGISTRO DE RESIDENTE E INTERNOS.pdf');
?>