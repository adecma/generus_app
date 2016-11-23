<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('updated_at', 'desc')
            ->paginate(30);

        if ($request->exists('page'))
        {
            $page = $request->input('page');;
        } else {
            $page = 1;
        }

        $no = (30*$page) - 29;

        $message = 'Tidak ada data role';

        $label = 'Index Role : '.$roles->total();

        return view('desa.role.index', compact('roles', 'no', 'message', 'label'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->pluck('name', 'id');

        return view('desa.role.create', compact('permissions'));
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
            'name' => 'required|min:3|unique:roles,name',
            'display_name' => 'required|min:3',
            'description' => 'required|min:10'
        ]);

        $role = new Role;
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        $role->permissions()->attach($request->input('permissions_list'));

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya tersimpan <i class="fa fa-smile-o"></i>');

        return redirect()->route('role.index');
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
        $role = Role::findOrFail($id);

        $permissions = Permission::orderBy('name')->pluck('name', 'id');

        return view('desa.role.edit', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:3|unique:roles,name,'.$role->id,
            'display_name' => 'required|min:3',
            'description' => 'required|min:10'
        ]);

        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        $role->permissions()->sync($request->input('permissions_list'));

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya berhasil diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> datanya telah dihapus <i class="fa fa-smile-o"></i>');

        return redirect()->route('role.index');
    }

    public function search(Request $request)
    {
        if ($request->has('cari')) {

            $roles = Role::where('name', 'like', '%'.$request->input('cari').'%')
                ->orWhere('display_name', 'like', '%'.$request->input('cari').'%')
                ->orWhere('description', 'like', '%'.$request->input('cari').'%')
                ->paginate(30);

            $roles->setPath('search?cari='.$request->input('cari'));

            if ($request->exists('page'))
            {
                $page = $request->input('page');;
            } else {
                $page = 1;
            }

            $no = (30*$page) - 29;

            $label = '<a href="'.route('role.index').'" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i></a> Pencarian Role : '.$roles->total();

            $message = 'Pencarian <strong>'.$request->input('cari').'</strong> tidak ditemukan. <br>. <a href="'.route('role.index').'">Kembali</a>';

            return view('desa.role.index', compact('roles', 'no', 'message', 'label'));
        }else{
            $this->validate($request, [
                'cari' => 'required'
            ]);
        }
    }
}
