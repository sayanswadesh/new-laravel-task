<?php

namespace App\Http\Controllers\Developer\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Exception;

class DashboardController extends Controller

{
    public function index()
    {
        $total_projects=Project::where('deleted_at', '=', NULL)->where('developer_id', Auth::user()->id)->count();
        $total_complete_tasks=Task::where('deleted_at', '=', NULL)->where('status','Complete')->whereHas('project_details', function ($q) {
            $q->where('developer_id', Auth::user()->id);
        })->count();
        $total_pending_tasks=Task::where('deleted_at', '=', NULL)->where('status','Pending')->whereHas('project_details', function ($q) {
            $q->where('developer_id', Auth::user()->id);
        })->count();
        return view('Developer.Dashboard.index', compact('total_complete_tasks', 'total_projects','total_pending_tasks'));
    }
}
