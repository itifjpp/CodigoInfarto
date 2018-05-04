<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notificaciones_m extends CI_Model {

   public function getNotificacionesByDeparNoVisto($idUsuario) {
      return $this->db
         ->join('tipo_usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND usuario.idUsuario = "'.$idUsuario.'"')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('notificacionesdepartamentos','notificacionesdepartamentos.destinatario = departamento.idDepartamento AND notificacionesdepartamentos.visto = "0"')
         ->order_by('notificacionesdepartamentos.fecha','DESC')
         ->get('usuario')
         ->result_array();
   }

   /**
    * [getIdDepartemento SELECT * FROM usuario
    * JOIN tipo_usuario
    * ON usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario
    * AND usuario.idUsuario = '1'
    * JOIN departamento
    * ON departamento.idDepartamento = tipo_usuario.idDepartamento]
    * @param  [string] $idUsuario [ID usuario]
    * @return [array]             [Resultados]
    */      
   public function getNotificacionesByDepar($idUsuario) {
      return $this->db
         // ->select(format_select([
         //    'departamento.idDepartamento' => 'idDepartamento'
         // ]))
         ->join('tipo_usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND usuario.idUsuario = "'.$idUsuario.'"')
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('notificacionesdepartamentos','notificacionesdepartamentos.destinatario = departamento.idDepartamento')
         ->order_by('notificacionesdepartamentos.fecha','DESC')
         ->get('usuario')
         ->result_array();
   }

}

/* End of file Notificaciones_m.php */
/* Location: ./application/modules/inicio/models/Notificaciones_m.php */