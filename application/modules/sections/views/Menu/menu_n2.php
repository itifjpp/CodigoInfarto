<?= modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">Menu Nivel 2</h4>
                        <a class="md-btn md-fab m-b red waves-effect btn-add-mn2 pull-right" data-id="<?=$_GET['m']?>">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control " id="filter" placeholder="Buscar...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table  class="table table-bordered footable table-no-padding m-t-10"  data-filter="#filter" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th>MENU NIVEL 1</th>
                                            <th>MENU NIVEL 2</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                        <?php 
                                        if($value['menuN2_c_m']=='0'){
                                            $mn2_accion='disabled';
                                        }else{
                                            $mn2_accion='';
                                        }

                                        ?>
                                        <tr id="<?=$value['menuN2_id']?>" >
                                            <td><?=$value['menuN1_menu']?> </td>
                                            <td><?=$value['menuN2_menu']?></td>
                                            <td class="text-center ">
                                                <a href="<?=  base_url()?>Sections/Menu/menuN3?m=<?=$value['menuN2_id']?>">
                                                    <button <?=$mn2_accion?> class="btn btn-mini green waves-effect color-white">Menu N3</button>
                                                </a>
                                                <button  class="btn btn-mini blue color-white btn-edit-mn2" data-id="<?=$value['menuN2_id']?>">Editar</button>
                                                <button class="btn btn-mini red color-white btn-delete-mn2" data-id="<?=$value['menuN2_id']?>">Eliminar</button>
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
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Menus.js?'). md5(microtime())?>" type="text/javascript"></script>