<?= modules::run('Sections/Menu/index'); ?>
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered " style="margin-top: 10px">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading p teal-900 back-imss">
                        <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">LISTA DE FAMILIARES PARA LOS PASES DE VISITAS</span>
                        <a class="md-btn md-fab m-b red pull-right tip hide" style="right: 0px;position: absolute" >
                            <i class="mdi-social-group-add i-24" ></i>
                        </a>
                        <div class="card-tools" style="margin-top: 10px">
                            <ul class="list-inline">
                                <li class="dropdown">
                                    <a md-ink-ripple data-toggle="dropdown" class="md-btn md-fab red md-btn-circle tip btn-add-tratamiento-quirurgico" data-triage-id="<?=$this->uri->segment(4)?>">
                                        <i class="mdi-navigation-more-vert i-24 " ></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                        <?php if($PaseVisita['pv_tipo_solicitud']=='Solicitar Pase de 24 Horas'){?>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-id-card-o i-20 color-imss"></i> Solicitar Pase Normal
                                            </a>
                                        </li>
                                        <?php }else{?>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-id-card-o i-20 color-imss"></i> Solicitar Pase de 24 Horas
                                            </a>
                                        </li>
                                        <?php }?>
                                        <li><a href="#" onclick="AbrirVista(base_url+'AdmisionHospitalaria/AgregarFamiliar?folio=<?=$_GET['folio']?>&accion=add&familiar=0&tipo=<?=$_GET['tipo']?>',400,300)" ><i class="mdi-social-group-add i-20 color-imss"></i> Agregar Familiar</a></li>
                                        <li><a href="#" onclick="AbrirVista(base_url+'AdmisionHospitalaria/ValidarPasedeVisita?folio=<?=$_GET['folio']?>&tipo=<?=$_GET['tipo']?>',450,400)"><i class="fa fa-pencil-square-o i-20 color-imss"></i> Validar Pase de Visita</a></li>
                                        <li><a href="#" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/PaseDeVisita/<?=$_GET['folio']?>?tipo=<?=$_GET['tipo']?>')"><i class="mdi-action-print i-20 color-imss"></i> Imprimir Pase de Visita</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="row">
                            <div class="col-md-12" style="margin-top: -5px;margin-bottom: 10px">
                                <h5 class="text-uppercase"><b>TIPO DE PASE SOLICITADO:</b> <?=$PaseVisita['pv_tipo_solicitud']?></h5>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-no-padding footable"  data-filter="#filter" data-page-size="15">
                                    <thead>
                                        <tr>
                                            <th colspan="2">NOMBRE</th>
                                            <th>PERENTESCO</th>
                                            <th>REGISTRO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                        <tr id="<?=$value['familiar_id']?>" >
                                            <td style="padding: 0px!important">
                                                <?php if($value['familiar_perfil']!=''){?>
                                                <img src="<?= base_url()?>assets/img/familiares/<?=$value['familiar_perfil']?>?<?=md5(microtime())?>" onclick="ViewImage($(this).attr('src'),'small')" class="pointer" style="width: 46px;height: 40px;margin-right: -4px;">
                                                <?php }else{?>
                                                
                                                <?php }?>
                                                
                                            </td>
                                            <td>
                                                <?=$value['familiar_nombre']?> <?=$value['familiar_nombre_ap']?> <?=$value['familiar_nombre_am']?>
                                            </td>
                                            <td><?=$value['familiar_parentesco']?></td>
                                            <td><?=$value['familiar_registro']?></td>
                                            <td>
                                                <i class="fa fa-pencil icono-accion pointer" onclick="AbrirVista(base_url+'AdmisionHospitalaria/AgregarFamiliar?folio=<?=$_GET['folio']?>&accion=edit&familiar=<?=$value['familiar_id']?>&tipo=<?=$_GET['tipo']?>',400,300)"></i>
                                                <i class="fa fa-image pointer icono-accion" onclick="AbrirVista(base_url+'AdmisionHospitalaria/AgregarFamiliarFoto?familiar=<?=$value['familiar_id']?>&triage_id=<?=$value['triage_id']?>',700,500)"></i>&nbsp;
                                                <i class="fa fa-trash-o icono-accion pointer pases-eliminar-familiar" data-id="<?=$value['familiar_id']?>"></i>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="7" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AdmisionHospitalaria.js?'). md5(microtime())?>" type="text/javascript"></script>