<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INTERCONSULTAS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="input-group transparent">
                                    <span class="input-group-addon">
                                        <i class="fa fa-search "></i>
                                    </span>
                                    <input type="search" class="form-control" id="filter" placeholder="BUSCAR...">
                                </div>
                            </div>
                            <div class="col-xs-offset-4 col-xs-4">
                                <div class="alert alert-danger">
                                    <h5 class="no-margin text-right"><b>TOTAL INTERCONSULTAS: </b> <?= count($Gestion)?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-5">
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding footable" data-filter="#filter">
                                    <thead>
                                        <tr>
                                            <th style="width: 18%">NOMBRE DEL PACIENTE</th>
                                            <th style="width: 12%">CLASIFICACIÓN</th>
                                            <th style="width: 15%">FECHA SOLICITUD</th>
                                            <th style="width: 18%">SERVICIO SOLICITADO</th>
                                            <th style="width: 18%">MÉDICO SOLICITANTE</th>
                                            <th style="width: 10%">ESTADO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) { ?>
                                        <tr>
                                            <td><?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?></td>
                                            <td><?=$value['ingreso_clasificacion']?></td>
                                            <td><?=$value['doc_fecha']?> <?=$value['doc_hora']?></td>
                                            <td><?=$value['doc_servicio_solicitado']?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                            <td><?=$value['doc_estatus']?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="hide-if-no-paging">
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
</div>
<?=Modules::run('Sections/Menu/loadFooter'); ?>



