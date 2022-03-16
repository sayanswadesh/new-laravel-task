<?php

namespace App\Http\Controllers\Developer\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function index(Request $request, $project_id = '')
    {
        if (request()->ajax()) {
            $dataQuery = Task::where('deleted_at', '=', NULL)->where('project_id', $project_id);
            $data = $dataQuery->select('*')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('update_status', function ($data) {
                    $upt_st = '<span id="status' . $data->id . '">&nbsp;';
                    if ($data->status == 'Complete') {
                        $upt_st .= '<a href="javascript:task_dev_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-success">Complete </a>';
                    } else {
                        $upt_st .= '<a href="javascript:task_dev_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-warning" >Pending </a>';
                    }
                    $upt_st .= '</span>';
                    return $upt_st;
                })
                ->rawColumns(['update_status'])
                ->make(true);
        }
        $project_details = Project::where('deleted_at', '=', NULL)->findOrFail($project_id);
        return view('Developer.Project.Task.All', compact('project_id', 'project_details'));
    }
    public function all_task(Request $request)
    {
        if (request()->ajax()) {
            $dataQuery = Task::where('deleted_at', '=', NULL)->whereHas('project_details', function ($q) {
                $q->where('developer_id', Auth::user()->id);
            });
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
                        $upt_st .= '<a href="javascript:task_dev_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-success">Complete </a>';
                    } else {
                        $upt_st .= '<a href="javascript:task_dev_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-warning" >Pending </a>';
                    }
                    $upt_st .= '</span>';
                    return $upt_st;
                })
                ->rawColumns(['update_status','project_name'])
                ->make(true);
        }
        return view('Developer.Project.Task.AllTable');
    }
    public function status(Request $request)
    {
        $input = $request->all();
        if ($input['status'] == 'Complete') {
            Task::where('id', $input['id'])->update([
                'status' => 'Pending',
            ]);
            $st = 'Pending';
            $html = '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="task_dev_status(' . $input['id'] . ',' . $st . ')">Pending</a>';
            return json_encode(array('id' => $input['id'], 'html' => $html));
        } else {
            Task::where('id', $input['id'])->update([
                'status' => 'Complete',
            ]);
            $st = 'Complete';
            $html = '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="task_dev_status(' . $input['id'] . ',' . $st . ')">Complete</a>';
            return json_encode(array('id' => $input['id'], 'html' => $html));
        }
    }
}
