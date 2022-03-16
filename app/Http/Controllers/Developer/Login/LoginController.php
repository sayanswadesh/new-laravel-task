<?php

namespace App\Http\Controllers\Developer\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        if (auth()->user()) {
            return redirect()->route('dev_dashboard');
        }

        return redirect()->route('developer_login');
    }

    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('dev_dashboard');
        }
        return view('Developer.login.login');
    }
    public function Check_login(Request $request)
    {
        $msg = [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ];
        $this->validate($request, [
            'email' => 'bail|required',
            'password' => 'bail|required|min:3'

        ], $msg);
        $input = $request->all();
        $remember_me = true;
        $email = $input['email'];
        $pass = $input['password'];
        if (Auth::attempt(array('email' => $email, 'password' => $pass, 'user_type' => 'Developer'), $remember_me)) {
            return redirect()->route('dev_dashboard')->with('success', 'Logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Login Failed !!!');
        }
    }
    public function logout()
    {
        if (auth()->user()) {
            Auth::logout();
            return redirect()->route('developer_login')->with('success', 'Logged out successfully');
        } else {
            return redirect()->route('developer_login');
        }
    }
}
