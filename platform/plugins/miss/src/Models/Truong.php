<?php

namespace Botble\Miss\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Truong extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'truongs';

    /**
     * @var array
     */
    protected $fillable = [
        'ten_truong',
        'logo_truong',
        'status',
    ];

    public function thisinhs()
    {
        return $this->hasMany(Thisinh::class, 'id', 'id_truong');
    }

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
}
