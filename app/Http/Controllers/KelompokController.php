<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kategori;
use App\Kelompok;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelompoks = Kelompok::orderBy('updated_at', 'desc')
            ->paginate(30);

        if ($request->exists('page'))
        {
            $page = $request->input('page');;
        } else {
            $page = 1;
        }

        $no = (30*$page) - 29;

        $message = 'Tidak ada data kelompok';

        $label = 'Index Kelompok : '.$kelompoks->total();

        return view('desa.kelompok.index', compact('kelompoks', 'no', 'message', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama')->pluck('nama', 'id');

        return view('desa.kelompok.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:3|unique:kelompoks,nama',
            'alamat' => 'required|min:3',
            'kategoris_list' => 'required'
        ]);

        $kelompok = new kelompok;
        $kelompok->nama = $request->input('nama');
        $kelompok->alamat = $request->input('alamat');
        $kelompok->save();

        $kelompok->kategoris()->attach($request->input('kategoris_list'));

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('kelompok.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelompok = Kelompok::findOrFail($id);

        $kategoris = Kategori::orderBy('nama')->pluck('nama', 'id');

        return view('desa.kelompok.edit', compact('kelompok', 'kategoris'));
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
        $kelompok = Kelompok::findOrFail($id);

        $this->validate($request, [
            'nama' => 'required|min:3|unique:kelompoks,nama,'.$kelompok->id,
            'alamat' => 'required|min:3',
            'kategoris_list' => 'required'
        ]);

        $kelompok->nama = $request->input('nama');
        $kelompok->alamat = $request->input('alamat');
        $kelompok->save();

        $kelompok->kategoris()->sync($request->input('kategoris_list'));

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya berhasil diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('kelompok.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelompok = Kelompok::findOrFail($id);

        $kelompok->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('kelompok.index');
    }

    public function search(Request $request)
    {
        if ($request->has('cari')) {

            $kelompoks = Kelompok::where('nama', 'like', '%'.$request->input('cari').'%')
                ->orWhere('alamat', 'like', '%'.$request->input('cari').'%')
                ->paginate(30);

            $kelompoks->setPath('search?cari='.$request->input('cari'));

            if ($request->exists('page'))
            {
                $page = $request->input('page');;
            } else {
                $page = 1;
            }

            $no = (30*$page) - 29;

            $label = '<a href="'.route('kelompok.index').'" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a> Pencarian Kelompok : '.$kelompoks->total();

            $message = 'Pencarian <strong>'.$request->input('cari').'</strong> tidak ditemukan. <br>. <a href="'.route('kelompok.index').'">Kembali</a>';

            return view('desa.kelompok.index', compact('kelompoks', 'no', 'message', 'label'));
        }else{
            $this->validate($request, [
                'cari' => 'required'
            ]);
        }
    }
}
