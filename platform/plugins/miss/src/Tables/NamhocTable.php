<?php

namespace Botble\Miss\Tables;

use Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Repositories\Interfaces\NamhocInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Miss\Models\Namhoc;
use Html;

class NamhocTable extends TableAbstract
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
     * NamhocTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param NamhocInterface $namhocRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, NamhocInterface $namhocRepository)
    {
        $this->repository = $namhocRepository;
        $this->setOption('id', 'plugins-namhoc-table');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['namhoc.edit', 'namhoc.destroy'])) {
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
            ->editColumn('ten_nam_hoc', function ($item) {
                if (!Auth::user()->hasPermission('namhoc.edit')) {
                    return $item->ten_nam_hoc;
                }
                return Html::link(route('namhoc.edit', $item->id), $item->ten_nam_hoc);
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
                return $this->getOperations('namhoc.edit', 'namhoc.destroy', $item);
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
            'namhocs.id',
            'namhocs.ten_nam_hoc',
            'namhocs.created_at',
            'namhocs.status',
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
                'name'  => 'namhocs.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'ten_nam_hoc' => [
                'name'  => 'namhocs.ten_nam_hoc',
                'title' => 'Năm học của sinh viên',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'namhocs.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'name'  => 'namhocs.status',
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
        $buttons = $this->addCreateButton(route('namhoc.create'), 'namhoc.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Namhoc::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('namhoc.deletes'), 'namhoc.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'namhocs.ten_nam_hoc' => [
                'title'    => 'Năm học của sinh viên',
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'namhocs.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'namhocs.created_at' => [
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
