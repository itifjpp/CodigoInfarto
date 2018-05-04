<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin text-uppercase">BUSCAR PACIENTE</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form class="formSearch">
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <select class="width100" name="inputSelect">
                                            <option value="POR_NUMERO">N° DE PACIENTE</option>
                                            <option value="POR_NOMBRE">NOMBRE DEL PACIENTE</option>
                                            <option value="POR_NSS">N.S.S (SIN AGREGADO)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5" style="padding-right: 2px">
                                    <div class="input-group ">
                                        <span class="input-group-addon sigh-background-primary no-border " >
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <input type="text" name="inputSearch" class="form-control" autocomplete="off" placeholder="INGRESAR N° DE PACIENTE">
                                    </div>
                                </div>

                                <div class="col-md-3" style="padding-left: 0px">
                                    <div class="form-group">
                                        <button class="btn btn-block sigh-background-primary" name="btnSearch">BUSCAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <h6 class="inputSelectNombre hide" style="color: red;margin-top: -10px"><i class="fa fa-warning"></i> ESTA CONSULTA ESTA LIMITADA A: 100 REGISTROS</h6>
                                <table class="footable table table-bordered table-no-padding" id="tableResultSearch" data-filter="#search" data-page-size="20" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th data-sort-ignore="true">N° DE PACIENTE</th>
                                            <th data-sort-ignore="true">NOMBRE</th>
                                            <th data-sort-ignore="true">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <h5>NO SE HA REALIZADO UNA BÚSQUEDA</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-center">
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
<script src="<?= base_url('assets/js/sections/Pacientes.js?'). md5(microtime())?>" type="text/javascript"></script> 