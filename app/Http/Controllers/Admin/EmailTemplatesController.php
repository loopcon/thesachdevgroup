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
        $return_data = array();
        $return_data['site_title'] = trans('Email Templates');
        $return_data['email_templates'] = EmailTemplates::orderby('id','desc')->get();
        return view('admin.email_template.email', array_merge($return_data));
    }

    public function emailTemplateUpdate(Request $request)
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
    }
}
