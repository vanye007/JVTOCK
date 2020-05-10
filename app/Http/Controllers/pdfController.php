<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product_info;
use App\product_certs;
use App\product_audit;
use App\units_per_package;
use App\packages_per_carton;
use App\product_price;



class pdfController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

   public function inventory(){
     $check = product_info::all();
     if ($check->isEmpty()) {
        return redirect()->back()->with('notification','No supplier inventory');
       // code...
     } else {
       $products = product_info::join('product_certs','product_infos.id',"=",'product_certs.product_infos_id')
                              ->leftjoin('product_audits','product_infos.id',"=",'product_audits.product_infos_id')
                              ->leftjoin('product_certs as certificates','product_infos.id',"=",'product_certs.product_infos_id')
                              ->leftjoin('product_prices','product_infos.id',"=",'product_prices.product_infos_id')
                              ->where('status','approved')
                              ->get();

        $pdf = \PDF::loadView('PDF',['products'=>$products]);
        return $pdf->download('inventory.pdf');
       // code...
     }


   }

}
