<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Login extends CI_Model
{
	public function cek_login($tabel,$where)
	{
		return $this->db->get_where($tabel,$where);
	}

  public function usr_by_nim($nim)
  {
    $data = "SELECT * FROM one_admin WHERE nim = '$nim'";
		return $this->db->query($data)->result();
  }

}
