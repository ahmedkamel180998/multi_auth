<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::latest()->get();
        $permissions = Permission::where('guard_name', 'admin')->get();

        return view('backend.roles', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', Rule::unique('roles', 'name')],
            'permissions' => ['nullable'],
        ]);
        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'admin']);
        if (isset($validated['permissions'])) {
            foreach ($validated['permissions'] as $permission => $value) {
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('backend.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions' => ['nullable'],
        ]);

        $role->update(['name' => $validated['name']]);

        // Sync permissions
        $role->syncPermissions([]);
        if (isset($validated['permissions'])) {
            foreach ($validated['permissions'] as $permission => $value) {
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('backend.roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        $role->syncPermissions([]);

        return redirect()->route('backend.roles.index')->with('success', 'Role deleted successfully.');
    }
}
