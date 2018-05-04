<?= modules::run('Sections/Menu/index'); ?> 
<div class="box-row">
    <div class="box-cell">
        <div class="col-md-6 col-centered" style="margin-top: -20px ">
            <div class="box-inner padding">
                <div class="panel panel-default ">
                    <div class="panel-heading p teal-900 back-imss" style="">
                        <span style="font-weight: 500;text-transform: uppercase">
                            <b>PROCURACIÓN DE ORGANOS | BUSQUEDA ACTIVA</b>
                        </span>
                    </div>
                    <div class="panel-body b-b b-light">
                        <div class="card-body" style="padding: 20px 0px;">
                            <form class="posible-donador-form">
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><b>POTENCIAL DONADOR</b></label>&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="Si" class="posible-donador" data-value="<?=$po['po_potencial_donador']?>" name="po_potencial_donador" data-tipo="Potencial Donador">
                                                <i class="back-imss"></i>SI
                                            </label>&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="No" checked="" class="posible-donador" name="po_potencial_donador" data-tipo="Potencial Donador">
                                                <i class="back-imss"></i>NO
                                            </label>
                                        </div>
                                        <div class="form-group po_donador_elegible hide">
                                            <label><b>DONADOR ELEGIBLE</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="Si" class="posible-donador" data-value="<?=$po['po_donador_elegible']?>" name="po_donador_elegible" data-tipo="Donador Elegible">
                                                <i class="back-imss"></i>SI
                                            </label>&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="No" checked="" class="posible-donador" name="po_donador_elegible" data-tipo="Donador Elegible">
                                                <i class="back-imss"></i>NO
                                            </label>
                                        </div>
                                        <div class="form-group po_donador_efectivo hide">
                                            <label><b>DONADOR EFECTIVO</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="Si" class="posible-donador" data-value="<?=$po['po_donador_efectivo']?>" name="po_donador_efectivo" data-tipo="Donador Efectivo">
                                                <i class="back-imss"></i>SI
                                            </label>&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="No" checked="" class="posible-donador" name="po_donador_efectivo" data-tipo="Donador Efectivo">
                                                <i class="back-imss"></i>NO
                                            </label>
                                        </div>
                                        <div class="form-group po_donador_util hide">
                                            <label><b>DONADOR ÚTIL</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="Si" class="posible-donador" data-value="<?=$po['po_donador_util']?>" name="po_donador_util" data-tipo="Donador Útil">
                                                <i class="back-imss"></i>SI
                                            </label>&nbsp;&nbsp;
                                            <label class="md-check">
                                                <input type="radio" value="No" checked="" class="posible-donador" name="po_donador_util" data-tipo="Donador Útil">
                                                <i class="back-imss"></i>NO
                                            </label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <input type="hidden" name="triage_id" value="<?=$_GET['folio']?>">
                                            <input type="hidden" name="csrf_token">
                                            <input type="hidden" name="po_type">
                                            <input type="hidden" name="po_value">
                                            <input type="hidden" name="po_input">
                                            <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modules::run('Sections/Menu/footer'); ?>
<script src="<?= base_url('assets/js/ProcuracionOrganos.js?'). md5(microtime())?>" type="text/javascript"></script>