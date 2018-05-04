<?= Modules::run('Sections/Menu/loadHeader'); ?> 
<div class="page-content">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin">GESTIÓN DE CAMAS</h4>
                        <?php if($_GET['tipo']=='Ocupados'){?>
                        <a onclick="AbrirDocumento(base_url+'Inicio/Documentos/CamasOcupadas?area=<?=$_GET['area']?>&tipo=<?=$_GET['tipo']?>')" href="#"  md-ink-ripple="" class="md-btn md-fab m-b green waves-effect pull-right tip " data-original-title="Indicadores">
                            <i class="fa fa-file-pdf-o i-24"></i>
                        </a>
                        <?php }?>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding footable"  data-filter="#Filtro_Camas" data-page-size="40" data-limit-navigation="7">
                                    <thead>
                                        <tr>
                                            <th>ÁREA</th>
                                            <th>CAMA</th>
                                            <th style="width: 20%;">PACIENTE</th>
                                            <th>INGRESO</th>
                                            <th>TIEMPO EN CAMA</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Gestion as $value) {
                                        if($_GET['tipo']=='Ocupados'){
                                            $Tiempo=Modules::run('Config/CalcularTiempoTranscurrido',array(
                                                    'Tiempo1'=> date('d-m-Y').' '. date('H:i'),
                                                    'Tiempo2'=> str_replace('/', '-', $value['cama_ingreso_f'].' '.$value['cama_ingreso_h']),

                                            ));
                                            if($Tiempo->d==0 && $Tiempo->h>=12 && $Tiempo->h<18 ){
                                                $class="color-amarillo";
                                            }else if($Tiempo->d==0 && $Tiempo->h>=18 ){
                                                $class="color-naranja";
                                            }else if($Tiempo->d>0 ){
                                                $class="red";
                                            }else{
                                                $class='';
                                            }
                                        }else{
                                            $class='';
                                        }
                                        ?>
                                        <tr class="<?=$class?>">
                                            <td class="text-uppercase"><?=$value['area_nombre']?></td>
                                            <td class="text-uppercase"><?=$value['cama_nombre']?></td>
                                            <td class="text-uppercase">
                                                <?php if($_GET['tipo']=='Ocupados'){?>
                                                <?php 
                                                $sqlPaciente=$this->config_mdl->sqlQuery("SELECT pac.paciente_nombre, pac.paciente_ap, pac.paciente_am FROM sigh_pacientes_ingresos AS ing , sigh_pacientes AS pac
                                                                pac.paciente_id=ing.paciente_id AND  ing.ingreso_id=".$value['cama_dh'])[0];
                                                ?>
                                                <?=$sqlPaciente['paciente_nombre']?> <?=$sqlPaciente['paciente_ap']?> <?=$sqlPaciente['paciente_am']?>
                                                <?php }else{?>
                                                No Aplica
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if($_GET['tipo']=='Ocupados'){?>
                                                <?=$value['cama_ingreso_f']?> <?=$value['cama_ingreso_h']?>
                                                <?php }else{?>
                                                No Aplica
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if($_GET['tipo']=='Ocupados'){?>
                                                <?= $Tiempo->d.' Dias '.$Tiempo->h.' Horas '.$Tiempo->i.' Min';?>
                                                <?php }else{?>
                                                No Aplica
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if($_GET['tipo']=='Ocupados'){?>
                                                <a href="<?= base_url()?>Sections/Documentos/Expediente/<?=$value['cama_dh']?>/?tipo=Consultorios&url=Enfemeria" target="_blank">
                                                    <i class="fa fa-share-square-o sigh-color tip i-24" data-original-title="Expediente"></i>
                                                </a>&nbsp;
                                                <a href="<?= base_url()?>Sections/Pacientes/Paciente/<?=$value['cama_dh']?>" target="_blank">
                                                    <i class="fa fa-user sigh-color tip i-24" data-original-title="Historial del Paciente" ></i>
                                                </a>
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
</div>
<?= Modules::run('Sections/Menu/loadFooter'); ?>