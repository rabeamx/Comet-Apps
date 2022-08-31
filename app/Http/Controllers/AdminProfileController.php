<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // show admin profile
    public function showAdminProfile()
    {
        return view('admin.pages.user.profile');
    }

    // show admin password
    public function showAdminPassword()
    {
        return view('admin.pages.user.password');
    }

    // change admin password
    public function changeAdminPassword(Request $request)
    {
        $this -> validate($request, [
            'old_pass'   => 'required',
            'pass'   => 'required',
        ]);

        // old pass check
        if( !password_verify($request -> old_pass, Auth::guard('admin') -> user() -> password) ){
            return back() -> with('danger', 'old pass not match');
        };

        // pass confirmation
        if( $request -> pass !== $request -> pass_confirmation ){
            return back() -> with('danger', 'pass not match');
        }

        $data = Admin::findOrFail(Auth::guard('admin') -> user() -> id);
        $data -> update([
            'password'  => Hash::make($request -> pass)
        ]);

        Auth::guard('admin') -> logout();
        return redirect() -> route('admin.login') -> with('success', 'password changed successfully');
    }

    // change admin profile
    public function changeAdminProfile(Request $request)
    {
        $data = Admin::findOrFail(Auth::guard('admin') -> user() -> id);
        $data -> update([
            'name'      => $request -> name,
            'cell'      => $request -> cell,
        ]);

        Auth::guard('admin') -> logout();
        return redirect() -> route('admin.login') -> with('success', 'profile changed successfully');
    }
}
