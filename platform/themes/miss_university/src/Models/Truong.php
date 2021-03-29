<?php
namespace Theme\Missuniversity\Models;

use Eloquent;

class Truong extends Eloquent
{
    protected $table = 'truongs';

    /**
     * @var array
     */
    protected $fillable = [
        'ten_truong',
        'logo_truong',
        'status',
    ];
}