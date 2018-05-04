<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;font-weight: bold;text-transform: uppercase">GESTIÓN DE CAMAS <?php if(isset($_GET['area_id'])) { echo ': '.count($Gestion).' Camas en Total';} ?></span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form action="<?= base_url()?>Observacion/Camas/Estados" method="GET">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="input-group m-b">
                                        <span class="input-group-addon">SELECCIONAR</span>
                                        <select class="form-control" name="area_id">
                                            <option value="">SELECCIONAR ÁREA</option>
                                            <?php foreach ($Areas as $value) {?>
                                            <option value="<?=$value['area_id']?>"><?=$value['area_nombre']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 no-padding" >
                                <button class="btn back-imss btn-block">Aceptar</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-no-padding footable" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>ÁREA</th>
                                        <th>NOMBRE DE LA CAMA</th>
                                        <th>ESTADO</th>
                                        <th>TIPO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value){?>
                                    <tr>
                                        <td><?=$value['area_nombre']?></td>
                                        <td><?=$value['cama_nombre']?></td>
                                        <td><?=$value['cama_status']?></td>
                                        <td><?=$value['cama_tipo']?></td>
                                        <td>
                                            <?php if($value['cama_status']!='Ocupado'){?>
                                                <?php if($value['cama_display']==''){?>
                                            <i class="fa fa-window-close icono-accion tip pointer camas-acciones" data-cama="<?=$value['cama_id']?>" data-display="hidden" data-original-title="Desabilitar esta cama"></i>
                                                <?php }else{?>
                                            <i class="fa fa-check-square-o icono-accion tip pointer camas-acciones" data-cama="<?=$value['cama_id']?>" data-display="" data-original-title="Habilitar esta cama"></i>
                                                <?php }?>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php if(!isset($_GET['area_id'])){?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h5>POR FAVOR SELECCIONE UNA ÁREA</h5>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
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
<script src="<?= base_url('assets/js/Observacion.js?'). md5(microtime())?>" type="text/javascript"></script>