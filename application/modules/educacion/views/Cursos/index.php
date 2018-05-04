<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">CURSOS</h4>
                        <a href="<?=  base_url()?>Educacion/AgregarCurso/0/?a=add" md-ink-ripple="" class="btn sigh-background-primary" style="position: absolute;right: 25px;top: 5px">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <input type="text" id="curso_id" class="form-control" placeholder="Buscar Curso">
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#curso_id" style="font-size: 13px">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">CURSO</th>
                                            <th style="width: 15%">INICIO</th>
                                            <th style="width: 15%">TÉRMINO</th>
                                            <th style="width: 15%">USUARIOS</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['curso_nombre']?></td>
                                            <td><?=$value['curso_inicio_fecha']?> <?=$value['curso_inicio_hora']?></td>
                                            <td><?=$value['curso_termino_fecha']?> <?=$value['curso_termino_hora']?></td>
                                            <td>
                                                <?= Modules::run('Educacion/TotalUsuarios',array('curso_id'=>$value['curso_id']))?> Usuarios
                                            </td>
                                            <td>
                                                <a href="<?= base_url()?>Educacion/CursoUsuario?curso=<?=$value['curso_id']?>">
                                                    <i class="fa fa-users sigh-color i-20" data-original-title="Agregar usuarios al curso"></i>
                                                </a>&nbsp;
                                                <a href="<?= base_url()?>Educacion/AgregarCurso/<?=$value['curso_id']?>/?a=edit">
                                                    <i class="fa fa-pencil sigh-color i-20"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="hide-if-no-paging text-center">
                                            <td colspan="5">
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
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>