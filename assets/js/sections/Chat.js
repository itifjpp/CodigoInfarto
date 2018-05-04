$(document).ready(function (e) {
    $('#chat_para').select2();
    if($('input[name=tipo_chat]').val()!=undefined){
        setTimeout(function () {
            var chat_para=$('input[name=chat_para]').val();
            var chat_para_socket=$('input[name=chat_para_socket]').val();
            var chat_de=$('input[name=chat_de]').val();
            $('input[name=chat_para]').val(chat_para);
            $('input[name=chat_para_socket]').val(chat_para_socket);
            $('input[name=chat_msj]').removeAttr('readonly');
            $('.chat-msj').html("");
            sighAjaxPost({
                chat_de:chat_de,
                chat_para:chat_para
            },base_url+'Sections/Chat/AjaxMessages',function (msj) {
                $.each(msj,function (i,e) {
                    appendMessage(e)
                });
                animateScroll();
            });
        },4000);
        setTimeout(function () {
            sighAjaxPost({
                empleado_id:$('input[name=chat_para]').val()
            },base_url+'Sections/Chat/AjaxGetSocket',function (response) {
                $('input[name=chat_para_socket]').val(response.empleado_socket_id);
            })
        },5000);
    }
    
    $('input[name=chat_msj]').keypress(function (e) {
        let chat_msj=$(this).val();
        let input=$(this);
        let chat_para=$('input[name=chat_para]').val();
        let chat_para_socket=$('input[name=chat_para_socket]').val();
        var chat_de=$('input[name=chat_de]').val();
        let chat_fecha=getFechaHora();
        if(e.which==13 && chat_msj!=''){
            var info_msj={
                chat_fecha:chat_fecha,
                chat_msj:chat_msj,
                chat_para:chat_para,
                chat_de:chat_de,
                chat_socket:chat_para_socket
            }
            socket.emit('insertMessage',info_msj);
            socket.emit('listeningChat',{
                chat_para:chat_para,
                chat_de:chat_de
            });
            appendMessage(info_msj);
            input.val('');
        }
        animateScroll();
    });
    socket.emit('startChat',{
        cliente_id:$('input[name=empleado_id]').val()
    });
    let totalMsj=0;
    socket.on('updateLoadLista',function (msj) {
        AjaxListaUsuario();
    })
    socket.on('notificationChat',function(msj) {
        
        let chat_de=$('input[name=chat_de]').val();
        let chat_para=$('input[name=chat_para]').val();
        if(chat_de==msj.chat_para){
            totalMsj++;
            $('body .notifications-msj a span').html(totalMsj);
        }
    });
    socket.on('actualizarChat',function(msj) {
        let chat_de=$('input[name=chat_de]').val();
        let chat_para=$('input[name=chat_para]').val();
        let chat_para_socket=$('input[name=chat_para_socket]').val();
        //if(chat_de==msj.chat_de && chat_para==msj.chat_para || chat_de==msj.chat_para && chat_para==msj.chat_de){
            appendMessage(msj);
            animateScroll();
        //}
    });
    function appendMessage(msj) {
        let chat_de=$('input[name=chat_de]').val();
        let align_msj='';
        let msj_border='';
        if(msj.chat_de==chat_de){
            align_msj='left';
            msj_border='box-msj-left';
        }else{
            align_msj='right';
            msj_border='box-msj-right';
        }
        $('.chat-msj').append('<div class="row" style="margin: auto;margin-bottom: 5px;">'+
                                            '<div class="chat-msj-content '+msj_border+'" style="float:'+align_msj+'">'+
                                                '<h6 class="msj">'+msj.chat_msj+'</h6>'+
                                                '<div class="time">'+msj.chat_fecha+'</div>'+
                                            '</div>'+
                                        '</div>');
           
    }
    function animateScroll(){
        var container = $('.chat-msj');
        container.animate({"scrollTop": $('.chat-msj')[0].scrollHeight}, "slow");
    }
    $('input[name=inputMatricula]').keypress(function (e) {
        var inputMatricula=$(this).val();
        if(e.which==13 && inputMatricula!=''){
            SendAjaxPost({
                inputMatricula:inputMatricula,
            },'Sections/Chat/AjaxSearch',function (response) {
               if(response.sql.length>0){
                   $('.chat-list-users').html('');
                   $.each(response.sql,function (i,e) {
                        $('.chat-list-users').append('<div class="col-xs-12 pointer start-chat-user" style="margin-bottom: 6px" data-id="'+e.empleado_id+'" data-user="'+e.empleado_nombre+' '+e.empleado_ap+' '+e.empleado_am+'">'+
                                    '<div class="row">'+
                                        '<div class="col-md-1">'+
                                            '<img src="'+base_url+'assets/img/perfiles/'+e.empleado_perfil+'" style="height:35px;width: 35px;border-radius: 50%">'+
                                        '</div>'+
                                        '<div class="col-xs-10" style="padding-left: 30px">'+
                                            '<div class="text-nowrap-imss" style="font-size: 10px">'+
                                                '<b>'+e.empleado_nombre+' '+e.empleado_ap+' '+e.empleado_am+'</b>'+
                                            '</div>'+
                                            '<h6 style="margin: -4px 0px;font-size: 10px">'+e.empleado_matricula+'</h6>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>')
                    })
               }
            });
        }
    });
    AjaxListaUsuario()
    function AjaxListaUsuario(){
        sighAjaxGet(base_url+'Sections/Chat/AjaxListaUsers',function (response) {
           if(response.sql.length>0){
               $('.chat-list-users').html('');
               var empleado_id=$('input[name=empleado_id]').val();
               $.each(response.sql,function (i,e) {
                   if(empleado_id!=e.empleado_id){
                    $('.chat-list-users').append(
                        '<div class="col-xs-12 pointer start-chat-user" style="margin-bottom: 6px" data-id="'+e.empleado_id+'" data-socket="'+e.empleado_socket_id+'" data-user="'+e.empleado_nombre+' '+e.empleado_ap+' '+e.empleado_am+'">'+
                            '<div class="row">'+
                                '<div class="col-xs-1">'+
                                    '<img src="'+base_url+'assets/img/perfiles/'+e.empleado_perfil+'" style="height:35px;width: 35px;border-radius: 50%">'+
                                '</div>'+
                                '<div class="col-xs-10" style="padding-left: 30px">'+
                                    '<h6 class="no-margin text-nowrap semi-bold">'+e.empleado_nombre+' '+e.empleado_ap+' '+e.empleado_am+'</h6>'+
                                    '<h6 style="margin: -4px 0px;">'+e.empleado_matricula+'</h6>'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                    }
                });
           }
        });
    }
})