<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">INDICADOR DE TICKETS GENERADOS</h4>
                    </div>
                    <div class="grid-body">
                        <fieldset class="fieldset p-b-15">
                            <legend class="legend" style="width: auto">BUSQUEDA DE PRODUCTIVIDAD POR TURNOS</legend>
                            <div class="row">
                                <form class="by_fecha col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="inputFecha" placeholder="SELECCIONAR FECHA" required="" class="form-control dp-yyyy-mm-dd">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="width100" name="inputTurno">
                                                    <option value="Mañana">Mañana</option>
                                                    <option value="Tarde">Tarde</option>
                                                    <option value="Noche">Noche</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button class="btn sigh-background-secundary btn-block">Buscar</button>
                                            </div>
                                        </div>        
                                    </div>

                                </form>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info" style="position: relative">
                                        <h4 class="no-margin">NÚMERO DE PACIENTES: <span class="horacero-indicador-rs">0</span> PACIENTES </h4>
                                        <a href="#" class="horacero-indicador-export hide" style="position: absolute;right: 10px;top: 5px">
                                            <i class="material-icons " style="font-size: 30px">picture_as_pdf</i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table  class="table footable table-filtros table-bordered table-hover table-no-padding" data-limit-navigation="5" data-filter="#filter" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th >N° DE FOLIO</th>
                                                <th >FECHA</th>
                                                <th >HORA</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
                        </fieldset>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Horacero.js?').md5(microtime())?>" type="text/javascript"></script>