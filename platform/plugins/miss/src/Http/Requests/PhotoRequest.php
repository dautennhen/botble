<?php

namespace Botble\Miss\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class PhotoRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mo_ta'   => 'required',
            // 'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
