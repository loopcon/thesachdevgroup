<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Constant;
use Auth;
use DB;

class EmailTemplatesController extends Controller
{
    public function emailTemplate()
    {
        $has_permission = hasPermission('Email Templates');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $return_data = array();
                $return_data['site_title'] = trans('Email Templates');
                $return_data['email_templates'] = EmailTemplates::orderby('id','desc')->get();
                return view('admin.email_template.email', array_merge($return_data));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }

    public function emailTemplateUpdate(Request $request)
    {
        $has_permission = hasPermission('Email Templates');
        if(isset($has_permission) && $has_permission)
        {
            if($has_permission->read_permission == 1 || $has_permission->full_permission == 1)
            {
                $label = $request->id;
                if($label){
                    $email =  EmailTemplates::select('value')->where('label', $label)->first();
                    $template = isset($email->value) && $email->value ? $email->value : NULL;

                    if($request->$label) {
                        DB::table('email_templates')
                            ->where('label', $label)
                            ->update(['template' => $request->$label]);
                    }
                    return redirect('email-template')->with('success', trans($template.' '. trans('Email Template Updated Successfully!')));
                }
                return redirect('email-template')->with('error', trans('Something went wrong, please try again later.'));
            }else {
                return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
            }
        }else {
            return redirect('dashboard')->with('error', trans('You have not permission to access this page!'));
        }
    }
}
