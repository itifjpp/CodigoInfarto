<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12 ">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white"><?=$_SESSION['UMAE_AREA']?></h4>
                        <div style="position: relative;margin-top: 0px">
                            <a href="#" class="btn sigh-background-primary pull-right tip enf-obs-del-paciente" data-placement="bottom" data-original-title="" style="position: absolute;right: 105px;top: -36px">
                                <i class="fa fa-user-times i-24 color-white"></i>
                            </a>
                            <a href="#" class="btn sigh-background-primary pull-right tip cortaestancia-actualizarcamas" data-placement="bottom" data-original-title="Actualizar vista de camas" style="position: absolute;right: 50px;top: -36px">
                                <i class="fa fa-refresh i-24 color-white"></i>
                            </a>
                            <a  href="#" class="btn sigh-background-primary pull-right tip" data-placement="bottom" data-original-title="Indicadores" style="top:-36px;right: -10px;position: absolute">
                                <i class="fa fa-bar-chart-o i-24 color-white"></i>
                            </a>
                        </div>

                    </div>
                    <div class="grid-body">
                        <div class="" >
                            <style> .cols-camas :nth-child(3n){clear: left!important;}.color-white{color: white!important}</style>
                            <div class="row row-cols-camas"></div>
                            <input type="hidden" name="loadCamasEnfermeria" value="Si">
                        </div>
                    </div>    
                </div>
                
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Cortaestancia.js?time=<?= date('YmdHis')?>" type="text/javascript"></script>