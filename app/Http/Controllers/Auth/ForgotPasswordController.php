<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Validator;
use Exception;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function forgot_password()
    {
        return view('auth.forgot_password');
    }
    public function save_forgot_password(Request $request)
    {

        $input = $request->all();
        $rules = [
            'email' => 'required|email'
        ];

        $customMessages = [
            'email.required' => 'This field is required',
            'email.email' => 'Enter vaild email',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // try {
        $user = User::where('email', $input['email']);
        if ($user->count()) {
            // Generate a new code and password
            $token = Str::random(40);
            $user = $user->first();
            $check_data = PasswordReset::where('email', $input['email'])->first();
            if ($check_data) {
                $PasswordReset = PasswordReset::findOrFail($check_data['id']);
                $PasswordReset->token =$token;
                $PasswordReset->timestamps = false;
                $PasswordReset->created_at = date('Y-m-d h:i:s');
                $PasswordReset->save();
            } else {
                PasswordReset::insert(
                    ['email' => $user->email, 'token' => $token, 'created_at' => date('Y-m-d h:i:s')]
                );
            }
            User::where('id', $user->id)->update(array('hash_number' => $token));
            $request_sent = array(
                'token' =>  $token,
                'name' =>  $user->name,
            );

            $status = Mail::to($user->email)->send(new \App\Mail\ForgotPassword($request_sent));

            return redirect()->back()->with('success', 'Please check your mail for recover password.');
        } else {
            return redirect()->back()->with('error', 'Invalid email address.');
        }
        // } catch (Exception $e) {
        //     return view('layouts.404');
        // }
    }
}
