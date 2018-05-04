<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;">UNIDADES DE MEDICINA FAMILIAR</span>
                    <a href="<?=base_url()?>sections/unidadMedica/addUnidad" md-ink-ripple="" target="_blank" class="md-btn md-fab m-b green waves-effect pull-right tip" data-original-title="Agregar">
                        <i class="fa fa-plus i-24"></i>
                    </a>
                </div>
                <div class="container-fluid">
                    <br>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?=base_url() ?>sections/unidadMedica" >Zonificación</a>
                        </li>
                        <li id="tipo_unidad"></li>
                    </ol>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-4 hidden" id="buscadorUnidades">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group m-b ">
                                        <span class="input-group-addon back-imss no-border" ><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" id="buscar" name="triage_id" placeholder="Buscar UMF">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 filtrar_unidad" data-tipo="UMF">
                                    <center>
                                        <button md-ink-ripple class="md-btn md-raised m-b btn-fw green-700">UMF</button><br>
                                    </center>
                                </div>
                                <div class="col-md-4 filtrar_unidad" data-tipo="HGZ">
                                    <center>
                                        <button md-ink-ripple class="md-btn md-raised m-b btn-fw green-700">HGZ</button><br>
                                    </center>
                                </div>
                                <div class="col-md-4 filtrar_unidad" data-tipo="UMAE">
                                    <center>
                                        <button md-ink-ripple class="md-btn md-raised m-b btn-fw green-700">UMAE</button><br>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden" id="tablaUnidades">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered footable table-filtros" data-filter="#buscar" style="font-size: 11px">
                                <thead>
                                    <th>UNIDAD</th>
                                    <th>NO. DE UNIDAD</th>
                                    <th>NIVEL</th>
                                    <th>ESTADO</th>
                                    <th>ALTITUD</th>
                                    <th>LATITUD</th>
                                    <th>TIPO DE UNIDAD</th>
                                    <th class="hidden" id="unidades_asignadas">UNIDADES ASIGNADAS</th>
                                    <th>ACCIONES</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="9" id="footerCeldas" class="text-center">
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
<script src="<?= base_url('assets/js/sections/UnidadMedica.js?'). md5(microtime())?>" type="text/javascript"></script> 