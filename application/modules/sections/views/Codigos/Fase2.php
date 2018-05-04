<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <ol class="breadcrumb" style="margin-top: 0px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Codigos">Codigos</a></li>
            <li><a href="<?=  base_url()?>Sections/Codigos/Fase1?ci=<?=$_GET['ci']?>">Fase 1</a></li>
            <li><a href="#">Fase 2</a></li>
        </ol>
        <div class="box-inner col-md-8 col-centered" style="margin-top: 45px">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">CODIGOS FASE 2</span>
                    <a href="#" onclick="AbrirVista(base_url+'Sections/Codigos/AgregarFase2?f1=<?=$_GET['f1']?>&f2=0&a=add',400,400)" class="md-btn md-fab m-b red waves-effect pull-right">
                        <i class="mdi-av-queue i-24"></i>
                    </a>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th style="width: 30%">FASE 1</th>
                                        <th style="width: 40%">FASE 2</th>
                                        <th style="width: 20%">TIEMPO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value){?>
                                    <tr>                                       
                                        <td class="text-uppercase"><?=$value['ci_f1_fase']?></td>
                                        <td class="text-uppercase"><?=$value['ci_f2_fase']?></td>
                                        <td class="text-uppercase"><?=$value['ci_f2_tiempo']?></td> 
                                        <td>
                                            <a href="<?= base_url()?>Sections/Codigos/Fase3?ci=<?=$_GET['ci']?>&f1=<?=$value['ci_f1_id']?>&f2=<?=$value['ci_f2_id']?>">
                                                <i class="fa fa-share-square-o color-imss i-20 tip" data-original-title="Agregar Fases"></i>
                                            </a>&nbsp;
                                            <a onclick="AbrirVista(base_url+'Sections/Codigos/AgregarFase2?f1=<?=$value['ci_f1_id']?>&f2=<?=$value['ci_f2_id']?>&a=edit',400,400)">
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