<?=Modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <?php if($_GET['inputFiltro']=='Fechas'){?>
                        <h4 class="no-margin color-white text-uppercase">INDICADORES TRIAGE <?=$_GET['Color']?> DE FECHA <?=$_GET['inputFi']?> A <?=$_GET['inputFf']?></h4>
                        <?php }else{?>
                        <h4 class="no-margin color-white text-uppercase">INDICADORES TRIAGE <?=$_GET['Color']?> DE FECHA <?=$_GET['inputFi']?> TURNO <?=$_GET['inputTurno']?></h4>
                        <?php }?>
                    </div>
                    <div class="grid-body">
                        <div class="row row-graficas-espontaneo-referido hide">
                            <div class="col-md-6">
                                <h5 class="text-center">
                                    <b>GRÁFICA DE PROCEDENCIA</b>
                                </h5>
                                <canvas id="TriageGraficaEsponRefec" style="height: 250px"></canvas>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">
                                    <b>GRÁFICA POR GÉNERO</b>
                                </h5>
                                <canvas id="TriageGraficaSexo" style="height: 250px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="GraficasTriage" value="Si">
<input type="hidden" name="TriageFi" value="<?=$_GET['inputFi']?>">
<input type="hidden" name="TriageFf" value="<?=$_GET['inputFf']?>">
<input type="hidden" name="TriageColor" value="<?=$_GET['Color']?>">
<input type="hidden" name="TriageFiltro" value="<?=$_GET['inputFiltro']?>">
<input type="hidden" name="TriageTurno" value="<?=$_GET['inputTurno']?>">
<?=Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>