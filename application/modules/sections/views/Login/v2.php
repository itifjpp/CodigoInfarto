<?=Modules::run('Sections/Menu/loadHeaderBasico')?>
<div class="row">
    <?php if(empty($CheckEquipo)){?>
    <div class="col-md-6 col-centered">
        <div class="row login-container ">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <h5 class="line-height text-justify">LO SENTIMOS EL EQUIPO NO ESTA REGISTRADO, POR FAVOR PONGASE EN CONTATO CON EL ADMINISTRADOR PARA REGISTRAR ESTE EQUIPO Y PODER HACER USO DEL SISTEMA</h5>
                </div>
            </div>
            <div class="col-md-9 col-centered">
                <div class="grid simple">
                    <div class="grid-body">
                        <form name="form" class="row-login-autorizate " style="padding-left: 20px;padding-right: 20px">
                            <div class="form-group">
                                <h4 class="semi-bold no-margin">AUTORIZAR REGISTRO DE EQUIPO</h4>
                            </div>
                            <div class="form-group">
                                <div class="transparent">
                                    <input type="password" name="empleado_id" required="" autocomplete="off" class="form-control" placeholder="INGRESAR ID DE USUARIO">
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div class="transparent">
                                    <input type="password" name="empleado_matricula" required="" autocomplete="off" class="form-control" placeholder="INGRESAR MATRICULA">
                                    
                                </div>
                            </div>
                            <input type="hidden" name="equipo_ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
                            <button type="submit" class="btn btn-danger btn-block">Accesar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }else{?>
    <div class="col-xs-8 col-sm-5  col-md-3 col-centered">
        <div class="row login-container " style="margin-top: calc(20%)">
            <div class="col-md-12 text-center">
                <img src="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" style="width: 40%"><br><br>
            </div>
            <div class="col-md-12 grid simple">
                <form name="form" class="login-form row-login grid-body" style="border-left: 4px solid <?=$this->sigh->getInfo('hospital_color')?>;padding-left: 20px;padding-right: 20px">
                    <div class="form-group">
                        <label>SELECCIONAR ÁREA</label>
                        <select class="select2 width100" name="empleado_area" id="empleado_area">
                            <option value=""></option>
                            <?php foreach ($Gestion as $value){?>
                            <option value="<?=$value['areas_acceso_nombre']?>"><?=$value['areas_acceso_nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group no-margin">
                        <label>INGRESAR N° DE EMPLEADO</label>
                        <div class="input-group transparent">
                            <input type="password" name="empleado_matricula" required="" autocomplete="off" class="form-control" placeholder="INGRESAR N° DE EMPLEADO">
                            <span class="input-group-addon  pointer">
                                <i class="fa fa-unlock show-hide-matricula sigh-color"></i>
                            </span>
                            
                        </div>
                    </div>
                    <div class="form-group m-t-15 m-b-10">
                        <h6 class="no-margin text-right pointer" onclick="AbrirVista(base_url+'Sections/Login/NoPuedoIngresar',500,450)"> NO PUEDO INGRESAR?</h6>
                    </div>
                    <div class="form-group m-b-5" >
                        <button  type="submit" class="btn sigh-background-secundary btn-block">Accesar</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>
    <?php }?>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group no-margin">
            <h5 class="color-black m-t-10 text-center semi-bold" style="margin-bottom: -10px">SiGH &copy; 2018 | 
                <a href="<?= base_url()?>AvisoLegal">Aviso legal</a> y 
                <a href="<?= base_url()?>Privacidad" >privacidad</a>
            </h5>

        </div>
        
        
    </div>
</div>
<?=Modules::run('Sections/Menu/loadFooterBasico')?>
<script src="<?=  base_url()?>assets/js/sections/login.js?<?= md5(microtime())?>"></script>