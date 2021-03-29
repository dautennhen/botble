<?php

namespace Botble\Miss\Tables;

use Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Repositories\Interfaces\TruongInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Miss\Models\Truong;
use Html;
use RvMedia;

class TruongTable extends TableAbstract
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
     * TruongTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param TruongInterface $truongRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, TruongInterface $truongRepository)
    {
        $this->repository = $truongRepository;
        $this->setOption('id', 'plugins-truong-table');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['truong.edit', 'truong.destroy'])) {
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
            ->editColumn('ten_truong', function ($item) {
                if (!Auth::user()->hasPermission('truong.edit')) {
                    return $item->ten_truong;
                }
                return Html::link(route('truong.edit', $item->id), $item->ten_truong);
            })
            ->editColumn('logo_truong', function ($item) {
                if ($this->request()->input('action') == 'csv') {
                    return RvMedia::getImageUrl($item->logo_truong, null, false, RvMedia::getDefaultImage());
                }

                if ($this->request()->input('action') == 'excel') {
                    return RvMedia::getImageUrl($item->logo_truong, 'thumb', false, RvMedia::getDefaultImage());
                }

                return Html::image(RvMedia::getImageUrl($item->logo_truong, 'thumb', false, RvMedia::getDefaultImage()),
                    $item->logo_truong, ['width' => 70]);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('truong.edit', 'truong.destroy', $item);
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
            'truongs.id',
            'truongs.ten_truong',
            'truongs.logo_truong',
            'truongs.created_at',
            'truongs.status',
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
                'name'  => 'truongs.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'ten_truong' => [
                'name'  => 'truongs.ten_truong',
                'title' => 'Tên trường',
                'class' => 'text-left',
            ],
            'logo_truong' => [
                'name'  => 'truongs.logo_truong',
                'title' => 'Logo trường',
                'width' => '90px',
            ],
            'created_at' => [
                'name'  => 'truongs.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name'  => 'truongs.status',
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
        $buttons = $this->addCreateButton(route('truong.create'), 'truong.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Truong::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('truong.deletes'), 'truong.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'truongs.ten_truong' => [
                'title'    => 'Tên trường',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'truongs.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'truongs.created_at' => [
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
