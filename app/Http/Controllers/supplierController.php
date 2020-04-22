<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Session;
use App\product;
use App\supplier;
use App\countries;
use App\action_required;

class supplierController extends Controller
{

  public function action_required(){
    $action = new action_required();
    $action->type = 'supplier';
    $action->visited = 'no';
    $action->save();
  }

  public function supplier(){
    $countries = countries::get();
    $products = product::get();
    return view('supplier',['countries'=>$countries,'products'=>$products]);
  }

  public function submit_supply(Request $request){
    $the_message = 'This is to confirm that we have recieved your supply information. Our customer representative will get back to you shortly';

    $name = $request->input('name');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $country_id = $request->input('countries');
    $product_id = $request->input('product_id');
    $specifications = $request->input('specifications');
    $shipping_routes = $request->input('shipping_routes');
    $shipping_terms = $request->input('shipping_terms');
    $payment_terms = $request->input('payment_terms');
    $prices_per_capacity = $request->input('prices_per_capacity');
    $capacity_upgrades = $request->input('capacity_upgrades');
    $price = $request->input('price');

    $certificates = $request->file('certificates');
    $get_certificates_name = $certificates->getClientOriginalName();

    $product_image = $request->file('product_image');
    $get_product_image_name = $product_image->getClientOriginalName();

    $supply_capacity = $request->input('supply_capacity');
    $current_inventory = $request->input('current_inventory');
    $port_of_origin = $request ->input('port_of_origin');
    $units_per_box = $request->input('units_per_box');

    $proof_of_life = $request->file('proof_of_life');
    $get_proof_of_life_name = $proof_of_life->getClientOriginalName();

    $validate = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'specifications' => 'required',
      'shipping_routes' => 'required',
      'shipping_terms' => 'required',
      'payment_terms' => 'required',
      'prices_per_capacity' => 'required',
      'capacity_upgrades' => 'required',
      'price' => 'required',
      'certificates' => 'required|mimes:png,jpeg,pdf,doc,docx',
      'product_image' => 'required|mimes:png,jpeg,pdf,doc,docx',
      'supply_capacity' => 'required',
      'current_inventory' => 'required',
      'port_of_origin' => 'required',
      'units_per_box' => 'required',
      // 'proof_of_life' => 'required|mimes:pdf,mov,mp4,webm',
      'file' => 'max:40480',
    ]);

    if ($validate->fails())
    {
        return redirect()->back()->withErrors($validate->errors());
    }

    $supplier = new supplier();
    $supplier->product_id = $product_id;
    $supplier->name = $name;
    $supplier->country_id = $country_id;
    $supplier->email = $email;
    $supplier->phone = $phone;
    $supplier->specifications = $specifications;
    $supplier->shipping_routes = $shipping_routes;
    $supplier->shipping_terms = $shipping_terms;
    $supplier->payment_terms = $payment_terms;
    $supplier->prices_per_capacity = $prices_per_capacity;
    $supplier->capacity_upgrades = $capacity_upgrades;
    $supplier->price = $price;

    $supplier->certificates = $certificates;
    $supplier->product_image = $product_image;

    $supplier->supply_capacity = $supply_capacity;
    $supplier->current_inventory = $current_inventory;
    $supplier->port_of_origin = $port_of_origin;
    $supplier->units_per_box = $units_per_box;

    $supplier->proof_of_life = $proof_of_life;

    if ($supplier->save()) {
      //retrieve the buyers id
        $id =  $supplier->id;

        //Rename uploaded files with the user id
        $new_certificate_name = $id . '_' . $get_certificates_name;
        $new_product_image_name = $id . '_' . $get_product_image_name;
        $new_proof_of_life_name = $id . '_' . $get_proof_of_life_name;

        //Move renamed Uploaded files to new destination
        $certificates_destination = '/storage/app/uploads/supplier/certificates/';
        $product_image_destination  = 'images/supplier/product_image/';
        $proof_of_life_destination = '/storage/app/uploads/supplier/proof_of_life/';

        $certificates->move($certificates_destination, $new_certificate_name);
        $product_image->move($product_image_destination, $new_product_image_name);
        $proof_of_life->move($proof_of_life_destination, $new_proof_of_life_name);

        $this->action_required();
        supplier::where('id',$id)->update(['certificates' => $new_certificate_name, 'product_image'=>$new_product_image_name, 'proof_of_life'=>$new_proof_of_life_name]);

        $data = array('to_name'=>$name, 'the_message'=> $the_message, 'from_name'=>'Chris');
        Mail::send('layouts.mail.supplier_confirmation', $data, function($message) use ($name, $email){
          $from_name ='JVTOCK';
          $from_email = 'info@jvtock.com';
          $message->to($email, $name)
                  ->subject('JVTOCK Notification');
          $message->from($from_email,$from_name);
        });

        return view('external_broker.confirmation')->with('supplier',$the_message);
      }
    }



}
