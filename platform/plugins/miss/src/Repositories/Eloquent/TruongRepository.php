<?php

namespace Botble\Miss\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Miss\Repositories\Interfaces\TruongInterface;

class TruongRepository extends RepositoriesAbstract implements TruongInterface
{
    public function getTruong()
    {
        return $this->model->get();
    }
}
