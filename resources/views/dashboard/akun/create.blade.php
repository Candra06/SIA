@extends('dashboard.templates.master')

@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Edit Akun</h6>
            </div>
            <div class="card-body">
                <form action="/dashboard/akun/data" method="POST">
                    
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="">Nama Akun</label>
                            <input type="text" name="nama_reff" value="{{ old('nama_reff') }}" class="form-control @error('nama_reff') is-invalid @enderror" placeholder="Nama Akun">
                            @error('nama_reff')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">No Reff</label>
                            <input type="text" name="no_reff" value="{{ old('no_reff')}}" class="form-control @error('no_reff') is-invalid @enderror" placeholder="No Reff">
                            @error('no_reff')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Keterangan</label>
                            <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan">
                            @error('keterangan')
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