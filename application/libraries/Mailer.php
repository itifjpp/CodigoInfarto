<?php  defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/phpmailer/PHPMailerAutoload.php';

class Mailer {

   private $ci;

   public $mail;
   
   public $error;
   
   public $confimar = 'umae.magdalena@gmail.com';

   public function __construct() {
      // $this->ci = &get_instance();
      // !$this->ci->load->library('database') ? $this->ci->load->library('database') : FALSE;
      // !$this->ci->load->helper('array') ? $this->ci->load->helper('array') : FALSE;
      $this->mail = new PHPMailer();
   }

   public function init($config) {
      if (is_array($config) and $this->validArray($config)) {
         if (isset($config['username']) and !empty($config['username'])) {
            $this->mail->Username = $config['username'];
            $this->mail->From = $config['username'];
         }
         if (isset($config['password']) and !empty($config['password'])) {
            $this->mail->Password = $config['password'];
         }
         if (isset($config['gmail']) and !empty($config['gmail'])) {
            $this->mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $this->mail->IsSMTP();
            $this->mail->SMTPAuth = TRUE;
            $this->mail->Host = 'tls://smtp.gmail.com:587';
         }
         if (isset($config['port']) and !empty($config['port'])) {
            $this->mail->Port = $config['port'];
         }
         if (isset($config['smtp']) and !empty($config['smtp'])) {
            $this->mail->IsSMTP();
         }
         if (isset($config['smtpauth']) and !empty($config['smtpauth'])) {
            $this->mail->SMTPAuth = TRUE;
         }
         if (isset($config['fromName']) and !empty($config['fromName'])) {
            $this->mail->FromName = $config['fromName'];
         }
         if (isset($config['confirmar']) and !empty($config['confirmar'])) {
            if ($config['confirmar'] and !is_string($config['confirmar'])) {
               $this->mail->ConfirmReadingTo = $this->confimar;
            }
         }
      }
   }

   public function doSend() {
      if(!$this->mail->send()) {
         $this->error = $this->mail->ErrorInfo;
      }
      else {
         return TRUE;
      }
   }

   public function sendEmailToProveedor($emailProveedor,$body,$subject='Reabastecimiento de materiales') {
      $this->mail->AddAddress($emailProveedor);
      $this->mail->Subject = $subject;
      $this->mail->Body    = $body;
      $this->mail->IsHTML(TRUE);
      $this->mail->CharSet = 'utf-8';
      $enviado = $this->doSend();
      $this->mail->ClearAddresses();
      return $enviado;
   }
   public function emailConstancia($emailProveedor,$body,$subject='Generación de Constancia') {
      $this->mail->AddAddress($emailProveedor);
      $this->mail->Subject = $subject;
      $this->mail->Body    = $body;
      $this->mail->IsHTML(TRUE);
      $this->mail->CharSet = 'utf-8';
      $enviado = $this->doSend();
      $this->mail->ClearAddresses();
      return $enviado;
   }
   private function validArray($array) {
      return (isset($array) and !empty($array));
   }

}

/* End of file Mailer.php */
/* Location: ./application/libraries/Mailer.php */ 