<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::where('user_type', 'customer')->get();

        // Return the view with users data
        return view('admin.admin.users', compact('users'));
    }

    public function addUser(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Create the user with the type 'customer'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->mobile,
            'password' => Hash::make($request->password),
            'user_type' => 'customer', // Set the user type to 'customer'
        ]);
    
        return redirect('admin/users')->with('success_message', 'User created successfully!');
    }
    

    public function destroy($id)
    {
        // Delete the user
        User::find($id)->delete();

        // Redirect back with success message
        return redirect()->back()->with('success_message', 'User deleted successfully!');
    }
}
