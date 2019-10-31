<?php

namespace App\Http\Controllers\Apis;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use \App\Models\DetailProduct;

class DetailController extends ApiController
{
    public function __construct() {
        $this->model = "App\Models\hocvien";
    }


    function cast_to_model($input) {
        $obj = new $this->model();
        return $obj;
    }
    public function getDetail($id) {
        return response()->json($this->model::gethocvien($id));
        
    }
    public function getGD() {
        // return response()->json("App\Models\giangday"::gethocvien());
        return response()->json(DB::table('giangday')->get());
    }
    public function get(){
        return response()->json("App\Models\giaovien"::gethocvien());
    }
    public function getDD() {
        $dd=DB::table('hocvien')
        ->join('giangday','giangday.MALOP','=','hocvien.MALOP')
        ->select('MAHV','MAMH','giangday.MALOP')
        ->get();
        return response()->json($dd);
    }
    public function insert(){
        $MAHV='';
        $MAMH='';
        $MALOP='';
        $NGAY='';
        
        foreach($_GET as $key=>$value){
            if($key=='MAHV')
                $MAHV=$value;
            if($key=='MAMH')
                $MAMH=$value;
            if($key=='MALOP')
                $MALOP=$value;  
            if($key=='NGAY')
                $NGAY=$value; 
        }
       
        $dd=DB::table('diemdanh')->insert(
            ['MAHV' => $MAHV,
             'MAMH' => $MAMH,
             "MALOP"=>$MALOP,
             "NGAYTHANG"=>$NGAY]
        );
        return response()->json("Thanh cong");
    }


}
