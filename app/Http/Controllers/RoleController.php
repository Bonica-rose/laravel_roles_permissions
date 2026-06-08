<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    // Show role page
    public function index()
    {        
        $roles = Role::orderBy('name', 'asc')->paginate(6);
        
        return view('roles.list', compact('roles'));
    }

    // Show create role page
    public function create()
    {        
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('roles.create', compact('permissions'));
    }

    // Do create role action
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pgsql.auth.roles,name|min:3',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:pgsql.auth.permissions,id',
        ]);

        // Create the role
        $role = Role::create($request->only('name'));
        if(!empty($request->permissions)) {
            // $permissions = Permission::whereIn('id', $request->permissions)->get();
            // $role->syncPermissions($permissions);

            // Convert array of string IDs ["1", "2"] into true integers [1, 2]
            $integerIds = collect($request->permissions)->map(fn($id) => (int) $id)->all();
            $role->syncPermissions($integerIds);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
    
    // Show edit role page
    public function edit(Role $role)
    {
        $hasPermissions = $role->permissions()->pluck('name'); 
        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('roles.edit', compact('role', 'hasPermissions', 'permissions'));
    }

    // Do update role action
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('pgsql.auth.roles', 'name')->ignore($role->id),
            ],
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:pgsql.auth.permissions,id',
        ]);

        // Update the role name
        $role->update($request->only('name'));

        // Sync the role's permissions (Casting to integers to prevent the Spatie guard name error)
        $permissions = $request->has('permissions') 
            ? collect($request->permissions)->map(fn($id) => (int) $id)->all()
            : [];            
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Do delete role action
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }    
}
