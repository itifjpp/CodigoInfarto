$(document).ready(function () {
    $('.btn-obtener-datos').click(function (e) {
        $.each($('body #IframeVigenciaDerecho').contents().find('.contenido table'),function (i,e) {
            console.log(e)
        });
    })
    $('.buscar').click(function (e) {
        $.ajax({
            url: "http://serviciosdigitalesinterno.imss.gob.mx/gestionVigenciaGpoFamiliar-web-externo/busqueda/asegurado",
            type: 'POST',
            dataType: 'json',
            data:{
                idPersona:'',
                idAsignacionNSS:'',
                nss:'4515993871'
            },success: function (data, textStatus, jqXHR) {
                console.log(data);
            },error: function (e) {
                msj_error_serve();
                console.log(e);
            }
        })
    })
})