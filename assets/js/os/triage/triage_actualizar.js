var total_actual,total_nuevo;
$(document).ready(function (e){
//    $.ajax({
//        url: base_url+"triage/obtener_total",
//        dataType: 'json',
//        beforeSend: function (xhr) {
//            
//        },success: function (data, textStatus, jqXHR) {
//            total_actual=data.total;
//        },error: function (jqXHR, textStatus, errorThrown) {
//            
//        }
//    });
//    setInterval(function(){
//        $.ajax({
//            url: base_url+"triage/obtener_total",
//            dataType: 'json',
//            beforeSend: function (xhr) {
//
//            },success: function (data, textStatus, jqXHR) {
//                total_nuevo=data.total;
//                if (total_actual!=total_nuevo){
//                    
//                    setTimeout(function(){
//                        msj_success_noti('Nuevos Registros...');
//                        location.reload(); 
//                       
//                    },1000);
//                }
//            },error: function (jqXHR, textStatus, errorThrown) {
//
//            }
//        });    
//    },2000);   
})