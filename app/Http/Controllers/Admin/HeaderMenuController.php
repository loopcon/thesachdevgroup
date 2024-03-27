<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_menu;
use DataTables;

class HeaderMenuController extends Controller
{
    //header_menu
    public function header_menu(Request $request){
        return view("admin.header_menu.form"); 
    }

    public function header_menu_insert(Request $request){
      
        $header_menu = new Header_menu();
        $header_menu->menu_name = $request->menu_name;
        $header_menu->name = $request->name;
        $header_menu->link = $request->link;
        $header_menu->color = $request->color;
        $header_menu->font_size = $request->font_size;
        $header_menu->font_family = $request->font_family;
        $header_menu->save();
  
        return redirect()->route('header_menu.index')->with('message', 'Header menu insert succesfully');
    }

    public function header_menu_index(Request $request){
        if ($request->ajax()) {
            $header_menu = Header_menu::orderBy('id', 'DESC')->get();
            return Datatables::of($header_menu)
                    ->addIndexColumn()
                    ->addColumn('action', function($header_menu){
            
                    $updateButton = "<a href='".route("header_menu.edit",encrypt($header_menu->id))."' rel='tooltip' title='".trans('Edit')."' class='btn btn-info btn-sm'><i class='fas fa-pencil-alt'></i></a>&nbsp";        
                    $deleteBtn = "<a href='javascript:void(0);' data-href='".route('header_menu_destroy',array($header_menu->id))."' rel='tooltip' title='".trans('Delete')."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash-alt'></i></a>&nbsp";
                    return $updateButton . $deleteBtn;
                    })

            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('admin.header_menu.show');
    }

    public function header_menu_edit($id){
        $header_menus  = Header_menu::where('id',decrypt($id))->get();
        return view('admin.header_menu._form',compact('header_menus'));
    }

    public function header_menu_update(Request $request, $id)
    {
        $header_menu = Header_menu::find($id);
        $header_menu->menu_name = $request->menu_name;
        $header_menu->name = $request->name;
        $header_menu->link = $request->link;
        $header_menu->color = $request->color;
        $header_menu->font_size = $request->font_size;
        $header_menu->font_family = $request->font_family;
        $header_menu->save();

        return redirect()->route('header_menu.index')->with('message', 'Header menu update succesfully');
    }

    
    public function header_menu_destroy(Request $request,$id){

        $header_menu = Header_menu::findOrFail($id);
        $header_menu->delete();
  
        if($header_menu)
        {
            return redirect()->route('header_menu.index')->with('message', 'Header Menu deleted succesfully');
        }
  
    }
}