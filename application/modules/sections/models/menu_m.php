<?php  defined('BASEPATH') OR exit('No direct script access allowed');
 
class Menu_m extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

   public function getNotificacionesFromDepar($destinatario,$limit='5') {
      return $this->db
         ->order_by('id','DESC')
         ->limit($limit)
         ->get_where('notificacionesdepartamentos',['destinatario'=>$destinatario])
         ->result_array();
   }

   public function getIdDepartemento($idUsuario) {
      return $this->db
         ->select(format_select([
            'departamento.idDepartamento' => 'idDepartamento'
         ]))
         ->join('departamento','departamento.idDepartamento = tipo_usuario.idDepartamento')
         ->join('usuario','usuario.idTipo_Usuario = tipo_usuario.idTipo_Usuario AND usuario.idUsuario = "'.$idUsuario.'" ')
         ->get('tipo_usuario')
         ->result_array();
   }

	public function get_menus($status=false,$id_rol=false){
		if ($status and $id_rol) {
			return $this->db
				->select('menu_1.*, tipo_usuario_menu.id_menu')
				->join('tipo_usuario_menu','tipo_usuario_menu.id_menu = menu_1.menuN1_id AND menu_1.menuN1_status="'.$status.'" AND tipo_usuario_menu.id_tipoUsuario = "'.$id_rol.'"')
				->get('menu_1')
				->result_array();
		}
		else {
			return false;
		}
	}

	public function get_info_usuario($id_usuario=false) {
		if ($id_usuario) {
			return $this->db
				->join('empleado','usuario.idEmpleado = empleado.idEmpleado AND usuario.idUsuario = "'.$id_usuario.'"')
				->get('usuario')
				->result_array();
		} 
		else {
			return false;
		}
	}
        public function _get_menuN1($area) {
        return $this->db
                ->where('menu_1.menuN1_id=menu_1_area.menuN1_id')
                ->where('menu_1_area.areas_acceso_id=sigh_areasacceso.areas_acceso_id')
                ->where('sigh_areasacceso.areas_acceso_nombre',$area)
                ->order_by('menu_1.menuN1_id','DESC')
                ->get('menu_1, sigh_areasacceso, menu_1_area')
                ->result_array();
        }
        public function _get_menuN2($menu) {
            return $this->db
                    ->where('menu_1.menuN1_id=menu_2.menuN1_id')
                    ->where('menu_2.menuN2_status','1')
                    ->where('menu_1.menuN1_id',$menu)
                    ->get('menu_1, menu_2')
                    ->result_array();
        }
        public function _get_menuN3($menu) {
            return $this->db
                    ->where('menu_2.menuN2_id=menu_3.menuN2_id')
                    ->where('menu_3.menuN3_status','1')
                    ->where('menu_2.menuN2_id',$menu)
                    ->get('menu_2, menu_3')
                    ->result_array();
        }

}