<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\ThisinhRequest;
use Botble\Miss\Repositories\Interfaces\ThisinhInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\ThisinhTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\ThisinhForm;
use Botble\Base\Forms\FormBuilder;


class ThisinhController extends BaseController
{
    /**
     * @var ThisinhInterface
     */
    protected $thisinhRepository;

    /**
     * @param ThisinhInterface $thisinhRepository
     */
    public function __construct(ThisinhInterface $thisinhRepository)
    {
        $this->thisinhRepository = $thisinhRepository;
    }

    /**
     * @param ThisinhTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(ThisinhTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::thisinh.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::thisinh.create'));

        return $formBuilder->create(ThisinhForm::class)->renderForm();
    }

    /**
     * @param ThisinhRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(ThisinhRequest $request, BaseHttpResponse $response)
    {
        $request->merge(['full_name' => $request->ho.' '.$request->ten]);
        // dd($request->input());exit;
        $thisinh = $this->thisinhRepository->createOrUpdate($request->input());
        event(new CreatedContentEvent(THISINH_MODULE_SCREEN_NAME, $request, $thisinh));

        return $response
            ->setPreviousUrl(route('thisinh.index'))
            ->setNextUrl(route('thisinh.edit', $thisinh->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $thisinh = $this->thisinhRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $thisinh));

        page_title()->setTitle(trans('plugins/miss::thisinh.edit') . ' "' . $thisinh->name . '"');

        return $formBuilder->create(ThisinhForm::class, ['model' => $thisinh])->renderForm();
    }

    /**
     * @param int $id
     * @param ThisinhRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, ThisinhRequest $request, BaseHttpResponse $response)
    {
        $thisinh = $this->thisinhRepository->findOrFail($id);

        $thisinh->fill($request->input());

        $this->thisinhRepository->createOrUpdate($thisinh);

        event(new UpdatedContentEvent(THISINH_MODULE_SCREEN_NAME, $request, $thisinh));

        return $response
            ->setPreviousUrl(route('thisinh.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $thisinh = $this->thisinhRepository->findOrFail($id);

            $this->thisinhRepository->delete($thisinh);

            event(new DeletedContentEvent(THISINH_MODULE_SCREEN_NAME, $request, $thisinh));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $thisinh = $this->thisinhRepository->findOrFail($id);
            $this->thisinhRepository->delete($thisinh);
            event(new DeletedContentEvent(THISINH_MODULE_SCREEN_NAME, $request, $thisinh));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
