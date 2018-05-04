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
                        <th colspan="5" style="text-align: center;line-height: 1.4">
                            <b >
                                REPORTE DE PRESTACIONES DE ROPA QUIRÚRGICA AL PERSONAL<br>
                                DEL <?=$_GET['start']?> AL <?=$_GET['end']?>
                            </b>
                        </th>
                    </tr>
                    <tr>
                        <th style=";font-size: 9px;">FECHA ENTREGA</th>
                        <th style=";font-size: 9px;">FECHA DEVOLUCIÓN</th>
                        <th style=";font-size: 9px;">ESTADO</th>
                        <th style=";font-size: 9px;">MEDICO</th>
                        <th style=";font-size: 9px;">MATRICULA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Gestion as $value) {
                        if($value['rq_e_fecha']==''){
                            $color='color:red';
                        }else{
                            $color='';
                        }
                    ?>
                    <tr>
                        <td style="width: 15%;font-size: 9px;<?=$color?>"><?=$value['rq_r_fecha']?> </td>
                        <td style="width: 15%;text-transform: uppercase;font-size: 9px;<?=$color?>"><?=$value['rq_e_fecha']?></td>
                        <td style="width: 15%;text-transform: uppercase;font-size: 9px;<?=$color?>"><?=$value['rq_e_fecha']=='' ? 'SIN DEVOLDER':'OK'?></td>
                        <td style="width: 40%;text-transform: uppercase;font-size: 9px;<?=$color?>"><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                        <td style="width: 15%;text-transform: uppercase;font-size: 9px;<?=$color?>"><?=$value['empleado_matricula']?></td>
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
    $pdf=new HTML2PDF('P','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('REPORTE DE PRESTACIONES DE ROPA QUIRÚRGICA AL PERSONAL');
    $pdf->Output('REPORTE DE PRESTACIONES DE ROPA QUIRÚRGICA AL PERSONAL.pdf');
?>