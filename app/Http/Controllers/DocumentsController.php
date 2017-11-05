<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Department;
use App\Document;
use App\User;
use App\TypeDocument;
use DB;
use File;
use App\Role;
use App\Http\Requests\CreateDocumentRequest;

use DateTime;
use Carbon\Carbon;
use URL;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($select)
    {   
        $data = DB::table("departments")->select('id', 'alias')->get();

        return view('user.index', compact('data', 'select'));
    }

    private function getUserAndDepartments($ele){
        $online = Auth::user();

        $data =  DB::table('users')
                    ->join('departments', 'departments.id', '=', 'users.department_id')
                    ->select("users.name AS userName", "departments.name AS departmentName", "departments.alias AS departmentAlias")
                    ->where('users.id', $ele->user_id)
                    ->where('users.department_id', $online->department_id)
                    ->get();

        if ($data!=false && $data!=null){
            foreach($data as $ele){
                return array( $ele->userName, $ele->departmentName, $ele->departmentAlias );
            }
        }

        return false;
    }

    private function validateDate($date, $str)
    {
        $d = DateTime::createFromFormat($str, $date);
        return $d && $d->format($str) === $date;
    }

    public function getDocumentList(Request $R)
    { 
        if(Auth::user()->hasRole('user') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager')) {
            $text = $R->text;
            if ($text!=null && $text!=""){
                $text = app('App\Http\Controllers\HandleAllCaller')->standardString(strip_tags($text));
            }

            $key= $R->key;

            if ($key!=null && $key!=""){
                $key = app('App\Http\Controllers\HandleAllCaller')->standardString(strip_tags($key));
            }

            $min = json_decode($R->start);
            $max = json_decode($R->end);

            date_default_timezone_set('Asia/Ho_Chi_Minh');

            $dayMin = "10-10-10";

            $dayMax = "3010-10-10";

            if ($min!=null && $min!=""){
                $dayMin = $min[0]."-".$min[1]."-".$min[2];

                if (!$this->validateDate($dayMin, 'Y-n-j')){
                    return json_encode(array());
                }
            }

            if ($max!=null && $max!=""){
                $dayMax = $max[0]."-".$max[1]."-".$max[2];

                if (!$this->validateDate($dayMax, 'Y-n-j')){
                    return json_encode(array());
                }
            }

            $departmentFilter = $R->department_ID;

            if ($text!=null && $text!=""){
                $data =  DB::table('documents')
                    ->select('documents.id AS document_id', 'documents.*', 'documents.created_at AS document_create_at')
                    ->where('title','like','%'.$text.'%')
                    ->orWhere('coquan','like','%'.$text.'%')
                    ->orWhere('nguoiky','like','%'.$text.'%')
                    ->orWhere('sohieu','like','%'.$text.'%')
                    ->orWhereRaw('DATE_FORMAT(documents.date, \'%d %m %Y\') LIKE \'%?%\'',[$text])
                    ->get();
            }else{
                $data =  DB::table('documents')
                    ->select('documents.id AS document_id', 'documents.*', 'documents.created_at AS document_create_at')
                    ->where('documents.created_at', '<=', $dayMax)
                    ->where('documents.created_at', '>=', $dayMin)
                    ->orderBy('documents.created_at', 'DESC')
                    ->get();
            }
            $list = array();
            if(!count($data)){
                return json_encode($list);
            }

            $typemodel = new TypeDocument();
            foreach($data as $d){
                $type = $typemodel->where('id',$d->typedoc_id)->first();
                $parent = $typemodel->where('id',$type->parent)->first();
                $d->type_document = $parent->name.'/'.$type->name;
            }


            $can_modify = 0;

            if ($data!=null && $data!=false){
                foreach($data as $ele){
                    if ($ele->user_id === null || $ele->user_id === false){
                        continue;
                    }

                    $online = Auth::user();

                    $advance = false;

                    if (!$online->hasRole('admin')){
                        $can_modify = 0;
                        $catch =  DB::table('users')
                                    ->join('departments', 'departments.id', '=', 'users.department_id')
                                    ->select("users.name AS userName", "departments.name AS departmentName", "departments.alias AS departmentAlias", "departments.id AS department_ID")
                                    ->where('users.id', $ele->user_id)
                                    ->get();

                        if ($catch!=false && $catch!=null){
                            foreach($catch as $temp){
                                if ($departmentFilter != 0 && $temp->department_ID != $departmentFilter){
                                    continue;
                                }
                                
                                if ($ele->is_public == 0 && $online->department_id != $temp->department_ID){
                                    continue;
                                }

                                if (($online->hasRole('manager') && $online->department_id == $temp->department_ID ) || ($online->hasRole('user') && $ele->user_id == $online->id )){

                                    $can_modify = 1;
                                }

                                $advance = array( $temp->userName, $temp->departmentName, $temp->departmentAlias );
                            }
                        }

                    }else{
                        $can_modify = 1;
                        $catch =  DB::table('users')
                                    ->join('departments', 'departments.id', '=', 'users.department_id')
                                    ->select("users.name AS userName", "departments.name AS departmentName", "departments.alias AS departmentAlias", "departments.id AS department_ID")
                                    ->where('users.id', $ele->user_id)
                                    ->get();
                        if ($catch!=false && $catch!=null){
                            foreach($catch as $temp){
                                if ($departmentFilter != 0 && $temp->department_ID != $departmentFilter){
                                    continue;
                                }

                                $advance = array( $temp->userName, $temp->departmentName, $temp->departmentAlias );
                            }
                        }
                    }

                    if ($advance !== false){

                        if ($key!=""){
                            
                            if (strpos(strtolower($ele->title), strtolower($key)) === false && strpos(strtolower($ele->type_document), strtolower($key)) === false){
                                continue;
                            }
                        }

                        $ele->user_name = $advance[0];
                        $ele->department_name = $advance[1];
                        $ele->department_alias = $advance[2];
                        $ele->can_modify = $can_modify;
                        $ele->show_create_at = $this->standardTime($ele->document_create_at);
                        $ele->document_create_at = $this->standardDate($ele->document_create_at);
                        
                        $file_location = 'public/documents/'.$ele->content;

                        $type_file = pathinfo($file_location, PATHINFO_EXTENSION);

                        if ($type_file == "pdf"){
                            $ele->type_file = URL::asset("public/images/pdf.png");
                        }else if ($type_file == "xlsx" || $type_file == "xls"){
                            $ele->type_file = URL::asset("public/images/excel.png");
                        }else if ($type_file == "doc" || $type_file == "docs"){
                            $ele->type_file = URL::asset("public/images/word.png");
                        }

                        $ele->link_download = URL::asset($file_location);

                        array_push($list, $ele);
                    }

                }
            }

            return json_encode($list);
        }
    }

    public function getMyDocumentList(Request $R)
    { 
        $key= $R->key;

        if ($key!=null && $key!=""){
            $key = app('App\Http\Controllers\HandleAllCaller')->standardString(strip_tags($key));
        }

        $min = json_decode($R->start);
        $max = json_decode($R->end);

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $dayMin = "10-10-10";

        $dayMax = "3010-10-10";

        if ($min!=null && $min!=""){
            $dayMin = $min[0]."-".$min[1]."-".$min[2];

            if (!$this->validateDate($dayMin, 'Y-n-j')){
                return json_encode(array());
            }
        }

        if ($max!=null && $max!=""){
            $dayMax = $max[0]."-".$max[1]."-".$max[2];

            if (!$this->validateDate($dayMax, 'Y-n-j')){
                return json_encode(array());
            }
        }

        $typeFilter = $R->type;

        if ($typeFilter!=0){
            $test = TypeDocument::find($typeFilter);

            if ($test == false || $test == null){
                return -1;
            }
        }

        $data =  DB::table('documents')
                    ->join('type_documents', 'documents.typedoc_id', '=', 'type_documents.id')
                    ->select('documents.id AS document_id', 'title', 'description', 'content', 'is_public', 'user_id', 'typedoc_id', 'documents.created_at AS document_create_at', 'name as type_document', 'type_documents.id AS id_type')
                    ->where('documents.created_at', '<=', $dayMax)
                    ->where('documents.created_at', '>=', $dayMin)
                    ->where('documents.user_id', Auth::user()->id)
                    ->orderBy('documents.created_at', 'DESC')
                    ->get();

        $list = array();
        $can_modify = 0;

        if ($data!=null && $data!=false){
            foreach($data as $ele){
                if ($ele->user_id === null || $ele->user_id === false){
                    continue;
                }

                if ($typeFilter!=0){
                    if ($ele->id_type != $typeFilter){
                        continue;
                    }
                }

                $online = Auth::user();
                
                $catch =  Department::find($online->department_id);

                if ($catch!=false && $catch!=null){

                    if ($key!=""){
                        if (strpos(strtolower($ele->title), strtolower($key)) === false && strpos(strtolower($ele->type_document), strtolower($key)) === false){
                            continue;
                        }
                    }

                    $ele->department_name = $catch->name;
                    $ele->department_alias = $catch->alias;
                    $ele->can_modify = 1;

                    $ele->show_create_at = $this->standardTime($ele->document_create_at);
                    $ele->document_create_at = $this->standardDate($ele->document_create_at);
                    
                    $file_location = 'public/documents/'.$ele->content;

                    $type_file = pathinfo($file_location, PATHINFO_EXTENSION);

                    if ($type_file == "pdf"){
                        $ele->type_file = URL::asset("public/images/pdf.png");
                    }else if ($type_file == "xlsx" || $type_file == "xls"){
                        $ele->type_file = URL::asset("public/images/excel.png");
                    }else if ($type_file == "doc" || $type_file == "docx"){
                        $ele->type_file = URL::asset("public/images/word.png");
                    }

                    $ele->link_download = URL::asset($file_location);

                    array_push($list, $ele);
                }

            }
        }

        return json_encode($list);
    }

    private function standardTime($date_time){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dt = date_create($date_time);

        return date_format($dt, "H:i:s")." ngày ". date_format($dt, "d-m-Y")." (". app('App\Http\Controllers\HandleAllCaller')->parseTime($date_time).")";
    }

    private function standardDate($date_time){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dt = date_create($date_time);

        return date_format($dt, "d-m-Y");
    }

    private function getTotalInfo($id){
        $doc = Document::find($id);

        if ($doc == null || $doc == false){
            return null;
        }

        $file_location = 'public/documents/'.$doc->content;

        if ($file_location!= null && File::exists($file_location)){
            $hi = $file_location;

            $type = pathinfo($hi, PATHINFO_EXTENSION);
            
            $size = round(filesize($hi)/1024)." kb ";
        }else{
            return false;
        }

        $time = $this->standardDate($doc->create_at);
        
        return array("description" => $doc->description, "type" => $type, "size" => $size, "link" => URL::asset($file_location), "time" => $time);
    }

    public function handleAll($key=""){
        if ($key == ""){
            return $this->index(0);
        }else if ($key == "create"){
            return $this->create();
        }else{
            $test = DB::table("departments")
                    ->select('id')
                    ->where('id', $key)
                    ->get();

            if (count($test) > 0){
                return $this->index($test[0]->id);
            }
        }
    }

    public function getInfoDocumentForModal(Request $R){
        $id = $R->id;

        // need: description, format, size, link

        if ($id==null){
            return -1;
        }

        $document = Document::find($id);

        if ($document == null || $document == false){
            return -1;
        }

        if(!Auth::user()->hasRole('admin') && $document->is_public == 0){
            $catch =  DB::table('users')
                        ->join('departments', 'departments.id', '=', 'users.department_id')
                        ->select("users.name AS userName")
                        ->where('users.id', $document->user_id)
                        ->where('departments.id', Auth::user()->department_id)
                        ->get();

            if ($catch==null || $catch===false || count($catch)==0){
                return -1;
            }
        }
        
        $ret = $this->getTotalInfo($id);

        if ($ret === false){
            return -1;
        }

        return json_encode($ret);
    }

    public function deleteDocumentWithID(Request $R){
        $id = $R->id;

        // need: description, format, size, link

        if ($id==null){
            return -1;
        }

        $document = Document::find($id);

        if ($document == null || $document == false){
            return -1;
        }

        if (Auth::user()->hasRole('user') && $document->user_id != Auth::user()->id){
            return -1;
        }

        if(Auth::user()->hasRole('manager')){
            $catch =  DB::table('users')
                        ->join('departments', 'departments.id', '=', 'users.department_id')
                        ->select("users.name AS userName")
                        ->where('users.id', $document->user_id)
                        ->where('departments.id', Auth::user()->department_id)
                        ->get();

            if ($catch==null || $catch===false || count($catch)==0){
                return -1;
            }
        }

        if ($document->totalDeleteFile() == 1){
            app('App\Http\Controllers\LogController')->makeLog(4, array($document->title, $document->user_id));
            Document::destroy($id);

            return 1;
        }else{
            app('App\Http\Controllers\LogController')->makeLog(4, array($document->title, $document->user_id));

            Document::destroy($id);

            return 1;
        }
    }

    public function deleteManyDocuments(Request $R){
        $list = json_decode($R->list);

        if ($list == null || $list == "" || !is_array($list)){
            return -1;
        }

        foreach ($list as $id){
            if ($id==null){
                return -1;
            }

            $document = Document::find($id);

            if ($document == null || $document == false){
                return -1;
            }

            if (Auth::user()->hasRole('user') && $document->user_id != Auth::user()->id){
                return -1;
            }

            if(Auth::user()->hasRole('manager')){
                $catch =  DB::table('users')
                            ->join('departments', 'departments.id', '=', 'users.department_id')
                            ->select("users.name AS userName")
                            ->where('users.id', $document->user_id)
                            ->where('departments.id', Auth::user()->department_id)
                            ->get();

                if ($catch==null || $catch===false || count($catch)==0){
                    return -1;
                }
            }
        }

        $perfect = 0;

        foreach ($list as $id){
            $document->totalDeleteFile();

            Document::destroy($id);

            $perfect ++;
        }

        app('App\Http\Controllers\LogController')->makeLog(5, $list);

        return $perfect;
    }

    public function mydocuments()
    {
        $user = Auth::user();
        
        $data = TypeDocument::all();
        $select = 0;

        return view('user.mydoc', compact('data', 'select'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_types = TypeDocument::where('parent', null)->lists('name', 'id')->all();
        $typedocument = array();
        foreach ($parent_types as $key => $value) {
            $typedocument[$value] = TypeDocument::where('parent', $key)->lists('name', 'id')->toArray();
        }

        return view('user.create', compact('typedocument'));
    }

    private function standardNameFile($name_file){
        $name_file=$this->standardString($name_file);

        $name_file= str_replace(array("ă","â","á","à","ả","ã","ạ","ă","ắ","ặ","ằ","ẳ","ẵ","â","ấ","ầ","ẩ","ẫ","ậ"), "a", $name_file);
        $name_file= str_replace(array("Á","À","Ả","Ã","Ạ","Ă","Ắ","Ặ","Ằ","Ẳ","Ẵ","Â","Ấ","Ầ","Ẩ","Ẫ","Ậ"), "A",$name_file);
        $name_file= str_replace("đ", "d",$name_file);
        $name_file= str_replace("Đ", "D",$name_file);
        $name_file= str_replace(array("ê","é","è","ẻ","ẽ","ẹ","ê","ế","ề","ể","ễ","ệ"), "e",$name_file);
        $name_file= str_replace(array("É","È","Ẻ","Ẽ","Ẹ","Ê","Ế","Ề","Ể","Ễ","Ệ"), "E",$name_file);
        $name_file= str_replace(array("ư","ú","ù","ủ","ũ","ụ","ư","ứ","ừ","ử","ữ","ự"), "u",$name_file);
        $name_file= str_replace(array("Ú","Ù","Ủ","Ũ","Ụ","Ư","Ứ","Ừ","Ử","Ữ","Ự"), "U",$name_file);
        $name_file= str_replace(array("í","ì","ỉ","ĩ","ị"), "i",$name_file);
        $name_file= str_replace(array("Í","Ì","Ỉ","Ĩ","Ị"), "I",$name_file);
        $name_file= str_replace(array("ô","ơ","ó","ò","ỏ","õ","ọ","ô","ố","ồ","ổ","ỗ","ộ","ơ","ớ","ờ","ở","ỡ","ợ"), "o",$name_file);
        $name_file= str_replace(array("Ó","Ò","Ỏ","Õ","Ọ","Ô","Ố","Ồ","Ổ","Ỗ","Ộ","Ơ","Ớ","Ờ","Ở","Ỡ","Ợ"), "O",$name_file);
        $name_file= str_replace(array("ý","ỳ","ỷ","ỹ","ỵ","Ý","Ỳ","Ỷ","Ỹ","Ỵ"), "y",$name_file);
        return $name_file; 
    }

    private function standardString($string){
        $temp= trim($string);

        if (strlen($temp) >1){
            $count=strlen($temp)-1;
            for ($i=0; $i<$count; $i++){
                if ($temp[$i] == " " && $temp[$i + 1] == " "){
                    $temp = substr($temp, 0, $i).substr($temp,$i+1, $count);
                    $i--;
                    $count=strlen($temp)-1;
                }
            }
        }

        //$temp = preg_replace("/[^a-zA-Z0-9]+/", "", $temp);

        return $temp;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if ($request->hasFile('content')){
            $sohieu = stripslashes($request->sohieu);
            if($sohieu == "" || $sohieu == null){
                return 0;
            }

            $coquan = stripslashes($request->coquan);
            if($coquan == "" || $coquan == null){
                return 0;
            }

            $nguoiky = stripslashes($request->nguoiky);
            if($nguoiky == "" || $nguoiky == null){
                return 0;
            }

            $date = stripslashes($request->date);
            if($date == "" || $date == null){
                return 0;
            }
              
            $title = stripslashes($request->title);
            if($title == "" || $title == null){
                return 0;
            }

            $description = stripslashes($request->description);
            if($description == "" || $description == null){
                return 0;
            }

            $secure = $request->secure;
            if($secure != 1 && $secure != 0){
                return 0;
            }          

            $typedoc_id = $request->typedoc_id;
            if ($typedoc_id == "" || $typedoc_id == null)  {
                return 0;
            }

            $test = TypeDocument::find($typedoc_id);

            if ($test == null || $test == false){
                return 0;
            }

            //lấy department của user hiện tại
            $user = Auth::user()->department_id;
            $department_user = Department::find($user)->alias;

            // create document with user current
            $document = new Document;
            $document->title = $title;
            
            //get name file
            $file = $request->file('content');
            $file_name = '[' . $department_user . ']' . ' ' . $file->getClientOriginalName();
            $file_name = $this->standardNameFile($file_name);

            //chuyển file sang folder
            $request->file('content')->move(base_path() . '/public/documents/', $file_name);

            $document->content =  $file_name;
            $document->description = $description;
            $document->is_public = $secure;
            $document->user_id = Auth::user()->id;
            $document->typedoc_id = $typedoc_id;
            $document->sohieu =  $sohieu;
            $document->date = $date;
            $document->nguoiky =  $nguoiky;
            $document->coquan =  $coquan;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $document->created_at = Carbon::now();
            $document->updated_at = Carbon::now();

            $document->save();

            app('App\Http\Controllers\LogController')->makeLog(6, array($title));
            return 1;
        }

        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        $content = $document->content;
        $extension = File::extension('documents/'. $content);

        if ($extension != 'pdf') {
            return response()->download('documents/'. $content);
        }

        return view('user.show_file', compact('document', 'extension'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id=null)
    {
        if ($id==null){
            return redirect("document");
        }

        $document = Document::find($id);

        if ($document == null || $document == false){
            return redirect("document");
        }

        if(Auth::user()->hasRole('manager') || Auth::user()->hasRole('admin') || (Auth::user()->hasRole('user') && $document->user_id == Auth::user()->id)){
            if (Auth::user()->hasRole('manager')){
                $catch =  DB::table('users')
                            ->join('departments', 'departments.id', '=', 'users.department_id')
                            ->select("users.name AS userName")
                            ->where('users.id', $document->user_id)
                            ->where('departments.id', Auth::user()->department_id)
                            ->get();

                if ($catch==null || $catch===false || count($catch)==0){
                    return redirect("document");
                }
            }

            $typedocument = TypeDocument::lists('name', 'id');

            return view('user.edit', compact('document', 'typedocument'));
        }

        return redirect("document");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        // need: description, name, id_type, secure

        if ($id==null){
            return -1;
        }

        $document = Document::find($id);

        if ($document == null || $document == false){
            return -1;
        }

        if (Auth::user()->hasRole('user') && $document->user_id != Auth::user()->id){
            return -1;
        }

        if(Auth::user()->hasRole('manager')){
            $catch =  DB::table('users')
                        ->join('departments', 'departments.id', '=', 'users.department_id')
                        ->select("users.name AS userName")
                        ->where('users.id', $document->user_id)
                        ->where('departments.id', Auth::user()->department_id)
                        ->get();

            if ($catch==null || $catch===false || count($catch)==0){
                return 0;
            }
        }

        $title = stripslashes($request->title);
        if($title == "" || $title == null){
            return 0;
        }

        $description = stripslashes($request->description);
        if($description == "" || $description == null){
            return 0;
        }

        $secure = $request->secure;
        if($secure != 1 && $secure != 0){
            return 0;
        }          

        $typedoc_id = $request->typedoc_id;
        if ($typedoc_id == "" || $typedoc_id == null)  {
            return 0;
        }

        $test = TypeDocument::find($typedoc_id);

        if ($test == null || $test == false){
            return 0;
        }

        $oldTitle = $document->title;

        $document->title = $title;
        $document->description = $description;
        $document->typedoc_id = $typedoc_id;
        $document->is_public = $secure;

        $document->save();

        app('App\Http\Controllers\LogController')->makeLog(7, array($oldTitle, $document->user_id));

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
            $document = Document::find($id);
            $document->delete();

            return redirect()->action('DocumentsController@index')
                ->with('success', trans('session.document_delete_success'));
        } catch(Exception $e) {
            return redirect()->action('DocumentsController@index')
                ->with('errors', trans('session.document_delete_fail'));
        }
    }

    public function dashboard() 
    {
        $allDoc= Document::all();
        $allDepartment = Department::all();
       
        foreach ($allDepartment as $item) {
            $item->countDoc = DB::table('departments')
                    ->join('users', 'users.department_id', '=', 'departments.id')
                    ->join('documents', 'documents.user_id', '=', 'users.id')
                    ->where('department_id', $item->id)
                    ->count();
        }

        return view('admin.dashboard', compact('allDoc', 'allDepartment'));
    }
}
