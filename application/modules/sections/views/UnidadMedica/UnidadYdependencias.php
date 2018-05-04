<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered" style="margin-top: -20px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;"><?= $UNIDAD_PADRE['unidad_nombre'] ?></span> <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;margin-left: 80px !important;">UNIDAD NÚMERO :<?=$UNIDAD_PADRE['numero_unidad_atencion']?></span> 
                    <a href="<?=  base_url()?>sections/unidadMedica/FiltrarUnidadesDisponibles?idUnidad=<?=$_GET['id']?>&tipo_unidad=<?=$_GET['tipo_unidad']?>" md-ink-ripple="" target="_blank" class=" agregarUMF md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Agregar Dependencias">
                        <i class="fa fa-plus i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-4" style="margin-top: 10px">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" id="buscar" name="triage_id" placeholder="Buscar Unidad">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12"><br>
                            <table class="table table-hover table-bordered footable" data-filter="#buscar" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>UNIDAD</th>
                                        <th>NO. DE UNIDAD</th>
                                        <th>NIVEL</th>
                                        <th>ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($UNIDADES_DEPENDIENTES as $value) {?>
                                    <tr>
                                        <td><?=$value['unidad_nombre']?></td>
                                        <td><?=$value['numero_unidad_atencion']?></td>
                                        <td><?=$value['unidad_nivel']?></td>
                                        <td>
                                            <a href="<?=base_url()?>sections/unidadMedica/EditarUnidad/?id=<?=$value['id_unidad_atencion']?>" target="_blank">
                                                <i class="fa fa-pencil editar " data-original-title="Editar datos"></i>
                                            </a>&nbsp;&nbsp;
                                            <a class="md-btn green quitar" style="width: 25px !important;height: 10px !important;" data-idZonificacion="<?= $value['id_zonificacion']?>" data-unidadUMF="<?= $value['id_unidad_atencion']?>">
                                                <p style="color: white !important; margin-top: -23px !important; font-size: 30px">-</p>
                                            </a>
                                            &nbsp;&nbsp;
                                            <?php if($_GET['tipo_unidad']=='UMAE') {?>
                                            <a href="<?= base_url()?>sections/unidadMedica/FiltrarUnidadesDependientes/?id=<?=$value['id_unidad_atencion']?>" data- target="_blank">
                                                <i class="fa fa-share" title="Ver detalles"></i>
                                            </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php } ?>
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
<script src="<?= base_url('assets/js/sections/UnidadMedica.js?'). md5(microtime())?>" type="text/javascript"></script> 

