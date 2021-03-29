<?php

namespace Botble\Miss\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Http\Requests\TruongRequest;
use Botble\Miss\Models\Truong;

class TruongForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Truong)
            ->setValidatorClass(TruongRequest::class)
            ->withCustomFields()
            // ->add('name', 'text', [
            //     'label'      => trans('core/base::forms.name'),
            //     'label_attr' => ['class' => 'control-label required'],
            //     'attr'       => [
            //         'placeholder'  => trans('core/base::forms.name_placeholder'),
            //         'data-counter' => 120,
            //     ],
            // ])
            ->add('ten_truong', 'text', [ // you can change "text" to "password", "email", "number" or "textarea"
                'label'      => __('Tên trường'),
                'label_attr' => ['class' => 'control-label required'], // Add class "required" if that is mandatory field
                'attr'       => [
                    'placeholder'  => __('Nhập tên trường'),
                    'data-counter' => 120, // Maximum characters
                ],
            ])
            ->add('logo_truong', 'mediaImage', [
                'label'      => __('Logo trường'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
