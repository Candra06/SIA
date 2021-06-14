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
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Laba Rugi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="5">Pendapatan</th>
                                </tr>
                            </thead>
                            @php
                                $ttl_saldo = 0;
                                $total_pendapatan = 0;
                            @endphp
                            @foreach ($pendapatan as $key => $items)
                                @php
                                    $saldo = 0;
                                    
                                @endphp
                                @php
                                    $title = explode('-', $key);
                                @endphp
                                <tr>
                                    @foreach ($items as $item)
                                        @php
                                            $saldo += $item->saldo;
                                            $ttl_saldo = $ttl_saldo + $item->saldo;
                                        @endphp
                                    @endforeach
                                    <td></td>
                                    <td>{{ $title[0] }}</td>
                                    <td>
                                        {{ Helper::price($saldo) }}
                                    </td>
                                    <td class="text-center">
                                        <strong>+</strong>
                                    </td>
                                    <td></td>
                                </tr>

                            @endforeach
                            @php
                                $total_pendapatan = $ttl_saldo;
                            @endphp
                            <tr>
                                <td colspan="2" class="text-center"><strong>Total Pendapatan</strong></td>
                                <td><strong>{{ Helper::price($ttl_saldo) }}</strong></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <thead>
                                <tr>
                                    <th colspan="5">Beban</th>
                                </tr>
                            </thead>
                            @php
                                $ttl_saldo = 0;
                                $total_beban = 0;
                            @endphp
                            @foreach ($beban as $key => $items)
                                @php
                                    $saldo = 0;
                                    
                                @endphp
                                @php
                                    $title = explode('-', $key);
                                @endphp
                                <tr>
                                    @foreach ($items as $item)
                                        @php
                                            $saldo += $item->saldo;
                                            $ttl_saldo = $ttl_saldo + $item->saldo;
                                        @endphp
                                    @endforeach
                                    <td></td>
                                    <td>{{ $title[0] }}</td>
                                    <td>
                                        {{ Helper::price($saldo) }}
                                    </td>
                                    <td class="text-center">
                                        <strong>+</strong>
                                    </td>
                                    <td></td>
                                </tr>

                            @endforeach
                            @php
                                $total_beban = $ttl_saldo;
                            @endphp
                            <tr>
                                <td colspan="2" class="text-center"><strong>Total Beban</strong></td>
                                <td><strong>{{ Helper::price($ttl_saldo) }}</strong></td>
                                <td></td>
                                <td class="text-center"><strong>-</strong></td>
                            </tr>
                            @php
                                $laba = $total_pendapatan - $total_beban;
                            @endphp
                            <tr>
                              <td colspan="4" class="text-center"><strong>Laba Bersih</strong></td>
                              <td><strong>{{ Helper::price($laba) }}</strong></td>
                          </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
