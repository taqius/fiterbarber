@extends('layouts.app')

@section('content')
<div class="row my-2 ml-2">
    <a href="/pegawai/create" class="btn btn-primary">Tambah Pegawai</a> 
</div>
<div class="row my-2 ml-2">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Tempat</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    @foreach($pegawai as $p)
    <tbody>
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$p->nama}}</td>
        <td>{{$p->tempat}}</td>
        <td>{{$p->created_at}}</td>
        <td>
        <a href="/pegawai/{{$p->id}}" class="btn btn-success">Detail</a>  
        <a href="/pegawai/{{$p->id}}/edit" class="btn btn-primary">Edit</a> 
            
        
            <form action="/pegawai/{{$p->id}}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    </tbody>
    @endforeach
</table>  
@endsection