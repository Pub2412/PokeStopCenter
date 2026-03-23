<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display users datatable (MP2 - 5pts)
     */
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store user
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('user-images', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        User::create($validated);

        return redirect()->route('admin.users.index')->with(['success' => 'User created successfully!']);
    }

    /**
     * Show user details
     */
    public function show(User $user)
    {
        $user->load(['orders.items.product', 'reviews.product']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user (MP2 - 5pts - profile update with photo)
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('user-images', 'public');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with(['success' => 'User updated successfully!']);
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with(['success' => 'User deleted!']);
    }

    /**
     * Toggle user status (MP2 - 5pts)
     */
    public function toggleStatus(Request $request, User $user)
    {
        $newStatus = $user->status === 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);

        return back()->with(['success' => "User status changed to {$newStatus}!"]);
    }

    /**
     * Update user role (MP2 - 5pts)
     */
    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user->update($validated);

        return back()->with(['success' => 'User role updated!']);
    }
}
