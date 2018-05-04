<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        INDICADOR DE CONSULTAS POR USUARIOS LISTADO DE PACIENTES
                    </span>
                    <a href="<?=  base_url()?>Urgencias/Graficas/IndicadorTriage/?tipo=<?=$_GET['tipo']?>&turno=<?=$_GET['turno']?>&fecha=<?=$_GET['fecha']?>" class="md-btn md-fab m-b red pull-left " style="margin-left: -30px;margin-top: -20px">
                        <i class="fa fa-arrow-left i-24" ></i>
                    </a>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-uppercase">
                                <b>USUARIO:</b> <?=$Empleado['empleado_nombre']?> <?=$Empleado['empleado_ap']?> <?=$Empleado['empleado_am']?>&nbsp;&nbsp;
                                <b>TOTAL DE CONSULTAS:</b> <?=count($Gestion)?> Consultas&nbsp;&nbsp;
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered footable table-striped table-no-padding" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th>TIPO</th>
                                        <th>FECHA</th>
                                        <th>TURNO</th>
                                        <th>PACIENTE</th>
                                        <th>FOLIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$_GET['tipo']?></td>
                                        <td><?=$_GET['fecha']?></td>
                                        <td><?=$_GET['turno']?></td>
                                        <td><?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?><?=$value['triage_nombre']?></td>
                                        <td><?=$value['triage_id']?></td>
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
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js"></script>