@extends('dashboard.templates.master')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Bulan</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=0;
                    @endphp
                      @foreach ($data as $key => $m)
                          <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{Helper::bulanTahun($key)}}</td>
                              
                              <td class="">
                                <a href="{{ url('/dashboard/neraca/data/'.$key)}}" class="btn btn-primary btn-circle ">
                                  Detail
                              </a>
                                
                              </td>
                          </tr>
                          @php
                              $i++
                          @endphp
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection