var mdlConnection= require ('./mdlConnection');
//creamos un objeto para ir almacenando todo lo que necesitemos
var models = {};

models.getNotasMedicas=function (callback,Paciente) {
    if(mdlConnection){
        mdlConnection.query(`SELECT nota.notas_id,nota.notas_fecha,nota.notas_hora, nota.notas_tipo,nota.notas_area, nota.notas_temp,
                                                        em.empleado_nombre, em.empleado_ap,em.empleado_am, em.empleado_id
                                                        FROM sigh_notas AS nota, sigh_empleados AS em WHERE 
                                                        nota.empleado_id=em.empleado_id AND
                                                        nota.ingreso_id=`+Paciente,function (error,response) {
            if(error){
                throw error;
            }else{
                callback(null, response);
            } 
        })
    }
}
models.getEventosMedicos=function (callback,paciente_id) {
    if(mdlConnection){
        mdlConnection.query("SELECT ing.ingreso_id, ing.ingreso_date_horacero,ing.ingreso_time_horacero FROM sigh_pacientes_ingresos AS ing WHERE ing.paciente_id='"+paciente_id+"'",function (error,response) {
            if(error){
                throw error;
            }else{
                callback(null, response);
            } 
        });
    }
};
models.getPaciente=function (callback,paciente) {
    if(mdlConnection){
        mdlConnection.query("SELECT pac.paciente_id,pac.paciente_nombre, pac.paciente_ap, pac.paciente_am, pac.paciente_fn, pac.paciente_sexo, pac.paciente_nss,"+
                            "pac.paciente_nss_agregado, pac.paciente_rfc, info.info_lugar_accidente, info.info_procedencia_esp, "+
                            "info.info_procedencia_esp_lugar, info.info_procedencia_lugar, info.info_procedencia_hospital, info.info_procedencia_hospital_num,"+
                            "ing.ingreso_clasificacion FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_pacientes_info_ing AS info "+
                            "WHERE pac.paciente_id=ing.paciente_id AND ing.ingreso_id=info.ingreso_id AND "+
                            "ing.ingreso_id='"+paciente+"'",function (error,response) {
            if(error){
                throw error;
            }else{
                callback(null, response);
            } 
        });
    }
};
//exportamos el objeto para
module.exports = models;