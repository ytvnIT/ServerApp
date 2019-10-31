<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lop extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "lop";
        $this->fillable = array_merge($this->fillable, array(
            'MALOP',
            'TENLOP',
            'TRGLOP',
            'SISO',
            'MAGVCN',
        ));
    }
    public static function gethocvien() {
        return [
            'hocvien' => giangday::where("MALOP","K11")->get(),
            
        ];
    }
}
