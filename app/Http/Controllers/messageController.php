<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\template;

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
}
