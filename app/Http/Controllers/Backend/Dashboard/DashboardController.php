<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Challan;
use Illuminate\Support\Facades\Auth;
use Exception;

class DashboardController extends Controller

{
    public function index()
    {
        $c_year = Carbon::now()->format('Y');
        $current_month = Carbon::now()->format('m');
        if ($current_month < 4) {
            $current_year = ($c_year - 1);
        } else {
            $current_year = $c_year;
        }
        return view('Backend.Dashboard.index', compact('current_year', 'current_month'));
    }
    public function getDashboard(Request $request)
    {
        try {
            $filter_year = $request->get('filter_year');
            $filter_month = $request->get('filter_month');

            $monthly_query = Challan::where('deleted_at', '=', NULL);
            if (Auth::user()->id == '1') {
            } else if (Auth::user()->id == '4') {
                $monthly_query->where('user_id', '2');
            } else {
                $monthly_query->where('user_id', Auth::user()->id);
            }
            $monthly_quentity = $monthly_query->sum('quantity_of_sand');


            $total_query = Challan::where('deleted_at', '=', NULL);
            if (Auth::user()->id == '1') {
            } else if (Auth::user()->id == '4') {
                $total_query->where('user_id', '2');
            } else {
                $total_query->where('user_id', Auth::user()->id);
            }
            $total_quentity = $total_query->sum('quantity_of_sand');

            return view('Backend.Dashboard.dashboard', compact('monthly_quentity', 'total_quentity'));
        } catch (Exception $exception) {
            return array('status' => 'error', 'msg' => 'Something Wrong!');
        }
    }
}
