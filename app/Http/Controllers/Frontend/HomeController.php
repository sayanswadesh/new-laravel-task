<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Challan;
use App\Models\ChallanLog;
use Exception;

class HomeController extends Controller
{
   public function challanDetails($alias = '')
   {
      /* Challan Log Entry */
      $ChallanLog = new ChallanLog();
      $ChallanLog->challan_id = $alias;
      $ChallanLog->save();

      /* Challan Details */
      $challan_details = Challan::where('deleted_at', '=', NULL)->where('id', $alias)->first();
      return view('Frontend.challan_details', compact('challan_details'));
   }
}
