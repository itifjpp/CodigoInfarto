var mdlConnection= require ('./mdlConnection');
//creamos un objeto para ir almacenando todo lo que necesitemos
var models = {};

models.insertMensaje=function (callback,data) {
    if(mdlConnection){
        mdlConnection.query("INSERT INTO sigh_chat VALUES(0,'"+data.chat_fecha+"','"+data.chat_msj+"','Nuevo',"+data.chat_para+","+data.chat_de+",'"+data.chat_socket+"')",function (error,response) {
            if(error){
                throw  error;
            }else{
                callback(null,{accion:'Ok'});
            }
        })
    }
}
models.updateClientSocket=function (cb,data) {
    if(mdlConnection){
        mdlConnection.query("UPDATE sigh_empleados SET empleado_socket_id='"+data.socket_id+"' WHERE empleado_id='"+data.empleado_id+"'",function (error,response) {
            if(error){
                throw  error;
            }else{
                cb(null,{accion:'Ok'});
            }
        })
    }
}
models.updateClientSocketDisconnect=function (cb,data) {
    if(mdlConnection){
        mdlConnection.query("UPDATE sigh_empleados SET empleado_socket_id='' WHERE empleado_socket_id='"+data.socket_id+"'",function (error,response) {
            if(error){
                throw  error;
            }else{
                cb(null,{accion:'Ok'});
            }
        })
    }
}
models.getAllMessages=function (callback) {
    if(mdlConnection){
        mdlConnection.query("SELECT * FROM sigh_chat AS c ",function (error,response) {
            if(error){
                throw  error;
            }else{
                callback(null,response);
            }
        })
    }
}
models.getMessages=function (callback,data) {
    if(mdlConnection){
        mdlConnection.query("SELECT * FROM sigh_chat AS c WHERE c.chat_id=(SELECT MAX(chat_id) FROM sigh_chat AS c WHERE  c.chat_de="+data.chat_de+" AND c.chat_para="+data.chat_para+" OR c.chat_de="+data.chat_para+" AND c.chat_para="+data.chat_de+")",function (error,response) {
            if(error){
                throw  error;
            }else{
                callback(null,response);
            }
        })
    }
}
//exportamos el objeto para
module.exports = models;