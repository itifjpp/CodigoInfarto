<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario {
   
   private $ci;

   public function __construct() {
      //$this->ci =& get_instance();
      // !$this->ci->load->library('session') ? $this->ci->load->library('session') : FALSE;
   }

   public function getInfoEmpleado($idUsuario='',$idEmpleado='') {
//      if ($idUsuario != '' && $idEmpleado =='') {
//         
//      }
//      else if ($idEmpleado == '' && $idUsuario == '') {
//         $idUsuario = $this->ci->session->sess['idUsuario'];
//         $resultado = $this->ci->db
//            ->select('empleado.*, usuario.idUsuario')
//            ->join('empleado','usuario.idEmpleado = empleado.idEmpleado AND empleado.status = "1"')
//            ->get('usuario')
//            ->result_array();
//         if (!empty($resultado)) {
//            return $resultado[0];
//         }
//         else {
//            return FALSE;
//         }
//      }
//      else if ($idUsuario == '' && $idEmpleado != '') {
//         $resultado = $this->ci->db
//            ->group_start()
//               ->where(['idEmpleado'=>$idEmpleado])
//               ->or_where(['matricula'=>$idEmpleado])
//            ->group_end()
//            ->where(['status'=>'1'])
//            ->get('empleado')
//            ->result_array();
//         if (!empty($resultado)) {
//            return $resultado[0];
//         }
//         else {
//            return FALSE;
//         }
//      }
   }

}
/* End of file Usuario.php */
/* Location: ./application/libraries/Usuario.php */