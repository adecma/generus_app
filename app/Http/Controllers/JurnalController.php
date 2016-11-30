<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jurnal;
use Auth;
use App\Galeri;
use Image;
use File;
use Excel;
use DB;

class JurnalController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('permission:manage-jurnal|read-jurnal')->only(['index', 'show', 'search']);

        $this->middleware('permission:manage-jurnal')->only(['create', 'store', 'edit', 'update', 'destroy', 'store_galeri', 'destroy_galeri']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurnals = Jurnal::orderBy('updated_at', 'desc')
            ->paginate(30);

        if ($request->exists('page'))
        {
            $page = $request->input('page');;
        } else {
            $page = 1;
        }

        $no = (30*$page) - 29;

        $message = 'Tidak ada data jurnal';

        $label = 'Index jurnal : '.$jurnals->total();

        return view('desa.jurnal.index', compact('jurnals', 'no', 'message', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oleh = Auth::user()->kelompoks->pluck('nama', 'nama');
        if (Auth::user()->hasRole('master')) {
            $oleh->prepend('Desa Barat', 'Desa Barat');
        }

        return view('desa.jurnal.create', compact('oleh'));
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
            'kegiatan' => 'required',
            'tempat' => 'required',
            'oleh' => 'required',
            'tg' => 'required|date',
            'peserta' => 'required|numeric',
            'materi' => 'required',
            'deskripsi' => 'required'
        ]);

        $jurnal = new jurnal;
        $jurnal->kegiatan = $request->input('kegiatan');
        $jurnal->tempat = $request->input('tempat');
        $jurnal->oleh = $request->input('oleh');
        $jurnal->tg = $request->input('tg');
        $jurnal->peserta = $request->input('peserta');
        $jurnal->materi = $request->input('materi');
        $jurnal->deskripsi = $request->input('deskripsi');
        $jurnal->user_id = Auth::user()->id;
        $jurnal->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('jurnal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurnal = Jurnal::findOrFail($id);

        $galeris = Galeri::where('jurnal_id', '=', $jurnal->id)->get();

        return view('desa.jurnal.show', compact('jurnal', 'galeris'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurnal = Jurnal::findOrFail($id);

        $oleh = Auth::user()->kelompoks->pluck('nama', 'nama');
        if (Auth::user()->hasRole('master')) {
            $oleh->prepend('Desa Barat', 'Desa Barat');
        }

        return view('desa.jurnal.edit', compact('jurnal', 'oleh'));
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
        $jurnal = Jurnal::findOrFail($id);

        $this->validate($request, [
            'kegiatan' => 'required',
            'tempat' => 'required',
            'oleh' => 'required',
            'tg' => 'required|date',
            'peserta' => 'required|numeric',
            'materi' => 'required',
            'deskripsi' => 'required'
        ]);

        $jurnal->kegiatan = $request->input('kegiatan');
        $jurnal->tempat = $request->input('tempat');
        $jurnal->oleh = $request->input('oleh');
        $jurnal->tg = $request->input('tg');
        $jurnal->peserta = $request->input('peserta');
        $jurnal->materi = $request->input('materi');
        $jurnal->deskripsi = $request->input('deskripsi');
        $jurnal->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya berhasil diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('jurnal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);

        $jurnal->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('jurnal.index');
    }

    public function search(Request $request)
    {
        if ($request->has('cari')) {

            $jurnals = Jurnal::whereHas('user', function($user) use($request) {
                    $user->where('name', 'like', '%'.$request->input('cari').'%');
                })
                ->orWhere('kegiatan', 'like', '%'.$request->input('cari').'%')
                ->orWhere('tempat', 'like', '%'.$request->input('cari').'%')
                ->orWhere('oleh', 'like', '%'.$request->input('cari').'%')
                ->orWhere('materi', 'like', '%'.$request->input('cari').'%')
                ->orWhere('deskripsi', 'like', '%'.$request->input('cari').'%')
                ->orderBy('updated_at', 'desc')
                ->paginate(30);

            $jurnals->setPath('search?cari='.$request->input('cari'));

            if ($request->exists('page'))
            {
                $page = $request->input('page');;
            } else {
                $page = 1;
            }

            $no = (30*$page) - 29;

            $label = '<a href="'.route('jurnal.index').'" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a> Pencarian jurnal : '.$jurnals->total();

            $message = 'Pencarian <strong>'.$request->input('cari').'</strong> tidak ditemukan. <br>. <a href="'.route('jurnal.index').'">Kembali</a>';

            return view('desa.jurnal.index', compact('jurnals', 'no', 'message', 'label'));
        }else{
            $this->validate($request, [
                'cari' => 'required'
            ]);
        }
    }

    public function store_galeri(Request $request, $id)
    {
        $jurnal = Jurnal::findOrFail($id);

        $this->validate($request, [
            'galeri' => 'required|mimes:jpeg',
            'label' => 'required'
        ]);

        if ($request->hasFile('galeri')) {
            $galeri = $request->file('galeri');
            $filename = $jurnal->id.'-'.time().'.'.$galeri->getClientOriginalExtension();
            Image::make($galeri)
                ->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/galeris/'.$filename));

            $galeri = new Galeri;
            $galeri->filename = $filename;
            $galeri->label = $request->input('label');
            $galeri->jurnal_id = $jurnal->id;
            $galeri->save();
        }

        session()->flash('notif', '<strong>Alhamdulillah,</strong> fotonya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('jurnal.show', $jurnal->id);        
    }

    public function destroy_galeri($jurnal_id, $galeri_id)
    {
        $galeri = Galeri::findOrFail($galeri_id);

        File::delete('uploads/galeris/'.$galeri->filename);

        $galeri->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('jurnal.show', $jurnal_id);
    }

    public function exportToExcel()
    {
        $jurnals = Jurnal::get(['id', 'kegiatan', 'oleh', 'tempat', DB::raw("concat(tg) as tanggal"), 'peserta', 'materi', 'deskripsi']);

        Excel::create('DataJurnalDesaBarat-'.time(), function($excel) use($jurnals) {
                $excel->setTitle('Data Generus Desa Barat');

                $excel->setCreator('Ade Prast')
                    ->setCompany('Ade Prast');

                $excel->setDescription('Data jurnal desa barat yang diexport dari Generus App');

                $excel->sheet('JurnalDesaBarat', function($sheet) use($jurnals) {
                    $sheet->fromArray($jurnals);                        
                });
            })
            ->export('xlsx');
    }
}
