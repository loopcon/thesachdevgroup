<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
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
        return redirect("admin")->with(['error'=>'Login details are not valid.']);

    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('admin');

    }

    public function dashboard(){
        if(Auth::check()) {
            return view('admin.dashboard');
        }
        return redirect('admin');
    }

    public function showchangePasswordForm()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Change Password');
        return view('admin.change_password', array_merge($return_data));
    }

    public function changePassword(Request $request)
    {
        $current_password = Auth::user()->password;
        if(!\Hash::check($request->old_password, $current_password)){
            return back()->with('error',trans('You have entered wrong old password!'));
        } else {
            $user_id = Auth::user()->id;
            $password = \Hash::make($request->new_password);

            DB::table('users')->where('id', $user_id)->update(['password' => $password]);
            return redirect('dashboard')->with('success', trans('Your password updated successfully!'));
        }
        
    }
}
