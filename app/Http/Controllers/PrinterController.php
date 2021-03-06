<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

use PDF;
use TCPDF;

class PrinterController extends TCPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    public function kitchenPdf($id)
    {


        $pdf = new PrinterController('l', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('');
        $pdf->SetSubject('');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);

// set header and footer fonts
//        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

// set font
        $pdf->SetFont('DejaVuSans', '', 10);

// add a page
        $pdf->AddPage();


// data loading
        $data = $pdf->LoadData($id);
        // column titles
        $header = array(
            '0' => 'Nazwa',
            '1' => 'Ilo????',
        );
// print info
        $pdf->Ln(6);
        $pdf->Write('0', 'Zam??wienie nr: '. $data->id);
        $pdf->Ln(6);
        $pdf->Write('0', 'Data dostawy: '. $data->delivery);
        $pdf->Ln(6);
        $pdf->Write('0', 'Klient :'. $data->customer_name);
        $pdf->Ln(6);
        $pdf->Write('0', 'Telefon :'. $data->customer_tel);
        $pdf->Ln(6);
        $pdf->Write('0', 'Uwagi :'. $data->comments);
        $pdf->Ln(6);
        if($data->dowoz == 1)
        {
            $pdf->Write('0', 'Dow??z do Klienta');
            $pdf->Ln(6);
        }else
        {
            $pdf->Write('0', 'Odbi??r osobisty');
            $pdf->Ln(6);
        }
// print colored table
        $pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
        $pdf->Output('example_011.pdf', 'I');
    }

    // Load table data from file
    public function LoadData($id) {
        $data = Order::find($id);
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
//        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(100, 25);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        $order = json_decode($data->order);

        foreach($order as $row) {
            $this->Cell($w[0], 6, $row->nazwa, 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row->quantity, 'LR', 0, 'C', $fill);
//            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
//            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
//            $this->Cell($w[4], 6, number_format($row[4]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
