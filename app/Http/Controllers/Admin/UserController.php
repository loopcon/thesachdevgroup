<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use DB;

class UserController extends Controller
{
    public function userList()
    {
        $has_permission = hasPermission('Users');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Users');
                return view("admin.user.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function userCreate()
    {
        $has_permission = hasPermission('Users');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['role'] = DB::table('roles')->select('id','name')->get();
                $return_data['site_title'] = trans('User Create');
                return view("admin.user.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function userStore(Request $request)
    {
        $has_permission = hasPermission('Users');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'cpassword' => 'required|same:password'
                ]);
                $user = new User();
                $user->role_id = $request->role_id ? $request->role_id : NULL;
                $user->name = $request->name ? $request->name : NULL;
                $user->email = $request->email ? $request->email : NULL;
                $user->password = \Hash::make($request->password);
                $user->visible_password = $request->password;
                $user->save();

                if($user)
                {
                    return redirect()->route('user')->with('success', 'User insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function userDatatable(Request $request)
    {
        if($request->ajax()){
            $query = User::select('id', 'name', 'email')->where('id','!=',1)->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Users');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('user-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('user-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function userEdit($id)
    {
        $has_permission = hasPermission('Users');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $return_data = array();
                $id = decrypt($id);
                $return_data['site_title'] = trans('User Edit');
                $user = User::find($id);
                $return_data['record'] = $user;
                $return_data['role'] = DB::table('roles')->select('id','name')->get();
                return view("admin.user.form",array_merge($return_data));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function userUpdate(Request $request,$id)
    {
        $has_permission = hasPermission('Users');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'email' => 'required|email|unique:users,email,'.$id,
                    'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'cpassword' => 'required|same:password'
                ]);
                $user = User::find($id);
                $user->role_id = $request->role_id ? $request->role_id : NULL;
                $user->name = $request->name ? $request->name : NULL;
                $user->email = $request->email ? $request->email : NULL;
                $user->password = \Hash::make($request->password);
                $user->visible_password = $request->password;
                $user->save();

                if($user)
                {
                    return redirect()->route('user')->with('success', 'User update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function userDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Users');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $user = User::where('id',$id)->delete();
                if($user)
                {
                    return redirect()->route('user')->with('success', 'User deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
