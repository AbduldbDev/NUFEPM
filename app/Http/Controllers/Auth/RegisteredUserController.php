<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'uid' => 'required|string',
            'type' => 'required|string',
            'fname' => 'required|string|max:100',
            'mname' => 'nullable|string|max:100',
            'lname' => 'required|string|max:100',
            'suffix' => 'nullable|string|max:10',
            'gender' => 'required|string|in:male,female,other',
            'phone' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'barangay' => 'required|string|max:100',
            'street' => 'required|string|max:100',
            'house' => 'required|string|max:100',
            'postal' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'nullable|image|max:2048',
        ]);

        $address = implode(' | ', [
            $validated['house'],
            $validated['street'],
            $validated['barangay'],
            $validated['city'],
            $validated['province'],
            $validated['postal'],
        ]);

        $name = trim(
            $validated['fname'] . ' ' .
                ($validated['mname'] ?? '') . ' ' .
                $validated['lname'] . ' ' .
                ($validated['suffix'] ?? '')
        );


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles', 'public');
        }


        $user = User::create([
            'uid' => $validated['uid'],
            'type' => $validated['type'],
            'name' => $name,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'address' => $address,
            'image' => $imagePath,
        ]);


        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
