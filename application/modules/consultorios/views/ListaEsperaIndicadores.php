<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">INDICADOR DE PACIENTES INGRESADOS POR LISTA DE ESPERA </h4>
                    </div>
                    <div class="grid-body">
                        <form class="form-indicador-lista-espera">
                            <div class="row ">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon sigh-background-primary no-border">
                                                <i class="fa fa-align-justify"></i>
                                            </span>
                                            <select class="width100" name="inputFilter">
                                                <option value="RANGO_DE_FECHAS">POR RANGO DE FECHAS</option>
                                                <option value="POR_TURNOS">POR TURNOS</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon sigh-background-primary no-border">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" name="inputDateStart" required="" class="form-control dp-yyyy-mm-dd" placeholder="FECHA DE INICIO">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group input-filter-fechas">
                                        <div class="input-group">
                                            <span class="input-group-addon sigh-background-primary no-border">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" name="inputDateEnd" class="form-control dp-yyyy-mm-dd" placeholder="FECHA DE TERMINO">
                                        </div>
                                    </div>
                                    <div class="form-group input-filter-turnos hide">
                                        <div class="input-group">
                                            <span class="input-group-addon sigh-background-primary no-border">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <select class="width100" name="inputTurno">
                                                <option value="MAÑANA">MAÑANA</option>
                                                <option value="TARDE">TARDE</option>
                                                <option value="NOCHE">NOCHE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn sigh-background-primary btn-block">BUSCAR...</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row row-rs-indicador"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Consultorios.js?<?= date('YmdHis')?>" type="text/javascript"></script>