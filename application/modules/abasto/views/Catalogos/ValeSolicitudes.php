<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-12 col-centered">
            <div class="box-inner padding">
                <ol class="breadcrumb">
                    <li><a style="text-transform: uppercase" href="#">VALE DE SOLICITUDES</a></li>
                </ol>
                <div class="panel panel-default">
                    <div class="paciente-sexo-mujer hide" style="background: pink;width: 100%;height: 10px"></div>
                    <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        <b>SOLICITUDES</b>
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
                                                <th>ÁREA</th>
                                                <th>MÉDICO</th>
                                                <th>PROCEDIMIENTO</th>
                                                <th>CANTIDAD</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($solicitados AS $value) { ?>
                                            <tr>
                                                <td><?=$value['empleado_area']?></td>
                                                <td><?php $medico = $this->config_mdl->_query("SELECT *FROM os_empleados WHERE os_empleados.empleado_id =".$value['empleado_id'])[0]; echo $medico['empleado_nombre'].' '.$medico['empleado_apellidos'];?></td>
                                                <td><?=$value['tratamiento_qx']?></td>
                                                <td><?php $TOTAL_PETI = $this->config_mdl->_query("SELECT COUNT(abs_solicitud_osteo.peticion_id) AS total FROM abs_solicitud_osteo WHERE abs_solicitud_osteo.rango_id = ".$value['rango_id'])[0]; echo $TOTAL_PETI['total']?></td>
                                                <td style="width:15%">
                                                    <center><a href="<?= base_url()?>Abasto/MinimaInvacion/SolicitudDetalles?peticion=<?= $value['tratamiento_id']?>&rango=<?=$value['rango_id']?>" ><i class="fa fa-share-square i-16 pointer icono-accion" title="Ver disponibles"></i></a></center>
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
