<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('updated_at', 'desc')
            ->paginate(30);

        if ($request->exists('page'))
        {
            $page = $request->input('page');;
        } else {
            $page = 1;
        }

        $no = (30*$page) - 29;

        $message = 'Tidak ada data permission';

        $label = 'Index permission : '.$permissions->total();

        return view('desa.permission.index', compact('permissions', 'no', 'message', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desa.permission.create');
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
            'name' => 'required|min:3|unique:permissions,name',
            'display_name' => 'required|min:3',
            'description' => 'required|min:10'
        ]);

        $permission = new permission;
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('permission.index');
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
        $permission = Permission::findOrFail($id);

        return view('desa.permission.edit', compact('permission'));
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
        $permission = Permission::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:3|unique:permissions,name,'.$permission->id,
            'display_name' => 'required|min:3',
            'description' => 'required|min:10'
        ]);

        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya berhasil diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('permission.index');
    }

    public function search(Request $request)
    {
        if ($request->has('cari')) {

            $permissions = Permission::where('name', 'like', '%'.$request->input('cari').'%')
                ->orWhere('display_name', 'like', '%'.$request->input('cari').'%')
                ->orWhere('description', 'like', '%'.$request->input('cari').'%')
                ->paginate(30);

            $permissions->setPath('search?cari='.$request->input('cari'));

            if ($request->exists('page'))
            {
                $page = $request->input('page');;
            } else {
                $page = 1;
            }

            $no = (30*$page) - 29;

            $label = '<a href="'.route('permission.index').'" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a> Pencarian Permission : '.$permissions->total();

            $message = 'Pencarian <strong>'.$request->input('cari').'</strong> tidak ditemukan. <br>. <a href="'.route('permission.index').'">Kembali</a>';

            return view('desa.permission.index', compact('permissions', 'no', 'message', 'label'));
        }else{
            $this->validate($request, [
                'cari' => 'required'
            ]);
        }
    }
}
