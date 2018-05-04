<?= modules::run('Sections/Menu/HeaderBasico'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered" style="margin-top: 10px">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">AGREGAR FAMILIAR</span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <form class="PaseDeVisitaFamiliar">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="familiar_nombre" value="<?=$info['familiar_nombre']?>" required="" placeholder="Nombre del Familiar">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="familiar_nombre_ap" value="<?=$info['familiar_nombre_ap']?>" placeholder="Apellido Paterno">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="familiar_nombre_am" value="<?=$info['familiar_nombre_am']?>" placeholder="Apellido Materno">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="familiar_parentesco" value="<?=$info['familiar_parentesco']?>" required="" placeholder="Parentesco con el paciente">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <input type="hidden" name="csrf_token">
                                    <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                    <input type="hidden" name="accion" value="<?=$_GET['accion']?>">
                                    <input type="hidden" name="familiar_id" value="<?=$_GET['familiar']?>">
                                    <input type="hidden" name="familiar_tipo" value="<?=$_GET['tipo']?>">
                                    <button class="btn back-imss btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>