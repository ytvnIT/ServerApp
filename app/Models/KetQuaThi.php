<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetQuaThi extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "ketquathi";
        $this->fillable = array_merge($this->fillable, array(
            'MAHV',
            'MAMH',
            'LANTHI',
            'NGTHI',
            'DIEM',
            'KQUA',
        ));
    }
    public static function gethocvien() {
        return [
            'hocvien' => giangday::where("MALOP","K11")->get(),
            
        ];
    }
}
