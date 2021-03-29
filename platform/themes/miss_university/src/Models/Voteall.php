<?php
namespace Theme\Missuniversity\Models;

use Eloquent;

class Voteall extends Eloquent
{
    protected $table = 'voteall';
    protected $fillable = [
        'id', 'member_id', 'thisinh_id', 'ipaddress', 'device'
    ];
}