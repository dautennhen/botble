<?php
namespace Theme\Missuniversity\Models;

use Eloquent;

class Namhoc extends Eloquent
{
    protected $table = 'namhocs';

    /**
     * @var array
     */
    protected $fillable = [
        'ten_nam_hoc',
        'status',
    ];
}