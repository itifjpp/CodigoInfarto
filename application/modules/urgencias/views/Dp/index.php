<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">DISTRIBUCIÓN DE PERSONAL</h4>
                        <a class="md-btn md-fab m-b red pull-right" href="#" onclick="AbrirVista(base_url+'Urgencias/DistribucionPersonal/Agregar',400,400)" style="">
                            <i class="material-icons color-white i-24" >library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding footable">
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>TURNO</th>
                                            <th>JEFE URGENCIAS</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['distribucion_fecha']?></td>
                                            <td><?=$value['distribucion_turno']?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url()?>Urgencias/DistribucionPersonal/Personal?dp=<?=$value['distribucion_id']?>">
                                                    <i class="fa fa-users color-imss i-20"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-cloud-download color-imss i-20 pointer" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/DistribucionDePersonal?dp=<?=$value['distribucion_id']?>','DIstribucion de Personal')"></i>
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
</div>

<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgencias.js?<?= md5(microtime())?>"></script>

