<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gen;
use App\Kategori;
use App\Kelompok;
use DB;
use Auth;
use App\User;
use Image;
use File;

class GenController extends Controller
{
   /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('permission:manage-generus|read-generus')->only(['index', 'show', 'search']);

        $this->middleware('permission:manage-generus')->only(['create', 'store', 'edit', 'update', 'destroy', 'update_avatar']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gens = Gen::whereHas('kelompok', function($kelompok){
                $kelompok->whereHas('users', function($users){
                    $users->where('user_id', '=', Auth::user()->id);
                });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(30);

        if ($request->exists('page'))
        {
            $page = $request->input('page');;
        } else {
            $page = 1;
        }

        $no = (30*$page) - 29;

        $message = 'Tidak ada data generus';

        $label = 'Index Generus : '.$gens->total();

        return view('kelompok.generus.index', compact('gens', 'no', 'message', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$kelompoks = Kelompok::pluck('nama', 'id'); 

        $kelompoks = User::findOrFail(Auth::user()->id)->kelompoks->pluck('nama', 'id');

        $kategoris = Kategori::pluck('nama', 'id');

        return view('kelompok.generus.create', compact('kelompoks', 'kategoris'));
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
            'nama_pendek' => 'required',
            'gender' => 'required|in:Laki,Perempuan',
            'kelompok_id' => 'required',
            'kategori_id' => 'required',
            'kontak' => 'numeric|digits_between:10,13',
            'tg_lahir' => 'required|date',
        ]);

        $gen = new Gen;
        $gen->nama_lengkap = $request->input('nama_lengkap');
        $gen->nama_pendek = $request->input('nama_pendek');
        $gen->gender = $request->input('gender');
        $gen->tg_lahir = $request->input('tg_lahir');
        $gen->kelompok_id = $request->input('kelompok_id');
        $gen->kategori_id = $request->input('kategori_id');
        $gen->orang_tua = $request->input('orang_tua');
        $gen->alamat = $request->input('alamat');
        $gen->kontak = $request->input('kontak');
        $gen->status = $request->input('status');
        $gen->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('generus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gen = Gen::whereHas('kelompok', function($kelompok){
                $kelompok->whereHas('users', function($users){
                    $users->where('user_id', '=', Auth::user()->id);
                });
            })
            ->findOrFail($id);

        return view('kelompok.generus.show', compact('gen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gen = Gen::whereHas('kelompok', function($kelompok){
                $kelompok->whereHas('users', function($users){
                    $users->where('user_id', '=', Auth::user()->id);
                });
            })
            ->findOrFail($id);

        $kelompoks = User::findOrFail(Auth::user()->id)->kelompoks->pluck('nama', 'id');

        $kategoris = Kategori::pluck('nama', 'id');

        return view('kelompok.generus.edit', compact('gen', 'kategoris', 'kelompoks'));
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
        $gen = Gen::whereHas('kelompok', function($kelompok){
                $kelompok->whereHas('users', function($users){
                    $users->where('user_id', '=', Auth::user()->id);
                });
            })
            ->findOrFail($id);

        $this->validate($request, [
            'nama_pendek' => 'required',
            'gender' => 'required|in:Laki,Perempuan',
            'kelompok_id' => 'required',
            'kategori_id' => 'required',
            'kontak' => 'numeric|digits_between:10,13',
            'tg_lahir' => 'required|date',
        ]);

        $gen->nama_lengkap = $request->input('nama_lengkap');
        $gen->nama_pendek = $request->input('nama_pendek');
        $gen->gender = $request->input('gender');
        $gen->tg_lahir = $request->input('tg_lahir');
        $gen->kelompok_id = $request->input('kelompok_id');
        $gen->kategori_id = $request->input('kategori_id');
        $gen->orang_tua = $request->input('orang_tua');
        $gen->alamat = $request->input('alamat');
        $gen->kontak = $request->input('kontak');
        $gen->status = $request->input('status');
        $gen->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya berhasil diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('generus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gen = Gen::whereHas('kelompok', function($kelompok){
                $kelompok->whereHas('users', function($users){
                    $users->where('user_id', '=', Auth::user()->id);
                });
            })
            ->findOrFail($id);

        $gen->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('generus.index');
    }

    /**
     * pencarian generus
     */
    public function search(Request $request)
    {
        if ($request->has('cari')) {

            $gens = Gen::join('kategoris', 'gens.kategori_id', '=', 'kategoris.id')
                ->select(['gens.id', 'gens.nama_lengkap', 'gens.nama_pendek', 'gens.orang_tua', 'gens.gender', 'gens.alamat', 'gens.created_at', 'gens.updated_at', 'gens.tg_lahir', 'gens.kategori_id', 'gens.kelompok_id', 'gens.status', 'gens.avatar'])
                ->whereHas('kelompok', function($kelompok) use($request) {
                        $kelompok->whereHas('users', function($users){
                            $users->where('user_id', '=', Auth::user()->id);
                        })
                        ->where(function ($gen) use($request) {
                            $gen->where('nama_pendek', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('nama_lengkap', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('orang_tua', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('gender', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('alamat', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('kontak', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('status', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('kelompoks.nama', 'like', '%'.$request->input('cari').'%')
                                ->orWhere('kategoris.nama', 'like', '%'.$request->input('cari').'%');
                        });
                })
                ->paginate(30);

            $gens->setPath('search?q='.$request->input('cari'));

            if ($request->exists('page'))
            {
                $page = $request->input('page');;
            } else {
                $page = 1;
            }

            $no = (30*$page) - 29;

            $label = '<a href="'.route('generus.index').'" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a> Pencarian Generus : '.$gens->total();

            $message = 'Pencarian <strong>'.$request->input('cari').'</strong> tidak ditemukan. <br>. <a href="'.route('generus.index').'">Kembali</a>';

            return view('kelompok.generus.index', compact('gens', 'no', 'message', 'label'));
        }else{
            $this->validate($request, [
                'cari' => 'required'
            ]);
        }
    }

    public function update_avatar(Request $request, $id)
    {
        $gen = Gen::findOrFail($id);

        $old_filename = $gen->avatar;

        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg'
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $gen->id.'-'.time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)
                ->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('/uploads/avatars/'.$filename));

            $gen->avatar = $filename;
            $gen->save();

            if ($old_filename != 'no_avatar.png') {
                File::delete('uploads/avatars/'.$old_filename);
            }
        }



        session()->flash('notif', '<strong>Alhamdulillah,</strong> fotonya telah diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('generus.show', $gen->id);
    }

    public function count()
    {
        /*$kategoris =  Kategori::whereHas('gen', function($query){
            $query->whereHas('kelompok', function($query){
                    $query->has('users','=', Auth::user()->id);
                });
            })
            ->withCount('gen')->get();

        return view('kelompok.generus.count', compact('kategoris', 'kelompok'))->with(['no' => 1]);*/

        $kelompok = Kelompok::whereHas('users', function($users){
                $users->where('id', '=', 1);
            })
            ->with(['kategoris' => function($kategoris){
                $kategoris->withCount(['gen' => function($gen){
                    $gen->where('kelompok_id', '=', 3);
                }]);
            }])
            ->get();

        return $kelompok;
    }
}
