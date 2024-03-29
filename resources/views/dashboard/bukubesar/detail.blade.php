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
                    <h6 class="m-0 font-weight-bold text-primary">Buku Besar</h6>
                </div>
                <div class="card-body">
                    @foreach ($data as $key => $items)
                        @php
                            $title = explode('-', $key);
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="3">Nama Akun : {{ $title[0] }}</th>
                                        <th colspan="3">Kode Ref : {{ $title[1] }}</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" class="text-center">Tanggal</th>
                                        <th rowspan="2" class="text-center">Keterangan</th>
                                        <th rowspan="2" class="text-center">Debit</th>
                                        <th rowspan="2" class="text-center">Kredit</th>
                                        <th colspan="2" class="text-center">Saldo</th>
                                    </tr>

                                    <tr>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sld_debit = 0;
                                        $sld_kredit = 0;
                                    @endphp
                                    @foreach ($items as $item)
                                        <tr>
                                            @if ($item->jenis_transaksi == 'debit')
                                                @php
                                                    $sld_debit = $sld_debit + $item->saldo;
                                                @endphp
                                            @else
                                                @php
                                                    $sld_kredit = $sld_kredit + $item->saldo;
                                                    $sld_debit = $sld_debit - $sld_kredit;
                                                @endphp
                                            @endif
                                            {{-- <td></td> --}}
                                            <td>{{ Helper::tanggal($item->tanggal_transaksi) }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->jenis_transaksi == 'debit' ? Helper::price($item->saldo) : Helper::price(0) }}
                                            </td>
                                            <td>{{ $item->jenis_transaksi == 'kredit' ? Helper::price($item->saldo) : Helper::price(0) }}
                                            </td>
                                            <td>{{ $sld_debit <= 0 ? Helper::price(0) : Helper::price($sld_debit) }}</td>
                                            <td>{{ $sld_debit >= 0 ? Helper::price(0) : Helper::price($sld_kredit) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-center"><strong>Total</strong></td>
                                        <td style="color : {{ $sld_debit >= 0 ? 'green' : '' }}">
                                            <strong>{{ $sld_debit <= 0 ? Helper::price(0) : Helper::price($sld_debit) }}</strong>
                                        </td>
                                        <td style="color : {{ $sld_debit <= 0 ? 'red' : '' }}">
                                            <strong>{{ $sld_debit >= 0 ? Helper::price(0) : Helper::price($sld_kredit) }}</strong>
                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>
                    @endforeach
                    <div class="row">
                        {{-- <div class="col-md-12">
                  @if ($kredit == $debit)
                  <button class="btn btn-block btn-success"><b>Balance</b></button>
                  @else
                  <button class="btn btn-block btn-danger"><b>Tidak Balance</b></button>
                  @endif
                </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
