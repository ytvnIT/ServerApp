<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\UrlUtil;

class CookieController extends Controller
{
    //
    
    protected $urlUtil; 
    public function __construct() { 
        // parent::__construct();
        $this->urlUtil = new UrlUtil();
    }
    
}
