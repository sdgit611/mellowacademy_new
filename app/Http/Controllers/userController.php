<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use PDF;
use Image;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use URL;

class userController extends Controller
{
	private $razorpayId = "rzp_live_k8FyLiwKwfBx2j";
    private $razorpayKey = "ltaegAk3x7CH3RPRhcs5eUDV";

    public function developer_order_data()
    { 
        $u_id=Session::get('user_login_id');  
        return  $developer_order_details = DB::table('developer_order_tb')->where('payment_status' ,'=', 'SUCCESS')->where('u_id' ,'=', $u_id )->count();
    }
	
   public function registration()
    { 
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/registration')->with($show);
    }

    public function login()
    { 
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/login')->with($show);
    }

    public function submit_registeration(Request $request)
    {
        $response = Http::withoutVerifying()->post('https://gulbug.com/staging/mellow_backend/public/api/employer-register', [
            'company_name' => $request->input('company_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'show_password' => $request->input('password'),
            'location' => $request->input('location'),
        ]);
        
        $response->body();
		
        $email=$request->post('email');
       // echo $email; exit();
		request()->validate([
		'fname' => 'required',
		'lname' => 'required',
		'location' => 'required',
		'email' => 'required|email',
		'phone' => 'required|digits:10',
		'password' => 'required|min:5',
		'user_name' => 'required|min:5|max:255',
	
		]);
             
			$email=$request->post('email');
		
			$phone=$request->post('phone');
			$count = DB::table('user_login')->where('email',$email)->orwhere('phone',$phone)->count();
			if($count == 0)
			{
				$data=array(
					'fname'=>$request->post('fname'),
					'lname'=>$request->post('lname'),
					'email'=>$request->post('email'),
					'phone'=>$request->post('phone'),
					'location'=>$request->post('location'),
					'address'=>$request->post('address'),
					'password'=>md5($request->post('password')),
					'show_password'=>$request->post('password'),
					'user_name'=>$request->post('user_name'),
					'company_name'=>$request->post('company_name'),
					'purpose'=>$request->post('purpose'),
					'date'=>date('Y-m-d')
					);

                //dd($data);
				$result=DB::table('user_login')->insert($data);

				$email=$request->post('email'); 
        
	            $details = DB::table('user_login')->where('email',$email)->get();
	            $emails=array();
	            foreach ($details as $key) 
	            {
	                $emails[]= $key->email;
	                $email= $key->email;
	                $fname= $key->fname;
	            }

	           $datas=array(
	                'email'=>$email,
	                'fname'=>$fname,
	            );
	            $URL = url()->current();
	            $link = $URL;
	            
	            $files = [
                    public_path('front/assets/images/Logo-01.png'),
                    URL::$link,
                ];
                

				if($result==true)
				{
					session(['message' =>'success', 'errmsg' =>'Registration Complete']);
					

						Mail::send('registration_mail', $datas, function($message) use ($emails, $files) {
                		$message->to($emails)->subject('Mellow Elements');
                		foreach ($files as $file){
                            $message->attach($file);
                        }
                		$message->from('welcome@mellowvault.com', 'Mellow Vault');
            		});
            		
            		$show['developer_order_details']=$this->developer_order_data();
                	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
                    $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
                    $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
                    $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
                    $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

					return view('front/registration_completed')->with($show);
				}
				else
				{
					session(['message' =>'danger', 'errmsg'=>'Registration Not Complete']); 
					return redirect()->back();
				}
			}
			else
			{
				session(['message' =>'danger', 'errmsg' =>'Email Address Or Contact Number Already Exists.']);
				return redirect()->back();
			}
	}

	//old function with only login md5 but in new function hash || md5 
	// public function verify_login(Request $request)
    // {
    // 	$show['developer_order_details']=$this->developer_order_data();
    // 	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    // 	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
    //     $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
    //     $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
    //     $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

    //     $show['web_details'] = DB::table('web_setting')->get();

    //    	$show['cart_details'] = DB::table('cart_tb')
    //     ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
    //     ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
    //     ->whereNull('status')
    //     ->get();

    //      $u_id=Session::get('user_login_id'); 

    //     $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
    //     $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
    //     $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
    //     $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

	// 	request()->validate(['phone' => 'required','password' => 'required']);		
		
	// 	$phone=$request->post('phone');
	// 	$pass=$request->post('password');
	// 	$password=md5($pass);

	// 	$use = DB::table('user_login')->where('email','=',$phone)->where('password','=',$password)->orwhere('phone','=',$phone)->count();
    //    	if($use > 0)
    //     {
	// 		$details= DB::table('user_login')->where('email','=',$phone)->where('password','=',$password)->orwhere('phone','=',$phone)->get();
	// 		foreach($details as $dd)
	// 		{
	// 			$id=$dd->id;
	// 			$email=$dd->email;
    //             $fname=$dd->fname;
	// 		}
	// 			session(['client_login_id' => $id,'client_email_login' => $email,'client_name_login' => $fname]);
	// 			session(['user_login_id' => $id]);
    //        	    $cart = Session::get('cart');
    //        		$developer_cart = Session::get('developer_cart');


    //        		if(!empty($cart))
	// 			{
	// 				$u_id=$id;
    //        			foreach ($cart as $id => $val) 
	// 				{					
	// 					$p_id=$cart[$id]['p_id'];
	// 					$count=DB::table('cart_tb')->whereNull('status')->where('p_id','=',$p_id)->where('u_id','=',$u_id)->count();
	// 					if($count == 0)
	// 					{
	// 						$data = array('u_id'=>$u_id,'p_id'=>$p_id,'status'=>null);
	// 						DB::table('cart_tb')->insert($data);
	// 					}
	// 				}
	// 				Session::forget('cart');
	// 			}
	// 		if(!empty($developer_cart))
	// 		{
	// 			$u_id=$id;

	// 			foreach ($developer_cart as $id => $val) 
	// 			{					
	// 				$dev_id=$developer_cart[$id]['dev_id'];
	// 				$count=DB::table('developer_cart_tb')->whereNull('status')->where('dev_id','=',$dev_id)->where('u_id','=',$u_id)->count();
	// 				if($count == 0)
	// 				{
	// 					$data = array('u_id'=>$u_id,'dev_id'=>$dev_id,'status'=>null);
	// 					DB::table('developer_cart_tb')->insert($data);
	// 				}
	// 			}
					
	// 			Session::forget('developer_cart');
	// 		}
           
	// 		return redirect()->route('index')->with($show);
	// 	}
    //     else
    //     {
    //         //session(['message' =>'danger','loginerrmsgs' =>'Login Failed ? Mobile Number / Email & Password Wrong....']);
    //         //return redirect()->route('index')->with($show);

    //         return view('front/wrong_login')->with($show);
    //     }
	// }

	//new login function with hash || md5 password 
	public function verify_login(Request $request)
	{
		// Validate input
		$request->validate([
			'phone' => 'required',
			'password' => 'required'
		]);

		$show['developer_order_details'] = $this->developer_order_data();
		$show['user_details'] = DB::table('user_login')->orderBy('id', 'desc')->get(); 
		$show['category'] = DB::table('category_tb')->orderBy('id', 'desc')->get();
		$show['banner'] = DB::table('banner_tb')->orderBy('id', 'desc')->get();
		$show['subcategorys'] = DB::table('subcategory_tb')->orderBy('id', 'asc')->get();
		$show['higher_professional'] = DB::table('higher_professional_tb')->orderBy('id', 'desc')->get();
		$show['web_details'] = DB::table('web_setting')->get();

		$u_id = Session::get('user_login_id');
		$show['cart_value'] = DB::table('cart_tb')->whereNull('status')->where('u_id', $u_id)->count();
		$show['cart_empty'] = DB::table('cart_tb')->whereNull('status')->where('u_id', $u_id)->count();
		$show['developer_cart_empty'] = DB::table('developer_cart_tb')->whereNull('status')->where('u_id', $u_id)->count();
		$show['developer_cart_value'] = DB::table('developer_cart_tb')->whereNull('status')->where('u_id', $u_id)->count();

		$phone = $request->post('phone');
		$pass = $request->post('password');

		// Find user by email or phone
		$loginUser = DB::table('user_login')
			->where(function ($query) use ($phone) {
				$query->where('email', $phone)->orWhere('phone', $phone);
			})
			->first();

		if ($loginUser) {
			$storedPassword = $loginUser->password;

			// Check both Hash::check() and md5() match
			if (Hash::check($pass, $storedPassword) || $storedPassword === md5($pass)) {

				// Auto-upgrade md5 to hashed password
				if ($storedPassword === md5($pass)) {
					DB::table('user_login')->where('id', $loginUser->id)->update([
						'password' => Hash::make($pass)
					]);
				}

				// Set session
				session([
					'client_login_id' => $loginUser->id,
					'client_email_login' => $loginUser->email,
					'client_name_login' => $loginUser->fname,
					'user_login_id' => $loginUser->id
				]);

				// Merge cart items if any
				$cart = Session::get('cart');
				if (!empty($cart)) {
					foreach ($cart as $item) {
						$count = DB::table('cart_tb')
							->whereNull('status')
							->where('p_id', $item['p_id'])
							->where('u_id', $loginUser->id)
							->count();

						if ($count === 0) {
							DB::table('cart_tb')->insert([
								'u_id' => $loginUser->id,
								'p_id' => $item['p_id'],
								'status' => null
							]);
						}
					}
					Session::forget('cart');
				}

				// Merge developer cart
				$developer_cart = Session::get('developer_cart');
				if (!empty($developer_cart)) {
					foreach ($developer_cart as $item) {
						$count = DB::table('developer_cart_tb')
							->whereNull('status')
							->where('dev_id', $item['dev_id'])
							->where('u_id', $loginUser->id)
							->count();

						if ($count === 0) {
							DB::table('developer_cart_tb')->insert([
								'u_id' => $loginUser->id,
								'dev_id' => $item['dev_id'],
								'status' => null
							]);
						}
					}
					Session::forget('developer_cart');
				}

				// Redirect to home
				return redirect()->route('index')->with($show);
			} else {
				// Password incorrect
				return view('front/wrong_login')->with($show);
			}
		} else {
			// User not found
			return view('front/wrong_login')->with($show);
		}
	}


	public function user_logout()
	{
		$show['developer_order_details']=$this->developer_order_data();
		$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
		$show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
		$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		Session::forget('user_login_id');
		Session::flush();
		return redirect()->route('index')->with($show);
	}
	
	public function add_to_cart(Request $request)
    { 
		$u_id=Session::get('user_login_id'); 
		$p_id=$request->post('p_id');

		if(empty($u_id))
		{
			$cart = Session::get('cart');
			$qty=0;				
			$cart[] = array(
				"p_id" => $p_id,	
			);
			Session::put('cart', $cart);
			$i=1;
			foreach ($cart as $id => $val) 
			{			
				$qty+=$cart[$id]['p_id'];	
				$i++;
			}
			echo $i;
		}
		else
		{
			$count=DB::table('cart_tb')->whereNull('status')->where('p_id','=',$p_id)->where('u_id','=',$u_id)->count();
			if($count == 0)
			{
				$data = array('u_id'=>$u_id,'p_id'=>$p_id,'status'=>null);
				DB::table('cart_tb')->insert($data);
			}
			echo $count=DB::table('cart_tb')->whereNull('status')->where('u_id','=',$u_id)->count();
		}	
	}

	public function delete_cart($id)
    {
        $info_delete=DB::table('cart_tb')->where('id', $id)->delete();
        if($info_delete==true)
        {
           session(['message' =>'success', 'errmsg'=>'Cart Item Delete Successfully!']); 
           return redirect()->route('cart');
        }
        else
        {

            session(['message' =>'danger', 'errmsg'=>'Cart Item Delete Failed']); 
            return redirect()->route('user_profile');
        }
    }  

	public function proceed_to_checkout()
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/proceed_to_checkout')->with($show);
    }

    public function payment_initiate(Request $request)
    {
    	$show['developer_order_details']=$this->developer_order_data();
		$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();


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


		session(['fname' => $fname]);
		session(['lname' => $lname]);
		session(['email' => $email]);
		session(['phone' => $phone]);
		session(['company_name' => $company_name]);
		session(['country' => $country]);
		session(['state' => $state]);
		session(['city' => $city]);
		session(['address_one' => $address_one]);
		session(['address_two' => $address_two]);
		session(['code' => $code]);
		session(['gst' => $gst]);
		
		session(['purpose' => $purpose]);
		
		$tprice= Session::get('total_price');
				
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
			'fname' =>$fname,
			'lname' =>$lname,             
			'email' => $email,
			'phone' =>$phone,
			'company_name' =>$company_name,
			'country' =>$country,
			'state' =>$state,
			'city' =>$city,
			'address_one' =>$address_one,
			'address_two' =>$address_two,
			'code' =>$code,
			'gst' =>$gst,
			'purpose' =>$purpose,
			'description' => 'Buy Plan Payment',
        ];
        // Let's checkout payment page is it working	
	return view('front/payment',compact('response'))->with($show);
    }
	

	public function checkout(Request $request)
    { 
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

    	$fname=Session::get('fname');
    	$lname=Session::get('lname');
    	$email=Session::get('email');
    	$phone=Session::get('phone');
    	$company_name=Session::get('company_name');
    	$country=Session::get('country');
    	$state=Session::get('state');
    	$city=Session::get('city');
    	$address_one=Session::get('address_one');
    	$address_two=Session::get('address_two');
    	$code=Session::get('code');
    	$gst=Session::get('gst');
    	$tax=Session::get('tax');
    	$purpose=Session::get('purpose');
    	$tprice= Session::get('total_price');

    	$signatureStatus = $this->SignatureVerify(
			$request->all()['rzp_signature'],
			$request->all()['rzp_paymentid'],
			$request->all()['rzp_orderid']
		);
		// If Signature status is true We will save the payment response in our database
		// In this tutorial we send the response to Success page if payment successfully made
		if($signatureStatus == true)
		{
			

			$u_id=Session::get('user_login_id'); 
			$order_id = rand(0,9999);
			
			$cart = DB::table('cart_tb')
				->select('product_tb.id','cart_tb.id as c_id')
				->join('product_tb', 'product_tb.id', '=', 'cart_tb.p_id')
				->whereNull('cart_tb.status')->where('cart_tb.u_id','=',$u_id)->get();		
				
				foreach($cart as $c)
				{
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
					'tax'=>$tax,
					'purpose'=>$purpose,
					'p_id'=>$c->id,
					'tprice'=>$tprice,
					'status'=>'Booked',				
					'payment_status'=>'SUCCESS',
					'date' => date("Y-m-d")				
					);				
					DB::table('order_tb')->insert($order_data);

					$payment_data=array(
					'order_id'=>$order_id,
					'tprice'=>$tprice,
					'razorpay_payment_id'=>$request->all()['rzp_paymentid'],
					'date' => date("Y-m-d")
					);	

					DB::table('payment_tb')->insert($payment_data);
					
					$c_id=$c->c_id;
					$cart_data=array('status'=>'Order');
					DB::table('cart_tb')->where('id','=',$c_id)->update($cart_data);

					$p_id = $c->id;
					$pro_dev_details = DB::table('product_tb')->where('id',$p_id)->first();
					
					$dev_id = $pro_dev_details->dev_id;
					$pro_price = $pro_dev_details->price;
					$tax = $pro_dev_details->tax;

					$price = $pro_price + $calculate_price =(( $tax / 100 ) * $pro_price );

					$original_price = $price - $calculate_price =(( 30 / 100 ) * $price );

					$wallet_data=array(
					'order_id'=>$order_id,
					'total_price'=>$price,
					'original_price'=>$original_price,
					'p_id'=>$c->id,
					'u_id'=>$u_id,
					'dev_id'=>$dev_id,
					'transaction_status'=>0,
					);
					DB::table('wallet_tb')->insert($wallet_data);

					$email=Session::get('email');
					$details = DB::table('order_tb')->where('email',$email)->get();
		            $emails=array();
		            foreach ($details as $key) 
		            {
		                $emails[]= $key->email;
		            }

		            $data = DB::table('order_tb')->where('email',$email)->get();
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

		           	$details=array(
		                'order_id'=>$order_id,
		            );

					Mail::send('payment_mail', $datas, function($message) use ($emails) {
			            $message->to($emails)->subject('Mellow Element');
			            $message->from('dev@mellowelements.in', 'Mellow Elements');   
			        });

			        Mail::send('admin_information_mail', $details, function($message) {
			           $message->to('mellowpayalchandra@gmail.com')->subject('Mellow Element');
			           $message->from('dev@mellowelements.in', 'Mellow Element');  
			       	});

				}

				return redirect()->route('thank_you');
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

	private function SignatureVerify($_signature,$_paymentId,$_orderId)
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
	
	public function thank_you()
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

		return view('front/thank_you')->with($show);
    }
    
    public function user_profile_details()
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

		return view('front/user_profile_details')->with($show);
    }

	public function user_profile()
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

		return view('front/user_profile')->with($show);
    }
    public function edit_profile(Request $request)
    {  
    	request()->validate([
		'fname' => 'required',
		'lname' => 'required',
		'email' => 'required|email',
		'phone' => 'required|digits:10',
		'user_name' => 'required|min:5|max:255',
		
		]);
        
        
        $data=array(
			'fname'=>$request->post('fname'),
			'lname'=>$request->post('lname'),
			'email'=>$request->post('email'),
			'phone'=>$request->post('phone'),
			'user_name'=>$request->post('user_name'),
			'company_name'=>$request->post('company_name'),
			'purpose'=>$request->post('user_purpose'),
			'date'=>date('Y-m-d')
		);

        $id=$request->post('update');       
        $result=DB::table('user_login')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Profile Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Profile Update Failed.']); 
            return redirect()->back();
        }
    }

    public function user_profile_show(Request $request)
    {   
        $purpose=$_POST['purpose'];
									
		if($purpose == 'For Myself')
		{
			$output='<input type="text" name="user_purpose" class="form-control" value="For Myself" palceholder="For Myself" readonly>';
            echo $output;
		}
		elseif($purpose == 'For Organization')
		{
			$output='<input type="text" name="user_purpose" class="form-control" value="For Organization" palceholder="For Organization" readonly>';
			
            echo $output;
		}
		else 
		{
			$output='<input type="text" name="user_purpose" class="form-control" value="For Designer" palceholder="For Designer" readonly>';
            echo $output;
		}
    }


    public function show_invoice()
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

		$show['order_details'] = DB::table('order_tb')->orderby('id','desc')->groupBy('order_id')->get();
        $show['dev_order_details'] = DB::table('developer_order_tb')->orderby('id','desc')->get();      
        $show['order_details_empty'] = DB::table('order_tb')->groupBy('order_id')->where('u_id' ,'=', $u_id )->orderby('id','desc')->count(); 
        $show['dev_order_details_empty'] = DB::table('developer_order_tb')->groupBy('order_id')->where('u_id' ,'=', $u_id )->orderby('id','desc')->count(); 
       	    
    	return view('front/show_invoice')->with($show);
    }

    public function invoice($id)
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

    	$count = DB::table('order_tb')->where('order_id','=',$id)->count();
		if($count > 0) {
	        $show['invoice'] = DB::table('order_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get(); 
	        $show['payment'] = DB::table('payment_tb')->where('order_id',$id)->orderby('id','desc')->get();
	       
	        $show['details'] = DB::table('order_tb')
			->select('product_tb.name','product_tb.image','product_tb.price','product_tb.tax','product_tb.video','order_tb.order_id','order_tb.tprice','order_tb.p_id')
			->join('product_tb', 'product_tb.id', '=', 'order_tb.p_id')
			->where('order_tb.order_id', $id)
			->get();

	        return view('front/invoice')->with($show);
	    }else {

			return redirect()->back();
		}
    }
    
	public function dev_invoice($id)
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
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

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

    	$count = DB::table('developer_order_tb')->where('order_id','=',$id)->count();
		if($count > 0) {
	    $show['dev_invoice'] = DB::table('developer_order_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get(); 
	    $show['dev_payment'] = DB::table('developer_payment_tb')->where('order_id',$id)->orderby('id','desc')->get();
	       
	    $show['dev_details'] = DB::table('developer_order_tb')
			->select('developer_details_tb.image','developer_details_tb.name','developer_details_tb.last_name','developer_order_tb.order_id','developer_order_tb.perhr','developer_order_tb.dev_id')
			->join('developer_details_tb', 'developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
			->where('developer_order_tb.order_id', $id)
			->get();

	        return view('front/developer_invoice')->with($show);
	    }else {

			return redirect()->back();
		}
    }

    public function my_download()
    {  
    	$ip = request()->ip();
        $show['pro_rating']=DB::table('rating_tb')->where('ip','=',$ip)->get();
    	
    	//$show['pro_rating'] = DB::table('rating_tb')->orderby('id','desc')->get(); 
        $show['developer_order_details']=$this->developer_order_data();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get();
    	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

    	$show['web_details'] = DB::table('web_setting')->get();

    	$u_id=Session::get('user_login_id'); 

    	$show['order_details'] = DB::table('order_tb')
    	->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.id','product_tb.video','order_tb.p_id','order_tb.order_id','order_tb.payment_status','order_tb.date','order_tb.u_id')
        ->join('product_tb','product_tb.id', '=', 'order_tb.p_id')
    	->orderby('order_tb.id','desc')
    	->get();

    	$show['order_empty'] = DB::table('order_tb')
    	->select('product_tb.name','product_tb.image','product_tb.id','order_tb.p_id','order_tb.order_id','order_tb.payment_status','order_tb.date','order_tb.u_id')
        ->join('product_tb','product_tb.id', '=', 'order_tb.p_id')
        ->where('u_id' ,'=', $u_id )
    	->count(); 

		$show['profession'] = DB::table('higher_professional_tb')->orderby('id','desc')->get(); 

    	
    	$show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        

		return view('front/my_download')->with($show);
    }
    
    public function act_setting()
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/account_setting')->with($show);
    }

	public function update_change_password(Request $request)
    {   
    	$id= Session::get('user_login_id');
		if(empty($id))
		{
			return redirect()->route('index');
		}
		request()->validate(['confirm_password' => 'required','new_password' => 'required','old_password' => 'required']);
		$new=$request->post('new_password');	
		$con=$request->post('confirm_password');
		$old=$request->post('old_password');
		if($new==$con)
		{	
			$use = DB::table('user_login')->where('password','=',md5($old))->where('id',$id)->count();
			if($use > 0)
			{			
				$data=array('password'=>md5($new),'show_password'=>$new);
				$update_result=DB::table('user_login')->where('id',$id)->update($data);

				$details_result=DB::table('user_login')->where('id',$id)->get();
				$emails=array();
	            foreach ($details_result as $key) 
	            {
	                $emails[]= $key->email;
	            }

	           	$datas=array(
	                'name'=>"Mellow Element"
	            );
				if($update_result==true)
				{
					session(['message' =>'success', 'errmsg' =>'Password Change Successfully.']);

					Mail::send('password_change_mail', $datas, function($message) use ($emails) {
		                $message->to($emails)->subject('Mellow Element');
		                $message->from('dev@mellowelements.in', 'Mellow Elements');
		                
		            });
					return redirect()->back();
				}
				else
				{
					session(['message' =>'danger', 'errmsg'=>'Password Change Failed. Due To Internal Server Error..']); 
					return redirect()->back();
				}
			}
			else
			{
				session(['message' =>'danger', 'errmsg'=>'Old Password Does Not Matched. Please Try Again.....']); 
				return redirect()->back();				
			}
		}
		else
		{
			session(['message' =>'warning', 'errmsg'=>'New Password & Confrim Password Do Not Matched.']); 
			return redirect()->back();
		}     
	}

	public function leave_comment(Request $req)
    {
        request()->validate([
        	'p_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);     
        $data = array(
        	'p_id'=>$req->post('p_id'),
            'name'=>$req->post('name'),
            'email'=>$req->post('email'),
            'comment'=>$req->post('comment'),
            'date'=>date('y/m/d')
        );      
        $result=DB::table('comment_tb')->insert($data);
        if ($result==true) 
        {
            session(['message' =>'success', 'errmsg' =>'Thank you for your kind comments!']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg' =>'Your Comments Not submitted!']);
            return redirect()->back();
        }           
    }

    public function reply(Request $req)
    {
        request()->validate([
        	'p_id' => 'required',
            'comment_id' => 'required',
            'reply_comment' => 'required'
        ]);     
        $data = array(
        	'p_id'=>$req->post('p_id'),
            'comment_id'=>$req->post('comment_id'),
            'reply_comment'=>$req->post('reply_comment'),
            'date'=>date('y/m/d')
        );      
        $result=DB::table('reply_comment_tb')->insert($data);
        if ($result==true) 
        {
            session(['message' =>'success', 'errmsg' =>'Thank you for replying quickly!']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg' =>'Your Comment Not submitted']);
            return redirect()->back();
        }           
    }

    public function search(Request $request)
    {
    	$show['developer_order_details']=$this->developer_order_data();
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
       $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

       $usersearch = $request->post('usersearch'); 
       if(empty($usersearch))
       {
            return redirect()->back();
       }else{
      
       		$show['search'] = DB::table('product_tb')->where( 'name', 'LIKE', '%' . $usersearch . '%')->orderby('id','desc')->get();
       		$show['search_total'] = DB::table('product_tb')->where( 'name', 'LIKE', '%' . $usersearch . '%')->orderby('id','desc')->count();
       		return view('front/search_result')->with($show);
	   }    	     
    }

    public function higher_professional()
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();

        $show['web_details'] = DB::table('web_setting')->get();
        
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();
        
        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
       // $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        //$show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/higher_professional')->with($show);
    }

    public function dev_details($id)
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['developer_details'] = DB::table('developer_details_tb')
    	->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.rating')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
    	->where('developer_details_tb.pro_id',$id)
    	->where('developer_details_tb.login_status',1)
    	->orderby('developer_details_tb.dev_id','desc')
    	->get();

    	$show['developer'] = DB::table('developer_details_tb')
    	->select('higher_professional_tb.id as ids','higher_professional_tb.heading','developer_details_tb.dev_id','developer_details_tb.pro_id','developer_details_tb.name','developer_details_tb.description','developer_details_tb.image','developer_details_tb.phone','developer_details_tb.email','developer_details_tb.job','developer_details_tb.perhr','developer_details_tb.rating')
        ->join('higher_professional_tb','higher_professional_tb.id' , '=' , 'developer_details_tb.pro_id')
    	->where('developer_details_tb.pro_id',$id)
    	->where('developer_details_tb.login_status',1)
    	->count();  

    	$show['higher_professional'] = DB::table('higher_professional_tb')->where('id',$id)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();

        $show['web_details'] = DB::table('web_setting')->get();
        
       $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        //$show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
       // $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/developer')->with($show);
    }

    public function developer_detail($id)
    {  
        $u_id=Session::get('user_login_id');

    	$show['developer_order_details']=$this->developer_order_data();
    	$show['deve'] = DB::table('developer_details_tb')->where('dev_id',$id)->get(); 
        $show['hire_dev'] = DB::table('developer_order_tb')->where('u_id',$u_id)->where('dev_id',$id)->where('payment_status','SUCCESS')->count(); 
    	$show['developer_project'] = DB::table('developer_project_details_tb')->where('developer_id',$id)->get(); 
    	$show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['web_details'] = DB::table('web_setting')->get();
        
        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        // $count = DB::table('developer_order_tb')->where('payment_status' ,'=', 'SUCCESS')->where('u_id' ,'=', $u_id )->where('dev_id',$id )->count();

        // if( $count > 0 ){

        // 	$data=array(
        //     'developer_status'=>'Booked',          
        // );       
        // 	$result=DB::table('developer_details_tb')->where('dev_id',$id)->update($data);
        // }


 		$current_date = date("Y-m-d");
 		$developer_dates = DB::table('developer_details_tb')->where('dev_id',$id)->first(); 
 		$date = $developer_dates->available_end_date;

 		if($current_date > $date && $date != NULL ){
                $data=array(
                    'developer_status'=>'NULL',
                    'available_start_date'=>NULL,
                    'available_end_date'=>NULL,
                );            
                $result = DB::table('developer_details_tb')->where('dev_id',$id)->update($data);

                $data=array(
                    'payment_status'=>'NULL',
                ); 

                $result = DB::table('developer_order_tb')->where('dev_id',$id)->update($data);
        }

       // $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        //$show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
       // $show['developer_go_to_cart'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->where('dev_id',$dev_id )->count();

		return view('front/developer_detail')->with($show);
    }

    public function update_image(Request $request)
   	{
        request()->validate(
        [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);  
        if ($request->hasFile('image')) {
			$file = $request->file('image');
			$getimageName = time() . '.' . $file->getClientOriginalExtension();
			
			// Move the uploaded file to the public path
			$file->move(public_path('upload/profile_image'), $getimageName);
		} else {
			$getimageName = $request->post('old_image');
		}
		

        $data=array(
            'image'=>$getimageName,
        );
        $id=$request->post('update');       
        $result=DB::table('user_login')->where('id',$id)->update($data);
        if($result==true)
        {
            session(['message' =>'success', 'errmsg' =>'Profile Image Update Successfully...']);
            return redirect()->back();
        }
        else
        {
            session(['message' =>'danger', 'errmsg'=>'Profile Image Update Failed.']); 
            return redirect()->back();
        }
    }
    public function invoice_pdf($id)
    {  
        $count = DB::table('order_tb')->where('order_id','=',$id)->count();
		if($count > 0)
		{
	        $shows = DB::table('order_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get(); 
	        $details = DB::table('payment_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get();
	        

	        $show = DB::table('order_tb')
			->select('product_tb.name','product_tb.price','product_tb.tax','product_tb.image','product_tb.video','order_tb.order_id','order_tb.tprice','order_tb.p_id')
			->join('product_tb', 'product_tb.id', '=', 'order_tb.p_id')
			->where('order_tb.order_id', $id)
			->get();

	        view()->share('shows',$shows);

	        view()->share('show',$show);

	        view()->share('details',$details);

	        $pdf = PDF::loadView('invoice_pdf');
            return $pdf->download('invoice_pdf.pdf');
	    }
	    else
		{
			return redirect()->back();
		}
    }

    public function dev_invoice_pdf($id)
    {  
        $count = DB::table('developer_order_tb')->where('order_id','=',$id)->count();
		if($count > 0)
		{
	        $shows = DB::table('developer_order_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get(); 
	        $details = DB::table('developer_payment_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get();
	        
	        $show = DB::table('developer_order_tb')
			->select('developer_details_tb.name','developer_details_tb.image','developer_order_tb.order_id','developer_order_tb.perhr','developer_order_tb.dev_id')
			->join('developer_details_tb', 'developer_details_tb.dev_id', '=', 'developer_order_tb.dev_id')
			->where('developer_order_tb.order_id', $id)
			->get();

	        view()->share('shows',$shows);

	        view()->share('show',$show);

	        view()->share('details',$details);

	        $pdf = PDF::loadView('dev_invoice_pdf');
            return $pdf->download('dev_invoice_pdf.pdf');
	    }
	    else
		{
			return redirect()->back();
		}
    }


     public function buynow_invoice_pdf($id)
    {  
        $count = DB::table('buynow_order_tb')->where('order_id','=',$id)->count();
        if($count > 0)
        {
            $shows = DB::table('buynow_order_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get(); 
            $details = DB::table('buynow_payment_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get();
            

            $show = DB::table('buynow_order_tb')
            ->select('web_hosting_tb.hostingname','web_hosting_tb.hostingprice','buynow_order_tb.order_id','buynow_order_tb.tprice','buynow_order_tb.p_id')
            ->join('web_hosting_tb', 'web_hosting_tb.id', '=', 'buynow_order_tb.p_id')
            ->where('buynow_order_tb.order_id', $id)
            ->get();

            view()->share('shows',$shows);

            view()->share('show',$show);

            view()->share('details',$details);

            $pdf = PDF::loadView('invoice');
            return $pdf->download('invoice.pdf');
        }
        else
        {
            return redirect()->back();
        }
    }
    public function send_message(Request $request)
    {
       
        $message=$request->post('message');           

       	$data = array('message'=>$message);
		$result=DB::table('message_tb')->insert($data);
       
        if($result==true) {
        	$shows = DB::table('message_tb')->where('order_id',$id)->groupBy('order_id')->orderby('id','desc')->get(); 	
        }else {
            session(['message' =>'danger', 'errmsg'=>'Message Not Send']); 
            return redirect()->back(); }
    } 

    public function forgetpassword()
    {  
    	$show['developer_order_details']=$this->developer_order_data();
    	$show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
		$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $show['web_details'] = DB::table('web_setting')->get();

        $show['cart_details'] = DB::table('cart_tb')
        ->select('product_tb.name','product_tb.image','product_tb.tax','product_tb.video','product_tb.price','product_tb.pro_size','product_tb.id','cart_tb.u_id','cart_tb.id','cart_tb.status')
        ->join('product_tb','product_tb.id', '=', 'cart_tb.p_id')
        ->whereNull('status')
        ->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count(); 
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

        return view('front/forgetpassword')->with($show);
    }

    public function sendforgetpassword(Request $request)
    {   

       $email = $request->post('email');

        $count = DB::table('user_login')->where('email','=',$email)->count();

       	if( $count > 0){

	        $u_details = DB::table('user_login')->where('email','=',$email)->get();
	        foreach($u_details as $ud) {
	        $u_email = $ud->email;
	        $fname = $ud->fname;
	        $show_password = $ud->show_password;
	        $url = route('index');
	        }
        	$datas=array(
        	'email'=>$u_email,
        	'fname'=>$fname,
        	'show_password'=>$show_password,
            'link'=>$url
        	);

        	Mail::send('forget_password_mail', $datas, function($message) use ($email)
        	{
	            $message->to($email)->subject('Forget Password Information From Mellow Element');
	            $message->from('dev@mellowelements.in', 'The Mellow Element');
	       });
        	session(['message' =>'success', 'errmsg'=>'Password send in your email']);
        	return redirect()->back(); 	
        }
	    else{
	    		session(['message' =>'danger', 'errmsg'=>'This Email Address Does Not Exist!']); 
	          	return redirect()->back();
	    }
    }

    public function submit_rating(Request $request)
    {   
    	$ip = request()->ip();
    	$p_id=Session::get('p_id');
        $rating=$request->post('rating');
        $date=date('y/m/d');

        $count=DB::table('rating_tb')->where('ip','=',$ip)->where('p_id','=',$p_id)->count();

        if($count == 0){
        	$data = array('p_id'=>$p_id,'rating'=>$rating,'ip'=>$ip,'date'=>$date);       

	        DB::table('rating_tb')->insert($data);
        }else {
        	$data = array('rating'=>$rating,'date'=>$date); 
			DB::table('rating_tb')->where('ip',$ip)->where('p_id',$p_id)->update($data);
    	}
    }

    public function free_consultation(Request $req)
    {
    	$show['pro'] = DB::table('product_tb')->selectRaw('c_id, count(id) as count_id')->groupBy('c_id')->get();
        $show['developer_order_details']=$this->developer_order_data();
        $show['allproduct'] = DB::table('product_tb')->orderby('id','desc')->limit(3)->get(); 
        $show['user_details'] = DB::table('user_login')->orderby('id','desc')->get(); 
        $show['about'] = DB::table('about_tb')->orderby('id','desc')->get(); 
    	$show['category'] = DB::table('category_tb')->orderby('id','desc')->get();
        $show['subcategorys'] = DB::table('subcategory_tb')->orderby('id','asc')->get();
        $show['banner'] = DB::table('banner_tb')->orderby('id','desc')->get();
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
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

	        request()->validate([
	            
	            'email' => 'required|email',
	            'subject' => 'required',
	            'service' => 'required',
	            'message' => 'required'
	        ]);     
	        $data = array(
	            'email'=>$req->post('email'),
	            'subject'=>$req->post('subject'),
	            'service'=>$req->post('service'),
	            'message'=>$req->post('message'),
	            'date'=>date('y/m/d')
	        );           
	        $result=DB::table('free_consultation_tb')->insert($data);

	        $email=$req->post('email');	
    	
	    	$details = DB::table('free_consultation_tb')->where('email',$email)->get();
	        $emails=array();
	        foreach ($details as $key) 
	        {
	            $emails[]= $key->email;
	            $subject = $key->subject;
	        }

	       $datas=array(
	            'subject'=>$subject
	        );
	        
	        if ($result==true) 
	        {
	            Mail::send('free_consultation_mail', $datas, function($message) use ($emails) {
	            $message->to($emails)->subject('Mellow Elements');
	            $message->from('dev@mellowelements.in', 'Mellow Elements');
	            });

	            session(['message' =>'success', 'freemsg' =>'Enquiry Submit Successfully. We Will Contact You Very Soon...']);
	            return redirect()->back(); 
	        }
	        else
	        {
	            session(['message' =>'danger', 'freemsg' =>'Enquiry Submit failed. Please Try Again....']);
	            return redirect()->back();
	        }          
    }


    public function add_work_space()
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

        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/add_work_space')->with($show);
    }

    public function cart()
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

        $show['higher_professional'] = DB::table('higher_professional_tb')->orderby('id','desc')->get();

        $u_id=Session::get('user_login_id'); 

        $show['cart_value'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['cart_empty'] = DB::table('cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_empty'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();
        $show['developer_cart_value'] = DB::table('developer_cart_tb')->where('status' ,'=', Null)->where('u_id' ,'=', $u_id )->count();

		return view('front/cart')->with($show);
    }
}