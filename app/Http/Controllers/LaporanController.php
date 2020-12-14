<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pegawai;
use App\Models\Transaksi;
use Cron\MonthField;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        $pegawai = Pegawai::all();
        return view('admin.laporan', compact('transaksi', 'pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function bulan($tgl)
    {

        $arraybulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        return $arraybulan[$tgl];
    }
    public function searchbulan(Request $request, $tgl, $tahun, $nama, $ket)
    {
        $hasil['total'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('nama', $nama)->where('keterangan', $ket)->get()->sum('total');
        $hasil['totaljumlah'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('nama', $nama)->where('keterangan', $ket)->get()->sum('jumlah');

        $hasil['bulan'] = $this->bulan($tgl);
        return response()->json($hasil);
    }

    public function print(Request $request)
    {
        //request data
        $nama = $request->pilnama;
        $bulan = $this->bulan($request->month);
        $tahun = $request->tahun;
        $totalpotong = Transaksi::whereMonth('tanggal', $request->month)->whereYear('tanggal', $request->tahun)->where('nama', $nama)->where('keterangan', $request->ket)->get()->sum('jumlah');

        /* Open file */
        $tmpdir = sys_get_temp_dir();
        $file =  tempnam($tmpdir, 'cetak');

        /* Do some printing */
        $connector = new FilePrintConnector($file);
        $printer = new Printer($connector);

        /* Print Logo */

        // $img = EscposImage::load(asset('images/logo_fiter_tok.png'));
        // $printer->graphics($img, false);
        /* Name of shop */
        $printer->selectPrintMode(Printer::MODE_EMPHASIZED);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Fiter Barber\n");
        $printer->selectPrintMode();
        $printer->text("Ngampel Kulon - Ngampel\n");
        $printer->text("Karangayu - Cepiring\n");
        // $printer->text($nama . "\n");
        $printer->feed();

        /* Title of receipt */
        $printer->setEmphasis(true);
        $printer->text("FITER BARBER INVOICE\n");
        $printer->setEmphasis(false);

        /* Information for the receipt */
        $items = array(
            new item("Nama", $nama),
            new item("Bulan", $bulan . "," . $tahun),
        );
        $subtotal = new item('Total Potong', $totalpotong);
        // $tax = new item('A local tax', '1.30');
        // $total = new item('Total', '14.25', true);
        /* Date is kept the same for testing */
        // $date = date('l jS \of F Y h:i:s A');

        $date = gmdate('Y-m-d');


        /* Items */
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        // $printer->setEmphasis(true);
        // $printer->text(new item('', '')); //Rp
        // $printer->setEmphasis(false);
        foreach ($items as $item) {
            $printer->text($item);
        }
        $printer->setEmphasis(true);
        $printer->text($subtotal);
        $printer->setEmphasis(false);
        $printer->feed();

        /* Tax and total */
        // $printer->text($tax);
        // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        // $printer->text($total);
        // $printer->selectPrintMode();

        /* Footer */
        $printer->feed();
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Fiter Barber\n");
        // $printer->text("Tampan dan Berani\n");
        $printer->feed();
        $printer->text($date . "\n");

        /* Cut the receipt and open the cash drawer */
        $printer->cut();
        $printer->pulse();

        $printer->close();

        /* Copy it over to the printer */
        copy($file, "//localhost/EPSONTU");
        unlink($file);
        return redirect('/laporan');
    }
}
