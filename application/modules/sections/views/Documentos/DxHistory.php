<?= modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="grid simple ">
            <div class="grid-title sigh-background-secundary text-center" style="">
                <h4 class="color-white no-margin text-center">HISTORIAL DE DIAGNÓSTICOS</h4>
            </div>
            <div class="grid-body">
                <div class="card-body" style="padding: 0px">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-no-padding footable table-dx-pac-history " data-sorting="true" data-page-size="5">
                                <thead>
                                    <tr>
                                        <th style="width: 20%">FECHA & HORA</th>
                                        <th style="width: 15%" data-sort-ignore="false" >TIPO</th>
                                        <th style="width: 55%">DX</th>
                                        <th style="width: 10%" >DX CIE10</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Dxs as $value){
                                        $label='';
                                        if($value['dx_tipo']=='PRIMARIO'){
                                            $label='green';
                                        }if($value['dx_tipo']=='SECUNDARIO'){
                                            $label='blue';
                                        }if($value['dx_tipo']=='PRESUNTIVO'){
                                            $label='orange';
                                        }

                                    ?>
                                    <tr>
                                        <td><?=$value['dx_fecha']?> <?=$value['dx_hora']?></td>
                                        <td><span class="label <?=$label?>"><?=$value['dx_tipo']?></span></td>
                                        <td><?=$value['dx_dx']?></td>
                                        <td><?=$value['id10']?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td class="text-center" colspan="4">
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
<?= modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>
<script src="<?= base_url()?>assets/js/IdleTimer.js?<?= md5(microtime())?>" type="text/javascript"></script>
