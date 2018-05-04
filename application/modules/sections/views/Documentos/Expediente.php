<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <div class="row row-loading-expediente">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-spinner fa-pulse color-white fa-4x"></i><br>
                                <h5 class="color-white">OBTENIENDO INFORMACIÓN DEL PACIENTE, ESTO PUEDE TARDAR UN MOMENTO</h5>
                            </div>
                        </div>
                        <div class="row hide row-load-expediente"></div>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="total-eventos-medicos col-md-2">
                                        <h1 style="font-size: 70px;text-align: left;" class="">0</h1>
                                    </div>
                                    <div class="col-xs-9" style="padding-left: 0px;">
                                        <h4 style=";margin-top: 0px">EVENTOS DE ATENCIÓN MÉDICA</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon sigh-background-primary no-border">
                                                <i class="fa fa-folder-open i-20"></i>
                                            </span>
                                            <select class="width100" name="FoliosAsociados" data-folio="<?=$this->uri->segment(4)?>" data-tipo="<?=$_GET['tipo']?>">
                                                <option value="">N° DE FOLIOS ASOCIADOS AL N.S.S DE ESTE PACIENTE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php if($_GET['tipo']=='Choque' && empty($AvisoMp)){?>
                                        <button class="btn btn-danger pull-right btn-notificar-mp" data-folio="<?=$this->uri->segment(4)?>" data-tipo="<?=$_GET['tipo']?>"><i class="fa fa-shield" aria-hidden="true"></i> NOTIFICAR AL MP</button>
                                        <?php }?>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="btn-group pull-right ">
                                            <button class="btn sigh-background-primary dropdown-toggle"  <?=$info['ingreso_egreso_date']!=''?'disabled':''?> type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-stethoscope i-20 color-imss"></i> Aux Dx <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                 <?php if(isset($_GET['url'])){?>
                                                <li class="disabled">
                                                    <a href="#">NO PERMITIDO</a>
                                                </li>
                                                <?php }else{?>
                                                <li class="disabled">
                                                    <a href="#"><i class="fa fa-thermometer-full i-20 sigh-color"></i> Laboratorio</a>
                                                </li>
                                                <li>
                                                    <!--base_url()?>-->
                                                    <a href="<?= base_url()?>Rx/SolicitudesRx?folio=<?=$this->uri->segment(4)?>" target="_blank"><i class="material-icons i-20 sigh-color">contacts</i> Imagen</a>
                                                </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="btn-group pull-right">
                                            <button class="btn sigh-background-primary dropdown-toggle" <?=$info['ingreso_egreso_date']!=''?'disabled':''?> type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-clone i-20 color-imss"></i> Documentos <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if(isset($_GET['url'])){?>
                                                <li class="disabled">
                                                    <a href="#">NO PERMITIDO</a>
                                                </li>
                                                <?php }else{?>
                                                <?php if($_GET['tipo']=='Choque'){?>
                                                <li class="<?=$info['ingreso_date_medico']!='' ? 'disabled' :''?>">
                                                    <a <?php if($info['ingreso_date_medico']==''){?>href="<?= base_url()?>Sections/Documentos/HojaClasificacion/<?=$this->uri->segment(4)?>/?tipo=<?=$_GET['tipo']?>" target="_blank" <?php }?>>
                                                        <i class="fa fa-pencil-square-o sigh-color i-20"></i> Hoja de Clasificación
                                                    </a>
                                                </li>
                                                <?php }?>
                                                <?php if(!isset($_GET['via'])){?>
                                                <?php if($this->ConfigHojaInicialAbierta=='No'){?>
                                                <li class="<?=!empty($HojasFrontales)  ? 'disabled' :''?>">
                                                    <a <?php if(empty($HojasFrontales)){?>href="<?= base_url()?>Sections/Documentos/HojaFrontal?hf=0&a=add&folio=<?=$this->uri->segment(4)?>&tipo=<?=$_GET['tipo']?>&accion=Nuevo&temp=<?= date('YmdHis')?>&DxTipo=Hoja" target="_blank" <?php }?>>
                                                        <i class="material-icons sigh-color" style="font-size: 20px!important;vertical-align: -4%!important">note_add</i> Generar Hoja Inicial
                                                    </a>
                                                </li>
                                                <?php }else{?>
                                                <li class="<?=!empty($HojasFrontales)  ? 'disabled' :''?>">
                                                    <a <?php if(empty($HojasFrontales)){?>href="<?= base_url()?>Sections/Documentos/HojaInicialAbierto?hf=0&a=add&folio=<?=$this->uri->segment(4)?>&tipo=<?=$_GET['tipo']?>" target="_blank" <?php }?>>
                                                        <i class="material-icons sigh-color" style="font-size: 20px!important;vertical-align: -4%!important">note_add</i> Generar Hoja Inicial
                                                    </a>
                                                </li>
                                                <?php }?>

                                                <?php }?>
                                                <li class="">
                                                    <a href="<?= base_url()?>Sections/Documentos/Notas/0/?a=add&folio=<?=$this->uri->segment(4)?>&via=<?=$_GET['tipo']?>&doc_id=<?=$_GET['doc_id']?>&inputVia=<?=$_GET['tipo']?>&temp=N<?= date('YmdHis')?>&DxTipo=Notas" target="_blank">
                                                        <i class="material-icons sigh-color" style="font-size: 20px!important;vertical-align: -4%!important">note_add</i> Generar Nueva Nota Médica
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="<?= base_url()?>Sections/Documentos/HojaAltaHospitalaria/0/?a=add&folio=<?=$this->uri->segment(4)?>&via=<?=$_GET['tipo']?>&doc_id=<?=$_GET['doc_id']?>&inputVia=<?=$_GET['tipo']?>&temp=<?= rand().'_'.$this->uri->segment(4)?>" target="_blank">
                                                        <i class="material-icons sigh-color" style="font-size: 20px!important;vertical-align: -4%!important">note_add</i> Hoja de Alta Hospitalaria
                                                    </a>
                                                </li>
                                                <?php 
                                                if($_GET['tipo']=='Medicos'){
                                                $sqlPrealta=$this->config_mdl->sqlGetDataCondition('sigh_pisos_prealtas',array(
                                                    'ingreso_id'=>$this->uri->segment(4)
                                                ));  
                                                ?>
                                                <li class="<?= empty($sqlPrealta) ? 'medico-torres-prealta':'hide'?>" data-id="<?=$this->uri->segment(4)?>">
                                                    <a href="#">
                                                        <i class="fa fa-share-square-o sigh-color i-20"></i> Pre-Alta
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-top: 10px">
                                <style>th,td{padding-left: 5px!important;padding-right: 0px!important;}</style>
                                <table class="table table-bordered table-striped footable table-no-padding table-expediente-paciente" data-page-size="10" data-filter="#filterExpediente" data-limit-navigation="6">
                                    <thead>
                                        <tr>
                                            <th style="width: 16%;" data-sort-ignore="true">FECHA & HORA</th>
                                            <th style="width: 20%" data-sort-ignore="true">TIPO</th>
                                            <th style="width: 22%" data-sort-ignore="true">ÁREA</th>
                                            <th style="width: 27%" data-sort-ignore="true">MÉDICO</th>
                                            <th style="width: 13%" data-sort-ignore="true">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($info['ingreso_date_medico']!=''):?>
                                        <tr>
                                            <td>
                                                 <?=$info['ingreso_date_medico']?> <?=$info['ingreso_time_medico']?>
                                            </td>
                                            <td>Hoja de Clasificación</td>
                                            <td>Médico Triage</td>
                                            <td>
                                                <?php 
                                                $sqlMedicoClass=$this->config_mdl->sqlGetDataCondition('sigh_empleados',array(
                                                    'empleado_id'=>$info['ingreso_medico_id']
                                                ),'empleado_nombre, empleado_ap,empleado_am')[0];?>
                                                <?=$sqlMedicoClass['empleado_nombre']?> <?=$sqlMedicoClass['empleado_ap']?> <?=$sqlMedicoClass['empleado_am']?>
                                            </td>

                                            <td>
                                                <?php if($info['ingreso_clasificacion']!=''){?>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 pointer tip" data-original-title='Generar Hoja de Clasificación' onclick="AbrirVista(base_url+'Inicio/Documentos/Clasificacion/<?=$this->uri->segment(4)?>/?via=<?=$_GET['tipo']?>')"></i>
                                                <?php }else{?>
                                                No Aplica
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                        <?php foreach ($HojasFrontales as $value) {?>
                                        <tr>
                                            <td><?=$value['hf_fg']?> <?=$value['hf_hg']?></td>
                                            <td>Hoja Inicial(Hoja Frontal) & ST7</td>
                                            <td>
                                                <?php if($value['hf_via']=='Choque'){?>
                                                <span class="label red">MÉDICO CHOQUE</span>
                                                <?php }else{?>
                                                <?=$value['hf_via']?>
                                                <?php }?>
                                            </td>
                                            <td><?= Modules::run('Sections/Documentos/ExpedienteEmpleado',array('empleado_id'=>$value['empleado_id']))?></td>
                                            <td>
                                                <?php if($this->ConfigHojaInicialAbierta=='No'){?>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer" onclick="AbrirVista(base_url+'Inicio/Documentos/HojaFrontalCE/<?=$value['ingreso_id']?>')" data-original-title="Generar Hoja Frontal"></i>
                                                &nbsp;
                                                <?php }else{?>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer" onclick="AbrirVista(base_url+'Inicio/Documentos/HojaInicialAbierto/<?=$value['ingreso_id']?>')" data-original-title="Generar Hoja Frontal"></i>
                                                &nbsp;
                                                <?php }?>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer icon-st7 hide" onclick="AbrirVista(base_url+'Inicio/Documentos/ST7/<?=$value['ingreso_id']?>')" data-original-title="Generar ST7"></i>
                                                &nbsp;
                                                <?php if($_GET['via']!='paciente'){?>
                                                <?php if($value['empleado_id']==$_SESSION['UMAE_USER'] || $value['hf_via']=='Choque'){?>
                                                    <?php if($this->ConfigHojaInicialAbierta=='No'){?>
                                                        <a href="<?=  base_url()?>Sections/Documentos/HojaFrontal?hf=<?=$value['hf_id']?>&a=edit&folio=<?=$this->uri->segment(4)?>&tipo=<?=$_GET['tipo']?>&accion=Editar&temp=<?= $value['hf_temp']?>&DxTipo=Hoja" target="_blank">
                                                            <i class="fa fa-pencil sigh-color i-20 <?=$info['ingreso_egreso_date']!=''?'hide':''?>"></i>
                                                        </a>&nbsp;
                                                    <?php }else{?>
                                                        <a href="<?=  base_url()?>Sections/Documentos/HojaInicialAbierto?hf=<?=$value['hf_id']?>&a=edit&folio=<?=$this->uri->segment(4)?>&tipo=<?=$_GET['tipo']?>" target="_blank">
                                                            <i class="fa fa-pencil sigh-color i-20 <?=$info['ingreso_egreso_date']!=''?'hide':''?>"></i>
                                                        </a>&nbsp;
                                                    <?php }?>
                                                <?php }?>
                                                <i class="fa fa-trash-o sigh-color i-20 pointer hide" style="opacity: 0.4"></i>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <?php foreach ($HojasAltas as $value) { ?>
                                        <tr>
                                            <td><?=$value['ha_fecha']?> <?=$value['ha_hora']?></td>
                                            <td>
                                                Hoja de Alta Hospitalaria
                                            </td>
                                            <td><?=$value['ha_area']?></td>
                                            <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>

                                            <td>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer" onclick="AbrirVista(base_url+'Inicio/Documentos/GenerarHojaAltaHospitalaria/<?=$value['ha_id']?>?inputVia=<?=$_GET['tipo']?>')" data-original-title="Generar Hoja de Alta Hospitalaria"></i>
                                                &nbsp;
                                                <?php if($value['empleado_id']==$_SESSION['UMAE_USER']){?>
                                                <a href="<?= base_url()?>Sections/Documentos/HojaAltaHospitalaria/<?=$value['ha_id']?>/?a=edit&folio=<?=$this->uri->segment(4)?>&via=<?=$_GET['via']?>&doc_id=<?=$_GET['doc_id']?>&inputVia=<?=$_GET['tipo']?>&temp=0" target="_blank">
                                                    <i class="fa fa-pencil sigh-color i-20 <?=$info['ingreso_egreso_date']!=''?'hide':''?>"></i>
                                                </a>&nbsp;
                                                <i class="fa fa-trash-o hide sigh-color i-20 pointer icono-remove-notas hide" data-value="<?=$value['notas_id']?>"></i> 
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <?php 
                                        $sqlObsUrg=$this->config_mdl->sqlQuery("SELECT ingreso_id FROM sigh_observacion WHERE ingreso_id=".$this->uri->segment(4));
                                        if(!empty($sqlObsUrg)){
                                        ?><tr>
                                            <td>NO APLICA</td>
                                            <td>Consentimiento informado para el ingreso al área de Observacion-Urgencias</td>
                                            <td>NO APLICA</td>
                                            <td>NO APLICA</td>
                                            <td>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer" onclick="AbrirVista(base_url+'Inicio/Documentos/ConsentimientoInformadoIngresoObs/<?=$this->uri->segment(4)?>')" data-original-title="Generar Documento"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <?php 
                                            $sqlChoqueUrg=$this->config_mdl->sqlQuery("SELECT ingreso_id FROM sigh_choque WHERE ingreso_id=".$this->uri->segment(4));
                                            if(!empty($sqlChoqueUrg)){
                                        ?>
                                        <tr>
                                            <td>NO APLICA</td>

                                            <td>Consentimiento informado para el ingreso al área de Choque-Urgencias</td>
                                            <td>NO APLICA</td>
                                            <td>NO APLICA</td>
                                            <td>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer" onclick="AbrirVista(base_url+'Inicio/Documentos/ConsentimientoInformadoIngresoObs/<?=$this->uri->segment(4)?>')" data-original-title="Generar Documento"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <?php foreach ($AvisoMp as $AvisoMp) {?>
                                        <tr>
                                            <td><?=$AvisoMp['mp_fecha']?> <?=$AvisoMp['mp_hora']?></td>
                                            <td>Documento de Aviso al Ministerio Público</td>
                                            <td>NO APLICA</td>
                                            <td><?=$AvisoMp['empleado_nombre']?> <?=$AvisoMp['empleado_ap']?> <?=$AvisoMp['empleado_am']?></td>
                                            <td>
                                                <i class="fa fa-file-pdf-o sigh-color i-20 tip pointer" onclick="AbrirVista(base_url+'Inicio/Documentos/AvisarAlMinisterioPublico/<?=$this->uri->segment(4)?>')" data-original-title="Generar Documento"></i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr class="no-padding">
                                            <td colspan="5" class="text-center ">
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
<input type="hidden" name="inputExpediente" value="Si">
<input type="hidden" name="inputIngresoEgreso" value="<?=$info['ingreso_egreso_date']?>">
<input type="hidden" name="DocPasteImg" value="Si">
<input type="hidden" name="ServerNodeJs" value="Si">
<input type="hidden" name="ingreso_id" value="<?=$this->uri->segment(4)?>">
<input type="hidden" name="paciente_id">
<input type="hidden" name="viaExpediente" value="<?=$_GET['tipo']?>">
<input type="hidden" name="empleadoSession" value="<?=$this->UMAE_USER?>">
<input type="hidden" name="pacienteNss" value="">
<input type="hidden" name="pacienteNssAgregado" value="">
<?= Modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/sections/Documentos.js?time=<?= date('YmdHis')?>"></script>