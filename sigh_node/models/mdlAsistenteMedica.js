var mdlConnection= require ('./mdlConnection');
//creamos un objeto para ir almacenando todo lo que necesitemos
var models = {};
models.getPaciente=function (callback,INGRESO_ID) {
    if(mdlConnection){
        mdlConnection.query("SELECT ing.ingreso_date_medico,ing.ingreso_time_medico,ing.ingreso_am_id FROM sigh_pacientes_ingresos AS ing WHERE ing.ingreso_id='"+INGRESO_ID+"'",function (error,rows) {
            if(error){
                callback(null,{
                    action:'error'
                });
                console.log("ERROR GET PACIENTE ASISTENTE MEDICA");
            }else{
                if(rows.length==0){
                    callback(null,{
                        action:'no_existe'
                    });
                }else{
                    callback(null,{
                        action:1,
                        sql:rows[0]
                    });
                }
                
            }
        })
    }
}
models.PacientesAm=function (callback,Empleado) {
    if(mdlConnection){
        mdlConnection.query('SELECT triage.triage_id,triage.triage_nombre, triage.triage_nombre_ap, triage.triage_nombre_am,'+
                        'triage.triage_color,triage.triage_fecha_clasifica,'+
                        'triage.triage_hora_clasifica, am.asistentesmedicas_fecha, am.asistentesmedicas_hora,'+ 
                        'pin.pia_lugar_accidente FROM os_triage as triage, os_asistentesmedicas as am ,paciente_info AS pin WHERE '+
                        'am.triage_id=triage.triage_id AND pin.triage_id=triage.triage_id AND '+
                        'triage.triage_crea_am='+Empleado+'  LIMIT 10',function(error, rows) {
        if(error){
                throw error;
            }else{
                callback(null, rows);
            }   
        });
    }
};
//exportamos el objeto para
module.exports = models;