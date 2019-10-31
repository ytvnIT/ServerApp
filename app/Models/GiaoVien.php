<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiaoVien extends BaseModel
{public function __construct () {
    parent::__construct();

    $this->table = "giaovien";
    $this->fillable = array_merge($this->fillable, array(
        'MAGV',
        'HOTEN',
        'HOCVI',
        'HOCHAM',
        'GIOITINH',
        'NGSINH',
        'NGVL',
        'HESO',
        'MUCLUONG',
        'MAKHOA'
    ));
}
public static function gethocvien() {
    return [
        GiaoVien::get(),
        
    ];
}
}
