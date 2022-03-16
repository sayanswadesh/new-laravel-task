<?php

namespace App\Http\Controllers\Developer\Profile;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class GeneralController extends Controller
{
    public function index()
    {
        return view('Developer.Profile.general');
    }

    public function changeProfileImage(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        $photo = $request->get('photo');
        $data = str_replace('data:image/jpeg;base64,', '', $photo);
        $file = base64_decode($data);
        $safeName = Str::random(10) . '.' . 'jpeg';
        $status = file_put_contents(public_path() . '/uploads/profilePhoto/' . $safeName, $file);
        if ($status) {
            if (file_exists(public_path() . $user->image)) {
                unlink(public_path() . $user->image);
            }
            $user->image = '/uploads/profilePhoto/' . $safeName;
            $user->save();
        }
    }

    public function save(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId . ',id',
            'mobile' => 'required|numeric',
        ]);
        $filename = User::where('id', $userId)->value('image');
        if ($request->hasFile('file')) {
            $path = public_path() . $filename;
            if (file_exists($path) && $filename != '') {
                unlink($path);
            }
            $profile_img = $request->file('file');
            $extension = $profile_img->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destinationPath = public_path('/uploads/profilePhoto');
            $profile_img->move($destinationPath, $imagename);
            $image_name = '/uploads/profilePhoto/' . $imagename;
        } else {
            $image_name = $filename;
        }
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $mobile = $request->get('mobile');


        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->mobile = $mobile;
        $user->image = $image_name;
        $user->save();

        Session::flash('success', "Profile has been updated");
        return redirect()->back();
    }
    public function accountsetting()
    {
        return view('Developer.Profile.account');
    }

    public function saveaccountsetting(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');
        $confirm_password = $request->get('confirm_password');

        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($confirm_password);
            $user->save();
            Session::flash('success', "Password has been updated");
        } else {
            Session::flash('error', "Old Password Does Not Matched");
        }
        return redirect()->back();
    }
}
