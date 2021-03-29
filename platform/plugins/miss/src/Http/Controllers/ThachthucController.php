<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\ThachthucRequest;
use Botble\Miss\Repositories\Interfaces\ThachthucInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\ThachthucTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\ThachthucForm;
use Botble\Base\Forms\FormBuilder;

class ThachthucController extends BaseController
{
    /**
     * @var ThachthucInterface
     */
    protected $thachthucRepository;

    /**
     * @param ThachthucInterface $thachthucRepository
     */
    public function __construct(ThachthucInterface $thachthucRepository)
    {
        $this->thachthucRepository = $thachthucRepository;
    }

    /**
     * @param ThachthucTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(ThachthucTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::thachthuc.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::thachthuc.create'));

        return $formBuilder->create(ThachthucForm::class)->renderForm();
    }

    /**
     * @param ThachthucRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(ThachthucRequest $request, BaseHttpResponse $response)
    {
        $thachthuc = $this->thachthucRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(THACHTHUC_MODULE_SCREEN_NAME, $request, $thachthuc));

        return $response
            ->setPreviousUrl(route('thachthuc.index'))
            ->setNextUrl(route('thachthuc.edit', $thachthuc->id))
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
        $thachthuc = $this->thachthucRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $thachthuc));

        page_title()->setTitle(trans('plugins/miss::thachthuc.edit') . ' "' . $thachthuc->name . '"');

        return $formBuilder->create(ThachthucForm::class, ['model' => $thachthuc])->renderForm();
    }

    /**
     * @param int $id
     * @param ThachthucRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, ThachthucRequest $request, BaseHttpResponse $response)
    {
        $thachthuc = $this->thachthucRepository->findOrFail($id);

        $thachthuc->fill($request->input());

        $this->thachthucRepository->createOrUpdate($thachthuc);

        event(new UpdatedContentEvent(THACHTHUC_MODULE_SCREEN_NAME, $request, $thachthuc));

        return $response
            ->setPreviousUrl(route('thachthuc.index'))
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
            $thachthuc = $this->thachthucRepository->findOrFail($id);

            $this->thachthucRepository->delete($thachthuc);

            event(new DeletedContentEvent(THACHTHUC_MODULE_SCREEN_NAME, $request, $thachthuc));

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
            $thachthuc = $this->thachthucRepository->findOrFail($id);
            $this->thachthucRepository->delete($thachthuc);
            event(new DeletedContentEvent(THACHTHUC_MODULE_SCREEN_NAME, $request, $thachthuc));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
