<?php

namespace Botble\Miss\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Photo extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * @var array
     */
    protected $fillable = [
        'id_thi_sinh',
        'mo_ta',
        'sap_xep',
        'image',
        'deleted_at',
        'who',
        'ip_address',
        'device',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];
    public function thisinhs(): BelongsTo
    {
        return $this->belongsTo(Thisinh::class, 'id_thi_sinh', 'id');
    }

}
