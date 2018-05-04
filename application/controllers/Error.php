<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error404
 *
 * @author bienTICS
 */
class Error extends MX_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('error_404');
    }
}
