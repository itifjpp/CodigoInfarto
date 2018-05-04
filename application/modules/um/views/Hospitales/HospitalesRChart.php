<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">GRAFICA DE REPORTE GENERAL DE ESTADOS ACTUALES DE LOS HOSPITALES</span>
                    <div class="row hide">
                        <div class="col-sm-4" style="position: absolute;top: 20px;right: 15px">
                            <form action="<?= base_url()?>Um/Hospitales/Graficas">
                                <div class="input-group" >
                                    <input type="text" class="form-control dp-yyyy-mm-dd" name="inputFecha" value="<?=$_GET['inputFecha']?>">
                                    <span class="input-group-btn">
                                        <input type="hidden" name="hos" value="<?=$_GET['hos']?>">
                                        <button class="btn btn-default waves-effect"  type="submit">BUSCAR</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body b-b b-light" style="padding: 14px;">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>TOTAL DE CAMAS</h5>
                            </div>
                            <div class="col-CamasTotales" data-m="<?=$TotalCamas_Mañana?>" data-t="<?=$TotalCamas_Tarde?>" data-n="<?=$TotalCamas_Noche?>"></div>
                            <canvas id="ChartCamasTotales" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>ADMISIÓN DE PACIENTES RELACIONADOS CON EL SISMO NO DH</h5>
                            </div>
                            <div class="col-NoDerechoHabientes" data-m="<?=$TotalAdmisionDH_M?>" data-t="<?=$TotalAdmisionDH_T?>" data-n="<?=$TotalAdmisionDH_N?>"></div>
                            <canvas id="ChartNoDerechoHabientes" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>DEFUNCIONES RELACIONADOS CON EL SISMO</h5>
                            </div>
                            <div class="col-ReporteDefunciones" data-m="<?=$DefuncionesConElSismo_M?>" data-t="<?=$DefuncionesConElSismo_T?>" data-n="<?=$DefuncionesConElSismo_N?>"></div>
                            <canvas id="ChartReporteDefunciones" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>CAMAS OCUPADAS</h5>
                            </div>
                            <div class="col-CamasOcupadas" data-m="<?=$CamasOcupadas_M?>" data-t="<?=$CamasOcupadas_T?>" data-n="<?=$CamasOcupadas_N?>"></div>
                            <canvas id="ChartCamasOcupadas" style="height: 250px"></canvas>
                        </div>
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-6">
                            <div class="back-imss" style="padding: 0.5px;text-align: center">
                                <h5>EGRESOS DE PACIENTES ESPECIFICANDO DESTINO</h5>
                            </div>
                            <div class="col-EgresosPacientes" data-m="<?=$Egresos_M?>" data-t="<?=$Egresos_T?>" data-n="<?=$Egresos_N?>"></div>
                            <canvas id="ChartEgresosPacientes" style="height: 250px"></canvas>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<input type="hidden" name="ShowCharts" value="Si">
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/UmHospitales.js?<?= md5(microtime())?>"></script>


