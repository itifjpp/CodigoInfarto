<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">GESTIÓN DE EQUIPOS</h4>
                <a href="#" class="md-btn md-fab btnHospitalEquipoadd m-b red waves-effect pull-right" data-id="0" data-ip="" data-descripcion="" data-accion="add" data-hospital="<?=$_GET['hos']?>">
                    <i class="material-icons i-24 color-white">library_add</i>
                </a>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon sigh-background-secundary no-border">
                                    <i class="fa fa-desktop"></i>
                                </span>
                                <input type="text" id="filter" class="form-control" placeholder="Buscar...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                            <thead>
                                <tr>
                                    <th style="width: 5%">N°</th>
                                    <th style="width: 12%">IP</th>
                                    <th style="width: 20%">DESCRIPCIÓN</th>
                                    <th style="width: 25%">ÁREA DE ACCESO</th>
                                    <th>FECHA DE ACCESO</th>
                                    <th>ESTADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $i=0;foreach ($Gestion as $value){$i++;?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$value['equipo_ip']?></td>                                        
                                    <td><?=$value['equipo_descripcion']?></td>
                                    <td><?=$value['equipo_estado']=='' || $value['equipo_estado']=='Offline' ? 'Offline':$value['equipo_acceso_area']?></td>
                                    <td><?=$value['equipo_estado']=='' || $value['equipo_estado']=='Offline' ? 'Offline':$value['equipo_acceso_fecha']?></td>
                                    <td><?=$value['equipo_estado']=='' || $value['equipo_estado']=='Offline' ? 'Offline':$value['equipo_estado']?></td>
                                    <td>
                                        <i class="fa fa-pencil i-20 color-imss pointer btnHospitalEquipoadd" data-id="<?=$value['equipo_id']?>" data-ip="<?=$value['equipo_ip']?>" data-accion="edit" data-hospital="<?=$value['hospital_id']?>" data-descripcion="<?=$value['equipo_descripcion']?>"></i>&nbsp;
                                        <i class="fa fa-trash-o i-20 color-imss pointer iconHospitalEquipoRemove" data-id="<?=$value['equipo_id']?>"></i>
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

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Hospitales.js?'). md5(microtime())?>" type="text/javascript"></script>