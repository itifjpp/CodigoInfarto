<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white">INTERCONSULTAS ENVIADAS</h4>
                    </div>
                    <div class="grid-body">
                        <form action="<?= base_url()?>Sections/Documentos/InterconsultasEnviadas" method="GET">
                        <div class="row ">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border" >
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control dp-yyyy-mm-dd" required="" name="inputDateStart" value="<?=$_GET['inputDateStart']?>" placeholder="FECHA INICIO...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border" >
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" class="form-control dp-yyyy-mm-dd" required="" name="inputDateEnd" value="<?=$_GET['inputDateEnd']?>" placeholder="FECHA TERMINO...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-block sigh-background-secundary">BUSCAR</button>
                            </div>
                        </div>
                        </form>
                        <div class="row m-t-20">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#TriageIdFilter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">PACIENTE</th>
                                            <th style="width: 13%">ENVIO</th>
                                            <th style="width: 18%;">ÁREA QUE ENVIA</th>
                                            <th style="width: 18%;">ÁREA SOLICITADA</th>
                                            <th style="width: 12%">DIAGNOSTICO</th>
                                            <th style="width: 10%">ESTADO</th>
                                            <th style="width: 8%">ACCION</th>
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
                                            <td >
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
                                                <i class="fa fa-pencil-square-o sigh-color i-20"></i> VER DX...
                                            </td>
                                            <td><?=$value['doc_estatus']?></td>
                                            <td >
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
