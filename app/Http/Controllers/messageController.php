<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\template;
use Illuminate\Support\Facades\Crypt;
use App\supplier_info;
use App\template_msg;
use App\loi_log;
use App\valid_upload_link;
use App\log_mndnc;
class messageController extends Controller
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


    public function send_message(Request $request){
      $to_name = 'vanye';
      $to_email = $request->input('email');
      // $subject = 'JVTOCK';
      $the_message = $request->input('message');
      // $from_email = 'wvanye@gmail.com';
      $from_name = Auth::user()->email;

      $userId = Auth::id();
      $message = template::where('user_id',$userId)->first();
      if ($message === null) {
         $message = new template();
         $message->user_id = $userId;
         $message->message = $the_message;
         $message->save();
      }else{
        template::where('user_id',$userId)->update(['message' => $the_message]);
      }

      //the current user email
      $data = array('to_name'=>$to_name, 'the_message'=> $the_message, 'from_name'=>$from_name);
      Mail::send('layouts.mail.mail', $data, function($message) use ($to_name, $to_email){
        $from_email = 'wvanye@gmail.com';
        $from_name = 'vanye';
        $message->to($to_email, $to_name)
                ->subject('JVTOCK');
        $message->from($from_email,$from_name);
      });
      return redirect()->back()->with('notification','Mail Sent');
    }

    // admin send message to clients
    public function message(Request $request, $type){
      $from_name = Auth::user()->name;
      $userId = Auth::id();
      $to_name = 'vanye';
      $to_email = $request->input('email');
      $the_message = '';
      $subject = $request->input('subject');

      if ($type == 'message') {
        $the_message = $request->input('message');
      }

      if ($type == 'contract') {
        $the_message = $request->input('contract');
      }

      if ($type == 'loi') {
        $the_message = $request->input('loi');
      }

      if ($type == 'custom') {
        $the_message = $request->input('custom');
      }

      if ($type == 'pol') {
        $the_message = $request->input('pol');
      }

      if ($type == 'pof') {
        $the_message = $request->input('pof');
      }

      $message = template::where('user_id',$userId)->where('type',$type)->first();

      if ($message === null) {
         $message = new template();
         $message->user_id = $userId;
         $message->type = $type;
         $message->message = $the_message;
         $message->save();
      }else{
        template::where('user_id',$userId)->where('type',$type)->update(['message' => $the_message]);
      }

      $data = array('to_name'=>$to_name, 'the_message'=> $the_message, 'from_name'=>$from_name);
      Mail::send('layouts.mail.mail', $data, function($message) use ($to_name, $to_email, $subject){
        $from_name = Auth::user()->name;
        $from_email = Auth::user()->email;
        $message->to($to_email, $to_name)
                ->subject($subject);
        $message->from($from_email,$from_name);
      });
      return redirect()->back()->with('notification','Mail Sent');
    }

    public function log_loi($user_id,$supplier_id,$transaction_details,$purchase_price){
      $loi_audit = new loi_log();
      $loi_audit->user_id = $user_id;
      $loi_audit->supplier_infos_id = $supplier_id;

      if ($transaction_details == null) {
        $loi_audit->header = 'null';
      }else{
        $loi_audit->transaction_details = $transaction_details;
      }

      if ($purchase_price == null) {
          $loi_audit->purchase_price = 'null';
      } else {
          $loi_audit->purchase_price = $purchase_price;
      }
      $loi_audit->save();
    }

    public function valid_link($id,$name){
      $valid_link = new valid_upload_link();
      $valid_link->supplier_infos_id = $id;
      $valid_link->name = $name;
      $valid_link->uploaded = 'no';
      $valid_link->save();
    }

    public function loi_message(Request $request){
      //retrieve the current admin details

      $userId = Auth::id();
      //retrieve the supplier details (inputed from the admin)
      $to_name = 'Supplier';
      $subject = 'LOI (Letter Of Intent)';

      $date_a = $request->input('date_a');
      $buyer_info = $request->input('buyer_info');
      $to_email = $request->input('supplier_mail');
      $supplier_info = $request->input('supplier_info');
      $transaction_details = $request->input('transaction_details');
      $purchase_price = $request->input('purchase_price');
      $from_name = $request->input('admin_name');
      $date_b = $request->input('date_b');
      $date_c = $request->input('date_c');

      $to_id = supplier_info::where('email',$to_email)->value('id');


      $message = template::where('user_id',$userId)->where('type','loi')->first();
      $template_id = '';

      //retrive the loi template blade from PDF folder and convert to PDF
      $pdf = \PDF::loadView('PDF.loi',['date_a'=>$date_a,'buyer_info'=>$buyer_info, 'supplier_info'=>$supplier_info, 'transaction_details'=>$transaction_details,'purchase_price'=>$purchase_price,'admin_name'=>$from_name,'date_b'=>$date_b,'date_c'=>$date_c]);


      $this->log_loi($userId,$to_id,$transaction_details,$purchase_price);

      $this->valid_link($to_id,'loi');

      //encrypt supplier id (will be sent to supplier for uploading documents)
      $to_id = Crypt::encryptString($to_id);
      $upload_link = 'http://127.0.0.1:8000/upload/supplier/loi/'.$to_id;


      $data = array('to_name'=>$to_name, 'upload_link'=> $upload_link, 'from_name'=>$from_name);
      Mail::send('layouts.mail.mail', $data, function($message) use ($to_name, $to_email, $subject,$pdf){
        $from_name = Auth::user()->name;
        $from_email = Auth::user()->email;
        $message->to($to_email, $to_name)
                ->subject($subject)
                 ->attachData($pdf->output(), "loi.pdf");
        $message->from($from_email,$from_name);
      });
      return redirect()->back()->with('notification','LOI Mail Sent');
    }

    public function log_mndnc($id,$email){
      $log = new log_mndnc();
      $log->user_id = $id;
      $log->sent_to = $email;
      $log->save();

    }

    public function mndnc_message(Request $request){
      $userId = Auth::id();
      $date_a = $request->input('date_a');
      $date_b = $request->input('date_b');
      $date_c = $request->input('date_c');
      $name = $request->input('client_name');
      $address = $request->input('address');
      $admin_name = $request->input('admin_name');
      $client_info = $request->input('client_info');
      $email = $request->input('email');
      $subject  = 'Mutual Non-Disclosure Non-Circumvent Agreement';
      $message = 'Attached is a copy of Mutual Non-Disclosure Non-Circumvent Agreement. You are required to download and fill the form before uploading and sending back to any of customer representative';

      $pdf = \PDF::loadView('PDF.mndnc',['date_a'=>$date_a,'date_b'=>$date_b,'date_c',$date_c,'name'=>$name,'address'=>$address,'admin_name'=>$admin_name,'client_info'=>$client_info,'email',$email]);
      $this->log_mndnc($userId,$email);

      $data = array('to_name'=>$name, 'the_message'=>$message, 'from_name'=>$admin_name);
      Mail::send('layouts.mail.mail', $data, function($message) use ($name, $email, $subject,$pdf){
        $from_name = Auth::user()->name;
        $from_email = Auth::user()->email;
        $message->to($email, $name)
                ->subject($subject)
                 ->attachData($pdf->output(), "mndnc.pdf");
        $message->from($from_email,$from_name);
      });
      return redirect()->back()->with('notification','MNDNC Mail Sent');


    }

}
