<?php

namespace App\Http\Controllers\Apis;

use \App\Models\MainProduct;

class MainProductController extends ApiController
{

    public function __construct() {
        $this->model = "App\Models\Product";
    }

    //
    function cast_to_model($input) {
        $obj = new $this->model();
        return $obj;
    }

}
