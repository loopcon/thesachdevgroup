@extends('frontend.layout.header')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
@section('css')

@endsection
@section('content')
<section id="home-slider-wrap" class="section lb clearfix p-t30 ">
    <!-- END PRELOADER -->
    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                            <strong>The Sachdev Group</strong>
                            <br>
                             <?php echo $payUsLog->near_location; ?>
                            <br>
                                <abbr title="Phone"><?php echo $locs->ac_phone; ?></abbr> 
                        </address>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <?php  $date=date_create(date('Y-m-d H:i:s')); ?>
                            <em>Date: <?php  echo date_format($date,"M d,Y H:i:s"); ?></em>
                        </p>

                        <p>
                            <em>Receipt #: <?php echo $payUsLog->trans_id; ?></em>  
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        <h1>Payment Detail</h1>
                    </div>
                    </span>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>#</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-9"><em><?php echo $payUsLog->payment_towards; ?></em></h4></td>
                                <td class="col-md-1" style="text-align: center"> 1 </td>
                                <td class="col-md-1 text-center"><?php echo $amount; ?></td>
                                <td class="col-md-1 text-center"><?php echo $amount; ?></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-right">
                                    <p>
                                        <strong>Subtotal: </strong>
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p>
                                        <strong><?php echo $amount; ?></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                <td class="text-center text-danger"><h4><strong><?php echo $amount; ?></strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php 
                        $MERCHANT_KEY = $locs->payu_key;
                        $payment_to = $payUsLog->payment_to;
                        $user['uid']= $payUsLog->trans_id;
                        $user['first_name']=$payUsLog->name;
                        $user['email']=$payUsLog->emailid;
                        $user['contact_no']=$payUsLog->mobile_no;
                        $user['loc_near']=$payUsLog->near_location;
                        $price=$payUsLog->amount;
                        $SALT =  $locs->payu_salt;
                        $txnid = $user['uid'];
                        $posted['key']=$MERCHANT_KEY;
                        $posted['amount']=$price;
                        $posted['firstname']=$user['first_name'];
                        $posted['lastname']='';
                        $posted['email']=$user['email'];
                        $posted['phone']=$user['contact_no'];
                        $posted['productinfo']=$payUsLog->payment_towards;
                        $posted['location']= $user['loc_near'];
                        $posted['surl']="https://thesachdevgroup.com/pyu_paid.php";
                        $posted['furl']="https://thesachdevgroup.com/cancel.php";
                        $posted['udf1']=$user['uid'];
                        $posted['txnid']=$txnid;
                        $posted['curl']='https://thesachdevgroup.com/cancel.php';
                        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
                        $hashVarsSeq = explode('|', $hashSequence);
                        $hash_string = '';	
                        foreach($hashVarsSeq as $hash_var) {
                            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                            $hash_string .= '|';
                        }
                        $hash_string .= $SALT;
                        $hash = strtolower(hash('sha512', $hash_string));
                    ?>
                    <?php 
                    // if($MERCHANT_KEY !="" && $SALT !="") { 
                    if(true) {  // need to display this "Pay using SBI" without checking condition
                        ?>
                        {{-- <form action="https://secure.payu.in/_payment" method='post'>
                            <input type="hidden" name="firstname" value="<?php echo $posted['firstname'];?>" />
                            <input type="hidden" name="lastname" value="<?php echo $posted['lastname'];?>" />
                            <input type="hidden" name="surl" value="<?php echo $posted['surl'];?>" />
                            <input type="hidden" name="phone" value="<?php echo $posted['phone'];?>" />
                            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
                            <input type="hidden" name="hash" value ="<?php echo $hash; ?>" />
                            <input type="hidden" name="curl" value="<?php echo $posted['curl'];?>" />
                            <input type="hidden" name="furl" value="<?php echo $posted['furl'];?>" />
                            <input type="hidden" name="txnid" value="<?php echo $posted['txnid']; ?>" />
                            <input type="hidden" name="productinfo" value="<?php echo $posted['productinfo'];?>" />
                            <input type="hidden" name="amount" value="<?php echo $posted['amount'];?>" />
                            <input type="hidden" name="email" value="<?php echo $posted['email'];?>" />
                            <input type="hidden" name="udf1" value="<?php echo $posted['udf1'];?>" />
                            <!-- <button type="submit" class="btn btn-info btn-lg btn-block">
                                Pay Now Via PayUbiz<span class="glyphicon glyphicon-chevron-right"></span>
                            </button> -->
                        </form> --}}
                                        <?php
                                        //  if($payUsLog->payment_to == "Hans Hyundai"){ ?>
                                   {{-- <form action="sbi_payment.php" method='post'> --}}
                                     <?php
                                    //  } if($payUsLog->payment_to == "Galaxy Toyota"){?>
                                       {{-- <form action="sbi_paymentgt.php" method='post'> --}}
                                        <?php
                                        //  } if($payUsLog->payment_to == "Harpreet Ford"){?>
                                       {{-- <form action="sbi_paymenthf.php" method='post'> --}}

                                       <?php
                                    //  } if($payUsLog->payment_to == "Auto Car Repair"){?>
                                       {{-- <form action="sbi_paymentacr.php" method='post'> --}}

                                       <?php
                                    //  } if($payUsLog->payment_to == "AMS Dry Ice"){?>
                                       {{-- <form action="sbi_paymentams.php" method='post'> --}}

                                       <?php
                                    //  } if($payUsLog->payment_to == "TSG Auction Mart"){?>
                                       {{-- <form action="sbi_paymenttsg.php" method='post'> --}}

                                       <?php
                                    //  } ?>
            <form action="{{route('payment.submit')}}" method="post">   
                @csrf                           
                <div class="modal-body1" >
                    <input type="hidden" name="firstname" value="<?php echo $posted['firstname']; ?>" />
                    <input type="hidden" name="lastname" value="<?php echo $posted['lastname']; ?>" />
                    <input type="hidden" name="surl" value="<?php echo $posted['surl']; ?>" />
                    <input type="hidden" name="phone" value="<?php echo $posted['phone']; ?>" />
                    <input type="hidden" name="txnid" value="<?php echo $posted['txnid']; ?>" />
                    <input type="hidden" name="productinfo" value="<?php echo $posted['productinfo']; ?>" />
                    <input type="hidden" name="location" value="<?php echo $posted['location']; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $posted['amount']; ?>" />
                    <input type="hidden" name="email" value="<?php echo $posted['email']; ?>" />
                    <input type="hidden" name="payment_to" value="<?php echo $payment_to; ?>" />
                    
                    <select hidden class="form-control" name="pay_mode">
                        <option value="NB">Net Banking</option>
                        <option value="CC">Credit Card</option>
                        <option value="DC">Debit Card</option>
                        <option value="WALLET">WALLET</option>
                        <option value="PC">Prepaid Cards</option>
                        <option value="CASH">CASH</option>
                        <option value="NEFT">NEFT</option>
                        <option value="PAYPAL">PAYPAL</option>
                        <option value="UPI">UPI</option>
                    </select>
                </div>
                <!-- Modal footer -->
              
                     <button type="submit" class="btn btn-primary btn-lg btn-block">Pay using SBI <span class="glyphicon glyphicon-chevron-right" style="
    margin-left: 12px !important;
"></span></button> 
               
            </form>
                      <!--  &nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg" id="payusing_sbi" data-toggle="modal" data-target="#myModal">Pay using SBI old</a>-->

                    <?php } else { ?>
                        <br/>		
                        <form action="https://m.ultracash.in/userver_ios/customer/get_payment_details_by_msisdn" method="post"  enctype="application/json">
                            <input type="hidden" name="bill_id" value="<?php echo $payUsLog->trans_id; ?>">
                            <input type="hidden" name="currency_code" value="INR">
                            <input type="hidden" name="customer_msisdn" value="<?php echo clean($_POST['MobileNo']); ?>">
                            <input type="hidden" name="partner_id" value="2">
                            <input type="hidden" name="partner_key" value="AF!#543GDS&%WE&HS">
                            <input type="hidden" name="api_key" value="F6dfjh9@hfh@g@#JKFSJK#Dsdk33$jdkj4!@313*&Dsds&&E">
                            <?php if($merchant_id !="") {  ?>
                                <input type="hidden" name="merchant_id" value="<?php echo $merchant_id; ?>">
                            <?php }else { ?>	
                                <input type="hidden" name="merchant_id" value="3706">
                            <?php } ?>
                            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                            <input type="hidden" name="notification_url" value="https://thesachdevgroup.com/uc_paid.php">
                            <input type="hidden" name="redirect_url" value="https://thesachdevgroup.com/thanks.php">
                            <input type="hidden" name="merchant_notification_number" value="1234567892">
                            <input type="hidden" name="time" value="<?php echo $time; ?>">
                                <!--<button type="submit" class="btn btn-success btn-lg btn-block">
                                Pay Now Via Ultracash <span class="glyphicon glyphicon-chevron-right"></span>
                                </button>-->
                        </form>
                    <?php } ?>
                    <!--HDFC PAYMENT GATEWAY FORM START-->
                    <?php 
                        // $secret_key = $locs['hdfc_secret'];//'236caa8a6109bfea69c2a00cb0e9d062'; //Provide your HDFC Account’s Secret Key   
                        // $hashData = $secret_key;  // Intialise with Secret Key  
                        // $channel=10;
                        // $account_id=$locs['hdfc_account']; //22900;
                        // $reference_no=$payUsLog->trans_id;
                        // $amount=$price;
                        // $mode='LIVE';
                        // $currency='INR';
                        // $currency_code='INR';
                        // $description='test';
                        // $return_url='https://thesachdevgroup.com/hdfc_paid.php';
                        // $name=clean($_POST['Name']);;
                        // $address=$loc;
                        // $city='Delhi';
                        // $state='Delhi';
                        // $country='IND';
                        // $postal_code='110015';
                        // $phone=clean($_POST['MobileNo']);
                        // $email=clean($_POST['EmailId']);
                        // $ship_name='';
                        // $ship_address='';
                        // $ship_country='';
                        // $ship_state='';
                        // $ship_city='';
                        // $ship_postal_code='';
                        // $ship_phone='';
                        // $posted2['account_id']=$account_id;
                        // $posted2['channel']=$channel;
                        // $posted2['reference_no']=$reference_no;
                        // $posted2['amount']=$amount;
                        // $posted2['mode']=$mode;
                        // $posted2['currency']=$currency;
                        // $posted2['currency_code']=$currency_code;
                        // $posted2['description']=$description;
                        // $posted2['return_url']=$return_url;
                        // $posted2['name']=$name;
                        // $posted2['address']=$address;
                        // $posted2['city']=$city;
                        // $posted2['state']=$state;
                        // $posted2['country']=$country;
                        // $posted2['postal_code']=$postal_code;
                        // $posted2['phone']=$phone;
                        // $posted2['email']=$email;
                        // $posted2['ship_name']=$ship_name;
                        // $posted2['ship_address']=$ship_address;
                        // $posted2['ship_country']=$ship_country;
                        // $posted2['ship_state']=$ship_state;
                        // $posted2['ship_city']=$ship_city;
                        // $posted2['ship_postal_code']=$ship_postal_code;
                        // $posted2['ship_phone']=$ship_phone;

                        // ksort ($posted2);  // Sort the post parameters in alphabetical order of parameter names.  
                        //Append the posted values to $hashData  
                        // foreach($posted2 as $key => $value) {   
                        //     //create the hashing input leaving out any fields that has no value and by concatenating the      values using a ‘|’ symbol.  
                        //     if (strlen($value) > 0) {  
                        //         $hashData .= '|'.$value;  
                        //     }
                        // }    
                        // Create the secure hash and append it to the Post data  
                        // if (strlen($hashData) > 0) {   
                        //     $hashvalue = strtoupper(md5($hashData));   
                        // }   
                        // $SecureHash = $hashvalue; 
                        $a=0;
                        /* 	if($_POST['EmailId']=='hardeep.vikazinfotech@gmail.com' || $_POST['EmailId']=='er.vinodverma@gmail.com' || $_POST['MobileNo']=='9875641230'){						  

                                        $a=1;

                                }	 */				
                    ?>
                    {{-- <form  method="post" action="https://secure.ebs.in/pg/ma/payment/request"  name="frmTransaction" id="frmTransaction" > 
                        <input name="channel"  type="hidden" value="<?php echo $channel; ?>" />  
                        <input name="account_id" type="hidden" value="<?php echo $account_id; ?>" />  
                        <input name="reference_no" type="hidden" value="<?php echo $reference_no; ?>" />  
                        <input name="amount" type="hidden" value="<?php echo $amount; ?>" />  
                        <input name="mode" type="hidden" value="<?php echo $mode; ?>" />  
                        <input name="currency" type="hidden" value="<?php echo $currency; ?>" />  
                        <input name="currency_code" type="hidden" value="<?php echo $currency_code; ?>" />  
                        <input name="description" type="hidden" value="<?php echo $description; ?>" />  
                        <input name="return_url" type="hidden" value="<?php echo $return_url; ?>" />  
                        <input name="name" type="hidden" value="<?php echo $name; ?>" />  
                        <input name="address" type="hidden" value="<?php echo $address; ?>" />  
                        <input name="city" type="hidden" value="<?php echo $city; ?>" />  
                        <input name="state" type="hidden" value="<?php echo $state; ?>" />  
                        <input name="country" type="hidden" value="<?php echo $country; ?>" />  
                        <input name="postal_code" type="hidden" value="<?php echo $postal_code; ?>" />  
                        <input name="phone" type="hidden" value="<?php echo $phone; ?>" />  
                        <input name="email" type="hidden" value="<?php echo $email; ?>" />  
                        <input name="ship_name" type="hidden" value="<?php echo $ship_name; ?>" /> 
                        <input name="ship_address" type="hidden" value="<?php echo $ship_address; ?>" /> 
                        <input name="ship_country" type="hidden" value="<?php echo $ship_country; ?>" />  
                        <input name="ship_state" type="hidden" value="<?php echo $ship_state; ?>" />  
                        <input name="ship_city" type="hidden" value="<?php echo $ship_city; ?>" />  
                        <input name="ship_postal_code" type="hidden" value="<?php echo $ship_postal_code; ?>" />  
                        <input name="ship_phone" type="hidden" value="<?php echo $ship_phone; ?>" />  
                        <input name="secure_hash" type="hidden" value="<?php echo $SecureHash; ?>" />  
                        <br/>
                        <!--	<button type="submit" class="btn btn-success btn-lg btn-block"style="background:#014a8e;">  
                            Pay Via CREDIT/DEBIT CARD NET BANKING <span class="glyphicon glyphicon-chevron-right"></span>
                        </button>-->
                    </form> --}}
                    <!--HDFC PAYMENT GATEWAY FORM END-->
                    <!--UPI PAYMENT GATEWAY FORM START LIVE FROM 11-5-2017-->
                    <?php  // if($uniqueStr == 'C125B0B4B2'){ ?>
                    <br/>
                    <!--for a time <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target=".bs-example-modal-sm">  
                    Pay Now Via UPI <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> <h4 class="modal-title" id="mySmallModalLabel">Payment Via UPI</h4> </div> 
                                <div class="modal-body text-center">
                                    <span id="success_message"></span>
                                    <form  method="post" class="text-center" id="check_vpa"  action="<?php // echo $static['url'] ; ?>/upi_payment/init2.php"> 
                                        <input name="invoiceid"  id="invoiceid" type="hidden" value="<?php //echo $uniqueStr; ?>" /> 
                                        <input name="orderkey"  id="orderkey" type="hidden" value="" /> 
                                        <div class="form-group">
                                            <label for="upikey">Enter UPI</label>
                                            <input name="upikey"  id="upikey" type="Text" class="form-control" value="" /> 
                                            <input id="hitusrl" type="hidden" class="form-control" value="init2.php" /> 
                                        </div>
                                        <button type="submit" id="submit_vpa"  class="btn btn-danger btn-lg btn-block">  
                                                Pay Now Via UPI <span class="glyphicon glyphicon-chevron-right"></span>
                                        </button>
                                    </form> 
			`       </div>
                            </div>
                        </div>
                    </div>-->
                    <?php //  } ?>
                    <!--UPI PAYMENT GATEWAY FORM END-->
        	</div>
            </div>
        </div>
        <!-- Main Scripts-->  
        <!-- Main Scripts-->  
</section>
<!-- Main Scripts-->  
<!-- Main Scripts-->  
<div class="footer-distributed">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 footer-left">
                <div class="widget">
                    <p class="footer-links"><a href="sitemap.php">Site Map</a> ·
                    <a href="privacy.php">Privacy</a> · <a href="disclaimer.php">Disclaimer</a> ·
                    <a href="terms.php">Terms & Conditions</a> · <a href="contact.php">Contact Us</a></p>
                </div>
            </div>

            <div class="col-md-5 col-sm-12 footer-right" style="float: right;">
                <div class="widget">
                    <br>
                    <p class="footer-company-name">TSG (The Sachdev Group)&copy; 2020</p>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end copyrights -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Select Payment Type</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="sbi_payment.php" method='post'>
                <div class="modal-body">
                    <input type="hidden" name="firstname" value="<?php echo $posted['firstname']; ?>" />
                    <input type="hidden" name="lastname" value="<?php echo $posted['lastname']; ?>" />
                    <input type="hidden" name="surl" value="<?php echo $posted['surl']; ?>" />
                    <input type="hidden" name="phone" value="<?php echo $posted['phone']; ?>" />
                    <input type="hidden" name="txnid" value="<?php echo $posted['txnid']; ?>" />
                    <input type="hidden" name="productinfo" value="<?php echo $posted['productinfo']; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $posted['amount']; ?>" />
                    <input type="hidden" name="email" value="<?php echo $posted['email']; ?>" />
                    <label>Select</label>
                    <select class="form-control" name="pay_mode">
                        <option value="NB">Net Banking</option>
                        <option value="CC">Credit Card</option>
                        <option value="DC">Debit Card</option>
                        <option value="WALLET">WALLET</option>
                        <option value="PC">Prepaid Cards</option>
                        <option value="CASH">CASH</option>
                        <option value="NEFT">NEFT</option>
                        <option value="PAYPAL">PAYPAL</option>
                        <option value="UPI">UPI</option>
                    </select>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

