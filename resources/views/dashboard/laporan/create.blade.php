@extends('dashboard.templates.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Tambah Transaksi</h6>
            </div>
            <div class="card-body">
                <form action="/dashboard/jurnal/data" method="POST">
                    
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="">Nama Akun</label>
                            <select name="reff_debit" class="form-control @error('reff_debit') is-invalid @enderror" id="">
                                <option value="">Pilih Akun</option>
                                @foreach ($akun as $i)
                                    <option value="{{$i->id}}" {{ old('reff_debit') == $i->id ? 'selected' : ''}}>{{$i->nama_reff.'-'.$i->no_reff}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" name="nama_reff" value="{{ old('nama_reff') }}" class="form-control @error('nama_reff') is-invalid @enderror" placeholder="Nama Akun"> --}}
                            @error('reff_debit')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Jenis</label>
                            <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" id="">
                                <option value="">Pilih Jenis Traknsaksi</option>
                                <option value="debit">Debit</option>
                                <option value="kredit">Kredit</option>
                                {{-- @foreach ($akun as $i)
                                    <option value="{{$i->id}}" {{ old('reff_debit') == $i->id ? 'selected' : ''}}>{{$i->nama_reff.'-'.$i->no_reff}}</option>
                                @endforeach --}}
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Nominal Saldo</label>
                            <input type="number" name="nominal" value="{{ old('nominal') }}" class="form-control @error('nominal') is-invalid @enderror" placeholder="Nominal">
                            @error('nominal')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" value="{{ old('tanggal_transaksi') }}" class="form-control @error('tanggal_transaksi') is-invalid @enderror" placeholder="tanggal_transaksi">
                            @error('tanggal_transaksi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 d-flex justify-content-between">
                            
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection