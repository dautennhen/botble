<?php

namespace Botble\Miss\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Miss\Repositories\Interfaces\TruongInterface;

class TruongCacheDecorator extends CacheAbstractDecorator implements TruongInterface
{
    public function getTruong()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
}
