<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top:-10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Calendarios</a></li>
        </ol>
        <div class="row m-t-5">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">CALENDARIOS</h4>
                        <?php if($this->UMAE_AREA=='Administrador'){?>
                        <a class="md-btn md-fab red btn-60 btn-add-mn1 pull-right" href="<?= base_url()?>Educacion/Calendario/Calendar?cal=0&action=add">
                            <i class="fa fa-calendar-plus-o color-white i-20" ></i>
                        </a>
                        <?php }?>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border">	
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 margin-top-10">
                                <table class="table table-bordered table-no-padding">
                                    <thead>
                                        <tr>
                                            <th>TÍTULO</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <tr>
                                            <td><?=$value['calendar_title']?></td>
                                            <td><?=$value['calendar_description']?></td>
                                            <td>
                                                <a href="<?= base_url()?>Educacion/Calendario/Events?calendar=<?=$value['calendar_id']?>">
                                                    <i class="fa fa-calendar-plus-o i-20 sigh-color tip" data-original-title="Nuevos Eventos"></i>
                                                </a>&nbsp;
                                                <?php if($this->UMAE_AREA=='Administrador'){?>
                                                <a href="<?= base_url()?>Educacion/Calendario/Calendar?cal=<?=$value['calendar_id']?>&action=edit">
                                                    <i class="fa fa-pencil sigh-color i-20"></i>
                                                </a>
                                                <?php }?>
                                            </td>
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

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Educacion.js?').md5(microtime())?>" type="text/javascript"></script>