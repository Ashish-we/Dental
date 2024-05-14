<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    public function edit()
    {
        // dd(session()->all());
        $user = Auth::user();
        if ($user->hasRole('dentist')) {
            $data = $user->dentist;
            return view('profile.edit', ['user' => $user, 'data' => $data]);
        }
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'mobile' => 'required|string|regex:/^[0-9]{10}$/',
            'dob' => ['nullable', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'alternative_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',
            'alternative_email' => 'nullable|string',
            'gender' => 'nullable|string',
        ]);
        // dd($request);
        if (Auth::user()->hasRole('dentist')) {
            $dentist_validate = $request->validate([
                'qualification' => ['required', 'string', 'max:500'],
                'speciality' => ['required', 'string', 'max:255'],
            ]);
            $dentist = Auth::user()->dentist;

            $dentist->update([
                'qualification' => $dentist_validate['qualification'],
                'speciality' => $dentist_validate['speciality'],
            ]);
        }

        $user = Auth::user();
        $user = User::find($user->id);
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'dob' => $request->dob,
            'address' => $validatedData['address'],
            'alternative_mobile' => $validatedData['alternative_mobile'],
            'alternative_email' => $validatedData['alternative_email'],
            'gender' => $validatedData['gender'],
        ]);
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function password_change()
    {
        return view('profile.passwordChange');
    }

    public function password_update(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.'])->withInput();
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('password.change')->with('success', 'Password updated successfully.');
    }
}
