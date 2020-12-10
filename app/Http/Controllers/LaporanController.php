<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pegawai;
use App\Models\Transaksi;
use Cron\MonthField;
use Illuminate\Support\Facades\DB;


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
    public function searchbulan(Request $request, $tgl, $tahun, $nama, $ket)
    {
        $hasil['total'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('nama', $nama)->where('keterangan', $ket)->get()->sum('total');
        $hasil['totaljumlah'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('nama', $nama)->where('keterangan', $ket)->get()->sum('jumlah');
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
        $hasil['bulan'] = $arraybulan[$tgl];
        return response()->json($hasil);
    }
}
