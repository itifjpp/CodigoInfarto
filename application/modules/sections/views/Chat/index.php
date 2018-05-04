<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary" >
                        <h4 class="no-margin color-white chat-con text-uppercase">SELECCIONAR UN CHAT DE LA LISTA</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-8">

                                <div class="chat-msj scrollable" style="height: 350px;padding: 5px"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" name="chat_de" value="<?=$this->UMAE_USER?>" class="form-control input-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" name="chat_para" value="" class="form-control input-sm">
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
                            <div class="col-xs-4" style="border-left: 2px solid #256659">
                                <div class="row" style="margin-top: -10px">
                                    <div class="col-md-12 " style="padding: 8px">
                                        <div class="form-group form-group-sm" style="margin: 0px">
                                            <div class="input-with-icon">
                                                <i class="fa fa-user" style="margin-top: 6px"></i>
                                                <input type="text" name="inputMatricula" class="form-control chat-search input-sm" placeholder="BUSCAR POR MATRICULA" >

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row scrollable chat-list-users" style="height: 360px;">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</div>
<input type="hidden" name="empleado_id" value="<?=$this->UMAE_USER?>">
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Chat.js?'). md5(microtime())?>" type="text/javascript"></script>
<script>

</script>
