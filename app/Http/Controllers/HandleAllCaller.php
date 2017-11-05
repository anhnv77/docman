<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Redirect;
use DB;
use Hash;
use App\User;
use App\Department;

use Carbon\Carbon;

class HandleAllCaller extends Controller
{
    public function get_client_ip() {
        $ipaddress =    getenv('HTTP_CLIENT_IP')?:
                        getenv('HTTP_X_FORWARDED_FOR')?:
                        getenv('HTTP_X_FORWARDED')?:
                        getenv('HTTP_FORWARDED_FOR')?:
                        getenv('HTTP_FORWARDED')?:
                        getenv('REMOTE_ADDR');

        return $ipaddress;
    }
    
    public function parseTime($datetime){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $now = Carbon::now();

        $interval = date_diff(date_create($datetime), $now);

        $year = $interval->format("%y");

        $month = $interval->format("%m");

        $day = $interval->format("%a");

        $hour = $interval->format("%h");

        $minute = $interval->format("%i");

        $second = $interval->format("%s");

        $kill = "";

        if ($day==0){
            if ($minute==0){
                $kill .= ($second." giây ");
            }else if ($hour == 0){
                $kill .= ($minute." phút ");
            }else{
                $kill .= ($hour." giờ ");
            }
        }else if ($day < 31){
            $kill .= ($day." ngày ");
        }else if ($day < 365){
            $kill .= ($month." tháng ");
        }else{
            $kill .= ($year." năm ");
        }

        $kill.="trước";

        return $kill;
    }

    public function standardString($string){
        $string = str_replace("&nbsp;", " ", $string);

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

    public function character_limiter($str, $n = 500, $end_char = '&#8230;')
    {
        $str = $this->standardString($str);
        if (strlen($str) < $n)
        {
            return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
        {
            return $str;
        }

        $out = "";
        $temp_out = "";
        
        foreach (explode(' ', trim($str)) as $val)
        {
            $temp_out .= $val.' ';

            if (strlen($temp_out) <= $n){
                $out=$temp_out;
            }else{
                return $out;
            }

            if (strlen($out) == $n)
            {
                $out = trim($out);
                return $out;
            }
        }
    }

    // Check sv
    // private function authldap($username,$password){
    //     //authen with LDAP
    //     $server="10.10.0.220";        //change to ip address of ldap server
    //     #$basedn=" ou=dhcn,ou=canbo,dc=vnu,dc=vn";   
    //     $basedn="ou=chinhquy,ou=sinhvien,ou=dhcn,ou=sinhvien,dc=vnu,dc=vn";
    //     $dn = "cn=admin, ";
    //     $pass="13579";
    //     $attributes = array("cn", "uid","userpassword");
    //     if (!($connect = ldap_connect($server))) {
    //         $this->flash->error("Could not connect to LDAP server");
    //         if (!($bind = ldap_bind($connect, "$dn" . "$basedn", $pass))) {
    //             $this->flash->error("Could not bind to $dn$basedn");
    //         }
    //      }else{
                    
    //         $filter="uid=$username";
    //         $sr = ldap_search($connect,$basedn,$filter,$attributes);
    //         $info = ldap_get_entries($connect, $sr);
    //         if ($info != null && count($info) > 0  && $info['count'] != 0) { 
    //             if (@ldap_bind( $connect, $info[0]['dn'], $password) ) {
    //                 return true;
    //             }else
    //                 return false;
    //         }   
    //         return false;
            
    //     }               
    // }

    // check cb:

    private function authldapCB($username,$password){
        //authen with LDAP
        $server="10.10.0.220";        //change to ip address of ldap server
        $basedn=" ou=dhcn,ou=canbo,dc=vnu,dc=vn";
        # $basedn="ou=chinhquy,ou=sinhvien,ou=dhcn,ou=sinhvien,dc=vnu,dc=vn";
        $dn = "cn=admin, ";
        $pass="13579";
        $attributes = array("cn", "uid","userpassword");
        if (!($connect = ldap_connect($server))) {
            $this->flash->error("Could not connect to LDAP server");
            if (!($bind = ldap_bind($connect, "$dn" . "$basedn", $pass))) {
                $this->flash->error("Could not bind to $dn$basedn");
            }
        }else{

            $filter="uid=$username";
            $sr = ldap_search($connect,$basedn,$filter,$attributes);
            $info = ldap_get_entries($connect, $sr);
            if ($info != null && count($info) > 0 && $info['count'] != 0) {
                if (@ldap_bind( $connect, $info[0]['dn'], $password) ) {
                    return true;
                }else
                    return false;
            }
            return false;

        }
    }

    public function submitLoginForm(Request $R){
        if ($R->username == "" || $R->password == ""){
            return redirect('/login')->with('message', '1');
        } 

        $username = $R->username;
        $password = $R->password;
        $default_pass = "qa#@2016";

        if (DB::table('users')->where('username', $username)->where('type', 0)->count() > 0){
            $auth= array('username' => $username, 'password' => $password);
        }else{
            $check_CB = $this->authldapCB($username,$password);

            if (!$check_CB){
                return redirect('/login')->with('message', '2');
            }else{
                $count = User::where('username', $username)->count();

                if ($count == 0){

                    $arr = array('username' => $username, 'password' => Hash::make($default_pass), 'type' => 1);

                    User::create($arr);
                }

                $auth= array('username' => $username, 'password' => $default_pass);
            }
        }

        $remember=false;
                
        if (!Auth::attempt($auth, $remember)){
            return redirect('/login')->with('message', '2');
        }else{
            $online = Auth::user();

            if ($online->status == 0){
                Auth::logout();
                return redirect('/login')->with('message', '3');
            }else{
                if($online->hasRole('admin')) {
                    return redirect()->intended('/admin/dashboard');
                }
                
                return redirect()->intended('/document');
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function goHome() {
        $online = Auth::user();

        if (($online != null && $online != false) && ($online->name == null || $online->name == "" || $online->email == null || $online->email == "" || $online->department_id == null || $online->department_id == "")){
            $needInfo = 1;
            $departmentList = Department::select('name', 'id')->get();
            $oldName = ($online->name == null || $online->name == "" ? "" : $online->name);
            $oldEmail = ($online->email == null || $online->email == "" ? "" : $online->email);
            $oldDepartment = ($online->department_id == null || $online->department_id == "" ? "" : $online->department_id);

            return view('welcome_page', compact('needInfo', 'departmentList', 'oldName', 'oldEmail', 'oldDepartment'));
        }

        return view('welcome_page');
    }

    public function submitAddInfo(Request $R){

        $online = Auth::user();

        if ($online==null || $online==false){
            return -1;
        }

        if ($online->name == null || $online->name == "" || $online->email == null || $online->email == "" ){
            
            $name = stripcslashes($R->name);
//            $department_id = stripcslashes($R->department);
            $email = stripcslashes($R->email);

            if ($name == null || $name == "" || $email == null || $email == ""  ){
                
                return -1;

            }   


            $online->name = $name;
            $online->email = $email;
//            $online->department_id = $department_id;

            $online->save();

            app('App\Http\Controllers\LogController')->makeLog(1, array());

            return 1;
        }

        return -3;
    }
}
