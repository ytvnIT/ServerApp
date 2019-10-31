<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    public function __construct () {
        parent::__construct();

        $this->table = "giangday";
        $this->fillable = array_merge($this->fillable, array(
            'MAKHOA',
            'TENKHOA',
            'NGTLAP',
            'TRGKHOA',
        ));
    }
    public static function gethocvien() {
        return [
            'hocvien' => giangday::where("MALOP","K11")->get(),
            
        ];
    }
}
