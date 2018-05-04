<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <div class="panel panel-default " style="margin-top: -20px">
                    <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                    <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>VALES DE SERVICIO</b>&nbsp;
                    </span>
                </div>
                    <div class="panel-body b-b b-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon back-imss "><i class="fa fa-search"></i></span>
                                        <input type="text" required="" class="form-control" id="buscar" placeholder="Buscar Solicitud">
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    <table class="table table-hover table-bordered footable table-filtros" data-page-size="7" data-filter="#buscar" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th>PROCEDIMIENTO</th>
                                                <th>PACIENTE</th>
                                                <th>MÉDICO</th>
                                                <th>PRIORIDAD</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($PROCEDIMIENTOS AS $value) { ?>
                                            <tr>
                                                <td><?=$value['procedimiento_nombre']?></td>
                                                <td><?=$value['triage_nombre_ap']?> <?=$value['triage_nombre_am']?> <?=$value['triage_nombre']?></td>
                                                <td><?php $medico = $this->config_mdl->_query("SELECT *FROM os_empleados WHERE os_empleados.empleado_matricula =".$value['ci_mmc'])[0]; echo $medico['empleado_nombre'].' '.$medico['empleado_apellidos'];?></td>
                                                <td><?= $value['ci_prioridad']?></td>
                                                <td style="width:15%">
                                                    <i class="fa fa-calendar-o i-16 pointer icono-accion autorizar-confirmar" data-vale_id="<?=$value['vale_id']?>" title="Autorizar"></i>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <?php if($value['cirugia_status'] == 0) {?>
                                                    <i style="color: #F9F900;" class="fa fa-check-circle i-20 pointer autorizado" title="Por Autorizar"></i>
                                                    <?php } else if($value['cirugia_status'] == 1){ ?>
                                                    <i style="color: #31B404;" class="fa fa-check-circle i-20 pointer autorizado" title="Autorizado"></i>
                                                    <?php }  else {?>
                                                    <i style="color: #FF0000;" class="fa fa-check-circle i-20 pointer porAutorizar" title="Rechazado"></i>
                                                    <?php } ?>
                                                </td>
                                           </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot class="hide-if-no-paging">
                                            <tr>
                                                <td colspan="5" id="footerCeldas" class="text-center">
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
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>

