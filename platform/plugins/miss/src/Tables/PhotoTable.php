<?php

namespace Botble\Miss\Tables;

use Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Repositories\Interfaces\PhotoInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Miss\Models\Photo;
use Html;
use RvMedia;

class PhotoTable extends TableAbstract
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
     * PhotoTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param PhotoInterface $photoRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, PhotoInterface $photoRepository)
    {
        $this->repository = $photoRepository;
        $this->setOption('id', 'plugins-photo-table');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['photo.edit', 'photo.destroy'])) {
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
            ->editColumn('id_thi_sinh', function ($item) {

                if (!Auth::user()->hasPermission('photo.edit')) {
                    return $item->thisinhs->full_name;
                }
                return Html::link(route('photo.edit', $item->id), $item->thisinhs->full_name);
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
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            });
            // ->editColumn('status', function ($item) {
            //     return $item->status->toHtml();
            // });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return $this->getOperations('photo.edit', 'photo.destroy', $item);
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
            'photos.id',
            'photos.id_thi_sinh',
            'photos.image',
            'photos.created_at',
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
                'name'  => 'photos.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'id_thi_sinh' => [
                'name'  => 'photos.id_thi_sinh',
                'title' => "Tên thí sinh",
                'class' => 'text-left',
            ],
            'image' => [
                'name'  => 'photos.image',
                'title' => 'Ảnh đại diện album',
                'width' => '70px',
            ],
            'created_at' => [
                'name'  => 'photos.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('photo.create'), 'photo.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Photo::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('photo.deletes'), 'photo.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'photos.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],

            'photos.created_at' => [
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
