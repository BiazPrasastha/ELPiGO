<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function index()
    {
        if (Auth::user()) {
            return redirect('/');
        } else {
            return view('Auth.login');
        }
    }
    function login(Request $req)
    {
        $user = [
            'username' => $req->username,
            'password' => $req->password
        ];
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/store');
            } elseif (Auth::user()->role == 'user') {
                return redirect('/');
            }
        } else {
            return back()->with('notification', 'Login Failed, Please Check Your Username & Password');
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    function index_register()
    {
        return view('Auth.register');
    }
    function register(Request $req)
    {
        $validate = $req->validate([
            'username' => 'unique:users,username',
            'store' => 'required',
            'pass2' => 'same:pass1|min:5'
        ], [
            'username.unique' => 'Username Already Exist.',
            'pass2.same' => 'Password Not Match, Please Try Again.',
            'pass2.min' => 'Password Minimum 5 Character.'
        ]);

        $store = new Store();
        $store->name = $req->store;
        $store->save();

        $user = new User();
        $user->username = $req->username;
        $user->password = Hash::make($req->pass2);
        $user->store_id = $store->id;
        $user->role = 'user';
        $user->save();
        return redirect()->route('index');
    }
    function password()
    {
        return view('Auth.change-password');
    }
    function change(Request $req)
    {
        $validate = $req->validate([
            'pass2' => 'same:pass1|min:5'
        ], [
            'pass2.same' => 'New Password Not Match, Please Try Again',
            'pass2.min' => 'New Password Minimum 5 Character.'
        ]);
        if (Hash::check($req->old, Auth::user()->password)) {
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = Hash::make($req->pass2);
            $user->save();
            return redirect('/logout');
        } else {
            return back()->with('notification', 'Wrong Old Password, Please Check Again');
        }
    }
}
