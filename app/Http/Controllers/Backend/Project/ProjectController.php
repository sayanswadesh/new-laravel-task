<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Session;

use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $dataQuery = Project::where('deleted_at', '=', NULL);
            $data = $dataQuery->select('*')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('client_name', function ($data) {
                    $client_name = Client::where('id', $data['client_id'])->value('client_name');
                    return $client_name;
                })
                ->addColumn('developer_name', function ($data) {
                    $developer_name = User::where('id', $data['developer_id'])->value('first_name');
                    return $developer_name;
                })
                ->addColumn('action', function ($data) {
                    $url_update = route('editProject', ['id' => $data->id]);
                    $url_task = route('allTask', ['project_id' => $data->id]);
                    $url_delete = route('deleteProject', ['id' => $data->id]);
                    $edit = ' <a href="' . $url_update . '" class="badge badge-pill badge-primary"><i class="fas fa-edit"></i> Edit </a>&nbsp;';
                    $edit .= ' <a class="badge badge-pill badge-warning" data-title="Add Task" href="' . $url_task . '" ><i class="fas fa-plus-circle"></i> Task </a>&nbsp;';

                    $edit .= '&nbsp<a href="' . $url_delete . '" class="badge badge-pill badge-danger" data-confirm="Are you sure to delete Project ? <span class=&#034;label label-primary&#034;></span>"><i class="fas fa-trash"></i> Delete </a>';
                    return $edit;
                })

                ->rawColumns(['action', 'client_name', 'developer_name'])
                ->make(true);
        }
        return view('Backend.Project.All');
    }

    public function add()
    {
        $all_clients = Client::where('deleted_at', '=', NULL)->get();
        $all_developers = User::where('deleted_at', '=', NULL)->where('user_type', 'Developer')->where('status', 'Active')->get();
        return view('Backend.Project.Add', compact('all_clients', 'all_developers'));
    }
    public function save(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'project_name' => 'required',
            'duration' => 'required|numeric',
            'client_id' => 'required',
            'developer_id' => 'required',
        ]);
        try {
            $Project = new Project();
            $Project->project_name = $input['project_name'];
            $Project->duration = $input['duration'];
            $Project->client_id = $input['client_id'];
            $Project->developer_id = $input['developer_id'];
            $Project->save();

            Session::flash('success', "Project has been created successfully");
            return redirect()->route('allProject');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function edit($id = '')
    {
        try {
            $records = Project::findOrFail($id);
            $all_clients = Client::where('deleted_at', '=', NULL)->get();
            $all_developers = User::where('deleted_at', '=', NULL)->where('user_type', 'Developer')->where('status', 'Active')->get();
            return view('Backend.Project.Edit', compact('records', 'all_clients', 'all_developers'));
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function update(Request $request, $id = '')
    {
        $input = $request->all();
        $this->validate($request, [
            'project_name' => 'required',
            'duration' => 'required|numeric',
            'client_id' => 'required',
            'developer_id' => 'required',
        ]);
        try {
            $hidden_id = $input['hidden_id'];

            $Project = Project::where('id', $hidden_id)->first();
            $Project->project_name = $input['project_name'];
            $Project->duration = $input['duration'];
            $Project->client_id = $input['client_id'];
            $Project->developer_id = $input['developer_id'];
            $Project->save();

            return redirect()->route('allProject')->with('success', 'Project has been Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function delete($id = null)
    {
        try {
            $remove = Project::findOrFail($id);
            $remove->delete();
            return redirect()->back()->with('success', 'Project has been deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
