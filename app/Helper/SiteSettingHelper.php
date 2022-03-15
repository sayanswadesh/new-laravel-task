<?php

namespace App\Helper;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
class SiteSettingHelper
{
	/* General Settings */
	public static function general_setting()
	{
		$general_details = GeneralSetting::first();
		return $general_details;
	}
}
