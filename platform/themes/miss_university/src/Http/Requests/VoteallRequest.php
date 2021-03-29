<?php

namespace Theme\Missuniversity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteallRequest extends FormRequest
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
            'thisinh_id' => 'required',
        ];
    }
    
    public function messages()
    {
        return [];
    }
    
    public function attributes()
    {
        return [];
    }
}
