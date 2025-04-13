<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Session;
use DB;
use Mail;
use App\Models\Evalution;


class cartcontroller extends Controller
{
    private $razorpayId = "rzp_test_oGWqJW6LQBc9Gs";
    private $razorpayKey = "EDknjtGrhABUsDq0FGfnYDM3";

    public function developer_order_data()
    { 
        $u_id=Session::get('user_login_id');  
        return  $developer_order_details = DB::table('developer_order_tb')->where('payment_status' ,'=', 'SUCCESS')->where('u_id' ,'=', $u_id )->count();
    }
    
    public function developer_data()
    { 
        $developer_id=Session::get('developer_login_id'); 
        return $developer_details = DB::table('developer_details_tb')->where('dev_id',$developer_id)->get();

        return $developer_project_details = DB::table('developer_project_details_tb')->where('developer_id',$developer_id)->get();
    }

    /*public function cart(Request $request)
    { 
		 $u_id=Session::get('user_login_id'); 
		 $dev_id=$request->post('dev_id');

		if(empty($u_id))
		{
			$developer_cart = Session::get('developer_cart');
			$qty=0;				
			$developer_cart[] = array(
				"dev_id" => $dev_id,	
			);
			Session::put('developer_cart', $developer_cart);
			$i=1;
			foreach ($developer_cart as $id => $val) 
			{			
				$qty+=$developer_cart[$id]['dev_id'];	
				$i++;
			}
			echo $i;
		}
		else
		{
			$count=DB::table('developer_cart_tb')->whereNull('status')->where('dev_id','=',$dev_id)->where('u_id','=',$u_id)->count();
			if($count == 0)
			{
				$data = array('u_id'=>$u_id,'dev_id'=>$dev_id,'status'=>null);
				DB::table('developer_cart_tb')->insert($data);
			}
			echo $count=DB::table('developer_cart_tb')->whereNull('status')->where('u_id','=',$u_id)->count();
		}	
	}*/

	public function developer_checkout($id)
    {   
    	$show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
       	$show['web_details'] = DB::table('web_setting')->get();
       	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();  
        

        //$show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();      

        /*$show['developer_cart'] = DB::table('developer_cart_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.rating','developer_details_tb.name','developer_details_tb.image','developer_details_tb.perhr','developer_cart_tb.u_id','developer_cart_tb.dev_id as devp_id','developer_cart_tb.status')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_cart_tb.dev_id')
        ->whereNull('status')
        ->get();*/

        $show['developer_cart'] = DB::table('developer_details_tb')->where('dev_id',$id)->get();

        $show['developer_cart_deatls'] = DB::table('higher_professional_tb')->get();

        return view('front/checkout')->with($show);
    }

    public function developer_proceed_checkout()
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        //$show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

         /*$show['developer_cart'] = DB::table('developer_cart_tb')
        ->select('developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.rating','developer_details_tb.name','developer_details_tb.image','developer_details_tb.perhr','developer_cart_tb.u_id','developer_cart_tb.dev_id as devp_id','developer_cart_tb.status')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_cart_tb.dev_id')
        ->whereNull('status')
        ->get();*/

        //$show['developer_cart_deatls'] = DB::table('higher_professional_tb')->get();

		return view('front/developer_proceed_checkout')->with($show);
    }

     public function developer_payment_initiate(Request $request)
    {
    	$show['developer_order_details']=$this->developer_order_data();
		$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();


  		$fname = $request->post('fname');
  		$lname = $request->post('lname');
		$email = $request->post('email');
		$phone = $request->post('phone');
		$company_name = $request->post('company_name');
		$country = $request->post('country');
		$state = $request->post('state');
		$city = $request->post('city');
		$address_one = $request->post('address_one');
		$address_two = $request->post('address_two');
		$code = $request->post('code');
		$gst = $request->post('gst');
		$purpose = $request->post('purpose');

		$tperhr= Session::get('tperhr');

		$u_id=Session::get('user_login_id'); 
		$dev_id=Session::get('dev_id'); 
			
		$order_id = rand(0,9999);				
				
		$order_data=array(
					'order_id'=>$order_id,
					'u_id'=>$u_id,
					'fname'=>$fname,
					'lname'=>$lname,
					'email'=>$email,
					'phone'=>$phone,
					'company_name'=>$company_name,
					'country'=>$country,
					'state'=>$state,
					'city'=>$city,
					'address_one'=>$address_one,
					'address_two'=>$address_two,
					'code'=>$code,
					'gst'=>$gst,
					'purpose'=>$purpose,
					'dev_id'=>$dev_id,
					'perhr'=>$tperhr,
					'status'=>'Not Approved',				
					'payment_status'=>'SUCCESS',
					'date' => date("Y-m-d")				
					);				
					DB::table('developer_order_tb')->insert($order_data);

					$details = DB::table('developer_order_tb')->where('email',$email)->get();
		            $emails=array();
		            foreach ($details as $key) 
		            {
		                $emails[]= $key->email;
		            }

					$data = DB::table('developer_order_tb')->where('email',$email)->get();
		            foreach ($data as $k) 
		            {
		                $fname = $k->fname;
		                $order_id = $k->order_id;
		                $url = route('contact');
		            }
		           $datas=array(
		                'fname'=>$fname,
		                'order_id'=>$order_id,
		                'link'=>$url
		            );

					Mail::send('developer_payment_mail', $datas, function($message) use ($emails) {
			            $message->to($emails)->subject('Mellow Elements');
			            $message->from('dev@mellowelements.in', 'The Mellow Elements');   
			        });
				
					
					$status=array(
					'developer_status'=>'Book Now',
					);

					DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($status);	
					
					return redirect()->route('developer_thank_you')->with($show);
				
    }

    public function developer_thank_you()
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/developer_thank_you')->with($show);
    }
	

	// public function developer_payment(Request $request)
 //    { 

 //    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
 //        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
 //        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
 //        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
 //        $show['web_details'] = DB::table('web_setting')->get();

 //        $show['cart_details'] = DB::table('cart_tb')
 //        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
 //        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
 //        ->whereNull('status')
 //        ->get();

 //         $u_id=Session::get('user_login_id'); 

 //        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
 //        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

    	
 //    	$fname=Session::get('fname');
 //    	$lname=Session::get('lname');
 //    	$email=Session::get('email');
 //    	$phone=Session::get('phone');
 //    	$company_name=Session::get('company_name');
 //    	$country=Session::get('country');
 //    	$state=Session::get('state');
 //    	$city=Session::get('city');
 //    	$address_one=Session::get('address_one');
 //    	$address_two=Session::get('address_two');
 //    	$code=Session::get('code');
 //    	$gst=Session::get('gst');
 //    	$purpose=Session::get('purpose');
 //    	$tperhr=Session::get('tperhr');

 //    	$signatureStatus = $this->SignatureVerify(
	// 		$request->all()['rzp_signature'],
	// 		$request->all()['rzp_paymentid'],
	// 		$request->all()['rzp_orderid']
	// 	);
	// 	// If Signature status is true We will save the payment response in our database
	// 	// In this tutorial we send the response to Success page if payment successfully made
	// 	if($signatureStatus == true)
	// 	{
	// 		$u_id=Session::get('user_login_id'); 
	// 		$dev_id=Session::get('dev_id'); 
			
	// 		$order_id = rand(0,9999);				
				
	// 				$order_data=array(
	// 				'order_id'=>$order_id,
	// 				'u_id'=>$u_id,
	// 				'fname'=>$fname,
	// 				'lname'=>$lname,
	// 				'email'=>$email,
	// 				'phone'=>$phone,
	// 				'company_name'=>$company_name,
	// 				'country'=>$country,
	// 				'state'=>$state,
	// 				'city'=>$city,
	// 				'address_one'=>$address_one,
	// 				'address_two'=>$address_two,
	// 				'code'=>$code,
	// 				'gst'=>$gst,
	// 				'purpose'=>$purpose,
	// 				'dev_id'=>$dev_id,
	// 				'perhr'=>$tperhr,
	// 				'status'=>'Booked',				
	// 				'payment_status'=>'SUCCESS',
	// 				'date' => date("Y-m-d")				
	// 				);				
	// 				DB::table('developer_order_tb')->insert($order_data);

	// 				$payment_data=array(
	// 				'order_id'=>$order_id,
	// 				'perhr'=>$tperhr,
	// 				'razorpay_payment_id'=>$request->all()['rzp_paymentid'],
	// 				'date' => date("Y-m-d")
	// 				);	

	// 				DB::table('developer_payment_tb')->insert($payment_data);
					

	// 				$email=Session::get('email');
	// 				$details = DB::table('developer_order_tb')->where('email',$email)->get();
	// 	            $emails=array();
	// 	            foreach ($details as $key) 
	// 	            {
	// 	                $emails[]= $key->email;
	// 	            }

	// 	            $data = DB::table('developer_order_tb')->where('email',$email)->get();
	// 	            foreach ($data as $k) 
	// 	            {
	// 	                $fname = $k->fname;
	// 	                $order_id = $k->order_id;
	// 	                $url = route('contact');
	// 	            }
	// 	           $datas=array(
	// 	                'fname'=>$fname,
	// 	                'order_id'=>$order_id,
	// 	                'link'=>$url
	// 	            );

	// 				Mail::send('developer_payment_mail', $datas, function($message) use ($emails) {
	// 		            $message->to($emails)->subject('Mellow Element');
	// 		            $message->from('info@mellowelements.seminator.in', 'The Mellow Element');   
	// 		        });
				
					
	// 				$status=array(
	// 				'developer_status'=>'Booked',
	// 				);

	// 				DB::table('developer_details_tb')->where('dev_id',$dev_id)->update($status);	
					
	// 			return view('front/thank_you')->with($show);

				
	// 	}
	// 	else
	// 	{
	// 		// You can create this page
	// 		echo "not done";
	// 	}
	// }

	// private function SignatureVerify($_signature,$_paymentId,$_orderId)
	// {
	// 	try
	// 	{
	// 		// Create an object of razorpay class
	// 		$api = new Api($this->razorpayId, $this->razorpayKey);
	// 		$attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
	// 		$order  = $api->utility->verifyPaymentSignature($attributes);
	// 		return true;
	// 	}
	// 	catch(\Exception $e)
	// 	{
	// 		// If Signature is not correct its give a excetption so we use try catch
	// 		return false;
	// 	}
	// }

	public function delete_developer_cart($dev_id)
    {
        $info_delete=DB::table('developer_cart_tb')->where('dev_id', $dev_id)->delete();
        if($info_delete==true)
        {
           session(['message' =>'success', 'errmsg'=>'Cart Item Delete Successfully.']); 
           return redirect()->route('index');
        }
        else
        {

            session(['message' =>'danger', 'errmsg'=>'Cart Item Delete Failed']); 
            return redirect()->route('user_profile');
        }
    }  

	public function resume_download($dev_id)
    { 
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

         $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
       
       if(!empty(Session::get('user_login_id'))) {
	       	$show= DB::table('developer_order_tb')->where('dev_id','=' , $dev_id)->get();
	        foreach($show as $s)            
	        {
	            $dev_id=$s->dev_id;
	            /*$details = DB::table('developer_details_tb')->where('dev_id','=',$dev_id)->first();
	           
	            $file = $details->resume;
	           	$myFile = public_path('upload/resume/'.$file);
	            return response()->download($file); */

	            $details = DB::table('developer_details_tb')->where('dev_id','=',$dev_id)->first();
	           
		        $file = $details->resume;
		        $myFile = public_path('upload/resume/'.$file);
		        return response()->download($file); 
	        }
	    }else
        {
            return view('front/registration')->with($show);
        }

        // if(!empty(Session::get('user_login_id'))) {

        //     $u_id = Session::get('user_login_id');
        //     $use = DB::table('developer_order_tb')->where(['u_id','=', $u_id])->count();
           
        //     if($use > 0 )
        //     {
        //         $show= DB::table('developer_order_tb')->where([['u_id','=', $u_id],['payment_status', 'SUCCESS'],['dev_id','=' , $dev_id]])->get();
        //         foreach($show as $s)            
        //         {
        //             $dev_id=$s->dev_id;
        //             $details = DB::table('developer_details_tb')->where('dev_id','=',$dev_id)->first();
                   
        //             $file = $details->resume;
        //            	$myFile = public_path('upload/resume/'.$file);
        //             return response()->download($file); 

        //             $details = DB::table('developer_details_tb')->where('dev_id','=',$dev_id)->first();
                   
			     //    $file = $details->resume;
			     //    $myFile = public_path('upload/resume/'.$file);
			     //    return response()->download($file); 
        //         }    
        //     }
        //     else
        //     {
        //         session(['message' =>'danger', 'errmsg'=>'Payment not complete']); 
        //         return redirect()->back();
        //     }
        // }
        // else
        // {
        //     return view('front/registration')->with($show);
        // }
    }

    public function resource()
    {  
        $u_id=Session::get('user_login_id');
        $dev_id=Session::get('dev_id');
        //$email=Session::get('user_login_id');
        //echo $dev_id;exit();
        //$show['premium_profile_detailss'] = DB::table('qualified_order_tb')->where('dev_id',$dev_id)->where('payment_status',NULL)->get();
        //dd($show['premium_profile_details']);
        $show['premium_profile_details'] = DB::table('developer_order_tb')
        	->select('qualified_order_tb.p_code','qualified_order_tb.dev_id','qualified_order_tb.payment_status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.status','developer_order_tb.payment_status')
            ->join('qualified_order_tb','qualified_order_tb.dev_id', '=', 'developer_order_tb.dev_id')
            ->where('qualified_order_tb.payment_status' ,'=', 'SUCCESS' )
        	->get();
        //dd($show['premium_profile_details']);
        
        $show['developer_order_resource'] = DB::table('developer_order_tb')->where('u_id' ,'=', $u_id )->get(); 
        $show['developer_payment_resource'] = DB::table('qualified_order_tb')->where('dev_id',$dev_id)->where('payment_status' ,'=', "SUCCESS" )->get();
        $show['developerid'] = DB::table('qualified_order_tb')->where('dev_id',$dev_id)->count();
        //dd($show['developer_order_resource']);
        $show['developer_interview_resource'] = DB::table('developer_interview_schedule')->where('dev_id' ,'=', $dev_id )->get(); 
        //dd($show['developer_interview_resource']);
        //exit();
        $show['developer_order_details']=$this->developer_order_data();   
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->limit(3)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        
        $show['dev_order_details_empty'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.image','developer_details_tb.dev_id','developer_order_tb.id','developer_order_tb.order_id','developer_order_tb.payment_status','developer_order_tb.date','developer_order_tb.u_id','developer_details_tb.degree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        ->where('developer_order_tb.status' ,'=', '1' )
    	->count();

        //     $show['developer_resources'] = DB::table('developer_order_tb')
        // 	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_order_tb.u_id','developer_order_tb.dev_id')
        //     ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        //     ->where('u_id' ,'=', $u_id )
        //     ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        //     ->where('developer_order_tb.status' ,'=', 'Not Approved' )
        // 	->get();
    	 //echo $show['developer_resources']; exit();
    	 
    	$show['developer_resources'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.qdate')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        
    	->get();
    	 //dd($show['developer_resources']);
    	 
    	 $show['developer_resource'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        ->where('developer_order_tb.status' ,'=', 'Not Approved' )
    	->get();
    	
    	
    	$show['developer_resourceSELE'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        ->where('developer_order_tb.status' ,'=', 'Interview Schedule' )
    	->get();
    	//echo $show['developer_resourceSELE']; exit();
    	
    	$show['developer_resourcesche'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        ->where('developer_order_tb.status' ,'=', 'Scheduled' )
    	->get();
    	
    	
    	$show['developer_resourcequl'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        ->where('developer_order_tb.status' ,'=', 'Qualified' )
    	->get();
    	
    	
    	$show['developer_resourceappr'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        ->where('developer_order_tb.status' ,'=', '1' )
    	->get();

    	$show['sow_details'] = DB::table('sow_tb')->where('u_id' ,'=', $u_id )->where('sow_payment_status' ,'=', NULL )->get();


    	// $show['developer_data_details'] = DB::table('sow_tb')->count();

    	// $show['developer_data'] = DB::table('sow_tb')->where('sow_status' ,'=', '')->count();

		return view('front/resource')->with($show);
    }

    public function Evalution(Request $req,$devId)
    {
    	if($req->method()=="GET")
    	{
	        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
	        $show['web_details'] = DB::table('web_setting')->get();
	        $u_id=Session::get('user_login_id'); 

	        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
	        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
	        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
	    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
	        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
	        $show['developer_order_details']=$this->developer_order_data(); 

	         $show['cart_details'] = DB::table('cart_tb')
	        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
	        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
	        ->whereNull('status')
	        ->get();
	        $show['dev_id']=$devId;

	        $show['evalution'] = DB::table('evalutions')->Where(['dev_id'=>$devId,'user_id'=>Session::get('user_login_id')])->first();
	     }else
	     {
	     	// dd($req->all());
	     	$evalution=Evalution::Where(['dev_id'=>$devId,'user_id'=>Session::get('user_login_id')])->first();
	     	if(empty($evalution))
	     	{
	     		$evalution=new Evalution;
	     	}

	     	$evalution->dev_id=$devId;
	     	$evalution->user_id=Session::get('user_login_id');
	     	$evalution->feedback1=$req->q23_overallHow23;
	     	$evalution->feedback2=$req->q25_afterThe25;
	     	$evalution->feedback3=$req->q24_doYou;
	     	$evalution->feedback4=$req->q30_whatWas;
	     	$evalution->feedback5=$req->q26_wouldYou;
	     	// $evalution->feedback6=$req->q31_presenter1[0];
	     	// $evalution->feedback7=$req->q34_presenter2[0];
	     	// $evalution->feedback8=$req->q33_presenter3[0];
	     	// $evalution->feedback9=$req->q32_presenter4[0];
	     	// $evalution->feedback10=$req->q32_presenter4[0];
	     	$evalution->feedback11=$req->q17_howWas17;
	     	$evalution->feedback12=$req->q50_wasThere;
	     	$evalution->problems=$req->q37_whatProblems;
	     	$evalution->suggestion_future_topics=$req->q45_anySuggestions45;
	     	$evalution->final_comments=$req->q38_anyFinal38;
	     	$evalution->save();

	     	session(['message' =>'success', 'schedule_errmsg' =>'Evalution Added Successfully..']);

	     	return back();
	     }

    	return view('front/evalution/index')->with($show);
    }
    
    public function schedule_interview_resource (Request $request)
    {  

    	    
    	
	       	request()->validate(
	        [
	            'interviewdateone' => ['required'],
	            'interviewdatetwo' => ['required'],
	            'interviewdatethree' => ['required'],
	        ]);
	        
	        $dev_id= Session::get('dev_id');
	       
	       // echo $dev_id; exit();

       		$docs = DB::table('developer_order_tb')->where('dev_id',$dev_id)->get();
       		
       		//dd($docs);

			foreach($docs as $c)
			{
		        $data=array(

		            'dev_id'=>$dev_id,
		            'u_id'=>$c->u_id,
		            'fname'=>$c->fname,
		            'lname'=>$c->lname,
		            'phone'=>$c->phone,
		            'email'=>$c->email,
		            'perhr'=>$c->perhr,
		            'code'=>$c->code,
		            'address_one'=>$c->address_one,
		            'interviewdateone'=>$request->post('interviewdateone'),
		            'interviewdatetwo'=>$request->post('interviewdatetwo'),
		            'interviewdatethree'=>$request->post('interviewdatethree'),
		            'status'=>'Interview Schedule',
		        );
		        
		    }

	        $result=DB::table('developer_interview_schedule')->insert($data);
	        
	        $result=DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);
	        

	        if($result==true)
	        {
	            session(['message' =>'success', 'schedule_errmsg' =>'Interview Schedule Successfully.']);
	           
	            return redirect()->back();
	        }
	        else
	        {
	            session(['message' =>'danger', 'schedule_errmsg'=>'Interview Schedule Not Successful.']); 
	            return redirect()->back();
	        }
	    
    }
    
    public function schedule_interview_qualified (Request $request)
    {  

    	    $u_id=Session::get('user_login_id');
    	    $dev_id= Session::get('dev_id');
    	    //echo $dev_id; exit();
    	    
	       	request()->validate(
	        [
	            'status' => ['required'],
	            'review' => ['required'],
	        ]);
	        
	        $dev_id= Session::get('dev_id');
	        //$fname = $request->post('fname');
  	    	//$lname = $request->post('lname');
	        
       		$docs = DB::table('developer_order_tb')->where('dev_id',$dev_id)->get();

			foreach($docs as $c)
			{
		        $data=array(

		            'dev_id'=>$dev_id,
		            'fname'=>$c->fname,
		            'lname'=>$c->lname,
		            'phone'=>$c->phone,
		            'email'=>$c->email,
		            'perhr'=>$c->perhr,
		            'code'=>$c->code,
		            'address_one'=>$c->address_one,
		            'status'=>$request->post('status'),
		            'review'=>$request->post('review'),
		        );
		        
		    }

	       // $result=DB::table('developer_interview_schedule')->insert($data);
	        $result=DB::table('developer_interview_schedule')->where('dev_id',$dev_id)->update($data);
	        
	        $result=DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);
	        

	        if($result==true)
	        {
	            session(['message' =>'success', 'schedule_errmsg' =>'Interview Feedback Sent Successfully.']);
	           
	            return redirect()->back();
	        }
	        else
	        {
	            session(['message' =>'danger', 'schedule_errmsg'=>'Interview Feedback Not Sent Successfully.']); 
	            return redirect()->back();
	        }
	    
    }
    
    // public function schedule_interview_qualified (Request $request)
    // {  

	   //    	request()->validate(
	   //     [
	   //         'status' => 'required',
	   //         'review' => 'required',
	   //     ]);
	        
    //   		$data=array(
    //             'status'=>$request->post('status'),
    //             'review'=>$request->post('review'), 
    //         );
            
    //         $dev_id= Session::get('dev_id');
    //         //$id=$request->post('update');
 
    //         // 			foreach($docs as $c)
    //         // 			{
    //         // 		        $data=array(
    //         // 		            'dev_id'=>$dev_id,
    //         // 		            'fname'=>$c->fname,
    //         // 		            'lname'=>$c->lname,
    //         // 		            'phone'=>$c->phone,
    //         // 		            'email'=>$c->email,
    //         // 		            'perhr'=>$c->perhr,
    //         // 		            'code'=>$c->code,
    //         // 		            'address_one'=>$c->address_one,
    //         // 		            'status'=>$request->post('status'),
    //         // 		            'review'=>$request->post('review'),
    //         // 		        );
    //         // 		    }

	   //     $result=DB::table('developer_interview_schedule')->where('dev_id',$dev_id)->update($data);
	   //     $result=DB::table('developer_order_tb')->where('dev_id',$dev_id)->update($data);
	        
	   //     if($result==true)
	   //     {
	   //         session(['message' =>'success', 'schedule_errmsg' =>'Interview Schedule Successfully.']);
	           
	   //         return redirect()->back();
	   //     }
	   //     else
	   //     {
	   //         session(['message' =>'danger', 'schedule_errmsg'=>'Interview Schedule Not Successful.']); 
	   //         return redirect()->back();
	   //     }
	    
    // }
    

    public function submit_require_docs(Request $request)
    {  

    	$u_id=Session::get('user_login_id');

    	$dev_id = $request->post('dev_id');

    	
	       	request()->validate(
	        [
	            'require_docs' => ['required', 'mimes:pdf','max:5000gb'],
	        ]);

	        if($files=$request->file('require_docs'))
	        {
	            $new_name = rand().'.'.$request->require_docs->getClientOriginalExtension();
	            $getrequiredocs = $request->require_docs->move(public_path('upload\require'),$new_name); 
	        }

       		$docs = DB::table('developer_order_tb')->where('dev_id',$dev_id)->get();

			foreach($docs as $c)
			{
		        $data=array(

		            'dev_id'=>$c->dev_id,
		            'u_id'=>$c->u_id,
		            'fname'=>$c->fname,
		            'lname'=>$c->lname,
		            'phone'=>$c->phone,
		            'email'=>$c->email,
		            'address'=>$c->address_one,
		            'subject'=>$request->post('subject'),
		            'require_docs'=>$getrequiredocs,
		            'date'=>date('y/m/d')
		        );
		    }

	        $result=DB::table('require_docs_tb')->insert($data);

	        if($result==true)
	        {
	            session(['message' =>'success', 'require_docs_errmsg' =>'Require Docs Send Successfully.']);
	           
	            return redirect()->back();
	        }
	        else
	        {
	            session(['message' =>'danger', 'require_docs_errmsg'=>'Require Docs Not Send.']); 
	            return redirect()->back();
	        }
	    
    }


    public function submit_short_message(Request $request)
    {  

    	$u_id=Session::get('user_login_id'); 
        
       	request()->validate(
        [
           'subject' => 'required',
           'description' => 'required',
        ]);

        
        $dev_id = $request->post('dev_id');

       $docs = DB::table('developer_order_tb')->where('dev_id',$dev_id)->get();

		foreach($docs as $c)
		{
	        $data=array(
	            'dev_id'=>$c->dev_id,
	            'u_id'=>$c->u_id,
	            'fname'=>$c->fname,
	            'lname'=>$c->lname,
	            'phone'=>$c->phone,
	            'email'=>$c->email,
	            'address'=>$c->address_one,
	            'subject'=>$request->post('subject'),
	            'description'=>$request->post('description'),
	            'date'=>date('y/m/d')
	        );
	    }

        $result=DB::table('short_message_tb')->insert($data);

        $deta = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.email','developer_details_tb.dev_id','developer_order_tb.u_id','developer_order_tb.dev_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('u_id' ,'=', $u_id )
    	->get();    	

        $emails=array();
        foreach ($deta as $key) 
        {
            $emails[]= $key->email;         
            $name = $key->name;           
        }

        $datas=array(
            'name'=>$name,      
        );

        if($result==true)
        {
            session(['message' =>'success', 'require_docs_errmsg' =>'Short Message Send Successfully.']);
           
            Mail::send('client_short_mail', $datas, function($message) use ($emails)
            {
                $message->to($emails)->subject('Mellow Element');
                
                $message->from('dev@mellowelements.in', 'Mellow Elements');   
            });

            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'require_docs_errmsg'=>'Short Message Not Send.']); 
            return redirect()->back();
        }
    }

    public function submit_sow_docs(Request $request)
    {  

    	$u_id=Session::get('user_login_id'); 

    	$dev_id = $request->post('dev_id');
    	
    	$developer_data_details = DB::table('sow_tb')->where('dev_id',$dev_id)->where('u_id' ,'=', $u_id )->where('sow_payment_status','=',NULL)->count();

    	if( $developer_data_details == 0){

		       	request()->validate(
		        [
		            'sow_docs' => ['required', 'mimes:pdf','max:5000gb'],
		        ]);

		        if($files=$request->file('sow_docs'))
		        {
		            $new_name = rand().'.'.$request->sow_docs->getClientOriginalExtension();
		            $getsowdocs = $request->sow_docs->move(public_path('upload\sow'),$new_name); 
		        }

       			$docs = DB::table('developer_order_tb')->where('dev_id',$dev_id)->get();

				foreach($docs as $c)
				{
			        $data=array(

			            'dev_id'=>$c->dev_id,
			            'u_id'=>$c->u_id,
			            'fname'=>$c->fname,
			            'lname'=>$c->lname,
			            'phone'=>$c->phone,
			            'email'=>$c->email,
			            'subject'=>$request->post('subject'),
			            'address'=>$c->address_one,
			            'sow_docs'=>$getsowdocs,
			            'sow_status'=>'0',
			            'date'=>date('y/m/d')
			        );
			    }

	        	$result=DB::table('sow_tb')->insert($data);

		        if($result==true)
		        {
		            session(['message' =>'success', 'require_docs_errmsg' =>'SOW Docs Send Successfully.']);
		           
		            return redirect()->back();
		        }
		        else
		        {
		            session(['message' =>'danger', 'require_docs_errmsg'=>'SOW Docs Not Send.']); 
		            return redirect()->back();
		        }
        }else{

        	$developer_sow_details = DB::table('sow_tb')->where('dev_id',$dev_id)->where('u_id' ,'=', $u_id )->where('sow_payment_status','=',NULL)->first();

        	if($developer_sow_details->sow_status == NULL)
        	{
        		session(['message' =>'danger', 'require_docs_errmsg'=>'You have already Sent One SOW! Please Request Developer to reject Previous SOW!']); 
	            return redirect()->back();

        	}
        	elseif($developer_sow_details->sow_status == '1')
        	{
        		session(['message' =>'danger', 'require_docs_errmsg'=>'You have already Sent One SOW! Please Request Developer to reject Previous SOW!']); 
	            return redirect()->back();

        	}elseif($developer_sow_details->sow_status == '2'){

        		request()->validate(
		        [
		            'sow_docs' => ['required', 'mimes:pdf','max:5000gb'],
		        ]);

		        if($files=$request->file('sow_docs'))
		        {
		            $new_name = rand().'.'.$request->sow_docs->getClientOriginalExtension();
		            $getsowdocs = $request->sow_docs->move(public_path('upload\sow'),$new_name); 
		        }

       			$docs = DB::table('developer_order_tb')->where('dev_id',$dev_id)->get();

				foreach($docs as $c)
				{
			        $data=array(

			            'dev_id'=>$c->dev_id,
			            'u_id'=>$c->u_id,
			            'fname'=>$c->fname,
			            'lname'=>$c->lname,
			            'phone'=>$c->phone,
			            'email'=>$c->email,
			            'subject'=>$request->post('subject'),
			            'address'=>$c->address_one,
			            'sow_docs'=>$getsowdocs,
			            'sow_status'=>'1',
			            'date'=>date('y/m/d')
			        );
			    }

			    $result=DB::table('sow_tb')->where('dev_id',$dev_id)->where('u_id' ,'=', $u_id )->where('sow_payment_status','=',NULL)->update($data);
			    if($result==true)
		        {
		            session(['message' =>'success', 'require_docs_errmsg' =>'SOW Docs Send Successfully.']);
		           
		            return redirect()->back();
		        }
		        else
		        {
		            session(['message' =>'danger', 'require_docs_errmsg'=>'SOW Docs Not Send.']); 
		            return redirect()->back();
		        }
        	}
	    		
	    }
    }

    public function assign_work(Request $request)
    {  
    	$show['developer_order_details']=$this->developer_order_data();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get();
    	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

    	$show['web_details'] = DB::table('web_setting')->get();

    	$u_id=Session::get('user_login_id'); 

    	
    	$show['dev_order_details'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.image','developer_details_tb.dev_id','developer_details_tb.rating','developer_details_tb.pro_id','developer_order_tb.id','developer_order_tb.order_id','developer_order_tb.payment_status','developer_order_tb.date','developer_order_tb.u_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
    	->orderby('id','desc')
    	->where('u_id' ,'=', $u_id )
    	->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
    	->get();

		$show['profession'] = DB::table('higher_professional_tb')->orderby('id','desc')->get(); 


    	$show['dev_order_details_empty'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.image','developer_details_tb.dev_id','developer_order_tb.id','developer_order_tb.order_id','developer_order_tb.payment_status','developer_order_tb.date','developer_order_tb.u_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
    	->count(); 
    	
    	
    	$show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        
    	return view('front/assign_work')->with($show);
    }

    public function assign_work_details($dev_id)
    {  
        $show['developer_order_details']=$this->developer_order_data();
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->limit(3)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
       
        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();
        
        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        


    	$show['developer_resource'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_order_tb.u_id','developer_order_tb.dev_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('u_id' ,'=', $u_id )
        ->where('developer_order_tb.dev_id' ,'=', $dev_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
    	->get();

    	/*$show['require_docs_details'] = DB::table('require_docs_tb')
    	->select('developer_order_tb.dev_id','developer_order_tb.payment_status','require_docs_tb.dev_id','require_docs_tb.id','require_docs_tb.subject','require_docs_tb.date','require_docs_tb.require_docs','require_docs_tb.u_id')
        ->join('developer_order_tb','developer_order_tb.dev_id', '=', 'require_docs_tb.dev_id')
    	->where('require_docs_tb.u_id' ,'=', $u_id )
    	->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
    	->where('require_docs_tb.dev_id' ,'=', $dev_id )
    	->get();

    	$show['short_message_details'] = DB::table('short_message_tb')
    	->select('developer_order_tb.dev_id','developer_order_tb.payment_status','short_message_tb.dev_id','short_message_tb.id','short_message_tb.subject','short_message_tb.date','short_message_tb.description','short_message_tb.u_id')
        ->join('developer_order_tb', 'developer_order_tb.dev_id', '=', 'short_message_tb.dev_id')
    	->where('short_message_tb.u_id' ,'=', $u_id )
    	->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
    	->where('short_message_tb.dev_id' ,'=', $dev_id )
    	->get();

    	//$show['sow_details'] = DB::table('sow_tb')->where('u_id' ,'=', $u_id )->get();

    	$show['sow_details'] = DB::table('sow_tb')
    	->select('developer_order_tb.dev_id','developer_order_tb.payment_status','sow_tb.dev_id','sow_tb.id','sow_tb.subject','sow_tb.date','sow_tb.sow_docs','sow_tb.u_id')
        ->join('developer_order_tb', 'developer_order_tb.dev_id', '=', 'sow_tb.dev_id')
    	->where('sow_tb.u_id' ,'=', $u_id )
    	->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
    	->where('sow_tb.dev_id' ,'=', $dev_id )
    	->get();*/

    	$show['require_docs_details'] = DB::table('require_docs_tb')->where('dev_id' ,'=', $dev_id )->get();
    	$show['short_message_details'] = DB::table('short_message_tb')->where('dev_id' ,'=', $dev_id )->get();
    	$show['sow_details'] = DB::table('sow_tb')->where('dev_id' ,'=', $dev_id )->get();

    	return view('front/assign_work_details')->with($show);
    }

    public function sow_docs_download($id)
    {   
       $details = DB::table('sow_tb')->where('id','=',$id)->first();
                   
        $file = $details->sow_docs;
        $myFile = public_path('upload/sow/'.$file);
        return response()->download($file); 
    }

    public function require_docs_download($id)
    {   
        $details = DB::table('require_docs_tb')->where('id','=',$id)->first();
        $file = $details->require_docs;
        $myFile = public_path('upload/require/'.$file);
        return response()->download($file); 
    }
    
    public function dev_qualified_checkout(Request $request, $dev_id)
    {   
        $devs_id =$request->route('dev_id');
         $u_id=Session::get('user_login_id'); 
        
         $show['developer_resourcequl'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.dev_id' ,'=', $devs_id )
        ->where('developer_order_tb.status' ,'=', '1' )
    	->get();
       // dd($show['developer_resourcequl']);
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
       	$show['web_details'] = DB::table('web_setting')->get();
       	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

       
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();  
        
        $show['developer_details']=$this->developer_data();
        $show['developer_order_details']=$this->developer_order_data();
        
        $show['developer_resources'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        
    	->get();
        $d_id=Session::get('dev_id'); 
        //echo $d_id; exit();
        $show['dev_qualified_table_details'] = DB::table('developer_order_tb')->where('dev_id',$devs_id)->get();
        //echo $show['dev_qualified_table_details']; exit();
        return view('front/dev_qualified_checkout')->with($show);
    }
    
    public function why_qualified_advance(Request $request, $dev_id)
    {   
        // $d_id=Session::get('dev_id');
        $devs_id =$request->route('dev_id');
        //echo $devs_id; exit();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
       	$show['web_details'] = DB::table('web_setting')->get();
       	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count(); 
        
        $show['developer_resourcequl'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.dev_id' ,'=', $devs_id )
        ->where('developer_order_tb.status' ,'=', '1' )
    	->get();
    	//dd($show['developer_resourcequl']);
    	
    	$show['developer_resources'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.payment_status' ,'=', 'SUCCESS' )
        
    	->get();
    	
        
        $show['developer_details']=$this->developer_data();
        $show['developer_order_details']=$this->developer_order_data();
        return view('front/why_qualified_advance')->with($show);
    }
    
    public function devq_payment_initiate(Request $request, $dev_id)
    {   
        $u_id=Session::get('user_login_id'); 
        $devs_id =$request->route('dev_id');
         //$u_id=Session::get('user_login_id'); 
        
         $show['developer_resourcequl'] = DB::table('developer_order_tb')
    	->select('developer_details_tb.name','developer_details_tb.last_name','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.education','developer_details_tb.rating','developer_details_tb.language','developer_details_tb.address','developer_details_tb.date','developer_details_tb.dev_id','developer_details_tb.degree','developer_order_tb.status','developer_order_tb.u_id','developer_order_tb.dev_id','developer_order_tb.interviewdateone','developer_order_tb.interviewdatetwo','developer_order_tb.interviewdatethree')
        ->join('developer_details_tb','developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
        ->where('developer_order_tb.u_id' ,'=', $u_id )
        ->where('developer_order_tb.dev_id' ,'=', $devs_id )
        ->where('developer_order_tb.status' ,'=', '1' )
    	->get();
        
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
       	$show['web_details'] = DB::table('web_setting')->get();
       	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();  
        
        $d_id=Session::get('dev_id');
        $show['devq_payment_details'] = DB::table('developer_order_tb')->where('dev_id',$d_id)->orderby('dev_id','asc')->get();
    	$d_id= Session::get('developer_login_id');
		$show['developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();
		$show['dev_qualified_table_details'] = DB::table('developer_order_tb')->where('dev_id',$devs_id)->get();
		//$show['dev_qualified_table_details'] = DB::table('developer_details_tb')->where('dev_id',$d_id)->orderby('dev_id','asc')->get();
		$show['developer_order_details']=$this->developer_order_data();
		//$d_id= Session::get('developer_login_id');
		//echo $d_id; exit();
		
  		$fname = $request->post('name');
  		$lname = $request->post('last_name');
		$email = $request->post('email');
		$phone = $request->post('phone');
		$country = $request->post('country');
		$state = $request->post('state');
		$city = $request->post('city');
		$address_one = $request->post('address_one');
		$code = $request->post('code');
		$purpose = $request->post('purpose');

		session(['name' => $fname]);
		session(['last_name' => $lname]);
		session(['email' => $email]);
		session(['phone' => $phone]);
		session(['country' => $country]);
		session(['state' => $state]);
		session(['city' => $city]);
		session(['address_one' => $address_one]);
		session(['code' => $code]);
		session(['purpose' => $purpose]);
		
		$tprice= Session::get('total_price');
		
		//echo $tprice; exit();
		$final=$tprice;		
		// Generate random receipt id
        $receiptId = Str::random(20);        
        // Create an object of razorpay
        $api = new Api($this->razorpayId, $this->razorpayKey);
        // In razorpay you have to convert rupees into paise we multiply by 100
        // Creating order
        $order = $api->order->create(array(
			'receipt' => $receiptId,
			'amount' => $final * 100,
			'currency' => 'INR'
			)
        );

        request()->validate([
					'phone' => 'required|digits:10',
				]);
        // Return response on payment page
        $response = [
			'orderId' => $order['id'],
			'razorpayId' => $this->razorpayId,
			'currency' => 'INR',
			'amount' => $final,			
			'name' =>$fname,
			'last_name' =>$lname,             
			'email' => $email,
			'phone' =>$phone,
			'country' =>$country,
			'state' =>$state,
			'city' =>$city,
			'address_one' =>$address_one,
			'code' =>$code,
			'purpose' =>$purpose,
			'description' => 'Buy Plan Payment',
        ];
        // Let's checkout payment page is it working	
        return view('front/devqpayment',compact('response'))->with($show);
    }
    
    public function dev_qcheckout(Request  $request, $dev_id)
    { 
        $u_id=Session::get('user_login_id'); 
        //echo $u_id; exit();
        $devs_id =$request->route('dev_id');
    	//$d_id= Session::get('developer_login_id');
    	
		$show['developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();
		$show['developer_order_details']=$this->developer_order_data();

        $fname = Session::get('name');
        $lname = Session::get('last_name');
        $email = Session::get('email');
        $phone = Session::get('phone');
        $country = Session::get('country');
        $state = Session::get('state');
        $city = Session::get('city');
        $address_one = Session::get('address_one');
        $code = Session::get('code');
        $purpose = Session::get('purpose');
    	$tprice= Session::get('total_price');

    	$signatureStatus = $this->SignatureVerifyss(
			$request->all()['rzp_signature'],
			$request->all()['rzp_paymentid'],
			$request->all()['rzp_orderid']
		);
		// If Signature status is true We will save the payment response in our database
		// In this tutorial we send the response to Success page if payment successfully made
		if($signatureStatus == true)
		{

			$d_id= Session::get('developer_login_id');
			$order_id = rand(0,9999);
			
			$pre = DB::table('developer_order_tb')->where('dev_id','=',$devs_id)->get();     
			
				foreach($pre as $c)
				{
					$order_data=array(
				    'order_id'=>$order_id,
					'dev_id'=>$devs_id,
				    'name'=>$fname,
				    'last_name'=>$lname,
				    'email'=>$email,
				    'phone'=>$phone,
				    'country'=>$country,
					'state'=>$state,
					'city'=>$city,
					'address_one'=>$address_one,
					'code'=>$code,
					'purpose'=>$purpose,
					'tprice'=>$tprice,
					'status'=>'2',				
					'payment_status'=>'SUCCESS',
					'p_code'=>'1',
					'qdate' => date("Y-m-d")				
					);
					
					DB::table('qualified_order_tb')->insert($order_data);
					DB::table('developer_order_tb')->where('dev_id','=',$devs_id)->update($order_data);

					$payment_data=array(
					'order_id'=>$order_id,
					'tprice'=>$tprice,
					'razorpay_payment_id'=>$request->all()['rzp_paymentid'],
					'date' => date("Y-m-d")
					);	

					DB::table('qualified_payment_tb')->insert($payment_data);

					$email=Session::get('email');
					$details = DB::table('qualified_order_tb')->where('email',$email)->get();
		            $emails=array();
		            foreach ($details as $key) 
		            {
		                $emails[]= $key->email;
		            }

		            $data = DB::table('qualified_order_tb')->where('email',$email)->get();
		            foreach ($data as $k) 
		            {
		                $fname = $k->name;
		                $order_id = $k->order_id;
		                $url = route('contact');
		            }
		           	$datas=array(
		                'name'=>$fname,
		                'order_id'=>$order_id,
		                'link'=>$url
		            );

		           	$details=array(
		                'order_id'=>$order_id,
		            );

					Mail::send('qualified_payment_mail', $datas, function($message) use ($emails) {
			            $message->to($emails)->subject('Mellow Element');
			            $message->from('info@mellowelements.in', 'Mellow Elements');   
			        });

			        Mail::send('admin_qualified_payment_mail', $details, function($message) {
			           $message->to('mellowtulika@gmail.com')->subject('Mellow Elements');
			           $message->from('info@mellowelements.in', 'Mellow Elements');  
			       	});

				}

				return redirect()->route('dev_thank_you')->with($show);
				//return redirect('front/thank_you')->with($show);

			//echo 'rzp_signature'.$request->all()['rzp_signature'];
			//echo "<br>";
			//echo 'rzp_paymentid'.$request->all()['rzp_paymentid'];
			//echo "<br>";
			//echo 'rzp_orderid'.$request->all()['rzp_orderid'];
		}
		else
		{
			// You can create this page
			 session(['message' =>'danger', 'errmsg'=>'Payment Not Completed']); 
            return redirect()->back();
		}
	}
	
	private function SignatureVerifyss($_signature,$_paymentId,$_orderId)
	{
		try
		{
			// Create an object of razorpay class
			$api = new Api($this->razorpayId, $this->razorpayKey);
			$attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
			$order  = $api->utility->verifyPaymentSignature($attributes);
			return true;
		}
		catch(\Exception $e)
		{
			// If Signature is not correct its give a excetption so we use try catch
			return false;
		}
	}
	
	public function dev_thank_you()
    {  
        
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
       	$show['web_details'] = DB::table('web_setting')->get();
       	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count(); 
        $show['developer_order_details']=$this->developer_order_data();
        
    	$d_id= Session::get('developer_login_id');
		$show['developer_details'] = DB::table('developer_details_tb')->orderby('dev_id','desc')->get();

		return view('front/dev_thank_you')->with($show);
    }

}
