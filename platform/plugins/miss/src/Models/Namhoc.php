<?php

namespace Botble\Miss\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Namhoc extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'namhocs';

    /**
     * @var array
     */
    protected $fillable = [
        'ten_nam_hoc',
        'status',
    ];

    public function thisinhs()
    {
        return $this->hasMany(Thisinh::class, 'id', 'id_nam_hoc');
    }

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    
}
