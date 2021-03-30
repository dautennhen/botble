<?php

namespace Botble\Miss\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface HoatdongInterface extends RepositoryInterface
{
    public function getByTeam($id_team);
}
