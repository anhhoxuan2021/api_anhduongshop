<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\discount;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    /*
    * Get discount
    */
    public function getDiscount(Request $request)
    {
        //print_r($request->input('discount_code')); die();
        $text_search = $request->input('discount_code');
        $text_search = trim($text_search);

        $current_date = date('Y-m-d h:m');
        $discount = Discount::select('discount_type','discount_amount','discount_code',
            'app_total','start_date','end_date')->where('discount_code', '=', "{$text_search}")->where('start_date', '<=', "{$current_date}")
            ->where('end_date', '>=', "{$current_date}")
            ->where('active', '=', true)
            ->get();
        if(count($discount) > 0) $discount =$discount[0];
        else $discount =array('discount_type'=>'','discount_amount'=>0,'app_total'=>0,
            'start_date'=>'','end_date'=>'','discount_code'=>'');
        return response()->json($discount);
    }
}
