@extends('layouts.app')

@section('content')
<form class="form my-2" method="POST" action="/pegawai">
    @csrf
    <div class="form-group row"> 
      <label for="nama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-5">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama')}}">
        <div class="invalid-feedback">
           @error('nama')
            {{$message}}
            @enderror
        </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="tempat" class="col-sm-2 col-form-label">Tempat</label>
      <div class="col-sm-5">
        <select class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat">
            <option class="form-control" value="{{old('tempat')}}">{{old('tempat') ?: 'Pilih Tempat'}}</option>
            <option class="form-control" value="Ngampel">Ngampel</option>
            <option class="form-control" value="Cepiring">Cepiring</option>
        </select>
        <div class="invalid-feedback">
            @error('tempat')
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