<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-8 col-centered" style="margin-top: 10px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">CODIGOS</span>
                    <a href="#" onclick="AbrirVista(base_url+'Sections/Codigos/Agregar?ci=0&a=add',400,400)" class="md-btn md-fab m-b red waves-effect pull-right">
                        <i class="mdi-av-queue i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">N°</th>
                                        <th style="width: 40%">CODIGO</th>
                                        <th style="width: 20%">COLOR</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value){?>
                                    <tr>                                       
                                        <td class="text-uppercase"><?=$value['ci_id']?></td>
                                        <td class="text-uppercase"><?=$value['ci_codigo']?></td>
                                        <td class="text-uppercase"><?=$value['ci_color']?></td> 
                                        <td>
                                            <a href="<?= base_url()?>Sections/Codigos/Fase1?ci=<?=$value['ci_id']?>">
                                                <i class="fa fa-share-square-o color-imss i-20 tip" data-original-title="Agregar Fases"></i>
                                            </a>&nbsp;
                                            <a onclick="AbrirVista(base_url+'Sections/Codigos/Agregar?ci=<?=$value['ci_id']?>&a=edit',400,400)">
                                                <i class="fa fa-pencil color-imss i-20 pointer" ></i>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <ul class="pagination"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/Codigos.js?'). md5(microtime())?>" type="text/javascript"></script>