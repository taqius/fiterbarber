@extends('layouts.app')

@section('content')
<div class="form-group my-2 ml-2 col-md-6">
   <label for="month" class="form-label mr-2">Pilih Laporan : </label>
    {{ Form::selectMonth('month','', ['id' => 'month','class'=>'']) }}
    {{ Form::selectYear('tahun',2020,2025,'', ['id' => 'tahun','class'=>'ml-2 mr-2']) }}
    {{ Form::select('pilnama', $pegawai->pluck('nama','nama'),null,['id'=>'pilnama']) }}
    {{ Form::select('ket', ['Potong'=>'Potong','Pomade'=>'Pomade'],null,['id'=>'ket','class'=>'ml-2']) }}

</div>
<div class="col-md-3 card-body" id="laporan">

</div>
@endsection