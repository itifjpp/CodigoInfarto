<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary" >
                        <h4 class="no-margin color-white chat-con text-uppercase">CHAT CON : <?=$info['empleado_nombre']?> <?=$info['empleado_ap']?> <?=$info['empleado_am']?></h4>
                        <a href="<?= base_url()?>Sections/Protocolos/Pacientes?protocolo=<?=$_GET['prot']?>" class="btn btn-circle red btn-60 pull-left" style="position: absolute;left: -25px;">
                            <i class="fa fa-arrow-left color-white i-24" ></i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="chat-msj scrollable" style="height: 300px;padding: 5px"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" name="chat_de" value="<?=$this->UMAE_USER?>" class="form-control input-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" name="chat_para" value="<?=$_GET['emp']?>" class="form-control input-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" name="chat_para_socket" value="" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group form-group-sm">
                                    <div class="input-group">
                                        <input type="text" name="chat_msj" placeholder="Escribir mensaje" maxlength="100" class="form-control input-sm" readonly="" style="border-radius: 4px 0px 0px 4px">
                                        <span class="input-group-addon back-imss" style="border: none">
                                            <i class="fa fa-paper-plane-o"></i>
                                        </span>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</div>
<input type="hidden" name="tipo_chat" value="Con Paciente">
<input type="hidden" name="empleado_id" value="<?=$this->UMAE_USER?>">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Chat.js?'). md5(microtime())?>" type="text/javascript"></script>
<script>

</script>
