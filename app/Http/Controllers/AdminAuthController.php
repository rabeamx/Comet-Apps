<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * show login page
     */
    public function showLoginPage()
    {
        return view('admin.pages.login');
    }

    /**
     *  admin login system
     */
    public function login(Request $request)
    {
        $this -> validate($request, [
            'auth'      => 'required',
            'password'  => 'required',
        ]);

        // if try login
        if( Auth::guard('admin') -> attempt(['email' => $request -> auth, 'password' => $request -> password]) || Auth::guard('admin') -> attempt(['cell' => $request -> auth, 'password' => $request -> password]) || Auth::guard('admin') -> attempt(['username' => $request -> auth, 'password' => $request -> password]) ){

            if(Auth::guard('admin') -> user() -> status && Auth::guard('admin') -> user() -> trash == false){
                return redirect() -> route('admin.dashboard');
            } else{
                Auth::guard('admin') -> logout();
                return redirect() -> route('admin.login') -> with('danger', 'your account is blocked');
            }

        } else{

            return redirect() -> route('admin.login.page') -> with('warning', 'email or pass not match');

        }
    }

    /**
     *  admin logout system
     */
    public function logout()
    {
        Auth::guard('admin') -> logout();
        return redirect() -> route('admin.login.page');
    }
}
