<?php

namespace Theme\Missuniversity\Http\Controllers;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Miss\Models\Thisinh;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Theme;

use Theme\Missuniversity\Models\Post as Post;

class MissController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function __construct() {
        $this->commonRepo = new \Theme\Missuniversity\Repositories\Common();
        $this->thisinhRepo = new Theme\Missuniversity\Repositories\ThisinhRepo();
    }

    public function getIndex()
    {
        return parent::getIndex();
    }

    /**
     * {@inheritDoc}
     */
    public function getView($key = null)
    {
        //return dd(1);
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $slug = $uriSegments[1];
        if(($slug == 'dang-ki-du-thi')) {
           $member_id = $this->commonRepo->getMemberId();
           if(empty($member_id))
                return redirect('/login');
           $thisinh = $this->thisinhRepo->checkIfMemberRegistered();
           if($thisinh)
               return redirect('/chi-tiet-thi-sinh?id='.$thisinh->id);
        } else if(($slug == 'chi-tiet-thi-sinh') ) {
            $id_thisinh=$_GET["id"];
            $ts = Thisinh::find($id_thisinh);
            if($ts!=null)
                $ts->update(['luot_xem_profile' => $ts->luot_xem_profile + 1]);
        }
        return parent::getView($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }

    /**
     * Search post
     *
     * @bodyParam q string required The search keyword.
     *
     * @group Blog
     *
     * @param Request $request
     * @param PostInterface $postRepository
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws FileNotFoundException
     */
    public function getSearch(Request $request, PostInterface $postRepository, BaseHttpResponse $response)
    {
        $query = $request->input('q');
        if (!empty($query)) {
            $posts = $postRepository->getSearch($query);

            $data = [
                'items' => Theme::partial('search', compact('posts')),
                'query' => $query,
                'count' => $posts->count(),
            ];

            if ($data['count'] > 0) {
                return $response->setData(apply_filters(BASE_FILTER_SET_DATA_SEARCH, $data, 10, 1));
            }
        }

        return $response
            ->setError()
            ->setMessage(__('No results found, please try with different keywords.'));
    }
}
