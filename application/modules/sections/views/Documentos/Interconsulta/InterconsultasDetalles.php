<?= Modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-10" >
    <div class="col-md-12 col-centered ">
        <div class="grid simple">   
            <div class="grid-title sigh-background-secundary">
                <h4 class="no-margin color-white">DETALLE DE LA INTERCONSULTAS</h4>
            </div>
            <div class="grid-body">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h5>
                            <b>FECHA DE SOLICITUD </b> <?=$info['doc_fecha']?> <?=$info['doc_hora']?>
                        </h5>
                        <h5><b>SERVICIO SOLICITANTE: </b> <?=$info['doc_servicio_envia']?></h5>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h5>
                            <b>FECHA DE REALIZACIÓN: </b> <?=$info['doc_fecha_r']?> <?=$info['doc_hora_r']?>
                        </h5>
                        <h5><b>SERVICIO REQUERIDO: </b> <?=$info['doc_servicio_solicitado']?></h5>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>MÉDICO INTERCONSULTANTE: </b> <?=$info['empleado_nombre']?> <?=$info['empleado_ap']?> <?=$info['empleado_am']?></h5>
                        <h5><b>MÉDICO TRATANTE: </b> <?=$MedicoTratante['empleado_nombre']?> <?=$MedicoTratante['empleado_am']?> <?=$MedicoTratante['empleado_am']?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">    
                        <h5 style="line-height: 1.6"><b>DIAGNOSTICO PRESUNCIONAL: </b> <?=$info['doc_diagnostico']?></h5>

                        <h5><b>TIEMPO TRANSCURRIDO: </b> 
                            <?php
                            $TT= Modules::run('Config/CalcularTiempoTranscurrido',array(
                                'Tiempo1'=>$info['doc_fecha'].' '.$info['doc_hora'],
                                'Tiempo2'=>$info['doc_fecha_r'].' '.$info['doc_hora_r']
                            ));
                            echo $TT->h.' Horas'.' '.$TT->i.' Minutos';   
                            ?>
                        </h5>

                    </div>
                    <div class="col-md-6 col-xs-6 m-t-20">
                        <button class="btn btn-block sigh-background-secundary" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/GenerarNotas/<?=$info['doc_nota_id']?>','NOTA DE INTERCONSULTA')">
                            Generar Nota de Valoración
                        </button>
                    </div>
                    <div class="col-md-6 col-xs-6 m-t-20">
                        <button class="btn btn-danger pull-right btn-block" onclick="window.top.close()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<?= Modules::run('Sections/Menu/loadFooter'); ?>