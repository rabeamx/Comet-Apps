<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AdminAccountInfoNotification;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()    
    {
        $all_admin = Admin::latest() -> where('trash', false) -> get();
        $roles = Role::latest() -> get();
        return view('admin.pages.user.index', [
            'all_admin'  => $all_admin,
            'roles'      => $roles,
            'form_type'  => 'create',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashUsers()
    {
        $all_admin = Admin::latest() -> where('trash', true) -> get();
        return view('admin.pages.user.trash', [
            'all_admin'  => $all_admin,
            'form_type'  => 'trash',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:admins'],
            'cell'     => ['required', 'unique:admins'],
            'username' => ['required', 'unique:admins'],
            'role'     => ['required'],
        ]);

        $pass_string = str_shuffle('asdfghjkl;qwertyuiopzxcvbnm,./!@3$%%6&&8*90_0+_23456789');
        $pass = substr($pass_string, 10, 5);

        $user = Admin::create([
            'name'      => $request -> name,
            'email'     => $request -> email,
            'cell'      => $request -> cell,
            'username'  => $request -> username,
            'password'  => Hash::make($pass),
            'role_id'   => $request -> role,
        ]);

        $user -> notify( new AdminAccountInfoNotification( [$user['name'], $pass] ) );

        return back() -> with('success-main', 'Admin user added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $all_admin = Admin::latest() -> where('trash', false) -> get();
        $admin_user = Admin::findOrFail($id);
        return view('admin.pages.user.index', [
            'all_admin'  => $all_admin,
            'edit'  => $admin_user,
            'form_type' => 'edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin_user = Admin::findOrFail($id);
        $admin_user -> update([
            'name'      => $request -> name,
            'email'     => $request -> email,
            'cell'      => $request -> cell,
            'username'  => $request -> username
        ]);
        return back() -> with('success-main', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Admin::findOrFail($id);
        $delete_data -> delete();
        return back() -> with('success-main', 'User Deleted Successfully');
    }

    /**
     *  status update
     *
     * @return void
     */
    public function updateStatus($id)
    {
        $data = Admin::findOrFail($id);
        if($data -> status){
            $data -> update([
                'status' => false,
            ]);
        } else{
            $data -> update([
                'status' => true,
            ]);
        }

        return back() -> with('success-main', 'status updated successfully');

    }

    /**
     *  trash update
     *
     * @return void
     */
    public function updateTrash($id)
    {
        $data = Admin::findOrFail($id);
        if($data -> trash){
            $data -> update([
                'trash' => false,
            ]);
        } else{
            $data -> update([
                'trash' => true,
            ]);
        }

        return back() -> with('success-main', 'status updated successfully');

    }
}
