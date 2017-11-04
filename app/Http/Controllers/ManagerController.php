<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Department;
use App\User;
use App\Document;

use Auth;
use DB;
use Hash;
use Illuminate\Support\Facades\Input;
use File;
use Carbon\Carbon;
use DateTime;

class ManagerController extends Controller
{
    public function users(){
        $user = Auth::user();

        $department = Department::find($user->department_id);

        $data = DB::table('users')->join("roles", 'roles.id', '=', 'users.role_id')
                                ->select("users.id AS id_user", "username", "users.name AS fullname", "email", "roles.name AS role")
                                ->where("users.department_id", $department->id)
                                ->get();


        for ($i=0;$i<count($data);$i++){
            $data[$i]->role = ($data[$i]->role == "admin" ? "Quản lý hệ thống" : ($data[$i]->role == "manager" ? "Quản lý phòng" : "Nhân viên"));

            $data[$i]->numberDoc = DB::table('documents')->where('user_id', $data[$i]->id_user)->count();
        }

        return view('manager.users', compact('department', 'data'));
    }

    public function documents(){

        $user = Auth::user();

        return redirect("/document/".$user->department_id);
    }
}
