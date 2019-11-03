<?php
namespace App\Http\Controllers\Apis\Authentication;
use App\Http\Controllers\Apis\ApiController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class LoginController extends ApiController
{
    public function __construct() {
        $this->model = "App\Models\HocVien";
    }


    public function login(){      
        
        $doc = new $this->model ();
        $mahv="";
        $password="";
      
        if(array_key_exists("password",$_POST))
            $password=$_POST['password'];
        if(array_key_exists("mahv",$_POST))
            $mahv=$_POST['mahv'];
        // return $password . "====" . $mahv;
        return response()->json($doc->login($mahv, $password));//neu dang nhap thanh cong thi tra ve "success" 
        
    }


    function cast_to_model($input) {
        $obj = new $this->model($input);
        return $obj;
    }
}
