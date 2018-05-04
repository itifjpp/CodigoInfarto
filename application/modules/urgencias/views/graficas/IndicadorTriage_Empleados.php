<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        INDICADOR DE CONSULTAS POR USUARIOS
                    </span>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered footable table-striped table-no-padding" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th >MATRICULA</th>
                                        <th data-hide="phone" >USUARIO</th>
                                        <th data-hide="phone">FECHA</th>
                                        <th data-hide="phone">TURNO</th>
                                        <th>ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['empleado_matricula']?></td>
                                        <td><?=$value['empleado_nombre']?> <?=$value['empleado_am']?> <?=$value['empleado_am']?></td>
                                        <td><?=$value['acceso_fecha']?></td>
                                        <td><?=$value['acceso_turno']?></td>
                                        <td>
                                            <a href="<?= base_url()?>Urgencias/Graficas/IndicadorTriagePacientes/?empleado=<?=$value['empleado_id']?>&turno=<?=$_GET['turno']?>&fecha=<?=$_GET['fecha']?>&tipo=<?=$_GET['tipo']?>" >
                                                <i class="fa fa-users icono-accion"></i>
                                            </a>
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
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js"></script>