<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\User;
use Redirect;
use Validator;
use URL;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */


    public function resetPassword($token = '')
    {
        try {
            return view('Auth.changePassword', ['token' => $token]);
        } catch (Exception $e) {
            return view('layouts.404');
        }
    }

    public function saveResetPassword(Request $request, $en_token = '')
    {
        $input = $request->all();
        $rules = [
            'password' => 'required||min:3',
            'confirm_password' => 'required|same:password',
        ];

        $customMessages = [
            'password.required' => 'This field is required',
            'confirm_password.required' => 'This field is required',
        ];
        // $validator = Validator::make($request->all(), $rules, $customMessages);
        // if ($validator->fails()) {
        //     return Redirect::to(URL::previous())->withInput()->withErrors($validator);
        // }
        // try {
            $token=decrypt($en_token);
            $exeQuery = PasswordReset::where('token', $token);
            if ($exeQuery->count()) {
                $getUser = $exeQuery->first();
                $getToken = $getUser->token;
                $user = User::where('hash_number', '=', $getToken);
                if ($user->count()) {
                    $exeQuery = User::where('hash_number', $getToken)->update(array('password' => Hash::make($input['password'])));
                    if ($exeQuery) {
                        $exeQuery = PasswordReset::where('token', $token)->delete();
                        return redirect()->route('admin_login')->with('success', 'New password successfully set.');
                    }
                } else {
                    return redirect()->back()->with('error', 'We could not reset your password please try again later.');
                }
            } else {
                return redirect()->back()->with('error', 'We could not reset your password for invalid token.');
            }
        // } catch (Exception $e) {
        //     return redirect()->route('forgot');
        // }
    }
}
