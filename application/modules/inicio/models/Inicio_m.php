<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inicio_m
 *
 * @author felipe de jesus
 */
class Inicio_m extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function obtenerUser() {
        $sql=  $this->db->query("SELECT * FROM usuario");
        return $sql;
    }
    public function _BuscarPorNombre($nombre) {
        return $this->db->query("SELECT * FROM os_triage WHERE triage_nombre  LIKE '%$nombre%' LIMIT 10")->result_array();
    }
}
