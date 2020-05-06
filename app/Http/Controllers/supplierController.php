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
use App\referral;
use App\supplier_info;
use App\business_info;
use App\facility_info;
use App\product_info;
use App\product_certs;
use App\product_audit;
use App\units_per_package;
use App\packages_per_carton;

class supplierController extends Controller
{

  public function action_required(){
    $action = new action_required();
    $action->type = 'supplier';
    $action->visited = 'no';
    $action->save();
  }

  public function message(){
    $message = 'This is to confirm that we have recieved your supply information. Our customer representative will get back to you shortly';
    return $message;
  }

  public function supplier($id = null){
    $countries = countries::get();
    $products = product::get();
    return view('external_broker.supplier_info',['countries'=>$countries,'products'=>$products])->with('referral_id',$id);
  }

  public function save_referral($id,$supplier_id){
    $referral = new referral();
    $id = Crypt::decryptString($id);
    $referral->user_id = $id;
    $referral->supplier_id = $supplier_id;
    $referral->save();
  }

  public function supplier_info(Request $request){
    $firstname = $request->input('firstname');
    $lastname = $request->input('lastname');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $countries = countries::get();

    $supplier =  new supplier_info();
    $supplier->firstname = $firstname;
    $supplier->lastname = $lastname;
    $supplier->email = $email;
    $supplier->phone = $phone;
    $supplier->save();

    $supplier_id_fk =  $supplier->id;
    $supplier_id_fk = Crypt::encryptString($supplier_id_fk);
    $request->session()->put('supplier_session', $supplier_id_fk);

    $the_message = $this->message();

    $data = array('to_name'=>$firstname, 'the_message'=> $the_message, 'from_name'=>'Chris');
    Mail::send('layouts.mail.supplier_confirmation', $data, function($message) use ($firstname, $email){
      $from_name ='JVTOCK';
      $from_email = 'info@jvtock.com';
      $message->to($email, $firstname)
              ->subject('JVTOCK Notification');
      $message->from($from_email,$from_name);
    });

    return view('external_broker.business_info',['countries'=>$countries])->with('supplier_info',$supplier_id_fk);
  }

  // this is for the referall form sent to the supplier
  public function get_business_info_page($id){
    $countries = countries::get();
    $supplier_id_fk = $id;
    return view('external_broker.business_info',['countries'=>$countries])->with('supplier_info',$supplier_id_fk);
  }

  public function submit_business_info(Request $request){
    $supplier_id_fk = $request->input('supplier_info');
    $supplier_id_fk = Crypt::decryptString($supplier_id_fk);
    $country = $request->input('country');
    $city = $request->input('city');
    $address = $request->input('address');
    $postcode = $request->input('postcode');
    $countries = countries::get();

    $facility_country = $request->input('facility_country');
    $facility_region = $request->input('region');
    $facility_city = $request->input('facility_city');
    $facility_address = $request->input('facility_address');
    $facility_postcode = $request->input('facility_postcode');
    $port_of_origin = $request->input('poo');
    $shipping_terms = $request->input('shipping_terms');
    $payment_terms = $request->input('payment_terms');

    $validate = Validator::make($request->all(), [
      'country' => 'required',
      'city' => 'required',
      'address' => 'required',
      'postcode' => 'required',
      'facility_country' => 'required',
      'region' => 'required',
      'facility_address' => 'required',
      'facility_postcode' => 'required',
      'poo' => 'required',
      'shipping_terms' => 'required',
      'payment_terms' => 'required',
    ]);

    if ($validate->fails())
    {
        return redirect()->back()->withErrors($validate->errors());
    }

    $business = new business_info();
    $business->supplier_infos_id = $supplier_id_fk;
    $business->country_id = $country;
    $business->city = $city;
    $business->address = $address;
    $business->postal_code = $postcode;
    $business->save();
    $business_id_fk =  $business->id;

    $facility = new facility_info();
    $facility->business_infos_id = $business_id_fk;
    $facility->country_id = $facility_country;
    $facility->region = $facility_region;
    $facility->city = $facility_city;
    $facility->address = $facility_address;
    $facility->postal_code = $facility_postcode;
    $facility->port_of_origin = $port_of_origin;
    $facility->shipping_terms = $shipping_terms;
    $facility->payment_terms = $payment_terms;
    $facility->save();

    $facility_id_fk =  $facility->id;
    $facility_id_fk = Crypt::encryptString($facility_id_fk);
    return view('external_broker.product_info')->with('facility_info',$facility_id_fk);
  }


  public function submit_product_info(Request $request){
    $facility_info_id = $request->input('facility_info');
    $facility_info_id = Crypt::decryptString($facility_info_id);
    $name = $request->input('name');
    $image = $request->file('image');
    $image_name = $image->getClientOriginalName();
    $description = $request->input('description');
    $price = $request->input('price');
    $volume = $request->input('volume');
    $inventory = $request->input('inventory');
    $capacity = $request->input('capacity');
    $audit_date = $request->input('date');
    $certificates = $request->file('certificates');
    $certs_name = $certificates->getClientOriginalName();

    $validate = Validator::make($request->all(), [
      'name' => 'required',
      'description' => 'required',
      'price' => 'required',
      'volume' => 'required',
      'capacity' => 'required',
      'date' => 'required',
      'image'=> 'required|mimes:png,jpeg,jpg',
      'certificates' => 'required|mimes:png,jpeg,pdf,doc,docx',
    ]);

    if ($validate->fails())
    {
        return redirect()->back()->withErrors($validate->errors());
    }


    $supplier_folder = $request->session()->get('supplier_session');
    $supplier_folder = Crypt::decryptString($supplier_folder);
    $destination = 'uploads/supplier/'.$supplier_folder;
    //store copy of image in publc folder
    $image->storeAs('public/images/'.$destination, $image_name);
    //store copy in private folder
    $image->storeAs($destination,$image_name);

    $certificates->storeAs($destination,$certs_name);
    $product = new product_info();
    $product->facility_infos_id = $facility_info_id;
    $product->name = $name;
    $product->image = $image_name;
    $product->description = $description;
    $product->price = $price;
    $product->volume = $volume;
    $product->inventory = $inventory;
    $product->capacity = $capacity;
    $product->save();

    $product_id_fk =  $product->id;
    $certificates = new product_certs();
    $certificates->product_infos_id = $product_id_fk;
    $certificates->certificates = $certs_name;
    $certificates->path = $certs_name;
    $certificates->save();

    $audit = new product_audit();
    $audit->product_infos_id = $product_id_fk;
    $audit->pol = 'null';
    $audit->summary = 'null';
    $audit->audit_date = $audit_date;
    $audit->status = 'pending';
    $audit->save();


    $product_id_fk = Crypt::encryptString($product_id_fk);

    return view('external_broker.package_info')->with('product_info_fk',$product_id_fk);
  }


 public function store_package_info(Request $request){
      $product_id = $request->input('product_info');
      $product_id = Crypt::decryptString($product_id);
      $length = $request->input('length');
      $width = $request->input('width');
      $height = $request->input('height');

      $carton_length = $request->input('carton_length');
      $carton_width = $request->input('carton_width');
      $carton_height = $request->input('carton_height');
      $carton_weight = $request->input('weight');

      $validate = Validator::make($request->all(), [
        'length' => 'required',
        'width' => 'required',
        'carton_length' => 'required',
        'carton_height' => 'required',
        'carton_width' => 'required',
        'weight' => 'required',
      ]);

      if ($validate->fails())
      {
          return redirect()->back()->withErrors($validate->errors());
      }

      $units_per_packages = new units_per_package();
      $units_per_packages->product_infos_id = $product_id;
      $units_per_packages->length = $length;
      $units_per_packages->width = $width;
      $units_per_packages->height = $height;
      $units_per_packages->save();

      $carton = new packages_per_carton();
      $carton->product_infos_id = $product_id;
      $carton->length = $carton_length;
      $carton->width = $carton_width;
      $carton->height = $carton_height;
      $carton->weight = $carton_weight;
      $carton->save();

      $the_message = $this->message();
      return view('external_broker.confirmation')->with('supplier',$the_message);
  }

}
