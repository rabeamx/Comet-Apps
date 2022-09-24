<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest() -> get();
        return view('admin.pages.user.permission.index', [
            'all_permission' => $permissions,
            'form_type'      => 'create', 
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
            'name'  => 'required|unique:permissions'
        ]);

        // data store
        Permission::create([
            'name'  => $request -> name,
            'slug'  => Str::slug($request -> name),
        ]);

        return back() -> with('success', 'permission added successfully');
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
        $permissions = Permission::latest() -> get();
        $per = Permission::findOrFail($id);
        return view('admin.pages.user.permission.index', [
            'all_permission' => $permissions,
            'form_type'      => 'edit',
            'edit'           => $per
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
        // data update
        $update_data = Permission::findOrFail($id);
        $update_data -> update([
            'name'  => $request -> name,
            'slug'  => Str::slug($request -> name),
        ]);
        return back() -> with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Permission::findOrFail($id);
        $delete -> delete();
        return back() -> with('danger-main', 'Permission deleted successfully');
    }
}
