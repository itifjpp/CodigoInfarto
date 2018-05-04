<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menus_mdl
 *
 * @author felipe de jesus
 */
class Menus_mdl extends CI_Model{
    
    public function _get_menu_n1() {
        return $this->db
                ->get('menu_1')
                ->result_array();
    }
    public function _get_roles() {
        return $this->db
                ->get('tipo_usuario')
                ->result_array();
    }
    public function _insert($table,$data) {
        return $this->db->insert($table,$data);
    }
    public function _get_menus($table,$condicion) {
        return $this->db->get_where($table,$condicion)->result_array();
    }
    public function _update_menus($table,$data,$condicion) {
        return $this->db->update($table,$data,$condicion);
    }
    public function _delete_menus($table,$condicion) {
        return $this->db->delete($table,$condicion);
    }   
    public function _delete_mn1_rol($menu,$rol) {
        return $this->db
                ->where('id_menu',$menu)
                ->where('id_tipoUsuario',$rol)
                ->delete('tipo_usuario_menu');
    }
    public function _get_mn1_rol($id) {
        return $this->db
                ->where('menu_1.menuN1_id=menu_1_area.menuN1_id')
                ->where('sigh_areasacceso.areas_acceso_id=menu_1_area.areas_acceso_id')
                ->where('menu_1.menuN1_id',$id)
                ->get('menu_1, sigh_areasacceso, menu_1_area')
                ->result_array();
    }
    public function _get_menuN2($menu) {
        return $this->db
                ->where('menu_1.menuN1_id=menu_2.menuN1_id')
                ->where('menu_1.menuN1_id',$menu)
                ->get('menu_1, menu_2')
                ->result_array();
    }
    public function _get_menuN3($menu) {
        return $this->db
                ->where('menu_2.menuN2_id=menu_3.menuN2_id')
                ->where('menu_2.menuN2_id',$menu)
                ->get('menu_2, menu_3')
                ->result_array();
    }
}
