<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-40">
    <div class="col-md-6 col-centered">
        <div class="grid simple">
            <div class="grid-body text-center">
                <i class="fa fa-spinner fa-pulse fa-4x"></i>
                <h4>PUBLICANDO UN NUEVO EVENTO AL CALENDARIO</h4>
                <button class="btn btn-danger hide btn-authorize">AUTORIZAR ACCESO</button>
                <button class="btn btn-primary hide btn-publish-event">PUBLICAR EVENTO</button>
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
            $('.btn-publish-event').removeClass('hide');
            $('.btn-authorize').addClass('hide');
            //load the calendar client library
            gapi.client.load('calendar', 'v3', function(){ 
            console.log("Libreria de Google Calendar Listo...");
          });
        }else{
            $('.btn-publish-event').addClass('hide');
            $('.btn-authorize').removeClass('hide').click(handleAuthClick);   
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
            $('.btn-publish-event').trigger('click');
        },20000);
        $('.btn-publish-event').click(function() {
            PublishEvent()
        })
    });
    
    function PublishEvent() {
        createEvent({
            event_title:"<?=$info['event_title']?>",
            event_start_date:'<?=$info['event_start_date']?>',
            event_start_time:'<?=$info['event_start_time']?>',
            event_end_date:'<?=$info['event_end_date']?>',
            event_end_time:'<?=$info['event_end_time']?>',
            event_location:'<?=$info['event_location']?>',
            event_description:"<?=$info['event_description']?>"
        });    
    }
    // Haga una llamada API para crear un evento. Dar retroalimentación al usuario.
    function createEvent(eventData) {
        //sighMsjLoading();
        // Primero crea un recurso que se enviará al servidor.
        var resource = {
            'summary': eventData.event_title,
            'location':eventData.event_location,
            'description':eventData.event_description,
            'start': {
                dateTime: new Date(eventData.event_start_date + " " + eventData.event_start_time).toISOString()
            },end: {
                dateTime: new Date(eventData.event_end_date + " " + eventData.event_end_time).toISOString()
            }
        };
        // create the request
        var request = gapi.client.calendar.events.insert({
            'calendarId': ID_CALENDAR,
            'resource': resource
        });
        // execute the request and do something with response
        request.execute(function(resp) {
            sighAjaxPost({
                event_id:<?=$info['event_id']?>,
                event_idc:resp.id
            },base_url+'Educacion/Calendario/AjaxActualizarEvento',function() {
                
                var socket=io.connect(base_url_server);
                socket.emit('UpdateCalendarEvents',{
                    action:1
                });
                setTimeout(function() {
                    window.top.close();
                },1000);
            });
        });
        
    }
    
</script>

<script src="https://apis.google.com/js/client.js?onload=loadClient"></script>