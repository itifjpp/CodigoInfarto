(function($){
    var stimeout = 3000;
    var tTimeout=0;
    var TimeTrans=0;
    $(document).bind("idle.idleTimer", function(){
//        TimeTrans++;
//        bootbox.dialog({
//            message:'<div class="row"><div class="col-md-12"><center><i class="fa fa-clock-o fa-5x color-imss"></i><h6 style="line-height:1.6">SE HA DETECTADO INACTIVIDAD POR MAS DE 10 MINUTOS EN LA PÁGINA, LA SESIÓN SE CERRARA.</h6></center></div></div>',
//            size:'small'
//        });
//        var y = window.top.outerHeight / 4 ;
//        $('.modal-dialog').css({
//            'margin-top':y+'px',
//        })
    });
    $(document).bind("active.idleTimer", function(){
        //bootbox.hideAll();
        
    });
    $(document).idleTimer(stimeout);
})(jQuery);
