<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Session;


class GeneralSettingsController extends Controller
{
    public function index()
    {
        $GeneralSetting = GeneralSetting::first();
        return view('Backend.GeneralSetting.All', ['ID' => $GeneralSetting->id, 'data' => $GeneralSetting]);
    }

    public function saveGeneralSetting(Request $request, $id)
    {
        $this->validate($request, [
            'app_title' => 'required'
        ]);
        $app_title = $request->get('app_title');


        $filename1 = GeneralSetting::where('id', $id)->value('site_logo');
        if ($request->hasFile('site_logo')) {
            $path = public_path() . $filename1;
            if (file_exists($path) && $filename1 != '') {
                unlink($path);
            }
            $temp_img1 = $request->file('site_logo');
            $extension = $temp_img1->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destinationPath = public_path('/uploads/generalSetting');
            $temp_img1->move($destinationPath, $imagename);
            $site_logo = '/uploads/generalSetting/' . $imagename;
        } else {
            $site_logo = $filename1;
        }
        $filename2 = GeneralSetting::where('id', $id)->value('site_icon');
        if ($request->hasFile('site_icon')) {
            $path = public_path() . $filename2;
            if (file_exists($path) && $filename2 != '') {
                unlink($path);
            }
            $temp_img2 = $request->file('site_icon');
            $extension = $temp_img2->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destinationPath = public_path('/uploads/generalSetting');
            $temp_img2->move($destinationPath, $imagename);
            $site_icon = '/uploads/generalSetting/' . $imagename;
        } else {
            $site_icon = $filename2;
        }
        $filename3 = GeneralSetting::where('id', $id)->value('signIn_backgroundImage');
        if ($request->hasFile('signIn_backgroundImage')) {
            $path = public_path() . $filename3;
            if (file_exists($path) && $filename3 != '') {
                unlink($path);
            }
            $temp_img3 = $request->file('signIn_backgroundImage');
            $extension = $temp_img3->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destinationPath = public_path('/uploads/generalSetting');
            $temp_img3->move($destinationPath, $imagename);
            $signIn_backgroundImage = '/uploads/generalSetting/' . $imagename;
        } else {
            $signIn_backgroundImage = $filename3;
        }
        $GeneralSetting = GeneralSetting::findOrFail($id);
        $GeneralSetting->app_title = $app_title;
        $GeneralSetting->site_logo =  $site_logo;
        $GeneralSetting->site_icon =  $site_icon;
        $GeneralSetting->signIn_backgroundImage =  $signIn_backgroundImage;
        $GeneralSetting->save();

        Session::flash('success', "General setting has been updated");
        return redirect()->back();
    }
    public function comming_soon()
    {
        return view('errors.404');
    }
}
