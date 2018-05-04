<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <style>hr.style-eight {border: 0;border-top: 2px dashed #8c8c8c;text-align: center;}hr.style-eight:after {content: attr(data-titulo);display: inline-block;position: relative;top: -13px;font-size: 1.2em;padding: 0 0.20em;background: white;font-weight:bold;}</style>
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered"> 
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                        <strong>DATOS DEL PACIENTE</strong><br>
                    </span>
                </div>
                <div class="panel-body b-b b-light">  
                    <form class="form-expediente">                  
                        <div class="row row-info-user">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">NOMBRE</label>
                                    <input type="text" name="triage_nombre" value="<?=$info['triage_nombre']?>"value="<?=$info['triage_nombre']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">APELLIDO PATERNO</label>
                                    <input type="text" name="triage_nombre_ap" value="<?=$info['triage_nombre_ap']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">APELLIDO MATERNO</label>
                                    <input type="text" name="triage_nombre_am" value="<?=$info['triage_nombre_am']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">FOLIO</label>
                                    <input type="text" name="" readonly="" value="<?=$info['triage_id']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">C.U.R.P</label>
                                    <input type="text" name="triage_paciente_curp" value="<?=$info['triage_paciente_curp']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">N.S.S</label>
                                    <input type="text" name="pum_nss" value="<?=$pum['pum_nss']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">N.S.S Agregado</label>
                                    <input type="text" name="pum_nss_agregado" value="<?=$pum['pum_nss_agregado']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Unidad Médica</label>
                                    <input type="text" name="pum_umf" value="<?=$pum['pum_umf']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Delegación</label>
                                    <input type="text" name="pum_delegacion" value="<?=$pum['pum_delegacion']?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="style-eight" data-titulo="Domicilio del Paciente">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Telefono</label>
                                    <input class="form-control" name="directorio_telefono" placeholder="" value="<?=$DirPaciente['directorio_telefono']?>"> 
                                </div> 
                                </div>
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label style="text-transform: uppercase;font-weight: bold">Código Postal</label>
                                    <input class="form-control" name="directorio_cp" placeholder="" value="<?=$DirPaciente['directorio_cp']?>"> 
                                </div>                   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Calle y Numero</label>
                                    <input class="form-control" name="directorio_cn" placeholder="" value="<?=$DirPaciente['directorio_cn']?>"> 
                                </div>                   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Colonia</label>
                                    <input class="form-control" name="directorio_colonia" placeholder="" value="<?=$DirPaciente['directorio_colonia']?>"> 
                                </div>                   
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Municipio</label>
                                    <input class="form-control" name="directorio_municipio" placeholder="" value="<?=$DirPaciente['directorio_municipio']?>"> 
                                </div>            
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Estado</label>
                                    <input class="form-control" name="directorio_estado" placeholder="" value="<?=$DirPaciente['directorio_estado']?>"> 
                                </div>               
                            </div>
                            <?php if($DirEmpresa['directorio_telefono']!=''){?>
                            <div class="col-md-12">
                                <hr class="style-eight" data-titulo="Domicilio de la Empresa">
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Telefono (Lada)</label>
                                    <input class="form-control" name="directorio_telefono_2" placeholder="" value="<?=$DirEmpresa['directorio_telefono']?>"> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Código Postal</label>
                                    <input class="form-control" name="directorio_cp_2" placeholder="" value="<?=$DirEmpresa['directorio_cp']?>"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Calle y Numero</label>
                                    <input class="form-control" name="directorio_cn_2" placeholder="" value="<?=$DirEmpresa['directorio_cn']?>"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Colonia</label>
                                    <input class="form-control" name="directorio_colonia_2" placeholder="" value="<?=$DirEmpresa['directorio_colonia']?>"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label style="text-transform: uppercase;font-weight: bold">Municipio</label>
                                    <input class="form-control" name="directorio_municipio_2" placeholder="" value="<?=$DirEmpresa['directorio_municipio']?>"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="text-transform: uppercase;font-weight: bold">Estado</label>
                                    <input class="form-control" name="directorio_estado_2" placeholder="" value="<?=$DirEmpresa['directorio_estado']?>"> 
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div  class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="button" class="btn back-imss btn-block" onclick="window.top.close();">Cancelar</button>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="triage_id_val" value="<?=$info['triage_id']?>">
                                <input type="hidden" name="csrf_token" >
                                <button type="submit" class="btn back-imss btn-block" >Validar y Generar Expediente</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Arimac.js?').md5(microtime())?>" type="text/javascript"></script>