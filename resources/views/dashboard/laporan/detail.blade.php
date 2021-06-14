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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Nama Akun</th>
                      <th>Kode Reff</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=0;
                        $debit = 0;
                        $kredit = 0;
                    @endphp
                      @foreach ($data as $key => $m)
                          <tr>
                              <td>{{Helper::tanggal($m->tanggal_transaksi)}}</td>
                              <td class="{{$m->jenis_transaksi == 'kredit' ? 'text-right' : ''}}">{{$m->nama_reff}}</td>
                              <td>{{$m->no_reff}}</td>
                              <td>{{ $m->jenis_transaksi == 'debit' ? Helper::price($m->saldo) : Helper::price('0')}}</td>
                              <td>{{$m->jenis_transaksi == 'kredit' ? Helper::price($m->saldo) : Helper::price('0')}}</td>
                              
                              <td class="">
                                @if (Helper::permission()->edit == 1)
                                <a href="{{Helper::permission()->url . '/' . $m->id . '/edit'}}" class="btn btn-sm btn-primary btn-circle mr-2">
                                    <i data-feather="edit-2"></i>
                                </a>
                              @endif
                              @if (Helper::permission()->delete)
                                @php
                                  $linkdelete = Helper::permission()->url . '/' . $m->id
                                @endphp
                                <a onclick='modal_konfir("{{ $linkdelete }}")' class="btn btn-sm btn-danger btn-circle mr-2" href="#">
                                  <i data-feather="trash"></i>
                                </a>
                              @endif
                              </td>
                          </tr>
                          @php
                              $i++
                          @endphp
                          @if ( $m->jenis_transaksi == 'debit')
                              @php
                                  $debit = $debit + $m->saldo
                              @endphp
                          @else
                              @php
                                  $kredit = $kredit + $m->saldo;
                              @endphp
                          @endif
                      @endforeach
                      <tr>
                        <td colspan="3" class="text-center"><b>Jumlah Saldo</b></td>
                        <td><b>{{ Helper::price($debit)}}</b></td>
                        <td colspan="2"><b>{{ Helper::price($kredit)}}</b></td>
                      </tr>
                  </tbody>
                  
                </table>
                
              </div>
              <div class="row">
                <div class="col-md-12">
                  @if ($kredit == $debit)
                  <button class="btn btn-block btn-success"><b>Balance</b></button>
                  @else
                  <button class="btn btn-block btn-danger"><b>Tidak Balance</b></button>
                  @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection