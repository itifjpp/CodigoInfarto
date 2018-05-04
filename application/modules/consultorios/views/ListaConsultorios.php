<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered" style="margin-top: -20px">
            <div class="panel panel-default ">
                
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Gestión de Consultorios</span>
                    <a href="#" md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip disabled" >
                        <i class="mdi-content-add i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="input-group m-b ">
                                <span class="input-group-addon back-imss no-border" >
                                    <i class="fa fa-search-plus"></i>
                                </span>
                                <input type="text" class="form-control" id="Filtro_Consultorio" placeholder="Buscar...">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable" data-filter="#Filtro_Consultorio" data-limit-navigation="7"data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>Consultorio</th>
                                        <th>Consultorio de Especialidad</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['consultorio_nombre']?></td>
                                        <td><?=$value['consultorio_especialidad']?></td>
                                        <td>
                                            <i class="fa fa-pencil pointer icono-accion" style="opacity: 0.4"></i>&nbsp;
                                            <i class="fa fa-trash-o icono-accion pointer" style="opacity: 0.4"></i>
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
<?= modules::run('Sections/Menu/loadFooter'); ?>