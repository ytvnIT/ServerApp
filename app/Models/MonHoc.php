<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "monhoc";
        $this->fillable = array_merge($this->fillable, array(
            'MAMH',
            'TENMH',
            'TCLT',
            'TCTH',
            'MAKHOA',
            
        ));
    }
    public static function gethocvien() {
        return [
            'hocvien' => giangday::where("MALOP","K11")->get(),
            
        ];
    }
}
