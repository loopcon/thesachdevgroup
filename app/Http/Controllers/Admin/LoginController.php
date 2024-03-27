<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //login
    public function login(){

        if(Auth::check()){
            return redirect('dashboard');
        }else{
            return view('admin.login');
        }
    }

    public function customLogin(Request $request)
    {
       
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect("login")->withErrors(['meassage'=>'Login details are not valid']);

    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('login');
    }

    public function dashboard(){
        if(Auth::check()) {
            return view('admin.dashboard');
        }
        return redirect('login');
    }
}
