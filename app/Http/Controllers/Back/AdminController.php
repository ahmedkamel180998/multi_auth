<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = Admin::latest()->get();
        $roles = Role::where('guard_name', 'admin')->get();

        return view('backend.admins', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'role' => ['required', 'string', 'max:255', Rule::exists('roles', 'name')->where('guard_name', 'admin')],
            'password' => ['required', Password::defaults()],
        ]);

        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        if (isset($validated['role'])) {
            $admin->assignRole($validated['role']);
        }

        return redirect()->route('backend.admins.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,'.$admin->id],
            'role' => ['required', 'string', 'max:255', Rule::exists('roles', 'name')->where('guard_name', 'admin')],
            'password' => ['nullable', Password::defaults()],
        ]);

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (! empty($validated['password'])) {
            $admin->update(['password' => Hash::make($validated['password'])]);
        }

        // Sync role
        if (isset($validated['role'])) {
            $admin->syncRoles([$validated['role']]);
        }

        return redirect()->route('backend.admins.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin): RedirectResponse
    {
        // Remove all roles and permissions before deleting
        $admin->syncRoles([]);
        $admin->syncPermissions([]);

        $admin->delete();

        return redirect()->route('backend.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
