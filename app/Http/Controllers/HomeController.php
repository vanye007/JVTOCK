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
                                ->leftjoin('product_certs','product_infos.id',"=",'product_certs.product_infos_id')
                                ->leftjoin('product_audits','product_infos.id',"=",'product_audits.product_infos_id')
                                ->leftjoin('packages_per_cartons','product_infos.id',"=",'packages_per_cartons.product_infos_id')
                                ->leftjoin('units_per_packages','product_infos.id','=','units_per_packages.product_infos_id')
                                ->join('product_prices','product_infos.id','=','product_prices.product_infos_id')
                                ->select('product_prices.sale_price','product_prices.id as sales_price_id','product_infos.*', 'product_infos.id as product_id','product_certs.*','product_audits.*','packages_per_cartons.*','units_per_packages.*','packages_per_cartons.length as plength', 'packages_per_cartons.width as pwidth','packages_per_cartons.height as pheight', 'packages_per_cartons.weight as pweight')
                                ->where('facility_infos.id',$facility_id)
                                ->get();

      $countries = countries::get();

      return view('supplier-info',['supplier_info'=>$supplier_info,'business_info'=>$business_info,'facility_info'=>$facility_info,'countries'=>$countries,'products'=>$products])->with('id',$id);
    }

    public function buyer_info($id){
      $buyer = buyer::join('countries','buyer.country_id',"=",'countries.id')
                    ->where('buyer.id',$id)
                    ->select('buyer.*','countries.country_name')
                    ->get();
      $inquiry = $this->inquiry();
      return view('buyer-info',['buyer'=>$buyer, 'inquiry'=>$inquiry]);
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
      $userId = $name = Auth::user()->id;
      $product_id = $id;

      $log = new audit_log();
      $log->user_id = $userId;
      $log->product_audit_id = $product_id;
      $log->save();

      product_audit::where('id',$id)->update(['status'=>'approved']);
      return redirect()->back()->with('notification','Product approved');

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


}
