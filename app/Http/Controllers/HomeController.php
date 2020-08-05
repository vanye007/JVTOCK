<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\buyer;
use App\supplier;
use App\countries;
use App\inquiry;
use App\product;
use App\template;
use App\action_required;
use App\supplier_info;
use App\business_info;
use App\facility_info;
use App\product_info;
use App\product_certs;
use App\product_audit;
use App\units_per_package;
use App\packages_per_carton;
use App\audit_log;
use App\product_price;
use File;
use Response;
use App\supplier_docs;
use App\valid_upload_links;
use App\buyer_doc;
use App\User;

class HomeController extends Controller
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
    public function welcome(){
      return view('welcome');
    }
    private function retrieve_buyer(){
      $buyer = buyer::join('countries','buyer.country_id',"=", 'countries.id')
                    ->select('buyer.*','countries.country_name')
                    ->get();
      return $buyer;
    }

    private function retrieve_supplier(){
      $suppliers = supplier_info::join('business_infos','supplier_infos.id','=','business_infos.supplier_infos_id')
                                ->leftjoin('facility_infos','business_infos.id','=','facility_infos.business_infos_id')
                                ->leftjoin('product_infos','facility_infos.id','=','product_infos.facility_infos_id')
                                ->leftjoin('countries','facility_infos.country_id','=','countries.id')
                                ->leftjoin('product_certs','product_infos.id','=','product_certs.product_infos_id')
                                ->leftjoin('product_audits','product_infos.id','=','product_audits.product_infos_id')
                                ->select('supplier_infos.id as supplier_id','supplier_infos.firstname as firstname','supplier_infos.lastname as lastname','supplier_infos.email','business_infos.*','facility_infos.*','product_infos.*','countries.*','product_certs.*','product_audits.*')
                                ->get();
      return $suppliers;
    }

    private function all_products(){
      $products = product::where('deleted',0)->get();
      return $products;
    }

    private function inquiry(){
      $inquiry = inquiry::join('product','inquiry.product_id','=','product.id')
                        ->get();
      return $inquiry;
    }

    private function get_template(){
      $userId = Auth::id();
      $template = template::where('user_id',$userId)->get();
      return $template;

    }

    public function index()
    {
        $buyers = $this->retrieve_buyer();
        $suppliers = $this->retrieve_supplier();
        $products = $this->all_products();
        $template = $this->get_template();
        $buyer_actions = action_required::where('visited','no')->where('type','buyer')->get();
        $supplier_actions = action_required::where('visited','no')->where('type','supplier')->get();

        $inquiry = $this->inquiry();
        $name = Auth::user()->name;

        return view('home',['suppliers'=>$suppliers,'buyers'=>$buyers, 'products'=>$products, 'template'=>$template,'buyer_actions'=>$buyer_actions, 'supplier_actions'=>$supplier_actions,'inquiry'=>$inquiry])->with('name',$name);
    }

    public function buyer_database(){
      $buyers = $this->retrieve_buyer();
      $inquiry = $this->inquiry();
      action_required::where('type','buyer')->update(['visited' => 'yes']);
      return view('buyer-database',['buyers'=>$buyers,'inquiry'=>$inquiry]);
    }

    public function edit_template(){
      $template = $this->get_template();
      $name = Auth::user()->name;
      $buyer = $this->retrieve_buyer();
      return view('edit-template', ['buyers'=>$buyer,'template'=> $template])->with('name',$name);
    }

    public function supplier_database(){
      $suppliers = $this->retrieve_supplier();
      action_required::where('type','supplier')->update(['visited' => 'yes']);
      return view('supplier-database',['suppliers'=>$suppliers]);
    }

    public function inventory(){
      $products = $this->all_products();
      return view('inventory',['products'=>$products]);
    }

    public function action_items(){
      $buyer_actions = action_required::where('visited','no')->where('type','buyer')->get();
      $supplier_actions = action_required::where('visited','no')->where('type','supplier')->get();
      return view('action-items',['buyer_actions'=>$buyer_actions,'supplier_actions'=>$supplier_actions]);
    }

    public function supplier_info($id){
      $supplier_info = supplier_info::find($id);
      $business_info = supplier_info::find($id)->business_info;
      $facility_info = supplier_info::find($id)->facility_info;
      $facility_id = supplier_info::find($id)->facility_info->pluck('id');
      $products = facility_info::join('product_infos','facility_infos.id',"=",'product_infos.facility_infos_id')
                                // ->leftjoin('product_certs','product_infos.id',"=",'product_certs.product_infos_id')
                                ->leftjoin('product_audits','product_infos.id',"=",'product_audits.product_infos_id')
                                ->leftjoin('packages_per_cartons','product_infos.id',"=",'packages_per_cartons.product_infos_id')
                                ->leftjoin('units_per_packages','product_infos.id','=','units_per_packages.product_infos_id')
                                ->leftjoin('product_prices','product_infos.id','=','product_prices.product_infos_id')
                                ->select('product_prices.sale_price','product_prices.id as sales_price_id','product_infos.*', 'product_infos.id as product_id','product_audits.*','packages_per_cartons.*','units_per_packages.*','packages_per_cartons.length as plength', 'packages_per_cartons.width as pwidth','packages_per_cartons.height as pheight', 'packages_per_cartons.weight as pweight')
                                ->where('facility_infos.id',$facility_id)
                                ->get();
      $docs =  supplier_docs::where('supplier_infos_id',$id)->get();
      $countries = countries::get();

      $certificates =  product_certs::get();



      return view('supplier-info',['supplier_info'=>$supplier_info,'business_info'=>$business_info,'facility_info'=>$facility_info,'countries'=>$countries,'products'=>$products,'docs'=>$docs, 'certificates'=>$certificates])->with('id',$id);
    }

    public function buyer_info($id){
      $buyer = buyer::join('countries','buyer.country_id',"=",'countries.id')
                    ->where('buyer.id',$id)
                    ->select('buyer.*','countries.country_name')
                    ->get();
      $inquiry = $this->inquiry();
      $docs = buyer_doc::where('buyer_id',$id)->get();

      return view('buyer-info',['buyer'=>$buyer, 'inquiry'=>$inquiry,'docs'=>$docs])->with('id',$id);
    }

    public function retrieve_product($id){
      $product = product::where('id',$id)->get();
      return view('product-page',['product'=>$product]);
    }

    public function update_product($id){
      $type = request('type');
      $description = request('description');
      $price = request('price');

      product::where('id',$id)->update(['type' => $type,'description'=>$description, 'price'=>$price]);

      return redirect()->back()->with('notification','Product updated');
    }

    public function upload_product(Request $request){
      // dd($request->all());
      $type = $request->input('type');
      $description = $request->input('description');
      $price = $request->input('price');
      $image = $request->file('image');

      $validate = Validator::make($request->all(), [
        'type' => 'required',
        'description' => 'required',
        'price' => 'required',
        'file' => 'max:20480',
      ]);

      if ($validate->fails())
      {
          return redirect()->back()->withErrors($validate->errors());
      }

      $image_name = $image->getClientOriginalName();
      // $file_extension = $proof->getClientOriginalExtension();
      // $new_image_name = $type . '_' . $image_name;

      $destinationPath = 'images/products';
      $image->move($destinationPath, $image_name);

      $product = new product();
      $product->type = $type;
      $product->description = $description;
      $product->price = $price;
      $product->image_path = $image_name;
      $product->deleted = 0;
      $product->save();

      return redirect()->back()->with('notification','New product added');
    }


    public function get_message_template($type, $email = null){
      $name = Auth::user()->name;
      $id = Auth::user()->id;
      $template = template::where('user_id',$id)->where('type',$type)->get();
      return view('message',['template'=>$template])->with('type',$type)->with('name',$name)->with('email',$email);
    }

    public function approve_product($id){
      // $userId = $name = Auth::user()->id;
      // $product_id = $id;
      //
      // $log = new audit_log();
      // $log->user_id = $userId;
      // $log->product_audit_id = $product_id;
      // $log->save();

      product_audit::where('id',$id)->update(['status'=>'approved']);
      return redirect()->back()->with('notification','Product approved');

    }

  public function reject_product($id){
    product_audit::where('id',$id)->update(['status'=>'pending']);
    return redirect()->back()->with('notification','Product rejected');

  }

    public function delete_product($id){
      product::where('id',$id)->update(['deleted'=>1]);
      return redirect()->back()->with('notification','Product deleted');
    }

    public function update_selling_price(Request $request){
      $id = $request->input('sales_id');
      $price = $request->input('sale_price');

      product_price::where('id',$id)->update(['sale_price'=>$price]);
      return redirect()->back()->with('notification','Sales price updated');
    }

    public function displayImage($id,$filename){
        $path = storage_path('app/uploads/supplier/' .$id .'/'. $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }

  public function approve_buyer($id){
    buyer::where('id',$id)->update(['approved'=>'yes']);
    return redirect()->back()->with('notification','Buyer approved');
  }

  public function reject_buyer($id){
    buyer::where('id',$id)->update(['approved'=>'no']);
    return redirect()->back()->with('notification','Buyer declined');
  }


  public function display_template($type){
    $name = Auth::user()->name;
    $id = Auth::user()->id;
    // $template = template::leftjoin('template_msg','template.id','=','template_msg.template_id')
    //                     ->where('template.user_id',$id)
    //                     ->where('template.type',$type)
    //                     ->get();

    $suppliers = supplier_info::join('business_infos','supplier_infos_id','=','business_infos.supplier_infos_id')
                                ->join('countries','business_infos.country_id','=','countries.id')
                                ->get();

    return view('template.'.$type,['suppliers'=>$suppliers])->with('type',$type)->with('name',$name);
  }


  public function upload_doc(Request $request, $type = null){
    $id = $request->input('id');
    $doc_name = $request->input('type');
    $file = $request->file('document');
    $file_name = $file->getClientOriginalName();


    if ($type == 'supplier') {
      $supplier_doc = new supplier_docs();
      $supplier_doc->supplier_infos_id = $id;
      $supplier_doc->name = $doc_name;
      $supplier_doc->path = $file_name;
      $supplier_doc->save();

      $destination = 'uploads/supplier/'.$id;

      $file->storeAs($destination,$file_name);

      if ($supplier_doc) {
        return redirect()->back()->with('notification','Document uploaded');
      }
    }else {
      $buyer_doc = new buyer_doc();
      $buyer_doc->buyer_id = $id;
      $buyer_doc->name = $doc_name;
      $buyer_doc->path = $file_name;
      $buyer_doc->save();

      $destination = 'uploads/buyer/'.$id;

      $file->storeAs($destination,$file_name);
      if ($buyer_doc) {
        return redirect()->back()->with('notification','Document uploaded');
      }
    }

  }

public function users(){
  $users = User::get();
  return view('users',['users'=>$users]);
}

public function approve_user($id){
  User::where('id',$id)->update(['approve' => 'yes']);
  return redirect()->back()->with('notification','User approved');
}

public function revoke_user($id){
  User::where('id',$id)->update(['approve' => 'no']);
  return redirect()->back()->with('notification','User revoked');
}

public function mndnc_custom_email($who,$email,$id){
  $name = '';
  $address = '';
  if ($who == 'supplier') {
      $name = supplier_info::where('id',$id)->value('firstname');
      $address = business_info::where('supplier_infos_id',$id)->value('address');
  }

  if ($who == 'buyer') {
      $name = buyer::where('id',$id)->value('name');
      $address = buyer::where('id',$id)->value('address');
  }
  return view ('template.mndnc')->with('to_email',$email)->with('name',$name)->with('address',$address);
}

public function upload_product_file(Request $request){
  $id = $request->input('id');
  $product_id = $request->input('product_id');
  $file = $request->file('document');
  $file_name = $request->input('name');
  $path = $file_name. '.'. $file->getClientOriginalExtension();

  $destination = 'uploads/supplier/'.$id;

  $certificate = new product_certs();
  $certificate->product_infos_id = $id;
  $certificate->certificates = $file_name;
  $certificate->path = $path;
  $certificate->save();

  $file->storeAs($destination,$path);

  return redirect()->back()->with('notification','product certificate uploaded');

}

public function edit_product($id){
  $product = product_info::leftjoin('units_per_packages','product_infos.id','=','units_per_packages.product_infos_id')
                         ->leftjoin('packages_per_cartons','product_infos.id','=','packages_per_cartons.product_infos_id')
                         ->select('product_infos.*','units_per_packages.length as u_length','units_per_packages.width as u_width','units_per_packages.height as u_height','packages_per_cartons.length as p_length','packages_per_cartons.width as p_width','packages_per_cartons.height as p_height','packages_per_cartons.weight as p_weight')
                         ->where('product_infos.id',$id)
                         ->get();

  return view('edit_product',['product'=>$product]);
}

public function update_supplier_product(Request $request){
  $id = $request->input('product_id');

  //product info
  $name = $request->input('name');
  $description = $request->input('description');
  $volume = $request->input('volume');
  $inventory = $request->input('inventory');
  $capacity = $request->input('capacity');

  product_info::where('id',$id)->update(['name' => $name,'description'=>$description,'volume'=>$volume,'inventory'=>$inventory,'capacity'=>$capacity]);

  //unite per packages
  $u_length = $request->input('u_length');
  $u_width = $request->input('u_width');
  $u_height = $request->input('u_height');
  $units = units_per_package::where('product_infos_id',$id)->exists();
  if ($units) {
    units_per_package::where('product_infos_id',$id)->update(['length' => $u_length,'width'=>$u_width,'height'=>$u_height]);
  } else {
    $units = new units_per_package();
    $units->product_infos_id = $id;
    $units->length = $u_length;
    $units->Width = $u_width;
    $units->height = $u_height;
    $units->save();
  }

  //packages per carton
  $package = packages_per_carton::where('product_infos_id',$id)->exists();
  $p_length = $request->input('p_length');
  $p_height = $request->input('p_height');
  $p_width = $request->input('p_width');
  $p_weight = $request->input('p_weight');
  if ($package) {
    packages_per_carton::where('product_infos_id',$id)->update(['length' => $p_length,'width'=>$p_width,'height'=>$p_height]);
  } else {
    $package = new packages_per_carton();
    $package->product_infos_id = $id;
    $package->length = $p_length;
    $package->Width = $p_width;
    $package->height = $p_height;
    $package->weight = $p_weight;
    $package->save();
  }

  return redirect()->back()->with('notification','Product info updated');

  }

  public function edit_supplier_info($id){
    $supplier_info = supplier_info::leftjoin('business_infos','supplier_infos.id','=','business_infos.supplier_infos_id')
                                  ->leftjoin('facility_infos','supplier_infos.id','=','facility_infos.business_infos_id')
                                  ->select('supplier_infos.*','business_infos.country_id as b_country','business_infos.city as b_city','business_infos.address as b_address','business_infos.postal_code as b_postcode','facility_infos.country_id as f_country','facility_infos.city as f_city','facility_infos.address as f_address','facility_infos.postal_code as f_postcode')
                                  ->where('supplier_infos.id',$id)
                                  ->get();

    return view('edit_supplier_info',['supplier_info'=>$supplier_info]);

  }

  public function update_supplier_info(Request $request){
    $id = $request->input('supplier_id');

    // supplier info db
    $firstname = $request->input('firstname');
    $lastname = $request->input('lastname');
    $email = $request->input('email');
    $phone = $request->input('phone');

    supplier_info::where('id',$id)->update(['firstname' => $firstname,'lastname'=>$lastname,'email'=>$email,'phone'=>$phone]);

    // business_info db
    $b_city = $request->input('b_city');
    $b_address = $request->input('b_address');
    $b_postcode = $request->input('b_postcode');

    $business_info = business_info::where('supplier_infos_id',$id)->exists();
    $business_info_id = '';

    if ($business_info) {
      business_info::where('supplier_infos_id',$id)->update(['city' => $b_city,'address'=>$b_address,'postal_code'=>$b_postcode]);
      $business_info_id = business_info::where('supplier_infos_id',$id)->value('id');
    } else {
      $business_info = new business_info();
      $business_info->supplier_infos_id = $id;
      $business_info->city = $b_city;
      $business_info->address = $b_address;
      $business_info->postal_code = $b_postcode;
      $business_info->save();

      $business_info_id = $business_info->id;
    }

    // facility_info db
    $f_city = $request->input('f_city');
    $f_address = $request->input('f_address');
    $f_postcode = $request->input('f_postcode');

    $facility_info = facility_info::where('business_infos_id',$business_info_id)->exists();

    if ($facility_info) {
        facility_info::where('business_infos_id',$business_info_id)->update(['city' => $f_city,'address'=>$f_address,'postal_code'=>$f_postcode]);
    } else {
      $facility_info = new facility_infos();
      $facility_info->business_infos_id = $business_info_id;
      $facility_info->city = $f_city;
      $facility_info->address = $f_address;
      $facility_info->postal_code = $f_postcode;
      $facility_info->save();
    }

    return redirect()->back()->with('notification','Supplier info updated');

  }


}
