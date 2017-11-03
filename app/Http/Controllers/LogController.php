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

class LogController extends Controller
{
    public function makeLog($type, $list_var){
        $IP = app('App\Http\Controllers\HandleAllCaller')->get_client_ip();
        $user = Auth::user()->name." (".Auth::user()->username.") đã ";
        if ($type == 1){
            $content = $user."tham gia hệ thống";
        }else if ($type == 2){
            $content = $user."thêm phòng ban: ".$list_var[0]." (". $list_var[1] .")";
        }else if ($type == 3){
            $content = $user."sửa thông tin phòng ban: ".$list_var[0]." (". $list_var[1] .")";
        }else if ($type == 4){
            $content = $user."xóa tài liệu: ".$list_var[0]." (đăng bởi ". User::find($list_var[1])->name .")";
        }else if ($type == 5){
            $temp = "";

            foreach ($list_var as $ele){
                $temp .= (Document::find($ele)->title."\n");
            }

            $content = $user."xóa ".count($list_var)." tài liệu: \n".$temp;
        }else if ($type == 6){
            $content = $user."thêm tài liệu mới: ".$list_var[0];
        }else if ($type == 7){
            $content = $user."sửa tài liệu: ".$list_var[0]." (đăng bởi ". User::find($list_var[1])->name .")";
        }else if ($type == 8){
            $content = $user."sửa thông tin loại tài liệu: ".$list_var[0];
        }else if ($type == 9){
            $content = $user."thêm loại tài liệu mới: ".$list_var[0];
        }else if ($type == 10){
            $content = $user."xóa loại tài liệu: ".$list_var[0];
        }else if ($type == 11){
            $content = $user."sửa thông tin người dùng: ".$list_var[0];
        }else if ($type == 12){
            $content = $user."thêm người dùng mới: ".$list_var[0]." (phòng ".Department::find($list_var[1])->name.")";
        }else if ($type == 13){
            $content = $user."cập nhật thông tin cá nhân";
        }else if ($type == 14){
            $content = $user."cập nhật mật khẩu";
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created_at = Carbon::now();

        DB::table('log')->insert(['IP'=>$IP, 'content'=>$content, 'id_owner'=>Auth::user()->id, 'create_at'=>$created_at]);
    }  

    public function index(){
        return view("admin.log.index");
    }

    private function standardTime($date_time){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dt = date_create($date_time);

        return date_format($dt, "H:i:s")." ngày ". date_format($dt, "d-m-Y");
    }

    public function getDataForLogPage(){
        $data = DB::table("log")->orderBy('create_at', 'DESC')->get();

        if ($data == null || $data == false || count($data) == 0){
            return json_encode(array());
        }
        for ($i=0; $i<count($data); $i++){
            $data[$i]->time = $this->standardTime($data[$i]->create_at);
        }

        return json_encode($data);
    }

    private function validateDate($date, $str)
    {
        $d = DateTime::createFromFormat($str, $date);
        return $d && $d->format($str) === $date;
    }

    public function deleteLogFromTo(Request $R){
        $from = json_decode($R->from);
        $to = json_decode($R->to);

        if ($from!=null && $from!="" && count($from) > 2){
            $from = $from[0]."-".$from[1]."-".$from[2];

            if (!$this->validateDate($from, 'Y-n-j')){
                return -2;
            }
        }else{
            $from = "10-10-10";
        }

        if ($to!=null && $to!="" && count($to) > 2){
            $to = $to[0]."-".$to[1]."-".$to[2];

            if (!$this->validateDate($to, 'Y-n-j')){
                return -2;
            }
        }else{
            $to = "3010-10-10";
        }   

        DB::table('log')->where('create_at', ">=", $from)->where("create_at", '<=', $to)->delete();

        echo 1;

    }   

    public function deleteAllLog(){
        DB::table('log')->delete();

        echo 1;
    }
}
