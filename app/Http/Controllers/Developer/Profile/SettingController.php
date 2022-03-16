<?php

namespace App\Http\Controllers\Developer\Profile;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('Developer.Profile.account');
    }

    public function save(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required||min:3',
            'confirm_password' => 'required|same:new_password'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->save();
            Session::flash('success', "Password has been updated");
        } else {
            Session::flash('error', "Old Password Does Not Matched");
        }
        return redirect()->back();
    }
}
