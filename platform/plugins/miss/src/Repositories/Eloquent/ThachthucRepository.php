<?php

namespace Botble\Miss\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Miss\Repositories\Interfaces\ThachthucInterface;

class ThachthucRepository extends RepositoriesAbstract implements ThachthucInterface
{
    public function getThachThuc()
    {
        return $this->model->get();
    }
    public function getTeamById($id)
    {
        return $this->model->where('id',$id)->first();
    }
}
