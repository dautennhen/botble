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
use Botble\Miss\Repositories\Interfaces\TruongInterface;
use Html;
use RvMedia;


class Ts1000Table extends TableAbstract
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
        $this->truongRepository = $truongRepository;
        $this->setOption('id', 'plugins-thisinh-table');
        $this->truongRepository = $truongRepository;
        parent::__construct($table, $urlGenerator);

        // if (!Auth::user()->hasAnyPermission(['thisinh.edit', 'thisinh.destroy'])) {
        //     $this->hasOperations = false;
        //     $this->hasActions = false;
        // }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('so_bao_danh', function ($item) {
                if (!Auth::user()->hasPermission('thisinh.edit')) {
                    return $item->so_bao_danh;
                }
                return Html::link(route('thisinh.edit', $item->id), $item->so_bao_danh);
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
            ->editColumn('avatar_toan_than_1', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->avatar_toan_than_1, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->avatar_toan_than_1, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->avatar_toan_than_1, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->avatar_toan_than_1, ['width' => 70]);
            })
            ->editColumn('avatar_toan_than_2', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->avatar_toan_than_2, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->avatar_toan_than_2, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->avatar_toan_than_2, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->avatar_toan_than_2, ['width' => 70]);
            })
            ->editColumn('video', function ($item) {
                return $item->video;
            })
            ->editColumn('ho', function ($item) {
                return $item->ho.' '.$item->ten;
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })

            ->editColumn('id_truong', function ($item) {
                return $item->getTruong($item->id_truong);
            })
            ->editColumn('id_nam_hoc', function ($item) {
                return $item->getNamHoc($item->id_nam_hoc);
            })
            ->editColumn('mo_ta_ly_lich', function ($item) {
                return $item->mo_ta_ly_lich;
            })
            ->editColumn('luot_bau_chon', function ($item) {
                return $item->luot_bau_chon;
            })
            ->editColumn('luot_xem_profile', function ($item) {
                return $item->luot_xem_profile;
            })
            ->editColumn('chieu_cao', function ($item) {
                return $item->chieu_cao;
            })
            ->editColumn('can_nang', function ($item) {
                return $item->can_nang;
            })
            ->editColumn('so_do_ba_vong', function ($item) {
                return $item->so_do_ba_vong;
            })
            ->editColumn('ngay_sinh', function ($item) {
                return BaseHelper::formatDate($item->ngay_sinh);
            })
            ->editColumn('dia_chi', function ($item) {
                return $item->dia_chi;
            })
            ->editColumn('sdt', function ($item) {
                return $item->sdt;
            })
            ->editColumn('email', function ($item) {
                return $item->email;
            })
            ->editColumn('sdt_nguoi_than', function ($item) {
                return $item->sdt_nguoi_than;
            })
            ->editColumn('mssv', function ($item) {
                return $item->mssv;
            })
            ->editColumn('khoa_nganh', function ($item) {
                return $item->khoa_nganh;
            })
            ->editColumn('ban_scan', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->ban_scan, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->ban_scan, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->ban_scan, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->ban_scan, ['width' => 70]);
            })
            ->editColumn('anh_1', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->anh_1, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->anh_1, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->anh_1, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->anh_1, ['width' => 70]);
            })
            ->editColumn('anh_2', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->anh_2, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->anh_2, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->anh_2, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->anh_2, ['width' => 70]);
            })
            ->editColumn('anh_3', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->anh_3, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->anh_3, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->anh_3, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->anh_3, ['width' => 70]);
            })
            ->editColumn('anh_4', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->anh_4, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->anh_4, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->anh_4, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->anh_4, ['width' => 70]);
            })
            ->editColumn('anh_5', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->anh_5, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->anh_5, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->anh_5, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->anh_5, ['width' => 70]);
            })
            ->editColumn('nguon', function ($item) {
                if(is_numeric ($item->getInformation($item->id)))
                    return $item->showAvatar($item->getInformation($item->id));
                else if($item->getInformation($item->id)!=null)
                    return '<a href="'.$item->getInformation($item->id).'">'.'[Email]'.'</a>';
            });
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
            'thisinhs.mssv',
            'thisinhs.id_truong',
            'thisinhs.id_nam_hoc',
            'thisinhs.so_bao_danh',
            'thisinhs.ho',
            'thisinhs.ten',
            'thisinhs.full_name',
            'thisinhs.mo_ta_ly_lich',
            'thisinhs.sdt',
            'thisinhs.email',
            'thisinhs.avatar',
            'thisinhs.video',
            'thisinhs.tuoi',
            'thisinhs.chieu_cao',
            'thisinhs.so_do_ba_vong',
            'thisinhs.que_quan',
            'thisinhs.ngay_sinh',
            'thisinhs.luot_xem_profile',
            'thisinhs.luot_bau_chon',
            'thisinhs.luot_chia_se_fb',
            'thisinhs.luot_chia_se_khac',
            'thisinhs.deleted_at',
            'thisinhs.who',
            'thisinhs.ip_address',
            'thisinhs.device',
            'thisinhs.vong_1',
            'thisinhs.vong_2',
            'thisinhs.created_at',
            'thisinhs.updated_at',
            'thisinhs.dia_chi',
            'thisinhs.khoa_nganh',
            'thisinhs.sdt_nguoi_than',
            'thisinhs.ho_ten_me',
            'thisinhs.ho_ten_cha',
            'thisinhs.avatar_toan_than_1',
            'thisinhs.avatar_toan_than_2',
            'thisinhs.ban_scan',
            'thisinhs.vong_loai',
            'thisinhs.vong_top_200',
            'thisinhs.vong_top_40',
            'thisinhs.vong_top_35',
            'thisinhs.can_nang',
            'thisinhs.anh_1',
            'thisinhs.anh_2',
            'thisinhs.anh_3',
            'thisinhs.anh_4',
            'thisinhs.anh_5',
            'thisinhs.id_member',
        ];


        // $query = $model->select($select);


        $query = $model->select($select)->limit(1000);

        // dd($query->pluck('so_bao_danh'));

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model, $select));
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [

            'so_bao_danh' => [
                'name'  => 'thisinhs.so_bao_danh',
                'title' => 'Số báo danh',
                'class' => 'text-left',
            ],
            'avatar' => [
                'name'  => 'thisinhs.avatar',
                'title' => 'Ảnh chân dung',
                'width' => '70px',
            ],
            'avatar_toan_than_1' => [
                'name'  => 'thisinhs.avatar_toan_than_1',
                'title' => 'Ảnh toàn thân 1',
                'width' => '70px',
            ],
            'avatar_toan_than_2' => [
                'name'  => 'thisinhs.avatar_toan_than_2',
                'title' => 'Ảnh toàn thân 2',
                'width' => '70px',
            ],
            'video' => [
                'name'  => 'thisinhs.video',
                'title' => 'Video',
                'class' => 'text-left',
            ],
            'ho' => [
                'name'  => 'thisinhs.ho',
                'title' => 'Họ và tên',
                'class' => 'text-left',
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
            'mo_ta_ly_lich' => [
                'name'  => 'thisinhs.mo_ta_ly_lich',
                'title' => 'Mô tả ba',
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
            'chieu_cao' => [
                'name'  => 'thisinhs.chieu_cao',
                'title' => 'Chiều cao',
                'class' => 'text-left',
            ],
            'chieu_cao' => [
                'name'  => 'thisinhs.chieu_cao',
                'title' => 'Chiều cao',
                'class' => 'text-left',
            ],
            'can_nang' => [
                'name'  => 'thisinhs.can_nang',
                'title' => 'Cân nặng',
                'class' => 'text-left',
            ],
            'so_do_ba_vong' => [
                'name'  => 'thisinhs.so_do_ba_vong',
                'title' => 'Số đo 3 vòng',
                'class' => 'text-left',
            ],
            'ngay_sinh' => [
                'name'  => 'thisinhs.ngay_sinh',
                'title' => 'Ngày sinh',
                'class' => 'text-left',
            ],
            'dia_chi' => [
                'name'  => 'thisinhs.dia_chi',
                'title' => 'Địa chỉ',
                'class' => 'text-left',
            ],
            'sdt' => [
                'name'  => 'thisinhs.sdt',
                'title' => 'SĐT',
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'thisinhs.email',
                'title' => 'Email',
                'class' => 'text-left',
            ],
            'sdt_nguoi_than' => [
                'name'  => 'thisinhs.sdt_nguoi_than',
                'title' => 'SĐT người thân',
                'class' => 'text-left',
            ],
            'mssv' => [
                'name'  => 'thisinhs.mssv',
                'title' => 'MSSV',
                'class' => 'text-left',
            ],
            'khoa_nganh' => [
                'name'  => 'thisinhs.khoa_nganh',
                'title' => 'Khoa/ngành',
                'class' => 'text-left',
            ],
            'ban_scan' => [
                'name'  => 'thisinhs.ban_scan',
                'title' => 'Giấy chứng nhận',
                'width' => '70px',
            ],
            'anh_1' => [
                'name'  => 'thisinhs.anh_1',
                'title' => 'Ảnh 1',
                'width' => '70px',
            ],
            'anh_2' => [
                'name'  => 'thisinhs.anh_2',
                'title' => 'Ảnh 2',
                'width' => '70px',
            ],
            'anh_3' => [
                'name'  => 'thisinhs.anh_3',
                'title' => 'Ảnh 3',
                'width' => '70px',
            ],
            'anh_4' => [
                'name'  => 'thisinhs.anh_4',
                'title' => 'Ảnh 4',
                'width' => '70px',
            ],
            'anh_5' => [
                'name'  => 'thisinhs.anh_5',
                'title' => 'Ảnh 5',
                'width' => '70px',
            ],
            'nguon' => [
                'name'  => 'thisinhs.id',
                'title' => 'Nguồn',
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
                'title'    => 'Thí sinh mỗi trường',
                'type'     => 'select',
                'validate' => 'required|max:120',
                'callback' => 'getFiltersTruong',
            ],
            // 'thisinhs.created_at' => [
            //     'title' => trans('core/base::tables.created_at'),
            //     'type'  => 'date',
            //     'validate' => 'required',
            // ],
        ];
    }

    /**
     * @return array
     */

    public function getFilters(): array
    {
        // return $this->getBulkChanges();
        return [
            'thisinhs.so_bao_danh' => [
                'title'    => 'Số báo danh',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'thisinhs.id_truong'         => [
                'title'    => 'Trường',
                'type'     => 'select-search',
                'validate' => 'required',
                'callback' => 'getTruongs',
            ],
            // 'thisinhs.created_at' => [
            //     'title' => trans('core/base::tables.created_at'),
            //     'type'  => 'date',
            // ],
        ];
    }
    public function getTruongs(): array
    {
        return $this->truongRepository->pluck('ten_truong', 'id');
    }
    /**
     * @return array
     */
    public function getFiltersTruong(): array
    {
        return $this->truongRepository->pluck('truongs.ten_truong', 'truongs.id');
    }
    // public function applyFilterCondition($query, string $key, string $operator, ?string $value)
    // {
    //     switch ($key) {
    //         case 'thisinhs.created_at':
    //             if (!$value) {
    //                 break;
    //             }

    //             $value = Carbon::createFromFormat(config('core.base.general.date_format.date'), $value)->toDateString();
    //             return $query->whereDate($key,  $operator, $value)->orderBy('thisinhs.created_at','asc')->limit(2)->get();
    //     }

    //     return parent::applyFilterCondition($query, $key, $operator, $value);
    // }
    public function getDefaultButtons(): array
    {
        return [
            'export',

        ];
    }
}
