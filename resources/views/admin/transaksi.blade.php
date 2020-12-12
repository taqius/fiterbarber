@extends('layouts.app')

@section('content')
<div class="row my-2 ml-2">
    <a href="/transaksi/create" class="btn btn-primary">Tambah Transaksi</a>
</div>
<div class="row my-2 ml-2">
    @if (session('status'))
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                {{ session('status') }}
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
@endif

</div>
<table class="table table-hover" id="tabeltransaksi">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama</th>
            <th scope="col">Tempat</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    @foreach($transaksi as $p)
    <tbody>
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$p->tanggal}}</td>
        <td>{{$p->nama}}</td>
        <td>{{$p->tempat}}</td>
        <td>{{$p->keterangan}}</td>
        <td>{{$p->jumlah}}</td>
        <td>{{$p->total}}</td>
        <td>
        {{-- <a href="/transaksi/{{$p->id}}" class="btn btn-success">Detail</a>
        <a href="/transaksi/{{$p->id}}/edit" class="btn btn-primary">Edit</a> --}}


            <form action="/transaksi/{{$p->id}}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger tombol-hapus" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    </tbody>
    @endforeach
</table>
{{ $transaksi->onEachSide(5)->links() }}
@endsection
