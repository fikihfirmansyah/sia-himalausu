<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

class Mypdf
{
  protected $ci;

  public function __construct()
  {
        $this->ci =& get_instance();
  }

  public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation='portrait')
  {
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $options->set('isHtml5ParserEnabled', TRUE);
    $options->setIsRemoteEnabled(true);
    $dompdf = new Dompdf($options);
    $html = $this->ci->load->view($view, $data, TRUE);
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    // Render the HTML as PDF
    $dompdf->render();
    $dompdf->stream( $filename . ".pdf", array("Attachment" => FALSE));

  }

}

/* End of file Mypdf.php */
/* Location: ./application/libraries/Mypdf.php */
