<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">GESTIÓN DE CAMAS</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 15px">
                        
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon no-border back-imss pointer input-buscar">
                                    <i class="fa fa-search-plus " style="font-size: 22px"></i>
                                </span>
                                <input type="text" id="Filtro_Camas" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable table-usuarios"  data-filter="#Filtro_Camas" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th>Área</th>
                                        <th>Cama</th>
                                        <th>Estado</th>
                                        <th>Paciente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['area_nombre']?></td>
                                        <td><?=$value['cama_nombre']?></td>
                                        <td>
                                            <?php if($_GET['tipo']=='Total'){?>
                                            No Aplica
                                            <?php }else{?>
                                            <?=$value['cama_status']?>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($_GET['tipo']=='Ocupados'){?>
                                            <?= Modules::run('Sections/Camas/DetallePaciente',array('triage_id'=>$value['cama_dh']))['triage_nombre'].' '.['triage_nombre_ap'].' '.['triage_nombre_am']?> 
                                            <?php }else{?>
                                            No Aplica
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
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