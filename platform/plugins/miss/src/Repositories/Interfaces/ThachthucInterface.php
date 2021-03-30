<?php

namespace Botble\Miss\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface ThachthucInterface extends RepositoryInterface
{
    public function getThachThuc();
    public function getTeamById($id);
}
