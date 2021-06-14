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
                    <h6 class="m-0 font-weight-bold text-primary">Neraca Saldo</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>

                                <tr>
                                    <th rowspan="2" class="text-center">Akun</th>
                                    <th rowspan="2" class="text-center">No Reff</th>
                                    <th rowspan="2" class="text-center">Debit</th>
                                    <th rowspan="2" class="text-center">Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $ttl_kredit = 0;
                                    $ttl_debit = 0;
                                @endphp
                                @foreach ($data as $key => $items)
                                    @php
                                        $title = explode('-', $key);
                                    @endphp
                                    @php
                                        $sld_debit = 0;
                                        $sld_kredit = 0;
                                    @endphp
                                    <tr>
                                        @foreach ($items as $item)
                                            @if ($item->jenis_transaksi == 'debit')
                                                @php
                                                    $sld_debit = $sld_debit + $item->saldo;
                                                    
                                                    $ttl_debit = $ttl_debit + $item->saldo;
                                                    
                                                @endphp

                                            @else
                                                @php
                                                    $sld_kredit = $sld_kredit + $item->saldo;
                                                    $sld_debit = $sld_debit - $sld_kredit;
                                                    $ttl_kredit = $ttl_kredit + $sld_kredit;
                                                @endphp

                                            @endif
                                        @endforeach
                                        @php
                                            
                                        @endphp
                                        <td>{{ $title[0] }}</td>
                                        <td>{{ $title[1] }}</td>
                                        <td>
                                            {{ $sld_debit <= 0 ? Helper::price(0) : Helper::price($sld_debit) }}
                                        </td>
                                        <td>
                                            {{ $sld_debit >= 0 ? Helper::price(0) : Helper::price($sld_kredit) }}
                                        </td>
                                    </tr>


                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-center"><strong>Total </strong></td>
                                    <td><strong>{{ Helper::price($ttl_debit) }}</strong></td>
                                    <td><strong>{{ Helper::price($ttl_kredit) }}</strong></td>
                                </tr>
                            </tbody>

                        </table>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                @if ($ttl_debit == $ttl_kredit)
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
    </div>
@endsection
