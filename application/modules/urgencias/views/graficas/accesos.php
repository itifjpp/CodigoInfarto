<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
           <ol class="breadcrumb" style="margin-top: -20px">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Urgencias</a></li>
                <li><a href="#" class="">Accesos</a></li>
                <li><a href="#" class="">Usuarios</a></li>
                
            </ol>
            <form action="<?=  base_url()?>urgencias/graficas/turno/<?=$this->uri->segment(4)?>" method="GET">
                <div class="col-md-3" style="padding-right: 0px">
                    <div class="form-group" style="margin-top: 5px">
                        <label class="md-check">
                            <input type="radio" name="filter_by" value="Todo" <?=$_GET['filter_by']=='Fecha' ? '' : 'checked'?> class="has-value">
                            <i class="indigo"></i>Mostrar todo
                        </label>&nbsp;&nbsp;&nbsp;
                        <label class="md-check">
                            <input type="radio" name="filter_by" value="Fecha" <?=$_GET['filter_by']=='Fecha' ? 'checked' : ''?> class="has-value">
                            <i class="indigo"></i>Filtrar por fecha
                        </label>
                    </div>

                </div>
                <div class="col-md-2" style="padding-left: 0px">
                    <div class="form-group">
                        <input type="text" name="filter_selec_fecha" value="<?=$_GET['filter_selec_fecha']?>" placeholder="Seleccionar fecha" class="form-control dd-mm-yyyy">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="hidden" name="turno" value="<?=$this->uri->segment(4)?>">
                        <button class="btn btn-primary ">Aplicar</button>
                    </div>
                </div>
            </form>
            <div class="col-md-4" >
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAl_HORACERO?></h1>
                        <h5>Total de Tickets Generados</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_TRIAGE_E?></h1>
                        <h5>Total de Pacientes Triage Enfermería</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_TRIAGE_M?></h1>
                        <h5>Total de Pacientes Triage Médico</h5>
                    </div>
                </div>
            </div>
            <!---row--->
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_AM?></h1>
                        <h5>Total de Pacientes Asistentes Médicas</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_RX?></h1>
                        <h5>Total de Pacientes RX</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_CE?></h1>
                        <h5>Total de Pacientes Consultorios</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_CHOQUE_E?></h1>
                        <h5>Total de Pacientes Choque Enfermería</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_CHOQUE_M?></h1>
                        <h5>Total de Pacientes Choque Médicos</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_OBSERVACION_E?></h1>
                        <h5>Pacientes Observación Enfermería</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel no-border">
                    <div class="panel-body text-center" style="padding: 1px 0px;">
                        <h1><?=$TOTAL_OBSERVACION_M?></h1>
                        <h5>Pacientes Observación Médico</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Urgencias.js"></script>

