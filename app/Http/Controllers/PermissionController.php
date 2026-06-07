<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Show permission page
    public function index()
    {        
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(5);
        
        return view('permissions.list', compact('permissions'));
    }

    // Show create permission page
    public function create()
    {        
        return view('permissions.create');
    }

    // Do create permission action
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pgsql.auth.permissions,name|min:3|max:255',
        ]);

        // Create the permission
        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }
    
    // Show edit permission page
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    // Do update permission action
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:pgsql.auth.permissions,name,'.$permission->id.'|min:3|max:255',
        ]);

        // Update the permission
        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    // Do delete permission action
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
