<?= modules::run('Sections/Menu/loadHeader'); ?>
<div class="page-content">
    <div class="content">
        <ol class="breadcrumb" style="margin-top: -10px">
            <li><a href="#">Inicio</a></li>
            <li><a href="<?=  base_url()?>Sections/Usuarios">Usuarios</a></li>
            <li><a href="#">Carpeta de Documentos</a></li>
        </ol>
        <div class="row m-t-10">
            <div class="col-md-8 col-centered">
                <div class="grid simple">
                    <div class="grid-title sigh-background-secundary">
                        <h4 class="color-white no-margin" style="font-weight: 300">CARPETA DE DOCUMENTOS</h4>
                    </div>
                    <div class="grid-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-no-padding footable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">N°</th>
                                            <th style="width: 80%">DOCUMENTO</th>
                                            <th style="width: 10%">ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($info['empleado_roles']=='82'){?>
                                        <tr>
                                            <td>1</td>
                                            <td>FICHA DE INGRESO PARA MÉDICO RESIDENTE</td>
                                            <td>
                                                <i class="material-icons i-20 color-sigh pointer" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/FichaMedicoResidente?emp=<?=$_GET['emp']?>','FICHA INGRESO MEDICO RESIDENTES',400)">picture_as_pdf</i>
                                            </td>
                                        </tr>
                                        <?php }else{?>
                                        <tr>
                                            <td>1</td>
                                            <td>FICHA DE INGRESO PARA MÉDICO INTERNO</td>
                                            <td>
                                                <i class="material-icons i-20 color-sigh pointer" onclick="AbrirDocumentoMultiple(base_url+'Inicio/Documentos/FichaMedicoInterno?emp=<?=$_GET['emp']?>','FICHA INGRESO MEDICO INTERNOS',400)">picture_as_pdf</i>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>

<?= modules::run('Sections/Menu/loadFooter'); ?>
<script src="<?= base_url()?>assets/js/Usuarios.js?<?= md5(microtime())?>" type="text/javascript"></script> 
