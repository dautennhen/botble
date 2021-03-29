<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\MissRequest;
use Botble\Miss\Repositories\Interfaces\MissInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\MissTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\MissForm;
use Botble\Base\Forms\FormBuilder;

class MissController extends BaseController
{
    /**
     * @var MissInterface
     */
    protected $missRepository;

    /**
     * @param MissInterface $missRepository
     */
    public function __construct(MissInterface $missRepository)
    {
        $this->missRepository = $missRepository;
    }

    /**
     * @param MissTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(MissTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::miss.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::miss.create'));

        return $formBuilder->create(MissForm::class)->renderForm();
    }

    /**
     * @param MissRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(MissRequest $request, BaseHttpResponse $response)
    {
        $miss = $this->missRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(MISS_MODULE_SCREEN_NAME, $request, $miss));

        return $response
            ->setPreviousUrl(route('miss.index'))
            ->setNextUrl(route('miss.edit', $miss->id))
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
        $miss = $this->missRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $miss));

        page_title()->setTitle(trans('plugins/miss::miss.edit') . ' "' . $miss->name . '"');

        return $formBuilder->create(MissForm::class, ['model' => $miss])->renderForm();
    }

    /**
     * @param int $id
     * @param MissRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, MissRequest $request, BaseHttpResponse $response)
    {
        $miss = $this->missRepository->findOrFail($id);

        $miss->fill($request->input());

        $this->missRepository->createOrUpdate($miss);

        event(new UpdatedContentEvent(MISS_MODULE_SCREEN_NAME, $request, $miss));

        return $response
            ->setPreviousUrl(route('miss.index'))
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
            $miss = $this->missRepository->findOrFail($id);

            $this->missRepository->delete($miss);

            event(new DeletedContentEvent(MISS_MODULE_SCREEN_NAME, $request, $miss));

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
            $miss = $this->missRepository->findOrFail($id);
            $this->missRepository->delete($miss);
            event(new DeletedContentEvent(MISS_MODULE_SCREEN_NAME, $request, $miss));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
