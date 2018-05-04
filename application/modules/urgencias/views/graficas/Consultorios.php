<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-10 col-centered">
            <div class="panel panel-default ">
                <div class="panel-heading p teal-900 back-imss">
                    <span style="font-size: 15px;font-weight: 500;text-transform: uppercase">PACIENTES EN CONSULTORIOS</span>
                </div>
                <table class="table table-bordered table-hover footable" data-filter="#filter" data-page-size="10" data-limit-navigation="7">
                    <thead>
                        <tr>
                            <th >Consultorio</th>
                            <th data-hide="phone">Total de Pacientes</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Filtros</td>
                            <td><?= Modules::run('Urgencias/Graficasfunctions/ObtenerPacientesConsultorios',array(
                                'turno'=> Modules::run('Urgencias/Graficasfunctions/ObtenerTurno',array('turno'=>$_GET['turno'])),
                                'fecha'=>$_GET['fecha'],
                                'consultorio'=>'Filtro'
                            ))?> Pacientes</td>
                            <td class="text-center">
                                <a href="<?= base_url()?>Urgencias/Graficas/ConsultoriosUsuarios?consultorio=Filtro&fecha=<?=$_GET['fecha']?>&turno=<?=$_GET['turno']?>" target="_blank">
                                    <i class="fa fa-user icono-accion"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Consultorio Cirugía General</td>
                            <td><?= Modules::run('Urgencias/Graficasfunctions/ObtenerPacientesConsultorios',array(
                                'turno'=> Modules::run('Urgencias/Graficasfunctions/ObtenerTurno',array('turno'=>$_GET['turno'])),
                                'fecha'=>$_GET['fecha'],
                                'consultorio'=>'Consultorio Cirugía General'
                            ))?> Pacientes
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url()?>Urgencias/Graficas/ConsultoriosUsuarios?consultorio=Consultorio Cirugía General&fecha=<?=$_GET['fecha']?>&turno=<?=$_GET['turno']?>" target="_blank">
                                    <i class="fa fa-user icono-accion"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Consultorio Neurocirugía</td>
                            <td><?= Modules::run('Urgencias/Graficasfunctions/ObtenerPacientesConsultorios',array(
                                'turno'=> Modules::run('Urgencias/Graficasfunctions/ObtenerTurno',array('turno'=>$_GET['turno'])),
                                'fecha'=>$_GET['fecha'],
                                'consultorio'=>'Consultorio Neurocirugía'
                            ))?> Pacientes
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url()?>Urgencias/Graficas/ConsultoriosUsuarios?consultorio=Consultorio Neurocirugía&fecha=<?=$_GET['fecha']?>&turno=<?=$_GET['turno']?>" target="_blank">
                                    <i class="fa fa-user icono-accion"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Consultorio Cirugía Maxilofacial</td>
                            <td><?= Modules::run('Urgencias/Graficasfunctions/ObtenerPacientesConsultorios',array(
                                'turno'=> Modules::run('Urgencias/Graficasfunctions/ObtenerTurno',array('turno'=>$_GET['turno'])),
                                'fecha'=>$_GET['fecha'],
                                'consultorio'=>'Consultorio Cirugía Maxilofacial'
                            ))?> Pacientes
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url()?>Urgencias/Graficas/ConsultoriosUsuarios?consultorio=Consultorio Cirugía Maxilofacial&fecha=<?=$_GET['fecha']?>&turno=<?=$_GET['turno']?>" target="_blank">
                                    <i class="fa fa-user icono-accion"></i>
                                </a>
                            </td>
                        </tr>
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?=  base_url()?>assets/js/Urgencias.js"></script>