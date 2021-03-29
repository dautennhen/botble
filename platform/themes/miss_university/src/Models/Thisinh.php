<?php

namespace Theme\Missuniversity\Models;

use Eloquent;

class Thisinh extends Eloquent
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thisinhs';

    /**
     * @var array
     */
    protected $fillable = [
        'mssv',
        'id_truong',
        'id_nam_hoc',
        'so_bao_danh',
        'ho',
        'ten',
        'full_name',
        'dia_chi',
        'sdt_nguoi_than',
        'khoa_nganh',
        'can_nang',
        'mo_ta_ly_lich',
        'sdt',
        'email',
        'avatar',
        'video',
        'tuoi',
        'chieu_cao',
        'so_do_ba_vong',
        'que_quan',
        'ngay_sinh',
        'luot_xem_profile',
        'luot_bau_chon',
        'luot_chia_se_fb',
        'luot_chia_se_khac',
        'deleted_at',
        'who',
        'ip_address',
        'device',
        'vong_1',
        'vong_2',
        'vong_loai',
        'id_member',
        'created_at',
        'updated_at',
    ];
    
}
