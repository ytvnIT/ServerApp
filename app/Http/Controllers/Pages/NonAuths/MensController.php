<?php

namespace App\Http\Controllers\Pages\NonAuths;

use App\Http\Controllers\Pages\NonAuthController;
use Illuminate\Http\Request;
use App\Models\Product;
class MensController extends NonAuthController
{
    public function __construct() {
        parent::__construct();
    }
    public function clothing ($page) {
        return $this->view("mens", Product::getByPage($page,1));
    }
    public function shoe ($page) {
        return $this->view("mens", Product::getByPage($page,2));
    }
    public function watch ($page) {
        return $this->view("mens", Product::getByPage($page,3));
    }
    public function bag ($page) {
        return $this->view("mens", Product::getByPage($page,4));
    }
    public function belt ($page) {
        return $this->view("mens", Product::getByPage($page,5));
    }
    public function accessories ($page) {
        return $this->view("mens", Product::getByPage($page,6));
    }

}
