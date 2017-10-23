<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party//tcpdf//tcpdf.php";

class Pdf_detalle_pago extends TCPDF {

    public $data_header=array();


    public function __construct() {
        parent::__construct();
    }

    public function setDataHeader($input){
        $this->data_header = $input;
    }


    public function Header() {

 

    }

    // Page footer
    public function Footer() {


        $style2 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $this->Line(85, 262.5, 130, 262.5, $style2);
        $this->SetFont('helvetica', '', 8);


       $style = array(
            'border' => false,
            'padding' => 0,
            'fgcolor' => array(0,0,0),
            'bgcolor' => false
        );
        $this->write2DBarcode($this->data_header['hash'], 'QRCODE,H', 240, 150, 25, 25, $style, 'N');
    
    }
}
