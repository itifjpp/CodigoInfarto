<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500">GESTIÓN DE CAMAS</span>
                </div>
                <style>
                    .color-amarillo{ background-color: #FFC107!important;color: white!important;}
                    .color-naranja{background-color: #ff9800!important;color: white!important;}
                </style>
                <div class="panel-body b-b b-light">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered  footable table-usuarios"  data-filter="#Filtro_Camas" data-page-size="40" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th>ÁREA</th>
                                        <th>CAMA</th>
                                        <th style="width: 20%;">PACIENTE</th>
                                        <th>INGRESO</th>
                                        <th>TIEMPO EN CAMA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <?php ;
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
                                        <td><?=$value['area_nombre']?></td>
                                        <td ><?=$value['cama_nombre']?></td>
                                        
                                        <td style="font-size: 10px">
                                            <?php if($_GET['tipo']=='Ocupados'){?>
                                            <?= Modules::run('Pisos/Camas/DetallePaciente',array('triage_id'=>$value['cama_dh']))['triage_nombre'].' '.['triage_nombre_ap'].' '.['triage_nombre_am']?> 
                                            <?php }else{?>
                                            No Aplica
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($_GET['tipo']=='Ocupados'){?>
                                            <?=Modules::run('Pisos/Camas/IngresoPaciente',array('paciente'=>$value['cama_dh'],'area'=>$_GET['area']))?>
                                            <?php }else{?>
                                            No Aplica
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($_GET['tipo']=='Ocupados'){?>
                                            <?= $Tiempo->d.' Dias '.$Tiempo->h.' Horas '.$Tiempo->i.' Minutos';?>
                                            <?php }else{?>
                                            No Aplica
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