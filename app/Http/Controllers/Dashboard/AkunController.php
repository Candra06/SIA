<?php

namespace App\Http\Controllers\Dashboard;

use App\Akun;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Akun::all();
        return view('dashboard.akun.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Akun::create($request->validate([
                'no_reff' => 'required',
                'nama_reff' => 'required',
                'keterangan' => 'required',
            ]));
            return redirect('/dashboard/akun/data')->with('status', 'Berhasil menambahkan akun');
        } catch (\Throwable $th) {
            return redirect('/dashboard/akun/data/create')->with('status', 'Gagal menambahkan akun');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Akun::where('id', $id)->first();
        return view('dashboard.akun.edit', compact('data'));
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
        try {
            Akun::where('id', $id)->update($request->validate([
                'no_reff' => 'required',
                'nama_reff' => 'required',
                'keterangan' => 'required',
            ]));
            return redirect('/dashboard/akun/data')->with('status', 'Berhasil mengubah akun');
        } catch (\Throwable $th) {
            
            return redirect('/dashboard/akun/data/'.$id.'/edit')->with('status', 'Gagal mengubah akun');
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
        //
    }
}
