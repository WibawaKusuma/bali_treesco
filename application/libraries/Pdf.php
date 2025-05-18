<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Pastikan path ke autoload.inc.php sesuai dengan struktur folder Anda
require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        parent::__construct($options);
    }
}
