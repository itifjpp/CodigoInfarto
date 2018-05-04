$(document).ready(function () {
    /*BUSCAR PACIENTES*/
    $('input[name=TriageID_TA]').focus();
    $('input[name=TriageID_TA]').keyup(function () {
        let triage_id=$(this).val();
        let input=$(this);
        if(triage_id.length==11 && triage_id!=''){
            SendAjaxPost({
                triage_id:triage_id,
                csrf_token:csrf_token
            },'TerapiaIntensiva/AjaxPacientes',function (response) {
               if(response.accion=='1'){
                   location.href=base_url+'Sections/Documentos/Expediente/'+triage_id+'/?tipo=TerapiaIntensiva'
               }else{
                    msj_error_noti("EL N° DE FOLIO NO EXISTE");
               }
            });
            input.val("");
        }
    })
})

