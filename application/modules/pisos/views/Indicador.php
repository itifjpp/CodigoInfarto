<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss text-center">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;text-align: center">
                        <b>INDICADOR DE CAMAS PISOS</b>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" >
                        <div class="col-md-12">
                            <table class="table footable table-bordered">
                                <thead>
                                    <tr>
                                        <th>PISO</th>
                                        <th>ÁREA</th>
                                        <th>CAMA</th>
                                        <th>FECHA & HORA ESTADO</th>
                                        <th>ESTATUS</th>
                                        <th>TIEMPO TRANSCURRIDO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['piso_nombre']?></td>
                                        <td><?=$value['area_nombre']?></td>
                                        <td><?=$value['cama_nombre']?></td>
                                        <td><?=$value['cama_fh_estatus']=='' ? 'Sin Especificar' : $value['cama_fh_estatus']?></td>
                                        <td><?=$value['cama_status']?></td>
                                        <td>
                                            <?php 
                                            if($value['cama_fh_estatus']!=''){
                                                
                                                
                                                $TiempoHoraCero=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                    'Tiempo1'=>$value['cama_fh_estatus'],
                                                    'Tiempo2'=> date('Y-m-d H:i:s'),
                                                ));
                                                echo $TiempoHoraCero->h.' Horas '.$TiempoHoraCero->i.' Min'.' '.$TiempoHoraCero->s;
                                            }else{
                                                echo 'Sin Especificar';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <ul class="pagination"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
