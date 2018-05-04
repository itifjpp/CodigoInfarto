var mysql = require('mysql');
//creamos la conexion a nuestra base de datos con los datos de acceso de cada uno
var connect= mysql.createConnection({ 
    host: '127.0.0.1', 
    user: 'sigh5293issste',  
    password: 'sigh-5293-#$issste', 
    database: 'sigh'
});

module.exports=connect;