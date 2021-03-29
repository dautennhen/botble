<?php

namespace Botble\Miss\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Http\Requests\ThachthucRequest;
use Botble\Miss\Models\Thachthuc;

class ThachthucForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Thachthuc)
            ->setValidatorClass(ThachthucRequest::class)
            ->withCustomFields()
            ->add('ten_team', 'text', [
                'label'      => 'Tên team',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: DHHS',
                    'data-counter' => 120,
                ],
            ])
            ->add('huan_luyen_vien', 'text', [
                'label'      => 'Huấn luyện viên',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts1', 'text', [
                'label'      => 'Thí sinh 1',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts2', 'text', [
                'label'      => 'Thí sinh 2',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts3', 'text', [
                'label'      => 'Thí sinh 3',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts4', 'text', [
                'label'      => 'Thí sinh 4',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts5', 'text', [
                'label'      => 'Thí sinh 5',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts6', 'text', [
                'label'      => 'Thí sinh 6',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts7', 'text', [
                'label'      => 'Thí sinh 7',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('ts8', 'text', [
                'label'      => 'Thí sinh 8',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'VD: Võ Hoàng Yến',
                    'data-counter' => 120,
                ],
            ])
            ->add('image', 'mediaImage', [
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
