<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class hocvien extends BaseModel
{
    private $options = [
        'cost' => 10
    ];
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
            'PASSWORD',
            'EMAIL',
            'TOKEN',
            
        ));
    }
    public static function gethocvien($mahv) {
        return [
            'hocvien' => hocvien::where('MALOP', $mahv)
            ->get(),
        ];
    }

    public function login($mahv, $password){
        try {
            $data=HocVien::where('MAHV',$mahv)->first();//sau khi select du lieu nay dang [{}] 
        } 
        catch (Illuminate\Database\QueryException  $ex) {
            dd($ex->getMessage()); 
        }
        
        if($data==null)
            return 'fail';
        $hocvien=$this->castToModel($data, $this);//cast thanh user model
        
        if (!is_null($hocvien)) {
            if (password_verify($password, $hocvien->PASSWORD)) {
               return "success";
            }
        }
        return 'fail';
    }

    public static function getMail($mahv){

        try {
            $data=HocVien::select('EMAIL')-> where('MAHV',$mahv)->first();//sau khi select du lieu nay dang [{}] 
        } 
        catch (Illuminate\Database\QueryException  $ex) {
            dd($ex->getMessage()); 
        }
        // if($data!=null)
        return $data;
        // return null;
    }

    public static function setToken($mahv, $token){
        $self = new static;
        $token = password_hash($token, PASSWORD_BCRYPT, $self->options);
        HocVien::where('MAHV', $mahv)->update(['TOKEN' => $token]);
    }
    public static function setPassword($mahv, $password, $token){
        $self = new static;
        $password= password_hash($password, PASSWORD_BCRYPT, $self->options);
        $token2 = HocVien::select('TOKEN')->where('MAHV', $mahv )->first();
        if($token2==null)
            return 0;
        if (!password_verify($token, $token2->TOKEN)){
            return 0;
        }
        try {
            $result = HocVien::where('MAHV' , $mahv)->update(['PASSWORD' => $password]);
            if($result==1)
                HocVien::where('MAHV' , $mahv)->update(['TOKEN' => null]);
            return $result;

        } 
        catch (Illuminate\Database\QueryException  $ex) {
            dd($ex->getMessage()); 
        }        
    }
}

