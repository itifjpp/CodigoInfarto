<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Especialidades">Especialidades</a></li>
            <li><a href="#">Consultorios</a></li>
        </ol>   
        <div class="row m-t-10">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">GESTIÓN DE CONSULTORIOS</h4>
                        <a class="md-btn md-fab m-b red pull-right" onclick="AbrirVista(base_url+'Sections/Especialidades/AgregarConsultorios/?es=<?=$_GET['es']?>&cons=0&accion=add',400,300)">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding"  data-filter="#filter" data-page-size="6" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th>ESPECIALIDAD</th>
                                            <th>CONSULTORIO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['especialidad_nombre']?></td>
                                            <td><?=$value['consultorio_nombre']?></td>
                                            <td>
                                                <i class="fa fa-pencil sigh-color i-20 pointer" onclick="AbrirVista(base_url+'Sections/Especialidades/AgregarConsultorios/?es=<?=$_GET['es']?>&cons=<?=$value['consultorio_id']?>&accion=edit',400,300)"></i>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 pointer especialidades-con-eliminar" data-id="<?=$value['consultorio_id']?>"></i>
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
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>