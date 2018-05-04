<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-9 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Documentos para Tratamiento Quirurgico</span>
                    
                    <div class="card-tools" style="margin-top: 10px">
                        <ul class="list-inline">
                            <li class="dropdown">
                                <a md-ink-ripple data-toggle="dropdown" class="md-btn md-fab red md-btn-circle tip" data-original-title="Solicitar Documentos" data-placement="bottom">
                                    <i class="mdi-navigation-more-vert i-24 " ></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">
                                    
                                    <li class="<?=!empty($st) ? 'disabled' :''?>">
                                        <a <?php if(empty($st)){?>href="<?= base_url()?>Sections/Documentos/SolicitudTransfusion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank" <?php }?>>Solicitud de Transfución</a>
                                    </li>
                                    <li class="<?=!empty($cs) ? 'disabled' :''?>">
                                        <a <?php if(empty($cs)){?> href="<?= base_url()?>Sections/Documentos/CirugiaSegura/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank" <?php }?>>Cirugía Segura</a>
                                    </li>
                                    <li class="<?=!empty($si) ? 'disabled' :''?>">
                                        <a <?php if(empty($si)){ ?>href="<?= base_url()?>Sections/Documentos/SolicitudeIntervencion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank" <?php }?>>Solicitud Intervención</a>
                                    </li>
                                    <li class="<?=!empty($cci) ? 'disabled' :''?>">
                                        <a <?php if(empty($cci)){ ?>href="<?= base_url()?>Sections/Documentos/ConsentimientoInformado/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank" <?php }?>>Consentimiento Informado</a>
                                    </li>
                                    <li class="<?=!empty($isq) ? 'disabled' :''?>">
                                        <a <?php if(empty($isq)){ ?>href="<?= base_url()?>Sections/Documentos/ListaVerificacionISQ/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank" <?php }?>>Lista de Verificación Para Prevenir ISQ</a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url()?>Abasto/Catalogos/Sistemas?name=insumos&vale=<?= $_GET['vale']?>&tratamiento_qx=<?=$_GET['tratamiento_qx']?>" target="_blank">
                                            <i class="fa fa-address-card-o icono-accion"></i> Vale Osteosintesis
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 0px">
                            <table class="table table-bordered table-hover footable"  data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th data-sort-ignore="true">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($st as $value) {?>
                                    <tr>
                                        <td>Solicitud al Servicio de Transfusión</td>
                                        <td>
                                            <a href="<?= base_url()?>Sections/Documentos/SolicitudTransfusion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-file-pdf-o icono-accion pointer tip" data-original-title='Generar Solicitud al Servicio' onclick="AbrirDocumento(base_url+'Inicio/Documentos/SolicitudServicioTransfusion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>')"></i>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php foreach ($cs as $value) {?>
                                    <tr>
                                        <td>Cirugía Segura</td>
                                        <td>
                                            <a href="<?= base_url()?>Sections/Documentos/CirugiaSegura/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-file-pdf-o icono-accion pointer tip" data-original-title='Cirugía Segura' onclick="AbrirDocumento(base_url+'Inicio/Documentos/SolicitudServicioTransfusion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>')"></i>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php foreach ($si as $value) {?>
                                    <tr>
                                        <td>Solicitud de Intervención Quirúrgica</td>
                                        <td>
                                            <a href="<?= base_url()?>Sections/Documentos/SolicitudeIntervencion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-file-pdf-o icono-accion pointer tip" data-original-title='Solicitud de Intervención Quirúrgica' onclick="AbrirDocumento(base_url+'Inicio/Documentos/SolicitudServicioTransfusion/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>')"></i>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php foreach ($cci as $value) {?>
                                    <tr>
                                        <td>Carta de Consentimiento Informado</td>
                                        <td>
                                            <a href="<?= base_url()?>Sections/Documentos/ConsentimientoInformado/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-file-pdf-o icono-accion pointer tip" data-original-title='Carta de Consentimiento Informado' onclick="AbrirDocumento(base_url+'Inicio/Documentos/CartaConsentimientoInformado/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>')"></i>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php foreach ($isq as $value) {?>
                                    <tr>
                                        <td>Lista de Verificación Para Prevenir ISQ</td>
                                        <td>
                                            <a href="<?= base_url()?>Sections/Documentos/ListaVerificacionISQ/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>" target="_blank">
                                                <i class="fa fa-pencil icono-accion"></i>
                                            </a>&nbsp;
                                            <i class="fa fa-file-pdf-o icono-accion pointer tip" data-original-title='Lista de Verificación Para Prevenir ISQ' onclick="AbrirDocumento(base_url+'Inicio/Documentos/ISQ/<?=$this->uri->segment(4)?>/?folio=<?=$_GET['folio']?>')"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/os/observacion.js')?>" type="text/javascript"></script>