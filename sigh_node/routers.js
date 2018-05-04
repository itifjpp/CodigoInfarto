var modelAm = require('./models/mdlAsistenteMedica');
var modelPacientte = require('./models/mdlPaciente');
var modelTriage = require('./models/mdlTriage');
var modelChoque = require('./models/mdlChoque');

//creamos el ruteo de la aplicación
module.exports = function(app){
    app.use(function(req, res, next) {
        // Website you wish to allow to connect
        res.setHeader('Access-Control-Allow-Origin', '*');
        // Request methods you wish to allow
        res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
        // Request headers you wish to allow
        res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
        // Set to true if you need the website to include cookies in the requests sent
        // to the API (e.g. in case you use sessions)
        res.setHeader('Access-Control-Allow-Credentials', true);
        // Pass to next layer of middleware
        next();
    });
    app.get("/TriagePaciente/:paciente/:area",function (req,res) {
        var Paciente=req.params.paciente;
        modelTriage.getEtapa(function (error,response) { 
            if(response.length>0){
                if(req.params.area=='Enfermeria Triage'){
                    res.json(200,{
                        'msj':'FOLIO ENCONTRADO' 
                    });
                    console.log('GET PACIENTE ENFERMERIA TRIAGE...');
                }else{
                    if(response[0].ingreso_date_enfermera==null){
                        res.json(200,{
                            'msj':'NO ENFERMERIA' 
                        });
                    }else{
                        if(response[0].ingreso_date_medico==null){
                            res.json(200,{
                                'msj':'PACIENTE NO CLASIFICADO' 
                            });
                        }else{
                            modelTriage.getEtapaInfo(function (err,infos) {
                                modelTriage.getEmpleado(function (err,resp) {
                                    res.json(200,{
                                        msj:'PACIENTE CLASIFICADO' ,
                                        info:infos[0],
                                        medico:resp[0]
                                    });
                                },response[0].ingreso_medico_id);
                            },response[0].ingreso_id); 
                        }
                    }
                    console.log('GET PACIENTE MEDICO TRIAGE...');
                }
                
            }else{
                res.json(200,{
                   'msj':'FOLIO NO VALIDO' 
                });
            }
            
        },Paciente);
    });
    app.get("/PacientesInChoque", function(req,res){
        modelChoque.getPacientesChoque(function(error, data){
            res.json(200,{
                'sql':data
            });
            console.log("GET LISTA DE PACIENTES EN ASISTENTES MEDICAS CHOQUE.");
        });
    });
    app.get("/getPacienteAm/:id", function(req,res){
        var INGRESO_ID = req.params.id;
        modelAm.getPaciente(function(error, data){
            res.json(200,data);
            console.log("GET PACIENTE ASISTENTE MÉDICA");
        },INGRESO_ID);
    });
    app.get("/PacientesInAm/:id", function(req,res){
        var Empleado = req.params.id;
        modelAm.PacientesAm(function(error, data){
            res.json(200,data);
            console.log("GET LISTA DE PACIENTES EN ASISTENTES MÉDICAS");
        },Empleado);
    });
    app.get("/NotasMedicas/:id", function(req,res){
        var Paciente = req.params.id;
        modelPacientte.getNotasMedicas(function(error, data){
            res.json(200,{
                'notas':data
            });
            console.log("GET DATOS PARA EL EXPEDIENTE DEL PACIENTE");
        },Paciente);
    });
    app.get("/EventosMedicos/:id", function(req,res){
        let paciente_id = req.params.id;
        modelPacientte.getEventosMedicos(function(error, data){
            res.json(200,{
                eventos:data
            });
        },paciente_id);
    });
    app.get("/InformacionPaciente/:id",function (req,res) {
        var Paciente = req.params.id;
        modelPacientte.getPaciente(function(error, data){
            res.json(200,data);
            console.log("GET DATOS DEL PACIENTE");
        },Paciente); 
    });
    app.get("/TestServer",function (req,res) {
        res.json(200,{
            connection:'ok'
        });
    });
}
