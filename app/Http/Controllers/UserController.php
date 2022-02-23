<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){

        //mengambil data darri database menggunakan db::table() dan disimpan ke dalam $data
        //menggunakan ->join() untuk menggabungkan tabel lainnya
        //diakhir get() untuk mengambil data array

        //diakhir first() jika hanya satu data yang diambil

        $data = DB::table('Users')
                ->get();

        //tampilkan view barang dan kirim datanya ke view tersebut
        return view('Admin.index')->with('data', $data)->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function tambah (){

        return view('Admin.create');

    }

    public function store(Request $request){


        DB::table('Users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->level,
            'remember_token' => Str::random(60),
        ]);

        return redirect('/user');

    }

    public function edit($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $data = DB::table('Users')->where('id',$id)->get();
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('Admin.edit',['Users' => $data]);

    }


public function update(Request $request){


    DB::table('Users')->where('id',$request->id)->update([
        'name' => $request->name,
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'role' => $request->level,
        'remember_token' => Str::random(60),
    ]);

    return redirect('/user');

}

    public function delete($id){
	// menghapus data pegawai berdasarkan id yang dipilih
	DB::table('Users')->where('id',$id)->delete();

	// alihkan halaman ke halaman pegawai
	return redirect('/user');
}

    }
