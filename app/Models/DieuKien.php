<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DieuKien extends BaseModel
{
    public function __construct () {
        parent::__construct();

        $this->table = "dieukien";
        $this->fillable = array_merge($this->fillable, array(
            "MAMH",
            "MAMH_TRUOC"
        ));
    }
    public static function gethocvien() {
        return [
           DieuKien::get()
            
        ];
    }
}
