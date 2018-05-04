<?php

/**
 * Description of Camas
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
include_once APPPATH.'modules/config/controllers/Config.php';
class Camas extends Config{
    public function index() {
        $this->load->view('Camas/index');
    }
    public function AjaxCamasLimpieza() {
        $sql= $this->config_mdl->sqlQuery("SELECT c.cama_nombre, c.cama_fh_estatus, a.area_nombre,a.area_modulo FROM os_camas AS c, os_areas AS a WHERE 
                                            c.area_id=a.area_id AND
                                            c.cama_status='En Limpieza'");
        $Camas='';
        foreach ($sql as $value) {
            $TT='';
            if($value['cama_fh_estatus']!=''){
                $Tiempo= $this->CalcularTiempoTranscurrido(array(
                    'Tiempo1'=>$value['cama_fh_estatus'],
                    'Tiempo2'=> date('Y-m-d H:i:s') 
                ));  
                $TT=$Tiempo->d.' Días '.$Tiempo->h.' Hrs '.$Tiempo->i.' Min';
            }else{
                $TT='Sin Especificar';
            }
            $Camas.='<div class="col-md-4 cols-camas" >
                        <div class="card orange color-white" style="border-radius:3px">
                            <div class="row" style="    background: #256659!important;padding: 4px 2px 2px 12px;width: 100%;margin-left: 0px;">
                                <div class="col-md-12" "><b style="text-transform:uppercase;font-size:10px;margin-left:-14px"><i class="fa fa-window-restore"></i> '.$value['area_nombre'].'</b></div>
                            </div>
                            <div class="card-heading" style="margin-top:-10px">
                                <h5 class="font-thin color-white" style="font-size:12px!important;margin-left: -10px;margin-top: 0px;text-transform: uppercase">
                                    <div class="row">
                                        <div class="col-md-6"><i class="fa fa-bed " ></i> <b>'.$value['cama_nombre'].'</b></div>
                                        <div class="col-md-6 text-right" style="padding-left:0px">'.$TT.'</div>
                                    </div>
                                        
                                    
                                </h5>
                                <div class="row">
                                    <div class="col-md-12" style="margin-left: -10px;margin-top:-9px">
                                        <small style="opacity: 1;font-size: 10px"> 
                                            <h6 class="text-left"><i class="fa fa-clock-o"></i> '.($value['cama_fh_estatus']=='' ? 'SIN ESPECIFICAR':$value['cama_fh_estatus']).'</h6>
                                            <h6 class="text-left" style="margin-bottom: -12px;text-transform:uppercase"><i class="fa fa-window-maximize"></i> '.$value['area_modulo'].'</h6>&nbsp;&nbsp;&nbsp;
                                        </small>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-tools" style="right:2px;top:2px"></div>
                        </div>
                    </div>';
        }
        $this->setOutput(array('Camas'=>$Camas));
    }
}
