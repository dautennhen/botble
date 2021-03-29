<?php

namespace Botble\Miss\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;

interface ThisinhInterface extends RepositoryInterface
{
    public function getThiSinh();

    public function getAllThiSinh($perPage = 5);
    public function getRandomThiSinh($limit = 10);
    public function getByTruong($id_truong, $paginate = 5);

    public function getAllThiSinh200($perPage = 5);
    public function getRandomThiSinh200($limit = 10);
    public function getByTruong200($id_truong, $paginate = 5);

    public function getAllThiSinh40($perPage = 5);
    public function getRandomThiSinh40($limit = 10);
    public function getByTruong40($id_truong, $paginate = 5);

    public function getAllThiSinh35($perPage = 5);
    public function getRandomThiSinh35($limit = 10);
    public function getByTruong35($id_truong, $paginate = 5);
    
    public function getById($id);
}
