<?= modules::run('Sections/Menu/index'); ?>  
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="col-md-12">
                <ol class="breadcrumb" style="margin-top:">
                    <li><a style="text-transform: uppercase" href="#">Mínima Invasión</a></li>
                </ol>
                <div class="card back-imss">
                    <div class="lt p text-center">
                        <h3 style="margin-top: 0px;margin-bottom: 0px">
                            MÍNIMA INVASIÓN
                        </h3>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <a href="<?= base_url()?>Abasto/MinimaInvacion/Categorias_Ins_Equi?name=instrumental">
                    <div class="card">
                        <div class="lt p text-center">
                            <h4>INSTRUMENTAL</h4>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4">
                <a href="<?= base_url()?>Abasto/MinimaInvacion/Categorias_Ins_Equi?name=equipamiento">
                    <div class="card">
                        <div class="lt p text-center">
                            <h4>EQUIPAMIENTO</h4>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4">
                <a href="<?= base_url()?>Abasto/Catalogos?name=insumos&vale=0&tratamiento_qx=0">
                    <div class="card">
                        <div class="lt p text-center">
                            <h4>INSUMOS</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>
