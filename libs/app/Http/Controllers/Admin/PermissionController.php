<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * PermissionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:permissions-assign');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role           = Role::with('permissions')->findOrFail($id);
        $permissions    = Permission::all();
        $userPerms      = $role->permissions->pluck('id')->toArray() ?? [];
        return view('admin.permissions.edit', compact('role', 'permissions', 'userPerms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->input('permissions_id'));
        success('دسترسی‌های گروه کاربری با موفقیت آپدیت شدند.');
        return redirect()->route('admin.roles.index');
    }
}
