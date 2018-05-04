<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">Registro de acciones</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <input type="text" class="form-control dd-mm-yyyy" name="acceso_fecha" placeholder="Seleccionar Fecha">
                                <span class="input-group-addon no-border back-imss pointer input-buscar-registro">
                                    <i class="fa fa-search-plus " style="font-size: 22px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover footable table-registros"  data-filter="#filter" data-page-size="20" data-limit-navigation="7">
                        <thead>
                            <tr>
                                <th>N° Registro</th>
                                <th>Tipo</th>
                                <th>Fecha & Hora</th>
                                <th>Turno</th>
                                <th>Empleado</th>
                                
                            </tr>
                        </thead>
                        <tbody></tbody>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Registros.js?'). md5(microtime())?>" type="text/javascript"></script>