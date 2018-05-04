<?= Modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-9 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INDICADOR POR TURNOS JEFA ASISTENTES MÉDICAS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h5><b></b></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group m-b">
                                            <span class="input-group-addon sigh-background-secundary no-border">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" name="inputFecha" class="form-control dp-yyyy-mm-dd" placeholder="SELECCIONAR FECHA">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group m-b">
                                            <span class="input-group-addon sigh-background-secundary no-border">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <select class="width100" name="inputTurno">
                                                <option value="Mañana">Turno Mañana</option>
                                                <option value="Tarde">Turno Tarde</option>
                                                <option value="Noche">Turno Noche</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button class="btn sigh-background-secundary btn-block btn-turnos-v2">Aceptar</button>
                                    </div>
                                </div>
                                <div  class="row" >
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><b>CONSULTORIOS</b></h3>
                                                <hr>
                                            </div>
                                            <div class="col-md-12" style="font-size: 16px">
                                                <b>INGRESO :</b> <span class="filtro-ingreso">0</span>&nbsp;&nbsp;
                                                <b>EGRESO :</b> <span class="filtro-egreso">0</span>&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top: 15px">
                                                <button class="btn sigh-background-secundary btn-ingresos-registros pdf-4-30-29 hide">GENERAR PDF 4-30-29</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6" style="border-left: 2px solid #256659!important">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><b>OBSERVACIÓN/CHOQUE</b></h3>
                                                <hr>
                                            </div>
                                            <div class="col-md-12" style="font-size: 16px">
                                                <b>INGRESO :</b> <span class="observacion-ingreso">0</span>&nbsp;&nbsp;
                                                <b>EGRESO :</b> <span class="observacion-egreso">0</span>&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12" style="margin-top: 15px">
                                                <button class="btn sigh-background-secundary btn-egresos-registros pdf-4-30-21-I hide">INGRESOS 4-30-21/ I</button>
                                                <button class="btn sigh-background-secundary btn-egresos-registros pdf-4-30-21-E hide">EGRESOS 4-30-21/ E</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
<?= Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Asistentemedica.js?'). md5(microtime())?>" type="text/javascript"></script> 

