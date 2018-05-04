var mdlConnection= require ('./mdlConnection');
//creamos un objeto para ir almacenando todo lo que necesitemos
var models = {};
models.getEtapa=function (callback,Paciente) {
    if(mdlConnection){
        mdlConnection.query("SELECT ing.ingreso_clasificacion,ing.ingreso_date_horacero,ing.ingreso_time_horacero,ing.ingreso_date_enfermera,ing.ingreso_time_enfermera,ing.ingreso_date_medico,ing.ingreso_time_medico,ing.ingreso_medico_id,ing.ingreso_consultorio_nombre,ing.ingreso_id,ing.ingreso_en FROM sigh_pacientes_ingresos AS ing WHERE ing.ingreso_id='"+Paciente+"'",function (error,query) {
            if(!error){
                callback(null,query);
            }else{
                throw error;
            }
        });
    }
};
models.getEtapaInfo=function (callback,Paciente) {
    if(mdlConnection){
        mdlConnection.query("SELECT pac.paciente_nombre,pac.paciente_ap, pac.paciente_am ,ing.ingreso_en,ing.ingreso_destino_triage,ing.ingreso_clasificacion,ing.ingreso_date_horacero,ing.ingreso_time_horacero,ing.ingreso_date_enfermera,ing.ingreso_time_enfermera,ing.ingreso_date_medico,ing.ingreso_time_medico,ing.ingreso_medico_id,ing.ingreso_consultorio_nombre,ing.ingreso_id FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing WHERE ing.paciente_id=pac.paciente_id AND ing.ingreso_id='"+Paciente+"'",function (error,query) {
            if(!error){
                callback(null,query);
            }else{
                throw error;
            }
        });
    }
};

models.getEmpleado=function (callback,Empleado) {
    if(mdlConnection){
        mdlConnection.query("SELECT e.empleado_id, e.empleado_matricula, e.empleado_nombre,e.empleado_ap,e.empleado_am FROM sigh_empleados AS e WHERE e.empleado_id="+Empleado,function (error,query) {
            if(!error){
                callback(null,query);
            }else{
                throw error;
            }
        });
    }
};
//exportamos el objeto para
module.exports = models;