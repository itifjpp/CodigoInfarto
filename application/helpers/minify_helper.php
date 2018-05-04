<?php defined('BASEPATH') OR exit('No direct script access allowed');

   if (!function_exists('minify')) {
      /**
       * [minify Función para minificar JS y CSS]
       * @param  array  $assets_js  [Todos los JS]
       * @param  array  $assets_css [Todos los CSS]
       * @param  boolean $dev       [Poner en FALSE cuando ya esta en producción]
       * @param  array $config      [css_dir = dirección de CSS / js_dir = dirección de JS]
       * @return [array]            [Archivos ya minificados]
       */
      function minify($assets_js='',$assets_css='',$dev=FALSE,$config='') {
         $ci =& get_instance();
         $ci->load->library('minify');
         $ci->minify->auto_names = TRUE;
         if (is_array($config)) {
            if (isset($config['css_dir']) and !empty($config['css_dir'])) {
               $ci->minify->css_dir = $config['css_dir'];
            }
            else {
               $ci->minify->css_dir = 'assets/css';  
            }
            if (isset($config['js_dir']) and !empty($config['js_dir'])) {
               $ci->minify->js_dir = $config['js_dir'];
            }
            else {
               $ci->minify->js_dir = 'assets/js';
            }
         }
         else {
            $ci->minify->css_dir = 'assets/css';
            $ci->minify->js_dir  = 'assets/js';
         }
         if (is_array($assets_js)) {
            $ci->minify->js($assets_js);  
         }
         if (is_array($assets_css)) {
            $ci->minify->css($assets_css);
         }
         return array(
            'js'  => (is_array($assets_js)) ? $ci->minify->deploy_js($dev) : false,
            'css' => (is_array($assets_css)) ? $ci->minify->deploy_css($dev) : false
         );
      }
   }

/* End of file minify.php */
/* Location: ./application/helpers/minify.php */