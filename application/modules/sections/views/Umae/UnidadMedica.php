<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner col-md-10 col-centered" style="margin-top: 10px">
            <div class="md-whiteframe-z0 bg-white">
                <ul class="nav nav-md nav-tabs nav-lines b-info back-imss">
                    <li class="active" >
                        <a href="" data-toggle="tab" data-target="#tabUnidadMedica" aria-expanded="false" style="color: white">Unidad Médica</a>
                    </li>
                    <li class="">
                        <a href="" data-toggle="tab" data-target="#tabConfiguracionGeneral" aria-expanded="true" style="color: white">Configuración Expediente</a>
                    </li>
                </ul>
                <div class="tab-content p m-b-md b-t b-t-2x">
                    <div role="tabpanel" class="tab-pane animated fadeIn active" id="tabUnidadMedica">
                        <div class="row">
                            <form class="umae-config-admin">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>NOMBRE DE LA UNIDAD MÉDICA</b></label>
                                        <input type="text" class="form-control" name="um_nombre" value="<?=$info['um_nombre']?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>TIPO DE UNIDAD MÉDICA</b></label>
                                        <input type="text" class="form-control" name="um_tipo" value="<?=$info['um_tipo']?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>CLASIFICACIÓN</b></label>
                                        <select name="um_clasificacion" data-value="<?=$info['um_clasificacion']?>" class="form-control" required="">
                                            <option value=""></option>
                                            <option value="UMF">UMF</option>
                                            <option value="HGZ">HGZ</option>
                                            <option value="UMAE">UMAE</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><b>DIRECCIÓN DE LA UNIDAD MÉDICA</b></label>
                                        <textarea class="form-control"  name="um_direccion" required=""><?=$info['um_direccion']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><b>ACERCA DE LA UNIDAD MÉDICA</b></label>
                                        <textarea class="form-control"  name="um_acerca_de" rows="4"><?=$info['um_acerca_de']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>MISIÓN</b></label>
                                        <textarea class="form-control"  name="um_mision"  rows="5"><?=$info['um_mision']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>VISIÓN</b></label>
                                        <textarea class="form-control"  name="um_vision" rows="5"><?=$info['um_vision']?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>USUARIO DE BASE DE DATOS</b></label>
                                        <input type="text" class="form-control" name="um_bd_user" value="<?= $info['um_bd_user']?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>CONTRASEÑA DE BASE DE DATOS</b></label>
                                        <input type="password" class="form-control" name="um_bd_pass" value="(^_^) JAJA ACA NO ESTA LA CONTRASEÑA" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>DIRECCIÓN IP</b></label>
                                        <input type="text" class="form-control" name="um_bd_ip" value="<?=$info['um_bd_ip']?>" readonly="">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b>BASE DE DATOS</b></label>
                                        <input type="text" class="form-control" name="um_bd_name" value="<?=$info['um_bd_name']?>" readonly="">

                                    </div>
                                </div>   
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label ><b>SELECCIONAR IMAGEN DE LA UNIDAD MÉDICA</b></label>
                                        <input type="file" class="form-control upload-archivo" name="um_logo" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="csrf_token">
                                        <button class="btn back-imss pull-right" type="submit">GUARDAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane animated fadeIn" id="tabConfiguracionGeneral">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mayus-bold text-left">CONFIGURACIÓN EXPEDIENTE HOJA INICIAL</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigHojaInicialAbierta" data-id="10" value="Si" data-value="<?=$this->ConfigHojaInicialAbierta?>">
                                        <i class="blue"></i>Hoja Inicial Formato Abierto
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigHojaInicialAbierta" data-id="10" checked="" value="No" data-value="<?=$this->ConfigHojaInicialAbierta?>">
                                        <i class="blue"></i>Hoja Inicial No Abierto(Formato Completo)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigDiagnosticosCIE10" data-id="8" value="Si" data-value="<?=$this->ConfigDiagnosticosCIE10?>">
                                        <i class="blue"></i>Diagnósticos CIE10 
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="md-check mayus-bold">
                                        <input type="radio" class="save-config-um" name="ConfigDiagnosticosCIE10" data-id="8" checked="" value="No" data-value="<?=$this->ConfigDiagnosticosCIE10?>">
                                        <i class="blue"></i>Diagnósticos sin CIE10
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Sections/UMAE.js?'). md5(microtime())?>" type="text/javascript"></script>