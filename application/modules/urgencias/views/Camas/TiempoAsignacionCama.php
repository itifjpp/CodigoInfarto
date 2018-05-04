<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">TIEMPO PROMEDIO ASIGNACIÓN DE CAMAS</span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <form action="<?= base_url()?>Urgencias/TiempoAsignacionCamas">
                            <div class="col-md-4">
                                <input class="form-control dp-yyyy-mm-dd" name="acDateStart" value="<?=$_GET['acDateStart']?>" placeholder="FECHA INICIO">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control dp-yyyy-mm-dd" name="acDateEnd" value="<?= $_GET['acDateEnd'] ?>" placeholder="FECHA FIN">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-block back-imss">BUSCAR</button>
                            </div>
                        </form>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12 <?= !isset($_GET['acDateStart'])? 'hide':''?>">
                            <div class="alert alert-info ">
                                <h2 style="margin: 0px" class="text-center"><?=date('H', mktime(0,$Tiempo))?> HORAS (<?= round($Tiempo, 2)?> MINUTOS)</h2><br>
                                <h6 style="margin: 0px" class="line-height">TIEMPO PROMEDIO DE ASIGNACIÓN DE CAMAS DE ENFERMERÍA OBSERVACIÓN - INGRESO A PISOS <br><b>DEL:</b> <?=$_GET['acDateStart']?> &nbsp;&nbsp;&nbsp;<b>AL:</b> <?=$_GET['acDateEnd']?>&nbsp;&nbsp;&nbsp; <b>TOTAL DE PACIENTES:</b> <?=$Pacientes?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


