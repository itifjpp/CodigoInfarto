<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?= base_url()?>Educacion/Ua">Unidades Académicas</a></li>
            <li><a href="#">Carreras</a></li>
        </ol>
        <div class="row"> 
            <div class="col-md-6 m-t-10 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin semi-bold color-white text-uppercase">Carreras</h4>
                        <a href="#" onclick="AbrirVista(base_url+'Educacion/Ua/Carrera?a=add&carrera=0&ua=<?=$_GET['ua']?>',400,300)" class="md-btn md-fab m-b red pull-right tip ">
                            <i class="material-icons color-white i-24">library_add</i>
                        </a>
                    </div>
                    <div class="grid-body">                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-b">
                                    <span class="input-group-addon sigh-background-secundary no-border">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" id="ua_id" class="form-control" placeholder="BUSCAR CARRERA...">
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <table class="table table-hover table-bordered footable table-no-padding" data-page-size="10" data-filter="#ua_id" >
                                    <thead>
                                        <tr>
                                            <th style="width: 80%">CARRERA</th>
                                            <th style="width: 10%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($UaCarreras as $value) {?>
                                        <tr>
                                            <td><?=$value['carrera_nombre']?></td>
                                            <td>
                                                <a href="#" onclick="AbrirVista(base_url+'Educacion/Ua/Carrera?a=edit&carrera=<?=$value['carrera_id']?>&ua=<?=$_GET['ua']?>',400,300)">
                                                    <i class="fa fa-pencil sigh-color i-20"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-trash-o sigh-color i-20 pointer ua-carrera-eliminar" data-id="<?=$value['carrera_id']?>"></i>
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