var mdlConnection= require ('./mdlConnection');
//creamos un objeto para ir almacenando todo lo que necesitemos
var models = {};
models.getPacientesChoque = function(callback){
    if (mdlConnection){
        mdlConnection.query(`SELECT ing.ingreso_id, ing.ingreso_tipopaciente, ing.ingreso_date_horacero,ing.ingreso_time_horacero, pac.paciente_pseudonimo, pac.paciente_nombre,
                            pac.paciente_ap, pac.paciente_am, pac.paciente_sexo, pac.paciente_nss, pac.paciente_nss_agregado,
                            pac.paciente_nss_armado FROM sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing, sigh_choque AS cq WHERE
                            pac.paciente_id=ing.paciente_id AND cq.ingreso_id=ing.ingreso_id
                            AND cq.choque_status='Ingreso' ORDER BY cq.choque_id DESC LIMIT 10`, function(error, rows) {
            if(error){
                throw error;
            }else{
                callback(null, rows);
            }
        });
    }
};
module.exports = models;