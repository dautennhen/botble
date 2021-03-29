<?php

namespace Theme\Missuniversity\Repositories;

use Botble\Member\Http\Controllers\LoginController;
use Botble\Miss\Models\Thisinh;
use Theme\Missuniversity\Models\Voteall as Voteall;
use Validator;
use Session;
use DB;

class Vote{

    public function __construct() {
        $this->commonRepo = new \Theme\Missuniversity\Repositories\Common();
    }

    function doVote($request) {
        $member_id = Session::get('login_member_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $thisinh_id = $request->input('thisinh_id');
        $ip = $this->commonRepo->getIp();
        $count_member = Voteall::where('member_id', $member_id)
                ->whereDate('created_at', date("Y-m-d"))
                ->count(); //mỗi member chọn dc 5 thí sinh.
        if(empty($member_id))
            return "";
        if ($member_id != '' && $count_member >= 5)
            return ['votedover' => 1];
        $count_ip = Voteall::where('ipaddress', $ip)->count(); //quá 50 ip trùng ko cho vote
        if ($count_ip >= 50)
            return ['mess' => '##'];
        $data = [
            'member_id' => $member_id,
            'thisinh_id' => $thisinh_id,
            'ipaddress' => $ip,
            'device' => $request->header('User-Agent'),
        ];
        $validator = Validator::make($data, $request->rules(), $request->messages());
        if ($validator->fails()) {
            return $validator->errors();
        }
        $item = Voteall::where([
                    'member_id' => $member_id,
                    'thisinh_id' => $thisinh_id
                ])->count();
        if (!empty($item))
            return '';
        Voteall::create($data);
        $ts = Thisinh::find($thisinh_id);
        $ts->update(['luot_bau_chon' => $ts->luot_bau_chon + 1]);
        return ['voted' => 1, 'session' => -1];
    }

    public function doVoteDis($request) {
        // dd($request->all());exit;
        $member_id = Session::get('login_member_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $check_vote = Voteall::where('member_id', $member_id)->where('thisinh_id', $request->thisinh_id)->first();
        $count_member = Voteall::where('member_id', $member_id)->count(); //mỗi member chọn dc 5 thí sinh.
        if ($member_id != '' && $count_member >= 6 || isset($check_vote)) {
            return ['mess' => '!!', 'id_member' => $member_id]; //Disabled nut'
        }
    }

}
