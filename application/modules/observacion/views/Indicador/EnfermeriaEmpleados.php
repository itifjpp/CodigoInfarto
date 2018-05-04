<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">GESTIÓN DE ENFERMEROS(AS) QUE INGRESARÓN Y/O EGRESARON PACIENTES</span>
                    
                </div>
                <div class="panel-body b-b b-light">
                    
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <input type="text" class="form-control" id="filter" placeholder="Buscar...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable" data-limit-navigation="7" data-filter="#filter" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>Matricula</th>
                                        <th >Nombre</th>
                                        <th >Total Registro</th>
                                        <th >Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr id="<?=$value['empleado_id']?>">
                                        <td><?=$value['empleado_matricula']?> </td>
                                        <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                        <td>
                                            <?php if($_GET['TIPO_BUSQUEDA']=='POR_FECHA'){?>
                                            <?= count(Modules::run('Observacion/Indicador/FiltroEnfemeriaPacientesFecha',array(
                                                'FechaInicio'=> $this->input->get_post('POR_FECHA_FI'),
                                                'FechaFin'=> $this->input->get_post('POR_FECHA_FF'),
                                                'tipo'=>$this->input->get_post('TIPO'),
                                                'empleado'=>$value['empleado_id']
                                            )))?> Pacientes
                                            <?php }else{?>
                                            <?= count(Modules::run('Observacion/Indicador/FiltroEnfemeriaPacientesHora',array(
                                                'FechaInicio'=> $this->input->get_post('POR_HORA_FI'),
                                                'HoraInicio'=> $this->input->get_post('POR_HORA_HI'),
                                                'HoraFin'=> $this->input->get_post('POR_HORA_HF'),
                                                'tipo'=>$this->input->get_post('TIPO'),
                                                'empleado'=>$value['empleado_id']
                                            )))?> Pacientes
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url()?>Observacion/Indicador/EnfermeriaPacientes?TIPO=<?=$_GET['TIPO']?>&TIPO_BUSQUEDA=<?=$_GET['TIPO_BUSQUEDA']?>&POR_FECHA_FI=<?=$_GET['POR_FECHA_FI']?>&POR_FECHA_FF=<?=$_GET['POR_FECHA_FF']?>&POR_HORA_FI=<?=$_GET['POR_HORA_FI']?>&POR_HORA_HI=<?=$_GET['POR_HORA_HI']?>&POR_HORA_HF=<?=$_GET['POR_HORA_HF']?>&EMPLEADO=<?=$value['empleado_id']?>" target="_blank">
                                                <i class="fa fa-users icono-accion"></i>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/Enfermeriatriage.js?').md5(microtime())?>" type="text/javascript"></script>