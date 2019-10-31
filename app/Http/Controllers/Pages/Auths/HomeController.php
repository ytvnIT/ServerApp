<?php

namespace App\Http\Controllers\Pages\Auths;

use Illuminate\Http\Request;
use App\Http\Controllers\Pages\AuthController;
use App\Models\Product;
class HomeController extends AuthController
{

    public function index()
    {
        return $this->view('home');
    }
}
