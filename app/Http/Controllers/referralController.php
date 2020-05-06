<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\supplier;
use App\pre_referral;
use App\supplier_info;
use App\referral;


class referralController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

   private function encrypt($data){
     $encrypted = Crypt::encryptString($data);
     return $encrypted;
   }

   private function decrypt($data){
     $decrypt = Crypt::decryptString($data);
     return $decrypt;
   }

   private function get_referral_link($supplier_id){
     $supplier_id = $this->encrypt($supplier_id);
     $link = url('/supplier_business_info' .'/'.$supplier_id);
     return $link;
   }

   public function referral(Request $request,$id){
     $firstname = $request->input('firstname');
     $lastname = $request->input('lastname');
     $email = $request->input('email');
     $phone = $request->input('phone');

     $userId = Auth::user()->id;
     $from_name = Auth::user()->name;



     $supplier = new supplier_info();
     $supplier->firstname = $firstname;
     $supplier->lastname = $lastname;
     $supplier->email = $email;
     $supplier->phone = $phone;
     $supplier->save();

     $referral = new referral();
     $referral->user_id = $id;
     $referral->supplier_info_id = $supplier->id;
     $referral->save();

     $referal_link = $this->get_referral_link($supplier->id);

     $data = array('to_name'=>$firstname, 'referral_link'=> $referal_link, 'from_name'=>$from_name);
     Mail::send('layouts.mail.referral', $data, function($message) use ($firstname, $email){
       $from_email = Auth::user()->email;
       $from_name = Auth::user()->name;
       $message->to($email, $firstname)
               ->subject('JVTOCK Supplier form');
       $message->from($from_email,$from_name);
     });
     return redirect()->back()->with('notification','Referral Mail Sent');
   }


}
