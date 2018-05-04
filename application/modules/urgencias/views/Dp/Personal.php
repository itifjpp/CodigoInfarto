<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" >
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Urgencias/DistribucionPersonal">Distribución de Personal</a></li>
            <li><a href="#">Agregar Personal</a></li>
        </ol> 
        <div class="row m-t-10"> 
            <div class="col-md-12">
                <div class="grid simple" >
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR PERSONAL A LA DISTRIBUCIÓN DE PACIENTES DEL <b><?=$Dp['distribucion_fecha']?></b> TURNO <b><?=$Dp['distribucion_turno']?></b></h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-addon no-border sigh-background-secundary">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="empleado_matricula" class="form-control" placeholder="INGRESAR MATRICULA">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn sigh-background-secundary btn-block search-matricula-dp" type="button">BUSCAR</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="empleado_nombre" placeholder="NOMBRE" class="form-control" readonly="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="empleado_apellidos" placeholder="APELLIDOS" class="form-control" readonly="">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="dp_area" placeholder="AREA" class="form-control" >
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" name="empleado_id">
                                <input type="hidden" name="distribucion_id" value="<?=$_GET['dp']?>">
                                <div class="input-group">
                                    <select name="dp_tipo" class="form-control">
                                        <option value="BASE">BASE</option>
                                        <option value="RESIDENTE">RESIDENTE</option>
                                    </select>   
                                    <span class="input-group-addon sigh-background-secundary no-border pointer add-personal-dp">
                                        <i class="fa fa-check-square-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" >
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding footable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">ÁREA</th>
                                            <th style="width: 20%">TIPO</th>
                                            <th style="width: 50%">USUARIO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['dp_area']?></td>
                                            <td><?=$value['dp_tipo']?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_apellidos']?></td>
                                            <td class="text-center">
                                                <i class="fa fa-trash-o sigh-color i-20 pointer delete-dp" data-id="<?=$value['dp_id']?>"></i>
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

