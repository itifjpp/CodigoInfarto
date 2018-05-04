<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>SiGH - <?=$this->sigh->getInfo('hospital_clasificacion')?> <?=$this->sigh->getInfo('hospital_tipo')?> <?=$this->sigh->getInfo('hospital_nombre')?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Sistema de Gestión Hospitalaria v2.0" name="description" />
        <meta content="bienTICS" name="author" />
        <!-- BEGIN PLUGIN CSS -->

        <?php foreach ($css as $value) {?>
        <link href="<?=base_url()?>assetsv2/<?=$value?>" rel="stylesheet" type="text/css" />
        <?php }?>
        <link href="<?= base_url()?>assetsv2/plugins/material-iconfont/material-icons.css" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        
        <link href="<?=base_url()?>assetsv2/webarch/css/sigh.css" rel="stylesheet" type="text/css" />
        <link href="<?=  base_url()?>assets/img/<?=$this->sigh->getInfo('hospital_logo')?>" rel="icon" type="image/png">
        <style>
            .sigh-color{
                color:<?=$this->sigh->getInfo('hospital_color')?>!important; 
            }
            .sigh-background-primary{
                color:white!important;
                background: <?=$this->sigh->getInfo('hospital_back_primary')?>!important; 
            }
            .sigh-background-secundary{
                background: <?=$this->sigh->getInfo('hospital_back_secundary')?>!important; 
                color:white!important;
            }
            .modal-header{
                color: white!important;
                background: <?=$this->sigh->getInfo('hospital_back_secundary')?>!important;
                border-radius: 8px 8px 0px 0px;
            }
            .table-no-padding td, th{
                padding: 10px!important;
            }
            .table-no-padding th{
                border:1px solid #ddd!important;
                border-color: #E5E9EC !important;
                color: #64696A!important;
                background-color: #E5E9EC!important;
            }
            .table-sigh td, th{
                padding: 10px!important;
            }
            .table-sigh th{
                border:1px solid #256659!important;
                border-color: #256659 !important;
                color: white!important;
                background-color: #256659!important;
            }
        </style>
        <!-- END CORE CSS FRAMEWORK -->
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="error-body no-top">
        <div class="container" >