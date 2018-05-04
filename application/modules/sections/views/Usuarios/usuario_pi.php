<?= Modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px;margin-left: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Usuarios">Usuarios</a></li>
            <li><a href="#">Agregar Información de caracter personal del usuario</a></li>
        </ol>
        <div class="row m-t-10">
            <?php if($userLocal['empleado_pi']=='SI'){?>
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase">Agregar Información de caracter personal a <b><?=$user['empleado_nombre']?> <?=$user['empleado_ap']?> <?=$user['empleado_ap']?></b></h4>
                        <a href="#"  class="md-btn md-fab m-b red pull-right btn-pi-add-anexo tip" data-original-title="Agregar anexos" data-id="<?=$_GET['emp']?>">
                            <i class="material-icons i-24 color-white">note_add</i>
                        </a>
                    </div>
                    <div class="grid-body">
                        <form class="form-add-users-ip">
                            <div class="form-group">
                                <textarea class="form-control" name="ip_descripcion" rows="25" placeholder="Agregar Información a detalle..."><?=$info['ip_descripcion']?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row row-anexos-pi"></div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="empelado_anexo_pi" value="Si">
                                <input type="hidden" name="empleado_id" value="<?=$_GET['emp']?>">
                                <button class="btn sigh-background-secundary pull-right m-t-15">GUARDAR INFORMACIÓN</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
            <?php }else{?>
            <div class="col-md-6 col-centered">
                <div class="alert alert-danger text-center">
                    <i class="material-icons m-t-10" style="font-size: 50px">lock</i>
                    <h5 class="line-height ">LO SENTIMOS NO TIENE PERMISOS PARA PODER VER ESTA INFORMACIÓN</h5>
                </div>
            </div>
            <?php }?> 
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Usuarios.js?'). md5(microtime())?>" type="text/javascript"></script> 
