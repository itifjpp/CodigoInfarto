<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered"> 
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>LISTADO DE PRE-ALTAS DE PACIENTES</strong>
                    </span>
                    <a  href="<?= base_url()?>Consultaexterna/ReportesPrealtas" class="md-btn md-fab m-b tip red waves-effect pull-right" data-placement="left" data-original-title="Reportes de Pre-Altas">
                        <i class="fa fa-bar-chart i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss border-back-imss">
                                    <i class="fa fa-search-plus"></i>
                                </span>
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-no-padding footable" data-filter="#filter" data-page-size="10" data-limit-navigation="4">
                                <thead>
                                    <tr>
                                        <th>N° DE FOLIO</th>
                                        <th>PACIENTE</th>
                                        <th>FECHA DE PRE-ALTA</th>
                                        <th>CAMA</th>
                                        <th>SERVICIO</th>
                                        <th>ALTA</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['triage_id']?></td>
                                        <td><?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> <?=$value['triage_nombre']?></td>
                                        <td>
                                            
                                            <?=$value['prealta_fecha']?> <?=$value['prealta_hora']?>
                                        </td>
                                        <td><?=$value['cama_nombre']?></td>
                                        <td><?=$value['area_nombre']?></td>
                                        <td><?=$value['prealta_confirm']=='' ? 'EN ESPERA':$value['prealta_confirm']?></td>
                                        <td>
                                            <?php if($value['prealta_confirm']==''){?>
                                            <i class="fa fa-check-square-o color-imss i-20 pointer tip prealta-accion" data-id="<?=$value['triage_id']?>" data-confirm="ALTA EFECTIVA" data-original-title="ALTA EFECTIVA"></i>&nbsp;
                                            <i class="fa fa-times color-imss i-20 pointer tip prealta-accion" data-id="<?=$value['triage_id']?>" data-confirm="ALTA CANCELADA" data-original-title="ALTA CANCELADA"></i>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="7" class="text-center">
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
<script src="<?= base_url('assets/js/ConsultaExterna.js?').md5(microtime())?>" type="text/javascript"></script>