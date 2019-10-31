<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiangDay extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "giangday";
        $this->fillable = array_merge($this->fillable, array(
            'MALOP',
            'MAMH',
            'MAGV',
            'HOCKY',
            'NAM',
            'TUNGAY',
            'DENNGAY',
        ));
    }
    public static function gethocvien() {
        return [
            GiangDay::get(),
            
        ];
    }

}
