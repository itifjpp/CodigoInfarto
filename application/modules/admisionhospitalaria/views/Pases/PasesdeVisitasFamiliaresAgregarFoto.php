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
                                <div class="col-xs-6">
                                    <div id="my_camera"></div>
                                </div>
                                <div class="col-xs-6">
                                    <center>
                                        <img src="<?= base_url()?>assets/img/familiares/defaullt.png"  class="image_profile" style="width: 80%;height: 230px!important; margin-top: 5px;">
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <button class="btn back-imss btn-block btn-tomar-foto" type="button">Tomar Foto</button>
                                </div>
                                <div class="col-xs-6">
                                    <input type="hidden" name="familiar_perfil" >
                                    <input type="hidden" name="familiar_id" value="<?=$_GET['familiar']?>">
                                    <input type="hidden" name="triage_id" value="<?=$_GET['triage_id']?>">
                                    <button class="btn back-imss btn-block btn-save-img" type="button">Guardar Foto</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="inputPerfilFamiliar" value="Si">
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script type="text/javascript" src="<?= base_url()?>assets/libs/webcamjs-master/webcam.min.js"></script>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>