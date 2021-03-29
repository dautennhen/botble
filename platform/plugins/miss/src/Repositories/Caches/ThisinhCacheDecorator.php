<?php

namespace Botble\Miss\Repositories\Caches;

use Botble\Support\Repositories\Caches\CacheAbstractDecorator;
use Botble\Miss\Repositories\Interfaces\ThisinhInterface;

class ThisinhCacheDecorator extends CacheAbstractDecorator implements ThisinhInterface
{
    public function getThiSinh()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getAllThiSinh($perPage = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getRandomThiSinh($limit = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getByTruong($id_truong, $paginate = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getAllThiSinh200($perPage = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getRandomThiSinh200($limit = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getByTruong200($id_truong, $paginate = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getAllThiSinh40($perPage = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getRandomThiSinh40($limit = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getByTruong40($id_truong, $paginate = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getAllThiSinh35($perPage = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getRandomThiSinh35($limit = 10)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getByTruong35($id_truong, $paginate = 5)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getById($id)
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function getVotedThisinh()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }
    public function search()
    {
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

}
