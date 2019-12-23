<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class hocvien extends BaseModel
{
    private $options = [
        'cost' => 10
    ];
    public function __construct () {
        parent::__construct();
        $this->timestamps = false;
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
                return $this->Success($mahv);
                // return (int) 1;
            }
        }
        // return (int) 0;
        return $this->FAIL($mahv);
    }
    public function Success($mahv){
        $data = HocVien::select('HO','TEN', "ANH")->where('MAHV',$mahv)->first();
        $data->status="1";
        $data->TEN= $data->HO . " ".$data->TEN;
        unset($data->HO);
        return $data;
    }
    public function FAIL($mahv){
        $data = array('TEN'=>"", 'ANH' =>"", 'status'=>'0');

        return $data;
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
        HocVien::where('MAHV', $mahv)->update(['TOKEN' => $token, 'updated_at' => Carbon::now()]);
    }
    public static function setPassword($mahv, $password, $token){
        $self = new static;
        $password= password_hash($password, PASSWORD_BCRYPT, $self->options);

        $token2 = HocVien::select('TOKEN')->whereRaw("TIMEDIFF('" . Carbon::now('Asia/Ho_Chi_Minh') . "',updated_at)  <120 ")//now - updatee_at: đơn vị second
        ->where('MAHV', $mahv )
        ->first();

        if($token2==null)
            return 0;
        if (!password_verify($token, $token2->TOKEN)){
            return 0;
        }
        try {
            $result = HocVien::where('MAHV' , $mahv)->update(['PASSWORD' => $password, 'updated_at' => Carbon::now()]);
            if($result==1)
                HocVien::where('MAHV' , $mahv)->update(['TOKEN' => null, 'updated_at' => Carbon::now()]);
            return $result;

        } 
        catch (Illuminate\Database\QueryException  $ex) {
            dd($ex->getMessage()); 
        }        
    }
    public static function checkMac($mahv, $MAC){
        $now = Carbon::now();
        $MACTIME = HocVien::select("MACTIME")->where("MAHV", $mahv)->first()->MACTIME;
        //Trường hợp 1: User check in lần đầu, db chưa lưu mac, thì được pass luôn
        if($MACTIME==null)
        {
            HocVien::where("MAHV", $mahv)->update(['MAC' => $MAC , "MACTIME" => $now]);
            return '1';
        }
        //Trường hợp 1: User gửi MAC đúng với MAC trong db => pass luôn và update time
        if(HocVien::select("MAC")->where([["MAHV", $mahv], ["MAC", $MAC]])->first() != null){
            HocVien::where("MAHV", $mahv)->update(["MACTIME" => $now]);
            return '1';
        }
        $time = Carbon::createFromFormat("Y-m-d H:i:s", $MACTIME );
        $check = $now->diffInMinutes($time);
        //Trường hợp 3: User gửi sai MAC, nghĩa là đang dùng thiết bị khác => đơi 15m kể từ updated_at gần nhất thì mới được cập nhật lại địa chỉ MAC mới, rồi mới được pass
        if ($check>=1){
            HocVien::where("MAHV", $mahv)->update(['MAC' => $MAC , "MACTIME" => $now]);
            return '1'; 
        }
        //Trường hợp 4: Ngược lại với trường hợp 3, dưới 15m thì tèo
        return '5';   
    }
}

