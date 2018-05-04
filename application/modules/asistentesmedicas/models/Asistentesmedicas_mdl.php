<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asistentesmedicas_mdl
 *
 * @author felipe de jesus
 */
class Asistentesmedicas_mdl extends CI_Model{
    public function filtro_am($by,$campo,$fecha) {
        return $this->db
                ->where('os_triage.triage_id =os_triage_cortes_am.triage_id')
                ->where('os_triage_cortes_am.cortes_am_fecha',$fecha)
                ->like($by,$campo)
                ->order_by('os_triage_cortes_am.cortes_am_id','DESC')
                ->get('os_triage, os_triage_cortes_am')
                ->result_array();
    }
}
