<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white ">GESTIÓN DE USUARIOS</h4>
                        <a href="#" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ListaUsuarioPreregistro','ListaUsuarioPreregistro',300)" class="md-btn md-fab m-b red pull-right m-l-10 <?=$this->UMAE_AREA=='Enseñanza'? '' :'hide'?>">
                            <i class="material-icons i-24 color-white">picture_as_pdf</i>
                        </a>
                        <a href="<?=  base_url()?>Sections/Usuarios/Usuario/0/?a=add&tmp=<?= date('YmdHis')?>"  class="md-btn md-fab m-b red pull-right <?=$this->UMAE_AREA=='Enseñanza'? 'hide' :''?>">
                            <i class="material-icons i-24 color-white">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-3">
                                <div class="form-group" >
                                    <div class="input-group">
                                        <span class="input-group-addon sigh-background-secundary no-border">
                                            <i class="fa fa-align-justify"></i>
                                        </span>
                                        <select name="FILTRO_TIPO" class="width100">
                                            <option value="">TIPO DE BÚSQUEDA</option>
                                            <option value="empleado_id">POR N° DE REGISTRO</option>
                                            <option value="empleado_matricula">POR N° DE EMPLEADO</option>
                                            <option value="empleado_nombre">POR NOMBRE</option>
                                            <option value="empleado_categoria">CATEGORIA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <input type="text" name="FILTRO_VALUE" class="form-control" placeholder="BUSCAR...">
                                    <span class="input-group-addon no-border sigh-background-secundary pointer input-buscar">
                                        <i class="fa fa-search-plus i-16" ></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <div class="form-group" >
                                    <input type="text" class="form-control" id="filter" placeholder="FILTRO GENERAL">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding width100 footable table-usuarios"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th style="width: 12%">N° REGISTRO</th>
                                            <th style="width: 14%">N° DE USUARIO</th>
                                            <th style="width: 22%">NOMBRE</th>
                                            <th style="width: 25%">ESPECIALIDAD</th>
                                            <th >CATEGORIA</th>
                                            <th style="width: 15%">ESTADO</th>
                                            <th style="width: 10%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="8"  class="text-center">
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
<input type="hidden" name="AjaxLoadUserRol" value="AjaxObtenerUsuarioEducacion">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Usuarios.js?'). md5(microtime())?>" type="text/javascript"></script>