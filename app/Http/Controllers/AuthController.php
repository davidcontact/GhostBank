<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Wallet;


class AuthController extends Controller
{
    public function Register(){
        return view("register");
    }

    public function submitRegister(Request $request)
    {
        // Validate input
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:8',
        ]);

        // dd($validated);
        // dd("Break Data");
        // Create user

        $user = User::create([
            'name' => $validated['name'], // Access the validated data correctly
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);
        // dd($user);


        // Create primary wallet for user
        $Wallet = Wallet::create([
            'user_id' => $user->id,
            'wallet_address' => Str::random(12), // Generate unique wallet address
            'currency_type' => 'USD',
            'balance' => 10,
        ]);

        // dd("Success: " . $user . $wallet );
        // Redirect to dashboard or wallet page
        return view('login');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Pass the user and wallet data to the home page
            return redirect()->route('home')->with('message', 'Operation Success!')
            ->with('message_type', 'success');       
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->with('message', 'Invalid credentials, please try again.')
        ->with('message_type', 'error');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
