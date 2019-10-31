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
            'PASSWORD'
        ));
    }
    public static function gethocvien($mahv) {
        return [
            'hocvien' => hocvien::where('MALOP', $mahv)
            ->get(),
        ];
    }

    public function login($mahv, $password){
        
        $data=HocVien::where('MAHV',$mahv)->get();//sau khi select du lieu nay dang [{}] 
        $hocvien=$this->castToModel($data, $this);//cast thanh user model
        if (!is_null($user)) {
            if (password_verify($password, $user->password)) {
               return "success";
            }
        }
        return 'fail';
    }
}

