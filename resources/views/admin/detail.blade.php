@extends('layouts.app')

@section('content')
<div class="card col-sm-4 my-2">
    <div class="card-body">
        <div class="card-title">
            Nama : {{$pegawai->nama}}
        </div>
        <div class="card-text">

            Tempat : {{$pegawai->tempat}} <br>
            <a href="/pegawai" class="badge badge-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection