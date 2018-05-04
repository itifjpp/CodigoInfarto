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
    <!-- NAVIGAION END -->
	
    <!-- SLIDER -->
    <header id="minimal-intro" class="intro-block bg-color-grad" >
        <div id="slides" data-stellar-ratio="0.4">
            <div class="slides-container" > <img src="<?= base_url()?>asset_landing/images/urgencias_vespertinas.jpg" alt=""> <img src="<?= base_url()?>asset_landing/images/urgencias_vespertinas.jpg" alt=""></div>
	</div>
        <div class="ray ray-horizontal y-75 x-0 ray-rotate45 laser-blink hidden-sm hidden-xs" ></div>
        <div class="ray ray-horizontal y-50 x-0 ray-rotate45 laser-blink hidden-sm hidden-xs" ></div>
        <div class="ray ray-horizontal y-25 x-100 ray-rotate-135 laser-blink hidden-sm hidden-xs" ></div>
        <div class="ray ray-horizontal y-50 x-100 ray-rotate-135 laser-blink hidden-sm hidden-xs" ></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <br><br><br><br><br><br>
                    <h1 class="slogan">Gestión estratégica para la  
                    <br><strong>atención </strong><span class="type"></span> del paciente clasificado en el área de urgencias.</h1>
                    <!-- <a class="download-btn ios-btn" href="#">
                            <div class="btn-slide"></div>s
                            <div class="btn-content"><i class="icon soc-icon-apple"></i>Download for <b>Apple iOS</b></div> 
                    </a>-->
                </div>
            </div>
        </div>
        <div class="block-bg" data-stellar-ratio="0.4"></div>
    </header>
	<!-- SLIDER END --> 
	
    <!-- HORA CERO  -->
    <section  id="proceso_medico">
        <div class="container">
            <div class="title" >
                <h2 >CLASIFICACIÓN DE PACIENTES TRIAGE</h2>
                <p>Las sala de urgencias del Hospital de Traumatología se enfrentan todos los días a un <strong>flujo continuo y simultáneo </strong> de pacientes derechohabientes y no derechohabientes que solicitan atención médica de <strong>urgencias sentidas y reales</strong>, en un día típico ingresan 338 paciente esto  generaba  problemas administrativos y médicos para una atención oportuna. Por ello y con base al decálogo propuesto por la dirección general del IMSS se trabaja  en un marco tecnológico que apoye la toma de decisiones y mejora la coordinación de equipos interdisciplinarios a través de un modelo de priorización y organización de recursos en los servicios de urgencias con el objetivo priorizar la atención con base a la capacidad de atención de la unidad médica.</p><br><br>
                <div class="col-sm-2"> </div>
                <div class="col-sm-3">
                    <img src="<?= base_url()?>asset_landing/images/hora_cero.png" height="250">
                </div>
                <div class="col-md-5">
                    <br>
                    <p style="font-size: 24px; font-weight: bold;">Hora Cero</p>
                    <p>Evento en el que se registra el tipo y hora de ingreso del paciente a la unidad de atención</p><br>
                    <p style="font-size: 24px; font-weight: bold;">Tipo de Ingresos </p>
                    <p style="font-weight: bold;">Ingreso peatonal (Espontáneo - Referenciado).</p>
                    <p>Cuando el paciente ingresó por sus propios medios, podrá solicitar una silla de ruedas al personal de vigilancia.
                    Vigilancia proporcionará la silla de ruedas, registrando y acreditando la información de resguardo del paciente</p>
                </div>
                <div class="col-sm-2">  </div>
            </div>
        </div><br><br><br>

        <div class="container">
            <div class="title">
                <p style="font-size: 24px; font-weight: bold; text-align: center;">Ingreso en Vehículos</p>			
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?= base_url()?>asset_landing/images/ambulancia_imss.png" alt="" width="240" />
                    <p style="font-size: 24px; font-weight: bold; text-align: center; padding-top:30px;">Institucional IMSS</p>
                    <p>Cuando el paciente ingresa a través procedimiento de  <strong>referencia/contrareferencia </strong>por medio de una ambulancia del IMSS.</p>
                </div>
                <div class="col-sm-4">
                    <img src="<?= base_url()?>asset_landing/images/ambulancia_publica.png" alt="" width="240" />
                    <p style="font-size: 24px; font-weight: bold; text-align: center; padding-top:30px">Institución Pública</p>
                    <p>Cuando el paciente ingresa de manera espontánea por medio de una <strong>ambulancia pública </strong>(Cruz Roja, ERUM, etc).</p> 
                </div>
                <div class="col-sm-4">
                    <img src="<?= base_url()?>asset_landing/images/ambulancia_aerea.png" alt="" width="240" />
                    <p style="font-size: 24px; font-weight: bold; text-align: center; padding-top:30px">Áereo</p>
                    <p>Cuando ingresa el paciente a través de un vehículo aereo coordinado através del <strong>CRUM (Condores, Relampagos, etc).</strong></p> 
                </div>
            </div>
        </div>
    </section>
    <!-- HORA CERO END  -->

    <!-- ENFERMERÍA TRIAGE  -->
    <section >
        <div  class="container">
            <div class="title" >
                <h2>Enfermería TRIAGE</h2>
                <div class="col-sm-2"> </div>
                <div class="col-sm-3">
                    <img src="<?= base_url()?>asset_landing/images/filtro1-02.png" height="250">
                </div>
                <div class="col-md-5">
                    <br>
                    <p style="font-weight: bold;">Fila Espera Enfermería TRIAGE.</p>
                    <p>Sala donde el paciente que ingresa por sus propios medios espera a que el personal de enfermería toma sus datos iniciales.</p>
                    <p>Esta sala debe de contar con un diseño de ambiente y orientación del personal de TAOD para que el paciente conozca los procesos de atención en el área de TRIAGE, Cartera de Servicio y los Criterios de Ingreso del  Hospital de Traumatología.</p>
                </div>
                <div class="col-sm-2"> </div>
            </div>
        </div>

        <div class="container">
            <div class="title">
                <div class="col-sm-2"> </div>
                <div class="col-sm-3">
                    <img src="" height="250">
                </div>
                <div class="col-md-5">
                    <br>
                    <p style="font-weight: bold;">Identificación del paciente, captura y registro de signos vitales.</p>
                    <p>Proceso en el que el personal de enfermería identifica al paciente en la fila, obtiene su procedencia (espontáneo – referenciado |Unidad de Origen|),  toma, captura y registra los signos vitales del paciente.</p>
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="img-circle" src="<?= base_url()?>asset_landing/images/temperatura.png" alt="" width="80" />
                        </div>
                        <div class="col-sm-3">
                            <img class="img-circle" src="<?= base_url()?>asset_landing/images/presion_arterial.png" alt="" width="80" />
                        </div>
                        <div class="col-sm-3">
                            <img class="img-circle" src="<?= base_url()?>asset_landing/images/frecuencia_respiratoria.png" alt="" width="80" />
                        </div>
                        <div class="col-sm-3">
                            <img class="img-circle" src="<?= base_url()?>asset_landing/images/tension_arterial.png" alt="" width="80" />
                        </div>	
                    </div>
                </div>
                <div class="col-sm-2"> </div>
            </div>
        </div>
        <div class="container"> </div>
    </section>
    <!-- ENFERMERÍA TRIAGE END -->

    <!-- MÉDICO TRIAGE -->
    <section>
        <div class="container">
            <div class="title">
                <h2>Médico TRIAGE</h2>
                <div class="col-sm-2"> </div>
                <div class="col-sm-3">
                    <img src="<?= base_url()?>asset_landing/images/consulta1-04.png" height="250">
                </div>
                <div class="col-md-5">
                    <br>
                    <p style="font-weight: bold;">Clasificación del Paciente</p>
                    <p>El médico clasifica al paciente a través de una serie de discriminadores estandarizados y jerarquizados con base a la normativa del IMSS que permiten diferenciar el tipo y grado de la urgencia clasificando a los pacientes en cinco niveles. Cada nivel se representa mediante un color y un tiempo promedio de atención, que oscila entre la atención inmediata para los estados críticos y los 240 minutos para los estados no urgentes. Con base a esto determina el tipo, tiempo aproximado y destino de atención de paciente con base a la clasificación del TRIAGE y a los criterios de ingreso de la unidad médica.</p><br>				
                </div>
                <div class="col-sm-2"> </div>
            </div>
        </div>
        <div class="row">
            <img src="<?= base_url()?>asset_landing/images/triage.png" height="250" align=""><br><br><br>
        </div>

        <div class="container">
            <div class="title">
                <p style="font-size: 24px; font-weight: bold; text-align: center;">Desiciones</p>			
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?= base_url()?>asset_landing/images/radiografias.png" alt="" width="240" />
                    <p style="font-size: 24px; font-weight: bold; text-align: center; padding-top:30px;">Consultorios</p>
                    <p>Con base al algoritmo el tipo de TRIAGE y Especialidad  para que el paciente reciba atención en un consultorio con base a su clasificación (azul, verde, amarillo) y los criterios de ingreso.</p>
                </div>
                <div class="col-sm-4">
                    <img src="<?= base_url()?>asset_landing/images/silla de ruedas.png" alt="" width="240" />
                    <p style="font-size: 24px; font-weight: bold; text-align: center; padding-top:30px">Observación
                    </p>
                    <p>El Médico de TRIAGE determina que el paciente reciba atención en el área de observación un con base a su clasificación (amarillo) y los criterios de ingreso.</p> 
                </div>
                <div class="col-sm-4">
                    <img src="<?= base_url()?>asset_landing/images/camilla.png" alt="" width="240" />
                    <p style="font-size: 24px; font-weight: bold; text-align: center; padding-top:30px">Choque</p>
                    <p>El Médico de TRIAGE determina que el paciente reciba atención en el área de observación un con base a su clasificación (naranja, rojo) y los criterios de ingreso.</p> 
                </div>
            </div>
        </div>
        <div class="container-fluid wow fadeIn">
            <div id="screenshots-slider" class="owl-carousel">
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_093346.jpg" title="App Screen 1"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_093346.jpg" alt="screen1" width="300" /></a>
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_093335.jpg" title="App Screen 2"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_093335.jpg" alt="screen2" width="300" /></a>
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_093451.∫jpg" title="App Screen 3"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_093451.jpg" alt="screen1" width="300" /></a>
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_093023.jpg" title="App Screen 4"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_093023.jpg" alt="screen1" width="300" /></a>
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_092945.jpg" title="App Screen 5"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_092945.jpg" alt="screen1" width="300" /></a>
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_093144.jpg" title="App Screen 6"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_093144.jpg" alt="screen1" width="300" /></a>
                <a class="item" href="<?= base_url()?>asset_landing/images/IMG_20170314_092750.jpg" title="App Screen 7"><img src="<?= base_url()?>asset_landing/images/IMG_20170314_092750.jpg" alt="screen1" width="300" /></a>
            </div>
        </div>
    </section>
    <!-- MÉDICO TRIAGE END -->

    <!-- ASISTENTE MÉDICA TRIAGE -->
    <section>
        <div id="proceso_administrativo" class="container">
            <div class="title">
                <h2>Asistente Médica TRIAGE</h2>
                <div class="col-sm-2"> </div>
                <div class="col-sm-3">
                    <img src="<?= base_url()?>asset_landing/images/hora_cero.png" height="250">
                </div>
                <div class="col-md-5">
                    <br>
                    <p style="font-size: 24px; font-weight: bold;">Consulta de Vigencia	</p>
                    <p>Consulta el numero de seguro social y vegencia de dvigencia de derechos de derechos; a través de la plataforma  ACCEDER UNIFICADO  y a si continuar con el proceso de atención, en caso de que el paciente no cuente con vigencia y sea una urgencia sentida lo orienta ARIMAC para una búsqueda atrvés del SINDO.</p>
                </div>
                <div class="col-sm-2"> </div>
            </div>
        </div><br><br><br>
    </section>
    <!-- ASISTENTE MÉDICA TRIAGE END -->

    <!-- TAOD TRIAGE -->
    <section>
        <div class="container">
                <div class="title">
                    <h2>TAOD TRIAGE</h2>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-3">
                        <img src="<?= base_url()?>asset_landing/images/hora_cero.png" height="250">
                    </div>
                    <div class="col-md-5">
                        <br>
                        <p style="font-size: 24px; font-weight: bold;">Orientación en Sala de Espera</p>
                        <p>Sensibiliza al paciente en la fila de espera de Enfermería TRIAGE y orienta después de la clasificación del Médico de TRIAGE. Cuenta con la información de atención de las unidades de atención con base a los acuerdo de gestión con 1° y 2° Nivel de Atención. Realiza estudios de satisfacción de usuarios.</p><br>
                    </div>
                </div>
        </div><br><br><br>
    </section>
    <!-- TAOD TRIAGE END -->
    
    <!-- INICADORES -->
    <section id="indicadores">
        
        <div class="container">
            <div class="title">
                <h2>INDICADORES TRIAGE</h2>
                <div class="col-md-2">
                </div>
                <div class="col-md-4 grafica1 hidden">
                    <canvas id="graficaPorClasificacion"></canvas>
                </div>
                <div class="col-md-5 grafica1 hidden">
                    <div class="row" >
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss" style="border: 1px solid #256659;">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="yyyy-mm-dd form-control" name="FECHA_INICIO" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group m-b">
                                <span class="input-group-addon back-imss" style="border: 1px solid #256659;"> 
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="yyyy-mm-dd form-control" name="FECHA_FIN" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="graficar btn back-imss" >Graficar</div>
                        </div>
                    </div> 
                    <br><br>
                    <p style="font-size: 18px; font-weight: bold;text-transform: uppercase">Porcentaje de Pacientes clasificados por colores.</p>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                
                                <tr>
                                    <td><b>Azul:</b> <span id="AZUL"></span></td>
                                    <td><b>Verde: </b><span id="VERDE"></span></td>
                                    <td><b>Amarillo: </b><span id="AMARILLO"></span></td>
                                    <td><b>Naranja: </b> <span id="NARANJA"></span></td>
                                    <td><b>Rojo: </b><span id="ROJO"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right"><b>Tamaño de Muestra: </b><span class="result-tam-muestra"></span> <span class="load-tiempo-transcurrido hide"><i class="fa fa-spinner fa-spin"></i></span></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right"><b>Tiempo Promedico: </b><span class="result-tiempo-transcurrido"></span> <span class="load-tiempo-transcurrido hide"><i class="fa fa-spinner fa-spin"></i></span></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right"><b>Total: </b><span id="total_c"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>                           
                </div>
                <div class="col-md-1"> </div>
            </div>
        </div>
    </section>
    <!-- INDICADORES  END-->
    
    <!-- INNOVACION -->
    <section id="innovacion" class="bg-color2">
        <div class="container">
            <div class="title">
                <h2>Innovación Centrada en el Paciente</h2>
                <img src="<?= base_url()?>asset_landing/images/centrado_paciente.png" height="650">
            </div>
        </div>
    </section>
    <!-- INNOVACION END -->

    <!-- ARQUITECTURA -->
    <section id="trabajo">
        <div class="container">
            <div class="title">
                <h2>Innovación Centrada en el Paciente</h2>
                <img src="<?= base_url()?>asset_landing/images/arquitectura.png" height="650">
            </div>
        </div><br><br><br>
    </section>
<input type="hidden" name="CargarGrafica">
<?= Modules::run('Sections/Menu/FooterLanding'); ?> 