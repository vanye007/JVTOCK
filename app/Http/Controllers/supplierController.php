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

class supplierController extends Controller
{
  public function submit_supply(Request $request){

    $product_id = $request->input('product_id');
    $country_id = $request->input('countries');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $specifications = $request->input('specifications');
    $shipping_routes = $request->input('shipping_routes');
    $shipping_terms = $request->input('shipping_terms');
    $payment_terms = $request->input('payment_terms');
    $prices_per_capacity = $request->input('prices_per_capacity');
    $capacity_upgrades = $request->input('capacity_upgrades');
    $price = $request->input('price');

    $certificates = $request->file('certificates');
    $product_image = $request->file('product_image');

    $supply_capacity = $request->input('supply_capacity');
    $current_inventory = $request->input('current_inventory');
    $port_of_origin = $request ->input('port_of_origin');
    $units_per_box = $request->input('units_per_box');

    $proof_of_life = $request->file('proof_of_life');

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

    $supplier->save();


  }
}
