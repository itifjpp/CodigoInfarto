        </div>
        <script>
            var base_url = "<?= base_url(); ?>"
            var url_string="<?=$this->uri->uri_string()?>";
            var um_nombre="<?=_UM_NOMBRE?>";
            var um_tipo="<?=_UM_TIPO?>";
            var um_clasificacion="<?=_UM_CLASIFICACION?>";
            var base_domain=window.location.host;
            var base_url_server='https://'+base_domain+':5000/';
            var sigh_user_id='<?=$this->UMAE_USER?>';
            var SiGH_USER='<?=$this->UMAE_USER?>';
            var SiGH_AREA='<?=$this->UMAE_AREA?>';
            var SiGH_ASISTENTESMEDICAS_OMISION='<?=SiGH_ASISTENTESMEDICAS_OMISION?>';
            var SiGH_VALIDACIONPACIENTE='<?=SiGH_VALIDACIONPACIENTE?>';
        </script>
        <?php foreach ($scripts as $value) {?>
        <script src="<?=base_url()?>assetsv2/<?=$value?>" type="text/javascript"></script>
        <?php }?> 
        <script src="https://<?=base_domain?>:5000/socket.io/socket.io.js" type="text/javascript"></script>
        <script>
            var socket=io.connect(base_url_server);
            socket.emit('assignId', {
                SiGH_USER:SiGH_USER
            });        
        </script>
        <script src="<?=  base_url()?>assets/js/_umConfig.js?time=<?= sha1(microtime())?>" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assets/js/Mensajes.js?time=<?= sha1(microtime())?>" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assetsv2/webarch/js/webarch.js" type="text/javascript"></script>
        <script src="<?=  base_url()?>assetsv2/webarch/js/sigh.js?time=<?= sha1(microtime())?>" type="text/javascript"></script> 
        <script src="<?=base_url()?>assetsv2/js/chat.js" type="text/javascript"></script>
        <script>
            
            socket.on('NewNotification',function(data) {
                $('.new-notificacions-label').removeClass('hide').addClass('move-label-new-notification');
                $('.new-notificacions-label .badge').removeClass('hide').text(data.notification_total);
                setTimeout(function (e) {
                    $('.new-notificacions-label').removeClass('move-label-new-notification');
                    //$('.new-notificacions-label .badge').addClass('hide');
                },1000);
                //$('.new-notificacions-label').removeClass('move-label-new-notification');
                $('body .new-notificacions').html(data.notification_msj);
            });
            var AjaxGetNotifications=function () {
                sighAjaxGet(base_url+'Sections/Usuarios/AjaxGetNotifications',function (response) {
                    socket.emit('NewNotification',response);
                });
            };
            var loadNotificacion=function () {
                sighAjaxGet(base_url+'Sections/Usuarios/AjaxGetNotifications',function (response) {
                    if(response.notification_total>0){
                        $('.new-notificacions-label').removeClass('hide');
                        $('.new-notificacions-label .badge').removeClass('hide').text(response.notification_total);   
                        $('body .new-notificacions').html(response.notification_msj);
                    }
                });
            }
            loadNotificacion();
            $('body').on('click','.new-notificacions-label',function (evt) {
                evt.preventDefault();
                sighAjaxGet(base_url+'Sections/Usuarios/AjaxViewNotifications',function (response) {
                    $('.new-notificacions-label .badge').addClass('hide');
                    sighMjsConfirm({
                        title:'NOTIFICACIONES RECIENTES',
                        message:'<div class="col-md-12">'+response.notification_msj+'</div>',
                        size:'medium'
                    },function (cb) {

                    });
                });
            });
            var chat_msj=0;
            socket.on('listeningChat',function(response) {
                sighAjaxPost(response,base_url+'Sections/Chat/AjaxGetNewChats',function(response) {
                    chat_msj=response.chat_msj;
                    $('body .notifications-msj span').html(chat_msj);
                });
            });
            
        </script>
    </body>
</html>