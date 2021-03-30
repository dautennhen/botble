<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\Ts1000Request;
use Botble\Miss\Repositories\Interfaces\Ts1000Interface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\Ts1000Table;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\Ts1000Form;
use Botble\Base\Forms\FormBuilder;

class Ts1000Controller extends BaseController
{
    /**
     * @var Ts1000Interface
     */
    protected $ts1000Repository;

    /**
     * @param Ts1000Interface $ts1000Repository
     */
    public function __construct(Ts1000Interface $ts1000Repository)
    {
        $this->ts1000Repository = $ts1000Repository;
    }

    /**
     * @param Ts1000Table $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Ts1000Table $table)
    {
        page_title()->setTitle(trans('plugins/miss::ts1000.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::ts1000.create'));

        return $formBuilder->create(Ts1000Form::class)->renderForm();
    }

    /**
     * @param Ts1000Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(Ts1000Request $request, BaseHttpResponse $response)
    {
        $ts1000 = $this->ts1000Repository->createOrUpdate($request->input());

        event(new CreatedContentEvent(TS1000_MODULE_SCREEN_NAME, $request, $ts1000));

        return $response
            ->setPreviousUrl(route('ts1000.index'))
            ->setNextUrl(route('ts1000.edit', $ts1000->id))
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
        $ts1000 = $this->ts1000Repository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $ts1000));

        page_title()->setTitle(trans('plugins/miss::ts1000.edit') . ' "' . $ts1000->name . '"');

        return $formBuilder->create(Ts1000Form::class, ['model' => $ts1000])->renderForm();
    }

    /**
     * @param int $id
     * @param Ts1000Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, Ts1000Request $request, BaseHttpResponse $response)
    {
        $ts1000 = $this->ts1000Repository->findOrFail($id);

        $ts1000->fill($request->input());

        $this->ts1000Repository->createOrUpdate($ts1000);

        event(new UpdatedContentEvent(TS1000_MODULE_SCREEN_NAME, $request, $ts1000));

        return $response
            ->setPreviousUrl(route('ts1000.index'))
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
            $ts1000 = $this->ts1000Repository->findOrFail($id);

            $this->ts1000Repository->delete($ts1000);

            event(new DeletedContentEvent(TS1000_MODULE_SCREEN_NAME, $request, $ts1000));

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
            $ts1000 = $this->ts1000Repository->findOrFail($id);
            $this->ts1000Repository->delete($ts1000);
            event(new DeletedContentEvent(TS1000_MODULE_SCREEN_NAME, $request, $ts1000));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
