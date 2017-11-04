<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\CreateUserRequest;
use App\Department;
use App\Role;
use App\User;
use Hash;
use Mail;
use DB;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Department::select("name", 'id', 'alias', 'address')->orderBy('name')->get();
        $departments = array();

        if ($data != null && $data != false && count($data) > 0){
            foreach ($data as $value) {
                $value->number_users = DB::table("users")->where('department_id', $value->id)->count();

                $value->number_documents = DB::table("documents")->join("users", "users.id", "=", "documents.user_id")->where('users.department_id', $value->id)->count();

                array_push($departments, $value);
            }
        }

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $name = stripslashes($request->name);
        if($name == "" || $name == null){
            return 0;
        }

        $alias = stripslashes($request->alias);
        if($alias == "" || $alias == null){
            return 0;
        }

        $address = stripslashes($request->address);
        if($address == "" || $address == null){
            return 0;
        }

        $department = new Department;

        $department->name = $name;
        $department->alias = $alias;
        $department->address = $address;
        $department->save();

        app('App\Http\Controllers\LogController')->makeLog(2, array($name, $alias));

        return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        if ($department !== false && $department != null){
            return view('admin.departments.edit', compact('department'));
        }else{
            return redirect("admin/departments");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request)
    {
        $name = stripslashes($request->name);
        if($name == "" || $name == null){
            return 0;
        }

        $alias = stripslashes($request->alias);
        if($alias == "" || $alias == null){
            return 0;
        }

        $address = stripslashes($request->address);
        if($address == "" || $address == null){
            return 0;
        }

        $id = $request->id;

        if($id < 0 || $id == null){
            return 0;
        }

        $department = Department::find($id);

        if($department === false || $department == null){
            return 0;
        }

        $department->name = $name;
        $department->alias = $alias;
        $department->address = $address;
        $department->save();

        app('App\Http\Controllers\LogController')->makeLog(3, array($name, $alias));

        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $department = Department::find($id);
            $department->delete();

            return redirect()->action('DepartmentController@index')
                ->with('success', trans('session.department_delete_success'));
        } catch(Exception $e) {
            return redirect()->action('DepartmentController@index')
                ->with('errors', trans('session.department_delete_fail'));
        }
    }
}
