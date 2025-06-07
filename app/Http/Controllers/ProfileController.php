<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
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
        // dd($request->all());
        // $request->user()->fill($request->validated());
        $validated = $request->validated();

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // if ($request->avatar) {
        //     // jika sebelumnya user sudah punya avatar
        //     if (!empty($request->user()->avatar)) {
        //         Storage::disk('public')->delete($request->user()->avatar);
        //     }

        //     // bikin nama file baru
        //     $newFileName = Str::after($request->avatar, 'tmp/');

        //     // pindahkan file
        //     Storage::disk('public')->move($request->avatar, "img/$newFileName");

        //     // timpa key
        //     $validated['avatar'] = "img/$newFileName";
        // }

        if ($request->avatar) {
            if (!empty($request->user()->avatar)) {
                Storage::disk('public')->delete($request->user()->avatar);
            }
            // $path = $request->file('avatar')->store('img', 'public');
            // $validated['avatar'] = $path;
            $newFileName = Str::after($request->avatar, 'tmp/');

            Storage::disk('public')->move($request->avatar, "img/$newFileName");

            $validated['avatar'] = "img/$newFileName";
        }

        // $request->user()->save();
        $request->user()->update($validated);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('tmp', 'public');
        }

        return $path;
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
