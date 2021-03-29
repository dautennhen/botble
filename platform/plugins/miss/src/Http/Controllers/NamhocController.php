<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\NamhocRequest;
use Botble\Miss\Repositories\Interfaces\NamhocInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\NamhocTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\NamhocForm;
use Botble\Base\Forms\FormBuilder;

class NamhocController extends BaseController
{
    /**
     * @var NamhocInterface
     */
    protected $namhocRepository;

    /**
     * @param NamhocInterface $namhocRepository
     */
    public function __construct(NamhocInterface $namhocRepository)
    {
        $this->namhocRepository = $namhocRepository;
    }

    /**
     * @param NamhocTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(NamhocTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::namhoc.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::namhoc.create'));

        return $formBuilder->create(NamhocForm::class)->renderForm();
    }

    /**
     * @param NamhocRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(NamhocRequest $request, BaseHttpResponse $response)
    {
        $namhoc = $this->namhocRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(NAMHOC_MODULE_SCREEN_NAME, $request, $namhoc));

        return $response
            ->setPreviousUrl(route('namhoc.index'))
            ->setNextUrl(route('namhoc.edit', $namhoc->id))
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
        $namhoc = $this->namhocRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $namhoc));

        page_title()->setTitle(trans('plugins/miss::namhoc.edit') . ' "' . $namhoc->name . '"');

        return $formBuilder->create(NamhocForm::class, ['model' => $namhoc])->renderForm();
    }

    /**
     * @param int $id
     * @param NamhocRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, NamhocRequest $request, BaseHttpResponse $response)
    {
        $namhoc = $this->namhocRepository->findOrFail($id);

        $namhoc->fill($request->input());

        $this->namhocRepository->createOrUpdate($namhoc);

        event(new UpdatedContentEvent(NAMHOC_MODULE_SCREEN_NAME, $request, $namhoc));

        return $response
            ->setPreviousUrl(route('namhoc.index'))
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
            $namhoc = $this->namhocRepository->findOrFail($id);

            $this->namhocRepository->delete($namhoc);

            event(new DeletedContentEvent(NAMHOC_MODULE_SCREEN_NAME, $request, $namhoc));

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
            $namhoc = $this->namhocRepository->findOrFail($id);
            $this->namhocRepository->delete($namhoc);
            event(new DeletedContentEvent(NAMHOC_MODULE_SCREEN_NAME, $request, $namhoc));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
