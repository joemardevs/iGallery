<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        return view('livewire.pages.profile.index', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::findOrFail($id);
        // dd($user);
        // Validate the request data
        $request->validate([
            'name' => 'required|min:8',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        // Check if the input values are different from the existing values
        if ($request->input('name') !== $user->name || $request->input('email') !== $user->email) {
            // Update the user's profile
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // You can update other profile fields as well

            // Save the changes
            $user->save();
            return to_route('profile')->with('success', 'Profile updated successfully');
        }
        return to_route('profile');
    }
    public function updatePassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->get('current_password') || $request->get('new_password')) {
            $request->validate([
                'current_password' => 'required|min:8',
                'new_password' => 'required|confirmed|min:8',
            ]);
            // The passwords matches
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', "Current password is invalid");
            }
            // Current password and new password same
            if (strcmp($request->current_password, $request->new_password) == 0) {
                return redirect()->back()->with("error", "New password cannot be same as your current password.");
            }

            // Update the password
            $user->password =  Hash::make($request->new_password);
            $user->save();
            auth()->logout();
            return redirect('/sign-in')->with('success', "Password changed successfully");
        } else {
            return to_route('profile');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
