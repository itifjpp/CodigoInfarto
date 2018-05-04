<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding col-md-12 col-centered"> 
            <ol class="breadcrumb">
                <li><a style="text-transform: uppercase" href="<?= base_url()?>Abasto/MinimaInvacion/ValeSolicitudes">VALE DE SOLICITUDES</a></li>
                <li><a style="text-transform: uppercase" href="#">SOLICITUD</a></li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading p teal-900 back-imss">
                   <span style="font-size: 15px;font-weight: 500;text-align: center!important">
                       <center><strong>PETICIONES</strong></center>
                   </span>
               </div>
               <div class="panel-body b-b b-light">     
                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-12"><br><br>
                               <table class="table table-hover table-bordered footable" data-page-size="7" data-filter="#elemento_id" style="font-size: 13px">
                                   <thead>
                                       <tr>
                                           <th>SISTEMA</th>
                                           <th>ELEMENTO</th>
                                           <th>RANGO</th>
                                           <th style="text-align: center;">ACCIÓN</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <?php foreach ($solicitados AS $solicitado) {?>
                                       <tr>
                                            <td>
                                                 <?php $dato1= $this->config_mdl->_query("SELECT * FROM abs_sistemas WHERE sistema_id=".$solicitado['sistema_id'])[0]; echo $dato1['sistema_titulo']?>
                                            </td>
                                            <td>
                                                 <?php $dato2= $this->config_mdl->_query("SELECT * FROM abs_elementos WHERE elemento_id=".$solicitado['elemento_id'])[0]; echo $dato2['elemento_titulo']?>
                                            </td>
                                            <td>
                                                 <?php $dato3= $this->config_mdl->_query("SELECT * FROM abs_rangos WHERE rango_id=".$solicitado['rango_id'])[0]; echo $dato3['rango_titulo']?>
                                            </td>
                                            <td style="width:15%">
                                                <?php if($total['total'] > $total_solicitud['total_sol']) {  $total--;?>
                                                <center>
                                                    <i style="color: #04B404;" class="fa fa fa-check-circle i-20 pointer" title="Disponible"></i>
                                                    &nbsp;&nbsp;&nbsp;<i class="fa fa-unlock i-20 pointer icono-accion" title="Asociar"></i>
                                                  <!--  &nbsp;&nbsp;&nbsp;<i class="fa fa-lock i-20 pointer icono-accion" title="Asociado"></i> -->
                                                </center>
                                                
                                                <?php } else {?>
                                                <center><i style="color: #FF0000;" class="fa fa-times-circle i-20 pointer" title="No disponible"></i></center>
                                                <?php } ?>
                                            </td>
                                       </tr>
                                       <?php }?>
                                   </tbody>
                                   <tfoot class="hide-if-no-paging">
                                       <tr>
                                           <td colspan="6" id="footerCeldas" class="text-center">
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
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/AbsCatalogos.js?').md5(microtime())?>" type="text/javascript"></script>