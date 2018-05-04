<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <a href="<?=  base_url()?>Um/Hospitales" class="md-btn md-fab m-b red " style="position: absolute;left: -30px;top: 13px">
                        <i class="mdi-navigation-arrow-back i-24"></i>
                    </a>
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">REPORTE DE STATUS DEL HOSPITAL</span>
                    <a class="md-btn md-fab m-b red pull-left" href="<?= base_url()?>Um/Hospitales/ReportesAdd?hos=<?=$_GET['hos']?>&st=0&accion=add" style="position: absolute;right: 10px;top: 15px">
                        <i class="mdi-av-my-library-add i-24" ></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="footable table table-bordered table-striped table-no-padding">
                                <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['status_fecha']?></td>
                                        <td><?=$value['status_hora']?></td>
                                        <td>
                                            
                                            <a href="<?= base_url()?>Um/Hospitales/ReportesAdd?hos=<?=$_GET['hos']?>&st=<?=$value['status_id']?>&accion=edit">
                                                <i class="fa fa-medkit i-20 color-imss"></i>
                                            </a>&nbsp;
                                            <a href="<?= base_url()?>Sections/Reportes/ReporteStatusHospital?st=<?=$value['status_id']?>&hos=<?=$value['hospital_id']?>">
                                                <i class="fa fa-file-excel-o color-imss i-20"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-file-pdf-o i-20 color-imss pointer" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ReporteStatusHospital?st=<?=$value['status_id']?>&hos=<?=$value['hospital_id']?>')"></i>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr class="hide-if-no-paging">
                                        <td colspan="3" class="text-center">
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
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


