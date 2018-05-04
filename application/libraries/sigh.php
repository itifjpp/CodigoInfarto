<?php

/**
 * Description of sigh
 *
 * @author felipe de jesus <itifjpp@gmail.com>
 */
class sigh {
    private $ci;
    //put your code here
    public function __construct() {
        $this->ci =& get_instance();
        $this->HospitalConfiguracion();
    }
    public function getInfo($key){
        $sql=$this->ci->db->query("SELECT * FROM sigh_hospitales h, sigh_hospitales_equipos AS e WHERE h.hospital_id=e.hospital_id AND e.equipo_ip='".$_SERVER['REMOTE_ADDR']."'")->result_array()[0];
        return $sql[$key];
    }
    public function getEquipoIp() {
        return $_SERVER['REMOTE_ADDR'];
    }
    public function tbl($key) {
        $array=array(
            'sigh_accesos'=>'sigh_accesos',
            'sigh_hospitales'=>'sigh_hospitales',
            'sigh_hospitales_equipos'=>'sigh_hospitales_equipos',
            'sigh_hospitales_status'=>'sigh_hospitales_status',
            'sigh_ingresos'=>'sigh_ingresos',
            'sigh_pacientes'=>'sigh_pacientes',
            'sigh_pacientes'=>'sigh_pacientes',
            'sigh_pacientes_cla_ing'=>'sigh_pacientes_cla_ing',
            'sigh_pacientes_directorios'=>'sigh_pacientes_directorios',
            'sigh_pacientes_empresas'=> 'sigh_pacientes_empresas',
            'sigh_pacientes_info_ing'=> 'sigh_pacientes_info_ing',
            'sigh_hospitales_equipos'=>'sigh_hospitales_equipos'
        );
        return $array[$key];
    }
    public function HospitalConfiguracion() {
        define("SIGH_VALIDAR_VIGENCIA", 'No');
        //define('SIGH_OBSERVACION_ENFERMERIA', "No");
    }
}
