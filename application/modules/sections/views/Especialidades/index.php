<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row" >
            <div class="col-md-9 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">GESTIÓN DE ESPECIALIDADES</h4>
                        <a class="md-btn md-fab m-b red pull-right" onclick="AbrirVista(base_url+'Sections/Especialidades/Agregar/?es=0&accion=add',500,400)">
                            <i class="material-icons i-24 color-white">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding"  data-filter="#filter" data-page-size="6" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th>ESPECIALIDAD</th>
                                            <th>CONSULTORIOS</th>
                                            <th>INGRESO-EGRESO 43029</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['especialidad_nombre']?></td>
                                            <td><?=$value['especialidad_consultorios']?></td>
                                            <td><?=$value['especialidad_43029']?></td>
                                            <td>
                                                <i class="fa fa-pencil sigh-color i-20 pointer" onclick="AbrirVista(base_url+'Sections/Especialidades/Agregar/?es=<?=$value['especialidad_id']?>&accion=edit',500,400)"></i>&nbsp;
                                                <a href="<?= base_url()?>Sections/Especialidades/Consultorios?es=<?=$value['especialidad_id']?>">
                                                    <i class="fa fa-trello sigh-color i-20"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 tip pointer especialidades-eliminar" data-id="<?=$value['especialidad_id']?>"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="4" class="text-center">
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
<script src="<?= base_url('assets/js/sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>