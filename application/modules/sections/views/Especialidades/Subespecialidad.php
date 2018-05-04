<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Especialidades">Especialidades</a></li>
            <li><a href="#">Subespecialidades</a></li>
        </ol>   
        <div class="box-inner panel-default col-md-10 col-centered" style="margin-top: 40px">
            <div class="panel">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">GESTIÓN DE SUBESPECIALIDADES</span>
                    <a class="md-btn md-fab m-b red pull-right" onclick="AbrirVista(base_url+'Sections/Especialidades/SubespecialidadAgregar/?es=<?=$_GET['es']?>&sub=0&accion=add',400,300)">
                        <i class="mdi-av-queue i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable  table-no-padding"  data-filter="#filter" data-page-size="6" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th>ESPECIALIDAD</th>
                                        <th>SUBESPECIALIDAD</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['especialidad_nombre']?></td>
                                        <td><?=$value['sub_nombre']?></td>
                                        <td>
                                            <i class="fa fa-pencil icono-accion pointer" onclick="AbrirVista(base_url+'Sections/Especialidades/SubespecialidadAgregar/?es=<?=$_GET['es']?>&cons=<?=$value['sub_id']?>&accion=edit',400,300)"></i>&nbsp;
                                            
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Especialidades.js?'). md5(microtime())?>" type="text/javascript"></script>