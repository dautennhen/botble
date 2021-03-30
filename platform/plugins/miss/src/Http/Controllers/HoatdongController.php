<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\HoatdongRequest;
use Botble\Miss\Repositories\Interfaces\HoatdongInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\HoatdongTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\HoatdongForm;
use Botble\Base\Forms\FormBuilder;

class HoatdongController extends BaseController
{
    /**
     * @var HoatdongInterface
     */
    protected $hoatdongRepository;

    /**
     * @param HoatdongInterface $hoatdongRepository
     */
    public function __construct(HoatdongInterface $hoatdongRepository)
    {
        $this->hoatdongRepository = $hoatdongRepository;
    }

    /**
     * @param HoatdongTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(HoatdongTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::hoatdong.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::hoatdong.create'));

        return $formBuilder->create(HoatdongForm::class)->renderForm();
    }

    /**
     * @param HoatdongRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(HoatdongRequest $request, BaseHttpResponse $response)
    {
        $hoatdong = $this->hoatdongRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(HOATDONG_MODULE_SCREEN_NAME, $request, $hoatdong));

        return $response
            ->setPreviousUrl(route('hoatdong.index'))
            ->setNextUrl(route('hoatdong.edit', $hoatdong->id))
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
        $hoatdong = $this->hoatdongRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $hoatdong));

        page_title()->setTitle(trans('plugins/miss::hoatdong.edit') . ' "' . $hoatdong->name . '"');

        return $formBuilder->create(HoatdongForm::class, ['model' => $hoatdong])->renderForm();
    }

    /**
     * @param int $id
     * @param HoatdongRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, HoatdongRequest $request, BaseHttpResponse $response)
    {
        $hoatdong = $this->hoatdongRepository->findOrFail($id);

        $hoatdong->fill($request->input());

        $this->hoatdongRepository->createOrUpdate($hoatdong);

        event(new UpdatedContentEvent(HOATDONG_MODULE_SCREEN_NAME, $request, $hoatdong));

        return $response
            ->setPreviousUrl(route('hoatdong.index'))
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
            $hoatdong = $this->hoatdongRepository->findOrFail($id);

            $this->hoatdongRepository->delete($hoatdong);

            event(new DeletedContentEvent(HOATDONG_MODULE_SCREEN_NAME, $request, $hoatdong));

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
            $hoatdong = $this->hoatdongRepository->findOrFail($id);
            $this->hoatdongRepository->delete($hoatdong);
            event(new DeletedContentEvent(HOATDONG_MODULE_SCREEN_NAME, $request, $hoatdong));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
