<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemDanh extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "diemdanh";
        $this->fillable = array_merge($this->fillable, array(
            'MAHV',
            'MAMH',
            'MALOP',
            'DIEMDANH'
        ));
    }
    public static function gethocvien($mahv) {
        return [
            'diemdanh' => DiemDanh::where('MALOP', $mahv)
            ->get(),
        ];
    }
}

