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
      $supplier = supplier::join('countries','supplier.country_id',"=",'countries.id')
                          ->join('product','supplier.product_id',"=",'product.id')
                          ->select('supplier.*', 'product.type','countries.country_name')
                          ->get();
      return $supplier;
    }

    private function all_products(){
      $products = product::get();
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
      $supplier = supplier::join('countries','supplier.country_id',"=",'countries.id')
                          ->join('product','supplier.product_id',"=",'product.id')
                          ->where('supplier.id',$id)
                          ->get();
      $image_name = supplier::where('id',$id)->value('product_image');

      // $image = Storage::disk('public')->get('uploads/seller/product_image/2_b6-min.jpg');


      return view('supplier-info',['supplier'=>$supplier])->with('image',$image_name);
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

      return redirect()->back()->with('successMsg','Product updated');
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
      $product->save();

      return redirect()->back()->with('successMsg','Product updated');
    }


    public function get_message_template($type){
      $name = Auth::user()->name;
      $id = Auth::user()->id;
      $template = template::where('user_id',$id)->where('type',$type)->get();
      return view('message',['template'=>$template])->with('type',$type)->with('name',$name);
    }


}
