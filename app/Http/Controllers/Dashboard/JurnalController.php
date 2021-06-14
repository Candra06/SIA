<?php

namespace App\Http\Controllers\Dashboard;

use App\Akun;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
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
        return view('dashboard.jurnal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = Akun::all();
        return view('dashboard.jurnal.create', compact('akun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reff_debit' => 'required',
            'tanggal_transaksi' => 'required',
            'nominal' => 'required',
            'jenis' => 'required',
        ]);
        try {
            $debit['id_akun'] = $request->reff_debit; 
            $debit['tanggal_transaksi'] = $request->tanggal_transaksi; 
            $debit['jenis_transaksi'] = $request->jenis;
            $debit['saldo'] = $request->nominal;
            $debit['id_user'] = Auth::user()->id;
            // return $debit;   
            Transaksi::create($debit);
            return redirect('/dashboard/jurnal/data')->with('status', 'Berhasil menambahkan transaksi');
        } catch (\Throwable $th) {
            throw $th;
        }
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
            ->whereYear('tanggal_transaksi', '=', $dt[0])
            ->whereMonth('tanggal_transaksi', '=', $dt[1])
            ->select('transaksi.*', 'users.name', 'akun.nama_reff', 'akun.no_reff')
            ->get();
        return view('dashboard.jurnal.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $akun = Akun::all();
        $data = Transaksi::where('id', $id)->first();
        return view('dashboard.jurnal.edit', compact('data', 'akun'));
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
        $request->validate([
            'reff_debit' => 'required',
            'tanggal_transaksi' => 'required',
            'nominal' => 'required',
            'jenis' => 'required',
        ]);
        try {
            $debit['id_akun'] = $request->reff_debit; 
            $debit['tanggal_transaksi'] = $request->tanggal_transaksi; 
            $debit['jenis_transaksi'] = $request->jenis;
            $debit['saldo'] = $request->nominal;
            $debit['id_user'] = Auth::user()->id;
            // return $debit;   
            Transaksi::where('id', $id)->update($debit);
            return redirect('/dashboard/jurnal/data')->with('status', 'Berhasil mengubah transaksi');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Transaksi::destroy($id);
            return redirect('/dashboard/jurnal/data')->with('status', 'Berhasil mengahapus transaksi');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
