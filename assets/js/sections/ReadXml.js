var sv_fc='';
var sv_temp='';
var sv_ta_1='';
var sv_ta_2='';
var sv_fr='';
var sv_oximetria='';
var oxi_='';
var equipo_ns='';
var ns=0;
var paciente_nombre='';
var paciente_nombre_ap='';
var paciente_folio='';
var sv_key='';
var data_sv;
var start_ajax=0;
var total_file=0;
var total_lectura=0;
$(document).ready(function () {
    SendAjax({
        id:0,
        csrf_token:csrf_token
    },'Horacero/Movil/AjaxReasAndCopyAllFiles',function (response) {
        total_file=response.WelchAllyn;
        console.log(response);
        if(total_file>0){
            $.each(response.Files,function (i,xml_file) {
                $.get(base_url+"assets/xml/"+xml_file, {}, function (xml){
                    $('MEMBER',xml).each(function(i,e){
                        if($(this).attr('name')=='SerialNumber'){
                            if(ns==0){
                                equipo_ns=$(this).find('VALUE').text();
                                ns=ns+1;
                            }
                        }if($(this).attr('name')=='Systolic'){
                            sv_ta_1=$(this).find('VALUE DEFINITION MEMBERS MEMBER VALUE:first').text().trim().substr(0,3)+'/';
                        }if($(this).attr('name')=='Diastolic'){
                            sv_ta_2=$(this).find('VALUE DEFINITION MEMBERS MEMBER VALUE:first').text().trim().substr(0,2);
                        }if($(this).attr('name')=='FirstName'){
                            if($(this).find('VALUE').text()!=''){
                                paciente_nombre=$(this).find('VALUE').text();
                            }
                        }if($(this).attr('name')=='LastName'){
                            if($(this).find('VALUE').text()!=''){
                                paciente_nombre_ap=$(this).find('VALUE').text();
                            }
                        }if($(this).attr('name')=='Identifier'){
                            paciente_folio=$(this).find('VALUE').text();
                        }if($(this).attr('name')=='Sat'){
                            if($(this).find('VALUE DEFINITION MEMBERS MEMBER VALUE:first').text()!=''){
                                sv_oximetria=$(this).find('VALUE DEFINITION MEMBERS MEMBER VALUE:first').text().trim();
                            }
                        }
                    });
                    data_sv={
                        sv_fc:'S/E',
                        sv_temp:'S/E',
                        sv_ta:sv_ta_1+sv_ta_2,
                        sv_fr:sv_fr,
                        sv_oximetria:sv_oximetria.substr(0,4),
                        equipo_ns:equipo_ns,
                        sv_key:xml_file,
                        paciente_nombre:paciente_nombre,
                        paciente_nombre_ap:paciente_nombre_ap,
                        paciente_folio:paciente_folio,
                        csrf_token:csrf_token
                    };
                    $.ajax({
                        url:base_url+"Horacero/Movil/AjaxLocalSignosVitales",
                        type: 'POST',
                        dataType: 'json',
                        data:data_sv,
                        beforeSend: function (xhr) {
                            console.log('Enviando datos al servidor local');
                        },success: function (data, textStatus, jqXHR) {
                            console.log('Datos Enviados al Sevidor local');
                            $('.col-xml-read').append('<h5><i class="fa fa-check i-20 color-imss"></i> '+xml_file+'</h5>');
                            total_lectura=total_lectura+1;
                            $.ajax({
                                url: base_url+"Horacero/Movil/AjaxRemoveFile",
                                type: 'POST',
                                dataType: 'json',
                                data:{
                                    xml:xml_file,
                                    csrf_token:csrf_token
                                },beforeSend: function (xhr) {

                                },success: function (data, textStatus, jqXHR) {
                                    if(total_file==total_lectura){
                                        $.ajax({
                                            url: base_url+"Horacero/Movil/AjaxUpdateStatusDirectoryFiles",
                                            type: 'GET',
                                            dataType: 'json',
                                            beforeSend: function (xhr) {
                                                msj_success_noti('Actalizando status del directorio')
                                            },success: function (data, textStatus, jqXHR) {
                                                $('.col-xml-end').removeClass('hice');
                                                setTimeout(function () {
                                                    //window.top.close();
                                                },2000);
                                            },error: function (jqXHR, textStatus, errorThrown) {
                                                msj_error_serve();
                                            }
                                        });
                                    }
                                },error: function (e) {
                                    msj_error_serve();
                                }
                            })  
                        },error: function (e) {
                            console.log(e);
                        }
                    });
                });
            }); 
        }else{
            $.ajax({
                url: base_url+"Horacero/Movil/AjaxUpdateStatusDirectoryFiles",
                type: 'GET',
                dataType: 'json',
                beforeSend: function (xhr) {
                    msj_success_noti('Actalizando status del directorio')
                },success: function (data, textStatus, jqXHR) {
                    $('.col-xml-end').removeClass('hice');
                    setTimeout(function () {
                        window.top.close();
                    },2000);
                },error: function (jqXHR, textStatus, errorThrown) {
                    msj_error_serve();
                }
            });
        }
    });    
})