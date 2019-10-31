<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Support\Facades\Auth;

class AuthController extends ViewController {
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->user = Auth::user();
    }
    
}