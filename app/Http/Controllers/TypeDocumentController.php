<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TypeDocumentRequest;
use App\TypeDocument;
use DB;

class TypeDocumentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TypeDocument::all();
        $typedocuments = array();

        foreach ($data as $ele){
            $ele->number_doc = DB::table("documents")->where("typedoc_id", $ele->id)->count();
            array_push($typedocuments, $ele);
        }

        return view('admin.typedocuments.index', compact('typedocuments'));
    }

    public function getInfoEdit(Request $R){
        $id = stripcslashes($R->id);

        if ($id == null || $id == false){
            return -1;
        }

        $type = TypeDocument::find($id);

        if ($type == null || $type == false){
            return -1;
        }

        $number_doc = DB::table("documents")->where("typedoc_id", $id)->count();

        return json_encode(array($type->name, $number_doc));
    }

    public function submitInfoEdit(Request $R){
        $id = stripcslashes($R->id);

        if ($id == null || $id == false){
            return -1;
        }

        $type = TypeDocument::find($id);

        if ($type == null || $type == false){
            return -1;
        }

        $name = stripcslashes($R->name);

        if ($name == null || $name == ""){
            return -1;
        }

        $oldName = $type->name;
        $type->name = $name;
        $type->save();

        app('App\Http\Controllers\LogController')->makeLog(8, array($oldName));

        return 1;
    }

    public function submitAddType(Request $R){
        
        $name = stripcslashes($R->name);

        if ($name == null || $name == ""){
            return -1;
        }

        $type = new TypeDocument();

        $type->name = $name;
        $type->save();

        app('App\Http\Controllers\LogController')->makeLog(9, array($name));

        return 1;
    }

    public function deleteType(Request $R){
        $id = stripcslashes($R->id);

        if ($id == null || $id == false){
            return -1;
        }

        $type = TypeDocument::find($id);

        if ($type == null || $type == false){
            return -1;
        }

        $number_doc = DB::table("documents")->where("typedoc_id", $id)->count();
        if ($number_doc > 0){
            return -1;
        }

        $name  =  $type->name;
        
        TypeDocument::destroy($id);

        app('App\Http\Controllers\LogController')->makeLog(10, array($name));

        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typedocuments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeDocumentRequest $request)
    {
        $typeDocument = new TypeDocument;
        $typeDocument->name = $request->name;
        $typeDocument->save();

        return redirect()->action('TypeDocumentController@index')->with('success', trans('session.typedoc_add_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeDocument = TypeDocument::find($id);

        return view('admin.typedocuments.edit', compact('typeDocument'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeDocumentRequest $request, $id)
    {
        $allRequest = $request->all();
        $typeDocument = TypeDocument::find($id);
        $typeDocument->update($allRequest);

        return redirect()->action('TypeDocumentController@index')->with('success', trans('session.typedoc_edit_success'));
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
            $typeDocument = TypeDocument::find($id);
            $typeDocument->delete();

            return redirect()->action('TypeDocumentController@index')
                ->with('success', trans('session.typedoc_delete_success'));
        } catch(Exception $e) {
            return redirect()->action('TypeDocumentController@index')
                ->with('errors', trans('session.typedoc_delete_fail'));
        }
    }
}
