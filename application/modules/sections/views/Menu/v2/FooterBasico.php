        </div>
        <script>
            var base_url = "<?= base_url(); ?>"
            var url_string="<?=$this->uri->uri_string()?>";
            var um_nombre="<?=_UM_NOMBRE?>";
            var um_tipo="<?=_UM_TIPO?>";
            var um_clasificacion="<?=_UM_CLASIFICACION?>";
            var base_domain=window.location.host;
            var base_url_server='https://'+base_domain+':5000/';
        </script>
        <?php foreach ($scripts as $value) {?>
            <script src="<?=base_url()?>assetsv2/<?=$value?>" type="text/javascript"></script>
        <?php }?> 
        <script src="https://<?=base_domain?>:5000/socket.io/socket.io.js" type="text/javascript"></script>
        <script>
            
//            $.ajax({
//                url:base_url_server+'TestServer',
//                type: 'GET',
//                success: function (data, textStatus, jqXHR) {
//                    console.log('CONEXIÓN CON EL SERVIDOR ESTABLECIDA...');
//                },error: function (e) {
//                    sighMessenger({
//                        msj:'INTENTANDO CONEXIÓN NUEVAMENTE EN 10 SEGUNDOS...',
//                        type:'error',
//                        position:'right bottom'
//                    })
//                    sighMessenger({
//                        msj:'ERROR DE CONEXIÓN CON EL SERVIDOR...',
//                        type:'error',
//                        position:'right bottom'
//                    });
//                    
//                    console.log('ERROR DE CONEXIÓN CON EL SERVIDOR...');
//                    console.log('INTENTANDO CONEXIÓN NUEVAMENTE EN 10 SEGUNDOS...');
//                    setTimeout(function() {
//                        location.reload();
//                    },10000);
//                }
//            });
            var socket=io.connect(base_url_server);
            
        </script>
        <script src="<?=  base_url()?>assets/js/_umConfig.js?time=<?= sha1(microtime())?>" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assets/js/Mensajes.js?time=<?= sha1(microtime())?>" type="text/javascript"></script> 
        <script src="<?=  base_url()?>assetsv2/webarch/js/webarch.js?=<?= date('YmdHis')?>" type="text/javascript"></script>
        <script src="<?=  base_url()?>assetsv2/webarch/js/sigh.js?time=<?= sha1(microtime())?>" type="text/javascript"></script> 
        <script src="<?=base_url()?>assetsv2/js/chat.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                checkConnectionServer();
            }) 
        </script>
    </body>
</html>