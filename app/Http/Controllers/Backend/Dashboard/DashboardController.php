<?php

namespace App\Http\Controllers\Backend\Dashboard;

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
        $total_developers=User::where('deleted_at', '=', NULL)->where('user_type', 'Developer')->count();
        $total_projects=Project::where('deleted_at', '=', NULL)->count();
        $total_tasks=Task::where('deleted_at', '=', NULL)->count();
        return view('Backend.Dashboard.index', compact('total_developers', 'total_projects','total_tasks'));
    }
}
