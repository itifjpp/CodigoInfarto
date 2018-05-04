<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered">
            <div class="panel panel-default " style="margin-top: -20px">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">
                        INDICADOR <i class="fa fa-arrow-right"></i> <?=$_GET['section']?> <i class="fa fa-arrow-right"></i> CONSULTAS USUARIOS
                    </span>
                </div>
                <input type="hidden" name="fecha" value="<?=$_GET['fecha']?>">
                <input type="hidden" name="turno" value="<?=$_GET['turno']?>">
                <input type="hidden" name="tipo" value="<?=$_GET['tipo']?>">
                <input type="hidden" name="usuarios_productiviad">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover footable" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                                <thead>
                                    <tr>
                                        <th >Matrícula</th>
                                        <th data-hide="phone" >Nombre</th>
                                        <th data-hide="phone">Total ST7</th>
                                        <th data-hide="phone">Total Incapacidad</th>
                                        <th data-hide="phone">Total Consulta</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Gestion as $value) {?>
                                    <tr>
                                        <td><?=$value['empleado_matricula']?></td>
                                        <td><?=$value['empleado_nombre']?> <?=$value['empleado_ap']?> <?=$value['empleado_am']?></td>
                                        <td>PENDIENTE</td>
                                        <td>PENDIENTE</td>
                                        <td>
                                            <?php if($this->uri->segment(4)=='Triage'){?>
                                            <?= count(Modules::run('Urgencias/Graficasfunctions/IndicadorUsuariosTotalConsultas',array(
                                                'tipo'=> $this->input->get('section'),
                                                'fecha'=> $this->input->get('fecha'),
                                                'turno'=> $this->input->get('turno'),
                                                'empleado'=>$value['empleado_id']
                                            )))?>  Consultas
                                            <?php }?>
                                            <?php if($this->uri->segment(4)=='Consultorios'){?>
                                            <?= count(Modules::run('Urgencias/Graficasfunctions/IndicadorConsultoriosTotalConsultas',array(
                                                'consultorio'=> $this->input->get('section'),
                                                'fecha'=> $this->input->get('fecha'),
                                                'turno'=> $this->input->get('turno'),
                                                'empleado'=>$value['empleado_id']
                                            )))?>  Consultas
                                            <?php }?>
                                            <?php if($this->uri->segment(4)=='Observacion'){?>
                                            <?= count(Modules::run('Urgencias/Graficasfunctions/IndicadorObservacionPacientes',array(
                                                'tipo'=> $this->input->get('section'),
                                                'fecha'=> $this->input->get('fecha'),
                                                'turno'=> $this->input->get('turno'),
                                                'empleado'=>$value['empleado_id']
                                            )))?>  Consultas
                                            <?php }?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url()?>Urgencias/Graficas/IndicadorPacientes/<?=$value['empleado_id']?>/?section=<?=$_GET['section']?>&turno=<?=$_GET['turno']?>&fecha=<?=$_GET['fecha']?>&tipo=<?=$this->uri->segment(4)?>" target="_blank">
                                                <i class="fa fa-users icono-accion"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Urgenciasv2.js"></script>