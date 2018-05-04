<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">LISTADO DE PACIENTES ACTUAL INGRESADOS A URGENCIAS</span>
                    <a href="#" onclick="AbrirDocumento(base_url+'Inicio/Documentos/ReportesIngresoUrgencias')" class="md-btn md-fab m-b hide red waves-effect pull-right">
                        <i class="mdi-social-person-add i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 0px">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-user-plus"></i>
                                </span>
                                <input type="text" id="filter" class="form-control" placeholder="BUSCAR...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table footable table-filtros table-bordered table-hover table-no-padding"  data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>N° DE FOLIO</th>
                                        <th style="width: 30%">NOMBRE DEL PACIENTE</th>
                                        <th>FECHA</th>
                                        <th>CLASIFICACION</th>
                                        <th>DESTINO ACTUAL.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_id']?></td>
                                        <td>
                                            <?=$value['triage_nombre']?> <?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?>        
                                        </td>
                                        <td><?=$value['acceso_fecha']?> <?=$value['acceso_hora']?></td>
                                        <td><?=$value['triage_color']?></td>
                                        <td><?=$value['triage_en']?></td>
                                    </tr>
                                    <?php } ?>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Medicotriage.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/IdleTimer.js?').md5(microtime())?>" type="text/javascript"></script>