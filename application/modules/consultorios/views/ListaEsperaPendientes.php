<?= modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="no-margin color-white text-uppercase semi-bold width100">LISTA DE ESPERA DE PACIENTES EN CONSULTORIOS</h4>
                        <button class="btn sigh-background-primary tip btn-ce-lista-espera-alta-all" data-placement="left" data-original-title="Dar de alta a todos los pacientes de la lista de espera" style="position: absolute;top: 7px;right: 30px">
                            <i class="fa fa-share-square-o color-white i-20 " ></i>
                        </button>
                    </div>
                    <div class="grid-body">
                        <div class="row hide">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon no-border sigh-background-secundary" >
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filter" placeholder="BUSCAR...">
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-5">
                                <div class="alert alert-info pull-right">
                                    <h4 class="no-margin">
                                        <b><?= count($Gestion)?></b> Pacientes En Lista de Espera&nbsp;&nbsp;&nbsp; <i class="material-icons i-24 sigh-color pointer" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/ListaEsperaConsultorios?tipo=Pendientes','Lista de Espera')">picture_as_pdf</i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8"></div>
                            <div class="col-xs-4" >
                                <div class="row">
                                    <?php
                                    $sqlContadorLe=$this->config_mdl->sqlGetData('sigh_consultorios_le_llamados');
                                    
                                    ?>
                                   <div class="col-xs-3 " style="margin-left: 0px;margin-right: 0px;padding-right: 0px">
                                        <div class="grid simple">
                                            <div class="grid-body sigh-background-primary" style="padding: 10px!important">
                                                <h2 class="no-margin text-white bold text-center"><?= count($Gestion)?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3" style="margin-left: -5px;margin-right: 0px;padding-right: 0px">
                                        <div class="grid simple">
                                            <div class="grid-body bg-yellow" style="padding: 10px!important">
                                                <h2 class="no-margin text-white bold text-center h2-total-amarillo"><?=$sqlContadorLe[0]['llamado_espera_amarillo']?>/<?=$sqlContadorLe[1]['llamado_espera_amarillo']?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3" style="margin-left: -5px;margin-right: 0px;padding-right: 0px">
                                        <div class="grid simple ">
                                            <div class="grid-body bg-green" style="padding: 10px!important">
                                                <h2 class="no-margin text-white bold text-center h2-total-verde"><?=$sqlContadorLe[0]['llamado_espera_verde']?>/<?=$sqlContadorLe[1]['llamado_espera_verde']?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3" style="margin-left: 10px;margin-right: 0px;padding-left: 0px">
                                        <div class="grid simple">
                                            <div class="grid-body bg-blue" style="padding: 10px!important">
                                                <h2 class="no-margin text-white bold text-center h2-total-azul"><?=$sqlContadorLe[0]['llamado_espera_azul']?>/<?=$sqlContadorLe[1]['llamado_espera_azul']?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $sqlServicios=$this->config_mdl->sqlGetDataCondition('sigh_especialidades',array(
                                'especialidad_consultorios'=>'Si'
                            ));
                            $OportunidadAtencion=0;
                            foreach ($sqlServicios as $servicio) {
                                $Total=$this->config_mdl->sqlQuery("SELECT COUNT(servicios.especialidad_id) AS total
                                                                    FROM sigh_consultorios_lista_espera AS lista, sigh_pacientes AS pac, sigh_pacientes_ingresos AS ing,  
                                                                    sigh_especialidades AS servicios
                                                                    WHERE
                                                                    servicios.especialidad_id=ing.ingreso_consultorio AND
                                                                    lista.lista_espera_estatus='' AND 
                                                                    lista.lista_espera_date_envio!='' AND
                                                                    ing.paciente_id=pac.paciente_id AND 
                                                                    ing.ingreso_id=lista.ingreso_id AND 
                                                                    lista.lista_espera_estado IN('Ausente','En Espera') AND
                                                                    servicios.especialidad_nombre='".$servicio['especialidad_nombre']."'");
                                $OportunidadAtencion=$Total[0]['total']*count($Gestion);
                                if($OportunidadAtencion>=90){
                                    $OportunidadAtencionColor='bg-red';
                                }if($OportunidadAtencion>=70 && $OportunidadAtencion<=90){
                                    $OportunidadAtencionColor='bg-yellow';
                                }if($OportunidadAtencion<70){
                                    $OportunidadAtencionColor='bg-green';
                                }
                            ?>
                            <div class="<?= count($sqlServicios)<=3 ? 'col-xs-4':'col-xs-4'?>">
                                <div class="alert alert-info" style="padding-top: 3px;padding-bottom: 3px">
                                    <div class="row" style="margin-right: -20px!important">
                                        <div class="col-xs-2">
                                            <div class="row">
                                                <div class="col-xs-12 no-padding">
                                                    <h1 class="no-margin semi-bold text-center text-nowrap" style="height: 40px!important"><?=$Total[0]['total']?></h1>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xs-10">
                                            <div class="row">
                                                <div class="col-xs-12" style="padding-left: 3px;padding-top: 5px">
                                                    <h4 class="no-margin text-nowrap bold"><?=$servicio['especialidad_nombre']?></h4>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div style="height: 5px"></div>
                                                </div>
                                                <div class="col-xs-12 <?=$OportunidadAtencionColor?>" style="">
                                                    <h6 class="line-height m-t-5 m-b-5 text-left text-nowrap color-white" style="height: 12px!important;font-size: 10px"><?=$OportunidadAtencion?>% OPORTUNIDAD DE ATENCIÓN MÉDICA</h6>
                                                </div> 
                                                <div class="col-xs-12">
                                                    <div style="height: 10px"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="row m-t-10">
                            <?php 
                            $Min_Rojo;
                            $Max_Rojo;
                            $Min_Naranja;
                            $Max_Naranja;
                            $Min_Amarillo;
                            $Max_Amarillo;
                            $Min_Verde;
                            $Max_Verde;
                            $Min_Azul;
                            $Max_Azul;
                            $TotalAmarillo=0;
                            $TotalVerde=0;
                            $TotalAzul=0;
                            $sqlClasificacion=$this->config_mdl->sqlGetData('sigh_clasificacion_settings');
                            foreach ($sqlClasificacion as $class) {
                                if($class['clasificacion_color']=='Rojo'){
                                    $Min_Rojo=$class['clasificacion_min'];
                                    $Max_Rojo=$class['clasificacion_max'];
                                }if($class['clasificacion_color']=='Naranja'){
                                    $Min_Naranja=$class['clasificacion_min'];
                                    $Max_Naranja=$class['clasificacion_max'];
                                }if($class['clasificacion_color']=='Amarillo'){
                                    $Min_Amarillo=$class['clasificacion_min'];
                                    $Max_Amarillo=$class['clasificacion_max'];
                                }if($class['clasificacion_color']=='Verde'){
                                    $Min_Verde=$class['clasificacion_min'];
                                    $Max_Verde=$class['clasificacion_max'];
                                }if($class['clasificacion_color']=='Azul'){
                                    
                                    $Min_Azul=$class['clasificacion_min'];
                                    $Max_Azul=$class['clasificacion_max'];
                                }
                            }
                            
                            ?>
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover footable table-no-padding" data-filter="#filter" data-limit-navigation="7"data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th style="width: 12%">N° DE FOLIO</th>
                                            <th style="width: 25%;">PACIENTE</th>
                                            <th style="width: 8%" data-hide="phone">SEXO</th>
                                            <th style="width: 10%">CLASIFICACIÓN</th>
                                            <th style="width: 22%">DESTINO</th>
                                            <th style="width: 12%">T. TRANSC.</th>
                                            
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {?>
                                        <?php 
                                        if($value['lista_espera_date_envio']!=''){
                                            $Diff= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                'Tiempo1'=>$value['lista_espera_date_envio'].' '.$value['lista_espera_time_envio'],
                                                'Tiempo2'=> date('Y-m-d H:i')
                                            )); 
                                            $tt=(($Diff->d*24)*60)+($Diff->h*60)+$Diff->i;
                                            if($value['ingreso_clasificacion']=='Rojo'){
                                                if($tt<=$Max_Rojo){
                                                    $label_max_min='bg-blue color-white';
                                                }else{
                                                    $label_max_min='bg-red color-white';
                                                }
                                            }if($value['ingreso_clasificacion']=='Naranja'){
                                                if($tt<=$Max_Naranja){
                                                    $label_max_min='bg-blue color-white';
                                                }else{
                                                    $label_max_min='bg-red color-white';
                                                }
                                            }if($value['ingreso_clasificacion']=='Amarillo'){
                                                
                                                $TotalAmarillo++;
                                                if($tt<=$Max_Amarillo){
                                                    $label_max_min='bg-blue color-white';
                                                }else{
                                                    $label_max_min='bg-red color-white';
                                                }
                                            }if($value['ingreso_clasificacion']=='Verde'){
                                                $TotalVerde++;
                                                if($tt<=$Max_Verde){
                                                    $label_max_min='bg-blue color-white';
                                                }else{
                                                    $label_max_min='bg-red color-white';
                                                }
                                            }if($value['ingreso_clasificacion']=='Azul'){
                                                $TotalAzul++;
                                                if($tt<=$Max_Azul){
                                                    $label_max_min='bg-blue color-white';
                                                }else{
                                                    $label_max_min='bg-red color-white';
                                                }
                                            }
                                        }
                                        if($tt>=720){
                                            $this->config_mdl->sqlUpdate('sigh_consultorios_lista_espera',array(
                                                'lista_espera_estatus'=>'hidden'
                                            ),array(
                                                'lista_espera_id'=>$value['lista_espera_id']
                                            ));
                                        }
                                        ?>
                                        <tr id="<?=$value['ingreso_id']?>" >
                                            <td><?=$value['ingreso_id']?></td>
                                            <td style="font-size: 12px">
                                                <?=$value['paciente_nombre']?> <?=$value['paciente_ap']?> <?=$value['paciente_am']?>
                                                <?php 
                                                $sqlListaEspera=$this->config_mdl->sqlGetDataCondition('sigh_consultorios_lista_espera',array(
                                                    'ingreso_id'=>$value['ingreso_id']
                                                ));
                                                if(!empty($sqlListaEspera)){
                                                ?>
                                                <div style="position: relative">
                                                    <span class="label label-success tip pointer history-aventos-llamada" data-id="<?=$value['ingreso_id']?>" style="position: absolute;top: -28px;right: -10px" data-original-title="<?=$sqlListaEspera[0]['lista_espera_eventos']?> Eventos"><?=$sqlListaEspera[0]['lista_espera_eventos']?></span>
                                                </div>
                                                <?php }?>
                                            </td>
                                            
                                            <td><?=$value['paciente_sexo']?></td>
                                            <td><?=$value['ingreso_clasificacion']?></td>
                                            <td >
                                                <?=$value['ingreso_consultorio_nombre']?>
                                            </td>
                                            <td >
                                                <span class="label <?=$label_max_min?>" ><?=$tt?> Min.</span>
                                            </td>
                                            
                                            <td >
                                                <i class="fa fa-sign-out sigh-color i-20 pointer tip lista-espera-alta" data-id="<?=$value['lista_espera_id']?>" data-original-title="Alta al paciente por ausencia"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">
                                                <h6 class="no-margin"><span class="semi-bold">INGRESO ENFERMERÍA:</span><?=$value['ingreso_date_enfermera']?> <?=$value['ingreso_time_enfermera']?>  <span class="semi-bold">MÉDICO TRIAGE:</span> <?=$value['ingreso_time_medico']?> <span class="semi-bold"> Tiempo Espera:</span> <?=$Diff->h?> Hrs <?=$Diff->i?> Min </h6>
                                            </td>
                                        </tr>
                                        <?php //} ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot class="hide-if-no-paging">
                                    <tr>
                                        <td colspan="8" class="text-center">
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
<script src="<?= base_url()?>assets/js/Consultorios.js?<?= date('YmdHis')?>" type="text/javascript"></script>
<script>
$(document).ready(function(evt) {
    //$('.h2-total-amarillo').html('<?=$TotalAmarillo?>');
    //$('.h2-total-verde').html('<?=$TotalVerde?>');
    //$('.h2-total-azul').html('<?=$TotalAzul?>');
})
</script>