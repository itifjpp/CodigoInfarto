<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INTERCONSULTAS SOLICITADAS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="TriageIdFilter" placeholder="Buscar...">
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#TriageIdFilter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 25%;">PACIENTE</th>
                                            <th style="width: 16%">FECHA DE ENVÍO</th>
                                            <th style="width: 18%;">S. QUE ENVIA</th>
                                            <th style="width: 18%;">S. SOLICITADO</th>
                                            <th style="width: 10%">DIAGNOSTICO</th>
                                            <th style="width: 10%">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($Gestion as $value) {
                                        $Diff= Modules::run('Config/getTimeElapsed',array(
                                            'Time1'=>$value['doc_fecha'].' '.$value['doc_hora'],
                                            'Time2'=> date('Y-m-d H:i')
                                        ));
                                            
                                        ?>
                                        <tr id="<?=$value['ingreso_id']?>" >
                                            <td>
                                                <?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?>
                                            </td>
                                            <td >
                                                <?=$value['doc_fecha']?> <?=$value['doc_hora']?>
                                                <span class="label label-success"><?=$Diff->d?> Días <?=$Diff->h?> Hrs <?=$Diff->i?> Min</span>
                                            </td>
                                            <td >
                                                <?=$value['doc_servicio_envia']?><br>
                                                (<?=$value['doc_modulo']?>)
                                            </td>
                                            <td ><?=$value['doc_servicio_solicitado']?></td>
                                            <td  class="ver-texto pointer" data-content-title="DIAGNOSTICO" data-content-text="<?=$value['doc_diagnostico']?>">
                                                <i class="fa fa-pencil-square-o sigh-color i-20"></i> VEX DX...
                                            </td>
                                            <td >

                                                <?php if($value['doc_estatus']=='En Espera'){?>
                                                    <?php if($value['empleado_envia']!=$this->UMAE_USER){?>
                                                    <a href="<?=  base_url()?>Sections/Documentos/Notas/0/?a=add&TipoNota=Nota de Valoracion&folio=<?=$value['ingreso_id']?>&via=Interconsulta&doc_id=<?=$value['doc_id']?>" target="_blank">
                                                        <i class="fa fa-pencil-square-o i-20 sigh-color tip" data-original-title="Realizar Nota de Valoración"></i>
                                                    </a>&nbsp;
                                                    <?php }?>
                                                <?php }?>
                                                <a href="<?=  base_url()?>Sections/Documentos/Expediente/<?=$value['ingreso_id']?>/?tipo=Consultorios&url=Enfermeria" target="_blank">
                                                    <i class="fa fa-folder-open-o i-20 sigh-color tip" data-original-title="EXPEDIENTE DEL PACIENTE"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url('assets/js/Consultorios.js?'). md5(microtime())?>" type="text/javascript"></script>