<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Awards;
use App\Models\Brand;
use DataTables;
use File;

class AwardsController extends Controller
{
    public function awardList()
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Awards');
                return view("admin.award.list",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function awardCreate(Request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Award Create');
                $return_data['brand'] = Brand::select('id', 'name')->get();
                return view("admin.award.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardStore(Request $request)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $request->validate([
                    'brand_id' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $award = new Awards();
                $award->brand_id = $request->brand_id ? $request->brand_id : NULL;
                if($request->hasFile('image')) {
                    $image = fileUpload($request, 'image', 'uploads/award');
                    $award->image = $image;
                }
                $award->save();

                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award insert successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardDatatable(Request $request)
    {
        if($request->ajax()){
            $query = Awards::with('brandDetail')->select('id', 'brand_id', 'image')->orderBy('id', 'DESC');

            $list = $query->get();
            return DataTables::of($list)
                ->addColumn('image', function($list){
                    $image = $list->image ? asset('uploads/award/'.$list->image) : '';
                    return '<img src="' . $image . '" alt="" width="100">';
                }) 
                ->addColumn('brand_id', function($list){
                    $brand_id = isset($list->brandDetail->name) && $list->brandDetail->name ? $list->brandDetail->name : NULL;
                    return $brand_id;
                })
                ->addColumn('action', function ($list) {
                    $html = "";
                    $id = encrypt($list->id);
                    $has_permission = hasPermission('Awards');
                    if(isset($has_permission) && $has_permission)
                    {
                        if($has_permission->full_permission == 1)
                        {
                        $html .= "<span class='text-nowrap'>";
                        $html .= "<a href='".url('award-edit', array($id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";
                        $html .= "<a href='javascript:void(0);' data-href='".route('award-delete',array($id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                        $html .= "</span>";
                        }
                    }
                    return $html;
                })
                ->rawColumns(['image', 'brand_id', 'action'])
                ->make(true);
        } else {
            return redirect()->back()->with('message','something went wrong');
        }
    }

    public function awardEdit(Request $request,$id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $return_data = array();
                $return_data['site_title'] = trans('Award Edit');
                $award = Awards::find($id);
                $return_data['record'] = $award;
                $return_data['brand'] = Brand::select('id', 'name')->get();
                return view("admin.award.form",array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardUpdate(Request $request, $id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $request->validate([
                    'brand_id' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,webp',
                ]);
                $award = Awards::find($id);
                $award->brand_id = $request->brand_id ? $request->brand_id : NULL;
                if($request->hasFile('image')) {
                    $oldimg = $award->image;
                    if($oldimg)
                    {
                        removeFile('uploads/award/'.$oldimg);
                    }
                    $image = fileUpload($request, 'image', 'uploads/award');
                    $award->image = $image;
                }
                $award->save();

                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award update successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }
    }

    public function awardDestroy(Request $request, $id)
    {
        $has_permission = hasPermission('Awards');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->full_permission == 1)
            {
                $id = decrypt($id);
                $award = Awards::find($id);
                if($award->image != NULL)
                {
                    $image = $award->image;
                    if($image)
                    {
                        removeFile('uploads/award/'.$image);
                    }
                }
                $award = Awards::where('id',$id)->delete();
                if($award)
                {
                    return redirect()->route('awards')->with('success', 'Award deleted successfully.');
                } else {
                    return redirect()->back()->with('error', trans('Something went wrong, please try again later!'));
                }
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    // public function ajaxEditHtml(request $request)
    // {
    //     // $roles = Session::get('roles');
    //     // if(in_array(Constant::PRICELIST_FULL_ACCESS, $roles)){
    //         if($request->ajax()){
    //             $id = $request->id;
    //             $id = $id ? decrypt($id) : NULL;
    //             $record = $id ? Award::find($id) : NULL;
    //             // if(empty($record)){
    //                 // $favorite = Favorites::select('id', 'company_id')->where('id', $request->favorite_id)->first();
    //                 // $company_id = isset($favorite->company_id) ? $favorite->company_id : NULL;
    //             // } else {
    //             //     $company_id = $record->company_id;
    //             // }
    //             $brand = Brand::select('id', 'name')->get();
    //             // $price_list = PriceList::select('id', 'price_list_title')->where('company_id', $company_id)->get();
    //             // $article_no = PriceListArticle::select('id', 'article_number','description')->where('company_id', $company_id)->get();
    //             $html = view('admin.award.form', array('record' => $record, 'brand' =>$brand))->render();
    //             $return = array();
                
    //             $return['html'] = $html;
    //             echo json_encode($return);
    //         } else {
    //             return redirect('dashboard');
    //         }
    //     // } else {
    //     //     return redirect('backend/dashboard')->with('error', trans('You have not permission to access this page!'));
    //     // }
    // }
}
