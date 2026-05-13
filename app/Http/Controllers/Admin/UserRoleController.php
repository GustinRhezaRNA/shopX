<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Throwable;

class UserRoleController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:Role Management')
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = Admin::with('roles')->get();
        return view('admin.role-users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.role-users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);

        if ($request->role === 'Super Admin') {
            AlertService::error('You cannot assign Super Admin role');
            return redirect()->route('admin.role-users.index');
        }

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole($request->role);

        AlertService::created();
        return redirect()->route('admin.role-users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $user = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.role-users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Admin::findOrFail($id);
        if ($user->hasRole('Super Admin')) {
            AlertService::error('You cannot edit Super Admin user');
            return redirect()->route('admin.role-users.index');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);

        if ($request->role === 'Super Admin') {
            AlertService::error('You cannot assign Super Admin role');
            return redirect()->route('admin.role-users.index');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        AlertService::updated();
        return redirect()->route('admin.role-users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = Admin::findOrFail($id);
            if ($user->hasRole('Super Admin')) {
                return response()->json(['status' => 'error', 'message' => 'Cannot delete Super Admin'], 403);
            }
            $user->delete();

            AlertService::deleted();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully']);
        } catch (Throwable $th) {
            Log::error('Failed to delete user: ', ['error' => $th]);
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
