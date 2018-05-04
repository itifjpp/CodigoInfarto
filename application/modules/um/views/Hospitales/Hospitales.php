<?php echo modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">LISTADO DE HOSPITALES</span>
                    <?php if(empty($Gestion)){?>
                    <a class="md-btn md-fab m-b red pull-left tip btn-add-hospital" data-id="0" data-nombre=""  data-direccion="" data-accion="add" href="#" style="position: absolute;right: 10px;top: 15px">
                        <i class="mdi-av-my-library-add i-24" ></i>
                    </a>
                    <?php }?>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <table class="footable table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NOMBRE DEL HOSPITAL</th>
                                        <th style="width: 40%">DIRECCIÓN</th>
                                        <th style="width: 18%">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td class="text-center"><?=$value['hospital_nombre']?></td>
                                        <td class="text-center"><?=$value['hospital_direccion']?></td>
                                        <td>
                                            <a href="<?= base_url()?>Um/Hospitales/Reportes?hos=<?=$value['hospital_id']?>">
                                                <i class="fa fa-medkit i-20 color-imss"></i>
                                            </a>&nbsp;
                                            <a href="<?= base_url()?>Um/Hospitales/Graficas?hos=<?=$value['hospital_id']?>">
                                                <i class="fa fa-bar-chart i-20 color-imss"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-pencil i-20 color-imss pointer btn-add-hospital" data-id="<?=$value['hospital_id']?>" data-nombre="<?=$value['hospital_nombre']?>"  data-direccion="<?=$value['hospital_direccion']?>" data-accion="edit"></i>
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
<?=modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Chart.js" type="text/javascript"></script>
<script src="<?=  base_url()?>assets/js/UmHospitales.js?<?= md5(microtime())?>"></script>


