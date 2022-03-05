<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use App\Models\Manager;
use App\Models\User;


class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = transaksi::latest()->paginate(5);

        return view('Kasir.index',compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Manager::all();
        return view('Kasir.create',compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timezone = 'Asia/Jakarta';
        $date = new DateTime('now',new DateTimeZone($timezone));
        $tanggal = $date->format('y-m-d');
        $request->validate([
            'nama_pelanggan' => 'required',
            'nama_menu' => 'required',
            'jumlah' => 'required|min:1',
        ]);

            $menu= Manager::whereNamaMenu($request->nama_menu)->first();
            if(!$menu){
                return back()->with('Error', 'Unregistered menu');
            }

            transaksi::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'nama_menu' => $request->nama_menu,
                'jumlah' => $request->jumlah,
                'harga' => $menu->harga,
                'total_harga' => $menu->harga * $request->jumlah,
                'nama_pegawai' => auth()->user()->name,
                'tanggal' => $tanggal,
            ]);

            $menu->update([
                'ketersediaan' => $menu->ketersediaan - $request->jumlah,
            ]);





            return redirect()->route('Kasir.index')
            ->with('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = transaksi::findOrFail($id);
        return view('Kasir.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaksi $transaksi , $menu)
    {
        $request->validate([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nama_menu' => $request->nama_menu,
            'jumlah' => $request->jumlah,
            'total_harga' => $menu->harga * $request->jumlah
        ]);

        $menu->update($request->all());
        return redirect()->route('Kasir.index')
                        ->with('success','Berhasil Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Transaksi::find($id);
        $delete= $data->delete();

        if($delete){
        return redirect()->route('Kasir.index')
        ->with('success','Berhasil Menghapus!');
        }else{
            return back();
        }
    }

    public function daftar(){
        $menu = transaksi::paginate(10);

        return view('Kasir.daftar', compact('menu'));
    }
}
