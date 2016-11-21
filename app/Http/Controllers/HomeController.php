<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * menampilkan halaman reset password
     */
    public function replacePassword()
    {
        return view('profile.replace_password');
    }

    /**
     * Update kata sandi
     */
    public function updatePassword(Request $request)
    {
        if (Hash::check($request->input('old_password'), Auth::user()->password))
        {
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($request->input('password'));
            $user->save();

            session()->flash('notif', '<strong>Alhamdulillah,</strong> kata sandi telah diperbaharui <i class="fa fa-smile-o"></i>');

            return redirect()->route('home.index');
        }else{
            return back()->with('old_password', 'The Old Password is Incorrect');
        }
    }

    /**
     * Menampilkan profile
     */
    public function profile()
    {
        $user = User::select(['id', 'name', 'email', 'created_at', 'updated_at', 'last_logged_in_at'])->findOrFail(Auth::user()->id);

        return view('profile.profile', compact('user'));
    }

    /**
     * menampilkan halaman edit profil
     */
    public  function profileEdit()
    {
        $user = User::select(['id', 'name', 'email'])->findOrFail(Auth::user()->id);

        return view('profile.edit', compact('user'));
    }

    /**
     * update profile
     */
    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $this->validate($request, [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        session()->flash('notif', '<strong>Alhamdulillah,</strong> profile telah diperbaharui <i class="fa fa-smile-o"></i>');

        return redirect()->route('home.profile');
    }
}
