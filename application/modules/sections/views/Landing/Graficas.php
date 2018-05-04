<?= Modules::run('Sections/Menu/HeaderLanding'); ?> 

<body data-spy="scroll" data-target=".navMenuCollapse">

<!-- PRELOADER -->
<div id="preloader">
    <div class="battery inner">
        <div class="load-line"></div>
    </div>
</div>

<div id="wrap"> 

    <!-- NAVIGATION BEGIN -->
    <nav class="navbar navbar-fixed-top navbar-slide">
        <div class="container_fluid"> 
            <button class="navbar-toggle menu-collapse-btn collapsed" data-toggle="collapse" data-target=".navMenuCollapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <div class="collapse navbar-collapse navMenuCollapse">
                <ul class="nav">
                    <li><a href="#proceso_medico">PROCESO MÉDICO</a> </li>
                    <li><a href="#proceso_administrativo">PROCESO ADMINISTRATIVO</a></li>
                    <li><a href="#indicadores">INDICADORES</a></li>
                    <li><a href="#innovacion">MODELO DE INNOVACIÓN</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section  id="proceso_medico" style="margin-top: -100px">
        <div class="container">
            <div class="title" >
                <h3 style="text-transform: uppercase;">INDICADORES TRIAGE : <b><?=$_GET['color']?></b> DE FECHA: <b><?=$_GET['inputFi']?></b> A <b><?=$_GET['inputFf']?></b></h3>
                <div class="row" style="margin-top: 40px">
                    <div class="col-md-12">
                        <input type="hidden" name="color" value="<?=$_GET['color']?>">
                        <input type="hidden" name="inputFi" value="<?=$_GET['inputFi']?>">
                        <input type="hidden" name="inputFf" value="<?=$_GET['inputFf']?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="response-ajax-graficas hide">
                            <center><i class="fa fa-spinner fa-pulse fa-4x"></i></center>
                        </div>
                        <canvas id="GraficaEsponRefec" style="height: 300px"></canvas>
                    </div>
                    <div class="col-md-6">
                        <div class="response-ajax-graficas hide">
                            <center><i class="fa fa-spinner fa-pulse fa-4x"></i></center>
                        </div>
                        <canvas id="GraficaSexo" style="height: 300px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="CargarGraficaDetalles">
<?= Modules::run('Sections/Menu/FooterLanding'); ?> 