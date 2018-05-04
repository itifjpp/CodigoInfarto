$(document).ready(function (e) {
    $('.form-add-hospital').submit(function (e) {
        var MyForm=new FormData($(this)[0]);
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPostFiles(MyForm,base_url+'Sections/Hospitales/AjaxAgregar',function (response) {
            bootbox.hideAll();
            location.href=base_url+'Sections/Hospitales';
        });
    });
    $('.btnHospitalEquipoadd').click(function (e) {
        e.preventDefault();
        let element=$(this);
        let hospital_id=element.attr('data-hospital');
        let equipo_id=element.attr('data-id');
        let equipo_accion=$(this).attr('equipo_accion');
        sighMjsConfirm({
            title:'AGREGAR EQUIPO',
            message:'<div class="col-md-12">'+
                        '<div class="form-group">'+
                            '<input type="text" name="equipo_ip" class="form-control" placeholder="IP DEL EQUIPO" value="'+element.attr('data-ip')+'">'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<input type="text" name="equipo_descripcion" class="form-control" placeholder="DESCRIPCIÓN" value="'+element.attr('data-descripcion')+'">'+
                        '</div>'+
                    '</div>'
            ,size:'small',
        },function (result) {
            if(result==true){
                let equipo_ip=$('body input[name=equipo_ip]').val();
                let equipo_descripcion=$('body input[name=equipo_descripcion]').val();
                if(equipo_ip!=''){
                    SendAjaxPost({
                        equipo_id:equipo_id,
                        equipo_ip:equipo_ip,
                        equipo_descripcion:equipo_descripcion,
                        equipo_accion:equipo_accion,
                        hospital_id:hospital_id
                    },'Sections/Hospitales/AjaxEquipos',function (response) {
                        if(response.accion=='1'){
                            location.reload();
                        }else{
                            msj_error_noti("LA DIRECCIÓN DEL EQUIPO YA ESTA REGISTRADO");
                        }
                    })
                }else{
                    msj_error_noti('DIRECCIÓN IP REQUERIDA');
                }
            }
        });
    });
    $(document).on('click','.iconHospitalEquipoRemove',function (e) {
        let equipo_id=$(this).attr('data-id');
        SendAjaxPost({
            equipo_id:equipo_id
        },'Sections/Hospitales/AjaxEquipoEliminar',function () {
            location.reload();
        });
    });
    $('.form-add-ws').submit(function (e) {
        e.preventDefault();
        sighMsjLoading();
        sighAjaxPost($(this).serialize(),base_url+'Sections/Hospitales/Ajax_ws_add',function (response) {
            bootbox.hideAll();
            if(response.action==1){
                location.href=base_url+'Sections/Hospitales/ws?hos='+$('input[name=hospital_id]').val();
            }else{
                sighMsjError();
            }
        });
    });
    $('body').on('click','.ws-publicar',function (e) {
        e.preventDefault();
        let hospital_id=$(this).attr('data-hospital');
        let hospital_ws=$(this).attr('data-action');
        if(hospital_ws=='Publicar'){
            sighMjsConfirm({
                title:'Publicar este Hospital',
                message:'<div class="col-md-12">'+  
                            '<div class="form-group no-margin">'+
                                '<input type="text" name="hospital_ws_url" class="form-control" placeholder="URL DEL SITIO WEB">'+
                            '</div>'+
                        '</div>',
                size:'small'
            },function (callback) {
                if(callback==true){
                    let hospital_ws_url=$('body input[name=hospital_ws_url]').val();
                    if(hospital_ws_url!=''){
                        sighMsjLoading();
                        sighAjaxPost({
                            hospital_id:hospital_id,
                            hospital_ws_url:hospital_ws_url,
                            hospital_ws:hospital_ws
                        },base_url+'Sections/Hospitales/Ajax_ws_publish',function (response) {
                            location.reload();
                            console.log(response)
                        })
                    }else{
                        sighMsjError()
                    }
                }
            })    
        }else{
            sighMsjLoading();
            sighAjaxPost({
                hospital_id:hospital_id,
                hospital_ws:hospital_ws,
                hospital_ws_url:''
            },base_url+'Sections/Hospitales/Ajax_ws_publish',function (response) {
                location.reload();
                console.log(response)
            });
        }
        
    })
})