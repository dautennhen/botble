<?php

namespace Botble\Miss\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Miss\Http\Requests\NamhocRequest;
use Botble\Miss\Models\Namhoc;

class NamhocForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Namhoc)
            ->setValidatorClass(NamhocRequest::class)
            ->withCustomFields()
            ->add('ten_nam_hoc', 'text', [
                'label'      => 'Năm học của sinh viên',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => 'Ví dụ: Năm nhất',
                    'data-counter' => 120,
                ],
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
