<?php echo modules::run('Sections/Menu/loadHeaderBasico'); ?> 
<div class="row m-t-20">
    <div class="col-md-11 col-centered">
        <div class="grid simple">
            <div class="grid-title sigh-background-secundary" style="">
                <div class="row" style="">
                    <div style="position: relative">
                        <div style="top:-14px;position: absolute;height: 90px;width: 35px;left: -1px;" class="<?= Modules::run('Config/ColorClasificacion',array('color'=>$info['ingreso_clasificacion']))?>"></div>
                    </div>
                    <div class="col-sm-9 text-left" style="padding-left: 50px">
                        <h3 class="color-white text-uppercase no-margin semi-bold"><?=$info['paciente_ap']?> <?=$info['paciente_am']?> <?=$info['paciente_nombre']?></h3>
                        <h4 class="color-white text-uppercase m-t-5">
                            <?=$info['paciente_sexo']?> | 
                            <?php 
                                if($info['paciente_fn']!=''){
                                    $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                    if($fecha->y<15){
                                        echo 'PEDIATRICO';
                                    }if($fecha->y>15 && $fecha->y<60){
                                        echo 'ADULTO';
                                    }if($fecha->y>60){
                                        echo 'GERIATRICO';
                                    }
                                }else{
                                    echo 'S/E';
                                }
                            ?> | <?=$info['info_procedencia_esp']=='Si' ? 'ESPONTANEA:&nbsp; '.$info['info_procedencia_esp_lugar'] : ' : '.$info['info_procedencia_hospital'].' '.$info['info_procedencia_hospital_num']?> | <?=$info['ingreso_clasificacion']?>
                        </h4>
                    </div>
                    <div class="col-sm-3 text-right">
                        <h3 class="color-white text-uppercase no-margin semi-bold">EDAD</h3>
                        <h2 class="color-white no-margin">
                            <?php 
                            if($info['paciente_fn']!=''){
                                $fecha= Modules::run('Config/ModCalcularEdad',array('fecha'=>$info['paciente_fn']));
                                echo $fecha->y.'<span style="font-size:20px"><b>Años</b></span>';
                            }else{
                                echo 'S/E';
                            }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="grid-body">
                <form class="Form-Notas-COC">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon sigh-background-secundary no-border">TIPO DE NOTA</span>
                                    <select name="notas_tipo" class="select2 width100" data-value="<?=$Nota['notas_tipo']?>">
                                        <?php foreach ($Documentos as $value) {?>
                                        <option value="<?=$value['doc_nombre']?>"><?=$value['doc_nombre']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <select name="notas_especialidad" class="width100" data-value="<?=$Nota[0]['notas_especialidad']?>" >
                                    <option value="">SELECCIONAR ESPECIALIDAD...</option>
                                    <?php foreach ($Especialidades as $value) {?>
                                    <option value="<?=$value['especialidad_nombre']?>"><?=$value['especialidad_nombre']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" >

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">Tensión Arterial</label>
                                <input type="text" class="form-control" required="" name="sv_ta" value="<?=$SignosVitales['sv_ta']?>" >   
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">Temperatura</label>
                                <input type="text" class="form-control" required="" name="sv_temp"  value="<?=$SignosVitales['sv_temp']?>">   
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">Fr. Cardiaca</label>
                                <input type="text" class="form-control" required="" name="sv_fc"  value="<?=$SignosVitales['sv_fc']?>">  
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="mayus-bold">Fr. Respiratoria</label>
                                <input type="text" class="form-control" required="" name="sv_fr"  value="<?=$SignosVitales['sv_fr']?>">     
                            </div>
                        </div>
                        <div class="col-sm-12" >
                            <div class="form-group">
                                <a  href="#" class="md-btn md-fab m-b red btn-speech-start" style="position: absolute;right: 18px;top: -12px">
                                    <i class="material-icons i-24 color-white">mic</i>
                                </a>
                                <a  href="#" class="md-btn md-fab m-b red btn-speech-stop hide" style="position: absolute;right: 18px;top: -12px">
                                    <i class="material-icons i-24 color-white">mic_off</i>
                                </a>
                                <textarea class="form-control nota_nota" required="" name="nota_nota" rows="20" placeholder="DESCRIPCIÓN..."><?=$Nota['nota_nota']?></textarea>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <fieldset class="fieldset">
                                <legend class="legend">
                                    <span class="no-margin semi-bold">DIAGNÓSTICOS</span>&nbsp;&nbsp;
                                    <a onclick="AbrirVista(base_url+'Sections/Documentos/VideoDx',500,300)" class="cie10-dx-video pointer" style="color: red">
                                        <span class="text-right"><i class="fa fa-video-camera"></i> VER VIDEO</span>
                                    </a>
                                </legend>
                                <button type="button" onclick="AbrirVista(base_url+'Sections/Documentos/HistorialDx?ingreso=<?=$_GET['folio']?>',1000,600)" class="btn pull-left btn-success" style="">
                                    <i class="fa fa-history"></i> VER HISTORIAL DX
                                </button><br>
                                <a  href="#" onclick="AbrirVista(base_url+'Sections/Documentos/Dx?ingreso=<?=$_GET['folio']?>&temp=<?=$_GET['temp']?>&input=nota_diagnostico&Especialidad='+$('select[name=notas_especialidad]').val(),600,530)" md-ink-ripple="" class="md-btn md-fab m-b red waves-effect" style="position: absolute;right: 18px;top: -12px">
                                    <i class="material-icons i-24 color-white">library_add</i>
                                </a>
                                <br>
                                <table class="table table-bordered table-no-padding footable table-dx-pac" data-page-size="5">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">FECHA & HORA</th>
                                            <th style="width: 15%">TIPO</th>
                                            <th style="width: 25%">DX</th>
                                            <th style="width: 25%" >DX CIE10</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="hide-if-no-paging">
                                        <tr >
                                            <td class="text-center" colspan="5">
                                                <ul class="pagination"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </fieldset>
                        </div>
                        <div class="col-xs-12" style="margin-top: 10px">
                            <div class="form-group ">
                                <label><b>DIAGNÓSTICO</b></label>
                                <textarea class="form-control no-selectable nota_diagnostico" required="" name="nota_diagnostico" rows="4"><?=$Nota['nota_diagnostico']?></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <label><b>AGREGAR ANEXOS</b></label>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($Anexos as $value) {?>
                        <div class="col-md-4 col-img-anexos">
                            <i class="fa fa-trash-o color-imss i-20 icon-remove-img-bd" data-id="<?=$value['anexo_id']?>"></i>
                            <img src="<?= base_url()?>assets/NotasAnexos/<?=$value['anexo_img']?>" style="width: 100%">
                        </div>
                        <?php }?>
                    </div>
                    <div class="row row-paste-img">
                        <div class="col-md-12 info-imp-paste">
                            <div class="alert alert-info m-t-10" style="padding: 2px 5px 2px 5px;">
                                <h6>PUEDE AGREGAR IMAGENES COMO ANEXO SIMPLEMENTE CAPTURANDO PANTALLA (fn+Imp pnt) y PEGAR(Ctrl+v)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <?php 
                            $getRol=$this->config_mdl->sqlQuery("SELECT rol_nombre FROM sigh_areasacceso AS area, sigh_roles AS rol WHERE 
                            area.areas_acceso_rol=rol.rol_id AND
                            area.areas_acceso_nombre='$this->UMAE_AREA'")[0]
                        ?>
                        <?php if($getRol['rol_nombre']=='Médico Residente'){?>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="mayus-bold">MÉDICO QUE SUPERVISA</label>
                                <select class="select2 width100" required="" name="notas_medico_supervisa" data-value="<?=$Nota['notas_medico_supervisa']?>">
                                    <option value="">SELECCIONAR MÉDICO QUE SUPERVISA</option>
                                    <?php foreach ($Medicos as $value) {?>
                                    <option value="<?=$value['empleado_id']?>"><?=$value['empleado_ap']?> <?=$value['empleado_am']?> <?=$value['empleado_nombre']?> - <?=$value['empleado_matricula']?></option>
                                    <?php }?>
                                </select>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="mayus-bold">MÉDICO QUE AUTORIZA</label>
                                <select class="select2 width100" required="" name="notas_medico_autoriza" data-value="<?=$Nota['notas_medico_autoriza']?>">
                                    <option value="">SELECCIONAR MÉDICO QUE AUTORIZA</option>
                                    <?php foreach ($Medicos as $value) {?>
                                    <option value="<?=$value['empleado_id']?>"><?=$value['empleado_ap']?> <?=$value['empleado_am']?> <?=$value['empleado_nombre']?> - <?=$value['empleado_matricula']?></option>
                                    <?php }?>
                                </select>

                            </div>
                        </div>
                        <?php }?>
                        <div class="col-sm-offset-10 col-sm-2">
                            <input type="hidden" name="ingreso_id" value="<?=$_GET['folio']?>"> 
                            <input type="hidden" name="accion" value="<?=$_GET['a']?>">
                            <input type="hidden" name="notas_id" value="<?=$this->uri->segment(4)?>">
                            <input type="hidden" name="via" value="<?=$_GET['via']?>">
                            <input type="hidden" name="inputVia" value="<?=$_GET['inputVia']?>">
                            <input type="hidden" name="doc_id" value="<?=$_GET['doc_id']?>">
                            <input type="hidden" name="temp" value="<?=$_GET['temp']?>">
                            <button class="btn sigh-background-secundary pull-right btn-block" type="submit" style="margin-bottom: -10px">Guardar</button>                     
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="TIPO_MEDICO" value="<?=$this->UMAE_AREA?>">
<input type="hidden" name="getDX" value="Si">
<input type="hidden" name="PasteImg" value="Si">
<?=Modules::run('Sections/Menu/loadFooterBasico'); ?>
<script src="<?= base_url('assets/js/sections/Documentos.js?'). md5(microtime())?>" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $('.btn-speech-stop').click(function(e) {
        $('.btn-speech-stop').addClass('hide');
        $('.btn-speech-start').removeClass('hide');
        e.preventDefault();
        var speechRecognition=new webkitSpeechRecognition();
        speechRecognition.continuous=true;
        speechRecognition.interimResults=true;
        speechRecognition.lang='es-ES';
        speechRecognition.abort();
    });
    $('.btn-speech-start').click(function(e) {
        e.preventDefault();
        if('webkitSpeechRecognition' in window){
            $('.btn-speech-start').addClass('hide');
            $('.btn-speech-stop').removeClass('hide');
            var speechRecognition=new webkitSpeechRecognition();
            speechRecognition.continuous=true;
            speechRecognition.interimResults=true;
            speechRecognition.lang='es-ES';
            speechRecognition.start();
            var finalTranscripts='';
            var nota_nota=$('.nota_nota');
            speechRecognition.onresult=function(event) {
                var interimTranscripts='';
                for (var i = event.resultIndex; i<event.results.length; i++) {
                    var transcript=event.results[i][0].transcript;
                    transcript.replace('\n','<br>');
                    if(event.results[i].isFinal){
                        finalTranscripts+=transcript;
                    }else{
                        interimTranscripts+=transcript;
                    }
                }
                //console.log(finalTranscripts+'<span style="color:#999">'+interimTranscripts+'</span>')
                nota_nota.html(finalTranscripts+' '+interimTranscripts);
            }
            speechRecognition.onerror=function() {

            }
        }else{
            alert('error');
        }
    })
    
})    
</script>