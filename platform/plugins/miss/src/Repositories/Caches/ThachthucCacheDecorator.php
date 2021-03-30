<?php

namespace Botble\Miss\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Miss\Repositories\Interfaces\ThachthucInterface;

class ThachthucCacheDecorator extends CacheAbstractDecorator implements ThachthucInterface
{
    public function getThachThuc()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getTeamById($id)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
