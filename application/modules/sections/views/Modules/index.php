<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-8 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Plantillas</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    <form class="form-config-modules">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputHoraCero" value="Si" data-value="<?=$info['MOD_HORACERO']?>">
                                    <i class="green"></i>Hora Cero
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputEnfermeriaTriage" value="Si" data-value="<?=$info['MOD_ENFERMERIA_TRIAGE']?>">
                                    <i class="green"></i>Enfermeria Triage
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputEnfermeriaHoraCero" value="Si" data-value="<?=$info['MOD_ENFERMERIA_TRIAGE_HC']?>">
                                    <i class="green"></i>Enfermeria - Hora cero
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputMedicoTriage" value="Si" data-value="<?=$info['MOD_MEDICO_TRIAGE']?>">
                                    <i class="green"></i>Médico Triage
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputAsistenteMedica" value="Si" data-value="<?=$info['MOD_ASISTENTE_MEDICA']?>">
                                    <i class="green"></i>Asistentes Médicas
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputConsultorios" value="Si" data-value="<?=$info['MOD_CONSULTORIOS']?>">
                                    <i class="green"></i>Consultorios
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputObservacion" value="Si" data-value="<?=$info['MOD_OBSERVACION']?>">
                                    <i class="green"></i>Observación
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputChoque" value="Si" data-value="<?=$info['MOD_CHOQUE']?>">
                                    <i class="green"></i>Choque
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputQuirofanos" value="Si" data-value="<?=$info['MOD_QUIROFANOS']?>">
                                    <i class="green"></i>Quirofanos
                                </label><br><br>
                            </div>
                            <div class="col-md-4">
                                <label class="md-check mayus-bold">
                                    <input type="checkbox" checked="" class="inputModules" name="inputPisos" value="Si" data-value="<?=$info['MOD_PISOS']?>">
                                    <i class="green"></i>Pisos
                                </label><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-9 col-md-3">
                                <button class="btn back-imss btn-block">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/UMAE.js?').md5(microtime())?>" type="text/javascript"></script>