<?php

namespace Theme\Missuniversity\Repositories;

use Theme\Missuniversity\Models\Thisinh;
//use Botble\Miss\Models\Truong;
//use Botble\Miss\Models\Namhoc;
use Theme\Missuniversity\Models\Truong;
use Theme\Missuniversity\Models\Namhoc;
use Validator;
use Request;

class ThisinhRepo {

    public function __construct() {
        $this->commonRepo = new \Theme\Missuniversity\Repositories\Common();
    }

    function register($request) {
        $ngay_sinh = $request->year . '-' . $request->month . '-' . $request->date;
        if (empty($request->year) || empty($request->month) || empty($request->date))
            $ngay_sinh = '';
        $request->merge([
            'ip_address' => $this->commonRepo->getIp(),
            'device' => $request->header('User-Agent'),
            'full_name' => $request->ho . ' ' . $request->ten,
            'ngay_sinh' => $ngay_sinh,
            'tuoi' => (int) date("Y") - (int) $request->year
        ]);
        $validator = Validator::make($request->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            return redirect('thisinh/dang-ki-tham-du')
                            ->withErrors($validator)
                            ->withInput();
        }
        $id = (int)$request->input('id_ts');
        if ($id == 0) {
            $result = Thisinh::create($request->all());
            $result->so_bao_danh = $result->id;
            $result->vong_loai = 0;
            $result->id_member = $this->commonRepo->getMemberId();
            $result->save();
            return $result->id;
        } else {
            $item = Thisinh::find($id);
            $item->update($request->all());
            return $id;
        }
    }

    public function updateInfo($request) {
        $id = (int) $request->id;
        $video = $request->video;
        $ly_lich = clean($request->mo_ta_ly_lich);
        $item = Thisinh::find($id);
        $item->video = $video;
        $item->mo_ta_ly_lich = $ly_lich;
        $item->vong_loai = 1;
        return $item->save();
    }

    public function uploadImage($imageFolder, $inputname) {
        $id = Request::input('id');
        $rename = 'thisinh-' . $id . '-' . $inputname;
        $result = $this->commonRepo->uploadImage($imageFolder, $inputname, $rename);
        $db_img = str_replace("-", "_", $inputname);
        $item = Thisinh::find($id);
        $item->$db_img = $result;
        $item->save();
        return $result;
    }

    public function checkIfMemberRegistered() {
        $member_id = $this->commonRepo->getMemberId();
        if(empty($member_id))
            return false;
            //Tạm thời mở cho nó đăng ký, khi nào ổn định cái vụ hình thì đóng lại
         return Thisinh::where([
                    'id_member' => $member_id,
                    'vong_loai' => 1
                 ])->first();
    }
    
    public function getMemberRegisterProcessing() {
        $member_id = $this->commonRepo->getMemberId();
         $item = Thisinh::where([
                    'id_member' => $member_id,
                    'vong_loai' => 0
                 ])->first();
         return (is_null($item))? [] : $item->toArray();
    }
    
    static public function optionTruong($selected=''){
        $str = '';
        $items = Truong::all();
        foreach($items as $item) {
            $selectedItem = ($selected==$item->id) ? 'selected' : '';
            $str = $str . '<option value="'.$item->id.'" '. $selectedItem .' >'.$item->ten_truong.'</option>';
        }
        return $str;
    }
    
    static public function optionNamhoc($selected=''){
        $str = '';
        $items = Namhoc::all();
        foreach($items as $item) {
            $selectedItem = ($selected==$item->id) ? 'selected' : '';
            $str = $str . '<option value="'.$item->id.'" '. $selectedItem .' >'.$item->ten_nam_hoc.'</option>';
        }
        return $str;
    }

}



