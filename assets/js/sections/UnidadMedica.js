$(document).ready(function(){
    $('#multi').select2();
    
    if ( $("#multi")[0] ) {
        $('#multi').val($('#multi').attr('data-value').split(',')).select2();
    }
    
    $('.form-unidad-medica').on('submit',function(){
        if($('body input[name=id_unidad_editar]').val() == '') {
            $.ajax({
                url:base_url+'sections/unidadMedica/ajaxGuardarUnidad',
                type:'POST',
                dataType:'json',
                data:$(this).serialize(), 
                beforeSend: function(){
                    msj_loading();
                }, success: function(data){
                    bootbox.hideAll();
                    if(data.accion == '1'){
                        opener.location.reload();
                        window.close();
                    }
                }, error: function(e){
                    console.log(e);
                }
            });
        }else {
            $.ajax({
                url:base_url+'sections/unidadMedica/Editar',
                type:'POST',
                dataType:'json',
                data:$(this).serialize(),
                beforeSend: function(){
                    msj_loading();
                }, success: function(data){
                    bootbox.hideAll();
                    if(data.accion == '1'){
                        opener.location.reload();
                        window.close();
                    }
                }, error: function(e){
                    console.log(e);
                }
            });
        }
    });

    $('body').on('click','.eliminar_unidad',function () {
        if(confirm("¿DESEA ELIMINAR ESTE UNIDAD?")){
            var id_unidad_atencion = $(this).attr("data-idunidad");
            var id_unidad_direccion = $(this).attr("data-iddireccion");
            var id_unidad_tipo = $(this).attr("data-idtipo");
            console.log(id_unidad_atencion+" "+id_unidad_direccion+" "+id_unidad_tipo);
            $.ajax({
                url:base_url+'sections/unidadMedica/ajaxEliminarUnidad',
                type:'POST',
                dataType:'json',
                data:{
                    id_unidad_atencion:id_unidad_atencion,
                    id_unidad_direccion:id_unidad_direccion,
                    id_unidad_tipo: id_unidad_tipo,
                    csrf_token:csrf_token
                }, beforeSend: function(){
                    msj_loading();
                }, success: function(data){
                    ActionWindowsReload();
                }, error: function(e){
                    console.log(e);
                }
            });
        }
    });
    
    $('select[name=unidad_tipo]').val($('select[name=unidad_tipo]').attr('data-value'));

    $('body').on('click','.agregar',function () {
        var id_unidad_dependiente = $(this).attr("data-unidad_dependiente");
        var id_unidad_padre = $(this).attr("data-unidad_padre");
        console.log(id_unidad_dependiente+"->"+id_unidad_padre);
        $.ajax({
            url:base_url+'sections/unidadMedica/asignarUnidad',
            type:'POST',
            dataType:'json',
            data:{
                id_unidad_padre:id_unidad_padre,
                id_unidad_dependiente:id_unidad_dependiente,
                csrf_token:csrf_token
            }, beforeSend: function(){
                msj_loading();
            }, success: function(){
                opener.location.reload();
                window.close();
            }, error: function(e){
                console.log(e);
            }
        });
    });
    $('body').on('click','.quitar',function () {
        var id_unidad_UMF = $(this).attr("data-unidadUMF");
        var idZonificaion = $(this).attr("data-idZonificacion");
        $.ajax({
            url:base_url+'sections/unidadMedica/quitarUnidad',
            type:'POST',
            dataType:'json',
            data:{
                id_unidad_UMF:id_unidad_UMF,
                idZonificaion:idZonificaion,
                csrf_token:csrf_token
            }, beforeSend: function(){
                msj_loading();
            }, success: function(data){
                if(data.accion == '1'){
                    bootbox.hideAll();
                    ActionWindowsReload();
                }
            }, error: function(e){
                console.log(e);
            }
        });
    });
    $('body').on('click', '.filtrar_unidad', function() {
        var tipo_unidad = $(this).attr('data-tipo');
        $.ajax({
            url:base_url+'sections/unidadMedica/AjaxFiltrar_unidades',
            type:'POST',
            dataType:'json',
            data:{
                tipo_unidad : tipo_unidad,
                csrf_token:csrf_token
            }, beforeSend: function(){
                msj_loading();
            }, success: function(data){
                bootbox.hideAll();
                $('#buscadorUnidades').removeClass('hidden');
                $('#tablaUnidades').removeClass('hidden');
                $('#tipo_unidad').html(tipo_unidad);
                $('.table-filtros tbody').html(data.tr);
                if(tipo_unidad == 'UMF'){
                    $('#unidades_asignadas').addClass('hidden');
                }else{
                    $('#unidades_asignadas').removeClass('hidden');
                }
                InicializeFootable('.table-filtros');
            }, error: function(e){
                console.log(e);
            }
        });
    });
});