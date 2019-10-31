<?php
namespace App\Http\Controllers\Apis\Authentication;
use App\Http\Controllers\Apis\ApiController;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class RegisterController extends ApiController
{
    public function __construct() {
        $this->model = "App\Models\User";
    }

    public function index(Request $re){      
        return response()->json(["name" => $re->name, "password"=>$re->password]);
    }

    function cast_to_model($input) {
        $obj = new $this->model($input);
        return $obj;
    }
}
