<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<style>
    .fc-header-toolbar{
        text-transform: uppercase!important;
    }
    #calendarDay .fc-list-heading .fc-widget-header{
/*        background: #099A8C!important;
        color:white!important;*/
    }
</style>
<div class="row" style="margin-left: -60px;margin-right: -60px;margin-top: 70px">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-body" style="padding: 8px 26px 8px 26px">
                <div class="row">
                    <div class="col-md-1 col-xs-1 no-padding">
                        <img src="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" style="width: 90px">
                    </div>
                    <div class="col-md-10 col-xs-10">
                        <h2 class="no-margin text-center semi-bold"> <?=$this->sigh->getInfo('hospital_siglas_des')?></h2>
                        <h2 class="text-center no-margin" ><?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></h2>
                    </div>
                    <div class="col-md-1 col-xs-1 no-padding text-right" style="margin: 0px!important;padding: 0px!important">
                        <img src="<?= base_url()?>assets/img/QR_CALENDAR.png" style="width: 100px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-left: -60px;margin-right: -60px">
    <div class="col-md-4" style="margin-top: -20px">
        <div class="grid simple">
            <div class="grid-body" style="padding: 10px">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendarDay" ></div>
                        
                    </div>
                    <div class="col-md-4">
                        <img src="<?= base_url()?>assets/img/qr_drive_residentes.png" style="width: 120px;margin-left: -8px">
                    </div>
                    <div class="col-md-8" style="margin-left: -15px">
                        <h3 class="text-justify no-margin line-height bold">ESCANEÁ ESTE QR.</h3>
                        <h6 class="text-justify no-margin line-height">PARA CONOCER LOS DOCUMENTOS E INFORMACIÓN IMPORTANTE DE LA COORDINACIÓN DE ENSEÑANZA E INVESTIGACIÓN</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" style="margin-top: -20px">
        <div class="grid simple">
            <div class="grid-body" style="padding: 10px">
                <div id="calendar" ></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="googleCalendarApiKey" value="<?=$infoCalendar['calendar_api_key']?>">
    <input type="hidden" name="googleCalendarId" value="7mjb27acsb9102epoktnj30p5g@group.calendar.google.com">
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url()?>assetsv2/js/calender.js?<?=md5(microtime())?>" type="text/javascript"></script>
<script>
    document.title="SiGH | Calendario de Actividades"
    var socket=io.connect(base_url_server);
    socket.on('UpdateCalendarEvents',function(response) {
        if(response.action==1){
            location.reload()
        }
    });
</script>