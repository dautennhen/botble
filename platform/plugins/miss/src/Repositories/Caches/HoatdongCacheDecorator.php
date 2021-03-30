<?php

namespace Botble\Miss\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Miss\Repositories\Interfaces\HoatdongInterface;

class HoatdongCacheDecorator extends CacheAbstractDecorator implements HoatdongInterface
{
    public function getByTeam($id_team)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
