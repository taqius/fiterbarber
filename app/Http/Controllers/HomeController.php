<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function toprint()
    {
        /* Open file */
        $tmpdir = sys_get_temp_dir();
        $file =  tempnam($tmpdir, 'cetak');

        /* Do some printing */
        $connector = new FilePrintConnector($file);
        $printer = new Printer($connector);
        /* Name of shop */
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Fiter Barber\n");
        $printer->selectPrintMode();
        $printer->text("Ngampel Kulon - Ngampel\n");
        $printer->text("Karangayu - Cepiring\n");
        $printer->feed();

        /* Title of receipt */
        $printer->setEmphasis(true);
        $printer->text("FITER BARBER INVOICE\n");
        $printer->setEmphasis(false);

        /* Information for the receipt */
        $items = array(
            new item("Example item #1", "10.000"),
            new item("Something else", "100.0000"),
        );
        $subtotal = new item('Subtotal', '12.95');
        $tax = new item('A local tax', '1.30');
        $total = new item('Total', '14.25', true);
        /* Date is kept the same for testing */
        // $date = date('l jS \of F Y h:i:s A');

        $date = gmdate('Y-m-d');


        /* Items */
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->setEmphasis(true);
        $printer->text(new item('', 'Rp.'));
        $printer->setEmphasis(false);
        foreach ($items as $item) {
            $printer->text($item);
        }
        $printer->setEmphasis(true);
        $printer->text($subtotal);
        $printer->setEmphasis(false);
        $printer->feed();

        /* Tax and total */
        $printer->text($tax);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text($total);
        $printer->selectPrintMode();

        /* Footer */
        $printer->feed(2);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Fiter Barber\n");
        $printer->text("Tampan dan Berani\n");
        $printer->feed(2);
        $printer->text($date . "\n");

        /* Cut the receipt and open the cash drawer */
        $printer->cut();
        $printer->pulse();

        $printer->close();

        /* Copy it over to the printer */
        copy($file, "//localhost/Gudang2");
        unlink($file);
    }
}
