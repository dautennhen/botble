<?php

namespace Botble\Miss\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Http\Requests\PhotoRequest;
use Botble\Miss\Models\Photo;
use Botble\Miss\Repositories\Interfaces\ThisinhInterface;

class PhotoForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {


        $thi_sinh=app(ThisinhInterface::class)->pluck('full_name','id');
        $this
            ->setupModel(new Photo)
            ->setValidatorClass(PhotoRequest::class)
            ->withCustomFields()
            ->add('id_thi_sinh', 'customSelect', [
                'label'      => 'Thí sinh',
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $thi_sinh,
            ])
            ->add('mo_ta', 'textarea', [
                'label'      => 'Mô tả',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'rows'         => 4,
                    'placeholder'  => "Nhập mô tả",
                    'data-counter' => 400,
                ],
            ])
            ->add('image', 'mediaImage', [
                'label'      => 'Ảnh đại diện',
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');
    }
}
