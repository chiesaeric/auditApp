<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Dompdf\Dompdf;
use Dompdf\Options;



class ReportController extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('/report/pdf_view'));
        $dompdf->setPaper('A4', 'potrait');
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsPhpEnabled(true);
        $dompdf->setOptions($options);
        $dompdf->render();
        $dompdf->stream();
        //return view('/report/pdf_view');
    }

    function htmlToPDF()
    {
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('pdf_view'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
