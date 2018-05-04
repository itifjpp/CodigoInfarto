/*VARIABLE INICIALIZADA PARA CARGAR EL SDK*/
var VITALS_OBJECTID_STRING = "WelchAllyn.Vitals3";
/*VARIBLE DE INCREMENTO (NECESARIO)*/
var VITALS_TIMEOUT = 2000;
var GLOBALSDK = null;
var DEVICECONNECTED = true;
var ScriptVersion = "A";
//METODO PARA OBTENER LOS DATOS DEL SDK Y TRANSMITIRNOS A OTRA PAGINA
function getSDKObject() {
    //COMPRUEBA SU EL OBJETO SDK GLOBAL ES NULO  ESTO SÓLO DEBE OCURRIR CUANDO SE LLAMA ESTE MÉTODO POR PRIMERA VEZ
    try {
        GLOBALSDK = new ActiveXObject(VITALS_OBJECTID_STRING);
        if (GLOBALSDK == null) {
            //alert("SDK VITALS SDK NO HA SIDO ENCONTRADO");
            $('.btn-obtener-sv').addClass('hide');
            $('.Device-WelchAllyn-Status').removeClass('hide').find('h2').html("SDK VITALS SDK NO HA SIDO ENCONTRADO ");
        }
    }catch (Error) {
        console.log(Error);
        $('.btn-obtener-sv').addClass('hide');
        $('.Device-WelchAllyn-Status').removeClass('hide').find('h2').html("EXCEPCIÓN DETECTADA AL INSTANCIA EL OBJETO VITALS! : " + Error);
        //alert("EXCEPCIÓN DETECTADA AL INSTANCIA EL OBJETO VITALS!" + Error.number + ": " + Error.description);
    }
    return (GLOBALSDK);
}
getSDKObject();
GLOBALSDK.AutoDisplay = true; //WYSIWYG A LA PANTALLA DEL DISPOSITIVO
GLOBALSDK.MonitoringMode = true; //RECUPERAR VALORES MIENTRAS EL DISPOSITIVIO SIGUE PROCESANDO DATOS 
function ReadDeviceDataWelchAllyn() {
    var Device,Reading;
    if ($('select[name=inputAutoDisplay]').val() == "true"){ 
        GLOBALSDK.AutoDisplay = true; 
    }else{ 
        GLOBALSDK.AutoDisplay = false; 
    }
    if ($('select[name=inputMonitorMode]').val() == "true"){ 
        GLOBALSDK.MonitoringMode = true; 
    }else{ 
        GLOBALSDK.MonitoringMode = false; 
    }
    try {
        if($('input[name=inputConfig]').val() == "Auto") {
            GLOBALSDK.ScanDevices(true);
            VITALS_TIMEOUT = $('input[name=inputTimeOut]').val();
            try{
                GLOBALSDK.Timeout = VITALS_TIMEOUT;
            }catch (Error) {
                $('input[name=sv_ta]').val('');
                $('input[name=sv_temp]').val('');
                $('input[name=sv_fc]').val('');
                $('input[name=sv_fr]').val('');
                alert("ERROR AL ESTABLECER EL VALOR DE TIEMPO DE ESPERA: " + Error.message);
                return;
            }
        }
        else { 
            GLOBALSDK.ConfigFile = $('input[name=inputConfig]').val() ;
        }
        //RECUPERAR EL PRIMER DISPOSITIVO CONECTADO SI ES VERDADERO, BLOQUEARÁ HASTA EL TIEMPO DE ESPERA
        try {
            Device = GLOBALSDK.Connect(true); //LANZARÁ EXCEPCIÓN SI EL DISPOSITIVO NO SE ENCUENTRA (CUANDO EL MODO DE BLOQUEO ES TRUE)
        }
        catch (Error) {
            alert("NO SE PUEDE CONECTAR AL DISPOSITIVO! ERROR: " + Error);
            return false;
        }
        $('input[name=inputEstatus]').val( "DISPOSITIVO CONECTADO EN: " + Device.ConnectionKey); //ESTADO DEL DISPOSITIVO
        //OBTENER LECTURA DE LA PANTALLA
        Reading = Device.GetCurrentReading();
        if (typeof Reading.Diastolic == 'object'){ 
            $('input[name=inputSys],input[name=sv_ta]').val("Error " + Reading.Diastolic.ErrorCode + ": " + Reading.Diastolic.Description); 
        }else{ 
            if(Reading.Systolic!=undefined){
                $('input[name=inputSys],input[name=sv_ta]').val(Reading.Systolic+'/'+Reading.Diastolic);
            }
            
        }
        if (typeof Reading.HR == 'object'){ 
            $('input[name=inputHR]').val("Error " + Reading.HR.ErrorCode + ": " + Reading.HR.Description); 
        }else{ 
            $('input[name=inputHR]').val(Reading.HR); 
        }
        if (typeof Reading.MAP == 'object'){ 
            $('input[name=inputMAP]').val("Error " + Reading.MAP.ErrorCode + ": " + Reading.MAP.Description); 
        }else{ 
            $('input[name=inputMAP]').val(Reading.MAP); 
        }
        try {
            if (typeof Reading.O2Sat == 'object')
                $('input[name=inputSpo2],input[name=sv_fr]').val("Error " + Reading.O2Sat.ErrorCode + ": " + Reading.O2Sat.Description);
            else
                $('input[name=inputSpo2],input[name=sv_fr]').val(Reading.O2Sat);
            if (typeof Reading.Pulse == 'object')
                $('input[name=inputPulse],input[name=sv_fc]').val("Error " + Reading.Pulse.ErrorCode + ": " + Reading.Pulse.Description);
            else
                $('input[name=inputPulse],input[name=sv_fc]').val(Reading.Pulse);
        }catch (Error) {
            $('input[name=inputSpo2]').val(Error);
            $('input[name=inputPulse]').val(Error);
        }
        
        $('input[name=inputHeight]').val(Reading.Height);    //UNICAMENTE SOPORTADO EN LXi Y CVSM
        $('input[name=inputWeight]').val(Reading.Weight);    //UNICAMENTE SOPORTADO EN LXi Y CVSM
        $('input[name=inputPain]').val(Reading.Pain);        //UNICAMENTE SOPORTADO EN LXi Y CVSM
        $('input[name=inputResp]').val(Reading.Respiration); //UNICAMENTE SOPORTADO EN LXi Y CVSM
        try {
            if (typeof Reading.Temperature == 'object')
                $('input[name=inputTemp],input[name=sv_temp]').val( "Error " + Reading.Temperature.ErrorCode + ": " + Reading.Temperature.Description);
            else
                var Temperatura=Reading.Temperature;
                if(Reading.Temperature!=undefined){
                    $('input[name=inputTemp],input[name=sv_temp]').val(Temperatura.toFixed(1));
                }else{
                    $('input[name=inputTemp],input[name=sv_temp]').val('');
                }
                
        }catch (Error) {
            $('input[name=inputTemp],input[name=sv_temp]').val(Error);
        }
        if (typeof Reading.BestHR == 'object')
            $('input[name=inputBestHR]').val("Error " + Reading.BestHR.ErrorCode + ": " + Reading.BestHR.Description);
        else
        $('input[name=inputBestHR]').val(Reading.BestHR);
        $('input[name=inputReadingDate]').val(Reading.Date);
        $('input[name=inputBMI]').val(Reading.BMI);
        $('input[name=inputCID]').val(Reading.ClinicianID);
        $('input[name=inputPID]').val(Reading.PatientID);
        $('input[name=triage_nombre]').val(Reading.FirstName);
        //OBTENER INFORMACIÓN DEL DISPOSITIVO
        $('input[name=inputDate]').val(Device.Date);
        $('input[name=inputFirmware]').val(Device.Firmware);
        $('input[name=inputLocation]').val(Device.Location);
        $('input[name=inputModelName]').val(Device.ModelName);
        $('input[name=inputModelNumber]').val(Device.ModelNumber);
        $('input[name=inputSerialNumber]').val(Device.SerialNumber);
        try { 
            $('input[name=inputDisplayNIBP]').val(Device.NIBPDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputDisplayNIBP]').val(Error); 
        }
        try { 
            $('input[name=inputDisplayHeight]').val(Device.HeightDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputDisplayHeight]').val(Error); 
        }
        try { 
            $('input[name=inputDisplayTemp]').val(Device.TempDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputDisplayTemp]').val(Error);
        }
        try { 
            $('input[name=inputDisplayWeight]').val( Device.WeightDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputDisplayWeight]').val(Error);
        }
        try { 
            $('input[name=inputDisplayHemo]').val(Device.HemoglobinDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputDisplayHemo]').val(Error); 
        }
        //OBTENER INFORMACIÓN DEL DISPOSITIVO
        try { 
            $('input[name=inputNIBPUnits]').val(Device.NIBPDisplayUnit);
        }catch (Error) { 
            $('input[name=inputNIBPUnits]').val(Error);
        }
        try { 
            $('input[name=inputTempUnits]').val(Device.TempDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputTempUnits]').val(Error); 
        }
        try { 
            $('input[name=inputHeightUnits]').val(Device.HeightDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputHeightUnits]').val(Error);
        }
        try { 
            $('input[name=inputWeightUnits]').val(Device.WeightDisplayUnit); 
        }catch (Error) { 
            $('input[name=inputWeightUnits]').val(Error);
        }
        try {
            $('input[name=inputHemoUnits]').val( Device.HemoglobinDisplayUnit); 
        }
        catch (Error) { 
            $('input[name=inputHemoUnits]').val(Error);
        }
        //OBTENER CADENA XML
        try {
            if ($('select[name=inputXmlFile]').val()== "filereset" || $('select[name=inputXmlFile]').val() == "filenoreset") {
                var d = new Date();
                var xmlfile = "AX_Out_" + d.getTime() + ".xml";
                var encoding = "UTF-8";
                var bom = false;
                Reading.WriteXML(xmlfile, encoding, bom);
                $('textarea[name=inpuXmlString]').val("ARCHIVO ESCRITO EN: " + xmlfile);
            }else {
                var xmlstream = new ActiveXObject("Msxml2.DOMDocument.6.0");
                var encoding = "UTF-8";
                var bom = false;
                Reading.WriteXML(xmlstream, encoding, bom);
                $('textarea[name=inpuXmlString]').val( xmlstream.xml);
            }
        }catch (Error){
            $('textarea[name=inpuXmlString]').val("ERR: NO SE PUDO OBTENER EL XML"); 
        }
        //OBTENER MODIFICADORES
        try{ 
            $('input[name=inputModifiers]').val(Reading.GetModifiers()); 
        }catch (Error){ 
            $('input[name=inputModifiers]').val("ERR: NO SE PUEDO OBTENER LOS MODIFICADORES"); 
        }
        //EMITIR COMANDOS DE LIMPIEZA
        if ($('select[name=inputXmlFile]').val() == "pagereset" || $('select[name=inputXmlFile]').val() == "filereset") {
            try { 
                Device.ResetDevice(); 
            } catch (Error) {
                alert('ERROR AL EMITIR COMANDOS PARA RESETEAR EL DISPOSITIVO');
            }
            try { 
                Device.EraseCycleData(); 
            } catch (Error) {
                alert('ERROR AL EMITIR COMANDOS PARA RESETEAR EL DISPOSITIVO');
            }
        }
        if ($('input[name=inputSetTime]').val() != ""){ 
            try { 
                Device.Date = $('input[name=inputSetTime]').val(); 
                alert("LA FECHA DEL DISPOSITIVO SE HA ESTABLECIDO"); 
            } catch (Error) { 
                alert('ERRO AL ESTABLECER LA FECHA: '+Error); 
            } 
        }
        Reading = Device.GetCurrentReading();
        if (typeof Reading.Diastolic == 'object'){ 
            $('input[name=inputSysposterase]').val("Error " + Reading.Diastolic.ErrorCode + ": " + Reading.Diastolic.Description); 
        }else{ 
            $('input[name=inputSysposterase]').val(Reading.Systolic+'/'+Reading.Diastolic); 
        }if (typeof Reading.O2Sat == 'object'){ 
            $('input[name=inputSpo2posterase]').val("Error " + Reading.O2Sat.ErrorCode + ": " + Reading.O2Sat.Description); 
        }else{ 
            $('input[name=inputSpo2posterase]').val(Reading.O2Sat); 
        }
        $('input[name=sv_via]').val('WelchAllyn');
        $('input[name=inputTimeposterase]').val(Device.Date); 
        //msj_success_noti('TOMA DE SIGNOS VITALES REALIZADO CORRECTAMENTE');
        $('.btn-obtener-sv').removeClass('hide')
        //Device.ResetDevice(); 
    }catch (Error) {
        alert("HA OCURRIDO UN ERROR INESPERADO!\n\n " + Error);
    }finally {
        $('input[name=ScriptVersion]').val(ScriptVersion);
        GLOBALSDK.Disconnect();            
    }
}