<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\CookieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

abstract class ApiController extends CookieController
{
    protected $user;
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->user = Auth::user();
    }


    public abstract function cast_to_model($input);

    public function create(Request $re) {
        
        // $obj = $this->cast_to_model(["a" => 321321321]);
        // return ($obj);
        // return ($this->user)   
        $model = $this->model;
        $doc = new $model();   
        $arr=[];
      
        foreach ($_POST as $key => $value) {
            if (in_array($key, $doc->getfillable() )) {
                $doc->$key = $value;
            }
        }
        $doc->save();
        array_push($arr, $doc);
        return response()->json($arr);
        
    }
    public function read() {

    }
    public function update() {

    }
    public function delete() {

    }

    public function getByPage($page) {
        // var_dump($user);
        return response()->json($this->model::getByPage($page, 1));
    }


    // public abstract function before_create();
    // public abstract function before_update();
    // public abstract function after_create();
    // public abstract function after_update();
}
