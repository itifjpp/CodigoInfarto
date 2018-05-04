var mysql = require('mysql');
//creamos la conexion a nuestra base de datos con los datos de acceso de cada uno
var connect= mysql.createConnection({ 
    host: '127.0.0.1', 
    user: 'ci5293',  
    password: 'ci5293#$', 
    database: 'codigoinfarto'
});

module.exports=connect;