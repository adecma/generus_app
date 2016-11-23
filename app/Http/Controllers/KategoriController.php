<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('updated_at', 'desc')
            ->paginate(30);

        if ($request->exists('page'))
        {
            $page = $request->input('page');;
        } else {
            $page = 1;
        }

        $no = (30*$page) - 29;

        $message = 'Tidak ada data kategori';

        $label = 'Index Kategori : '.$kategoris->total();

        return view('desa.kategori.index', compact('kategoris', 'no', 'message', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desa.kategori.create');
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
            'nama' => 'required|min:3|unique:kategoris,nama',
            'keterangan' => 'required|min:3',
        ]);

        $kategori = new kategori;
        $kategori->nama = $request->input('nama');
        $kategori->keterangan = $request->input('keterangan');
        $kategori->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('kategori.index');
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
        $kategori = Kategori::findOrFail($id);

        return view('desa.kategori.edit', compact('kategori'));
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
        $kategori = Kategori::findOrFail($id);

        $this->validate($request, [
            'nama' => 'required|min:3|unique:kategoris,nama,'.$kategori->id,
            'keterangan' => 'required|min:3',
        ]);

        $kategori->nama = $request->input('nama');
        $kategori->keterangan = $request->input('keterangan');
        $kategori->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya berhasil diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('kategori.index');
    }

    public function search(Request $request)
    {
        if ($request->has('cari')) {

            $kategoris = Kategori::where('nama', 'like', '%'.$request->input('cari').'%')
                ->orWhere('keterangan', 'like', '%'.$request->input('cari').'%')
                ->paginate(30);

            $kategoris->setPath('search?cari='.$request->input('cari'));

            if ($request->exists('page'))
            {
                $page = $request->input('page');;
            } else {
                $page = 1;
            }

            $no = (30*$page) - 29;

            $label = '<a href="'.route('kategori.index').'" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a> Pencarian Kategori : '.$kategoris->total();

            $message = 'Pencarian <strong>'.$request->input('cari').'</strong> tidak ditemukan. <br>. <a href="'.route('kategori.index').'">Kembali</a>';

            return view('desa.kategori.index', compact('kategoris', 'no', 'message', 'label'));
        }else{
            $this->validate($request, [
                'cari' => 'required'
            ]);
        }
    }
}
