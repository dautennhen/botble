<?php

namespace Theme\Missuniversity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThisinhuploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mo_ta_ly_lich' => 'required',
            'video' => 'required'
        ];
    }
    
    public function messages()
    {
        return [];
    }
    
    public function attributes()
    {
        return [
            'mo_ta_ly_lich' => 'mô tả lý lịch'
        ];
    }
}
