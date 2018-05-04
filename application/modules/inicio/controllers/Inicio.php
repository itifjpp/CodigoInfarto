<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'modules/config/controllers/Config.php';
    class Inicio extends Config {
      
    public function __construct() {
        parent::__construct();
        $this->load->model('Inicio_m');
    }
    public function index() {
        $sql['Hospital']= $this->config_mdl->sqlGetDataCondition('sigh_hospitales',array(
            'hospital_id'=> $this->sigh->getInfo('hospital_id'),
            'hospital_nivel'=>'Principal'
        ))[0];
        $sql['Normativas']= $this->UltimasNormativas();
        $sql['Noticias']= $this->UltimasNoticias();
        $this->load->view('index',$sql);
    }
    public function UltimasNormativas() {
        $Area= $this->config_mdl->sqlGetDataCondition('sigh_areasacceso',array(
            'areas_acceso_nombre'=> $this->UMAE_AREA
        ))[0];
        return $this->config_mdl->sqlQuery("SELECT * FROM sigh_areasacceso AS acc, sigh_normativas_areas AS na, sigh_normativas AS norma
                                            WHERE 
                                            na.normativa_id=norma.normativa_id AND
                                            na.area_id=acc.areas_acceso_id AND 
                                            acc.areas_acceso_id=".$Area['areas_acceso_id']." ORDER BY norma.normativa_id DESC LIMIT 2");
    }
    public function UltimasNoticias() {
        return $this->config_mdl->sqlQuery("SELECT noti.*, em.empleado_nombre, em.empleado_ap,em.empleado_am  FROM sigh_noticias AS noti, sigh_empleados AS em
                                            WHERE noti.empleado_id=em.empleado_id AND noti.noticia_status='Publicado' ORDER BY noticia_id DESC LIMIT 3");
    }
    public function notificaciones_total() {
       $this->setOutput(array('total'=>0));
    }
    public function AvisoLegal() {
        $this->load->view('AvisoLegal');
    }
    public function Privacidad() {
        $this->load->view('Privacidad');
    }
}