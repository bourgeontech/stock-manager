<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

class Dpdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A6', $orientation='landscape'){
    	// $html   = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new Dompdf();
    	// Set font directory path
    $fontDir = APPPATH . 'libraries/dompdf/vendor/dompdf/dompdf/lib/fonts/';

    // Set font
    $defaultFont = 'Latha';
    $dompdf->set_option('defaultFont', $defaultFont);
    	$html = '<style>
                @page { margin:0; } /* top/bottom 20mm, left/right 10mm */
                body { margin: 0; } /* Remove default body margin/padding */
            </style>' . $html;

        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }

	function createCustomPDF($html, $filename='', $download=TRUE, $paper, $orientation){
    	// $html   = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new Dompdf();
    	// Set font directory path
    $fontDir = APPPATH . 'libraries/dompdf/vendor/dompdf/dompdf/lib/fonts/';

    // Set font
    $defaultFont = 'Latha';
    $dompdf->set_option('defaultFont', $defaultFont);
    	$html = '<style>
                @page { margin:0; } /* top/bottom 20mm, left/right 10mm */
                body { margin: 0; } /* Remove default body margin/padding */
            </style>' . $html;

        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }

	function kaladyCustomPdf($html_content, $filename='', $download=TRUE, $paper, $orientation) {
//     	$options = new Options();
//         $options->set('isPhpEnabled', true);
//     	$options->set('isHtml5ParserEnabled', true);
//     	$options->set('isRemoteEnabled', true);
//     	$options->set('debugPng', true);
// $options->set('debugKeepTemp', true);
// $options->set('debugCss', true);
// $options->set('debugLayout', true);
// $options->set('debugLayoutLines', true);
// $options->set('debugLayoutBlocks', true);
// $options->set('debugLayoutInline', true);
// $options->set('debugLayoutPaddingBox', true);
    
//         $dompdf = new Dompdf($options);
//         $dompdf->loadHtml($html_content);
//         $dompdf->setPaper('A4', 'portrait');
//         $dompdf->render();
// 		// $dompdf->stream('document.pdf', ["Attachment" => false]);
//     	$pdf_content = $dompdf->output();
    	$bill_id = 264;
//     	$pdf_file_path = FCPATH . 'uploads/' . $bill_id . '_confirmation.pdf';
//         file_put_contents($pdf_file_path, $pdf_content);
    	// print_r($html_content); exit;
		$dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        // $dompdf->stream("kalady_bill.pdf", array("Attachment" => 0));
        $pdf_content = $dompdf->output();
    	$pdf_file_path = FCPATH . 'uploads/' . $bill_id . '_confirmation.pdf';
    	file_put_contents($pdf_file_path, $pdf_content);
    
    	return $pdf_file_path;
    }
}
?>
