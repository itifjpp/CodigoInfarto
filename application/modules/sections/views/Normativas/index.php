<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row m-t-10">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white">GESTIÓN DE NORMATIVAS</h4>
                        <a href="<?= base_url()?>Sections/Normativas/NuevaNormativa?norma=0&a=add" class="md-btn md-fab m-b red waves-effect pull-right">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered footable table-no-padding"  data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">TITULO</th>
                                            <th style="width: 20%">ESPECIALIDAD</th<>
                                            <th style="width: 15%">GRUPO ETARIO</th>
                                            <th style="width: 15%">CATEGORÍA</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value){?>
                                        <tr>                                       
                                            <td class="text-uppercase"><?=$value['normativa_titulo']?></td>
                                            <td class="text-uppercase"><?=$value['rol_nombre']?></td>
                                            <td class="text-uppercase"><?=$value['normativa_grupo_etario']?></td> 
                                            <td class="text-uppercase"><?=$value['normativa_categoria']?></td> 
                                            <td>

                                                <a href="<?= base_url()?>Sections/Normativas/NuevaNormativa?norma=<?=$value['normativa_id']?>&a=edit">
                                                    <i class="fa fa-pencil sigh-color-secundary i-20"></i>
                                                </a>
                                                &nbsp;
                                                <a onclick="AbrirDocumento(base_url+'assets/Normativas/<?=$value['normativa_file']?>')">
                                                    <i class="fa fa-share-square-o sigh-color-secundary i-20 pointer" ></i>
                                                </a>&nbsp;
                                                <i class="fa fa-trash-o sigh-color-secundary i-20 pointer delete-normativa" data-file="<?=$value['normativa_file']?>" data-id="<?=$value['normativa_id']?>"></i>
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
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/sections/Normativas.js?'). md5(microtime())?>" type="text/javascript"></script>