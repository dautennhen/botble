<?php

namespace Botble\Miss\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Thachthuc extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thachthucs';

    /**
     * @var array
     */
    protected $fillable = [
       'ten_team',
       'huan_luyen_vien',
       'ts1',
       'ts2',
       'ts3',
       'ts4',
       'ts5',
       'ts6',
       'ts7',
       'ts8',
       'image',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
