<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\buyer;
use App\supplier;
use App\countries;
use App\inquiry;
use App\product;
use App\template;

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
    private function retrieve_buyer(){
      $buyer = buyer::join('countries','buyer.country_id',"=", 'countries.id')
                    ->join('inquiry','buyer.id',"=",'inquiry.buyer_id')
                    ->join('product','inquiry.product_id',"=",'product.id')
                    ->select('buyer.*', 'product.type','countries.country_name')
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

        $name = Auth::user()->name;

        return view('home',['suppliers'=>$suppliers,'buyers'=>$buyers, 'products'=>$products, 'template'=>$template])->with('name',$name);
    }

    public function buyer_database(){
      $buyers = $this->retrieve_buyer();
      return view('buyer-database',['buyers'=>$buyers]);
    }

    public function edit_template(){
      $template = $this->get_template();
      $name = Auth::user()->name;
      $buyer = $this->retrieve_buyer();
      return view('edit-template', ['buyers'=>$buyer,'template'=> $template])->with('name',$name);
    }

    public function supplier_database(){
      $suppliers = $this->retrieve_supplier();
      return view('supplier-database',['suppliers'=>$suppliers]);
    }

    public function inventory(){
      $products = $this->all_products();
      return view('inventory',['products'=>$products]);
    }

    public function action_items(){
      return view('action-items');
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

}
