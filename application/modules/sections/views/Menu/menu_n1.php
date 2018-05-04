<?= modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">MENU NIVEL 1</h4>
                <a class="btn btn-circle red btn-60 btn-add-mn1 pull-right">
                    <i class="material-icons color-white i-24" >library_add</i>
                </a>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon sigh-background-secundary sigh-border">	
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" id="filter" class="form-control" placeholder="BUSCAR">
                        </div>
                    </div>
                </div>
                <div class="row margin-top-10">
                    <div class="col-md-12">
                        <table id="ver-tabla-cirugias" class="table  footable table-bordered table-hover table-no-padding" data-filter="#filter" data-page-size="10">
                            <thead>
                                <tr>
                                    <th style="width: 40%">MENU</th>
                                    <th style="width: 30%">URL</th>
                                    <th style="width: 30%">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Gestion as $value) {?>
                                <?php 
                                if($value['menuN1_c_m']=='0'){
                                    $mn2_accion='disabled';
                                }else{
                                    $mn2_accion='';
                                }
                                
                                ?>
                                <tr id="<?=$value['menuN1_id']?>" >
                                    <td><?=$value['menuN1_menu']?> </td>
                                    <td><?=$value['menuN1_url']?></td>
                                    <td class="text-center ">
                                        <a href="<?=  base_url()?>Sections/Menu/mn1_area?m=<?=$value['menuN1_id']?>">
                                            <button class="btn btn-xs btn-mini btn-warning color-white">Areas</button>
                                        </a>
                                        
                                        <a href="<?=  base_url()?>Sections/Menu/menuN2?m=<?=$value['menuN1_id']?>">
                                            <button <?=$mn2_accion?> class="btn btn-xs btn-mini btn-primary waves-effect color-white">Menu N2</button>
                                        </a>
                                        <button class="btn btn-xs btn-mini btn-success color-white btn-edit-mn1" data-id="<?=$value['menuN1_id']?>">Editar</button>
                                        <button class="btn btn-xs btn-mini btn-danger color-white btn-delete-mn1" data-id="<?=$value['menuN1_id']?>">Eliminar</button>
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
<script src="<?= base_url('assets/js/Menus.js?'). md5(microtime())?>" type="text/javascript"></script>