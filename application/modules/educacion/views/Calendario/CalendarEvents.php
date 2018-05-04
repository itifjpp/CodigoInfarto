<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top:-10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Educacion/Calendario">Calendario</a></li>
            <li><a href="#">Eventos</a></li>
        </ol>
        <div class="row m-t-5">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">EVENTOS PUBLICADOS EN ESTE CALENDARIO</h4>
                        <a class="md-btn md-fab red btn-60 btn-add-mn1 pull-right" href="<?= base_url()?>Educacion/Calendario/Event?cal=<?=$_GET['calendar']?>&event=0&a=add">
                            <i class="fa fa-calendar-plus-o color-white i-20" ></i>
                        </a>
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
                                <table class="table table-bordered table-no-padding width100">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">TÍTULO</th>
                                            <th style="width: 20%">LUGAR</th>
                                            <th style="width: 12%">INICIO</th>
                                            <th style="width: 12%">TERMINO</th>
                                            <th style="width: 5%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Eventos as $value) {?>
                                        <tr>
                                            <td><?=$value['event_title']?></td>
                                            <td><?=$value['event_location']?></td>
                                            <td><?=$value['event_start_date']?> <?=$value['event_start_time']?></td>
                                            <td><?=$value['event_end_date']?> <?=$value['event_end_time']?></td>
                                            <td class="text-center">
                                                <i class="fa fa-trash-o i-20 sigh-color pointer event-google-delete" data-id="<?=$value['event_id']?>"></i>
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