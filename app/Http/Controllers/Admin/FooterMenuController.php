<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer_menu;
use DataTables;


class FooterMenuController extends Controller
{
    //footer_menu
    public function footer_menu()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Footer Menu');
        return view("admin.footer_menu.list",array_merge($return_data));
    }

    public function footerMenuCreate()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Footer Menu Create');
        return view("admin.footer_menu.form",array_merge($return_data));
    }

    public function footer_menu_insert(Request $request){
      
        $footer_menu = new Footer_menu();
        $footer_menu->menu_name = $request->menu_name;
        $footer_menu->name = $request->name;
        $footer_menu->link = $request->link;
        $footer_menu->color = $request->color;
        $footer_menu->font_size = $request->font_size;
        $footer_menu->font_family = $request->font_family;
        $footer_menu->save();
  
        return redirect()->route('footer_menu')->with('success','Footer Menu insert successfully.');
    }

    public function footer_menu_index(Request $request){
        if ($request->ajax()) {
            $footer_menu = Footer_menu::orderBy('id', 'DESC')->get();
            return Datatables::of($footer_menu)
                    ->addIndexColumn()
                    ->addColumn('action', function($footer_menu){
            
                    $updateButton = "<a href='".route("footer_menu.edit",encrypt($footer_menu->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                    $deleteBtn = "<a href='javascript:void(0);' data-href='".route('footer_menu_destroy',array($footer_menu->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    return $updateButton . $deleteBtn;
                    })

            ->rawColumns(['action'])
            ->make(true);
        }
       
        return redirect()->back()->with('message','something went wrong');
    }

    
    public function footer_menu_edit($id)
    {
        $return_data = array();
        $id = decrypt($id);
        $return_data['site_title'] = trans('Footer Menu Edit');
        $footer_menu = Footer_menu::find($id);
        $return_data['record'] = $footer_menu;
        return view("admin.footer_menu.form",array_merge($return_data));
    }

    public function footer_menu_update(Request $request, $id)
    {
        $footer_menu = Footer_menu::find(decrypt($id));
        $footer_menu->menu_name = $request->menu_name;
        $footer_menu->name = $request->name;
        $footer_menu->link = $request->link;
        $footer_menu->color = $request->color;
        $footer_menu->font_size = $request->font_size;
        $footer_menu->font_family = $request->font_family;
        $footer_menu->save();

        return redirect()->route('footer_menu')->with('success','Footer Menu update successfully.');
    
    }

    public function footer_menu_destroy(Request $request,$id){

        $footer_menu = Footer_menu::findOrFail($id);
        $footer_menu->delete();
  
        if($footer_menu)
        {
            return redirect()->route('footer_menu')->with('message', 'Footer Menu deleted successfully');
        }
  
    }
}
