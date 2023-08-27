<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('livewire.pages.index');
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
        $validatedForm = $request->validate([
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:8'
        ]);
        $validatedForm['password'] = bcrypt($validatedForm['password']);
        User::create($validatedForm);

        return redirect()
            ->route('sign-in')
            ->with('success', 'Register successful');
    }
    public function signIn(Request $request)
    {
        $validatedForm = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        if (auth()->attempt($validatedForm)) {
            return redirect()->route('home')
                ->with('success', 'Login successful');
        }
        return back()
            ->with('error', 'Login failed. Please check your credentials');
    }
    public function signOut()
    {
        Auth::logout();
        return redirect()
            ->route('sign-in')
            ->with('success', 'Logout successful');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
