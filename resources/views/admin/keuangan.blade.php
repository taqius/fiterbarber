@extends('layouts.app')

@section('content')
<div class="form-group my-2 ml-2 col-md-6">
   <label for="bulan" class="form-label mr-2">Laporan Saldo : </label>
    {{ Form::selectMonth('bulan','', ['id' => 'bulan','class'=>'']) }}
    {{ Form::selectYear('tahunk',2020,2025,'', ['id' => 'tahunk','class'=>'ml-2 mr-2']) }}

</div>
<div class="card-body" id="laporan">

</div>
@endsection