<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">INDICADOR DETALLES</span>
                    <a href="#" onclick="AbrirDocumento('<?=  base_url()?>Inicio/Documentos/IndicadorPisos?TipoBusqueda=<?=$_GET['TipoBusqueda']?>&by_fecha_inicio=<?=$_GET['by_fecha_inicio']?>&by_fecha_fin=<?=$_GET['by_fecha_fin']?>&by_hora_fecha=<?=$_GET['by_hora_fecha']?>&by_hora_inicio=<?=$_GET['by_hora_inicio']?>&by_hora_fin=<?=$_GET['by_hora_fin']?>&TIPO_ACCION=<?=$_GET['TIPO_ACCION']?>')" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Indicadores">
                        <i class="fa fa-file-pdf-o i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 15px">
                        
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon no-border back-imss pointer input-buscar">
                                    <i class="fa fa-search-plus " style="font-size: 22px"></i>
                                </span>
                                <input type="text" id="filter_cadit" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered footable"  data-filter="#filter_cadit" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th>N.S.S</th>
                                        <th style="width: 20%;">PACIENTE</th>
                                        <th>CAMA</th>
                                        <th>PISO</th>
                                        <th>SERVICIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    
                                    <tr class="<?=$class?>">
                                        <td><?=$value['triage_paciente_afiliacion']?></td>
                                        <td ><?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?></td>
                                        <td ><?=$value['cama_nombre']?></td>
                                        <td ><?=$value['piso_nombre']?></td>
                                        <td ><?=$value['area_nombre']?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="5" class="text-center">
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