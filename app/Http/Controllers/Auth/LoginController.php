<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /************************************
    * Logout
    */
    public function logout(Request $request): RedirectResponse
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        }
    /************************************************
     * Login
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $email = $request->input('email');
        $user = array();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::select('*')->where('email','=', $email)->
                get()->toArray();

            if(Auth::user()->role){
                $isadmin = $user[0]['role'];
                if($isadmin=='admin'){
                    return redirect()->intended('admin/products');
                }
            }
//            $check_forward = $request->input('check-forward');
//            if(isset($check_forward)){
//                if($check_forward==1){
//                    if(Auth::user()->role){
//                        $isadmin = $user[0]['role'];
//                        if($isadmin=='admin'){
//                            return redirect()->intended('admin/products');
//                    }
//                }
//            }

            return response()->json($user);
            //print_r(Auth::user()->role); die();
            /*
            */
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
