<?php

namespace Botble\Miss\Tables;

use Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Repositories\Interfaces\HoatdongInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Miss\Models\Hoatdong;
use Html;

class HoatdongTable extends TableAbstract
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
     * HoatdongTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param HoatdongInterface $hoatdongRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, HoatdongInterface $hoatdongRepository)
    {
        $this->repository = $hoatdongRepository;
        $this->setOption('id', 'plugins-hoatdong-table');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['hoatdong.edit', 'hoatdong.destroy'])) {
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
            ->editColumn('id_team', function ($item) {
                if (!Auth::user()->hasPermission('hoatdong.edit')) {
                    return $item->name;
                }
                return Html::link(route('hoatdong.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('url', function ($item) {
                return $item->url;
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('trang_thai', function ($item) {
                return $item->trang_thai;
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('hoatdong.edit', 'hoatdong.destroy', $item);
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
            'hoatdongs.id',
            'hoatdongs.id_team',
            'hoatdongs.url',
            'hoatdongs.created_at',
            'hoatdongs.trang_thai',
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
                'name'  => 'hoatdongs.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'id_team' => [
                'name'  => 'hoatdongs.id_team',
                'title' => 'Team',
                'class' => 'text-left',
            ],
            'url' => [
                'name'  => 'hoatdongs.url',
                'title' => 'URL Video',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'hoatdongs.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'trang_thai' => [
                'name'  => 'hoatdongs.trang_thai',
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
        $buttons = $this->addCreateButton(route('hoatdong.create'), 'hoatdong.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Hoatdong::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('hoatdong.deletes'), 'hoatdong.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'hoatdongs.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'hoatdongs.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'hoatdongs.created_at' => [
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
