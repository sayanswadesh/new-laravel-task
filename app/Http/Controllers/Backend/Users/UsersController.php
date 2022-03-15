<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use File;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $dataQuery = User::where('deleted_at', '=', NULL)->orderBy('id', 'DESC');
            $data = $dataQuery->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_image', function ($data) {
                    $user_image = '';
                    $user_image = '<img src="' . url('/') . $data->image . '" width="100px" height="100px">';

                    return $user_image;
                })
                ->addColumn('update_status', function ($data) {
                    $upt_st = '<span id="status' . $data->id . '">&nbsp;';
                    if ($data->id != '1') {
                        if ($data->status == 'Active') {
                            $upt_st .= '<a href="javascript:user_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i> </a>';
                        } else {
                            $upt_st .= '<a href="javascript:user_status(' . $data->id . ',' . $data->status . ');" class="btn btn-sm btn-warning" ><i class="fas fa-ban"></i> </a>';
                        }
                        $upt_st .= '</span>';
                    } else {
                        $upt_st = '<span class="badge badge-pill badge-info">' . $data->status . '</span>';
                    }
                    return $upt_st;
                })

                ->addColumn('action', function ($data) {
                    $edit = '';
                    // $url_update = route('editUser', ['id' => $data->id]);
                    // $url_delete = route('deleteUser', ['id' => $data->id]);
                    // $edit = ' <a href="' . $url_update . '" class="badge badge-pill badge-primary"><i class="fas fa-edit"></i> Edit </a>&nbsp;';
                    // if ($data->id != '1') {
                    //     $edit .= '&nbsp<a href="' . $url_delete . '" class="badge badge-pill badge-danger" data-confirm="Are you sure to delete user ? <span class=&#034;label label-primary&#034;></span>"><i class="fas fa-trash"></i> Delete </a>';
                    // }
                    return $edit;
                })

                ->rawColumns(['action', 'user_image', 'update_status'])
                ->make(true);
        }
        return view('Backend.Users.All');
    }
    public function add()
    {
        return view('Backend.Users.Add');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'login_id' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        $email = $request->get('email');
        $login_id = $request->get('login_id');
        $has_logInId = User::where('deleted_at', NULL)->where('login_id', $login_id)->first();
        $has_email = User::where('deleted_at', NULL)->where('email', $email)->first();
        if ($has_logInId) {
            return redirect()->back()->with('warning', 'User login id should be unique!');
        }
        if ($has_email) {
            return redirect()->back()->with('warning', 'User email should be unique!');
        }

        $name = $request->get('name');
        $confirm_password = $request->get('confirm_password');
        $mobile = $request->get('mobile');

        /* Default Image Start*/
        $defaultImagePath = public_path('/uploads/profilePhoto/avatar.png');
        $extension = \File::extension($defaultImagePath);
        $imagename = time() . '.' . $extension;
        $newFullPath = public_path('/uploads/profilePhoto/' . $imagename);
        $profile_photo = '/uploads/profilePhoto/' . $imagename;
        File::copy($defaultImagePath, $newFullPath);
        /* Default Image End*/

        $User = new User();
        $User->name = $name;
        $User->login_id = $login_id;
        $User->email = $email;
        $User->password = bcrypt($confirm_password);
        $User->phone = $mobile;
        $User->image = $profile_photo;
        $User->hash_number =  md5($name);
        $User->email_verification = 1;
        $User->status = 'Active';
        $User->save();

        Session::flash('success', "User has been created successfully");
        return redirect()->back();
    }

    public function edit($id)
    {
        try {
            $records = User::findOrFail($id);
            return view('Backend.Users.Edit', ['ID' => $id, 'records' => $records]);
        } catch (Exception $e) {
            return view('Backend.InvalidModalOperation');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|unique:users,email,' . $id . ',id'
        ]);

        $name = $request->get('name');
        $mobile = $request->get('mobile');


        $User =  User::findOrFail($id);


        $User->name = $name;
        $User->phone = $mobile;
        $User->save();

        Session::flash('success', "User has been updated");
        return redirect()->back();
    }

    public function delete($id = null)
    {
        $Remove = User::findOrFail($id);
        $Remove->delete();
        Session::flash('success', "User has been deleted");
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $input = $request->all();
        if ($input['status'] == 'Active') {
            User::where('id', $input['id'])->update([
                'status' => 'Inactive',
            ]);
            $st = 'Inactive';
            $html = '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="user_status(' . $input['id'] . ',' . $st . ')"><i class="fas fa-ban"></i></a>';
            return json_encode(array('id' => $input['id'], 'html' => $html));
        } else {
            User::where('id', $input['id'])->update([
                'status' => 'Active',
            ]);
            $st = 'Active';
            $html = '&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-success" onclick="user_status(' . $input['id'] . ',' . $st . ')"><i class="far fa-check-circle"></i></a>';
            return json_encode(array('id' => $input['id'], 'html' => $html));
        }
    }
}
