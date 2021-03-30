<?php

namespace Botble\Miss\Repositories\Eloquent;

use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Botble\Miss\Repositories\Interfaces\ThisinhInterface;
use Theme\Missuniversity\Models\Voteall as Voteall;
use Illuminate\Pagination\Paginator;
use Request;
use Theme\Missuniversity\Models\Thisinh;

class ThisinhRepository extends RepositoriesAbstract implements ThisinhInterface
{
    public function getThiSinh()
    {

        return $this->model->get();
    }

    public function getAllThiSinh($perPage = 5)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_loai','1')
        ->orderBy('thisinhs.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    public function getAllThiSinh200($perPage = 5)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_top_200','1')
        ->orderBy('thisinhs.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    public function getAllThiSinh40($perPage = 5)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_top_40','1')
        ->orderBy('thisinhs.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    public function getAllThiSinh35($perPage = 5)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_top_35','1')
        ->orderBy('thisinhs.created_at', 'desc');

        return $this->applyBeforeExecuteQuery($data)->paginate($perPage);
    }

    public function getRandomThiSinh($limit = 10)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_loai','1')
        ->inRandomOrder()->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getRandomThiSinh200($limit = 10)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_top_200','1')
        ->inRandomOrder()->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getRandomThiSinh40($limit = 10)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_top_40','1')
        ->inRandomOrder()->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getRandomThiSinh35($limit = 10)
    {
        $data = $this->model->select('thisinhs.*')
        ->where('vong_top_35','1')
        ->inRandomOrder()->limit($limit);

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getByTruong($id_truong, $paginate = 5)
    {
        if (!is_array($id_truong)) {
            $id_truong = [$id_truong];
        }

        $data = $this->model
            ->join('truongs', 'truongs.id', '=', 'id_truong')
            ->whereIn('truongs.id', $id_truong)
            ->where('vong_loai','1')
            ->select('thisinhs.*')
            ->orderBy('thisinhs.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getByTruong200($id_truong, $paginate = 5)
    {
        if (!is_array($id_truong)) {
            $id_truong = [$id_truong];
        }

        $data = $this->model
            ->join('truongs', 'truongs.id', '=', 'id_truong')
            ->whereIn('truongs.id', $id_truong)
            ->where('vong_top_200','1')
            ->select('thisinhs.*')
            ->orderBy('thisinhs.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getByTruong40($id_truong, $paginate = 5)
    {
        if (!is_array($id_truong)) {
            $id_truong = [$id_truong];
        }

        $data = $this->model
            ->join('truongs', 'truongs.id', '=', 'id_truong')
            ->whereIn('truongs.id', $id_truong)
            ->where('vong_top_40','1')
            ->select('thisinhs.*')
            ->orderBy('thisinhs.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getByTruong35($id_truong, $paginate = 5)
    {
        if (!is_array($id_truong)) {
            $id_truong = [$id_truong];
        }

        $data = $this->model
            ->join('truongs', 'truongs.id', '=', 'id_truong')
            ->whereIn('truongs.id', $id_truong)
            ->where('vong_top_35','1')
            ->select('thisinhs.*')
            ->orderBy('thisinhs.created_at', 'desc');

        if ($paginate != 0) {
            return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
        }

        return $this->applyBeforeExecuteQuery($data)->get();
    }

    public function getById($id)
    {
        $data = $this->model
            ->where('thisinhs.id', $id)
            ->select('thisinhs.*');

        return $this->applyBeforeExecuteQuery($data)->first();
    }

    public function getVotedThisinh() {
        $member_id = $this->getMemberId();
        $items = Voteall::where([
           'member_id' => $member_id
        ])->get();
        $arr = [];
        foreach($items as $item) {
            $arr[] =  $item->thisinh_id;
        }
        return $arr;
    }

    public function getMemberId() {
        return \Session::get('login_member_59ba36addc2b2f9401580f014c7f58ea4e30989d');
    }

    public function search($paginate = 20) {
        $search_value = Request::input('search_value');
        $data = $this->model->whereRaw(' MATCH(ho, ten, so_bao_danh) AGAINST("'.$search_value.'" IN NATURAL LANGUAGE MODE)');
        return $this->applyBeforeExecuteQuery($data)->paginate($paginate);
    }


}
