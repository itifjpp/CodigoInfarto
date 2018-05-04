<?= Modules::run('Sections/Menu/loadHeaderBasico')?>

<div class="row m-t-60" style="margin-left: -100px;margin-right: -100px">
    <div class=" col-xs-12">
        <div class="grid simple">
            <div class="grid-title ">
                <div class="row">
                    <div class="col-xs-12 col-centered text-center">
                        <h2 class="no-margin semi-bold"><?=$this->sigh->getInfo('hospital_siglas_des')?></h2>
                        <h2 class="m-t-5"><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="position: relative">
                            <h6 class="no-margin text-right  semi-bold" style="position: absolute;right:20px;top:-10px">ÚLTIMA ACTUALIZACIÓN: <span class="lb-ultima-actualizacion"></span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-body">
                <div class="row row-loading hidden" style="margin: calc(12.5%)">
                    <div class="col-md-12">
                        <center>
                            <i class="fa fa-spinner fa-pulse fa-4x"></i>
                        </center>
                    </div>
                </div>
                <div class="row row-load hide">
                    <div class="col-md-12 text-left" style="margin-top: -19px;margin-bottom: 12px">
                        <h6 style="margin-top: 7px;margin-bottom: -6px;margin-left: -15px;    text-align: right;" >
                            <span class="fecha-actual"></span>&nbsp;&nbsp; <span class="ultima-actualizacion"></span>
                        </h6>
                    </div>
                </div>
                <div class="row  row-no-list-patients"></div>
                <div class="row row-list-last-patient-no"></div>
                <div class="row row-load hide">
                    <div class="col-xs-3">
                        <center>
                            <img src="<?= base_url()?>assets/listas/img1.png" class="center-content" style="margin-top: -20px!important;width: 90%">
                        </center>
                    </div>
                    <div class="col-xs-9">
                        
                        <h1 class="text-center table-pacientes-especialidad-no hide" style="margin-top: calc(15%);margin-bottom: calc(30%)">NO SE HA LLAMADO NINGÚN PACIENTE A CONSULTORIOS...</h1>
                        <div class="row row-list-last-patient"  style="padding:5px;margin-top: -30px"></div>
                        <div class="row table-pacientes-especialidad">
                            <h1 class="text-center " style="margin-top: calc(15%);margin-bottom: calc(30%)">NO SE HA LLAMADO NINGÚN PACIENTE A CONSULTORIOS... </h1>
                        </div>
                    </div>
                </div>   
                <div class="row hide">
                    <div class="col-md-12">
                        <input type="text" name="textToSpeech" class="form-control"><br>
                        <button class="btn sigh-background-primary btn-textToSpeech">TEST</button>
                        <audio src="" hidden="" class="speechAudio"></audio>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="textToSpeech" value="<?=$_GET['textToSpeech']?>"> 
<?= Modules::run('Sections/Menu/loadFooterBasico')?>
<script src="<?= base_url()?>assetsv2/plugins/artyom.js-master/build/artyom.window.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/sections/Lista_ce.js?<?= md5(microtime())?>" type="text/javascript"></script> 
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $('.row-loading').addClass('hide');
        $('.row-load').removeClass('hide');
    },2000)
})
</script>