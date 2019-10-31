<?php

namespace App\Http\Controllers\Pages\NonAuths;

use App\Http\Controllers\Pages\NonAuthController;
use Illuminate\Http\Request;
class ContactController extends NonAuthController
{
    public function __construct() {
        parent::__construct();
    }
    //
    public function index () {
        return $this->view("contact");
    }
}
