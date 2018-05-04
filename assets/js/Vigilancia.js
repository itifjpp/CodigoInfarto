$(document).ready(function (e) {
    $('input[name=triage_id]').focus();
    $('input[name=triage_id]').keyup(function (e) {
        var input=$(this);
        var triage_id=$(this).val();
        if(triage_id.length==11 && triage_id!=''){
            SendAjaxPost({
                triage_id:triage_id,
                csrf_token:csrf_token
            },'Vigilancia/AjaxAccesos',function (response) {
                console.log(response)
                if(response.accion=='1'){
                    location.href=base_url+'Vigilancia/Paciente/'+triage_id+'?tipo='+response.pv_tipo;
                }
            });
            input.val('');
        }
    });
    $(document).on('click','.acceso-paciente',function (e) {
        var familiar_id=$(this).attr('data-id');
        var familiar_acceso=$(this).attr('data-acceso')
        SendAjaxPost({
            familiar_id:familiar_id,
            familiar_acceso:familiar_acceso,
            csrf_token:csrf_token
        },'Vigilancia/AjaxIngresoFamiliar',function (response) {
            location.reload();
        })
    });
})