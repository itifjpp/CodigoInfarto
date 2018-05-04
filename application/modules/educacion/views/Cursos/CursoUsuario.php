<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px;color:#2196F3">
            <li><a href="<?= base_url()?>Educacion/Cursos">Cursos</a></li>
            <li><a href="#">Cursos Usuarios</a></li>
        </ol>
        <div class="row m-t-20">
            <div class="col-md-11 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">AGREGAR USUARIOS AL CURSO</h4>
                        <a href="<?=  base_url()?>Sections/Reportes/UsuariosEnCursos?curso=<?=$_GET['curso']?>" class="btn sigh-background-primary" style="position: absolute;right: 80px;top: 5px">
                            <i class="material-icons color-white i-24">cloud_download</i>
                        </a>
                        <a onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/UsuariosEnCursos?curso=<?=$_GET['curso']?>','USUARIO CURSO',400)" href="#" class="btn sigh-background-primary" style="position: absolute;right: 25px;top: 5px">
                            <i class="material-icons color-white i-24">picture_as_pdf</i>
                        </a>
                         
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: -10px">
                                <div class="alert alert-success">
                                    <h5 class="no-margin"><b>INICIO DEL CURSO: </b><?=$info['curso_inicio_fecha']?> <?=$info['curso_inicio_hora']?>&nbsp;&nbsp;&nbsp;&nbsp; <b>TÉRMINO DEL CURSO:</b> <?=$info['curso_termino_fecha']?> <?=$info['curso_termino_hora']?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-primary no-border">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                    <select class="width100" name="typeScan">
                                        <option value="ESCANEO NORMAL">ESCANEO NORMAL</option>
                                        <option value="OMITIR DIGITOS">OMITIR DIGITOS</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon no-border sigh-background-secundary">
                                            <i class="fa fa-user-plus"></i>
                                        </span>
                                        <input type="text" name="empleado_matricula" class="form-control" placeholder="INGRESAR N° DE EMPLEADO">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-5">
                                <table class="table table-hover table-bordered footable table-no-padding table-users-in-cursos" data-page-size="8" data-filter="#curso_id" style="font-size: 13px">
                                    <thead>
                                        <tr>
                                            <th>USUARIO</th>
                                            <th>N° DE EMPLEADO</th>
                                            <th>FECHA INGRESO</th>
                                            <th>FECHA EGRESO</th>
                                            <th class="text-center">ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
<input type="hidden" name="CursoID" value="<?=$_GET['curso']?>">
<input type="hidden" name="CursoUsuario" value="Si">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>