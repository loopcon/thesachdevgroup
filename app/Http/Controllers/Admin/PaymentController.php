<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayUsLog;
use App\Models\PayUs;
use App\Models\VehicleBrand;
use App\Models\PaymentToward;
use App\Models\NearLocation;
use App\Models\OurBusiness;
use App\Exports\ExportPayment;
use DataTables;
use Auth;
use Constant;
use Excel;
use Carbon\Carbon;


class PaymentController extends Controller
{
    public function paymentList()
    {
        $return_data = array();
        $return_data['site_title'] = trans('Payment');
        // $return_data['vehicle_brands'] = VehicleBrand::select('id', 'name')->get();
        $return_data['businesses']  = OurBusiness::select('id','title')->get();

        if (isset(Auth::user()->role_id) && Auth::user()->role_id != Constant::SUPERADMIN)
        {
            // $vehicle_brand = VehicleBrand::select('id', 'name')->where('userid', Auth::user()->id)->first();
            // $return_data['services'] = PaymentToward::select('name')->where('vehicle_brand', $vehicle_brand->id)->groupBy('name')->get();
            $businesses  = OurBusiness::select('id','title')->get();
            foreach ($businesses as $key => $value) {
                $services = [];
                $service_id = json_decode($value->service_id);
                if ($service_id) {
                    $services = Service::whereIn('id', $service_id)->get();
                }
                $return_data['services'] = $services;
            }
        }

        // $return_data['services'] = PaymentToward::select('name')->groupBy('name')->get();
        // $return_data['locations'] = NearLocation::select('id', 'nikname')->groupBy('nikname')->get();

        // $return_data['showroom'] = Showroom::select('id', 'name')->get();
        // $return_data['service_center'] = ServiceCenter::select('id', 'name')->get();
        // $return_data['body_shop'] = Body_shop::select('id', 'name')->get();
        // $return_data['used_car'] = Used_car::select('id', 'name')->get();
        return view("admin.payment.list",array_merge($return_data));
    }

    public function getServiceData(Request $request)
    {
        $business = $request->input('business_id');
        // $vehicle_brand = VehicleBrand::select('id', 'name')->where('name', $business)->first();
        $vehicle_brand = OurBusiness::select('id', 'title')->where('title', $business)->first();
        $services = PaymentToward::select('name')->where('vehicle_brand', $vehicle_brand->id)->groupBy('name')->get();
        // $locations = NearLocation::select('id', 'nikname')->where('vehicle_brand', $vehicle_brand->id)->groupBy('nikname')->get();

        return [
            'services' => $services
            // 'locations' => $locations,
        ];
    }

    public function getLocationData(Request $request)
    {
        $business = $request->input('business_id');
        $service = $request->input('service');
        $vehicle_brand = VehicleBrand::select('id', 'name')->where('name', $business)->first();
        $services = PaymentToward::select('type')->where('name', $service)->first();
        
        $vehicle_brand = VehicleBrand::select('id', 'name')->where('name', $business)->first();
        $services = PaymentToward::select('type')->where('name', $service)->first();
        // dd($request->all(), $vehicle_brand, $services);
        $locations = NearLocation::select('id', 'nikname')->where('vehicle_brand', $vehicle_brand->id)->where('type', $services->type)->groupBy('nikname')->get();

        return [
            // 'services' => $services
            'locations' => $locations,
        ];
    }

    public function paymentDatatable(Request $request)
    {   
        if($request->ajax()){

            $query = PayUs::select('id', 'payment_to', 'payment_towards', 'paid_amount', 'loc_id', 'name', 'mobile_no', 'emailid', 'registeration_no', 'near_location', 'created_at','transaction_time');

            if (isset(Auth::user()->role_id) && Auth::user()->role_id != Constant::SUPERADMIN)
            {
                $ourBusiness = OurBusiness::find(Auth::user()->business_id);
                $query->where('payment_to', $ourBusiness->title);
            }

            if($request->has('business_id') && !empty($request->business_id))
            {
                $query->where('payment_to', $request->business_id);
            }

            if($request->has('service') && !empty($request->service))
            {
                $query->where('payment_towards', $request->service);
            }

            if ($request->from_date && $request->to_date)
            {
                $fromDate = $request->from_date;
                $toDate = $request->to_date;
                // Ensure both dates are inclusive and ignore the time part
                $query->whereDate('transaction_time', '>=', $fromDate)
                      ->whereDate('transaction_time', '<=', $toDate);
            }

            if($request->has('location') && !empty($request->location))
            {
                $query->whereHas('nearLocation', function($q) use ($request) {
                    $q->where('id', $request->location);
                });
            }

            $list = $query->limit(50)->orderBy('id', 'DESC')->get();

            return DataTables::of($list)
                ->addColumn('payment_to', function ($list) {
                    return $list->payment_to;
                })
                ->addColumn('paid_amount', function ($list) {
                    return $list->paid_amount;
                })
                ->addColumn('payment_towards', function ($list) {
                    return $list->payment_towards;
                })
                ->addColumn('loc_id', function ($list) {
                    if ($list->payment_towards == "showroom") {
                        $locs = $list->showrooms->find($list->loc_id);
                        return isset($locs) ? $locs->name : '';
                    } elseif ($list->payment_towards == "service_center") {
                        $locs = $list->serviceCenters->find($list->loc_id);
                        return isset($locs) ? $locs->name : '';
                    } elseif ($list->payment_towards == "body_shop") {
                        $locs = $list->bodyShops->find($list->loc_id);
                        return isset($locs) ? $locs->name : '';
                    } elseif ($list->payment_towards == "used_car") {
                        $locs = $list->usedCars->find($list->loc_id);
                        return isset($locs) ? $locs->name : '';
                    } elseif ($list->payment_towards == "insurance") {
                        $locs = $list->businessInsurance->find($list->loc_id);
                        return isset($locs) ? $locs->name : '';
                    } else {
                        return isset($list->nearLocation) ? $list->nearLocation->nikname : '';
                    }                    
                })
                ->addColumn('name', function ($list) {
                    return $list->name;
                })
                ->addColumn('mobile_no', function ($list) {
                    return $list->mobile_no;
                })
                ->addColumn('emailid', function ($list) {
                    return $list->emailid;
                })
                ->addColumn('registeration_no', function ($list) {
                    return $list->registeration_no;
                })
                ->addColumn('near_location', function ($list) {
                    return $list->near_location;
                })
                
                 ->addColumn('transaction_time', function($list){
                    $transaction_time = date('m/d/Y', strtotime($list->transaction_time));
                    return $transaction_time;
                })
                ->make(true);
        } else {
            return redirect()->back()->with('error','something went wrong');
        }
    }

    public function export()
    {
        return Excel::download(new ExportPayment, 'payment.xlsx');
    }
}