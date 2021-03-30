<?php

namespace Botble\Miss\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Http\Requests\HoatdongRequest;
use Botble\Miss\Models\Hoatdong;

class HoatdongForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Hoatdong)
            ->setValidatorClass(HoatdongRequest::class)
            ->withCustomFields()
            ->add('id_team', 'text', [
                'label'      => 'Team',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('url', 'text', [
                'label'      => 'URL Video',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('tran_thai', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => ['Ẩn','Hiện'],
                'default_value' => 0,
            ])
            ->setBreakFieldPoint('status');
    }
}
