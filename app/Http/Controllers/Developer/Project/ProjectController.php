<?php

namespace App\Http\Controllers\Developer\Project;

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
                    $url_task = route('allDevTask', ['project_id' => $data->id]);
                    $edit = ' <a class="badge badge-pill badge-warning" data-title="Add Task" href="' . $url_task . '" ><i class="fas fa-plus-circle"></i> Task </a>&nbsp;';
                    return $edit;
                })

                ->rawColumns(['action', 'client_name', 'developer_name'])
                ->make(true);
        }
        return view('Developer.Project.All');
    }
}
