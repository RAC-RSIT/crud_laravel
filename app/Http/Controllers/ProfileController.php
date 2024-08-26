<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{   

    /**
     * Show the user's profile.
     */
    public function show(): View
    {   
        $user = Auth::user();
        // $user = User::find();
        return view('profile.show', compact('user'));

    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        $user->fill($request->validated());
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        if ($request->hasFile('profile_photo')) 
        {
            try {
                $path = $request->file('profile_photo')->store('profile_photos', 'public');
                $user->update(['profile_photo_path' => $path]);
            } catch (Exception $e) {
                // Handle the exception, e.g., flash a message to the user
                return back()->withErrors(['error' => 'Failed to update profile picture.']);
            }
        }
    
        $user->save();
    
        return redirect()->route('profile.show')->with('status', 'Profile updated!');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
