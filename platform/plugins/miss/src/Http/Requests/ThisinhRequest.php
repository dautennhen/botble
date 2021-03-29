<?php

namespace Botble\Miss\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ThisinhRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mssv'   => 'required',
            'so_bao_danh'   => 'required',
            'ho'   => 'required',
            'ten'   => 'required',
            'email'   => 'required',
            'avatar'   => 'required',
            'tuoi'   => 'required',
            'chieu_cao'   => 'required',
            'so_do_ba_vong'   => 'required',
            // 'que_quan'   => 'required',

            // 'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
