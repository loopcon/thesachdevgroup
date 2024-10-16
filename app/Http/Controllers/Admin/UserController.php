<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OurBusiness;
use App\Models\Showroom;
use App\Models\ServiceCenter;
use App\Models\Body_shop;
use App\Models\Used_car;
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
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
                $return_data['showroom'] = Showroom::select('id', 'name')->get();
                $return_data['service_center'] = ServiceCenter::select('id', 'name')->get();
                $return_data['body_shop'] = Body_shop::select('id', 'name')->get();
                $return_data['used_car'] = Used_car::select('id', 'name')->get();
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
                // $return_data['role'] = DB::table('roles')->select('id','name')->get();
                $return_data['role'] = DB::table('roles')->select('id','name')->whereNot('id',1)->get();
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
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
                    'role_id' => 'required',
                    'name' => 'required',
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
                $user->business_id = $request->business_id;
                $user->showroom_id = $request->showroom_id;
                $user->service_center_id = $request->service_center_id;
                $user->body_shop_id = $request->body_shop_id;
                $user->used_car_id = $request->used_car_id;
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
            $query = User::with('businessDetail','showroomDetail','serviceCenterDetail','bodyShopDetail','usedCarDetail')->select('id', 'business_id', 'showroom_id', 'service_center_id', 'body_shop_id', 'used_car_id', 'name', 'email')->where('id','!=',1)->orderBy('id', 'DESC');
            if(isset($request->business_id) && $request->business_id)
            {
                $query->where('business_id','=',$request->business_id);
            }
            if(isset($request->showroom_id) && $request->showroom_id)
            {
                $query->where('showroom_id','=',$request->showroom_id);
            }
            if(isset($request->service_center_id) && $request->service_center_id)
            {
                $query->where('service_center_id','=',$request->service_center_id);
            }
            if(isset($request->body_shop_id) && $request->body_shop_id)
            {
                $query->where('body_shop_id','=',$request->body_shop_id);
            }
            if(isset($request->used_car_id) && $request->used_car_id)
            {
                $query->where('used_car_id','=',$request->used_car_id);
            }
            $list = $query->get();
            return DataTables::of($list)
                    ->addColumn('business_id', function ($list) {
                        $business_id = isset($list->businessDetail->title) && $list->businessDetail->title ? $list->businessDetail->title : NULL;
                        return $business_id;
                    })
                    ->addColumn('showroom_id', function ($list) {
                        $showroom_id = isset($list->showroomDetail->name) && $list->showroomDetail->name ? $list->showroomDetail->name : NULL;
                        return $showroom_id;
                    })
                    ->addColumn('service_center_id', function ($list) {
                        $service_center_id = isset($list->serviceCenterDetail->name) && $list->serviceCenterDetail->name ? $list->serviceCenterDetail->name : NULL;
                        return $service_center_id;
                    })
                    ->addColumn('body_shop_id', function ($list) {
                        $body_shop_id = isset($list->bodyShopDetail->name) && $list->bodyShopDetail->name ? $list->bodyShopDetail->name : NULL;
                        return $body_shop_id;
                    })
                    ->addColumn('used_car_id', function ($list) {
                        $used_car_id = isset($list->usedCarDetail->name) && $list->usedCarDetail->name ? $list->usedCarDetail->name : NULL;
                        return $used_car_id;
                    })
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
            return redirect()->back()->with('error','something went wrong');
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
                // $return_data['role'] = DB::table('roles')->select('id','name')->get();
                $return_data['role'] = DB::table('roles')->select('id','name')->whereNot('id',1)->get();
                $return_data['our_business'] = OurBusiness::select('id', 'title')->get();
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
                    'role_id' => 'required',
                    'name' => 'required',
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
                $user->business_id = $request->business_id;
                $user->showroom_id = $request->showroom_id;
                $user->service_center_id = $request->service_center_id;
                $user->body_shop_id = $request->body_shop_id;
                $user->used_car_id = $request->used_car_id;
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

    public function getBusiness(request $request)
    {
        if($request->ajax()){
            $showroom = Showroom::select('id', 'name')->where('our_business_id', $request->business_id)->get();
            $html = '<option value="">'.trans('-- select --').'</option>';
            if($showroom->count()){
                foreach($showroom as $value){
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }

            $service_center = ServiceCenter::select('id','name')->where('business_id', $request->business_id)->get();
            $service_center_html = '<option value="">'.trans('-- select --').'</option>';
            if($service_center->count()){
                foreach($service_center as $value){
                    $service_center_html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }

            $body_shop = Body_shop::select('id','name')->where('business_id', $request->business_id)->get();
            $body_shop_html = '<option value="">'.trans('-- select --').'</option>';
            if($body_shop->count()){
                foreach($body_shop as $value){
                    $body_shop_html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }

            $usedcar = Used_car::select('id','name')->where('business_id', $request->business_id)->get();
            $usedcar_html = '<option value="">'.trans('-- select --').'</option>';
            if($usedcar->count()){
                foreach($usedcar as $value){
                    $usedcar_html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
            echo json_encode(array('html' => $html, 'service_center_html' => $service_center_html, 'body_shop_html' => $body_shop_html, 'usedcar_html' => $usedcar_html));
            exit;
        } else {
            return redirect('dashboard');
        }
    }
}
