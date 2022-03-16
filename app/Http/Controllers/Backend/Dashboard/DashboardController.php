<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller

{
    public function index()
    {
        if (request()->ajax()) {
            $dataQuery = Task::where('deleted_at', '=', NULL)->where('status','Pending');
            $data = $dataQuery->select('*')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($data) {
                    $project_name = Project::where('id', $data['project_id'])->value('project_name');
                    return $project_name;
                })
                ->addColumn('update_status', function ($data) {
                    $upt_st = '<span id="status' . $data->id . '">&nbsp;';
                    if ($data->status == 'Complete') {
                        $upt_st .= '<a href="javascript:task_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-success">Complete </a>';
                    } else {
                        $upt_st .= '<a href="javascript:task_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-warning" >Pending </a>';
                    }
                    $upt_st .= '</span>';
                    return $upt_st;
                })
                ->rawColumns(['update_status','project_name'])
                ->make(true);
        }
        $total_developers=User::where('deleted_at', '=', NULL)->where('user_type', 'Developer')->count();
        $total_projects=Project::where('deleted_at', '=', NULL)->count();
        $total_tasks=Task::where('deleted_at', '=', NULL)->count();
        return view('Backend.Dashboard.index', compact('total_developers', 'total_projects','total_tasks'));
    }
}
