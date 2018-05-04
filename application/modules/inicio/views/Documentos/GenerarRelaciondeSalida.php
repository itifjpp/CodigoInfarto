<?php ob_start(); ?>
<page backtop="30mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>
        <img src="assets/img/logo_left.jpg" style="width: 50%;position: absolute;left: 30px;right: 10px">
        <h4 style="text-align: center;margin-top: 20px"><?=$this->sigh->getInfo('hospital_tipo')?></h4>
        <h4 style="text-align: center;margin-top:-10px"><?=$this->sigh->getInfo('hospital_clasificacion')?> | <?=$this->sigh->getInfo('hospital_nombre')?></h4>
        
    </page_header>
    <div style="position: absolute;margin-top: 10px">
        
        <style>
            .table, .table td, .table th {    border: 1px solid #ddd;text-align: left;}
            .table {border-collapse: collapse;width: 100%;}
            .table th, .table td {padding: 5px;}
        </style>
        <h4 style="text-align: center">RELACIÓN DE SALIDA DE ALMACEN DE MATERIALES DE OSTEOSÍNTESIS</h4>
        <table style="width: 100%" class="table">
            <tr>
                <th style="width: 70%;font-size: 10px;">USUARIO QUE GENERÓ RELACIÓN DE SALIDA</th>
                <th style="width: 30%;font-size: 10px;">FECHA Y HORA DE GENERACIÓN</th>
            </tr>
            <tr>
                <td style="font-size: 10px;;text-transform: uppercase"><?=$info['empleado_nombre']?> <?=$info['empleado_ap']?> <?=$info['empleado_am']?></td>
                <td style="font-size: 10px"><?=$info['rc_fecha']?> <?=$info['rc_hora']?></td>
            </tr>
        </table><br><br>
        <table style="width: 100%" class="table">
            <thead>
                <tr>
                    <th style="font-size: 10px;">SISTEMA</th>
                    <th style="font-size: 10px;">ELEMENTO</th>
                    <th style="font-size: 10px;">RANGO</th>
                    <th style="font-size: 10px;">CÓDIGO</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Gestion as $value) {?>
                <tr>
                    <td style="width: 30%;font-size: 10px;"><?=$value['sistema_titulo']?> </td>
                    <td style="width: 30%;text-transform: uppercase;font-size: 9px;"><?=$value['elemento_titulo']?></td>
                    <td style="width: 25%;text-transform: uppercase;font-size: 9px;"><?=$value['rango_titulo']?></td>
                    <td style="width: 15%;text-transform: uppercase;font-size: 9px;"><?=$value['inventario_id']?></td>

                </tr>
                <?php }?>
            </tbody>
        </table>
        
        
    </div>
    <page_footer>
        <table style="width: 100%">
            <tr>
                <td style="width: 40%;text-align: center;font-size: 10px">_________________________________</td>
                <td style="width: 30%;text-align: center;font-size: 10px">_________________________________</td>
                <td style="width: 30%;text-align: center;font-size: 10px">_________________________________</td>
            </tr>
            <tr>
                <td style="width: 40%;text-align: center;font-size: 10px">NOMBRE Y APELLIDOS DE QUIEN RECIBE</td>
                <td style="width: 30%;text-align: center;font-size: 10px">MATRICULA</td>
                <td style="width: 30%;text-align: center;font-size: 10px">FIRMA</td>
            </tr>
            
        </table>
        <barcode type="C128A" value="<?=$info['rc_id']?>" style="height: 50px;margin-left: 280px;margin-top: 30px" ></barcode>
    </page_footer>

        
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','es','UTF-8');
    $pdf->writeHTML($html);
    //$pdf->pdf->IncludeJS("print(true);");
    $pdf->pdf->SetTitle('RELACIÓN DE SALIDA DE ALMACEN DE MATERIALES DE OSTEOSÍNTESIS');
    $pdf->Output('RELACIÓN DE SALIDA DE ALMACEN DE MATERIALES DE OSTEOSÍNTESIS.pdf');
?>