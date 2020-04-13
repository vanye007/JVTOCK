<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\product;
use App\supplier;
use App\countries;

class supplierController extends Controller
{

  public function supplier(){
    $countries = countries::get();
    $products = product::get();
    return view('supplier',['countries'=>$countries,'products'=>$products]);
  }

  public function submit_supply(Request $request){


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

    $supplier = new supplier();
    $supplier->product_id = $product_id;
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
        $certificates_destination = 'uploads/seller/certificates';
        $product_image_destination  = 'uploads/seller/product_image';
        $proof_of_life_destination = 'uploads/seller/proof_of_life';

        $certificates->move($certificates_destination, $new_certificate_name);
        $product_image->move($product_image_destination, $new_product_image_name);
        $proof_of_life->move($proof_of_life_destination, $new_proof_of_life_name);


      }
    }


  
}
