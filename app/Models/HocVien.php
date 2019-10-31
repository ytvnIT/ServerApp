<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hocvien extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "hocvien";
        $this->fillable = array_merge($this->fillable, array(
            'MAHV',
            'HO',
            'TEN',
            'NGSINH',
            'GIOITINH',
            'NOISINH',
            'MALOP',
        ));
    }
    public static function gethocvien($mahv) {
        return [
            'hocvien' => hocvien::where('MALOP', $mahv)
            ->get(),
        ];
    }
}

