$(document).ready(function () {
    $('body').on('click','.add-plantilla',function (e){
        e.preventDefault();
        SeleccionarPlantilla(0,'','add')
    })
    $('body').on('click','.edit-plantilla',function (e){
        e.preventDefault();
        SeleccionarPlantilla($(this).data('id'),$(this).data('nombre'),'','edit');
        
    })
    function SeleccionarPlantilla(id,Plantilla,accion){
        sighMjsConfirm({
            title: 'SELECCIONAR PLANTILLA',
            message:'<div class="col-sm-12">'+
                        '<select id="plantilla_nombre" class="width100">'+
                            '<option value="Motivo de Urgencia" data-limit="300">Motivo de Urgencia</option>'+
                            '<option value="Antecedentes" data-limit="110">Antecedentes</option>'+
                            '<option value="Exploración Física" data-limit="330">Exploración Física</option>'+
                            '<option value="Interpretación" data-limit="240">Interpretación</option>'+
                            '<option value="Diagnosticos" data-limit="540">Diagnosticos</option>'+
                            '<option value="Receta" data-limit="110">Receta</option>'+
                            '<option value="Indicaciones" data-limit="240">Indicaciones</option>'+
                        '</select>'+
                    '</div>',
            size:'small'
        },function (result) {
            if(result==true){
                NuevoEdit(id,$('#plantilla_nombre').val(),$('#plantilla_nombre option:selected').data('limit'),accion);
            }
        });
        $('body #plantilla_nombre').val(Plantilla)
    }
    function NuevoEdit(id,nombre,limit,accion){
        sighMsjLoading();
        sighAjaxPost({
            plantilla_id:id,
            plantilla_nombre:nombre,
            plantilla_limit:limit,
            accion:accion,
        },base_url+"Sections/Plantillas/AjaxPlantilla",function (response) {
            bootbox.hideAll();
            if(response.accion=='1'){
                location.reload();
            }
            if(response.accion=='2'){
                msj_error_noti('LA PLANTILLA YA SE ENCUENTRA AGREGADO')
            }
        })
    }
    $('body').on('click','.eliminar-plantilla',function (e){
        var plantilla_id=$(this).data('id');
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"Sections/Plantillas/AjaxEliminarPlantilla",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'plantilla_id':plantilla_id
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_beforeSend();
                    bootbox.hideAll();
                }
                
            });
        }
    });
    $('.add-contenido').click(function (e) {
        e.preventDefault();
        AgregarContenido({
            contenido_id:0,
            contenido_datos:'',
            plantilla_id:$(this).attr('data-plantilla'),
            limit:$(this).attr('data-limit'),
            accion:'add'
        })
    })
    $('body').on('click','.editar-contenido',function (e) {
        e.preventDefault();
        AgregarContenido({
            contenido_id:$(this).attr('data-id'),
            contenido_datos:$(this).attr('data-contenido'),
            plantilla_id:$(this).attr('data-plantilla'),
            limit:$(this).attr('data-limit'),
            accion:'edit'
        })
    })
    function AgregarContenido(info) {
        bootbox.dialog({
            title:'<h5 class="mayus-bold">Agregar Contenido</h5>',
            message:'<div class="row">'+
                        '<div class="col-md-12">'+
                            '<div class="form-group">'+
                                '<textarea class="form-control" rows="4" name="contenido_datos" placeholder="Agregar Contenido">'+info.contenido_datos+'</textarea>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
            buttons:{
                Cancelar:{
                    label:'Cancelar',
                    callback:function () {}
                },Aceptar:{
                    label:'Aceptar',
                    callback:function () {
                        var contenido_datos=$('body textarea[name=contenido_datos]').val();
                        if(contenido_datos!=''){
                            
                        }
                    }
                }
            }
        })

    }
//    $('body textarea[name=contenido_datos]').wysihtml5({
//        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
//        "emphasis": true, //Italics, bold, etc. Default true
//        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
//        "html": false, //Button which allows you to edit the generated HTML. Default false
//        "link": false, //Button to insert a link. Default true
//        "image": false, //Button to insert an image. Default true,
//        "color": true //Button to change color of font  
//    });
    $('.guardar-contenido').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url+"Sections/Plantillas/AjaxContenido",
            type: 'POST',
            dataType: 'json',
            data:$(this).serialize(),
            beforeSend: function (xhr) {
                msj_loading();
            },success: function (data, textStatus, jqXHR) {
                bootbox.hideAll();
                if(data.accion=='1'){
                    ActionCloseWindowsReload();
                }
            },error: function (e) {
                bootbox.hideAll();
                console.log(e);
                MsjError();
            }
        })
    });
    $('body').on('click','.eliminar-contenido',function (e){
        var contenido_id=$(this).data('id');
        if(confirm('¿ELIMINAR REGISTRO?')){
            $.ajax({
                url: base_url+"Sections/Plantillas/AjaxEliminarContenido",
                type: 'POST',
                dataType: 'json',
                data:{
                    'csrf_token':csrf_token,
                    'contenido_id':contenido_id
                },beforeSend: function (xhr) {
                    msj_loading();
                },success: function (data, textStatus, jqXHR) {
                    if(data.accion=='1'){
                        location.reload();
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_beforeSend();
                    bootbox.hideAll();
                }
                
            });
        }
    });
    $('body .select-content').click(function (e) {
        e.preventDefault();
        $('body #SeleccionarContenido tbody tr').each(function (i,e) {
           var el=$(this);
           var radio=el.find('input[type=radio]:checked');
           if(radio.length==1){
               el.find('.contentSeleccion span').remove();
               var contentTr=el.find('.contentSeleccion').html();
               window.opener.$('textarea[name='+$('input[name=inputName]').val()+']').val(contentTr);
               window.close();
           }
        })
    })
});