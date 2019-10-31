<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\CookieController;

class ViewController extends CookieController
{
    
    public function __construct() { 
        parent::__construct();
    }
    
    //
    protected function view(string $viewName, array $viewParams = []) {
        $defautParams = [
            "url" => $this->urlUtil,
            "title" => "Core PHP - Laravel"
        ];
        return view($viewName, array_merge($defautParams, $viewParams));
    }

    //
    protected function dump($obj) {
        echo "<pre>";
        var_dump($obj);
        echo "</pre>";
    }
}