<?= Modules::run('Sections/Menu/loadHeaderBasico')?>
<div class="row m-t-10">
    <div class="col-md-12">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary">
                <h4 class="color-white no-margin">GUARDAR FIRMA DIGITAL DEL USUARIO</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-5">
                        <object id="sigCtl1" style="width:100%;height:200px"type="application/x-florentis-signature"></object>
                    </div>
                    <div class="col-md-5">
                        <img id="b64image" style="width:300px;height:150px">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-block btn-success" onclick="Capture()">Sign</button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-success" onclick="ClearSignature()">Clear Signature</button>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-success" onclick="DisplaySignatureDetails()">Get Information</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea cols="125" rows="4" id="txtDisplay" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 hide">
                        <div class="form-group">
                            <textarea cols="125" rows="4" id="txtSignature" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <h4 class="no-margin">WARNING:</h4>
                            <h5 class="no-margin">This application is only supported by Internet Explorer (The Javascript uses ActiveX controls which are not supported by alternative browsers such as Firefox)</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= Modules::run('Sections/Menu/loadFooterBasico')?>
<script type="text/javascript">
    /*
    TestSDKCapture-B64Image-Display.html

    Internet Explorer Signature Capture test

    Demonstrates Signature Capture and renderBitmap with B64 encoding
    Displays the B64 data in img.src

    Copyright (c) 2014 Wacom GmbH. All rights reserved.
    */
    OnLoad();
    function Capture() {
        try {
            print("Capturing signature...");
            var sigCtl = document.getElementById("sigCtl1");
            var dc = new ActiveXObject("Florentis.DynamicCapture");
            var rc = dc.Capture(sigCtl, "Administrador SiGH", "Sistema de Gestión Hospitalaria");
            sigCtl.SetProperty("Licence","AgAZAPZTkH0EBVdhY29tClNESyBTYW1wbGUBAoECA2UA");
            if(rc != 0 )
            print("Capture returned: " + rc);
            switch( rc ) {
                case 0: // CaptureOK
                    print("Signature captured successfully");
                    var txtSignature = document.getElementById("txtSignature");
                    flags = 0x2000 + 0x80000 + 0x400000; //SigObj.outputBase64 | SigObj.color32BPP | SigObj.encodeData
                    b64 = sigCtl.Signature.RenderBitmap("", 300, 150, "image/png", 0.5, 0xff0000, 0xffffff, 0.0, 0.0, flags );
                    txtSignature.value=b64;
                    var imgSrcData = "data:image/png;base64,"+b64;
                    document.getElementById("b64image").src=imgSrcData;

                    break;
                case 1: // CaptureCancel
                    print("Signature capture cancelled");
                    break;
                case 100: // CapturePadError
                    print("No capture service available");
                    break;
                case 101: // CaptureError
                    print("Tablet Error");
                    break;
                case 102: // CaptureIntegrityKeyInvalid
                    print("The integrity key parameter is invalid (obsolete)");
                    break;
                case 103: // CaptureNotLicensed
                    print("No valid Signature Capture licence found");
                    break;
                case 200: // CaptureAbort
                    print("Error - unable to parse document contents");
                    break;
                default: 
                    print("Capture Error " + rc);
                    break;
            }
        }catch(ex) {
            Exception("Capture() error: " + ex.message);
        }
    }

    function ClearSignature() {
        try {
            var sigCtl = document.getElementById("sigCtl1");
            sigCtl.Signature.Clear();
        }catch(ex) {
            Exception("ClearSignature() error: " + ex.message);
        }
    }

    function DisplaySignatureDetails() {
        try {
            var sigCtl = document.getElementById("sigCtl1");
            if (sigCtl.Signature.IsCaptured) {
                print("Signature Information:");
                print("  Name:   " + sigCtl.Signature.Who);
                print("  Date:   " + sigCtl.Signature.When);
                print("  Reason: " + sigCtl.Signature.Why);
            }
        }catch(ex) {
            Exception("DisplaySignatureDetails() error: " + ex.message);
        }
    }

    function AboutBox() {
        try {
            var sigCtl = document.getElementById("sigCtl1");
            sigCtl.SetProperty("Licence","AgAZAPZTkH0EBVdhY29tClNESyBTYW1wbGUBAoECA2UA");
            sigCtl.AboutBox();
        }catch(ex) {
            Exception("About() error: " + ex.message);
        }
    }

    function Exception(txt) {
        print("Exception: " + txt);
    }
    function print(txt) {
        var txtDisplay = document.getElementById("txtDisplay");
        if(txt == "CLEAR" )
            txtDisplay.value = "";
        else {
            txtDisplay.value += txt + "\n";
            txtDisplay.scrollTop = txtDisplay.scrollHeight; // scroll to end
        }
    }

    function OnLoad() {
        try {
            print("CLEAR");
            var sigCtl = document.getElementById("sigCtl1");
            sigCtl.BackStyle = 1;
            sigCtl.DisplayMode=0; // fit signature to control
            print("Checking components...");
            sigCtl.SetProperty("Licence","AgAZAPZTkH0EBVdhY29tClNESyBTYW1wbGUBAoECA2UA");
            var sigcapt = new ActiveXObject('Florentis.DynamicCapture');  // force 'can't create object' error if components not yet installed
            var lic = new ActiveXObject("Wacom.Signature.Licence");
            
            print("DLL: Licence.dll   v" + lic.GetProperty("Component_FileVersion"));
            print("DLL: flSigCOM.dll  v" +   sigCtl.GetProperty("Component_FileVersion"));
            print("DLL: flSigCapt.dll v" + sigcapt.GetProperty("Component_FileVersion"));
            print("Test application ready.");
            print("Press 'Sign' to capture a signature.");
        }catch(ex) {
            Exception("OnLoad() error: " + ex.message);
        }
    }
</script>
