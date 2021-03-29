<?php

namespace Botble\Miss\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Miss\Repositories\Interfaces\NamhocInterface;

class NamhocRepository extends RepositoriesAbstract implements NamhocInterface
{
    public function getNamHoc()
    {
        return $this->model->get();
    }
}
