<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $dataQuery = Client::where('deleted_at', '=', NULL);
            $data = $dataQuery->select('*')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $url_update = route('editClient', ['id' => $data->id]);
                    $url_delete = route('deleteClient', ['id' => $data->id]);
                    $edit = ' <a href="' . $url_update . '" class="badge badge-pill badge-primary"><i class="fas fa-edit"></i> Edit </a>&nbsp;';

                    $edit .= '&nbsp<a href="' . $url_delete . '" class="badge badge-pill badge-danger" data-confirm="Are you sure to delete Client ?"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>';

                    return $edit;
                })
                ->rawColumns(['action', 'Client_type'])
                ->make(true);
        }
        return view('Backend.Client.All');
    }

    public function add()
    {
        return view('Backend.Client.Add');
    }
    public function save(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'client_name' => 'required',
            'mobile' => ['required', 'digits:10'],
            'email' => 'required|email',
        ]);
        $Client = new Client();
        $Client->client_name = $input['client_name'];
        $Client->mobile = $input['mobile'];
        $Client->email = $input['email'];
        $Client->save();

        Session::flash('success', "Client has been created successfully");
        return redirect()->back();
    }
    public function edit($id = '')
    {
        try {
            $records = Client::findOrFail($id);
            return view('Backend.Client.Edit', ['ID' => $id, 'records' => $records]);
        } catch (Exception $e) {
            return view('Backend.InvalidModalOperation');
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'client_name' => 'required',
            'mobile' => ['required', 'digits:10'],
            'email' => 'required|email',
            'hidden_id' => 'required',
        ]);
        $hidden_id = $request['hidden_id'];

        $Client = Client::where('id', $hidden_id)->first();
        $Client->client_name = $input['client_name'];
        $Client->mobile = $input['mobile'];
        $Client->email = $input['email'];
        $Client->save();

        return redirect()->back()->with('success', 'Client has been Updated Successfully');
    }
    public function delete($id = null)
    {
        $remove = Client::findOrFail($id);
        $remove->delete();
        return redirect()->back()->with('success', 'Client has been deleted Successfully');
    }
}
