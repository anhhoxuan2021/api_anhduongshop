<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CommonController;
use App\Models\User;

class BaseLoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $email = $request->input('email');
        $user = array();

        if (Auth::attempt($credentials)) {
            //$request->session()->regenerate();
            $isAd = Auth::user()->role;
//            if (Auth::check()){
//                print_r($isAd); die();
//            }

            $user = User::select('*')->where('email','=', $email)->
                get()->toArray();
            $token = Auth::user()->createToken("auth_token")->plainTextToken;
            $user[0]['token']= $token;

        }
        //print_r($user[0]); die();
        if(count($user) > 0) return response()->json($user[0]);
        else return response()->json($user);
        //
    }

    /************************************
     * Logout
     */
    public function logout(Request $request)
        {
            Auth::logout();

//            $request->session()->invalidate();
//
//            $request->session()->regenerateToken();
            return response()->json("1");
        }

    /******************
    Register
     **/
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'password_confirmation' => 'required|same:password',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'address' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        unset($data['password_confirmation']);

        $email =$data['email'];
        $isID = User::select('id')->where('email','=',$email)->get()->toArray();

        $id ='';
        if(count($isID) > 0) {
            return response()->json(array());
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        $token = Auth::user()->createToken("auth_token")->plainTextToken;
        $user->token = $token;
        return response()->json($user);
    }
/*************************************************/
}
