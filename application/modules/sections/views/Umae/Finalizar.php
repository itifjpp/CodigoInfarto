<?= modules::run('Sections/Menu/HeaderBasico'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-6 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase;text-align: center">
                        <center>
                            <b style="font-size: 20px"><?=$info['unidadmedica_tipo']?></b><br>
                            <b style="font-size: 13px"><?=$info['unidadmedica_nombre']?></b><br>
                        </center>
                    </span>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?=  base_url()?>assets/img/imss.png" class="img-responsive " style="width: 150px;height: 150px; margin-top: 15px;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-justify">PERSONALIZACIÓN DEL SISTEMA DE TRIAGE FINALIZADO. YA PUEDE INGRESAR AL SISTEMA COMO ADMISTRADOR.</h4><br><br>
                            <a href="<?= base_url()?>">
                                <button class=" btn back-imss pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FINALIZAR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/FooterBasico'); ?>
<script src="<?= base_url('assets/js/Sections/UMAE.js?'). md5(microtime())?>" type="text/javascript"></script>