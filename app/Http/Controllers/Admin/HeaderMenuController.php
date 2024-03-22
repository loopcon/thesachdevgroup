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
        $header_menu->save();
  
        return redirect()->route('header_menu.index')->with('message', 'Header menu insert succesfully');
    }

    public function header_menu_index(Request $request){
        if ($request->ajax()) {
            $header_menu = Header_menu::get();
            return Datatables::of($header_menu)
                    ->addIndexColumn()
                    ->addColumn('action', function($header_menu){
            
                    $updateButton = '<a href="'.route("header_menu.edit",encrypt($header_menu->id)).'" class="btn btn-info btn-sm">Edit</a>';        
                    $deleteBtn = '<a class="btn btn-danger btn-sm" id="smallButton" data-id="'.$header_menu->id.'">Delete</a>';
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
        $header_menu->save();

        return redirect()->route('header_menu.index')->with('message', 'Header menu update succesfully');
    }

    
    public function header_menu_destroy(Request $request,$id){

        $header_menu = Header_menu::findOrFail($id);
        $header_menu->delete();
  
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
  
    }
}
