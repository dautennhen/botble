<?php

namespace Botble\Miss\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Miss\Repositories\Interfaces\HoatdongInterface;

class HoatdongRepository extends RepositoriesAbstract implements HoatdongInterface
{
    public function getByTeam($id_team)
    {
        return $this->model->where('id_team', $id_team)->get();
    }
}
