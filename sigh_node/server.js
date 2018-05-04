var express=require('express');
var app=express();
var fs = require('fs')  ;
var location = require('location-href')
var privateKey  = fs.readFileSync('sslcert/sigh.key', 'utf8');
var certificate = fs.readFileSync('sslcert/sigh.crt', 'utf8');
var credentials = {key: privateKey, cert: certificate};
//var http    =     require('http').createServer(app);
var https = require('https').createServer(credentials,app);
var socket      =     require("socket.io");
var modelChat = require('./models/mdlChat');
var path    = require("path");
var SiGH_USER=0;
require('./routers')(app);
var io=socket.listen(https);
io.sockets.on('connect',function(client){    
    client.on('assignId',function (data) {
        SiGH_USER=data.SiGH_USER;  
    });
//    io.engine.generateId = function (req) {
//        return SiGH_USER;
//    }
    client.on('actualizarChat',function(data){
       io.sockets.emit('actualizarChat',data); 
    });
    client.on('notificationChat',function (data) {
        io.sockets.emit('notificationChat',data)
    });
    client.on('EnsatRealTime',function (data) {
        io.sockets.emit('EnsatRealTime',data)
    });
    client.on('UpdateCalendarEvents',function (data) {
        io.sockets.emit('UpdateCalendarEvents',data)
    });
    client.on('UpdateAnalisisIngresos',function (data) {
        io.sockets.emit('UpdateAnalisisIngresos',data);
    })
    client.on('NewNotification',function (data) {
        io.sockets.emit('NewNotification',data)
    });
    client.on('CallPatientOnScreen',function (data) {
        io.sockets.emit('CallPatientOnScreen',data);
    });
    client.on('CallPatientOnScreenReady',function (data) {
        io.sockets.emit('CallPatientOnScreenReady',data);
    });
    client.on('UpdateWaitingList',function (data) {
        io.sockets.emit('UpdateWaitingList',data);
    });
    
    client.on('startChat',function (data) {
        modelChat.updateClientSocket(function (error,response) {
            console.log('NUEVO CLIENTE CONECTADO AL CHAT('+client.id+')...');
        },{
            empleado_id:data.cliente_id,
            socket_id:client.id
        });
        io.sockets.emit('updateLoadLista',data);
    });
    client.on('insertMessage',function (data) {
        modelChat.insertMensaje(function(response){
            modelChat.getMessages(function(error,query){
                io.sockets.in(data.chat_socket).emit('actualizarChat', query[0]);
                //client.broadcast.to(data.chat_para).emit('actualizarChat', query[0]);
                //client.broadcast.to(data.chat_de).emit('actualizarChat', query[0]);
                //console.log(data.chat_socket);
                //io.sockets.emit('actualizarChat',query[0]);
                //io.sockets.emit('notificationChat',query[0]); 
            },data);
        },data);
    });
    client.on('listeningChat',function (data) {
        io.sockets.emit('listeningChat',data);
    });
//    client.on("disconnect", function(data){
//        modelChat.updateClientSocketDisconnect(function (error,response) {
//            console.log('CLIENTE DESCONECTADO DEL CHAT('+client.id+')...');
//        },{
//            socket_id:client.id
//        });
//        io.sockets.emit('updateLoadLista',data);
//    });

});
https.listen(5000,function () {
    console.log('SERVER HTTPS IS READY AND LISTENING IN PORT 5000');
});
