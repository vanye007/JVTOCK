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

   private function get_referral_link($id){
     $id = $this->encrypt($id);
     $link = url('/supplier_form' .'/'.$id);
     return $link;
   }

   public function referral(Request $request,$id){
     $name = $request->input('name');
     $email = $request->input('email');
     $phone = $request->input('phone');
     $userId = Auth::user()->id;
     $from_name = Auth::user()->name;

     $referal_link = $this->get_referral_link($id);


     $pre_referral = new pre_referral();
     $pre_referral->user_id = $userId;
     $pre_referral->name = $name;
     $pre_referral->email = $email;
     $pre_referral->phone = $phone;
     $pre_referral->save();


     $data = array('to_name'=>$name, 'referral_link'=> $referal_link, 'from_name'=>$from_name);
     Mail::send('layouts.mail.referral', $data, function($message) use ($name, $email){
       $from_email = Auth::user()->email;
       $from_name = Auth::user()->name;
       $message->to($email, $name)
               ->subject('JVTOCK Supplier form');
       $message->from($from_email,$from_name);
     });

     return redirect()->back()->with('notification','Referral Mail Sent');

   }


}
