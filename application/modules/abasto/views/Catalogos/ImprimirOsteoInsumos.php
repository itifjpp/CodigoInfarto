<?php ob_start(); ?>
<page backleft="12.5mm" backright="15mm" backtop="20mm" backbottom="5mm">
    <div style="position: absolute;top: -5px">
        <div style="position: absolute;left: 250px">
            <table style="font-size: 13px">
                <thead>
                    <tr>
                        <th>RANGO</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($solicitados as $value) {?>
                    <tr>
                        <td>
                             <?php $dato= $this->config_mdl->_query("SELECT *FROM abs_rangos WHERE abs_rangos.rango_id =".$value['rango_id'])[0]; echo $dato['rango_titulo']?>
                        </td>
                        <td><?=$value['peticion_cantidad']?></td>
                    </tr>
                    <?php }?>
                </tbody>
                <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="6" id="footerCeldas" class="text-center">
                            <ul class="pagination"></ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</page>
<?php 
    $html=  ob_get_clean();
    $pdf=new HTML2PDF('P','A4','fr','UTF-8');
    $pdf->writeHTML($html);
    $pdf->pdf->IncludeJS("print(true);");
    $pdf->Output('INSUMOS'.$_GET['codigo'].'.pdf');
?>