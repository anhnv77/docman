<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\User;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Facades\Input;
use File;

class UserController extends Controller
{
    public function handleAll($key = "")
    {
        if ($key == "create") {
            return $this->create();
        } else {
            return $this->index($key);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $department = Department::all();
        $select = 0;
        if ($id > 0) {
            $select = $id;

            $test = Department::find($select);

            if ($test == false || $test == null) {
                return redirect("/admin/users");
            }
        }
        //dd($users);
        return view('admin.users.list_user', compact('department', 'select'));
    }

    public function getUserList(Request $R)
    {
        $department_ID = $R->department_ID;
        $name = $R->key;

        if ($department_ID == 0) {

            $data = DB::table('users')
                ->select("users.id AS id_user", "username", "users.name AS fullname", "email", "type", "users.role_id")
                ->get();
        } else {
            $test = Department::find($department_ID);

            if ($test == false || $test == null) {
                return -1;
            }

            $data = DB::table('users')
                ->select("users.id AS id_user", "username", "users.name AS fullname", "email", "role_id")
                ->get();
        }

        $list = array();
        if ($data != false && $data != null && count($data) > 0) {
            foreach ($data as $ele) {
                if ($name != "") {
                    if (strpos(strtolower($ele->username), strtolower($name)) === false && strpos(strtolower($ele->fullname), strtolower($name)) === false) {
                        continue;
                    }
                }

                $number_document = DB::table("documents")->where("user_id", $ele->id_user)->count();

                $ele->number_document = $number_document;

                $role = DB::table("roles")->where("id", $ele->role_id)->get();

                foreach ($role as $check) {
                    $ele->user_role = ($check->name == "admin" ? "Quản lý hệ thống" : ($check->name == "manager" ? "Đăng tài liệu" : "Người dùng"));
                }

                $online = Auth::user();

                if ($online->hasRole("admin")) {
                    $ele->can_modify = 1;
                } else {
                    $ele->can_modify = 0;
                }

                array_push($list, $ele);
            }
        }

        return json_encode($list);
    }

    public function create()
    {
        $data = DB::table("roles")->orderBy('id', 'DESC')->get();
        $temp = array("", "Quản lý hệ thống", "Đăng tài liệu", "Người dùng");
        $roles = array();
        foreach ($data as $role) {
            $role->name = $temp[$role->id];

            array_push($roles, $role);
        }

        $data = DB::table("departments")->get();

        $department = array();
        foreach ($data as $ele) {
            array_push($department, $ele);
        }

        return view("admin.users.create", compact('roles', 'department'));
    }

    public function changeRoleUser(Request $R)
    {
        $id = $R->id;

        if ($id == null) {
            return -1;
        }

        $user = User::find($id);

        if ($user == null || $user == false) {
            return -2;
        }

        $newRole = $R->newRole;

        if ($newRole == null) {
            return -3;
        }

        $test = DB::table("roles")->where('id', $newRole)->count();

        if ($test == 0) {
            return -4;
        }


        $newPass = $R->newPass;

        if ($newPass != null && $newPass != "") {
            if ($user->type == 1) {
                return -1;
            }

            $user->password = Hash::make($newPass);
        }

        $user->role_id = $newRole;

        $user->save();

        app('App\Http\Controllers\LogController')->makeLog(11, array($user->name));

        return 1;
    }

    public function startAddUser(Request $R)
    {
        if ($R->username !== null) {
            $username = app('App\Http\Controllers\HandleAllCaller')->standardString(stripslashes($R->username));

            if ($username == "" || $username == null) {
                return -1;
            }

            $test = DB::table("users")->where('username', $username)->count();

            if ($test > 0) {
                return "UN founded";
            }
        } else {
            return -1;
        }

        if ($R->name !== null) {
            $name = app('App\Http\Controllers\HandleAllCaller')->standardString(stripslashes($R->name));

            if ($name == "" || $name == null) {
                return -1;
            }
        } else {
            return -1;
        }

        if ($R->password !== null) {
            $password = app('App\Http\Controllers\HandleAllCaller')->standardString(stripslashes($R->password));

            if ($password == "" || $password == null) {
                return -1;
            }
        } else {
            return -1;
        }

        if ($R->id_role !== null) {
            $id_role = $R->id_role;

            $test = DB::table("roles")->where('id', $id_role)->count();

            if ($test == 0) {
                return -1;
            }
        } else {
            return -1;
        }

        $hehe = new User();
        $hehe->username = $username;
        $hehe->name = $name;
        $hehe->password = Hash::make($password);
        $hehe->role_id = $id_role;
        $hehe->department_id = 1;
        $hehe->type = 0;

        $hehe->save();

        app('App\Http\Controllers\LogController')->makeLog(12, array($name, $id_role));

        return 1;

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $user = Auth::user();

        $user->numberDocument = DB::table("documents")->where('user_id', $user->id)->count();
        $dp = Department::find($user->department_id);

        if ($user->role_id == 1) {
            $user->nameValidation = "Quản lý hệ thống";
        } else if ($user->role_id == 2) {
            $user->nameValidation = "Quản lý phòng";
        } else {
            $user->nameValidation = "Người dùng";
        }

        $user->nameDepartment = $dp->name;

        return view('user.info', compact('user'));
    }

    private function standardNameFile($name_file)
    {
        $name_file = app('App\Http\Controllers\HandleAllCaller')->standardString($name_file);

        $name_file = str_replace(array("ă", "â", "á", "à", "ả", "ã", "ạ", "ă", "ắ", "ặ", "ằ", "ẳ", "ẵ", "â", "ấ", "ầ", "ẩ", "ẫ", "ậ"), "a", $name_file);
        $name_file = str_replace(array("Á", "À", "Ả", "Ã", "Ạ", "Ă", "Ắ", "Ặ", "Ằ", "Ẳ", "Ẵ", "Â", "Ấ", "Ầ", "Ẩ", "Ẫ", "Ậ"), "A", $name_file);
        $name_file = str_replace("đ", "d", $name_file);
        $name_file = str_replace("Đ", "D", $name_file);
        $name_file = str_replace(array("ê", "é", "è", "ẻ", "ẽ", "ẹ", "ê", "ế", "ề", "ể", "ễ", "ệ"), "e", $name_file);
        $name_file = str_replace(array("É", "È", "Ẻ", "Ẽ", "Ẹ", "Ê", "Ế", "Ề", "Ể", "Ễ", "Ệ"), "E", $name_file);
        $name_file = str_replace(array("ư", "ú", "ù", "ủ", "ũ", "ụ", "ư", "ứ", "ừ", "ử", "ữ", "ự"), "u", $name_file);
        $name_file = str_replace(array("Ú", "Ù", "Ủ", "Ũ", "Ụ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự"), "U", $name_file);
        $name_file = str_replace(array("í", "ì", "ỉ", "ĩ", "ị"), "i", $name_file);
        $name_file = str_replace(array("Í", "Ì", "Ỉ", "Ĩ", "Ị"), "I", $name_file);
        $name_file = str_replace(array("ô", "ơ", "ó", "ò", "ỏ", "õ", "ọ", "ô", "ố", "ồ", "ổ", "ỗ", "ộ", "ơ", "ớ", "ờ", "ở", "ỡ", "ợ"), "o", $name_file);
        $name_file = str_replace(array("Ó", "Ò", "Ỏ", "Õ", "Ọ", "Ô", "Ố", "Ồ", "Ổ", "Ỗ", "Ộ", "Ơ", "Ớ", "Ờ", "Ở", "Ỡ", "Ợ"), "O", $name_file);
        $name_file = str_replace(array("ý", "ỳ", "ỷ", "ỹ", "ỵ", "Ý", "Ỳ", "Ỷ", "Ỹ", "Ỵ"), "y", $name_file);
        return $name_file;
    }

    public function editProfile(Request $R)
    {
        if (Input::hasFile('avatar') && $R->file('avatar') != null) {
            $file = $R->file('avatar');
            $name_file = $this->standardNameFile($file->getClientOriginalName());

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = date("hisdmy");

            // plus 12 digits:

            $name_file = $time . $name_file;

            $des = "public/images/avatar/";

            $file->move($des, $name_file);

            $des = $des . $name_file;

            $data = Auth::user();

            if ($data->avatar != "public/images/avatar.png") {
                if (File::exists($data->avatar)) {
                    File::delete($data->avatar);
                }
            }

            $data->avatar = $des;

            $name = app('App\Http\Controllers\HandleAllCaller')->standardString(stripslashes($R->name));

            if ($name == "" || $name == null) {
                return -1;
            }

            $email = stripslashes($R->email);

            if ($email == "" || $email == null) {
                return -1;
            }

            $data->name = $name;
            $data->email = $email;

            if ($data->save()) {

                app('App\Http\Controllers\LogController')->makeLog(13, array());

                return 1;
            } else {
                return -1;
            }
        } else {
            $name = app('App\Http\Controllers\HandleAllCaller')->standardString(stripslashes($R->name));

            if ($name == "" || $name == null) {
                return -1;
            }

            $email = app('App\Http\Controllers\HandleAllCaller')->standardString(stripslashes($R->email));

            if ($email == "" || $email == null) {
                return -1;
            }

            $data = Auth::user();

            $data->name = $name;
            $data->email = $email;

            if ($data->save()) {
                app('App\Http\Controllers\LogController')->makeLog(13, array());

                return 1;
            } else {
                return -1;
            }
        }
    }

    public function editPassword(Request $R)
    {
        $old = $R->pass;
        $new = $R->new_pass;

        if ($old == "" || $old == null) {
            return -1;
        }

        if (!Hash::check($old, Auth::user()->password)) {
            return -2;
        }

        $data = Auth::user();

        $data->password = Hash::make($new);

        if ($data->save()) {
            app('App\Http\Controllers\LogController')->makeLog(14, array());

            return 1;
        }

        return -1;
    }

    public function deleteUser(Request $request)
    {
        $id = $request->id;
        if (!isset($id)) {
            return response()->json(["success" => 0]);
        }
        $online = Auth::user();
        if ($online->hasRole("admin")) {
            $user = User::where('id', $id)->first();
            if (isset($user->id)) {
                Document::where('user_id',$user->id)->delete();
                $user->delete();
                return response()->json(["success" => 1]);
            } else {
                return response()->json(["success" => 0]);
            }
        } else {
            return response()->json(["success" => 0]);
        }
    }
}
