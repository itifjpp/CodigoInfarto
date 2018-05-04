$(document).ready(function () {
    $('.form-add-normativa').submit(function (evt) {
        evt.preventDefault();
        var form=new FormData($(this)[0]);
        sighAjaxPostFiles(form,base_url+"Sections/Normativas/AjaxNuevaNormativa",function (response) {
            //console.log(response);
            msj_success_noti('DATOS GUARDADOS');
            location.href=base_url+'Sections/Normativas';
        });
    });
    $('select[name=normativa_especialidad]').val($('select[name=normativa_especialidad]').data('value'));
    if($('select[name=normativa_especialidad]').val()!=undefined){
        var areas=$('body #areas_id').attr('data-value').split(',');
        if($('body #areas_id').attr('data-value')!=''){
            $('#areas_id').val(areas).select2();
        }
    }
    if($('input[name=accion_normativa]').val('edit')){
        $('input[name=normativa_file]').removeAttr('required');
    }
    $(document).on('click','.delete-normativa',function () {
        var normativa_id=$(this).attr('data-id');
        var normativa_file=$(this).attr('data-file');
        if(confirm('¿DESEA ELIMINAR ESTE REGISTRO?')){
            sighAjaxPost({
                normativa_id:normativa_id,
                normativa_file:normativa_file
            },base_url+'Sections/Normativas/AjaxEliminarNormativa',function (response) {
                location.reload();
            });
        }
    })
    if($('input[name=LoadNormativas]').val()!=undefined){
        var inputStart=0;
        var inputLimit=18;
        AjaxCargarNormativas({
            inputStart:inputStart,
            inputLimit:inputLimit
        });
        $('.box-cell').bind('scroll', function(){
            if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight){
                inputStart=inputStart+inputLimit;
                AjaxCargarNormativas({
                    inputStart:inputStart,
                    inputLimit:inputLimit
                })
            }
        })
    }
    if($('input[name=normativa_portada]').val()!=undefined){
        $('.html5imageupload').css({
            'background':"url("+base_url+"assets/Normativas/"+$('input[name=normativa_portada]').val()+")",
            'background-size':'cover'
        })
    };
    $('#checkbox2').click(function (e) {
        var area_id=[];
        if($(this).is(':checked')){
            $("#areas_id option").each(function(){
                area_id.push($(this).val());
            });
            $("#areas_id").select2('val',area_id).select2();
        };
    })
    function AjaxCargarNormativas(info) {
        SendAjaxPost({
            inputStart:info.inputStart,
            inputLimit:info.inputLimit,
        },'Sections/Normativas/AjaxCargarNormativas',function (response) {
            $('.row-normativas').append(response.col);
        })
    }
    $(document).on('click','.open-doc-click',function (response) {
        AbrirDocumentoMultiple(base_url+$(this).attr('data-url'),'TEST');
    })
});
