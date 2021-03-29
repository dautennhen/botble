<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\TruongRequest;
use Botble\Miss\Repositories\Interfaces\TruongInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\TruongTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\TruongForm;
use Botble\Base\Forms\FormBuilder;

class TruongController extends BaseController
{
    /**
     * @var TruongInterface
     */
    protected $truongRepository;

    /**
     * @param TruongInterface $truongRepository
     */
    public function __construct(TruongInterface $truongRepository)
    {
        $this->truongRepository = $truongRepository;
    }

    /**
     * @param TruongTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(TruongTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::truong.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::truong.create'));

        return $formBuilder->create(TruongForm::class)->renderForm();
    }

    /**
     * @param TruongRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(TruongRequest $request, BaseHttpResponse $response)
    {
        $truong = $this->truongRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(TRUONG_MODULE_SCREEN_NAME, $request, $truong));

        return $response
            ->setPreviousUrl(route('truong.index'))
            ->setNextUrl(route('truong.edit', $truong->id))
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
        $truong = $this->truongRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $truong));

        page_title()->setTitle(trans('plugins/miss::truong.edit') . ' "' . $truong->name . '"');

        return $formBuilder->create(TruongForm::class, ['model' => $truong])->renderForm();
    }

    /**
     * @param int $id
     * @param TruongRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, TruongRequest $request, BaseHttpResponse $response)
    {
        $truong = $this->truongRepository->findOrFail($id);

        $truong->fill($request->input());

        $this->truongRepository->createOrUpdate($truong);

        event(new UpdatedContentEvent(TRUONG_MODULE_SCREEN_NAME, $request, $truong));

        return $response
            ->setPreviousUrl(route('truong.index'))
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
            $truong = $this->truongRepository->findOrFail($id);

            $this->truongRepository->delete($truong);

            event(new DeletedContentEvent(TRUONG_MODULE_SCREEN_NAME, $request, $truong));

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
            $truong = $this->truongRepository->findOrFail($id);
            $this->truongRepository->delete($truong);
            event(new DeletedContentEvent(TRUONG_MODULE_SCREEN_NAME, $request, $truong));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
