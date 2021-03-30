<?php

namespace Botble\Miss\Tables;

use Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use RvMedia;
use Botble\Miss\Repositories\Interfaces\ThachthucInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Miss\Models\Thachthuc;
use Html;

class ThachthucTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * ThachthucTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param ThachthucInterface $thachthucRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, ThachthucInterface $thachthucRepository)
    {
        $this->repository = $thachthucRepository;
        $this->setOption('id', 'plugins-thachthuc-table');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['thachthuc.edit', 'thachthuc.destroy'])) {
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
            ->editColumn('ten_team', function ($item) {
                if (!Auth::user()->hasPermission('thachthuc.edit')) {
                    return $item->ten_team;
                }
                return Html::link(route('thachthuc.edit', $item->id), $item->ten_team);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('huan_luyen_vien', function ($item) {
                return $item->huan_luyen_vien;
            })
            ->editColumn('image', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->image, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->image, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->image, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->image, ['width' => 70]);
            })
            ->editColumn('avatar_hlv', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->avatar_hlv, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->avatar_hlv, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->avatar_hlv, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->avatar_hlv, ['width' => 70]);
            })


            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('thachthuc.edit', 'thachthuc.destroy', $item);
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
            'thachthucs.id',
            'thachthucs.ten_team',
            'thachthucs.huan_luyen_vien',
            'thachthucs.ts1',
            'thachthucs.ts2',
            'thachthucs.ts3',
            'thachthucs.ts4',
            'thachthucs.ts5',
            'thachthucs.ts6',
            'thachthucs.ts7',
            'thachthucs.ts8',
            'thachthucs.image',
            'thachthucs.avatar_hlv',
            'thachthucs.created_at',
            'thachthucs.status',
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
                'name'  => 'thachthucs.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'ten_team' => [
                'name'  => 'thachthucs.ten_team',
                'title' => 'Tên team',
                'class' => 'text-left',
            ],
            'huan_luyen_vien' => [
                'name'  => 'thachthucs.huan_luyen_vien',
                'title' => 'Huấn luyện viên',
                'class' => 'text-left',
            ],
            'image' => [
                'name'  => 'thachthucs.image',
                'title' => 'Logo trường',
                'class' => 'text-left',
            ],
            'avatar_hlv' => [
                'name'  => 'thachthucs.avatar_hlv',
                'title' => 'Ảnh HLV',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'thachthucs.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name'  => 'thachthucs.status',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('thachthuc.create'), 'thachthuc.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Thachthuc::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('thachthuc.deletes'), 'thachthuc.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'thachthucs.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'thachthucs.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'thachthucs.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
