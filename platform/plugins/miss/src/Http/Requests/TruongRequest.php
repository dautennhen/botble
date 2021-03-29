<?php

namespace Botble\Miss\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TruongRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name'   => 'required',
            'ten_truong'   => 'required',
            'logo_truong'   => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
