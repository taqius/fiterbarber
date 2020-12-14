<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.keuangan');
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
    public function searchsaldo(Request $request, $tgl, $tahun)
    {
        $hasil['total'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->get()->sum('total');
        $hasil['bon'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('keterangan', 'bon')->get()->sum('total');
        $hasil['pengeluaran'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('keterangan', 'pengeluaran')->get()->sum('total');
        $hasil['gaji'] = Transaksi::whereMonth('tanggal', $tgl)->whereYear('tanggal', $tahun)->where('keterangan', 'gaji')->get()->sum('total');
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
