<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once APPPATH."/third_party/PHPExcel/PHPExcel.php";

class Excel extends PHPExcel {
    
   function __construct() {
      parent::__construct();
   }

}