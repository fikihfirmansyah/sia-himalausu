<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donatur extends CI_Controller {
  public function index(){
    redirect('landingpage/keu_donatur/register');
  }
  public function register(){
    $this->load->view('landingpage/keu_donatur/register');
  }

}
