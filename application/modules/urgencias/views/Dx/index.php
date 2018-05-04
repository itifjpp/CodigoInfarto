<?php echo modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-centered">
                <div class="grid simple ">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">LOS 10 DX CIE10 MAS FRECUENTES</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <form action="<?= base_url()?>Urgencias/DxCIE10">
                                <div class="col-md-4">
                                    <input type="text" class="form-control dp-yyyy-mm-dd" name="dxDateStart" value="<?= isset($_GET['dxDateStart']) ? $_GET['dxDateStart']: date('Y-m-d') ?>" placeholder="FECHA INICIO">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control dp-yyyy-mm-dd" name="dxDateEnd" value="<?= isset($_GET['dxDateEnd']) ? $_GET['dxDateEnd']: date('Y-m-d') ?>" placeholder="FECHA FIN">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-block sigh-background-secundary">BUSCAR</button>
                                </div>
                            </form>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding footable" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th>CODIGO CIE10</th>
                                            <th>DX CIE10</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['id10']?></td>
                                            <td><?=$value['dec10']?></td>
                                            <td><?=$value['Total']?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>  
        </div>
    </div>
</div>
<?=modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js?<?= md5(microtime())?>"></script>


