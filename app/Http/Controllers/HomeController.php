<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show Products
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $products = Product::select('products.*','product_types.prd_type_name',
             DB::raw('SUM(order_products.order_product_qty) AS amount_of_sold'))
            ->leftJoin('product_types','product_types.prd_type_id','=','products.prd_type')
            ->leftJoin('order_products','order_products.order_products_id','=','products.prd_id')
            ->groupBy('products.prd_id')
            ->groupBy('product_types.prd_type_name')
            ->paginate(100);
//        $products = DB::table('products')
//            ->join('product_types', 'product_types.prd_type_id', '=', 'products.prd_type')
//            ->orderBy('articles.created_at', 'desc')
//            ->select('product_types.prd_type_name')
//            ->paginate(15);
        //print_r($products);die();
        //return view('pduct.products',);compact('products');
        return view('home', ['products' => $products]);
        // return view('welcome');
    }
    /************************************
     * Is login
     */
    public function checkLogin(Request $request){
        if (Auth::check()) {
            return response()->json(['login' => '1'], 200);
        } else {
            return response()->json(['login' => ''], 200);
        }

    }

    /***************************/
    public function testOut(Request $request){
        // print_r("12444");
        return response()->json([
            'toi_tes' => '',
            'state' => '',
        ]);
        // return response()->json(['login' => '1'], 200);
    }
}
