<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-40">
    <div class="col-md-6 col-centered">
        <div class="grid simple">
            <div class="grid-body text-center">
                <i class="fa fa-spinner fa-pulse fa-4x"></i>
                <h4>ELIMINANDO EVENTO DEL CALENDARIO</h4>
                <button class="btn btn-danger  btn-authorize">AUTORIZAR ACCESO</button>
                <button class="btn btn-primary hide btn-delete-event">ELIMINAR EVENTO</button>
            </div>
        </div>        
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script>

    var clientId = '<?=$infoCalendar['calendar_cliente_id']?>';
    var apiKey = '<?=$infoCalendar['calendar_api_key']?>';
    var scopes = 'https://www.googleapis.com/auth/calendar';
    var ID_CALENDAR='<?=$infoCalendar['calendar_id_google']?>';
    function loadClient() {
        console.log("Inside loadCliente ...");
        gapi.client.setApiKey(apiKey);
        window.setTimeout(checkAuth,100);
    }
    function checkAuth() {
        console.log("Inside checkAuth ...");
        gapi.auth.authorize({
            client_id: clientId, 
            scope: scopes, 
            immediate: true
        }, handleAuthResult);
    }

    /* Invocado por diferentes funciones para manejar el resultado de las comprobaciones de autenticación*/
    function handleAuthResult(authResult) {
        console.log("Inside handleAuthResult ...");
        if(authResult && !authResult.error) {
            $('.btn-delete-event').removeClass('hide');
            $('.btn-authorize').addClass('hide');
            //load the calendar client library
            gapi.client.load('calendar', 'v3', function(){ 
            console.log("Libreria de Google Calendar Listo...");
          });
        }else{
            $('.btn-delete-event').addClass('hide');
            $('.btn-authorize').removeClass('hide');   
        }
    }
    $('.btn-authorize').click(handleAuthClick);
    
    /*Manejador de eventos que se ocupa de hacer clic en el botón Autorizar.*/
    function handleAuthClick() {
        gapi.auth.authorize({
            client_id: clientId, 
            scope: scopes, 
            immediate: false
        }, handleAuthResult);
        return false;
    }
    $(document).ready(function() {
        setTimeout(function() {
            $('.btn-delete-event').trigger('click');
        },20000);
        $('.btn-delete-event').click(function() {
            deleteEvent();
        })
    });
    // Haga una llamada API para crear un evento. Dar retroalimentación al usuario.
    function deleteEvent() {
        //sighMsjLoading();
        // Primero crea un recurso que se enviará al servidor.
        // create the request
        var request = gapi.client.calendar.events.delete({
            'calendarId': ID_CALENDAR,
            'eventId': '<?=$info['event_idc']?>'
        });
        // execute the request and do something with response
        request.execute(function(resp) {
            sighAjaxPost({
                event_id:<?=$info['event_id']?>,
            },base_url+'Educacion/Calendario/AjaxDeleteEventEnd',function() {         
                var socket=io.connect(base_url_server);
                socket.emit('UpdateCalendarEvents',{
                    action:1
                });
                setTimeout(function() {
                    window.top.close();
                },1000)
            });
        });
        
    }
    
</script>

<script src="https://apis.google.com/js/client.js?onload=loadClient"></script>