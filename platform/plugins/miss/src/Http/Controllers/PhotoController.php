<?php

namespace Botble\Miss\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Miss\Http\Requests\PhotoRequest;
use Botble\Miss\Repositories\Interfaces\PhotoInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Miss\Tables\PhotoTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Miss\Forms\PhotoForm;
use Botble\Base\Forms\FormBuilder;

class PhotoController extends BaseController
{
    /**
     * @var PhotoInterface
     */
    protected $photoRepository;

    /**
     * @param PhotoInterface $photoRepository
     */
    public function __construct(PhotoInterface $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    /**
     * @param PhotoTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(PhotoTable $table)
    {
        page_title()->setTitle(trans('plugins/miss::photo.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/miss::photo.create'));

        return $formBuilder->create(PhotoForm::class)->renderForm();
    }

    /**
     * @param PhotoRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(PhotoRequest $request, BaseHttpResponse $response)
    {
        $photo = $this->photoRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(PHOTO_MODULE_SCREEN_NAME, $request, $photo));

        return $response
            ->setPreviousUrl(route('photo.index'))
            ->setNextUrl(route('photo.edit', $photo->id))
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
        $photo = $this->photoRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $photo));

        page_title()->setTitle(trans('plugins/miss::photo.edit') . ' "' . $photo->name . '"');

        return $formBuilder->create(PhotoForm::class, ['model' => $photo])->renderForm();
    }

    /**
     * @param int $id
     * @param PhotoRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, PhotoRequest $request, BaseHttpResponse $response)
    {
        $photo = $this->photoRepository->findOrFail($id);

        $photo->fill($request->input());

        $this->photoRepository->createOrUpdate($photo);

        event(new UpdatedContentEvent(PHOTO_MODULE_SCREEN_NAME, $request, $photo));

        return $response
            ->setPreviousUrl(route('photo.index'))
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
            $photo = $this->photoRepository->findOrFail($id);

            $this->photoRepository->delete($photo);

            event(new DeletedContentEvent(PHOTO_MODULE_SCREEN_NAME, $request, $photo));

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
            $photo = $this->photoRepository->findOrFail($id);
            $this->photoRepository->delete($photo);
            event(new DeletedContentEvent(PHOTO_MODULE_SCREEN_NAME, $request, $photo));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
