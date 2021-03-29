<?php

namespace Botble\Miss\Tables;

use Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Exports\ThiSinhExport;
use Botble\Miss\Repositories\Interfaces\ThisinhInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Miss\Models\Thisinh;
use Botble\Miss\Models\Truong;
use Botble\Miss\Repositories\Interfaces\TruongInterface;
use Html;
use RvMedia;

class ThisinhTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
        /**
     * @var string
     */
    protected $exportClass = ThiSinhExport::class;
    protected $hasFilter = true;

    /**
     * @var TruongInterface
     */
    protected $truongRepository;

    /**
     * ThisinhTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param ThisinhInterface $thisinhRepository
     */
    public function __construct(
        DataTables $table, 
        UrlGenerator $urlGenerator, 
        ThisinhInterface $thisinhRepository,
        TruongInterface $truongRepository)
    {
        $this->repository = $thisinhRepository;
        $this->setOption('id', 'plugins-thisinh-table');
        $this->truongRepository = $truongRepository;
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['thisinh.edit', 'thisinh.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('id', function ($item) {
               return $item->id;
            })
            ->editColumn('so_bao_danh', function ($item) {
                if (!Auth::user()->hasPermission('thisinh.edit')) {
                    return $item->so_bao_danh;
                }
                return Html::link(route('thisinh.edit', $item->id), $item->so_bao_danh);
            })
            ->editColumn('member', function ($item) {
                if(is_numeric ($item->getInformation($item->id)))
                    return $item->showAvatar($item->getInformation($item->id));
                else if($item->getInformation($item->id)!=null)
                    return '<a href="'.$item->getInformation($item->id).'">'.'[Email]'.'</a>';
            })
            ->editColumn('ho', function ($item) {
                return $item->ho.' '.$item->ten;
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('avatar', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->avatar, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->avatar, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->avatar, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->avatar, ['width' => 70]);
            })
            ->editColumn('id_truong', function ($item) {
                return $item->getTruong($item->id_truong);
            })
            ->editColumn('id_nam_hoc', function ($item) {
                return $item->getNamHoc($item->id_nam_hoc);
            })
            ->editColumn('id_nam_hoc', function ($item) {
                return $item->getNamHoc($item->id_nam_hoc);
            })
            ->editColumn('luot_bau_chon', function ($item) {
                return $item->luot_bau_chon;
            })
            ->editColumn('luot_xem_profile', function ($item) {
                return $item->luot_xem_profile;
            })
            ->editColumn('vong_loai', function ($item) {
                return $item->vong_loai?"Hiện":"Ẩn"; //0 an, 1 hien
            })
            ->editColumn('vong_top_200', function ($item) {
                return $item->vong_top_200?"Hiện":"Ẩn";
            })
            ->editColumn('vong_top_40', function ($item) {
                return $item->vong_top_40?"Hiện":"Ẩn";
            })
            ->editColumn('vong_top_35', function ($item) {
                return $item->vong_top_35?"Hiện":"Ẩn";
            })
;
            // ->editColumn('created_at', function ($item) {
            //     return BaseHelper::formatDate($item->created_at);
            // })
            // ->editColumn('status', function ($item) {
            //     return $item->status->toHtml();
            // });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('thisinh.edit', 'thisinh.destroy', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $select = [
            'thisinhs.id',
            'thisinhs.so_bao_danh',
            'thisinhs.ho',
            'thisinhs.ten',
            'thisinhs.avatar',
            'thisinhs.id_truong',
            'thisinhs.id_nam_hoc',
            'thisinhs.luot_bau_chon',
            'thisinhs.luot_xem_profile',
            'thisinhs.vong_loai',
            'thisinhs.vong_top_200',
            'thisinhs.vong_top_40',
            'thisinhs.vong_top_35',
        ];

        $query = $model->select($select);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, $select));
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [

            'id' => [
                'name'  => 'thisinhs.id',
                'title' => 'id',

            ],
            'member' => [
                'name'  => 'thisinhs.id',
                'title' => 'member',

            ],
            'so_bao_danh' => [
                'name'  => 'thisinhs.so_bao_danh',
                'title' => 'Số báo danh',
                'class' => 'text-left',
            ],
            'avatar' => [
                'name'  => 'thisinhs.avatar',
                'title' => 'Ảnh đại diện',
                'width' => '70px',
            ],
            'ho' => [
                'name'  => 'thisinhs.ho',
                'title' => 'Họ và tên',
                'width' => '100px',
            ],
            'id_truong' => [
                'name'  => 'thisinhs.id_truong',
                'title' => 'Trường',
                'class' => 'text-left',
            ],
            'id_nam_hoc' => [
                'name'  => 'thisinhs.id_nam_hoc',
                'title' => 'Năm học',
                'class' => 'text-left',
            ],
            'luot_bau_chon' => [
                'name'  => 'thisinhs.luot_bau_chon',
                'title' => 'Lượt bầu chọn',
                'class' => 'text-left',
            ],
            'luot_xem_profile' => [
                'name'  => 'thisinhs.luot_xem_profile',
                'title' => 'Lượt xem profile',
                'class' => 'text-left',
            ],
            'vong_loai' => [
                'name'  => 'thisinhs.vong_loai',
                'title' => 'Vòng loại',
                'class' => 'text-left',
            ],
            'vong_top_200' => [
                'name'  => 'thisinhs.vong_top_200',
                'title' => 'Vòng 200',
                'class' => 'text-left',
            ],
            'vong_top_40' => [
                'name'  => 'thisinhs.vong_top_200',
                'title' => 'Vòng 40',
                'class' => 'text-left',
            ],

            'vong_top_35' => [
                'name'  => 'thisinhs.vong_top_35',
                'title' => 'Vòng 35',
                'class' => 'text-left',
            ],


            // 'status' => [
            //     'name'  => 'thisinhs.status',
            //     'title' => trans('core/base::tables.status'),
            //     'width' => '100px',
            // ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('thisinh.create'), 'thisinh.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Thisinh::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('thisinh.deletes'), 'thisinh.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'thisinhs.id_truong' => [
                'title'    => 'Danh sách thí sinh mỗi trường',
                'type'     => 'select',
                'validate' => 'required|max:120',
                'callback' => 'getFiltersTruong',
            ],
            'thisinhs.avatar' => [
                'title'    => 'Ảnh đại diện',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            // 'thisinhs.created_at' => [
            //     'title' => trans('core/base::tables.created_at'),
            //     'type'  => 'date',
            // ],
        ];
    }

    /**
     * @return array
     */
    
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
    /**
     * @return array
     */
    public function getFiltersTruong(): array
    {
        return $this->truongRepository->pluck('truongs.ten_truong', 'truongs.id');
    }
    public function getDefaultButtons(): array
    {
        return [
            'export',
        ];
    }
}
