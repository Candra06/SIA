<?php

namespace App\Http\Controllers\Dashboard;

use App\Akun;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::select('id', 'tanggal_transaksi')->get()->groupBy(function ($val) {
            return Carbon::parse($val->tanggal_transaksi)->format('Y-m');
        });
        return view('dashboard.neraca.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dt = explode('-', $id);
        $data = Transaksi::leftJoin('akun', 'akun.id', 'transaksi.id_akun')
            ->leftJoin('users', 'users.id', 'transaksi.id_user')
            ->whereYear('transaksi.tanggal_transaksi', '=', $dt[0])
            ->whereMonth('transaksi.tanggal_transaksi', '=', $dt[1])
            ->select('transaksi.*', 'users.name', 'akun.nama_reff', 'akun.no_reff')
            ->get()
            ->groupBy(function ($val) {
                return $val->nama_reff . '-' . $val->no_reff;
            });
        // return $data;
        return view('dashboard.neraca.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
