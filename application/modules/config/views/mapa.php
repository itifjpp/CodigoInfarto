<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscar dirección.</title>
        <link rel="icon" type="image/png" href="<?php echo base_url()?>PM_Sistema/img/favicons.png" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url() ?>assets/js/jquery-1.3.2.js"></script>
        <script src="http://j.maxmind.com/app/geoip.js"></script>
    </head>
    <body>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
        getGeo();
        function getGeo(){
            if (navigator && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(geoOK, geoKO);
            } else {
                geoMaxmind();
            }
        }
        function geoOK(position) {
            showLatLong(position.coords.latitude, position.coords.longitude);
        }
        function geoMaxmind() {
            showLatLong(geoip_latitude(), geoip_longitude());
         }

        function geoKO(err) {
            if (err.code == 1) {
                error('El usuario ha denegado el permiso para obtener informacion de ubicacion.');
            } else if (err.code == 2) {
                error('Tu ubicacion no se puede determinar.');
            } else if (err.code == 3) {
                error('TimeOut.')
            } else {
                error('No sabemos que pasó pero ocurrio un error.');
            }
        }

        function showLatLong(lat, longi) {
            var geocoder = new google.maps.Geocoder();
            var yourLocation = new google.maps.LatLng(lat, longi);
            geocoder.geocode({ 'latLng': yourLocation },processGeocoder);
            initialize(lat,longi);
        }
        function processGeocoder(results, status){
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#direccion').val(results[0].formatted_address);
                } else {
                    error('Google no retorno resultado alguno.');
                }
            } else {
                error("Geocoding fallo debido a : " + status);
            }
        }
        function error(msg) {
            alert(msg);
        }
</script>    
    
    </script>
    <script type="text/javascript">
        var geocoder,marker,latLng2,latLng,map2;
        // INICiALIZACION DE MAPA
        function initialize(lat,long) {
          geocoder = new google.maps.Geocoder();	
          latLng = new google.maps.LatLng(lat,long);
          map = new google.maps.Map(document.getElementById('mapCanvasMapa'), {
            zoom:15,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.HYBRID  });
            // CREACION DEL MARCADOR  
            marker = new google.maps.Marker({
            position: latLng,
            title: 'Arrastra el marcador si quieres moverlo',
            map: map,
            draggable: true
          });
            // Escucho el CLICK sobre el mapa y si se produce actualizo la posicion del marcador 
             google.maps.event.addListener(map, 'click', function(event) {
             updateMarker(event.latLng);
           });
            //Inicializo los datos del marcador
            //updateMarkerPosition(latLng);
            geocodePosition(latLng);

          // Permito los eventos drag/drop sobre el marcador
          google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('Arrastrando...');
          });

          google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerStatus('Arrastrando...');
            updateMarkerPosition(marker.getPosition());
          });

          google.maps.event.addListener(marker, 'dragend', function() {
            updateMarkerStatus('Arrastre finalizado');
            geocodePosition(marker.getPosition());
          });
        }

        // ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
        function geocodePosition(pos) {
          geocoder.geocode({
            latLng: pos
          }, function(responses) {
            if (responses && responses.length > 0) {
              updateMarkerAddress(responses[0].formatted_address);
            } else {
              updateMarkerAddress('No puedo encontrar esta direccion.');
            }
          });
        }
        // OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
        function codeLatLon() { 
            str= document.form_mapa.longitud.value+" , "+document.form_mapa.latitud.value;
            latLng2 = new google.maps.LatLng(document.form_mapa.latitud.value ,document.form_mapa.longitud.value);
            marker.setPosition(latLng2);
            map.setCenter(latLng2);
            geocodePosition (latLng2);
            // document.form_mapa.direccion.value = str+" OK";
        }
        // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
        function codeAddress() {
            var address = document.form_mapa.direccion.value;
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    updateMarkerPosition(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    map.setCenter(results[0].geometry.location);
                } else {
            //alert('ERROR : ' + status);
                }
            });
        }
        // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
        function codeAddress2 (address) {
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    updateMarkerPosition(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    map.setCenter(results[0].geometry.location);
                    document.form_mapa.direccion.value = address;
                } else {
                //alert('ERROR : ' + status);
                }
            });
        }
        function updateMarkerStatus(str) {
            document.form_mapa.direccion.value = str;
        }
        // RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
        function updateMarkerPosition (latLng) {
            document.form_mapa.longitud.value =latLng.lng();
            document.form_mapa.latitud.value = latLng.lat();
        }
        function updateMarkerAddress(str) {
            document.form_mapa.direccion.value = str;
        }
        // ACTUALIZO LA POSICION DEL MARCADOR
        function updateMarker(location) {
            marker.setPosition(location);
            updateMarkerPosition(location);
            geocodePosition(location);
        }
    </script>
    <style>
        #mapCanvasMapa 
        {
            width: 100%;
            height: 500px;
        }
    </style>
        <form class="form-inline" role="form" name="form_mapa"  style="margin: 10px 10px 10px 10px">
            <div class="form-group" style="width: 75%">
            <label class="sr-only" for="pwd">Direccion:</label>
            <input type="hidden" class="form-control" id="latitud" name="latitud">
            <input type="hidden" class="form-control" id="longitud" name="longitud" >
            <input type="search" class="form-control" style="width: 100%"  id="direccion" name="direccion" >
          </div>
            <button type="button" id="Buscar" class="btn btn-default">Buscar</button>
            <button type="button" id="OK" class="btn btn-default">Guardar</button>
        </form>    
        <div id="mapCanvasMapa" style="margin-left: 0px;margin-top: 10px"></div> 
        <script>
            $(document).ready(function (){
               GuardarDireccion(); 
               $('.form-inline').submit(function (e){
                   e.preventDefault()
               })
               $('#direccion').keypress(function (){
                   codeAddress();
               })
            });
            var GuardarDireccion=function (){
                
                $("#Buscar").click(function (e){
                    codeAddress();
                });
                $("#OK").click(function (){
                    if($('#direccion').val()!=''){
                        window.opener.document.all.formDireccion.value=document.all.direccion.value;
                        window.opener.document.all.formLatitud.value=document.all.latitud.value;
                        window.opener.document.all.formLongitud.value=document.all.longitud.value;
                        window.close(); 
                    }
                });
            };
        </script>
    </body>
</html>
