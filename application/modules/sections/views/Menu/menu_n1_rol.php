<?= modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
     
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Menu/Menus">Menu Nivel 1</a></li>
            <li><a href="#">Asignar area a menu</a></li>
        </ol> 
        <div class="grid simple" style="margin-top: 10px!important">
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">ASIGNAR AREA DE ACCESO A MENUS</h4>
                <a class="btn btn-circle btn-60 red btn-add-mn1-rol pull-right" data-id="<?=$_GET['m']?>">
                    <i class="material-icons i-24 color-white" >library_add</i>
                </a>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group m-b ">
                            <span class="input-group-addon sigh-background-secundary no-border" >
                                <i class="fa fa-search"></i></span>
                            <input type="text" class="form-control " id="filter" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <table id="ver-tabla-cirugias" class="table table-bordered footable"  data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>MENU</th>
                                    <th>URL</th>
                                    <th>ÁREA DE ACCESO</th>
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <tr id="<?=$value['menuN1_id']?>" >
                                    <td><?=$value['menuN1_menu']?> </td>
                                    <td><?=$value['menuN1_url']?></td>
                                    <td><?=$value['areas_acceso_nombre']?></td>
                                    <td class="text-center">
                                        <i class="fa fa-trash-o del-mn1-rol icono-accion pointer" data-m="<?=$value['menuN1_id']?>" data-r="<?=$value['areas_acceso_id']?>"></i>

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
<div class="box-row hide">
    <div class="box-cell">
        <div class="box-inner">
             
            <div class="col-md-12 col-centered" style="margin-top: -10px">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500"></span>
                        
                    </div>
                    <div class="panel-body b-b b-light">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Menus.js?'). md5(microtime())?>" type="text/javascript"></script>