<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
  public function index(){
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'nugrahaarsil@gmail.com',
      'smtp_pass' => '*****',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1'
    );
      $this->load->library('email',$config);
      $this->email->set_newline("\r\n");
      $this->email->from('nugrahaarsil@gmail.com','Aflah');
      $this->email->to('aflahmutsannipulungan@gmail.com');
      $this->email->subject('test email');
      $this->email->message('Tes Ya');

      if($this->email->send()) {
        echo 'Email berhasil dikirim';
   }
   else {
        echo 'Email tidak berhasil dikirim';
        echo '<br />';
        echo $this->email->print_debugger();
   }
  }
}
