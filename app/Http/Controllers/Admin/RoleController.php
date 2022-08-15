<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest() -> get();
        $permissions = Permission::latest() -> get();
        return view('admin.pages.user.role.index', [
            'roles'          => $roles,
            'form_type'      => 'create',
            'permissions'    => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $this -> validate($request, [
            'name'  => 'required'
        ]);

        // data store
        Role::create([
            'name'          => $request -> name,
            'slug'          => Str::slug($request -> name),
            'permissions'   => json_encode($request -> permission),
        ]);

        // return back
        return back() -> with('success', 'role added successfully');
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
        $roles = Role::latest() -> get();
        $edit = Role::findOrFail($id);
        $permissions = Permission::latest() -> get();
        return view('admin.pages.user.role.index', [
            'roles'          => $roles,
            'form_type'      => 'edit',
            'permissions'    => $permissions,
            'edit'           => $edit,
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
        $update_data = Role::findOrFail($id);
        $update_data -> update([
            'name'          => $request -> name,
            'slug'          => Str::slug($request -> name),
            'permissions'   => json_encode($request -> permission),
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
        $delete_data = Role::findOrFail($id);
        $delete_data -> delete();
        return back() -> with('success-main', 'Deleted Successfully');
    }
}
