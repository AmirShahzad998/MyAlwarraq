<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin']);
    }

    // function __construct()
    // {
    //      $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboard.role.index', compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('dashboard.role.create', compact('permission'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'permission' => ['required']
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name'=> 'web'
        ]);
        $data['slug'] = Str::slug($request->name);
        $role->syncPermissions($request->permission);
        return redirect()->route('role.index')->with('status', 'A New Role has been created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions;

        return view('dashboard.role.show', compact('role', 'rolePermissions'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role )
    {

        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permission = Permission::get();
        return view('dashboard.role.edit', compact('role','permission', 'rolePermissions'));
        // $roles = $role;
        // $rolePermissions = $role->permissions->pluck('name')->toArray();
        // $permissions = Permission::get();
        // return view('role.edit', compact('roles', 'rolePermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // dd($request);
        $data = $request->validate([
            'name' => 'required',
            'permission' => 'required',

        ]);
        $data['slug'] = Str::slug($request->name);
        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));;
        return redirect()->route('role.index')->with('status', 'A Role has been update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('status', 'A Role has been removed');

    }
}
