<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BasicSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* General Settings */
        $generalSetting = new GeneralSetting();
        $generalSetting->site_logo         = 'logo.png';
        $generalSetting->signIn_backgroundImage  = 'background.jpg';
        $generalSetting->app_title  = 'Backend Panel';
        $generalSetting->site_icon         = 'logo-icon.png';
        $generalSetting->save();

        /* Default User */
        $User = new User();
        $User->user_type = 'Admin';
        $User->first_name     = 'Soumya';
        $User->last_name = 'Jana';
        $User->email = 'admin@gmail.com';
        $User->mobile = '1234567890';
        $User->password = Hash::make('123456');
        $User->email_verification = 1;
        $User->image = 'avatar.png';
        $User->hash_number = md5('Anirban Das');
        $User->status = 'Active';
        $User->save();
    }
}
