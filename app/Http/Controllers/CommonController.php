<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\User;



class CommonController extends Controller
{
    public function getField1(Request $request)
    {

        if($request->model){
           // $m = '\App'. '\\' .$request->model;
            $m = '\\App\\Models\\'.$request->model;
           // print_r($m); die();
            $value = $request->input('value');
            $primaryKey = $request->input('primaryKey');
            $valueOfField = $request->input('valueOfField');
            $rsl = $m::select('*')->where($primaryKey,'=',$value) //->toSql();
                ->get()->toArray();
            // print_r($rsl[0][$valueOfField]); die();
            if(count($rsl) > 0) return $rsl[0][$valueOfField];
            else return '';
         }

        else return 'not work';
        //
    }
    /*
     * getValueOfField
     */
    public function getValueOfField($model,$value,$primaryKey,$valueOfField)
    {
        // print_r($email); die();
        if($model !=''){
            $m = '\\App\\Models\\'.$model;
            $rsl = $m::select('*')->where($primaryKey,'=',$value)->get()->toArray();
            if(count($rsl) > 0) return $rsl[0][$valueOfField];
            else return '';
        }else{
          return '';
        }

    }
    /*
     * getRow
     */
    public function getRow($model,$value,$primaryKey)
    {
        // print_r($email); die();
        if($model !=''){
            $m = '\\App\\Models\\'.$model;
            $rsl = $m::select('*')->where($primaryKey,'=',$value)->get()->toArray();
            if(count($rsl) > 0) return $rsl[0];
            else return array();
        }else{
            return array();
        }

    }

    public function validatedEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(1);
        }
        $email = $request->input('email');
        $isID = User::select('id')->where('email','=',$email)->get()->toArray();
        if(count($isID) > 0) $id = $isID[0]['id'];
        else $id ='';
        return response()->json($id);
    }
    /*
     * checkEmail
     */

    public function checkEmail($email)
    {
       // print_r($email); die();
        $isID = User::select('id')->where('email','=',$email)->get()->toArray();
        if(count($isID) > 0) $id = $isID[0]['id'];
        else $id ='';
        return $id;
       // print_r($isID); die();
    }

    public function checkAnhCreateEmail($data)
    {
        // print_r($email); die();
        $email =$data['shipment_email'];
        $isID = User::select('id')->where('email','=',$email)->get()->toArray();

        $id ='';
        if(count($isID) > 0) $id = $isID[0]['id'];
        else {
           $user = User::create([
                'first_name' => $data['full_name'],
                //'last_name' => $data['last_name'],
                'email' => $data['shipment_email'],
                'address' => $data['shipment_address'],
                'password' => Hash::make('123'),
            ]);

            $id = $user->id;
        }
        return $id;
    }
}