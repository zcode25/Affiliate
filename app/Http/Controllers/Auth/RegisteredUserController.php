<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Affiliate;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Mail\AffiliateRegistrationMail;
use Illuminate\Support\Facades\Mail;

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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'max:15'],
            'instagram' => ['required', 'max:255'],
            'facebook' => ['required', 'max:255'],
            'tiktok' => ['required', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Affiliate',
            'phone' => $request->phone,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'tiktok' => $request->tiktok,
        ]);

        $affiliateCode = Str::random(10);

        Affiliate::create([
            'user_id' => $user->id,
            'affiliate_code' => $affiliateCode,
            'status' => 'pending',
        ]);

        Mail::to($user->email)->send(new AffiliateRegistrationMail($user));

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Pendaftaran afiliasi berhasil! Tunggu persetujuan admin.');

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
    }
}
