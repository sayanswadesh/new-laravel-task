<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $dataQuery = User::where('deleted_at', '=', NULL)->where('user_type', 'Developer')->orderBy('id', 'DESC');
            $data = $dataQuery->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_image', function ($data) {
                    $user_image = '';
                    $user_image = '<img src="' . url('/') . $data['image'] . '" width="100px" height="100px">';

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
                    $url_delete = route('deleteUser', ['id' => $data->id]);
                    $edit = '&nbsp<a href="' . $url_delete . '" class="badge badge-pill badge-danger" data-confirm="Are you sure to delete user ? <span class=&#034;label label-primary&#034;></span>"><i class="fas fa-trash"></i> Delete </a>';

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
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'user_image' => 'required|mimes:jpeg,png,jpg',
        ]);
        $email = $request->get('email');
        $has_email = User::where('deleted_at', NULL)->where('email', $email)->first();
        if ($has_email) {
            return redirect()->back()->with('warning', 'User email should be unique!');
        }
        $confirm_password = $request->get('confirm_password');
        $mobile = $request->get('mobile');

        /* Default Image Start*/
        if ($request->hasFile('user_image')) {
            $user_img = $request->file('user_image');
            $extension = $user_img->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destinationPath = public_path('/uploads/profilePhoto');
            $user_img->move($destinationPath, $imagename);
            $image_name = '/uploads/profilePhoto/' . $imagename;
        } else {
            $image_name = 'avatar.png';
        }
        /* Default Image End*/

        $User = new User();
        $User->user_type = 'Developer';
        $User->first_name = $request['first_name'];
        $User->last_name = $request['last_name'];
        $User->email = $email;
        $User->password = Hash::make($confirm_password);;
        $User->mobile = $mobile;
        $User->image = $image_name;
        $User->hash_number =  md5($request['first_name']);
        $User->email_verification = 1;
        $User->status = 'Active';
        $User->save();

        Session::flash('success', "User has been created successfully");
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
