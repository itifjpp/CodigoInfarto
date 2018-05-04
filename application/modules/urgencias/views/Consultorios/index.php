<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-9 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INDICADORES CONSULTORIOS</h4>
                        <a class="md-btn md-fab m-b red pull-left tip" href="<?= base_url()?>Urgencias/Graficas" style="position: absolute;left: -25px;top: 15px">
                            <i class="material-icons i-24 color-white">arrow_back</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="md-check text-uppercase">
                                    <input type="radio" name="inputFiltro" value="Fechas" checked="">
                                    <i class="blue"></i>Busqueda por Rango de Fechas
                                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="md-check text-uppercase">
                                    <input type="radio" name="inputFiltro" value="Turnos">
                                    <i class="blue"></i>Busqueda Turnos
                                </label>
                            </div>
                            <div class="col-md-12">
                                <hr style="margin-top: 10px">
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: -10px">
                            <div class="col-md-4 por-turnos hide">
                                <div class="input-group m-b">
                                    <span class="input-group-addon no-border sigh-background-secundary">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                    <select class="width100" name="inputTurno">
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon no-border sigh-background-secundary">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="inputDateStart" placeholder="Seleccionar Fecha Inicio" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-4 por-fechas">
                                <div class="input-group m-b">
                                    <span class="input-group-addon no-border sigh-background-secundary">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="inputDateEnd" placeholder="Seleccionar Fecha Termino" value="<?=  date('Y-m-d')?>" class="form-control dp-yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <button class="btn sigh-background-secundary btn-block btn-graficas-consultorios">Buscar</button>
                            </div>
                        </div>
                        <div class="row row-consultorios-indicador m-t-20">
                            

                        </div>
                        <div class="row hide">
                            <hr>
                            <div class="col-md-offset-9 col-md-3">
                                <button class="btn sigh-background-secundary btn-block btn-graficar-ic">Graficar</button>
                            </div>
                            <div class="col-md-12 GraficaIndicadorConsultorios">

                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


