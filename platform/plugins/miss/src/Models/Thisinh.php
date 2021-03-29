<?php

namespace Botble\Miss\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Theme\Missuniversity\Models\Voteall;
use DB;
use RvMedia;
use Html;

class Thisinh extends BaseModel
{
    use EnumCastable;
    // protected $id_avatar;

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
        'created_at',
        'updated_at',
        'dia_chi',
        'khoa_nganh',
        'sdt_nguoi_than',
        'ho_ten_me',
        'ho_ten_cha',
        'avatar_toan_than_1',
        'avatar_toan_than_2',
        'ban_scan',
        'vong_loai',
        'vong_top_200',
        'vong_top_40',
        'vong_top_35',
        'can_nang',
        'anh_1',
        'anh_2',
        'anh_3',
        'anh_4',
        'anh_5',
        'id_member',
    ];
    public function namhocs(): BelongsTo
    {
        return $this->belongsTo(Namhoc::class, 'id_nam_hoc', 'id');
    }

    public function truongs(): BelongsTo
    {
        return $this->belongsTo(Truong::class, 'id_truong', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'id_thi_sinh', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Voteall::class, 'thisinh_id', 'id');
    }
    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    public function getTruong($id_truong)
    {
        switch ($id_truong)
        {
            case 1:
                return "Đại Học Công Nghệ Miền Đông";
                break;
            case 2:
                return "Đại Học Hoa Sen";
                break;
            case 3:
                return "Đại Học Quốc Tế Hồng Bàng";
                break;
            case 4:
                return "Đại Học Gia Định";
                break;
            case 5:
                return "Đại Học Bà Rịa - Vũng Tàu";
                break;
        }
    }
    public function getNamHoc($id_nam_hoc)
    {
        switch ($id_nam_hoc)
        {
            case 2:
                return "Năm nhất";
                break;
            case 3:
                return "Năm hai";
                break;
            case 4:
                return "Năm ba";
                break;
            case 5:
                return "Năm tư";
                break;
        }
    }

    public function getInformation($id)
    {
        $data=Thisinh::where('id',$id)->first();
        // dd($data);
        if($data->id_member!=null)
        {
            $info=DB::table('members')->where('id',$data->id_member)->first();
            // dd( $info);
            if($info!=null)
            {
                if($info->facebook!=null)
                {
                    return $info->avatar_id;
                }
                else
                {
                    return "mailto:".$info->email;
                }
            }

        }
        return null;
    }

    public function showAvatar($id_avatar)
    {
        $av=DB::table('media_files')->where('id',$id_avatar)->first();
        // dd($id_avatar);
        return '<img src="'.url('storage/'.$av->url).'" alt="Avatar" class="br-100" style="width: 70px;">';
    }

}
