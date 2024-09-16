<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleBrand;
use App\Models\PaymentToward;
use App\Models\NearLocation;
use App\Models\PayUsLog;
use App\Models\PayUs;
use App\Models\OurBusiness;
use App\Models\Service;
use App\Services\AES128;

class PaymentController extends Controller
{
    public function form() {
        // $brands = VehicleBrand::get();
        $brands = OurBusiness::get();

        foreach ($brands as $key => $value) {
            $services = [];
            $service_id = json_decode($value->service_id);
            if ($service_id) {
                $services = Service::whereIn('id', $service_id)->get();
            }

            $value->services = $services;
        }
        return view('frontend.payment.form', compact('brands'));
    }

    public function getDataByService(Request $request) {
        $towrd=explode('-',$_POST['get_option']);

        $ourBusiness = OurBusiness::find($towrd[1]);
        // $paymentToward = PaymentToward::find($towrd[1]);
        // $nearLocation = NearLocation::where('vehicle_brand', $paymentToward->vehicle_brand)->where('type', $paymentToward->type)->where('status', 0)->orderBy('nikname')->get();
        $nearLocation = [];

        if ($towrd[0] != "Other Specify" && $towrd[0] != "Other" && $towrd[0] != "Sales") {
            if ($towrd[0] == "showroom") {
                if(isset($ourBusiness->showrooms) && count($ourBusiness->showrooms) > 0) {
                    $nearLocation = $ourBusiness->showrooms;
                }
            } elseif ($towrd[0] == "service_center") {
                if(isset($ourBusiness->serviceCenters) && count($ourBusiness->serviceCenters) > 0) {
                    $nearLocation = $ourBusiness->serviceCenters;
                }
            } elseif ($towrd[0] == "body_shop") {
                if(isset($ourBusiness->bodyShops) && count($ourBusiness->bodyShops) > 0) {
                    $nearLocation = $ourBusiness->bodyShops;
                }
            } elseif ($towrd[0] == "used_car") {
                if(isset($ourBusiness->usedCars) && count($ourBusiness->usedCars) > 0) {
                    $nearLocation = $ourBusiness->usedCars;
                }
            } elseif ($towrd[0] == "insurance") {
                if(isset($ourBusiness->businessInsurance) && count($ourBusiness->businessInsurance) > 0) {
                    $nearLocation = $ourBusiness->businessInsurance;
                }
            }

            $html = '<div class="form-group" id="payment_location">
            <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
                <div  class="col-xs-9">
                    <select class="form-control" required name="near_location" >
                        <option  value="">Select Location</option>';
                        foreach ($nearLocation as $fn) {
                            $html .= '<option value="'.$fn->id.'">'.$fn->name.'</option>';
                        }
                        $html .= '</select> 
                    <p>(Please ask your advisor what is your location)</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-3 control-label">Vehicle Registration No. <span class="text-danger"></span></label>
                <div class="col-xs-9">
                    <input type="text"  maxlength="100" placeholder="Enter Vehicle Registration No." name="VehicleReg" class="form-control" >
                </div>
            </div>';
        } elseif ($towrd[0] == "Sales") {
            $html = '<div class="form-group" id="payment_location">
            <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
                <div  class="col-xs-9">
                    <select class="form-control" required name="near_location" >
                        <option  value="">Select Location</option>';
                        foreach ($nearLocation as $fn) {
                            $html .= '<option value="'.$fn->id.'">'.$fn->nikname.'</option>';
                        }
                        $html .= '</select> 
                    <p>(Please ask your advisor what is your location)</p>
                </div>
            </div>';
            
        } elseif ($towrd[0] == "Other") {
            $vehicleBrand = VehicleBrand::where('name', $ourBusiness->title)->first();

            $html = '<div class="form-group" id="payment_location">
                <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" required name="near_location" >
                </div>
            </div>
            <input type="hidden" name="vehicle_brand" value="'. $vehicleBrand->id.'">
            <input type="hidden" name="type" value="other">';
        } else {
            $vehicleBrand = VehicleBrand::where('name', $ourBusiness->title)->first();
            $paymentToward = PaymentToward::where('name', 'Other Specify')->where('vehicle_brand', $vehicleBrand->id)->first();
            $nearLocation = NearLocation::where('vehicle_brand', $paymentToward->vehicle_brand)->where('type', $paymentToward->type)->where('status', 0)->orderBy('nikname')->get();

            $html = '<div class="form-group" id="payment_location">
            <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
                <div  class="col-xs-9">
                    <select class="form-control" required name="near_location" >
                        <option  value="">Select Location</option>';
                        foreach ($nearLocation as $fn) {
                            $html .= '<option value="'.$fn->id.'">'.$fn->nikname.'</option>';
                        }
                        $html .= '</select> 
                    <p>(Please ask your advisor what is your location)</p>
                </div>
            </div>
            <div class="form-group" id="payment_location">
                <label class="col-xs-3 control-label">Other Specify <span class="text-danger">*</span></label>
                <div  class="col-xs-9">
                    <input type="text" class="form-control" required name="others" >
                </div>
            </div>';
        }

        return $html;
    }
    
    // OLD CODE - 13-08-2024 ------
    // public function getDataByService(Request $request) {
    //     $towrd=explode('-',$_POST['get_option']);

    //     $paymentToward = PaymentToward::find($towrd[1]);

    //     $nearLocation = NearLocation::where('vehicle_brand', $paymentToward->vehicle_brand)->where('type', $paymentToward->type)->where('status', 0)->orderBy('nikname')->get();

    //     if ($towrd[0] != "Other Specify" && $towrd[0] != "Other" && $towrd[0] != "Sales") {
    //         $html = '<div class="form-group" id="payment_location">
    //         <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
    //             <div  class="col-xs-9">
    //                 <select class="form-control" required name="near_location" >
    //                     <option  value="">Select Location</option>';
    //                     foreach ($nearLocation as $fn) {
    //                         $html .= '<option value="'.$fn->id.'">'.$fn->nikname.'</option>';
    //                     }
    //                     $html .= '</select> 
    //                 <p>(Please ask your advisor what is your location)</p>
    //             </div>
    //         </div>
    //         <div class="form-group">
    //             <label class="col-xs-3 control-label">Vehicle Registration No. <span class="text-danger"></span></label>
    //             <div class="col-xs-9">
    //                 <input type="text"  maxlength="100" placeholder="Enter Vehicle Registration No." name="VehicleReg" class="form-control" >
    //             </div>
    //         </div>';
    //     } elseif ($towrd[0] == "Sales") {
    //         $html = '<div class="form-group" id="payment_location">
    //         <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
    //             <div  class="col-xs-9">
    //                 <select class="form-control" required name="near_location" >
    //                     <option  value="">Select Location</option>';
    //                     foreach ($nearLocation as $fn) {
    //                         $html .= '<option value="'.$fn->id.'">'.$fn->nikname.'</option>';
    //                     }
    //                     $html .= '</select> 
    //                 <p>(Please ask your advisor what is your location)</p>
    //             </div>
    //         </div>';
            
    //     } elseif ($towrd[0] == "Other") {
    //         $html = '<div class="form-group" id="payment_location">
    //             <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
    //             <div class="col-xs-9">
    //                 <input type="text" class="form-control" required name="near_location" >
    //             </div>
    //         </div>
    //         <input type="hidden" name="vehicle_brand" value="'. $paymentToward->vehicle_brand.'">
    //         <input type="hidden" name="type" value="'. $paymentToward->type.'">';
    //     } else {
    //         $html = '<div class="form-group" id="payment_location">
    //         <label class="col-xs-3 control-label">Location <span class="text-danger">*</span></label>
    //             <div  class="col-xs-9">
    //                 <select class="form-control" required name="near_location" >
    //                     <option  value="">Select Location</option>';
    //                     foreach ($nearLocation as $fn) {
    //                         $html .= '<option value="'.$fn->id.'">'.$fn->nikname.'</option>';
    //                     }
    //                     $html .= '</select> 
    //                 <p>(Please ask your advisor what is your location)</p>
    //             </div>
    //         </div>
    //         <div class="form-group" id="payment_location">
    //             <label class="col-xs-3 control-label">Other Specify <span class="text-danger">*</span></label>
    //             <div  class="col-xs-9">
    //                 <input type="text" class="form-control" required name="others" >
    //             </div>
    //         </div>';
    //     }

    //     return $html;
    // }

    public function showReceipt(Request $request)
    {
        if ($request->submit == "save") {
            if ($request->type == "other") {
                $nearLocation = new NearLocation();
                $nearLocation->nikname = $request->near_location;
                $nearLocation->vehicle_brand = $request->vehicle_brand;
                $nearLocation->type = $request->type;
                $nearLocation->hdfc_upi_merchant_id = '';
                $nearLocation->hdfc_upi_merchant_key = '';
                $nearLocation->merchant_id = '';
                $nearLocation->payu_key = '';
                $nearLocation->payu_password = '';
                $nearLocation->payu_salt = '';
                $nearLocation->hdfc_account = '';
                $nearLocation->hdfc_secret = '';
                $nearLocation->location = '';
                $nearLocation->lat = '';
                $nearLocation->lon = '';
                $nearLocation->ac_name = '';
                $nearLocation->ac_email = '';
                $nearLocation->ac_phone = '';
                $nearLocation->type_of_service = '';
                $nearLocation->designation = '';
                $nearLocation->save();
                $lastLocationId = $nearLocation->id;
            }

            //RANDOM SELECTION OF GATEWAY
            $strings = array('uc','pu',);
            $rand_key = array_rand($strings);	

            //GENRATE UNIQUE TRANSACTION STRING
            $uniqueStr= strtoupper(substr(md5(uniqid(rand(), true)), 6, 10));

            $towrd=explode('-',$request->PaymentTowards);

            //SELECT PLACE BY LOCATION TO PAYMENT
            if ($request->type == "other") {
                $locs = NearLocation::where('id', $lastLocationId)->first();

                $loc=$locs->location;
                $phone=$locs->ac_phone;
            } elseif ($towrd[0] == "Other Specify") {
                $locs = NearLocation::where('id', $request->near_location)->first();
                
                $loc=$locs->location;
                $phone=$locs->ac_phone;
            } else {
                // $locs = NearLocation::where('id', $request->near_location)->first();
                $ourBusiness = OurBusiness::find($towrd[1]);

                if ($towrd[0] == "showroom") {
                    $locs = $ourBusiness->showrooms->find($request->near_location);  
                } elseif ($towrd[0] == "service_center") {
                    $locs = $ourBusiness->serviceCenters->find($request->near_location);  
                } elseif ($towrd[0] == "body_shop") {
                    $locs = $ourBusiness->bodyShops->find($request->near_location);  
                } elseif ($towrd[0] == "used_car") {
                    $locs = $ourBusiness->usedCars->find($request->near_location);  
                } elseif ($towrd[0] == "insurance") {
                    $locs = $ourBusiness->businessInsurance->find($request->near_location);  
                }

                $loc=$locs->address;
                $phone=$locs->contact_number;
            }

            // $loc=$locs->location;

            // $phone=$locs['phone'];
            // $phone=$locs->ac_phone;
            $loc_id=$locs->id;
            $amount = $request->Amount;
            // $towrd=explode('-',$request->PaymentTowards);
            $toward=$towrd[0];
            // $merchant_id=$locs->merchant_id;
            // ASSIGN DATA TO LOGS ARRAY
            $LEAD['near_location'] =  $loc;
            $LEAD['trans_id'] =$uniqueStr;
            $LEAD['payment_towards'] =  $toward;
            $LEAD['payment_to'] = $request->paymentTo;
            // $LEAD['pancard_no'] =  clean($_POST['pancard']);
            $LEAD['loc_id'] = $loc_id;
            // $LEAD['registeration_no'] = clean($_POST['VehicleReg']);
            $LEAD['invoice_no'] = $request->InvoiceNo;
            $LEAD['amount'] = $request->Amount;
            // $LEAD['others'] = clean($_POST['others']);
            /*$LEAD['pin_code'] = clean($_POST['PinCode']);
            $LEAD['city'] = clean($_POST['City']);
            $LEAD['state'] = clean($_POST['State']);
            $LEAD['country'] = clean($_POST['Country']);*/
            $LEAD['name'] = $request->Name;
            $LEAD['emailid'] = $request->EmailId;
            $LEAD['mobile_no'] = $request->MobileNo;
            $LEAD['log_time'] = date('Y-m-d H:i:s');

            // INSERT DATA IN LOG		
            //	$db->insert('pay_us_logs', $LEAD);

            $payUsLog = new PayUsLog();
            $payUsLog->user_id = 0;
            $payUsLog->loc_id = $loc_id;
            $payUsLog->trans_id = $uniqueStr;  
            $payUsLog->merchant_id = ' ';  
            $payUsLog->payment_towards = $toward; 
            $payUsLog->payment_to = $request->paymentTo;
            $payUsLog->near_location = $loc;  
            $payUsLog->others = ' ';  
            $payUsLog->pancard_no = ' ' ;  
            $payUsLog->registeration_no = $request->VehicleReg ?? ''; 
            $payUsLog->invoice_no = $request->InvoiceNo;  
            $payUsLog->amount = $request->Amount;
            $payUsLog->name = $request->Name;
            $payUsLog->city = $request->City ?? '';
            $payUsLog->pin_code = ' ' ;
            $payUsLog->state = $request->State ?? '';
            $payUsLog->country = $request->Country ?? '';
            $payUsLog->mobile_no = $request->MobileNo;
            $payUsLog->emailid = $request->EmailId;
            $payUsLog->log_time = date('Y-m-d H:i:s');
            $payUsLog->save();

            return view('frontend.payment.receipt', compact('payUsLog', 'locs', 'amount'));
        }
        // dd($request->all());
    }
    
    public function paymentSubmit(Request $request)
    {
        $data = $request->all();
        switch ($request->payment_to) {
            case "Hans Hyundai":
                return $this->handleHansHyundaiPayment($data);
            case "Galaxy Toyota":
                return $this->handleGalaxyToyotaPayment($data);
            case "Harpreet Ford":
                return $this->handleHarpreetFordPayment($data);
            case "Auto Car Repair (myTVS)":
                return $this->handleAutoCarRepairPayment($data);
            case "AMS Dry ice":
                return $this->handleAMSDryIcePayment($data);
            case "Tsg Auction Mart":
                return $this->handleTSGAuctionMartPayment($data);
            case "Tsg Used Cars":
                return $this->handleTSGAuctionMartPayment($data);
            default:
                // Handle default case or error
                return response()->json(['error' => 'Invalid payment destination'], 400);
        }
    }

    public function successhh(Request $request)
    {
        $MERCHANT_KEY = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $response = $_POST;
        $enc_data = $response['encData'];
        $aes = new AES128();
        $response_dec = $aes->decrypt($enc_data, $MERCHANT_KEY);
        $rarray = $response_dec ? explode('|', $response_dec) : NULL;
        $trans_id = isset($rarray[0]) && $rarray[0] ? $rarray[0] : NULL;
        $success = isset($rarray[2]) && $rarray[2] ? $rarray[2] : NULL;
        $mihpayid = isset($rarray[1]) && $rarray[1] ? $rarray[1] : NULL;
        $transaction_date = isset($rarray[10]) && $rarray[10] ? $rarray[10] : NULL;
        $merchant_id = '1002189';
        $pay_amount = isset($rarray[3]) && $rarray[3] ? $rarray[3] : NULL;
        $aggregator_id = 'SBIEPAY';    

        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <title>The Schdev Group </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        </head>
        <body>
            <div class="container">';

        if($success == 'SUCCESS') {

            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);

            $service_url = 'https://www.sbiepay.sbi/payagg/statusQuery/getStatusQuery';
            $queryRequest="|$merchant_id| $trans_id|$pay_amount";
            $queryRequest33=http_build_query(array('queryRequest' => $queryRequest,"aggregatorId"=>"SBIEPAY","merchantId"=>$merchant_id));
            $ch = curl_init($service_url);
            curl_setopt($ch, CURLOPT_SSLVERSION, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $queryRequest33);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $double_verification_result = curl_exec($ch);
            curl_close($ch);

            $double_array = $double_verification_result ? explode('|', $double_verification_result) : NULL;
            $double_success = isset($rarray[2]) && $rarray[2] ? $rarray[2] : NULL;
            if($double_success == 'SUCCESS'){
                //create PDO Instance
                // $pdo=new PDO($dns,$user,$passoword);
                // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $logs = PayUsLog::where('trans_id', $trans_id)->first()->toArray();
                // $sql_pay_us_log="SELECT * FROM pay_us_logs WHERE trans_id=:trans_id";

                // $myStatement=$pdo->prepare($sql_pay_us_log);
                // $myStatement->execute(['trans_id'=>$trans_id]);
                // $logs=$myStatement->fetch(PDO::FETCH_ASSOC);

                $loc_id = $logs['loc_id'];
                //getting merchant_id from near_location where id= $logs['loc_id']
                // $sql_near_location="SELECT * FROM `near_location` WHERE id=:id";
                // $stmt1=$pdo->prepare($sql_near_location);
                // $stmt1->execute(['id'=>$logs['loc_id']]);
                // $log=$stmt1->fetch(PDO::FETCH_ASSOC);

                $log = NearLocation::where('id', $logs['loc_id'])->first()->toArray();
                $pdo=null;
                try{
                    // $pdo=new PDO($dns,$user,$passoword);
                    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // $sql="INSERT INTO pay_us(user_id, loc_id, gateway, mihpayid, trans_id, payment_towards, payment_to, near_location, others, paid_amount, bill_id, transaction_id,customer_msisdn, status, merchant_id, transaction_time, registeration_no, invoice_no, amount, name, city, pin_code, state, country, mobile_no, emailid) 
                    // VALUES (:user_id, :loc_id, :gateway, :mihpayid, :trans_id, :payment_towards, :payment_to, :near_location, :others, :paid_amount, :bill_id, :transaction_id, :customer_msisdn, :status, :merchant_id, :transaction_time, :registeration_no, :invoice_no, :amount, :name, :city, :pin_code, :state, :country, :mobile_no, :emailid)";
                    // $stmt=$pdo->prepare($sql);

                    /*Get logs Data*/ 
                    // $LEAD['user_id'] =  $logs['user_id'];
                    // $LEAD['trans_id']=$logs['trans_id'];
                    // $LEAD['loc_id']=$logs['loc_id'];
                    // $LEAD['payment_towards']=$logs['payment_towards'];
                    // $LEAD['payment_to']=$logs['payment_to'];
                    // $LEAD['near_location']=$logs['near_location'];
                    // $LEAD['registeration_no']=$logs['registeration_no'];
                    // $LEAD['invoice_no']=$logs['invoice_no'];
                    // $LEAD['amount']=$logs['amount'];		
                    // $LEAD['pin_code']=$logs['pin_code'];
                    // $LEAD['city']=$logs['city'];
                    // $LEAD['state']=$logs['state'];
                    // $LEAD['country']=$logs['country'];
                    // $LEAD['name']=$logs['name'];
                    // $LEAD['emailid']=$logs['emailid'];
                    // $LEAD['mobile_no']=$logs['mobile_no'];
                    // /*Response fields*/
                    // $LEAD['gateway']='sbiepay';
                    // $LEAD['mihpayid']=$mihpayid;
                    // $LEAD['paid_amount']=$pay_amount;
                    // $LEAD['transaction_id']=$trans_id;
                    // $LEAD['customer_msisdn']=$logs['mobile_no'];
                    // $LEAD['status']=$success;
                    // $LEAD['merchant_id']=$merchant_id;
                    // $LEAD['transaction_time']=$transaction_date;

                    // $LEAD['others']='';
                    // $LEAD['bill_id']='';

                    // $stmt->execute($LEAD);

                    $pay_us = new PayUs();
                    $pay_us->user_id = $logs['user_id'];
                    $pay_us->loc_id = $logs['loc_id'];
                    $pay_us->gateway = 'sbiepay';
                    $pay_us->mihpayid = $mihpayid;
                    $pay_us->trans_id = $logs['trans_id'];
                    $pay_us->payment_towards = $logs['payment_towards'];
                    $pay_us->payment_to = $logs['payment_to'];
                    $pay_us->near_location = $logs['near_location'];
                    $pay_us->others = '';
                    $pay_us->paid_amount = $pay_amount;
                    $pay_us->bill_id = '';
                    $pay_us->transaction_id = $trans_id;
                    $pay_us->customer_msisdn = $logs['mobile_no'];
                    $pay_us->status = $success;
                    $pay_us->merchant_id = $merchant_id;
                    $pay_us->transaction_time = $transaction_date;
                    $pay_us->registeration_no = $logs['registeration_no'];
                    $pay_us->invoice_no = $logs['invoice_no'];
                    $pay_us->amount = $logs['amount'];
                    $pay_us->name = $logs['name'];
                    $pay_us->city = $logs['city'];
                    $pay_us->pin_code = $logs['pin_code'];
                    $pay_us->country = $logs['country'];
                    $pay_us->mobile_no = $logs['mobile_no'];
                    $pay_us->emailid = $logs['emailid'];
                    $pay_us->save();

                    //sending sms
                    $mobile_number = $log['ac_phone'].',8130271181';
                    $sender = 'TOYOTA';
                    $message = $log['ac_name']." Payment of Rs ".$logs['amount']." has been Received From ".$logs['name']." - ".$logs['mobile_no']." Via Trans ID: ".$logs['trans_id']." On ".$transaction_date." For invoice no ".$logs['invoice_no']." Payment Gateway- SBIePayRefID-".$mihpayid." for ".$logs['payment_towards']." , ".$logs['payment_to']." , ". $logs['near_location'];

                    $message1='Dear '.$logs['name'].' , Payment of Rs '.$logs['amount'].' has been Received Via Trans ID: '.$logs['trans_id'].' On '.$transaction_date.' with invoice no '.$logs['invoice_no'].'  for'.$logs['payment_towards'].' , '.$logs['payment_to']. ','.$logs['near_location'];

                    try{

                        $url="http://prosms.contourdigitalmedia.com/http-tokenkeyapi.php?authentic-key=37325473676469673739361581911903&senderid=".$sender."&route=2&number=".$mobile_number."&message=".rawurlencode($message);

                        $ch=curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch,CURLOPT_POST,1);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                        curl_exec($ch);

                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    //sending sms to customer

                     try{

                        $url1="http://prosms.contourdigitalmedia.com/http-tokenkeyapi.php?authentic-key=37325473676469673739361581911903&senderid=".$sender."&route=2&number=".$logs['mobile_no']."&message=".rawurlencode($message1);

                        $ch1=curl_init($url1);
                        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch1,CURLOPT_POST,1);
                        curl_setopt($ch1,CURLOPT_POSTFIELDS,"");
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER,2);
                        curl_exec($ch1);

                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    $html .= '<div class="alert alert-success">
                        <strong>Success!</strong> Thanks You, You have completed your payment successfully.
                    </div>';
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            } else{
                $html .= '<div class="alert alert-danger">
                    <strong>Failed</strong> There is some problem. Please Try Again !
                </div>';
            }
        }else{
            $html .= '<div class="alert alert-danger">
                <strong>Failed</strong> There is some problem. Please Try Again !
            </div>';
        }

        $html .= '<a class="btn btn-primary" href="https://thesachdevgroup.com/">Return to Home Page</a>
                </div>
            </body>
        </html>';

        return response()->make($html);
    }

    public function successgt(Request $request)
    {
        $MERCHANT_KEY = "vfP0FxikwzjZVXMirqrRlWnMF1eXBDxAAuCvg8ewFUQ=";
        $response = $_POST;
        $enc_data = $response['encData'];
        $aes = new AES128();
        $response_dec = $aes->decrypt($enc_data, $MERCHANT_KEY);
        $rarray = $response_dec ? explode('|', $response_dec) : NULL;
        $trans_id = isset($rarray[0]) && $rarray[0] ? $rarray[0] : NULL;
        $success = isset($rarray[2]) && $rarray[2] ? $rarray[2] : NULL;
        $mihpayid = isset($rarray[1]) && $rarray[1] ? $rarray[1] : NULL;
        $transaction_date = isset($rarray[10]) && $rarray[10] ? $rarray[10] : NULL;
        $merchant_id = '1002188';
        $pay_amount = isset($rarray[3]) && $rarray[3] ? $rarray[3] : NULL;
        $aggregator_id = 'SBIEPAY';

        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <title>The Schdev Group </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        </head>
        <body>
            <div class="container">';

        if($success == 'SUCCESS') {

            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);

            $service_url = 'https://www.sbiepay.sbi/payagg/statusQuery/getStatusQuery';
            $queryRequest="|$merchant_id| $trans_id|$pay_amount";
            $queryRequest33=http_build_query(array('queryRequest' => $queryRequest,"aggregatorId"=>"SBIEPAY","merchantId"=>$merchant_id));
            $ch = curl_init($service_url);
            curl_setopt($ch, CURLOPT_SSLVERSION, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $queryRequest33);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $double_verification_result = curl_exec($ch);
            curl_close($ch);

            $double_array = $double_verification_result ? explode('|', $double_verification_result) : NULL;
            $double_success = isset($rarray[2]) && $rarray[2] ? $rarray[2] : NULL;
            if($double_success == 'SUCCESS'){
                //create PDO Instance
                // $pdo=new PDO($dns,$user,$passoword);
                // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $logs = PayUsLog::where('trans_id', $trans_id)->first()->toArray();
                // $sql_pay_us_log="SELECT * FROM pay_us_logs WHERE trans_id=:trans_id";

                // $myStatement=$pdo->prepare($sql_pay_us_log);
                // $myStatement->execute(['trans_id'=>$trans_id]);
                // $logs=$myStatement->fetch(PDO::FETCH_ASSOC);

                $loc_id = $logs['loc_id'];
                //getting merchant_id from near_location where id= $logs['loc_id']
                // $sql_near_location="SELECT * FROM `near_location` WHERE id=:id";
                // $stmt1=$pdo->prepare($sql_near_location);
                // $stmt1->execute(['id'=>$logs['loc_id']]);
                // $log=$stmt1->fetch(PDO::FETCH_ASSOC);

                $log = NearLocation::where('id', $logs['loc_id'])->first()->toArray();
                $pdo=null;
                try{
                    // $pdo=new PDO($dns,$user,$passoword);
                    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // $sql="INSERT INTO pay_us(user_id, loc_id, gateway, mihpayid, trans_id, payment_towards, payment_to, near_location, others, paid_amount, bill_id, transaction_id,customer_msisdn, status, merchant_id, transaction_time, registeration_no, invoice_no, amount, name, city, pin_code, state, country, mobile_no, emailid) 
                    // VALUES (:user_id, :loc_id, :gateway, :mihpayid, :trans_id, :payment_towards, :payment_to, :near_location, :others, :paid_amount, :bill_id, :transaction_id, :customer_msisdn, :status, :merchant_id, :transaction_time, :registeration_no, :invoice_no, :amount, :name, :city, :pin_code, :state, :country, :mobile_no, :emailid)";
                    // $stmt=$pdo->prepare($sql);

                    /*Get logs Data*/ 
                    // $LEAD['user_id'] =  $logs['user_id'];
                    // $LEAD['trans_id']=$logs['trans_id'];
                    // $LEAD['loc_id']=$logs['loc_id'];
                    // $LEAD['payment_towards']=$logs['payment_towards'];
                    // $LEAD['payment_to']=$logs['payment_to'];
                    // $LEAD['near_location']=$logs['near_location'];
                    // $LEAD['registeration_no']=$logs['registeration_no'];
                    // $LEAD['invoice_no']=$logs['invoice_no'];
                    // $LEAD['amount']=$logs['amount'];		
                    // $LEAD['pin_code']=$logs['pin_code'];
                    // $LEAD['city']=$logs['city'];
                    // $LEAD['state']=$logs['state'];
                    // $LEAD['country']=$logs['country'];
                    // $LEAD['name']=$logs['name'];
                    // $LEAD['emailid']=$logs['emailid'];
                    // $LEAD['mobile_no']=$logs['mobile_no'];
                    // /*Response fields*/
                    // $LEAD['gateway']='sbiepay';
                    // $LEAD['mihpayid']=$mihpayid;
                    // $LEAD['paid_amount']=$pay_amount;
                    // $LEAD['transaction_id']=$trans_id;
                    // $LEAD['customer_msisdn']=$logs['mobile_no'];
                    // $LEAD['status']=$success;
                    // $LEAD['merchant_id']=$merchant_id;
                    // $LEAD['transaction_time']=$transaction_date;

                    // $LEAD['others']='';
                    // $LEAD['bill_id']='';

                    // $stmt->execute($LEAD);

                    $pay_us = new PayUs();
                    $pay_us->user_id = $logs['user_id'];
                    $pay_us->loc_id = $logs['loc_id'];
                    $pay_us->gateway = 'sbiepay';
                    $pay_us->mihpayid = $mihpayid;
                    $pay_us->trans_id = $logs['trans_id'];
                    $pay_us->payment_towards = $logs['payment_towards'];
                    $pay_us->payment_to = $logs['payment_to'];
                    $pay_us->near_location = $logs['near_location'];
                    $pay_us->others = '';
                    $pay_us->paid_amount = $pay_amount;
                    $pay_us->bill_id = '';
                    $pay_us->transaction_id = $trans_id;
                    $pay_us->customer_msisdn = $logs['mobile_no'];
                    $pay_us->status = $success;
                    $pay_us->merchant_id = $merchant_id;
                    $pay_us->transaction_time = $transaction_date;
                    $pay_us->registeration_no = $logs['registeration_no'];
                    $pay_us->invoice_no = $logs['invoice_no'];
                    $pay_us->amount = $logs['amount'];
                    $pay_us->name = $logs['name'];
                    $pay_us->city = $logs['city'];
                    $pay_us->pin_code = $logs['pin_code'];
                    $pay_us->country = $logs['country'];
                    $pay_us->mobile_no = $logs['mobile_no'];
                    $pay_us->emailid = $logs['emailid'];
                    $pay_us->save();

                    //sending sms
                    $mobile_number = $log['ac_phone'].',8130271181';
                    $sender = 'TOYOTA';
                    $message = $log['ac_name']." Payment of Rs ".$logs['amount']." has been Received From ".$logs['name']." - ".$logs['mobile_no']." Via Trans ID: ".$logs['trans_id']." On ".$transaction_date." For invoice no ".$logs['invoice_no']." Payment Gateway- SBIePayRefID-".$mihpayid." for ".$logs['payment_towards']." , ".$logs['payment_to']." , ". $logs['near_location'];

                    $message1='Dear '.$logs['name'].' , Payment of Rs '.$logs['amount'].' has been Received Via Trans ID: '.$logs['trans_id'].' On '.$transaction_date.' with invoice no '.$logs['invoice_no'].'  for'.$logs['payment_towards'].' , '.$logs['payment_to']. ','.$logs['near_location'];

                    try{

                        $url="http://prosms.contourdigitalmedia.com/http-tokenkeyapi.php?authentic-key=37325473676469673739361581911903&senderid=".$sender."&route=2&number=".$mobile_number."&message=".rawurlencode($message);

                        $ch=curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch,CURLOPT_POST,1);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                        curl_exec($ch);

                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    //sending sms to customer

                        try{

                        $url1="http://prosms.contourdigitalmedia.com/http-tokenkeyapi.php?authentic-key=37325473676469673739361581911903&senderid=".$sender."&route=2&number=".$logs['mobile_no']."&message=".rawurlencode($message1);

                        $ch1=curl_init($url1);
                        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch1,CURLOPT_POST,1);
                        curl_setopt($ch1,CURLOPT_POSTFIELDS,"");
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER,2);
                        curl_exec($ch1);

                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    $html .= '<div class="alert alert-success">
                        <strong>Success!</strong> Thanks You, You have completed your payment successfully.
                    </div>';
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            } else{
                $html .= '<div class="alert alert-danger">
                    <strong>Failed</strong> There is some problem. Please Try Again !
                </div>';
            }
        }else{
            $html .= '<div class="alert alert-danger">
                <strong>Failed</strong> There is some problem. Please Try Again !
            </div>';
        }

        $html .= '<a class="btn btn-primary" href="https://thesachdevgroup.com/">Return to Home Page</a>
                </div>
            </body>
        </html>';
    
        return response()->make($html);            
    }
    
    public function successhf(Request $request)
    {
        $MERCHANT_KEY = "TPd1/eCCFFwTlvfGcpSTbHeAy3VXruQpVX/wcSzK/AE=";
        $response = $_POST;
        $enc_data = $response['encData'];
        $aes = new AES128();
        $response_dec = $aes->decrypt($enc_data, $MERCHANT_KEY);
        $rarray = $response_dec ? explode('|', $response_dec) : NULL;
        $trans_id = isset($rarray[0]) && $rarray[0] ? $rarray[0] : NULL;
        $success = isset($rarray[2]) && $rarray[2] ? $rarray[2] : NULL;
        $mihpayid = isset($rarray[1]) && $rarray[1] ? $rarray[1] : NULL;
        $transaction_date = isset($rarray[10]) && $rarray[10] ? $rarray[10] : NULL;
        $merchant_id = '1002189';
        $pay_amount = isset($rarray[3]) && $rarray[3] ? $rarray[3] : NULL;
        $aggregator_id = 'SBIEPAY';    

        $html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <title>The Schdev Group </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        </head>
        <body>
            <div class="container">';

        if($success == 'SUCCESS') {

            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);

            $service_url = 'https://www.sbiepay.sbi/payagg/statusQuery/getStatusQuery';
            $queryRequest="|$merchant_id| $trans_id|$pay_amount";
            $queryRequest33=http_build_query(array('queryRequest' => $queryRequest,"aggregatorId"=>"SBIEPAY","merchantId"=>$merchant_id));
            $ch = curl_init($service_url);
            curl_setopt($ch, CURLOPT_SSLVERSION, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $queryRequest33);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $double_verification_result = curl_exec($ch);
            curl_close($ch);

            $double_array = $double_verification_result ? explode('|', $double_verification_result) : NULL;
            $double_success = isset($rarray[2]) && $rarray[2] ? $rarray[2] : NULL;
            if($double_success == 'SUCCESS'){
                //create PDO Instance
                // $pdo=new PDO($dns,$user,$passoword);
                // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $logs = PayUsLog::where('trans_id', $trans_id)->first()->toArray();
                // $sql_pay_us_log="SELECT * FROM pay_us_logs WHERE trans_id=:trans_id";

                // $myStatement=$pdo->prepare($sql_pay_us_log);
                // $myStatement->execute(['trans_id'=>$trans_id]);
                // $logs=$myStatement->fetch(PDO::FETCH_ASSOC);

                $loc_id = $logs['loc_id'];
                //getting merchant_id from near_location where id= $logs['loc_id']
                // $sql_near_location="SELECT * FROM `near_location` WHERE id=:id";
                // $stmt1=$pdo->prepare($sql_near_location);
                // $stmt1->execute(['id'=>$logs['loc_id']]);
                // $log=$stmt1->fetch(PDO::FETCH_ASSOC);

                $log = NearLocation::where('id', $logs['loc_id'])->first()->toArray();
                $pdo=null;
                try{
                    // $pdo=new PDO($dns,$user,$passoword);
                    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // $sql="INSERT INTO pay_us(user_id, loc_id, gateway, mihpayid, trans_id, payment_towards, payment_to, near_location, others, paid_amount, bill_id, transaction_id,customer_msisdn, status, merchant_id, transaction_time, registeration_no, invoice_no, amount, name, city, pin_code, state, country, mobile_no, emailid) 
                    // VALUES (:user_id, :loc_id, :gateway, :mihpayid, :trans_id, :payment_towards, :payment_to, :near_location, :others, :paid_amount, :bill_id, :transaction_id, :customer_msisdn, :status, :merchant_id, :transaction_time, :registeration_no, :invoice_no, :amount, :name, :city, :pin_code, :state, :country, :mobile_no, :emailid)";
                    // $stmt=$pdo->prepare($sql);

                    /*Get logs Data*/ 
                    // $LEAD['user_id'] =  $logs['user_id'];
                    // $LEAD['trans_id']=$logs['trans_id'];
                    // $LEAD['loc_id']=$logs['loc_id'];
                    // $LEAD['payment_towards']=$logs['payment_towards'];
                    // $LEAD['payment_to']=$logs['payment_to'];
                    // $LEAD['near_location']=$logs['near_location'];
                    // $LEAD['registeration_no']=$logs['registeration_no'];
                    // $LEAD['invoice_no']=$logs['invoice_no'];
                    // $LEAD['amount']=$logs['amount'];		
                    // $LEAD['pin_code']=$logs['pin_code'];
                    // $LEAD['city']=$logs['city'];
                    // $LEAD['state']=$logs['state'];
                    // $LEAD['country']=$logs['country'];
                    // $LEAD['name']=$logs['name'];
                    // $LEAD['emailid']=$logs['emailid'];
                    // $LEAD['mobile_no']=$logs['mobile_no'];
                    // /*Response fields*/
                    // $LEAD['gateway']='sbiepay';
                    // $LEAD['mihpayid']=$mihpayid;
                    // $LEAD['paid_amount']=$pay_amount;
                    // $LEAD['transaction_id']=$trans_id;
                    // $LEAD['customer_msisdn']=$logs['mobile_no'];
                    // $LEAD['status']=$success;
                    // $LEAD['merchant_id']=$merchant_id;
                    // $LEAD['transaction_time']=$transaction_date;

                    // $LEAD['others']='';
                    // $LEAD['bill_id']='';

                    // $stmt->execute($LEAD);

                    $pay_us = new PayUs();
                    $pay_us->user_id = $logs['user_id'];
                    $pay_us->loc_id = $logs['loc_id'];
                    $pay_us->gateway = 'sbiepay';
                    $pay_us->mihpayid = $mihpayid;
                    $pay_us->trans_id = $logs['trans_id'];
                    $pay_us->payment_towards = $logs['payment_towards'];
                    $pay_us->payment_to = $logs['payment_to'];
                    $pay_us->near_location = $logs['near_location'];
                    $pay_us->others = '';
                    $pay_us->paid_amount = $pay_amount;
                    $pay_us->bill_id = '';
                    $pay_us->transaction_id = $trans_id;
                    $pay_us->customer_msisdn = $logs['mobile_no'];
                    $pay_us->status = $success;
                    $pay_us->merchant_id = $merchant_id;
                    $pay_us->transaction_time = $transaction_date;
                    $pay_us->registeration_no = $logs['registeration_no'];
                    $pay_us->invoice_no = $logs['invoice_no'];
                    $pay_us->amount = $logs['amount'];
                    $pay_us->name = $logs['name'];
                    $pay_us->city = $logs['city'];
                    $pay_us->pin_code = $logs['pin_code'];
                    $pay_us->country = $logs['country'];
                    $pay_us->mobile_no = $logs['mobile_no'];
                    $pay_us->emailid = $logs['emailid'];
                    $pay_us->save();

                    //sending sms
                    $mobile_number = $log['ac_phone'].',8130271181';
                    $sender = 'TOYOTA';
                    $message = $log['ac_name']." Payment of Rs ".$logs['amount']." has been Received From ".$logs['name']." - ".$logs['mobile_no']." Via Trans ID: ".$logs['trans_id']." On ".$transaction_date." For invoice no ".$logs['invoice_no']." Payment Gateway- SBIePayRefID-".$mihpayid." for ".$logs['payment_towards']." , ".$logs['payment_to']." , ". $logs['near_location'];

                    $message1='Dear '.$logs['name'].' , Payment of Rs '.$logs['amount'].' has been Received Via Trans ID: '.$logs['trans_id'].' On '.$transaction_date.' with invoice no '.$logs['invoice_no'].'  for'.$logs['payment_towards'].' , '.$logs['payment_to']. ','.$logs['near_location'];

                    try{

                        $url="http://prosms.contourdigitalmedia.com/http-tokenkeyapi.php?authentic-key=37325473676469673739361581911903&senderid=".$sender."&route=2&number=".$mobile_number."&message=".rawurlencode($message);

                        $ch=curl_init($url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch,CURLOPT_POST,1);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                        curl_exec($ch);

                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    //sending sms to customer

                     try{

                        $url1="http://prosms.contourdigitalmedia.com/http-tokenkeyapi.php?authentic-key=37325473676469673739361581911903&senderid=".$sender."&route=2&number=".$logs['mobile_no']."&message=".rawurlencode($message1);

                        $ch1=curl_init($url1);
                        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch1,CURLOPT_POST,1);
                        curl_setopt($ch1,CURLOPT_POSTFIELDS,"");
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER,2);
                        curl_exec($ch1);

                    }catch(Exception $e){
                        die('Error: '.$e->getMessage());
                    }
                    $html .= '<div class="alert alert-success">
                        <strong>Success!</strong> Thanks You, You have completed your payment successfully.
                    </div>';
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            } else{
                $html .= '<div class="alert alert-danger">
                    <strong>Failed</strong> There is some problem. Please Try Again !
                </div>';
            }
        }else{
            $html .= '<div class="alert alert-danger">
                <strong>Failed</strong> There is some problem. Please Try Again !
            </div>';
        }

        $html .= '<a class="btn btn-primary" href="https://thesachdevgroup.com/">Return to Home Page</a>
                </div>
            </body>
        </html>';

        return response()->make($html);
    }

    public function handleHansHyundaiPayment($data)
    {
        //print_r($data);exit;
        //error_reporting(E_ALL);
        //ini_set('display_errors', 'On');
        
        // Merchant key here as provided by SBI
        //$MERCHANT_KEY = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s="; //Please change this value with live key for production
        //$success_url = "https://test.sbiepay.sbi/secure/sucess3.jsp";
        //$fail_url = 'https://test.sbiepay.sbi/secure/fail3.jsp';

        $MERCHANT_KEY = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        // $success_url = 'https://thesachdevgroup.com/sbi/successhh.php';
        // $fail_url = 'https://thesachdevgroup.com/cancel.php';
        $success_url = route('payment.successhh');
        $fail_url = route('payment.cancel');

        $merchant_id = '1002189';
        $operation_mode = 'DOM';
        $merchant_country = 'IN';
        $merchant_currency = 'INR';

        $amount = isset($data['amount']) && $data['amount'] ? $data['amount'] : "";
        $amount1 = $amount/2;
        $amount2 = $amount1;

        //$key = "kLor6or9IaldjgQaRtRDBw==";
        $fname = isset($data['firstname']) && $data['firstname'] ? $data['firstname'] : "";
        $locations = isset($data['location']) && $data['location'] ? $data['location'] : "";

        switch ($locations) {
            case "7":
                $locations="Moti Nagar showroom";
                break;
            case "19":
                $locations="Badli(North West Delhi)";
                break;
            case "17":
                $locations="Moti Nagar workshop(West Delhi)";
                break;
            case "18":
                $locations="Naraina(South West Delhi)";
                break;
            case "20":
                $locations="Zakhira Bodyshop";
                break;
            case "104":
                $locations="Used Car (Head Office)";
                break;
            default:
        }

        $txnid = isset($data['txnid']) && $data['txnid'] ? $data['txnid'] : "";
        $email = isset($data['email']) && $data['email'] ? $data['email'] : "";
        $productinfo = isset($data['productinfo']) && $data['productinfo'] ? $data['productinfo'] : "";
        $phone = isset($data['phone']) && $data['phone'] ? $data['phone'] : "";

        //$key = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $BUSINESSNAME="Charu Motors Pvt Ltd";
        $MultiAccountInstructionDtls = $amount1."|INR|GRPT||".$amount2."|INR|NEFT";
        $other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone.'^'.$BUSINESSNAME;

        //$other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone;
        $aggregator_id = 'SBIEPAY';
        $merchant_order_no = $txnid;
        $merchant_customer_id = $txnid;
        $pay_mode = isset($data['pay_mode']) && $data['pay_mode'] ? $data['pay_mode'] : '';
        $access_medium = 'ONLINE';
        $transaction_source = 'ONLINE';

        $requestParameter = $merchant_id.'|'.$operation_mode.'|'.$merchant_country.'|'.$merchant_currency.'|'.$amount.'|'.$other.'|'.$success_url.'|'.$fail_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;

        $aes = new AES128();
        $EncryptTrans = $aes->encrypt($requestParameter, $MERCHANT_KEY);
        $EncryptMAId = $aes->encrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        //$EncryptTrans1 = $aes->decrypt($requestParameter, $MERCHANT_KEY);
        //$EncryptMAId1 = $aes->decrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);
        //exit;

        return response()->make('<html>
            <head>
                <script>
                    function submitSbiForm() {
                        document.getElementById("submit-form").click();
                    }
                </script>
            </head>
            <body onload="submitSbiForm()">
                <form name="sbiForm" id="sbiForm" method="post" action="https://www.sbiepay.sbi/secure/AggregatorHostedListener">
                    <input type="hidden" name="EncryptTrans" value="'. $EncryptTrans .'">
                    <input type="hidden" name="merchIdVal" value ="'. $merchant_id .'"/>
                    <input type="hidden" name="MultiAccountInstructionDtls" value="'. $EncryptMAId .'">
                    <input type="submit" name="submit" id="submit-form" value="Submit" style="display: none">
                </form>
            </body>
        </html>');
    }

    public function handleGalaxyToyotaPayment($data)
    {
        //$MERCHANT_KEY = "4jbSDg8x+9uudZkmzU5aShR6RnqfN0pblYspHaHifxPISlq+BDD4UPzVpDSrvMnz";
        //$success_url = "https://test.sbiepay.sbi/secure/sucess3.jsp";
        //$fail_url = 'https://test.sbiepay.sbi/secure/fail3.jsp';

        $MERCHANT_KEY = "vfP0FxikwzjZVXMirqrRlWnMF1eXBDxAAuCvg8ewFUQ="; //Please change this value with live key for production
        // $success_url = 'https://thesachdevgroup.com/sbi/successgt.php';
        // $fail_url = 'https://thesachdevgroup.com/cancel.php';
        $success_url = route('payment.successgt');
        $fail_url = route('payment.cancel');

        $merchant_id = '1002188';
        $operation_mode = 'DOM';
        $merchant_country = 'IN';
        $merchant_currency = 'INR';

        $amount = isset($data['amount']) && $data['amount'] ? $data['amount'] : "";
        $amount1 = $amount/2;
        $amount2 = $amount1;

        //$key = "5MFuoRco/pJi7Gw/RQlBIQ==";
        $fname = isset($data['firstname']) && $data['firstname'] ? $data['firstname'] : "";
        $locations = isset($data['location']) && $data['location'] ? $data['location'] : "";

        switch ($locations) {
            case "1":
                $locations="Motinagar Showroom";
                break;
            case "6":
                $locations="Dwarka Showroom";
                break;
            case "3":
                $locations="Chattarpur Showroom";
                break;
            case "2":
                $locations="Lajpatnagar Showroom";
                break;
            case "5":
                $locations="Shalimar Place Showroom";
                break;
            case "17":
                $locations="Moti Nagar Service";
                break;
            case "61":
                $locations="Moti Nagar";
                break;
            case "7":
                $locations="DLF";
                break;
            case "57":
                $locations="Kundli Service";
                break;
            case "9":
                $locations="Azadpur Service";
                break;
            case "10":
                $locations="Okhla Service";
                break;
            case "11":
                $locations="Moti Nagar";
                break;
            default:
        }

        $txnid = isset($data['txnid']) && $data['txnid'] ? $data['txnid'] : "";
        $email = isset($data['email']) && $data['email'] ? $data['email'] : "";
        $productinfo = isset($data['productinfo']) && $data['productinfo'] ? $data['productinfo'] : "";
        $phone = isset($data['phone']) && $data['phone'] ? $data['phone'] : "";

        //$key = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $MultiAccountInstructionDtls = $amount1."|INR|GRPT||".$amount2."|INR|NEFT";
        $other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone;

        $aggregator_id = 'SBIEPAY';
        $merchant_order_no = $txnid;
        $merchant_customer_id = $txnid;
        $pay_mode = isset($data['pay_mode']) && $data['pay_mode'] ? $data['pay_mode'] : '';
        $access_medium = 'ONLINE';
        $transaction_source = 'ONLINE';

        $requestParameter = $merchant_id.'|'.$operation_mode.'|'.$merchant_country.'|'.$merchant_currency.'|'.$amount.'|'.$other.'|'.$success_url.'|'.$fail_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;

        $aes = new AES128();
        $EncryptTrans = $aes->encrypt($requestParameter, $MERCHANT_KEY);
        $EncryptMAId = $aes->encrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        //$EncryptTrans1 = $aes->encrypt($MERCHANT_KEY, $key);
        //$EncryptMAId1 = $aes->decrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);
        return response()->make('<html>
            <head>
                <script>
                    function submitSbiForm() {
                        document.getElementById("submit-form").click();
                    }
                </script>
            </head>
            <body onload="submitSbiForm()">
                <form name="sbiForm" id="sbiForm" method="post" action="https://www.sbiepay.sbi/secure/AggregatorHostedListener">
                    <input type="hidden" name="EncryptTrans" value="'. $EncryptTrans .'">
                    <input type="hidden" name="merchIdVal" value ="'. $merchant_id .'"/>
                    <input type="hidden" name="MultiAccountInstructionDtls" value="'. $EncryptMAId .'">
                    <input type="submit" name="submit" id="submit-form" value="Submit" style="display: none">
                </form>
            </body>
        </html>');

    }

    public function handleHarpreetFordPayment($data)
    {
        //$MERCHANT_KEY = "9iiSrfROVVl2P0j5JcW01qeOBiyGMHVeJZ//A6JB8ie+IBBv+OlwiYGj19xQX92Q";
        //$success_url = "https://test.sbiepay.sbi/secure/sucess3.jsp";
        //$fail_url = 'https://test.sbiepay.sbi/secure/fail3.jsp';

        $MERCHANT_KEY = "TPd1/eCCFFwTlvfGcpSTbHeAy3VXruQpVX/wcSzK/AE="; //Please change this value with live key for production
        // $success_url = 'https://thesachdevgroup.com/sbi/successhf.php';
        // $fail_url = 'https://thesachdevgroup.com/cancel.php';
        $success_url = route('payment.successhf');
        $fail_url = route('payment.cancel');

        $merchant_id = '1002190';
        $operation_mode = 'DOM';
        $merchant_country = 'IN';
        $merchant_currency = 'INR';

        $amount = isset($data['amount']) && $data['amount'] ? $data['amount'] : "";
        $amount1 = $amount/2;
        $amount2 = $amount1;

        //$key = "5MFuoRco/pJi7Gw/RQlBIQ==";
        $fname = isset($data['firstname']) && $data['firstname'] ? $data['firstname'] : "";
        $locations = isset($data['location']) && $data['location'] ? $data['location'] : "";

        switch ($locations) {
            case "20":
                $locations="Moti Nagar workshop(West Delhi)";
                break;
            case "23":
                $locations="Gurgaon(NCR)";
                break;
            case "22":
                $locations="Jahangirpuri(North Delhi)";
                break;
            case "24":
                $locations="Okhla(South Delhi)";
                break;
            case "21":
                $locations="Sahibabad(NCR)";
                break;
            case "25":
                $locations="Kundli";
                break;
            case "26":
                $locations="Moti Nagar";
                break;
            default:
        }
        $txnid = isset($data['txnid']) && $data['txnid'] ? $data['txnid'] : "";
        $email = isset($data['email']) && $data['email'] ? $data['email'] : "";
        $productinfo = isset($data['productinfo']) && $data['productinfo'] ? $data['productinfo'] : "";
        $phone = isset($data['phone']) && $data['phone'] ? $data['phone'] : "";

        //$key = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $MultiAccountInstructionDtls = $amount1."|INR|GRPT||".$amount2."|INR|NEFT";
        $other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone;

        $aggregator_id = 'SBIEPAY';
        $merchant_order_no = $txnid;
        $merchant_customer_id = $txnid;
        $pay_mode = isset($data['pay_mode']) && $data['pay_mode'] ? $data['pay_mode'] : '';
        $access_medium = 'ONLINE';
        $transaction_source = 'ONLINE';

        $requestParameter = $merchant_id.'|'.$operation_mode.'|'.$merchant_country.'|'.$merchant_currency.'|'.$amount.'|'.$other.'|'.$success_url.'|'.$fail_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;
        
        $aes = new AES128();
        $EncryptTrans = $aes->encrypt($requestParameter, $MERCHANT_KEY);
        $EncryptMAId = $aes->encrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        //$EncryptTrans1 = $aes->encrypt($MERCHANT_KEY, $key);
        //$EncryptMAId1 = $aes->decrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        return response()->make('<html>
            <head>
                <script>
                    function submitSbiForm() {
                        document.getElementById("submit-form").click();
                    }
                </script>
            </head>
            <body onload="submitSbiForm()">
                <form name="sbiForm" id="sbiForm" method="post" action="https://www.sbiepay.sbi/secure/AggregatorHostedListener">
                    <input type="hidden" name="EncryptTrans" value="'. $EncryptTrans .'">
                    <input type="hidden" name="merchIdVal" value ="'. $merchant_id .'"/>
                    <input type="hidden" name="MultiAccountInstructionDtls" value="'. $EncryptMAId .'">
                    <input type="submit" name="submit" id="submit-form" value="Submit" style="display: none">
                </form>
            </body>
        </html>');
    }

    public function handleAutoCarRepairPayment($data)
    {
        // Merchant key here as provided by SBI
        // $MERCHANT_KEY = "NagApO2LAnirS1NWqX6V3sJBaeki1+lk7tlMX8R23MlWZ+iMVnnousNV/iDxFf2y"; //Please change this value with live key for production
        //$success_url = "https://test.sbiepay.sbi/secure/sucess3.jsp";
        //$fail_url = 'https://test.sbiepay.sbi/secure/fail3.jsp';

        $MERCHANT_KEY = "QE8un0CB4Ohq7RYAi9xO7s0/saqgqiK2jUIEiBjxqiI="; //Please change this value with live key for production
        // $success_url = 'https://thesachdevgroup.com/sbi/successhh.php';
        // $fail_url = 'https://thesachdevgroup.com/cancel.php';
        $success_url = route('payment.successhh');
        $fail_url = route('payment.cancel');

        $merchant_id = '1002693';
        $operation_mode = 'DOM';
        $merchant_country = 'IN';
        $merchant_currency = 'INR';

        $amount = isset($data['amount']) && $data['amount'] ? $data['amount'] : "";
        $amount1 = $amount/2;
        $amount2 = $amount1;

        //$key = "kLor6or9IaldjgQaRtRDBw==";
        $fname = isset($data['firstname']) && $data['firstname'] ? $data['firstname'] : "";
        $locations = isset($data['location']) && $data['location'] ? $data['location'] : "";

        switch ($locations) {
            case "7":
                $locations="Moti Nagar showroom";
                break;
            case "19":
                $locations="Badli(North West Delhi)";
                break;
            case "17":
                $locations="Moti Nagar workshop(West Delhi)";
                break;
            case "18":
                $locations="Naraina(South West Delhi)";
                break;
            case "20":
                $locations="Zakhira Bodyshop";
                break;
            case "104":
                $locations="Used Car (Head Office)";
                break;
            default:
        }

        $txnid = isset($data['txnid']) && $data['txnid'] ? $data['txnid'] : "";
        $email = isset($data['email']) && $data['email'] ? $data['email'] : "";
        $productinfo = isset($data['productinfo']) && $data['productinfo'] ? $data['productinfo'] : "";
        $phone = isset($data['phone']) && $data['phone'] ? $data['phone'] : "";

        //$key = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $BUSINESSNAME="Charu Motors Pvt Ltd";
        $MultiAccountInstructionDtls = $amount1."|INR|GRPT||".$amount2."|INR|NEFT";
        $other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone.'^'.$BUSINESSNAME;
        //$other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone;

        $aggregator_id = 'SBIEPAY';
        $merchant_order_no = $txnid;
        $merchant_customer_id = $txnid;
        $pay_mode = isset($data['pay_mode']) && $data['pay_mode'] ? $data['pay_mode'] : '';
        $access_medium = 'ONLINE';
        $transaction_source = 'ONLINE';

        $requestParameter = $merchant_id.'|'.$operation_mode.'|'.$merchant_country.'|'.$merchant_currency.'|'.$amount.'|'.$other.'|'.$success_url.'|'.$fail_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;
        
        $aes = new AES128();
        $EncryptTrans = $aes->encrypt($requestParameter, $MERCHANT_KEY);
        $EncryptMAId = $aes->encrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        //$EncryptTrans1 = $aes->decrypt($requestParameter, $MERCHANT_KEY);
        //$EncryptMAId1 = $aes->decrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);
        //exit;
        return response()->make('<html>
            <head>
                <script>
                    function submitSbiForm() {
                        document.getElementById("submit-form").click();
                    }
                </script>
            </head>
            <body onload="submitSbiForm()">
                <form name="sbiForm" id="sbiForm" method="post" action="https://www.sbiepay.sbi/secure/AggregatorHostedListener">
                    <input type="hidden" name="EncryptTrans" value="'. $EncryptTrans .'">
                    <input type="hidden" name="merchIdVal" value ="'. $merchant_id .'"/>
                    <input type="hidden" name="MultiAccountInstructionDtls" value="'. $EncryptMAId .'">
                    <input type="submit" name="submit" id="submit-form" value="Submit" style="display: none">
                </form>
            </body>
        </html>');
    }

    public function handleAMSDryIcePayment($data)
    {
        // Merchant key here as provided by SBI
        //$MERCHANT_KEY = "H77RZRFxM0tfVJTNiCCT/hpgS83nABLXprUjIOSL5+mOp3N555rAHaAI6O/otUDR"; //Please change this value with live key for production
        //$success_url = "https://test.sbiepay.sbi/secure/sucess3.jsp";
        //$fail_url = 'https://test.sbiepay.sbi/secure/fail3.jsp';

        $MERCHANT_KEY = "DNODMJ1/6gZgF8u1pqa3/z8pHEEwLUqoidWXyizLNOc="; //Please change this value with live key for production
        // $success_url = 'https://thesachdevgroup.com/sbi/successhh.php';
        // $fail_url = 'https://thesachdevgroup.com/cancel.php';
        $success_url = route('payment.successhh');
        $fail_url = route('payment.cancel');

        $merchant_id = '1002694';
        $operation_mode = 'DOM';
        $merchant_country = 'IN';
        $merchant_currency = 'INR';

        $amount = isset($data['amount']) && $data['amount'] ? $data['amount'] : "";
        $amount1 = $amount/2;
        $amount2 = $amount1;

        //$key = "kLor6or9IaldjgQaRtRDBw==";
        $fname = isset($data['firstname']) && $data['firstname'] ? $data['firstname'] : "";
        $locations = isset($data['location']) && $data['location'] ? $data['location'] : "";
        
        switch ($locations) {
            case "7":
                $locations="Moti Nagar showroom";
                break;
            case "19":
                $locations="Badli(North West Delhi)";
                break;
            case "17":
                $locations="Moti Nagar workshop(West Delhi)";
                break;
            case "18":
                $locations="Naraina(South West Delhi)";
                break;
            case "20":
                $locations="Zakhira Bodyshop";
                break;
            case "104":
                $locations="Used Car (Head Office)";
                break;
            default:
        }

        $txnid = isset($data['txnid']) && $data['txnid'] ? $data['txnid'] : "";
        $email = isset($data['email']) && $data['email'] ? $data['email'] : "";
        $productinfo = isset($data['productinfo']) && $data['productinfo'] ? $data['productinfo'] : "";
        $phone = isset($data['phone']) && $data['phone'] ? $data['phone'] : "";

        //$key = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $BUSINESSNAME="Charu Motors Pvt Ltd";
        $MultiAccountInstructionDtls = $amount1."|INR|GRPT||".$amount2."|INR|NEFT";
        $other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone.'^'.$BUSINESSNAME;
        //$other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone;

        $aggregator_id = 'SBIEPAY';
        $merchant_order_no = $txnid;
        $merchant_customer_id = $txnid;
        $pay_mode = isset($data['pay_mode']) && $data['pay_mode'] ? $data['pay_mode'] : '';
        $access_medium = 'ONLINE';
        $transaction_source = 'ONLINE';

        $requestParameter = $merchant_id.'|'.$operation_mode.'|'.$merchant_country.'|'.$merchant_currency.'|'.$amount.'|'.$other.'|'.$success_url.'|'.$fail_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;

        $aes = new AES128();
        $EncryptTrans = $aes->encrypt($requestParameter, $MERCHANT_KEY);
        $EncryptMAId = $aes->encrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        //$EncryptTrans1 = $aes->decrypt($requestParameter, $MERCHANT_KEY);
        //$EncryptMAId1 = $aes->decrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);
        //exit;

        return response()->make('<html>
            <head>
                <script>
                    function submitSbiForm() {
                        document.getElementById("submit-form").click();
                    }
                </script>
            </head>
            <body onload="submitSbiForm()">
                <form name="sbiForm" id="sbiForm" method="post" action="https://www.sbiepay.sbi/secure/AggregatorHostedListener">
                    <input type="hidden" name="EncryptTrans" value="'. $EncryptTrans .'">
                    <input type="hidden" name="merchIdVal" value ="'. $merchant_id .'"/>
                    <input type="hidden" name="MultiAccountInstructionDtls" value="'. $EncryptMAId .'">
                    <input type="submit" name="submit" id="submit-form" value="Submit" style="display: none">
                </form>
            </body>
        </html>');
    }

    public function handleTSGAuctionMartPayment($data)
    {
        // Merchant key here as provided by SBI
        // $MERCHANT_KEY = "x61NNbOW5RBRi7vAifRH1r731/HQsxfHh4nSE0pfWtJ971rYDQ+2pX6zPd6nQs7E"; //Please change this value with live key for production
        //$MERCHANT_KEY = "9iiSrfROVVl2P0j5JcW01qeOBiyGMHVeJZ//A6JB8ie+IBBv+OlwiYGj19xQX92Q";
        //$success_url = "https://test.sbiepay.sbi/secure/sucess3.jsp";
        //$fail_url = 'https://test.sbiepay.sbi/secure/fail3.jsp';

        $MERCHANT_KEY = "2V7v0QBgrTFLv3/TvAVSQ8BA7j6aRwfaIYyNz/RgScs="; //Please change this value with live key for production
        // $success_url = 'https://thesachdevgroup.com/sbi/successhf.php';
        // $fail_url = 'https://thesachdevgroup.com/cancel.php';
        $success_url = route('payment.successhf');
        $fail_url = route('payment.cancel');

        $merchant_id = '1002695';
        $operation_mode = 'DOM';
        $merchant_country = 'IN';
        $merchant_currency = 'INR';

        $amount = isset($data['amount']) && $data['amount'] ? $data['amount'] : "";
        $amount1 = $amount/2;
        $amount2 = $amount1;

        //$key = "5MFuoRco/pJi7Gw/RQlBIQ==";
        $fname = isset($data['firstname']) && $data['firstname'] ? $data['firstname'] : "";
        $locations = isset($data['location']) && $data['location'] ? $data['location'] : "";

        switch ($locations) {
            case "20":
                $locations="Moti Nagar workshop(West Delhi)";
                break;
            case "23":
                $locations="Gurgaon(NCR)";
                break;
            case "22":
                $locations="Jahangirpuri(North Delhi)";
                break;
            case "24":
                $locations="Okhla(South Delhi)";
                break;
            case "21":
                $locations="Sahibabad(NCR)";
                break;
            case "25":
                $locations="Kundli";
                break;
            case "26":
                $locations="Moti Nagar";
                break;
            default:
        }

        $txnid = isset($data['txnid']) && $data['txnid'] ? $data['txnid'] : "";
        $email = isset($data['email']) && $data['email'] ? $data['email'] : "";
        $productinfo = isset($data['productinfo']) && $data['productinfo'] ? $data['productinfo'] : "";
        $phone = isset($data['phone']) && $data['phone'] ? $data['phone'] : "";

        //$key = "3ZKehWui62ElpTpnFzoAwbmxqUM5ZXUJ6xI0/zhjT6s=";
        $MultiAccountInstructionDtls = $amount1."|INR|GRPT||".$amount2."|INR|NEFT";
        $other = $fname.'^'.$email.'^'.$productinfo.'^'.$locations.'^'.$phone;
        $aggregator_id = 'SBIEPAY';
        $merchant_order_no = $txnid;
        $merchant_customer_id = $txnid;

        $pay_mode = isset($data['pay_mode']) && $data['pay_mode'] ? $data['pay_mode'] : '';
        $access_medium = 'ONLINE';
        $transaction_source = 'ONLINE';

        $requestParameter = $merchant_id.'|'.$operation_mode.'|'.$merchant_country.'|'.$merchant_currency.'|'.$amount.'|'.$other.'|'.$success_url.'|'.$fail_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;

        $aes = new AES128();
        $EncryptTrans = $aes->encrypt($requestParameter, $MERCHANT_KEY);
        $EncryptMAId = $aes->encrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        //$EncryptTrans1 = $aes->encrypt($MERCHANT_KEY, $key);
        //$EncryptMAId1 = $aes->decrypt($MultiAccountInstructionDtls, $MERCHANT_KEY);

        return response()->make('<html>
            <head>
                <script>
                    function submitSbiForm() {
                        document.getElementById("submit-form").click();
                    }
                </script>
            </head>
            <body onload="submitSbiForm()">
                <form name="sbiForm" id="sbiForm" method="post" action="https://www.sbiepay.sbi/secure/AggregatorHostedListener">
                    <input type="hidden" name="EncryptTrans" value="'. $EncryptTrans .'">
                    <input type="hidden" name="merchIdVal" value ="'. $merchant_id .'"/>
                    <input type="hidden" name="MultiAccountInstructionDtls" value="'. $EncryptMAId .'">
                    <input type="submit" name="submit" id="submit-form" value="Submit" style="display: none">
                </form>
            </body>
        </html>');
    }
}
