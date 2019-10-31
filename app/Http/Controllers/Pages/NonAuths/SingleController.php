<?php

namespace App\Http\Controllers\Pages\NonAuths;

use App\Http\Controllers\Pages\NonAuthController;
use Illuminate\Http\Request;
use App\Models\DetailProduct;
class SingleController extends NonAuthController
{
    public function __construct() {
        parent::__construct();
    }
    //
    public function index ($id) {
        // $src=DetailProduct::select('src')->where('product_id',$id)->get()[0]['src'];
        $src=DetailProduct::where('product_id',$id)->get();
        echo $src;
        // $src=explode('@',$src);
        // $decription=DetailProduct::select('decription')->where('product_id',$id)->get()[0]['decription'];
        // $decription=explode('@',$decription);
        // $detail=DetailProduct::select('detail')->where('product_id',$id)->get()[0]['detail'];
        // $detail=explode('@',$detail);
        // echo $src[0];
        echo "dsfsd";
        // return $this->view("single",[
        //     'details'=>$detail,
        //     "srcs"=>$src,
        //     "decriptions"=>$decription
        // ]);
    }
}
