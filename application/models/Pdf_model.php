<?php 
if (!defined('BASEPATH'))exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

/**
 * @description: This is pdf model for creating pdf and keep into the system
 * @create date: 1-oct-2018
 **/
class Pdf_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	public function MakePdf($html,$path='assets/frontend/papers/', $filename = "") {
		$file_name = date("YmdHis");
		$filePath = $path.$file_name.'.pdf';
		$mpdf = new \Mpdf\Mpdf(['tempDir' => "assets/tempDir/"]);
		$mpdf->WriteHTML($html);
	  	if($filename) {
	  		$mpdf->Output($filename.'.pdf', 'F');
	  	}
	  	else {
			$mpdf->Output($filePath,'D');	//F D
	  	}
	    return $filePath;
	}    

	public function ViewPdf($html,$path='assets/frontend/papers/') {
		$file_name = date("YmdHis");
		$filePath = $path.$file_name.'.pdf';
		$mpdf = new \Mpdf\Mpdf(['tempDir' => "assets/tempDir/"]);
	 	$mpdf->WriteHTML($html);
    	$mpdf->Output();
	    return $filePath;
	}
}
