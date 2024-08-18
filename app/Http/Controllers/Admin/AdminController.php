<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Ensure the user is a superadmin
        if (Auth::user()->user_type != 'superadmin') {
        return redirect('/dashboard')->with('error_message', 'Unauthorized access.');
        }

        $admins = User::where('user_type', 'admin')->get();
        return view('admin.admin.admin', compact('admins'));
    }

    public function addAdmin(Request $request)
    {
        // Ensure the user is a superadmin
        if (Auth::user()->user_type != 'superadmin') {
            return redirect('/dashboard')->with('error_message', 'Unauthorized access.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the admin user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'admin',
        ]);

        return redirect('admin/admins')->with('success_message', 'Admin created successfully!');
    }

    public function destroy($id)
{
    // Ensure the user is a superadmin
    if (Auth::user()->user_type != 'superadmin') {
        return redirect('/dashboard')->with('error_message', 'Unauthorized access.');
    }

    // Find the admin user by ID
    $admin = User::findOrFail($id);

    // Check if the user is indeed an admin
    if ($admin->user_type != 'admin') {
        return redirect('/dashboard')->with('error_message', 'Cannot delete non-admin users.');
    }

    // Delete the admin user
    $admin->delete();

    return redirect('admin/admins')->with('success_message', 'Admin deleted successfully!');
}


}
