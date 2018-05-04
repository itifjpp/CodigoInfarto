<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-9 col-centered">
            <div class="panel panel-default " style="margin-top: 10px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">Tratamientos Quirúrgicos</span>
                    
                    <div class="card-tools" style="margin-top: 10px">
                        <ul class="list-inline">
                            <li class="dropdown">
                                <a md-ink-ripple data-toggle="dropdown" class="md-btn md-fab red md-btn-circle tip btn-add-tratamiento-quirurgico" data-triage-id="<?=$this->uri->segment(4)?>">
                                    <i class="mdi-av-my-library-add i-24 " ></i>
                                </a>
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
                                        <th>FECHA & HORA</th>
                                        <th>TRATAMIENTO QUIRÚRGICO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tratamientos as $value) {?>
                                    <tr>
                                        <td><?=$value['tratamiento_fecha']?> <?=$value['tratamiento_hora']?></td>
                                        <td><?=$value['tratamiento_nombre']?></td>
                                        <td>
                                            <i class="fa fa-pencil i-20 color-imss icono-editar-tratamiento pointer" data-triage_id="<?=$this->uri->segment(4)?>" data-tratamiento_id="<?=$value['tratamiento_id']?>" data-tratamiento_nombre="<?=$value['tratamiento_nombre']?>"></i>&nbsp;
                                            <a href="<?= base_url()?>Sections/Documentos/DocumentosTratamientoQuirurgico/<?=$value['tratamiento_id']?>/?folio=<?=$this->uri->segment(4)?>">
                                                <i class="mdi-av-my-library-add i-20 color-imss" data-original-title="Solicitar Documentos"></i>
                                            </a>
                                            &nbsp;
                                            <?php if($value['tratamiento_vale_servicio']!='Finalizado'){?>
                                            <a href="<?= base_url()?>Abasto/ValeOsteosintesis?tratamiento=<?=$value['tratamiento_id']?>&folio=<?=$this->uri->segment(4)?>&show=Sistemas">
                                                <i class="fa fa-id-card-o i-20 color-imss tip" data-original-title="Vales de Osteosintesis"></i>
                                            </a>
                                            <?php }else{?>
                                            <i class="mdi-content-content-paste i-24 color-imss pointer tip" data-original-title="Ver Solicitud de Vale de Servicio"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/sections/TratamientoQuirurgico.js')?>" type="text/javascript"></script>