<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class AccountsController extends Controller
{
    public function ShowAddUserForm()
    {
        return view('Admin.accounts.add');
    }

    public function ShowProfile()
    {
        return view('Admin.accounts.profile');
    }

    public function ShowAllAccounts()
    {
        $items = User::get();
        return view('Admin.accounts.allaccounts', compact('items'));
    }

    public function ShowAccountDetails($id)
    {
        $details = User::find($id);
        if ($details) {
            return view('Admin.accounts.editaccount', compact('details'));
        } else {
            return back()->with('error', 'Unable to find user account.');
        }
    }

    public function CreateUser(Request $request)
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

        try {
            $address = implode(' | ', [
                $validated['house'],
                $validated['street'],
                $validated['barangay'],
                $validated['city'],
                $validated['province'],
                $validated['postal'],
            ]);

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
                'fname' => $validated['fname'],
                'mname' => $validated['mname'],
                'lname' => $validated['lname'],
                'suffix' => $validated['suffix'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $address,
                'image' => $imagePath,
            ]);
            return back()->with('success', 'Employee edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function UpdateUserAccount(Request $request)
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
            'email' => 'required|string|',
            'postal' => 'required|string|max:20',
            'status' => 'required',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            $user = User::findOrFail($request->id);

            $address = implode(' | ', [
                $validated['house'],
                $validated['street'],
                $validated['barangay'],
                $validated['city'],
                $validated['province'],
                $validated['postal'],
            ]);

            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                $imagePath = $request->file('image')->store('profiles', 'public');
                $user->image = $imagePath;
            }

            $user->uid = $validated['uid'];
            $user->type = $validated['type'];
            $user->fname = $validated['fname'];
            $user->mname = $validated['mname'];
            $user->lname = $validated['lname'];
            $user->suffix = $validated['suffix'];
            $user->email = $validated['email'];
            $user->gender = $validated['gender'];
            $user->phone = $validated['phone'];
            $user->status = $validated['status'];
            $user->address = $address;

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            return back()->with('success', 'Employee updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function DeleteAccount(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
