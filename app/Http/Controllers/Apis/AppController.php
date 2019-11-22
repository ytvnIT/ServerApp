<?php

namespace App\Http\Controllers\Apis;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MonHoc;
use App\Models\DiemDanh;
use \App\Models\DetailProduct;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use QrCode\QrCode;

class AppController extends ApiController
{
    private $options = [
        'cost' => 10
    ];
    public function __construct() {
        // $this->model = "App\Models\hocvien";
    }
    public function generateQR($MAMH){
        //1. Kiểm tra thời điểm muốn điểm danh có đúng TKB hay không?
        if(!$this->checkTime($MAMH))//Hàm trả true thì hợp lệ và cho phép tạo QR ngược lại reject
            return "toang rùi!!!!";

        //2. Tạo token, lưu db, tạo QR code
        $token = password_hash(rand(), PASSWORD_BCRYPT, $this->options);//token duoc hash voi chuoi theo format: MAHV + random_number
        $token .= "@" . $MAMH;
        MonHoc::where("MAMH", $MAMH)->update(["TOKEN" => $token]);//update token to db
        return QrCode::size(400)->generate($token);

    }
    public function diemDanh($TOKEN, $MAHV){
        $tokens = explode("@", $TOKEN);//split to get $MAMH
        $MAMH = end($tokens);

        $condition = [
            ['MAHV', '=', $MAHV],
            ['MAMH', '=', $MAMH]
        ];
        if($this->isCheckedIn($condition))
            return 2;
      
        $string = MonHoc::whereRaw("TIMEDIFF('" . Carbon::now('Asia/Ho_Chi_Minh') . "',updated_at)  <30000 ")//now - updatee_at: đơn vị second
        ->where([ ["MAMH", $MAMH], ["TOKEN", $TOKEN]])
        ->first();
        if($string =="")
            return 0; //fail 
        //lay ra thong tin cac lan diem danh truoc
       
        $diemDanh =  DB::table('diemdanh')
                        ->select("DIEMDANH")
                        ->where($condition)->get();
        if(count($diemDanh)==0)//kiểm tra xem sv có học lớp đó không?
           return 0;
        //append gia tri moi vao
        $diemDanh = $diemDanh[0]->DIEMDANH . "#" . now();    
        DiemDanh::where($condition)
            ->update(["DIEMDANH" => $diemDanh]);
        DiemDanh::where($condition)
            ->increment('SOBUOI');
        return 1; //succuss 
    }
    public function getGrade(){
        $mahv="";
        if(array_key_exists("mahv", $_GET)){
            $mahv=$_GET['mahv'];
        }
        return $mahv;
    }
    
    function cast_to_model($input) {
        $obj = new $this->model();
        return $obj;
    }

    public function isCheckedIn($condition){
        $updated_at = DiemDanh::select("updated_at")->where($condition)->first()->updated_at;
        if($updated_at==null)
            return false;
        $now = Carbon::now();
        $time = Carbon::createFromFormat("Y-m-d H:i:s", $updated_at );
        $check = $now->diffInMinutes($time);
        if ($check<1)
            return true; 
        return false;   
    }
    public function checkTime($MAMH){
        //KIỂM TRA THỨ
        $dayofWeek  = Carbon::now()->dayOfWeek; //Lấy thứ hiện tại
        $THU = (MonHoc::select("THU")->where("MAMH", $MAMH)->first())->THU-1; //Lấy thứ trên TKB
        if($dayofWeek != $THU ) //so sánh hợp lệ
            return false;

        //KIỂM TRA GIỜ HỌC
        $TIET = (MonHoc::select("TIET")->where("MAMH", $MAMH)->first()->TIET);//Lấy tiết của buổi học
        $startTime = Carbon::createFromFormat("H:i:s", $this->parseTime($TIET[0], "start") );//thời gian bắt đâu
        $finishTime = Carbon::createFromFormat("H:i:s", $this->parseTime($TIET[-1], "finish") );//thời gian kết thúc 
        
        $now = Carbon::now();//lấy thời gian hiện tại
        $now =  Carbon::createFromFormat("H:i:s", '13:31:00');
        
        $check1 = $now->diffForHumans($startTime);// return value of this line: Ex: 1 hour after
        $check2 = $now->diffForHumans($finishTime);

        if (stristr($check1, "after") and stristr($check2, "before"))
            return true;
        return false; 
    }


    function parseTime($session, $flag){
        switch($session){
            case 1: 
                if($flag=="start")
                    return "7:30:00";
                return "7:45:00";
            case 2:
                if($flag=="start")
                    return "8:15:00"; 
                return "9:00:00";
            case 3:
                if($flag=="start")  
                    return "9:00:00";
                return "9:45:00";
            case 4:
                if($flag=="start")
                    return "10:00:00";
                return "10:45:00";
            case 5: 
                if($flag=="start")
                    return "10:45:00";
                return "11:30:00";
            case 6: 
                if($flag=="start")
                    return "13:00:00";
                return "13:30:00";
            case 7:
                if($flag=="start")
                    return "13:45:00";
                return "14:30:00";
            case 8:
                if($flag=="start") 
                    return "14:30:00";
                return "15:15:00";
            case 9:
                if($flag=="start")
                    return "15:30:00";
                return "16:15:00";
            case 0:
                if($flag=="start")
                     return "16:15:00";
                return "17:00:00";
        }
    }

}
