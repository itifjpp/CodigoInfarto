<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Limpiezacamas
 *
 * @author felipe de jesus
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Limpiezacamas extends Config{
    
    public function index() {
        $sql['Gestion']=  $this->config_mdl->_get_data('os_areas');
        $this->load->view('limpieza_camas/index',$sql);
    }
    public function CamasAreas() {
        $Camas=  $this->config_mdl->_query("SELECT * FROM os_camas WHERE os_camas.area_id=".$this->input->post('area'));
        if(!empty($Camas)){
            foreach ($Camas as $value) {
                if($value["cama_status"]=="Disponible"){
                    $color='blue';
                    $list=  '<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="En Limpieza">En Limpieza</a></li><li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'"  data-id="'.$value['cama_id'].'" data-accion="En Mantenimiento">En Mantenimiento</a></li>' ;
                }if($value["cama_status"]=="Ocupado"){
                    $color='green';
                    $list='<li><a href="#">Ocupado</a></li>';
                }if($value["cama_status"]=="En Mantenimiento"){
                    $color='red';
                    $list='<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="Disponible" >Finalizar Mantenimiento</a></li>';
                }if($value["cama_status"]=="En Limpieza"){
                    $color='orange';
                    $list='<li><a href="#" class="dar-mantenimiento" data-area="'.$value['area_id'].'" data-id="'.$value['cama_id'].'" data-accion="Disponible">Finalizar Limpieza</a></li>';
                }
                $col_md_3.='<div class="col-md-4 cols-camas" style="padding: 3px;">
                                    <div class="card '.$color.' color-white">
                                        <div class="card-heading" >
                                            <h2 class="font-thin color-white" style="font-size:30px!important"><i class="fa fa-bed " ></i> '.$value['cama_nombre'].'</h2>
                                            <small style="opacity: 1"> <i class="fa fa-clock-o"></i> '.$value['cama_status'].'</small>
                                        </div>
                                        <div class="card-tools">
                                            <ul class="list-inline">
                                                <li class="dropdown">
                                                    <a md-ink-ripple="" data-toggle="dropdown" class="md-btn md-flat md-btn-circle waves-effect" aria-expanded="false">
                                                        <i class="mdi-navigation-more-vert text-md"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-scale pull-right pull-up top text-color">'.$list.'</ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-divider" style="margin-top:-10px"></div>
                                        <div class="card-body" style="margin-top:-20px"></div>
                                    </div>
                                </div>';
                $col_md_3.='';
            }
            
        
        }else{
            $col_md_3='NO_HAY_CAMAS';
        }
        $this->setOutput(array('result_camas'=>$col_md_3));
    }
}
