<?= Modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10">
<div class="col-md-8 col-centered">
    <div class="grid simple">
        <div class="grid-title sigh-background-secundary">
            <h4 class="no-margin semi-bold color-white">BUSCAR USUARIO</h4>
        </div>
        <div class="grid-body">  
            <form class="" method="GET" action="<?= base_url()?>Sections/Usuarios/BuscarUsuario">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="width100" name="inputFilter">
                                <option value="">BUSCAR POR...</option>
                                <option value="POR NOMBRE" <?=$_GET['inputFilter']=='POR NOMBRE' ?'selected':''?>>POR NOMBRE</option>
                                <option value="N° DE EMPLEADO" <?=$_GET['inputFilter']=='N° DE EMPLEADO' ?'selected':''?>>N° DE EMPLEADO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon sigh-background-secundary no-border">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" name="inputSearch" value="<?=$_GET['inputSearch']?>" required="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn sigh-background-secundary btn-block">BUSCAR</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered footable table-no-padding">
                        <thead>
                            <tr>
                                <th>N° DE REGISTRO</th>
                                <th>N° DE EMPLEADO</th>
                                <th>NOMBRE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Result as $value){?>
                            <tr>
                                <td><?=$value['empleado_id']?></td>
                                <td><?=$value['empleado_matricula']?></td>
                                <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                        <tfoot class="hide-if-no-paging">
                            <tr>
                                <td colspan="3" class="text-center">
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
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/light-bootstrap/shieldui-all.min.js"></script>
<script src="<?= base_url('assets/js/Usuarios.js?'). md5(microtime())?>" type="text/javascript"></script> 

