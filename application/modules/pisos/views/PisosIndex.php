<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white semi-bold text-uppercase">Gestión de Pisos</h4>
                        <a href="#" data-piso="" data-accion="add"  data-id="0" data-hospital="0" class="md-btn btn-add-piso md-fab m-b red pull-right">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon sigh-background-secundary no-border">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="filter">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding"  data-filter="#filter" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">PISO</th>
                                            <th>N° CAMAS</th>
                                            <th style="width: 40%">HOSPITAL</th>
                                            <th class="text-center">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                        <tr id="<?=$value['piso_id']?>" >
                                            <td><?=$value['piso_nombre']?></td>
                                            <td>
                                                <?php 
                                                $sql0=$this->config_mdl->sqlGetDataCondition('sigh_pisos_camas',array(
                                                   'piso_id'=>$value['piso_id'] 
                                                ));
                                                echo count($sql0).' CAMAS';
                                                ?>
                                            </td>
                                            <td><?=$value['hospital_tipo']?> <?=$value['hospital_nombre']?></td>
                                            <td class="text-center ">
                                                <a href="<?=  base_url()?>Pisos/AsignarCamas?piso=<?=$value['piso_id']?>">
                                                    <i class="fa fa-bed tip i-20 sigh-color" data-original-title="Camas"></i>
                                                </a>&nbsp;
                                                <a href="<?=  base_url()?>Pisos/Salas/<?=$value['piso_id']?>" target="_blank" class="hide">
                                                    <i class="fa fa-trello tip i-20 sigh-color" data-original-title="Salas"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-pencil pointer btn-add-piso i-20 sigh-color"  data-piso="<?=$value['piso_nombre']?>" data-accion="edit"  data-id="<?=$value['piso_id']?>" data-hospital="<?=$value['hospital_id']?>"></i>&nbsp;
                                                <i class="fa fa-trash-o pointer i-20 sigh-color" style="opacity: 0.4"></i>
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
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Pisos.js?time=<?= date('YmdHis')?>" type="text/javascript"></script>