<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Vacancy;
use App\Models\CareerForm;

class CareerDetailController extends Controller
{
   public function job()
   {
      $return_data = array();
      $return_data['career'] = Career::select('id','banner_image','offer_main_title', 'offer_main_title_color','offer_main_title_font_size', 'offer_main_title_font_family', 'offer_first_icon','offer_first_title','offer_first_title_color','offer_first_title_font_size','offer_first_title_font_family','offer_first_description','offer_first_description_font_size','offer_first_description_font_family','offer_first_description_font_color','offer_second_icon','offer_second_title','offer_second_title_color','offer_second_title_font_size','offer_second_title_font_family','offer_second_description','offer_second_description_font_color','offer_second_description_font_size','offer_second_description_font_family','offer_third_icon','offer_third_title','offer_third_title_color','offer_third_title_font_size','offer_third_title_font_family','offer_third_description','offer_third_description_font_color','offer_third_description_font_size','offer_third_description_font_family','vacancy_title','vacancy_title_color','vacancy_title_font_size','vacancy_title_font_family','vacancy_sub_title','vacancy_sub_title_color','vacancy_sub_title_font_size','vacancy_sub_title_font_family')->first();
      $return_data['vacancies'] = Vacancy::with('businessDetail','showroomDetail','serviceCenterDetail','bodyShopDetail','usedCarDetail')->get();
      
      $return_data['image'] = Vacancy::select('id','image')->get();
      //  json_encode($data);
      return view('frontend.careers.index',array_merge($return_data));
   }

   public function jobApply(Request $request)
   {
      // $request->validate([
      //    'first_name' => 'required',
      //    'contact_no' => 'required|numeric',
      //    'email' => 'required',
      // ]);

      $career_form = new CareerForm();
      $career_form->first_name = $request->first_name;
      $career_form->last_name = $request->last_name;
      $career_form->email = $request->email;
      $career_form->contact_no = $request->contact_no;
      $career_form->post_apply_for = $request->post_apply_for;

      if($request->hasFile('resume')) {
         $resume = fileUpload($request, 'resume', 'uploads/career/resume');
         $career_form->resume = $resume;
     }
      $career_form->save();
      if($career_form)
      {
         return response()->json(['status'=>1]);
      }else{
         return response()->json(['status'=>0]);
      }
      
      // return json_encode(array('career_form'=>$career_form,'status'=>1));

      // if($career_form)
      // {
      //    return redirect()->back()->with('message','Your application send successfully!');
      // }else{
      //    return redirect()->back()->with('message','Your application not send, please try again!');
      // }
   }
}
