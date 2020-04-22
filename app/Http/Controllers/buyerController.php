<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Session;
use App\buyer;
use App\product;
use App\inquiry;
use App\countries;
use App\action_required;

class buyerController extends Controller
{
  public function action_required(){
    $action = new action_required();
    $action->type = 'buyer';
    $action->visited = 'no';
    $action->save();

  }


  public function products(){
    $products = product::get();
    return $products;
  }

  public function index(){

    $products = $this->products();
    $countries = countries::get();

    //retrieve the session id
    $session_id = Session::getId();
    $encrypted_session = Crypt::encryptString($session_id);

    $buyer = buyer::where('session',$session_id)->first();

    //check if the the current session is already in the broker system
    if($buyer === null){
        // if session not available return redirect user to home
        return view('external_broker.index',['countries'=>$countries]);
    }else{
      // else redirect user back to inventory
        return view('external_broker.inventory',['products'=>$products,'countries'=>$countries])->with('session',$encrypted_session);
    }
  }



  public function buyer_request(Request $request){
    //Get all buyer forms
    $name = $request->input('name');
    $proof = $request->file('proof');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $country_id = $request->input('countries');
    $port = $request->input('delivery_port');
    $session_id = Session::getId();

    $validate = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'proof' => 'required|mimes:png,jpeg,pdf,doc,docx',
      'file' => 'max:20480',
    ]);

    if ($validate->fails())
    {
        return redirect()->back()->withErrors($validate->errors());
    }

    //Store buyer details in the database
    $buyer = new buyer();
    $buyer->name = $name;
    $buyer->session = $session_id;
    $buyer->country_id = $country_id;
    $buyer->email = $email;
    $buyer->phone = $phone;
    $buyer->proof = $proof;
    $buyer->delivery_port = $port;

    if ($buyer->save()) {
      //retrieve the buyers id
        $id =  $buyer->id;

        //Rename the buyer proof of funds file before uploading
        $file_name = $proof->getClientOriginalName();
        // $file_extension = $proof->getClientOriginalExtension();
        $new_file_name = $id . '_' . $file_name;

        //Move renamed Uploaded File to uploads/buyer/proof_of_funds
        $destinationPath = '../storage/app/uploads/buyer/proof_of_funds/';
        $proof->move($destinationPath,$new_file_name);

        Storage::disk('local')->put($new_file_name, 'Contents');

        //Update the file name in the database to the new file
        buyer::where('id',$id)->update(['proof' => $new_file_name]);

        //retrieve products from the products database
        $products = $this->products();
        $encrypted_session = Crypt::encryptString($session_id);

        $this->action_required();


        return view('external_broker.inventory', ['products'=>$products])->with('session',$encrypted_session);
      }
    }

  public function product_specs($id,$encrypted_session,$name){
    $product_name = $name;
    $encrypted_session = $encrypted_session;
    $specification = product::find($id)->Specifications;
    $image =  product::where('id',$id)->value('image_path');
    $product = product::where('id',$id)->get();

    return view('external_broker.product-page',['specification'=>$specification,'product'=>$product])->with('product_name',$product_name)->with('product_id',$id)->with('session',$encrypted_session)->with('image',$image);
  }

  public function inquiry($product_id,$encrypted_session){
    //retrieve the product id
    $product_id = $product_id;
    $buyer = 'Thank you! Confirmation of your order request for information has been placed. Our team will get back to you as soon as possible.';

    //decrypt the ecnvrypted session and find the correspending user id from the databse
    $decrypted_session = Crypt::decryptString($encrypted_session);
    $buyer_id = buyer::where('session',$decrypted_session)->value('id');

    //save the inquiry in the inquiry database
    $inquiry = new inquiry();
    $inquiry->buyer_id = $buyer_id;
    $inquiry->product_id = $product_id;

    if($inquiry->save()){
      return view('external_broker.confirmation')->with('buyer',$buyer);
    }



  }

  public function mail(){
    return view('layouts.mail.mail');
  }

  public function Welcome(){
    return view('external_broker.welcome');
  }
}
