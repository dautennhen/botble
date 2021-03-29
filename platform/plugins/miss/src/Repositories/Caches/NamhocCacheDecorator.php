<?php

namespace Botble\Miss\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Miss\Repositories\Interfaces\NamhocInterface;

class NamhocCacheDecorator extends CacheAbstractDecorator implements NamhocInterface
{
    public function getNamHoc()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
