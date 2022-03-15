<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Exception;
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
                    if ($data->status == 'Active') {
                        $upt_st .= '<a href="javascript:task_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-success">Complete </a>';
                    } else {
                        $upt_st .= '<a href="javascript:task_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-warning" >Pending </a>';
                    }
                    $upt_st .= '</span>';
                    return $upt_st;
                })

                ->addColumn('action', function ($data) {
                    $url_update = route('editTask', ['id' => $data->id]);
                    $url_delete = route('deleteTask', ['id' => $data->id]);
                    $edit = ' <a href="' . $url_update . '" class="badge badge-pill badge-primary"><i class="fas fa-edit"></i> Edit </a>&nbsp;';

                    $edit .= '&nbsp<a href="' . $url_delete . '" class="badge badge-pill badge-danger"  data-confirm="Are you sure to delete hotel room?" ><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>';
                    return $edit;
                })
                ->rawColumns(['action', 'update_status'])
                ->make(true);
        }
        $project_details = Project::where('deleted_at', '=', NULL)->findOrFail($project_id);
        return view('Backend.Project.Task.All', compact('project_id', 'project_details'));
    }

    public function add(Request $request, $project_id = '')
    {
        return view('Backend.Project.Task.Add', compact('project_id'));
    }
    public function save(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'task_name' => 'required',
            'project_id' => 'required',
        ]);
        $Task = new Task();
        $Task->project_id = $input['project_id'];
        $Task->task_name = $input['task_name'];
        $Task->save();

        Session::flash('success', "Task has been created successfully");
        return redirect()->back();
    }
    public function edit($id = '')
    {
        try {
            $records = Task::findOrFail($id);
            $project_id = $records['project_id'];
            return view('Backend.Project.Task.Edit', compact('records', 'id', 'project_id'));
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'task_name' => 'required',
            'hidden_id' => 'required',
        ]);
        $hidden_id = $input['hidden_id'];

        $Task = Task::where('id', $hidden_id)->first();
        $Task->task_name = $input['task_name'];
        $Task->save();

        return redirect()->back()->with('success', 'Task has been Updated Successfully');
    }
    public function delete($id = null)
    {
        $remove = Task::findOrFail($id);
        $remove->delete();
        return redirect()->back()->with('success', 'Task has been deleted Successfully');
    }
    public function status(Request $request)
    {
        $input = $request->all();
        if ($input['status'] == 'Complete') {
            Project::where('id', $input['id'])->update([
                'status' => 'Pending',
            ]);
            $st = 'Pending';
            $html = '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="task_status(' . $input['id'] . ',' . $st . ')">Pending</a>';
            return json_encode(array('id' => $input['id'], 'html' => $html));
        } else {
            Project::where('id', $input['id'])->update([
                'status' => 'Complete',
            ]);
            $st = 'Complete';
            $html = '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="task_status(' . $input['id'] . ',' . $st . ')">Complete</a>';
            return json_encode(array('id' => $input['id'], 'html' => $html));
        }
    }
}
