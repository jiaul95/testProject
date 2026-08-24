<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;

class UserRegistration extends Controller
{
    public function registerForm(){
        return view("register-form");
    }

    public function store(Request $request){
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|numeric|digits:10',
                'password' => 'required|string|min:6'
            ]);

            $store = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'phone_no' => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            if($store){
                return redirect('/login')->with('success','Registered Successfully!');
            }
            return back()->with('error', 'Registration failed!');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function loginview(){
        return view('login');
    }

    public function validateLogin(Request $request){
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $user = User::where('email', $request->email)->first();

            if($user && Hash::check($request->password, $user->password)){
                $otp = rand(100000, 999999);
                $request->session()->put('login_otp', $otp);
                $request->session()->put('temp_user_id', $user->id);

                try {
                    Mail::raw("Your OTP for login is: $otp", function($message) use ($user) {
                        $message->to($user->email)->subject('Login OTP');
                    });
                } catch (Exception $e) {
                    // Ignore mail error as requested
                }

                return redirect('/otp-verify')->with('success', 'OTP sent to your email.');
            }

            return back()->with('error', 'Invalid Credentials');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function otpVerifyForm() {
        if (!session('temp_user_id')) {
            return redirect('/login');
        }
        return view('otp-verify');
    }

    public function verifyOtp(Request $request) {
        try {
            $request->validate([
                'otp' => 'required|numeric'
            ]);

            $sessionOtp = $request->session()->get('login_otp');
            $tempUserId = $request->session()->get('temp_user_id');

            if ($sessionOtp && $request->otp == $sessionOtp) {
                Auth::loginUsingId($tempUserId);
                $request->session()->forget(['login_otp', 'temp_user_id']);
                return redirect('/dashboard')->with('success', 'Logged in successfully!');
            }

            return back()->with('error', 'Invalid OTP');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function dashboard() {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
