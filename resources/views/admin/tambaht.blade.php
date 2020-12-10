@extends('layouts.app')

@section('content')
<form class="form my-2" method="POST" action="/transaksi">
    @csrf
    <div class="form-group row"> 
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
        <div class="col-sm-5">
          <input type="date" class="form-control date @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ gmdate('Y-m-d')}}">
          <div class="invalid-feedback">
             @error('tanggal')
              {{$message}}
              @enderror
          </div>
        </div>
      </div>
    
    <div class="form-group row">
      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-5">
        <select class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
            <option class="form-control" value="{{old('nama')}}">{{old('nama') ?: 'Pilih nama'}}</option>
            @foreach($pegawai as $p)
            <option class="form-control" value="{{ $p->nama}}">{{$p->nama}}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('tempat')
             {{$message}}
             @enderror
         </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="tempat" class="col-sm-2 col-form-label">Tempat</label>
      <div class="col-sm-5">
        <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" value="{{old('tempat')}}" readonly>
        <div class="invalid-feedback">
            @error('tempat')
             {{$message}}
             @enderror
         </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
      <div class="col-sm-5">
        <select class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan">
            <option class="form-control" value="{{old('keterangan')}}">{{old('keterangan') ?: 'Pilih keterangan'}}</option>
            <option class="form-control" value="Potong">Potong</option>
            <option class="form-control" value="Pomade">Pomade</option>
            <option class="form-control" value="Bon">Bon</option>
            <option class="form-control" value="Pengeluaran">Pengeluaran</option>
        </select>
        <div class="invalid-feedback">
            @error('keterangan')
             {{$message}}
             @enderror
         </div>
      </div>
    </div>

    <div class="form-group row"> 
        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
        <div class="col-sm-5">
          <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{old('jumlah')}}" autocomplete="off">
          <div class="invalid-feedback">
             @error('jumlah')
              {{$message}}
              @enderror
          </div>
        </div>
      </div>

      <div class="form-group row"> 
        <label for="harga" class="col-sm-2 col-form-label">harga</label>
        <div class="col-sm-5">
          <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{old('harga')}}">
          <div class="invalid-feedback">
             @error('harga')
              {{$message}}
              @enderror
          </div>
        </div>
      </div>

      <div class="form-group row"> 
        <label for="total" class="col-sm-2 col-form-label">total</label>
        <div class="col-sm-5">
          <input type="text" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{old('total')}}" readonly>
          <div class="invalid-feedback">
             @error('total')
              {{$message}}
              @enderror
          </div>
        </div>
      </div>

    <div class="form-group row"> 
        <button class="btn btn-primary ml-2" type="submit">Simpan</button>
        </div>
      </div>
  </form>
  
  


@endsection